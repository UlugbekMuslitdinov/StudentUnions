<?

        if($_SESSION['search'] == "tShirts") {
	
				$queryS = "select * from attendee where tShirtSize=\"Small\";";
				$resultS = mysql_query($queryS, $DBlink);
				$numS = mysql_num_rows($resultS);
				
				$queryM = "select * from attendee where tShirtSize=\"Medium\";";
				$resultM = mysql_query($queryM, $DBlink);
				$numM = mysql_num_rows($resultM);
				
				$queryL = "select * from attendee where tShirtSize=\"Large\";";
				$resultL = mysql_query($queryL, $DBlink);
				$numL = mysql_num_rows($resultL);
				
				$queryXL = "select * from attendee where tShirtSize=\"XL\";";
				$resultXL = mysql_query($queryXL, $DBlink);
				$numXL = mysql_num_rows($resultXL);
				
				$queryXXL = "select * from attendee where tShirtSize=\"XXL\";";
				$resultXXL = mysql_query($queryXXL, $DBlink);
				$numXXL = mysql_num_rows($resultXXL);
				
				$queryXXXL = "select * from attendee where tShirtSize=\"XXXL\";";
				$resultXXXL = mysql_query($queryXXXL, $DBlink);
				$numXXXL = mysql_num_rows($resultXXXL);
				
				$numTotal = $numS + $numM + $numL + $numXL + $numXXL + $numXXXL;
				
					
					
				print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
				print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Small";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Medium";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Large";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "XLarge";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "XXLarge";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "XXXLarge";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Total";
							print "</td>";
							
						print "</tr>";
						print "<tr>";
							print "<td bgcolor=\"#ffffff\" >";
							print $numS;
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\" >";
							print $numM;
							print "</td>";

							print "<td bgcolor=\"#ffffff\">";
							print $numL;
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $numXL;
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $numXXL;
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $numXXXL;
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $numTotal;
							print "</td>";
							
						print "</tr>";
				print "</table>";
				
				print "<br>";
				
				print "<a href=\"backweb.php\">Start New Search</a>";
					
		} elseif($_POST['search'] == "meals") {
	
				$queryMeat = "SELECT * from attendee where mealType=\"Non-Vegetarian\"";
				$resultMeat = mysql_query($queryMeat, $DBlink);
				$numMeat = mysql_num_rows($resultMeat);
					
				$queryVegi = "SELECT * from attendee where mealType=\"Vegetarian\"";
				$resultVegi = mysql_query($queryVegi, $DBlink);
				$numVegi = mysql_num_rows($resultVegi);
				
				$queryVegan = "SELECT * from attendee where mealType=\"Vegan\"";
				$resultVegan = mysql_query($queryVegan, $DBlink);
				$numVegan = mysql_num_rows($resultVegan);
				
				$numTotal = $numMeat + $numVegi + $numVegan;
				
				print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
				print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Regular";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Vegetarian";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Vegan";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Total";
							print "</td>";
				
				print "</tr>";
				print "<tr>";
							print "<td bgcolor=\"#ffffff\" >";
							print $numMeat;
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\" >";
							print $numVegi;
							print "</td>";

							print "<td bgcolor=\"#ffffff\">";
							print $numVegan;
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $numTotal;
							print "</td>";
				print "</tr>";
				print "</table>";
				
			print "<br>";
				
				print "<a href=\"backweb.php\">Start New Search</a>";
				
	
		} elseif($_POST['search'] == "housing") {
	
				$queryGuest = "SELECT * from Guest;";
				$resultGuest = mysql_query($queryGuest, $DBlink);
				$numGuest = mysql_num_rows($resultGuest);	
			
				print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
				print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "regID";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Last Name";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Guest Pref";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Guest Number";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Guest Gender";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print " Guest Transport";
							print "</td>";

							
						print "</tr>";
						for ($i = 1; $i <= $numGuest; $i++) {
						$row = mysql_fetch_array($resultGuest, MYSQL_ASSOC);
						print "<tr>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['regID'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\" >";
							print $row['lastName'];
							print "</td>";

							print "<td bgcolor=\"#ffffff\">";
							print $row['guestPref'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $row['guestNumber'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $row['guestGender'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $row['guestTrans'];
							print "</td>";
							
						print "</tr>";
						}
				print "</table>";
				

				print "<br /><br />";
				
				$queryHost = "SELECT * from Host;";
				$resultHost = mysql_query($queryHost, $DBlink);
				$numHost = mysql_num_rows($resultHost);					
				
				print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
				print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "regID";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Last Name";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Host Gender";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Host Capcity";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Host Pref";
							print "</td>";
							
						print "</tr>";
						for ($i = 1; $i <= $numHost; $i++) {
						$row = mysql_fetch_array($resultHost, MYSQL_ASSOC);
						print "<tr>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['regID'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\" >";
							print $row['lastName'];
							print "</td>";

							print "<td bgcolor=\"#ffffff\">";
							print $row['hostGender'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $row['hostCapacity'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $row['hostPref'];
							print "</td>";
							
						print "</tr>";
						}
				print "</table>";
				
				print "<br>";
				
				print "<a href=\"backweb.php\">Start New Search</a>";
				
		}
		

?>