<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/ViewGroupSession.css" />
		<title>View Available Appointments </title>
	</head>

	<body>
		<div id="wrapper">
			<div id="body">
				<div id="center">
					<?php
						include('../CommonMethods.php');
						
						function main()
						{
							//var_dump($_POST);
							//echo("<br>");

							$advisorID = $_POST["advisor"];
							$month = $_POST["month"];
							$day = $_POST["day"];
							$year = $_POST["year"];

							$viewer = new selectSession($advisorID,$month,$day,$year);

							$viewer->viewSession();
						}


						class selectSession
						{
							var $m_advisorID;
							var $m_year;
							var $m_month;
							var $m_day;

							// constructor
							function selectSession($advisorID,$month,$day,$year)
							{
								$this->m_advisorID = $advisorID;
								$this->m_month = $month;
								$this->m_day = $day;
								$this->m_year = $year;
							}


							function isDatePlausible()
							{
								$daysInMonth = array(31,28,31,30,31,30,31,31,30,31,30,31);
								
								// leap year
								if((intval($this->m_year) % 4 ) == 0)
								{
									$daysInMonth[1] = 29;
								}

								if(intval($this->m_day) > $daysInMonth[intval($this->m_month) - 1])
								{
									return false;
								}

								else
								{
									return true;
								}
							}


							function modifyHour($beginHour)
							{
								if($beginHour > 12)
								{
									$beginHour -= 12;
								}

								return $beginHour;
							}


							function printSession($beginHour,$beginMin,$endHour,$endMin)
							{
								$bHour = $beginHour;
								$bMin = $beginMin;
								$eHour = $endHour;
								$eMin = $endMin;

								// modifies beginning hour
								if($bHour >= 12)
								{
									$bTimePeriod = " p.m.";
									$bHour = $this->modifyHour($beginHour);
									if($bHour != 12)
									{
										$bHour = "0".$bHour;
									}
								}
								else
								{
									$bTimePeriod = " a.m.";
									if($bHour < 10)
									{
										$bHour = "0".$bHour;
									}
									
								}


								// modifies edning hour 
								if($eHour >= 12)
								{
									$eTimePeriod = " p.m.";
									$eHour = $this->modifyHour($endHour);
									if($eHour != 12)
									{
										$eHour = "0".$eHour;
									}
								}
								else
								{
									$eTimePeriod = " a.m.";
									if($bHour < 10)
									{
										$eHour = "0".$bHour;
									}
								}

								// modifies beginning min
								if($bMin == 0)
								{
									$bMin = "00";
								}


								// modifies ending min
								if($eMin == 0)
								{
									$eMin = "00";
								}

								return($bHour.':'.$bMin.$bTimePeriod.' - '.$eHour.':'.$eMin.$eTimePeriod);
							}


							function viewSession()
							{
							
								if($this->isDatePlausible())
								{
									$debug = false;
									$COMMON = new Common($debug);

									$sql = "SELECT `apptID`, `beginHour`, `beginMin`, `endHour`, `endMin`, `studentID` FROM";
									$sql .= ("`IndividualAdvisingAppts` WHERE `day`=".$this->m_day);
									$sql .= (" and `month`=".$this->m_month." and `year`=");
									$sql .= ($this->m_year." and `advisorID` = ".$this->m_advisorID);
									$sql .= (" and `studentID` IS NULL ORDER BY  `beginHour` ASC ,  `beginMin` ASC");
											
									 
									$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

									
									echo('<form action="signUpIndAdded.php" method="post" name="form1" >');
									

									echo('<table border="1px solid black" align="center">');
									echo("\n");
									echo('	<thead>');
									echo("\n");
									echo('		<tr>');
									echo("\n");
									echo('			<th> Session Time </th>');
									echo("\n");
									echo('			<th> Select Session </th>');
									echo('		</tr>');
									echo("\n");
									echo('	</thead>');
									echo("\n");
								
									
									
									echo('	<tbody>');
									echo("\n");


									$count = 0;
									while($row = mysql_fetch_assoc($rs)) 
									{
										$sessionID = $row["apptID"];
										$session = $this->printSession($row["beginHour"],$row["beginMin"],$row["endHour"],$row["endMin"]);

										echo('		<tr>');
										echo("\n");
										echo('			<td>'.$session.'</td>');
										echo("\n");

										if($count == 0)
										{
											echo('			<td> <input type="radio" name="selected" value="'.($sessionID.','.$session).'" checked> </td>');	
										}
										else
										{
											echo('			<td> <input type="radio" name="selected" value="'.($sessionID.','.$session).'" > </td>');	
										}
										echo("\n");
										echo('		</tr>');
										echo("\n");
										$count++ ;
									}
									
									echo('	</tbody>');
									echo("\n");
									echo('</table>');
									echo("\n");

									if(mysql_num_rows($rs) != 0)
									{
										echo('<br>');
										echo("\n");
										$info = ($_POST[campusID].','.$_POST[firstName].','.$_POST[lastName].','.$_POST[major]);
										echo('<input type="hidden" name="info" value="'.$info.'" >');
										echo('<input type="submit" value="Submit" onClick="return confirm('."'Do you confirm your appointment for this timeslot?'".');">');
										echo('</form>');
									}

									
								}
								
								else
								{
									echo("Invalid date");
									echo("\n"."<br />");
								}	
							}
						}

						
						main();	
						
					?>
				</div>
			</div>
		</div>
	</body>
</html>