<?php
	session_start();
  if(!isset($_SESSION['app_id'])){
    header("Location: ./start.php");
    exit;
  }
	require('application_db.inc');
	//var_dump($_SESSION['specificpos']);
	
	if($_POST['submit1']=='Save and Continue'){
		
		//Register variables from previous page	
		if($_POST['refer']){$_SESSION['refer'] = $_POST["refer"];}	
		if($_POST['crime1']){$_SESSION['crime1'] = $_POST["crime1"];}
		$_SESSION['year'] 			= $_POST["year"];
		$_SESSION['student'] 		= $_POST['student'];	
		
		$_SESSION['error_msg1'] = "";
			
		//Check all the rest of the required fields from the previous page
		if(!$_POST['first_name']) {
			$_SESSION['error_msg1'] = "First name required<br />";
			$_SESSION['error1']['first_name'] = 'border:1px solid red';
		}
		else{
			$_SESSION['first_name']		= $_POST["first_name"];
			unset($_SESSION['error1']['first_name']);
		}
		
		
		if(!$_POST['last_name']) {		
			$_SESSION['error_msg1'] .= "Last name required<br />";
			$_SESSION['error1']['last_name'] = 'border:1px solid red';
		}	
		else{
			$_SESSION['last_name']		= $_POST["last_name"];
			unset($_SESSION['error1']['last_name']);
		}
	
		if(!$_POST['add']) {
			$_SESSION['error_msg1'] .= "Address is required<br />";
			$_SESSION['error1']['add'] = 'border:1px solid red';
		}
		else{
			$_SESSION['add']			= $_POST["add"];
			unset($_SESSION['error1']['add']);
		}
		
		if(!$_POST['city']) {
			$_SESSION['error_msg1'] .= "City is required<br />";
			$_SESSION['error1']['city'] = 'border:1px solid red';
		}
		else{
			$_SESSION['city']			= $_POST["city"];
			unset($_SESSION['error1']['city']);
		}
		
		if(!$_POST['state']) {
			$_SESSION['error_msg1'] .= "State is required<br />";
			$_SESSION['error1']['state'] = '<span class="error_message">*</span>';
		}
		else{
			$_SESSION['state']			= $_POST["state"];
			unset($_SESSION['error1']['state']);
		}
		
		if(!$_POST['zip']) {
			$_SESSION['error_msg1'] .= "Zipcode is required<br />";
			$_SESSION['error1']['zip'] = 'border:1px solid red';
		}
		else{
			$_SESSION['zip']			= $_POST["zip"];
			unset($_SESSION['error1']['zip']);
		}
		
		if(preg_match("/^\d{5}$|^\d{5}-\d{4}$/", $_POST['zip'])===0) {
			$_SESSION['error_msg1'] .= "Please enter a valid zipcode<br />";
			$_SESSION['error1']['zip'] = 'border:1px solid red';
		}
		else{
			$_SESSION['zip']			= $_POST["zip"];
			unset($_SESSION['error1']['zip']);
		}
		
		
		
		if($_POST['email'] == "") {
			$_SESSION['error_msg1'] .= "Email contact required<br />";
			$_SESSION['error1']['email'] = 'border:1px solid red';
		}
		else{
			$_SESSION['email']			= $_POST["email"];
			unset($_SESSION['error1']['email']);
		}
		
		if(preg_match("/^[a-zA-Z]\w+(\.\w+)*\@\w+(\.[0-9a-zA-Z]+)*\.[a-zA-Z]{2,4}$/", $_POST["email"]) === 0) {
			$_SESSION['error_msg1'] .= "Please enter a valid email<br />";
			$_SESSION['error1']['email'] = 'border:1px solid red';
		}
		else{
			$_SESSION['email']			= $_POST["email"];
			unset($_SESSION['error1']['email']);
		}
	
		if(!$_POST['phone']) {
			$_SESSION['error_msg1'] .= "Phone number required<br />";
			$_SESSION['error1']['phone'] = 'border:1px solid red';
		}
		else{
			$_SESSION['phone']			= $_POST["phone"];
			unset($_SESSION['error1']['phone']);
		}
		
		if(preg_match("/^([-()]?[\d]){10,}.*$/", $_POST['phone']) === 0){
			$_SESSION['error_msg1'] .= "Please enter a valid phone number (including area code).<br />";
			$_SESSION['error1']['phone'] = 'border:1px solid red';
		}
		else{
			
			if(strlen($_POST['phone'])==10)
				$_SESSION['phone'] = $_POST['phone'][0].$_POST['phone'][1].$_POST['phone'][2].'-'.$_POST['phone'][3].$_POST['phone'][4].$_POST['phone'][5].'-'.$_POST['phone'][6].$_POST['phone'][7].$_POST['phone'][8].$_POST['phone'][9];
			else
				$_SESSION['phone']			= $_POST["phone"];
			unset($_SESSION['error1']['phone']);
		}
		
		if($_POST['workStudy'] == "") {
			$_SESSION['error_msg1'] .= "Please select your work study eligibility<br>";
			$_SESSION['error1']['workStudy'] = '<span class="error_message">*</span>';
		}
		else{
			$_SESSION['workStudy']		= $_POST["workStudy"];
			unset($_SESSION['error1']['workStudy']);
		}
	
		if($_POST['workUnions'] == "") {
			$_SESSION['error_msg1'] .= "Please let us know if you have ever worked at the Student Unions<br />";
			$_SESSION['error1']['workUnions'] = '<span class="error_message">*</span>';
		}
		else{
			$_SESSION['workUnions']	= $_POST["workUnions"];
			unset($_SESSION['error1']['workUnions']);
		}
	
		if($_POST['convictCrime'] == "") {
			$_SESSION['error_msg1'] .= "Please let us know if you have been convicted of a crime<br />";
			$_SESSION['error1']['convictCrime'] = '<span class="error_message">*</span>';
		}
		else{
			$_SESSION['convictCrime']	= $_POST["convictCrime"];
			unset($_SESSION['error1']['convictCrime']);
		}
		
		if($_SESSION['error_msg1'] != '') {
			header("Location: ./1.php");
			exit;
		}
		
		
					
		$query = 'update student set '.
				 'refered="'.db_real_escape($_SESSION['refer'], 25).'", '.
				 'crime_info="'.db_real_escape($_SESSION['crime1'], 100).'", '.
				 'class_standing="'.db_real_escape($_SESSION['year'], 8).'", '.
				 'student_type="'.$_SESSION['student'].'", '.
				 'first="'.db_real_escape($_SESSION['first_name'], 20).'", '.
				 'last="'.db_real_escape($_SESSION['last_name'], 20).'", '.
				 'address="'.db_real_escape($_SESSION['add'], 100).'", '.
				 'city="'.db_real_escape($_SESSION['city'], 20).'", '.
				 'state="'.db_real_escape($_SESSION['state'], 2).'", '.
				 'zip="'.db_real_escape($_SESSION['zip'], 10).'", '.
				 'email="'.db_real_escape($_SESSION['email'], 100).'", '.
				 'phone="'.db_real_escape($_SESSION['phone'], 15).'", '.
				 'work_study="'.$_SESSION['workStudy'].'", '.
				 'worked_for_union="'.$_SESSION['workUnions'].'", '.
				 'crime="'.$_SESSION['convictCrime'].'"' .
				 'where ID="'.$_SESSION['app_id'].'"';
		//print $query;
		db_query($query);
		
		if($_SESSION['stage']<2){
			$_SESSION['stage']=2;
			db_query("update student set stage=2 where ID='".$_SESSION['app_id']."'");
		}
				 

		
		
	}
	
	
	
ob_start();
?>
			@import url("forms.css");
					.textbox{
						border:none;
						background-color:#FCF9D0;
					}
					p{
						font-size:13px;
						margin-top: 15px;
						_margin-top: 14px;
						margin-bottom: 0px;
						line-height:15px;
					}
					.cloud{
						float:left;
						margin-bottom:20px;
						display:block;
					}
					.active{
						cursor:pointer;
					}					
					div{
						font-size:13px;
					}
					.info_box{
						position:absolute; 
						z-index:1000; 
						background-color:#387D31; 
						color:#fff;
						left: 0px;
						display:none;
						padding: 5px;
						margin: 15px;
						font-size:11px;
						line-height:13px;
					
					}
					.more_info{
						color:#C01525;
						cursor:pointer;
						text-decoration:underline;
					}
					label{
						font-size:12px;
						vertical-align:baseline;
					}
					input, label, span{
						margin-top:0px;
						margin-bottom:0px;
						padding-top:0px;
						padding-bottom:0px;
						
					}
					.remove{
						color:#387D31;
						text-decoration:underline;
						font-size:11px;
						cursor:pointer;
					}
					#shadow{
						background-color:#000000;
						opacity: .75; 
						filter:alpha(opacity=75);
						display:none;
						position:absolute;
						top:0;
						left:0;
						margin:0px;
						padding:0px;
						z-index:100;
						height:3000px;
						width:3000px;
					
					}
					.noscroll{
						overflow:hidden;
					}
					#scrollbox{
						overflow:auto;
						top:0;
						left:0;
						position:absolute;
						z-index:101;
						width:100%;
						height:100%;
						display:none;
						
					}
					.popup_box{
						background:white;
						position:absolute;
						width:600px;
						
						height:480px;
						left:50%;
						margin-left:-300px;
						top:50%;
						margin-top:-240px;						
						display:none;
						padding:15px;
						border:5px solid #999999;
						z-index:102;
					}
					
<?php
$page_options['styles'] = ob_get_clean();

ob_start();
?>
	
		
		var last = 'instructions1';
		var last_link = '';

		var oneortwo = 1;
		var scrolly = 0;
		var scrollx =0;
		
		function link_select(linkElement){
		
			if(linkElement){
				linkElement.style.color='#C01525';
				linkElement.style.fontWeight='bold';
				if(last_link){
					last_link.style.color = '#000000';
					last_link.style.fontWeight = 'normal';
				}
				last_link = linkElement;
			}
			return true;
		}
		
		function remove_job(job){
		
			document.getElementById('specifics').removeChild(job.parentNode);
			return true;
		}
		
		function addspecific(name, num){
			
			link_select(last_link);
	
			if(document.getElementById('specifics').innerHTML.indexOf(name.replace(/&/g, '&amp;'))==-1){
				document.getElementById('specifics').innerHTML += '<li>'+name+' <span onClick="remove_job(this);" style="color:#387D31; text-decoration:underline; font-size:11px; cursor:pointer;" >remove</span><input type="hidden" name="specificpos[]" value="'+name+'"><input type="hidden" name="specificposnum[]" value="'+num+'"></li>';
			
			}
			else{
				alert(name + ' has already been added');
			}
			
			switchdiv(0);	
		}
		
		function showspecific(location){
			document.getElementById(last).style.display = 'none';
			document.getElementById(location).style.display = 'block';
			last = location;
		}
		
		
		function switchdiv(div_id){
		
			return true;
		}
	
		function disable(type){
		switch(type){
			case 'area':
					document.getElementById('Dining').disabled = false;
					document.getElementById('Retail').disabled = false;
					document.getElementById('CSIL').disabled = false;
					document.getElementById('Operations').disabled = false;
					
					document.getElementById('specifics').style.color = '#777777';
					
					//document.getElementById('added').style.display = 'none';
			break;
			case 'position':
					
					document.getElementById('Dining').disabled = true;
					document.getElementById('Retail').disabled = true;
					document.getElementById('CSIL').disabled = true;
					document.getElementById('Operations').disabled = true;
					
					document.getElementById('specifics').style.color = '#000000';
					
					//document.getElementById('added').style.display = 'block';
			
			break;
			case 'any':
					document.getElementById('Dining').disabled = true;
					document.getElementById('Retail').disabled = true;
					document.getElementById('CSIL').disabled = true;
					document.getElementById('Operations').disabled = true;
					
					document.getElementById('specifics').style.color = '#777777';
					
					//document.getElementById('added').style.display = 'none';
			break;
		}
		
		
	}
	
	function switchdiv(id){
	
		if(id==1){		 
			
			oneortwo = 1;
			
			document.body.innerHTML += '<div id="shadow" ></div>';
			
			document.page2.redistribute[0].checked = true;
			
			var shad = document.getElementById('shadow');
					
			position_popup();
			
			document.getElementById('onlyavailable').style.display = 'none';
			
			shad.style.display = 'block';
			
			document.getElementById('specific').style.display = 'block';
			document.getElementById('scrollbox').style.display = 'block';
	   
			if(document.getElementById('specific').offsetTop<scrolly){
				document.getElementById('specific').style.top = (240-scrolly)+'px';
			}
			else{
				document.getElementById('specific').style.top = '50%';
			}
			if(document.getElementById('specific').offsetLeft < scrollx){
				document.getElementById('specific').style.left =(300-scrollx)+'px';
			}
			else{
				document.getElementById('specific').style.left = '50%';
			}
		}
		else if(id==2){
		
			oneortwo = 2;
			
			document.body.innerHTML += '<div id="shadow"></div>';
			
			document.page2.redistribute[0].checked = true;
			
			var shad = document.getElementById('shadow');
					
			position_popup();
			
			document.getElementById('specific').style.display = 'none';
			
			shad.style.display = 'block';
			
			document.getElementById('onlyavailable').style.display = 'block';
			document.getElementById('scrollbox').style.display = 'block';
	   
			if(document.getElementById('onlyavailable').offsetTop<scrolly){
				document.getElementById('onlyavailable').style.top = (240-scrolly)+'px';
			}
			else{
				document.getElementById('onlyavailable').style.top = '50%';
			}
			
			if(document.getElementById('onlyavailable').offsetLeft < scrollx){
				document.getElementById('onlyavailable').style.left =(300-scrollx)+'px';
			}
			else{
				document.getElementById('onlyavailable').style.left = '50%';
			}
		
		}
		else{
			document.body.className = '';
			document.getElementById('onlyavailable').style.display = 'none';
			document.getElementById('specific').style.display = 'none';
			document.getElementById('scrollbox').style.display = 'none';
			document.getElementById('shadow').style.display = 'none';
		
		}
		
	
	}
	
	function areas_notchecked(){
		var a1 = document.getElementById('Dining').checked;
		var a2 = document.getElementById('CSIL').checked;
		var a3 = document.getElementById('Retail').checked;
		var a4 = document.getElementById('Operations').checked;
		if(a1 || a2 || a3 || a4)	return false;
		else						return true;
	}
	
	function position_popup(){
	
		//var documentheight = document.getElementById('get_height').offsetHeight;
		//var documentwidth =  document.getElementById('get_height').offsetWidth;
	
		var myWidth = 0, myHeight = 0;
  
  		if( typeof( window.innerWidth ) == 'number' ) {
    		//Non-IE
    		myWidth = window.innerWidth;
    		myHeight = window.innerHeight;
  		}
		else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    		//IE 6+ in 'standards compliant mode'
    		myWidth = document.documentElement.clientWidth;
    		myHeight = document.documentElement.clientHeight;
  		}
		else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    		//IE 4 compatible
    		myWidth = document.body.clientWidth;
    		myHeight = document.body.clientHeight;
		}
  
  		scrolly= (document.all)?document.body.scrollTop:window.pageYOffset;

   		scrollx= (document.all)?document.body.scrollLeft:window.pageXOffset;

  		document.body.className = 'noscroll';
  
   		document.getElementById('specific').style.marginTop = (-240 + scrolly)+'px';
    	document.getElementById('specific').style.marginLeft = (-300 + scrollx)+'px';
	
	 	document.getElementById('onlyavailable').style.marginTop = (-240 + scrolly)+'px';
    	document.getElementById('onlyavailable').style.marginLeft = (-300 + scrollx)+'px';
	
		document.getElementById('scrollbox').style.marginTop = ( scrolly)+'px';
   		document.getElementById('scrollbox').style.marginLeft = ( scrollx)+'px';

		document.getElementById('scrollbox').style.height = (myHeight)+'px';
    	document.getElementById('scrollbox').style.width = (myWidth)+'px';

	 	if(document.getElementById('specific').offsetTop<scrolly){
			document.getElementById('specific').style.top = (240-scrolly)+'px';
	  	}
	  	else{
	  		document.getElementById('specific').style.top = '50%';
	  	}
	  
	  	if(document.getElementById('specific').offsetLeft < scrollx){
			document.getElementById('specific').style.left = (300-scrollx)+'px';
	  	}
	  	else{
			document.getElementById('specific').style.left ='50%';
	  	}
	  
	  
	   	if(document.getElementById('onlyavailable').offsetTop<scrolly){
			document.getElementById('onlyavailable').style.top = (240-scrolly)+'px';
	  	}
	  	else{
	  		document.getElementById('onlyavailable').style.top = '50%';
	  	}
	  
	  	if(document.getElementById('onlyavailable').offsetLeft < scrollx){
			document.getElementById('onlyavailable').style.left = (300-scrollx)+'px';
	  	}
	  	else{
			document.getElementById('onlyavailable').style.left ='50%';
	  	}
		
	}
	
	window.onresize = position_popup;
<?php
$page_options['scripts'] = ob_get_clean();
	
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Arizona Student Union employee application:';
  $page_options['header_image'] = 'images/student_employment.png';
  page_start($page_options);
?>
	
		
<div style="padding-left:0px; width:100%; z-index:2; position:relative; top:-10;">
		
        <div style="margin-top:15px; width:950px;">
        	<div style="float:left; width:75px;">
            	<?php
				switch($_SESSION['stage']){
					
                       
					
					case 3:
				?>
                			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud" src="images/4_grey.gif" />
                            <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;  
					
					case 4:
				?>
                			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
                            <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;  
					
					case 5:
				?>
                			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
                            <img class="cloud active" src="images/5_green.gif" onclick="window.location='./5.php'"/>
                <?php
					break;  
				
					default:
				?>
                			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud" src="images/3_grey.gif" />
                            <img class="cloud" src="images/4_grey.gif" />
                            <img class="cloud" src="images/5_grey.gif" />
                <?php
					break; 
				}			
				?>
            </div>
            <div style="float:left; margin-left:30px; width:803px;">
              <form action="3.php" enctype="multipart/form-data" method="post" name="page2" >
               	<div>
            		<img src="images/where_to_work.gif" /><br>
                    In order to provide you with the best student job opportunities available to you, please choose one of the following three options which best describes you.<br>
                    <? if( isset($_SESSION['error_msg2'])) {
                        print '<span class="error_message">' . $_SESSION['error_msg2'] . '</span>';
                    	}
                    ?>
                </div>
    			<div style="background-color:#D2E5CA; height:270px; width:803px; padding:15px 0 15px 0;">
                	
                    
                    	<div style="float:left; width:237px; _width:267px; padding:0 15px 0 15px; height:270px; position:relative;">
                        	<h1 style="color:red;">Option #1</h1>
                				<input type="radio" name="redistribute" value="position" onclick="disable('position')" <?php if($_SESSION['redistribute'] == "position" ||(is_array($_SESSION['specificpos']) && $_SESSION['specificpos'][0]!='')){print 'checked';}?> /><label for="redistribute" ><strong>I want to work in the following position(s): </strong><span style="color:#C01525; cursor:pointer; text-decoration:underline;" onmouseover="document.getElementById('op3').style.display='block';" onmouseout="document.getElementById('op3').style.display='none';">more info</span><br>
                                
                				
									<ul id="specifics"><?php
									if(is_array($_SESSION['specificpos']) && $_SESSION['specificpos'][0]!=''){
										 
                                    	foreach($_SESSION['specificpos'] as $key => $position){
											if($position != ''){
												print '<li>'.$position.' <span onClick="remove_job(this);" class="remove" >remove</span><input type="hidden" name="specificpos[]" value="'.$position.'"><input type="hidden" name="specificposnum[]" value="'.$_SESSION['specificposnum'][$key].'"></li>';
											}
										}
										
									}
                                    
                                    ?></ul>
                                
                                
                
                                <div onclick="switchdiv(oneortwo); document.page2.redistribute[0].checked = true; disable('position'); " align="center" style="border:2px outset; padding:5px; width:110px; height:25px; " ><img id="big" src="images/BIG_add_jobs_button.gif" />
                                </div>
                                
                                <div id="op3" class="info_box">
                                	Please select this option if you are only interested in specific positions from our list of available jobs. Only managers of these specific positions will be able to contact you. You may add as many positions as you want by clicking the "add" button and selecting jobs. To apply for multiple positions, simply click the "add" button again and you will be returned to the options page.
                                </div>
                        </div>
                    	
                       
                        
                        <div style="float:left; width:237px; _width:267px; padding:0 15px 0 15px; height:270px; border-right: 1px solid; border-left:1px solid; position:relative;">
                        	<h1 style="color:red;">Option #2</h1>
                				<input type="radio" name="redistribute" value="area" onclick="disable('area')" <?php if($_SESSION['redistribute'] == "area"){print 'checked';}?>  /><label for="redistribute" ><strong>I want to work in the following areas: </strong><span class="more_info" onmouseover="document.getElementById('op2').style.display='block';" onmouseout="document.getElementById('op2').style.display='none';">more info</span><br><br />
               
               					<div>
               					&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="Dining" id="Dining" value="Dining" onclick="document.page2.redistribute[1].checked = true;" <?php if($_SESSION['redistribute'] != "area"){print 'disabled ';} if($_SESSION['Dining'] ==  "Dining"){print ' checked';}?>/><label for="Dining" >Dining&nbsp;<span class="more_info" onmouseover="document.getElementById('dining_info').style.display='block';" onmouseout="document.getElementById('dining_info').style.display='none';">more info</span></label><br />
                
                				&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="Retail" id="Retail" value="Retail" onclick="document.page2.redistribute[1].checked = true;" <?php if($_SESSION['redistribute'] != "area"){print 'disabled ';} if($_SESSION['Retail'] == "Retail"){print ' checked';}?> /><label for="Retail" >Retail&nbsp;<span class="more_info" onmouseover="document.getElementById('retail_info').style.display='block';" onmouseout="document.getElementById('retail_info').style.display='none';">more info</span></label><br />
                
                				&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="CSIL" id="CSIL" value="CSIL" onclick="document.page2.redistribute[1].checked = true;" <?php if($_SESSION['redistribute'] != "area"){print 'disabled ';} if($_SESSION['CSIL'] == "CSIL"){print ' checked';}?> /><label for="CSIL" >CSIL&nbsp;<span class="more_info" onmouseover="document.getElementById('csil_info').style.display='block';" onmouseout="document.getElementById('csil_info').style.display='none';">more info</span></label><br />
                                
                				&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="Operations" id="Operations" value="Operations" onclick="document.page2.redistribute[1].checked = true;" <?php if($_SESSION['redistribute'] != "area"){print 'disabled ';} if($_SESSION['Operations'] == "Operations"){print ' checked';}?> /><label for="Operations" >Operations&nbsp;<span class="more_info" onmouseover="document.getElementById('operations_info').style.display='block';" onmouseout="document.getElementById('operations_info').style.display='none';">more info</span></label>
                
                				</div>
                
                                <div id="dining_info" class="info_box" style="top:145px;">This is where the majority of our students work: Dining Services employs students in many capacities, ranging from Cashiers to Cooks to Student Managers. Some units in this department include Core, IQ Fresh, and 3 Cheeses.</div>
                                
                                <div id="retail_info" class="info_box" style="top:145px;">Retail includes units like Fast Copy and the Post Office. Jobs within this department range from Cashier to Class Note Specialist.</div>
                                
                                <div id="csil_info" class="info_box" style="top:145px;">The Center for Student Involvement and Leadership includes many different units such as Greek Life, the Gallery and Off Campus Housing. Jobs may range from ticket collectors to front desk assistance.</div>
                                
                                <div id="operations_info" class="info_box" style="top:145px;">Operations includes units like the Information Desk, Computer and IT Support, and Maintenance. Jobs range from student computer technician or maintenance assistant to operations manager.</div>
                                
                                <div id="op2" class="info_box" style="top:145px;">This option allows you to choose only the specific departments that you want to work for. Feel free to check as many of these areas as you wish. Your application will only be accessible to hiring managers from these departments.</div>
                        </div>
                        
                        
                        
                         <div style="float:left; width:237px; _width:267px; padding:0 15px 0 15px; height:270px; position:relative;">
                        	
                            <h1 style="color:red;">Option #3</h1>
                 				
                                <input type="radio" name="redistribute" value="any" onclick="disable('any')" <?php if($_SESSION['redistribute'] == "any"){print 'checked';}?> /><label for="redistribute" ><strong>I want to work anywhere in the Union </strong><span class="more_info" onmouseover="document.getElementById('op1').style.display='block';" onmouseout="document.getElementById('op1').style.display='none';">more info</span></label>
                                
                                
                 <div id="op1" class="info_box" style="top:100px;">This option gives you the best chance of gaining employment with the Unions. Your application will be accessible to all hiring managers in all departments of the Unions.</div>
                        </div>
                   	
               </div>
               <input type="hidden" value="Save and Continue" name="submit2" /><input type="button" value="Save and Continue" style="float:right; margin-top:15px;"  onclick="if(document.page2.redistribute[0].checked == true){if(document.getElementById('specifics').innerHTML==''){alert('Please add a postion before continuing.'); return false;}} if(document.page2.redistribute[1].checked == true){if(areas_notchecked()){alert('Please check an area before continuing.'); return false;}} document.page2.submit();"/>
         	 </form>
            </div>
            
            
            
            
            
     	</div>
</div>


<div id="scrollbox">

<div id="specific"  class="popup_box">
 	<span style="float:right; font-size:16px; font-weight:bold; cursor:pointer;" onclick="link_select(last_link); switchdiv(0)">X</span>
 		<span style="font-size:16px; font-weight:bold; float:left;">Choose a position &nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration:underline; font-size:11px; cursor:pointer;" onclick="link_select(this); showspecific('instructions1');">view instructions</span></span><br /><br /><br /><br />
        <div style="float:left; width:200px;">
        
        
        <div><img src="images/all_jobs.gif" /><br /><input type="button" value="view only open jobs" onclick="link_select(last_link); switchdiv(2)" /></div>
    	<div style=" width:175px; height:350px; background-image:url(images/available_jobs_BOX.gif); background-repeat:no-repeat; padding-top:15px; ">
        	<div style="width:137px; _width:163px; height:325px; background:none; overflow-y:auto; overflow-x:hidden;  padding: 0px 10px 0px 15px;">
            	<div style="width:134px; ">
    		<?php
			   
					$param = array('intReportID'=>945);
					
					$client = new SoapClient("https://www.career.arizona.edu/apps/WS/CS_Webservices.asmx?WSDL", array('trace' => TRUE, 'soap_version'   => SOAP_1_2));
					
					
					$listing = $client->CS_Get_JobListings($param);
					
					$xml = $client->__getLastResponse();
					$xmlparse = simplexml_load_string($listing->CS_Get_JobListingsResult->any);
					
							
					$UnionJobListings_count = 0;
					
					$list = '';
					$av_divs= '';
					
					if($xmlparse->ReportData){
						
						if($xmlparse->ReportData['Job_JobTitle']){
							$job = $xmlparse->ReportData['ReportData'];
							
							$list .= '<span style="cursor:pointer;" onclick="link_select(this); showspecific(\''.addslashes((string)$job->Employer_Division.(string)$job->Job_JobTitle).'\');" >';
							if((string)$job->Employer_Division){
								$list .=(string)$job->Employer_Division.' - ';
							}
							$list .= (string)$job->Job_JobTitle.'</span><br><br>';
							
							$av_divs .= '<div id="'.(string)$job->Employer_Division.(string)$job->Job_JobTitle.'" style="display:none; margin-left:45px; margin-top:45px;">';
							$av_divs .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-weight:bold; font-size:14px; text-decoration:underline;">'.(string)$job->Employer_Division.' - '.(string)$job->Job_JobTitle.':</h2>';
							$av_divs .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-size:12px;">'.(string)$job->Job_JobTitle."</h2><p>".addslashes((string)$job->Job_Description).'</p>';
							
							if((string)$job->Job_Qualifications != ''){
								$av_divs .= '<img src="images/qualificantions.gif"><p>'.addslashes((string)$job->Job_Qualifications).'</p>';
							}
							
							 
							
							$query = 'select portal_id from joblink_convert where name="'.(string)$job->Employer_Division.'"';
							$result = db_query($query);
							$pid = mysql_fetch_assoc($result);
							$pid = $pid['portal_id'];
							
							$av_divs .= '<br><input type="button" value="add" onclick="addspecific(\''.addslashes((string)$job->Job_JobTitle).'\', '.$pid.');"><br><br><br></div>';
							
							//Store all the job data	
							$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['title'] = (string)$job->Job_JobTitle;
							$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['description'] = (string)$job->Job_Description;
							$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['supervisor'] = (string)$job->Job_Contact;
							$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['dept_unit'] = (string)$job->Job_Employer;
							$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['positionType'] = (string)$job->Job_PositionType;
							$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['qualifications'] = (string)$job->Job_Qualifications;
							$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['pid'] = $pid;
							//$UnionJobs[$job['Employer_Division']][$UnionJobListings_count]['qualifications'] = $job['Job_Qualifications'];
							
							//Increment the number of current jobs
							$UnionJobListings_count++;
						
						
						}
						else{
							
							foreach($xmlparse->ReportData as $job) {
								
								$list .= '<span style="cursor:pointer;" onclick="link_select(this); showspecific(\''.addslashes((string)$job->Employer_Division.(string)$job->Job_JobTitle).'\');" >';
								if((string)$job->Employer_Division){
									$list .=(string)$job->Employer_Division.' - ';
								}
								$list .= (string)$job->Job_JobTitle.'</span><br><br>';
								
								$av_divs .= '<div id="'.(string)$job->Employer_Division.(string)$job->Job_JobTitle.'" style="display:none; margin-left:45px; margin-top:45px;">';
								$av_divs .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-weight:bold; font-size:14px; text-decoration:underline;">'.(string)$job->Employer_Division.' - '.(string)$job->Job_JobTitle.':</h2>';
								$av_divs .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-size:12px;">'.(string)$job->Job_JobTitle."</h2><p>".addslashes((string)$job->Job_Description).'</p>';
								
								if((string)$job->Job_Qualifications != ''){
									$av_divs .= '<img src="images/qualificantions.gif"><p>'.addslashes((string)$job->Job_Qualifications).'</p>';
								}
								
               
								$query = 'select portal_id from joblink_convert where name="'.(string)$job->Employer_Division.'"';
								$result = db_query($query, $DBlink);
								//print mysql_error();
								$pid = mysql_fetch_assoc($result);
								$pid = $pid['portal_id'];
								
								$av_divs .= '<br><input type="button" value="add" onclick="addspecific(\''.addslashes((string)$job->Job_JobTitle).'\', '.$pid.');"><br><br><br></div>';
								
								//Store all the job data	
								$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['title'] = (string)$job->Job_JobTitle;
								$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['description'] = (string)$job->Job_Description;
								$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['supervisor'] = (string)$job->Job_Contact;
								$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['dept_unit'] = (string)$job->Job_Employer;
								$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['positionType'] = (string)$job->Job_PositionType;
								$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['qualifications'] = (string)$job->Job_Qualifications;
								$UnionJobs[(string)$job->Employer_Division][$UnionJobListings_count]['pid'] = $pid;
								
								//Increment the number of current jobs
								$UnionJobListings_count++;
							} 
						}
						
						
							
						
						
						
						$query = "select name as location_name, portal_id as pid, active from joblink_convert order by location_name";
						//print $query;
						$result = db_query($query);
						
						//print mysql_error();
						$spf = '';
						
						while($location = mysql_fetch_assoc($result)){
							print '<span style="cursor:pointer;" onclick="link_select(this); showspecific(\''.addslashes($location['location_name']).'\');" >'.$location['location_name'].'</span><br>';
							
							$spf .= '<div id="'.$location['location_name'].'" style="display:none; margin-left:45px; margin-top:45px;">';
							
							$spf .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-weight:bold; font-size:14px; text-decoration:underline;">'.$location['location_name'].':</h2>';
							$i=0;
							if($location['active']){
							
						
							
								if(	$UnionJobs[$location['location_name']] != NULL){
										
													
									foreach($UnionJobs[$location['location_name']] as $pos){
									$i++;
										$spf .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-size:12px;">'.$pos['title']."</h2><p>".htmlentities(nl2br($pos['description'])).'</p><p style="color:#387D31;">'.$pos['qualifications'].'</p><br><input type="button" value="add" onclick="addspecific(\''.addslashes($pos['title']).'\', '.$location['pid'].');"><br><br><br>';						
									}
								}
								
								$spf .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-size:12px;">'.'Any Position'."</h2>";
								if($i>0){
									$spf .= '<p>Any available position at this location</p>'.'<br><input type="button" value="add" onclick="addspecific(\''.addslashes($location['location_name']).'\', '.$location['pid'].');"><br>';
								}
								else{
									$spf .= '<p>Any available position at this location. <span style="font-weight:bold">Please be aware that this location may not be hiring at this time.</span></p><br>'.'<input type="button" value="add" onclick="addspecific(\''.addslashes($location['location_name']).'\', '.$location['pid'].');"><br>';
								}
								
							}
							else{
								$spf .='<p>Sorry. This unit is currently not accepting applications</p>';
							}
							$spf .= '</div>';
							
							
							
						}
					}
					else{
					
							
						
						
						 
						$query = "select name as location_name, portal_id as pid, active from joblink_convert order by location_name";
						//print $query;
						$result = db_query($query);
						
						
						$spf = '';
						
						while($location = mysql_fetch_assoc($result)){
							print '<span style="cursor:pointer;" onclick="link_select(this); showspecific(\''.addslashes($location['location_name']).'\');" >'.$location['location_name'].'</span><br>';
							
							$spf .= '<div id="'.$location['location_name'].'" style="display:none; margin-left:45px; margin-top:45px;">';
							
							$spf .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-weight:bold; font-size:14px; text-decoration:underline;">'.$location['location_name'].':</h2>';
							$i=0;
							if($location['active']){
							
						
							
									$spf .= '<p>Any available position at this location. <span style="font-weight:bold">Please be aware that this location may not be hiring at this time.</span></p><br>'.'<input type="button" value="add" onclick="addspecific(\''.addslashes($location['location_name']).'\', '.$location['pid'].');"><br>';
								
								
							}
							else{
								$spf .='<p>Sorry. This unit is currently not accepting applications</p>';
							}
							$spf .= '</div>';
							
							
							
						}	
						
					}
					
						
					
					
					$spf .= '<div id="instructions1" style="display:block; margin-left:45px; margin-top:45px;">';
							
							$spf .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-weight:bold; font-size:14px; text-decoration:underline;">Instructions</h2>'; 
							$spf.='This page displays a list of Union locations that may currently be hiring. Click the unit\'s name to display a list of currently available positions within that unit. If there are no specific positions displayed, you may still send your application to that unit if any openings become available by clicking "add" underneath the "Any available position at this location" entry.<br><br>

To show only available Union job positions, click "Show Only Available Jobs"</div>';

			?>
            </div>
        </div>
        </div>
        </div>
        <div style="float:left; width:375px; overflow:auto; height:350px;">
        
    		<?php print $spf; ?>
        </div>
  </div>
   
  
  <!--<div id="onlyavailable" style="background:white; float:left;  z-index:100; display:none; width:600;">-->
  <div id="onlyavailable" class="popup_box">
  <span style="float:right; font-size:16px; font-weight:bold; cursor:pointer;" onclick="link_select(last_link); switchdiv(0)">X</span>
  <span style="font-size:16px; font-weight:bold; float:left;">Choose a position  &nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration:underline; font-size:11px; cursor:pointer;" onclick="link_select(this); showspecific('instructions2');">view instructions</span></span><br /><br /><br /><br />
       
 		<div style="float:left; width:200px;">
        <div><img src="images/available.gif" /><br /><input type="button" value="view all jobs" onclick="link_select(last_link); switchdiv(1)" /></div>
    	<div style=" width:175px; height:350px; background-image:url(images/available_jobs_BOX.gif); background-repeat:no-repeat; padding-top:15px; ">
        	<div style="width:137px; _width:163px; height:325px; background:none; overflow-y:auto; overflow-x:hidden;  padding: 0px 10px 0px 15px;">
            	<div style="width:134px; ">
    		<?php
					
							print $list;
							
			?>
            </div>
        </div>
        </div>
        </div>
        <div style="float:left; width:375px; overflow:auto; height:350px;">
        
    		<?php 
			$av_divs .= '<div id="instructions2" style="display:none; margin-left:45px; margin-top:45px;">';
							
							$av_divs .= '<h2 style="margin-left:-30px; font-family:san-serif; color:#C01525; font-weight:bold; font-size:14px; text-decoration:underline;">Instructions</h2>'; 
							$av_divs .='This page displays a list of Union locations that may currently be hiring. Click the unit\'s name to display a list of currently available positions within that unit. If there are no specific positions displayed, you may still send your application to that unit if any openings become available by clicking "add" underneath the "Any available position at this location" entry.<br><br>

To show only available Union job positions, click "Show Only Available Jobs"</div>';
			
			print $av_divs; ?>
        </div>
  </div>
</div>


<?php  page_finish(); ?>