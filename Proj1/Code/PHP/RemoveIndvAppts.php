<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/RemoveIndvAppts.css" />
		<title>Remove Individual Appointments </title>
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

							$remover = new DayAppointments($advisorID,$month,$day,$year);

							$remover->removeAppts();
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


							function removeAppts()
							{
							
								if($this->isDatePlausible())
								{
									$debug = false;
									$COMMON = new Common($debug);

									$sql = "SELECT `apptID`,`beginHour`, `beginMin`, `endHour`, `endMin`, `studentID` FROM";
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
									echo('			<th> Click To Remove </th>');
									echo('		</tr>');
									echo("\n");
									echo('	</thead>');
									echo("\n");
								
									echo('	<tbody>');
									echo("\n");

									$debug1 = false;
									$COMMON1 = new Common($debug1);
									
									echo('<form action="RmIndvAppts.php" method="post" name="form" />');

									$elgibileStudents = 0;
									while($row = mysql_fetch_assoc($rs)) 
									{
										$studentID = $row["studentID"];

										if($studentID == "")
										{
											$elgibileStudents++;

											echo('		<tr>');
											echo("\n");
											echo('			<td>'.$this->printAppt($row["beginHour"],$row["beginMin"],$row["endHour"],$row["endMin"]).'</td>');
											echo("\n");
											echo('			<td> <input type="checkbox" name="'. $elgibileStudents.'"" value="'.$row["apptID"].'"> </td>');
											echo("\n");
											echo('		</tr>');
											echo("\n");
										}
									}

									echo('	</tbody>');
									echo("\n");
									echo('</table>');
									echo("\n");

									if($elgibileStudents != 0)
									{
										echo('<br>');
										echo('<input type="submit" value="submit">');
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