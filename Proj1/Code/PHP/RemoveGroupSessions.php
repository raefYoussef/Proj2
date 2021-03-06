<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/RemoveGroupSessions.css" />
		<title>Remove Group Sessions Form </title>
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

							$month = $_POST["month"];
							$day = $_POST["day"];
							$year = $_POST["year"];

							$remover = new GroupSessions($month,$day,$year);

							$remover->removeSession();
						}


						class GroupSessions
						{
							var $m_year;
							var $m_month;
							var $m_day;

							// constructor
							function GroupSessions($month,$day,$year)
							{
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


							function removeSession()
							{
							
								if($this->isDatePlausible())
								{
									$debug = false;
									$COMMON = new Common($debug);

									$sql = "SELECT `sessionID`, `beginHour`, `beginMin`, `endHour`, `endMin` 
											`student0`, `student1`, `student2`, `student3`, `student4`, `student5`, 
											`student6`, `student7`, `student8`, `student9` FROM";

									$sql .= ("`GroupAdvisingSessions` WHERE `day`=".$this->m_day);
									$sql .= (" and `month`=".$this->m_month." and `year`=".$this->m_year);
									$sql .= (" ORDER BY  `beginHour` ASC ,  `beginMin` ASC");
											
									 
									$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

									
									echo('<form action="RmGroupSession.php" method="post" name="form1" >');
									

									echo('<table border="1px solid black" align="center">');
									echo("\n");
									echo('	<thead>');
									echo("\n");
									echo('		<tr>');
									echo("\n");
									echo('			<th> Session Time </th>');
									echo("\n");
									echo('			<th> Click To Remove </th>');
									echo('		</tr>');
									echo("\n");
									echo('	</thead>');
									echo("\n");
								
									
									
									echo('	<tbody>');
									echo("\n");


									$eligibleSessions = 0;
									while($row = mysql_fetch_row($rs)) 
									{
										$sessionID = $row[0];
										$session = $this->printSession($row[1],$row[2],$row[3],$row[4]);
										$hasStudents = false;
										$i = 5;
										while($i<= 14 && !$hasStudents)
										{
											if($row[$i] != "")
											{
												$hasStudents = true;
											}
											else
											{
												$eligibleSessions++;
											}
											
											$i++;
										}

										if(!$hasStudents)
										{
											echo('		<tr>');
											echo("\n");
											echo('			<td>'.$session.'</td>');
											echo("\n");

										
											echo('			<td> <input type="checkbox" name="selected'.$eligibleSessions.'" value="'.$sessionID.'"> </td>');	
										
											echo("\n");
											echo('		</tr>');
											echo("\n");
										}
									}
									
									echo('	</tbody>');
									echo("\n");
									echo('</table>');
									echo("\n");

									if($eligibleSessions != 0)
									{
										echo('<br>');
										echo('<input type="submit" value="Submit">');
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