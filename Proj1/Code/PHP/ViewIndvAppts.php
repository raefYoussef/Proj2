<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/ViewIndvAppts.css" />
		<title>View Individual Appointments </title>
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

							$viewer = new DayAppointments($advisorID,$month,$day,$year);

							$viewer->viewAppts();
						}


						class DayAppointments
						{
							var $m_advisorID;
							var $m_year;
							var $m_month;
							var $m_day;

							// constructor
							function DayAppointments($advisorID,$month,$day,$year)
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


							function printAppt($beginHour,$beginMin,$endHour,$endMin)
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
									if($eHour < 10)
									{
										$eHour = "0".$eHour;
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

								return($bHour.":".$bMin.$bTimePeriod." - ".$eHour.":".$eMin.$eTimePeriod);
							}


							function viewAppts()
							{
							
								if($this->isDatePlausible())
								{
									$debug = false;
									$COMMON = new Common($debug);

									$sql = "SELECT `beginHour`, `beginMin`, `endHour`, `endMin`, `studentID` FROM";
									$sql .= ("`IndividualAdvisingAppts` WHERE `day`=".$this->m_day);
									$sql .= (" and `month`=".$this->m_month." and `year`=");
									$sql .= ($this->m_year." and `advisorID` = ".$this->m_advisorID);
									$sql .= (" ORDER BY  `beginHour` ASC ,  `beginMin` ASC");
											
									 
									$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

									
									echo('<table border="1px solid black" align="center">');
									echo("\n");
									echo('	<thead>');
									echo("\n");
									echo('		<tr>');
									echo("\n");
									echo('			<th> Appointment Time </th>');
									echo("\n");
									echo('			<th> Student Name </th>');
									echo("\n");
									echo('			<th> Major </th>');
									echo("\n");
									echo('			<th> UMBC ID </th>');
									echo("\n");
									echo('		</tr>');
									echo("\n");
									echo('	</thead>');
									echo("\n");
								
									echo('	<tbody>');
									echo("\n");

									$debug1 = false;
									$COMMON1 = new Common($debug1);
									

									while($row = mysql_fetch_assoc($rs)) 
									{
										$studentID = $row["studentID"];

										if($studentID != "")
										{
											$sql1 = "SELECT `schoolID`, `lastName`, `firstName`, `major` FROM `IndividualAdvisingStudents` WHERE `studentID`=".$studentID;
											$rs1 = $COMMON1->executeQuery($sql1, $_SERVER["SCRIPT_NAME"]);
											$row1 = mysql_fetch_assoc($rs1);

											$schoolID = $row1["schoolID"];
											$name = $row1["firstName"]." ".$row1["lastName"];
											$major = $row1["major"];
										}
										else
										{
											$schoolID = "";
											$name = "";
											$major = "";
										}


										echo('		<tr>');
										echo("\n");
										echo('			<td>'.$this->printAppt($row["beginHour"],$row["beginMin"],$row["endHour"],$row["endMin"]).'</td>');
										echo("\n");
										echo('			<td>'.$name.'</td>');
										echo("\n");
										echo('			<td>'.$major.'</td>');
										echo("\n");
										echo('			<td>'.$schoolID.'</td>');
										echo("\n");
										echo('		</tr>');
										echo("\n");
									}

									echo('	</tbody>');
									echo("\n");

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