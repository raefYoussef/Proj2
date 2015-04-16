<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/ScheduleIndvAppts.css" />
		<title>Schedule Individual Appointments </title>
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
							//echo("<br />");

							$advisorID = $_POST["advisor"];
							$month = $_POST["month"];
							$day = $_POST["day"];
							$year = $_POST["year"];
	
							$scheduler = new IndividualAppt($advisorID,$month,$day,$year);
			
							$count = 0 ;
							foreach($_POST as $key=>$value) 
							{
								if($count >= 4)
								{
									if($value == 1)
									{
										$scheduler->scheduleAppt($key);
									}
								}
								$count++;
							}
						}


						class IndividualAppt
						{
							var $m_advisorID;
							var $m_year;
							var $m_month;
							var $m_day;

							// constructor
							function IndividualAppt($advisorID,$month,$day,$year)
							{
								$this->m_advisorID = $advisorID;
								$this->m_month = $month;
								$this->m_day = $day;
								$this->m_year = $year;
							}


							function isAvailable($beginTime)
							{
								$debug = false;
								$COMMON = new Common($debug); 

								$sql = "SELECT `apptID` FROM `IndividualAdvisingAppts`";
								$sql .= (" WHERE "." `day`=".$this->m_day);
								$sql .= (" and "." `month`=".$this->m_month);
								$sql .= (" and "." `year`=".$this->m_year);
								$sql .= (" and "." `beginHour`=".$this->getHour($beginTime));
								$sql .=	(" and "." `beginMin`=".$this->getMin($beginTime));
								$sql .= (" and "." `advisorID`=".$this->m_advisorID);

									 
								$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
								$numRows = mysql_num_rows($rs);

								// if appt doesn't already exists
								if($numRows == 0)
								{
									return true;
								}

								// appt already exists
								else
								{
									return false;
								}
							}
							


							function isDateInFuture($beginTime)
							{
								// appt year is current year
								if(intval($this->m_year) == intval(date('Y')))
								{
									// appt month is in the past
									if(intval($this->m_month) < intval(date('n')))
									{
										return false;
									}

									// appt month is in the future 
									elseif (intval($this->m_month) > intval(date('n'))) 
									{
										return true;
									}

									// appt month is current month
									else
									{
										// appt day is in the past
										if(intval($this->m_day) < intval(date('j')))
										{
											return false;
										}

										// appt day is in the future
										elseif (intval($this->m_day) > intval(date('j'))) 
										{
											return true;
										}

										// appt day is current day
										else
										{
											// appt hour is in the past
											if(intval(substr($beginTime,0,2)) < intval(date('G')))
											{
												return false;
											}

											// appt hour is in the future
											if(intval(substr($beginTime,0,2)) > intval(date('G')))
											{
												return true;
											}

											// appt hour is current hour
											else
											{
												// appt time in the past
												if($this->getMin($beginTime) <= intval(date('i')))
												{
													return false;
												}

												// appt time is in the future
												else
												{
													return true;
												}

											}
										}
									}
								}

								// appt year is in the future
								else
								{
									return true;
								}
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


							function getHour($beginTime)
							{
								$hour = intval(substr($beginTime,0,2));
								
								return $hour;	
							}

							
							function getMin($beginTime)
							{
								$min = intval(substr($beginTime,2,5));
								return $min;
							}


							function getNextMin($beginTime)
							{
								
								return (($this->getMin($beginTime) +30) % 60);
							}


							function getNextHour($beginTime)
							{
								if($this->getMin($beginTime) == 0)
								{
									return $this->getHour($beginTime);
								}

								else
								{
									return ($this->getHour($beginTime) + 1);
									
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


							function printAppt($beginTime)
							{
								$beginHour = $this->modifyHour($this->getHour($beginTime));
								$beginMin = $this->getMin($beginTime);


								if($beginMin == 0)
								{
									$beginMin = "00";
								}

								$PM = array(12,1,2,3,4);
								if(in_array($beginHour,$PM))
								{
									$timePeriod = " p.m.";
								}

								else
								{
									$timePeriod = " a.m.";
								}
									
								echo("Appointment starting at: ".$beginHour.":".$beginMin.$timePeriod.": ");
							}


							function scheduleAppt($beginTime)
							{
								if($this->isDatePlausible())
								{
									if($this->isDateInFuture($beginTime))
									{
										if($this->isAvailable($beginTime))
										{
											$debug = false;
											$COMMON = new Common($debug);


											$sql = "INSERT INTO `IndividualAdvisingAppts`(`day`, `month`, `year`,";
											$sql .= "`beginHour`, `beginMin`, `endHour`, `endMin`, `advisorID`)";
											$sql .= ("VALUES (".$this->m_day.",".$this->m_month.",");
											$sql .= ($this->m_year.",".$this->getHour($beginTime).",");
											$sql .= ($this->getMin($beginTime).",".$this->getNextHour($beginTime));
											$sql .=	(",".$this->getNextMin($beginTime).",".$this->m_advisorID.");");
											
									 
											$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

											echo('<div id="message">');
											echo("\n");
											$this->printAppt($beginTime);
											echo("Successful scheduling");
											echo("\n"."<br />");
											echo('</div>');
											echo("\n");
										}

										else
										{
											echo('<div id="message">');
											echo("\n");
											$this->printAppt($beginTime);
											echo("Appointment already exists");
											echo("\n"."<br />");
											echo('</div>');
											echo("\n");
										}
									}

									else
									{
										echo('<div id="message">');
										echo("\n");
										$this->printAppt($beginTime);
										echo("Cannot schedule an appointment on a bygone date");
										echo("\n"."<br />");
										echo('</div>');
										echo("\n");
									}
								}

								else
								{
									echo('<div id="message">');
									echo("\n");
									$this->printAppt($beginTime);
									echo("Unsuccessful scheduling due to invalid date");
									echo("\n"."<br />");
									echo('</div>');
									echo("\n");
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