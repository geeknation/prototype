<?php
error_reporting(0);
/*
 * ACROSS THIS APPLICATION
 * COPYRIGHT 2012
 */
class Search {
	//this function searches for the lost document and returns the results to the user
	function searchLost($number, $agent) {

						<tr>
						<tr><td>'.$foundnames.'<hr/></td></tr>
						<tr><td><b>document type</b></td></tr>
						<tr><td>'.$itemtype.'<hr/></td></tr>
						<tr><td>
			}
		$querysucesstable = "SELECT * FROM success_search_table";
		$resultsucess = mysql_query($querysucesstable);
		$totalsucess = mysql_num_rows($resultsucess);
		return $totalsucess;
	}
		$queryfailtable = "SELECT * FROM fail_search_table";
		$resultfail = mysql_query($queryfailtable);
		$totalfail = mysql_num_rows($resultfail);
		return $totalfail;
	}
		$totalsucess = $this -> sucess_searches();
		$totalfail = $this -> fail_searches();
		$totalsearches = (int)$totalsucess + (int)$totalfail;
		return $totalsearches;
	}
		$query = "SELECT * FROM success_search_table WHERE item_type='National Id'";
		$result = mysql_query($query);
		$sucessnationalsearches = mysql_num_rows($result);
		return $sucessnationalsearches;
	}
		$query = "SELECT * FROM success_search_table WHERE item_type='School Id'";
		$result = mysql_query($query);
		$sucessschoolsearches = mysql_num_rows($result);
		return $sucessschoolsearches;
	}
		$query = "SELECT * FROM success_search_table WHERE item_type='Atm Card'";
		$result = mysql_query($query);
		$sucessatmsearches = mysql_num_rows($result);
		return $sucessatmsearches;
	}
		$query = "SELECT * FROM success_search_table WHERE item_type='Passport'";
		$result = mysql_query($query);
		$sucessatmsesarches = mysql_num_rows($result);
		return $sucessatmsesarches;
	}
		$query = "SELECT * FROM fail_search_table WHERE item_type='National Id'";
		$result = mysql_query($query);
		$failnationalsearches = mysql_num_rows($result);
		return $failnationalsearches;
	}
		$query = "SELECT * FROM fail_search_table WHERE item_type='School Id'";
		$result = mysql_query($query);
		$failschoolsearches = mysql_num_rows($result);
		return $failschoolsearches;
	}
		$query = "SELECT * FROM fail_search_table WHERE item_type='Atm Card'";
		$result = mysql_query($query);
		$failatmsearches = mysql_num_rows($result);
		return $failatmsearches;
	}
		$query = "SELECT * FROM fail_search_table WHERE item_type='Passport'";
		$result = mysql_query($query);
		$failatmsesarches = mysql_num_rows($result);
		return $failatmsesarches;
	}
		require_once 'Timekeeper.php';

		$timestamp = time();
		//Before the save seach to see if the id has been searched
		$ifexists = "SELECT item_id FROM success_search_table WHERE item_id= '" . $itemid . "';";
		$result = mysql_query($ifexists) or die(mysql_error());
		if ($count==0) {
			//Save a new
			$query = "INSERT INTO success_search_table(item_id,location_found,item_type,last_web_search,agent) VALUES('" . $itemid . "','" . $locationfound . "','" . $itemtype . "','" . $timestamp . "','".$agent."') ;";
			$proc=mysql_query($query) or die(mysql_error());
		}//End if
		else {
			/*increment times*/
			//First query to get the times searched
			$checktimes = "SELECT web_times FROM success_search_table WHERE item_id= '" . $itemid . "';";
			$checkTimesResult = mysql_query($checktimes);
			while ($row = mysql_fetch_assoc($checkTimesResult)) {
				$times = $row['web_times'];
			}//End while
			//update the times (increment once)
			$times += 1;
			//Update the database (times field)
			$updateQuery = "UPDATE success_search_table SET web_times='" . $times . "',last_web_search='" . $timestamp . "' WHERE item_id='" . $itemid . "';";
			mysql_query($updateQuery) or die(mysql_error());
		}//End else
	}//End function saveSuccessfulSearch
		//Before the save seach to see if the id has been searched
		require_once 'Timekeeper.php';
		$timestamp = time();
		$ifexists = "SELECT item_id FROM fail_search_table WHERE item_id= '" . $itemid . "';";
		$result = mysql_query($ifexists) or die(mysql_error());
		if ($count ==0) {
			//Save a new
			$query = "INSERT INTO fail_search_table (item_id,item_type,last_web_search,agent) VALUES ('" . $itemid . "','" . $itemtype . "','" . $timestamp . "','".$agent."') ;";
			mysql_query($query) or die(mysql_error());
		}//End if
		else {
			/*increment times*/
			//First query to get the times searched
			$checktimes = "SELECT web_times FROM fail_search_table WHERE item_id= '" . $itemid . "';";
			$checkTimesResult = mysql_query($checktimes);
			while ($row = mysql_fetch_assoc($checkTimesResult)) {
				$times = $row['web_times'];
			}//End while
			//update the times (increment once)
			$times += 1;
			//Update the database (times field)
			$updateQuery = "UPDATE fail_search_table SET web_times='" . $times . "',last_web_search='" . $timestamp . "' WHERE item_id='" . $itemid . "';";
			mysql_query($updateQuery) or die(mysql_error());
		}//End else
	}//End function saveUnsuccessfulSearch
		//seperate the characters of the string
		$chunked = chunk_split($string, 1, ".");
		//put the seperateed characters into an array
		$exploded = explode(".", $chunked);
		//get the length of the array elements
		$length = count($exploded);
		//create a complete star array
		for ($ic = 0; $ic < $length; $ic++) {
			$stararray[$ic] = "*";
		}
		//assigning the values into a new string
		//CONVERTING IT TO A STRING array AS A STRING
		for ($i = 0; $i <= $length - 1; $i++) {
			//GETTING AN INDIVIDUAL ARRAY ELEMENT AND ASSIGNING IT TO A VARIABLE
			$value = $exploded[$i];
			//CONVERTING IT TO A STRING
			$value = (string)$value;
			//PUTTING THE CONVERTED ELEMENT INTO ARRAY OF TYPE STRING
			$stringarray[$i] = $value;
		}
		//GETTING THE LENGTH OF THE NEW ARRAY ELEMENT
		$newarraylength = count($stringarray);
		//inserting the string array into the complete star array
		$encrypteddata;
		$e = 0;
		while ($e < $newarraylength) {
			$stararray[$e] = $stringarray[$e];
			$encrypteddata = join(" ", $stararray);
			$e = $e + 2;
		}
		return $encrypteddata;
	}
		$length = strlen($itempart);
		$length2 = strlen($realValue);
		$mainlength = $length - $length2;
		$notbolded = substr($realValue, 0, $mainlength);
		$bolded = substr($realValue, $mainlength);
		return $notbolded . "<strong>" . $bolded . "</strong>";
	}