<?php
//Extracts event data contained within Banquet Event Order PDFs exported from CaterEase.

//Testing page - this whole block should be deleted or commented out before pushing to production
/*
if (count(get_included_files()) <= 1){ //Make sure that this is the loaded page, since it is also a library
?>
<html>
	<head>
		<title>BEO PDF Decoder</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style>
			#output{
				display: none;
				white-space: nowrap;
			}
			#showhide:checked ~ #output{
				display: block;
			}
			#showhide{
				display: none;
			}
			#hshowhide{
				color: #00e;
				text-decoration: underline;
				cursor: pointer;
			}
			#hshowhide::before{
				content:"Show Raw Text";
			}
			#showhide:checked + #hshowhide::before{
				content:"Hide Raw Text";
			}
			table, thead, tbody, tfoot, tr, th, td{
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<h1>Upload a BEO PDF to decode <a href="#">+</a></h1>
		<form method="post" enctype="multipart/form-data" id="form">
			<input type="file" name="beo" onchange="document.getElementById('form').submit();" />
		</form>
		<hr/>
<?php
	//Validate file upload
	if ($_SERVER["REQUEST_METHOD"]=="POST" &&
		isset($_FILES['beo']['error']) &&
		!is_array($_FILES['beo']['error']) &&
		$_FILES['beo']['error'] == UPLOAD_ERR_OK &&
		$_FILES['beo']['size'] < 4000000 &&
		$_FILES['beo']['type'] == "application/pdf"
	) {
		//Convert pdf to json
		$pdfjson = decode_pdf_file_xpdf2json($_FILES['beo']['tmp_name']);
		//Output of pdf2json is each word individually, so organize those into lines
		$textdata = collate_text_xpdf2json($pdfjson);
		//Extract the business information from the pdf data
		$event_data = extract_data($textdata);
		//Display it for debugging purposes
	?>

		<h2><?=$event_data["type"]=="Normal"?"":$event_data["type"]." "?>Event Order E<?=$event_data["id"]?>:</h2>
		<h3>
			<?php if(!empty($event_data["meta"]["Event Name"])){ ?>
				<?=$event_data["meta"]["Event Name"]?><br/>
			<?php } ?>
			<?=date("l, F j, Y, g:i A", strtotime($event_data["date"]))?>
		</h3>
		<hr/>
		<h3 style="margin: 4px 0;">Food Items</h3>
		<table>
			<thead>
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Unit</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($event_data["foodservice"] as $fooditem){
						if(!empty($fooditem["meta"])){
							?>
							<tr>
								<td><?=$fooditem["title"]?></td>
								<td><?=$fooditem["meta"]["Qty"]?></td>
								<td><?=$fooditem["meta"]["Unit"]?></td>
							</tr>
							<?php
						}else{
							?>
							<tr>
								<td colspan="3">
									<b style="font-size: 1.1em"><u><?=$fooditem["title"]?></u></b><br/>
									<?=nl2br($fooditem["text"])?>
									<?php foreach($fooditem["items"] as $subitem){ ?>
										<br/>
										subitem
									<?php } ?>
								</td>
							</tr>
							<?php
						}
					}
				?>
			</tbody>
		</table>
		<?php
		
		echo("<pre>");
		var_export($event_data);
		echo("</pre>");
		
		//Display text blocks
		?>
		<br/>
		<input id="showhide" type="checkbox"/>
		<label id="hshowhide" for="showhide"></label>
		<div id="output">
		<?php
		$tb_inter = Array();
		foreach($textdata as $data){
			$blockstring  = "(F: S".$data["font"]["size"];
			$blockstring .= ($data["font"]["bold"]?"B":"");
			$blockstring .= ($data["font"]["italic"]?"I":"");
			$blockstring .= " X".$data["left"];
			$blockstring .= " Y".$data["top"];
			$blockstring .= " W".$data["width"].")<br/>";
			$blockstring .= $data["data"]."<br/>";
			array_push($tb_inter, $blockstring);
		}
		echo(join("-----<br/>", $tb_inter));
		?>
		</div>
	<?php } ?>
	</body>
</html>
<?php
}//*/

//Turns pdf into json USING FLEXPATH'S pdf2json.exe THAT WE CUSTOMIZED
function decode_pdf_file($filepath){
	//Decode PDF with pdf2json
	$Cpath = realpath($filepath);
	$Cpath2 = $Cpath . ".pdf";
	$Dpath = $Cpath.".json";
	shell_exec("\"./pdf2json/pdf2json\" -i ".$Cpath." ".$Dpath);
	//Unicode handling
	$rawfile = file_get_contents($Dpath); 

	$utf8file =  mb_convert_encoding($rawfile, 'UTF-8', mb_detect_encoding($rawfile, 'UTF-8, ISO-8859-1', true)); 
	$pdfjson = json_decode(rtrim($utf8file, "\0"), true);
	unlink($Dpath); //Clean up decompressed pdf

	return $pdfjson;
}

//Organize positioned words into positioned lines
//USE WITH FLEXPAPER'S pdf2json.exe THAT WE CUSTOMIZED
function collate_text($pdf){
	//Get font sizes so we can associate meaningful font info to text
	//PDF2JSON is /*subpar*/ garbage in this regard but oh well
	//But PDF2JSON UASU Custom Edition is great! Because it was actually detecting the stuff we needed, just not outputting it...
	$fontmap = [];
	foreach($pdf as $page){
		foreach($page["fonts"] as $font){
			$fontmap[intval($font["fontspec"])] = Array(
				"size" => intval($font["size"]),
				"bold" => $font["bold"] == "true" ? true : false,
				"italic" => $font["italic"] == "true" ? true : false
			);
		}
	}
	
	//Reorganize data to just have text, organized by line
	$yoff = 0;
	$textdata = [];
	$nextx = 0;
	$lasti = 0;
	foreach($pdf as $page){
		foreach($page["text"] as $text){
			$text["font"] = $fontmap[$text["font"]];
			$text["top"] += $yoff;
			if (abs($textdata[$lasti]["top"] - $text["top"]) < 2
				&& abs($nextx-$text["left"]) < 3
				&& $textdata[$lasti]["font"]["size"] == $text["font"]["size"]
			){ //See if the word should be attached to the last word (same line geometrically and same fontsize)
				$textdata[$lasti]["data"] .= $text["data"];
				$textdata[$lasti]["width"] += (($text["left"] - ($textdata[$lasti]["left"] + $textdata[$lasti]["width"])) + $text["width"]);
				$textdata[$lasti]["font"] = $text["font"];
			}else{
				/*
				if($text["data"] == ":"){
					error_log('==:==');
					error_log('abs($textdata[$lasti]["top"] - $text["top"]) = abs('.$textdata[$lasti]["top"]." - ".$text["top"].") = ".abs($textdata[$lasti]["top"] - $text["top"]));
					error_log('abs($nextx-$text["left"]) = abs('.$nextx."-".$text["left"].") = ".abs($nextx-$text["left"]));
					error_log('$textdata[$lasti]["font"]["spec"] = '.$textdata[$lasti]["font"]["spec"].', $text["font"]["spec"] = '.$text["font"]["spec"]);
					error_log('$textdata[$lasti]["font"]["size"] = '.$textdata[$lasti]["font"]["size"].', $text["font"]["size"] = '.$text["font"]["size"]);
					error_log('$textdata[$lasti]["data"] = '.$textdata[$lasti]["data"]);
				}
				//*/
				
				$text["font-i"] = $text["font"];
				$text["width-i"] = $text["width"];
				$lasti = array_push($textdata, $text) - 1;
			}
			$nextx = $text["left"]+$text["width"];
		}
		$yoff += $page["height"];
	}
	
	return $textdata;
}

function prepare_pdf($filename){
	$xpdfjson = decode_pdf_file($filename);
	$xpdf = collate_text($xpdfjson);
	return $xpdf;
}

//Strips non alphanumeric characters and makes key one lower-camelcase word
function normalize_key($rawkey){
	$ankey = preg_replace("/[^A-Za-z0-9 ]/", " ", $rawkey);
	$words = explode(" ", $ankey);
	$key = "";
	foreach($words as $word){
		$key .= ucfirst($word);
	}
	return $key;
}

//Get the useful catering event data from the pdf
function extract_data($textdata){
	$beo = Array(); //Main structure to hold all extracted data
	
	//Collect non-table text data from top area of the document
	$eventdata = [];
	foreach($textdata as $text){
		if($text["data"] == "Venue") break;
		$eventdata[] = $text["data"];
	}
	
	//Get basic event info
	$match_inter = [];

	// All possible phrases leading Event No should be listed here.
	if (preg_match('/^(?:([\w\s]+) )?Contract #E(\d+)$/', $eventdata[0], $match_inter)) {
		if(count($match_inter)!=3) return "BAD1";
	} elseif (preg_match('/^(?:([\w\s]+) )?Event Order # : E(\d+)$/', $eventdata[0], $match_inter)) {
		if(count($match_inter)!=3) return "BAD1";
	} else {
		echo "Add more if more";
	}
	
	if(empty($match_inter[1])) $beo["type"] = "Normal";
	else $beo["type"] = $match_inter[1];
	$beo["id"] = intval($match_inter[2], 10);
	preg_match('/^Event Date: (.+)$/', $eventdata[1], $match_inter);
	if(count($match_inter)!=2) return "BAD2";
	else $date_component = $match_inter[1];
	preg_match('/^Status: (.+)$/', $eventdata[2], $match_inter);
	if(count($match_inter)!=2) return "BAD3";
	else $beo["status"] = $match_inter[1];
	
	//Get all other field-structured data
	$beo["meta"] = Array();
	for($i = 0; $i < count($eventdata); $i++){
		$meta_inter = explode(":", $eventdata[$i], 2);
		if(count($meta_inter) == 2)
			$beo["meta"][normalize_key($meta_inter[0])] = trim($meta_inter[1]);
	}
	
	//Extract venue table data
	$inVenue = false;
	$tableX = 0;
	$tabledata = [];
	$common_fonts = [];
	foreach($textdata as $text){
		if($text["data"] == "Venue" && !$inVenue){
			$inVenue = true;
			$tableX = $text["left"];
		}else if($inVenue){
			if($text["data"] == "Food/Service Items") break;
			if($text["left"] < $tableX) break;
			array_push($tabledata, $text);
		}
	}
	$headerY = $tabledata[0]["top"];
	$columns = [];
	foreach ($tabledata as $text) {
		if ($text["top"] == $headerY) { //Add new column if text at top
			array_push($columns, Array(
				"name" => $text["data"],
				"x" => $text["left"],
				"data" => Array()
			));
		} else { //Group all other data into columns
			if(empty($text["data"])) continue; //Reject empty columns
			if(preg_match("/^\s*$/", $text["data"])) continue;
			$minD = 1000000;
			$column = null;
			foreach($columns as $cid => $testcolumn){ //Find nearest column
				$dist = abs($testcolumn["x"] - $text["left"]);
				if($dist < $minD){
					$minD = $dist;
					$column = $cid;
				}
			}
			array_push($columns[$column]["data"], Array(
				"y" => $text["top"] - $headerY,
				"font" => $text["font"],
				"text" => trim($text["data"])
			));
			$common_fonts[$text["font"]["size"]] += 1;
		}
	}
	
	$max_font_occurrences = 0;
	$common_font = 0;
	//Find most common font size (this is mostly vestigal)
	foreach($common_fonts as $fontid=>$count){
		if($count > $max_font_occurences){
			$max_font_occurences = $count;
			$common_font = $fontid;
		}
	}
	
	$venue = Array();
	foreach($columns as $column){
		$next_y = 0;
		$key = normalize_key($column["name"]);
		if($key == "TyPe") $key = "Type"; //happens on some pdfs
		foreach($column["data"] as $item){ //Make data associative
			if(abs($item["y"] - $next_y) <= 2){
				$venue[$key] .= " " . $item["text"];
			}else{
				if(empty($venue[$key]))
					$venue[$key] = $item["text"];
				else break;
			}
			$next_y = $item["y"]+$item["size"]*1.4;
		}
	}
	if(!empty($venue["Start"]) && preg_match("/^\d{1,2}:\d{2}\s*[ap]m$/", $venue["Start"]))
		$date_component .= " ".$venue["Start"];
	else if(!empty($venue["FBService"]) && preg_match("/^\d{1,2}:\d{2}\s*[ap]m$/", $venue["FBService"]))
		$date_component .= " ".$venue["FBService"];
	$beo["date"] = date("Y-m-d H:i:s", strtotime($date_component));
	$beo["event"] = $venue;
	
	//Extract Food/Service table data
	$inFood = false;
	$tableX = 0;
	$tabledata = [];
	$linelengths = [];
	$depage = false;
	$depage_ht = 0;
	$y_offset = 0;
	$last_font = [];
	foreach($textdata as $text){
		if($text["data"] == "Food/Service Items" && !$inFood){ //Find start of block
			$inFood = true;
			$tableX = $text["left"];
		}else if($inFood){
			if (preg_match("/^(?:Page \d+ of \d+)$/", $text["data"]) //Throw out things such as page numbers or footers
				|| preg_match("/^(?:E\d+ - .+)$/", $text["data"])
				|| preg_match("/^(?:[0-9\/]{8,10} - [0-9:]{7,8} [aApP][mM])$/", $text["data"])
				|| $text["font"]["size"] <= 9
			){ //These always occur between pages, so remove the inter-page spacing
				$depage = $last_font;
				continue;
			}
			if(empty(trim($text["data"]))) continue; //Obviously no reason to keep empty things
			if(strlen($text["data"]) <= 2 && !preg_match("/^[A-Za-z0-9!?]+$/", $text["data"])) continue; //Reject symbols that end up in a different block
			if($text["left"] < $tableX) break; //Stop when something is farther left than the start of the table.
			
			if($depage !== false){ //Calculate/remove inter-page spacing
				$y_offset = $text["top"] - $depage_ht;
				//Also consider that maybe there *should* be some spacing between the lines, these are common cases
				if(
					in_array(rtrim($text["data"], "s"), ["Salad", "Accompaniment", "Dessert", "Beverage", "Entrée"])
					|| $text["font"] != $depage
				){
					$y_offset -= 15;
				}
				$depage = false;
			}
			$next_y = $text["top"]+$text["font"]["size"]*1.4;
			if($next_y >= $depage_ht){
				$depage_ht = $next_y;
				$last_font = $text["font"];
			}
			$text["top"] -= $y_offset;
			
			array_push($tabledata, $text);
			array_push($linelengths, $text["width"]);
		}
	}
	
	//Find the typical max line length (average of longest 3 lines)
	//Lines longer than 500 are excluded since these are almost always outliers
	rsort($linelengths);
	$maxavglength = 0;
	$ia = 0;
	$ib = 0;
	while ($ib < 3) {
		if ($linelengths[$ia] < 500) {
			if ($ia > count($linelengths) - 1) break;
			$maxavglength += $linelengths[$ia];
			$ib++;
		}
		$ia++;
	}
	$maxavglength /= 3;
	
	$headerY = $tabledata[0]["top"];
	$columns = [];
	foreach ($tabledata as $text) {
		if ($text["top"] == $headerY) { //Add new column if text at top
			array_push($columns, Array(
				"name" => $text["data"],
				"x" => $text["left"],
				"data" => Array()
			));
		} else { //Group all other data into columns
			if(empty($text["data"])) continue; //Reject empty columns
			if(preg_match("/^\s*$/", $text["data"])) continue;
			$minD = 1000000;
			$column = null;
			foreach($columns as $cid => $testcolumn){ //Find nearest column
				$dist = abs($testcolumn["x"] - $text["left"]);
				if($dist < $minD){
					$minD = $dist;
					$column = $cid;
				}
			}
			array_push($columns[$column]["data"], Array(
				"x" => $text["left"],
				"y" => $text["top"] - $headerY,
				"font" => $text["font-i"]["bold"] == true ? $text["font-i"] : $text["font"],
				"size" => $text["font"]["size"],
				"width" => $text["width"],
				"width-i" => $text["width-i"],
				"text" => trim($text["data"])
			));
		}
	}
	
	$foodservice = Array();
	$sections = [
		"food" => "Food",
		"other" => "Other",
		"equipment" => "Equipment",
		"beverages" => "Beverages",
		"beverage" => "Beverages"
	];
	$current_section = "food";
	$current_block = 0;
	$current_item = -1;
	$next_y = 0;
	$last_width = 100000000000;
	$last_font = 0;
	foreach($columns[0]["data"] as $itemindex => $item){ //Group data into sections, line items or notes, and subitems
		if($item["font"]["bold"]){ //A heading
			$possible_section = strtolower($item["text"]);
			if(isset($sections[$possible_section])){
				$current_section = $sections[$possible_section];
				continue;
			}else{
				if(abs($item["y"] - $next_y) <= 3){ //Directly following last line
					$last_item = &$foodservice[$current_block];
					if ($item["width-i"] + $last_width >= $maxavglength && !empty($last_item["text"])){
						$last_item["text"] .= " " . $item["text"];
					}else if(!empty($last_item["text"])){
						$last_item["text"] .= "\n" . $item["text"];
					}else{
						$split_inter = explode(":", $last_item["title"], 2);
						if(count($split_inter) == 2){
							$last_item["title"] = trim($split_inter[0]);
							$last_item["text"] = trim($split_inter[1]);
							$last_item["text"] .= " " . $item["text"];
						}else if(count($last_item["meta"]) < 4){ //If it has price, qty, unit, etc it's probably not a comment
							$last_item["title"] = "Comment";
							$last_item["text"] = trim(end($split_inter));
							$last_item["text"] .= " " . $item["text"];
						}else if($item["width"] + 50 < $maxavglength){ //If for some reason the title runs to the next line concat it
							$last_item["title"] .= " " . $item["text"];
							$last_item["text"] = "";
						}
					}
				}else{
					//error_log($item["text"] . " ←↑↓→ " . abs($item["y"] - $next_y) . " ☜☝☞☟ " . ($maxavglength - $last_width));
					$meta = Array();
					
					//Find y-range which metadata for this block could be in (basically the y-range of this block of text plus a little)
					$meta_y_min = $item["y"] - 4;
					$sub_next_y = $item["y"] + $item["font"]["size"] * 1.4;
					$meta_y_max = $sub_next_y + 4;
					for($subi = $itemindex+1; $subi < count($columns[0]["data"]); $subi++){
						$subitem = $columns[0]["data"][$subi];
						if(abs($subitem["y"] - $sub_next_y) >= 3 && $subitem["font"]["bold"] == true){
							$meta_y_max = $subitem["y"]-$subitem["font"]["size"]*1.4+4;
							break;
						}
						$sub_next_y = $subitem["y"]+$subitem["font"]["size"]*1.4;
					}
					
					//Get the metadata (Price, Qty, Unit, Total, but potentially anything) for the block
					for($col = 1; $col < count($columns); $col++){
						$column = $columns[$col];
						foreach($column["data"] as $datum){
							if($meta_y_min < $datum["y"] && $datum["y"] < $meta_y_max){
								$meta[$column["name"]] = $datum["text"];
							}
						}
					}
					
					if($possible_section == "comments") $current_section = "Comments";
					$current_block = array_push($foodservice, Array(
						"title" => $item["text"],
						"text" => "",
						"items" => Array(),
						"category" => $current_section,
						"meta" => $meta,
					)) - 1;
					$current_item = -1;
				}
			}
		}else{ //A text
			if($item["x"] > 100 && $item["text"] == "Food") continue; //Reject stray "Food" from another part of the document
			if($current_item == -1)
				$last_item = &$foodservice[$current_block];
			else
				$last_item = &$foodservice[$current_block]["items"][$current_item];
			if (
				(
					( //Split lines when the lengths mean they probably haven't wrapped
						(
							$item["width-i"] + $last_width < $maxavglength
							|| $item["font"]["italic"] != $last_font["italic"]
						)
						&& !empty($last_item["text"])
					) //(V, VE, GF) and similar both denotes the end of a food item and often gets pushed to the next line
					|| preg_match("/\((V|GF)(?:,\s*)?(VE)?(?:,\s*)?(GF)?\)$/", $last_item["text"]) //Splits next item off
				)
				&& !preg_match("/^\((V|GF)(?:,\s*)?(VE)?(?:,\s*)?(GF)?\)$/", $last_item["text"]) //Rejoins with respective item
			)
				$item["text"] = "\n" . $item["text"];
			
			//Combine with previous lines in the block or item
			if(abs($item["y"] - $next_y) <= ($current_section == "Comments" && $current_item == -1 && empty($last_item["text"]) ? 50 : 2)){
				if(empty($last_item["text"]) && $item["width-i"] + $last_width >= $maxavglength && $item["font"] == $last_font){
					$last_item["text"] = $last_item["title"];
					$last_item["title"] = "";
				}
				if(!empty($last_item["text"])){
					if($item["text"][0] == "-")
						$item["text"] = "\n" . $item["text"];
					else
						$item["text"] = " " . $item["text"];
				}
				$last_item["text"] .= $item["text"];
			}else{
				$current_item = array_push($foodservice[$current_block]["items"], Array(
					"title" => ltrim($item["text"]),
					"text" => "",
				)) - 1;
			}
		}
		$next_y = $item["y"]+$item["size"]*1.4;
		$last_width = $item["width"];
		$last_font = $item["font"];
	}
	
	/*/Counteract the "Food" column heading from the next table sneaking into the foodservice list - SEE LINE 486
	end($foodservice);
	$last_fs_block = &$foodservice[key($foodservice)];
	end($last_fs_block["items"]);
	$last_fs_item = $last_fs_block["items"][key($last_fs_block["items"])];
	if (empty($last_fs_item["text"])
		&& strtolower($last_fs_item["title"]) == "food"
	){
		unset($last_fs_block["items"][key($last_fs_block["items"])]);
	}
	//*/
	
	$beo["foodservice"] = $foodservice;
	
	return $beo;
}
?>