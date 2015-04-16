<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/GroupSessionForms.css">
		<title>Group Session Input</title>
	</head>

	<body>
		<div id="wrapper">
			<div id="body">
				<div id="center">
					<form action="ScheduleGroupSession.php" method="post" name="form1" >
						
						<!-- Month drop down -->
						Month: 
						<select name = "month">
							<!-- when specifying a value in the option tag
							it represent the actual value of input -->
							<option value="1"> January </option>
							<option value="2"> Febuary </option>
							<option value="3"> March </option>
							<option value="4"> April </option>
							<option value="5"> May </option>
							<option value="6"> June </option>
							<option value="7"> July </option>
							<option value="8"> August </option>
							<option value="9"> September </option>
							<option value="10"> October </option>
							<option value="11"> November </option>
							<option value="12"> December </option>
						</select>

						<br />



						<!-- Day drop down -->
						Day: 
						<select name = "day">
							<?php
								for($i=1; $i <= 31 ; $i += 1)
								{
									echo("<option>".$i."</option>");
									
									// to format the page source 
									if($i != 31)
									{
										echo("\n");
										echo("                                ");
									}
									else
									{
										echo("\n");
									}
								}
									
							?>
						</select>

						<br />



						<!-- Year drop down -->	
						Year: 
						<select name = "year" >
							<?php
								// doesnt allwo registering in a past year.
								$year = intval(date('Y'));

								for($i= $year; $i <= ($year+100) ; $i += 1)
								{
									echo("<option>".$i."</option>");
									
									// to format the page source 
									if($i != ($year+100))
									{
										echo("\n"."                                ");
									}
									else
									{
										echo("\n");
									}
								}
							?>
						</select>
						
						<br />
						<br />


						<!-- Picking avaliable appointment -->
						<table border="1px solid black" align="center">
							<thead>
								<tr>
									<th> Appointment Time </th>
									<th> Not Avaliable </th>
									<th> Avaliable </th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td> 09:00 a.m. - 09:30 a.m.</td>
									<td>
										<input type="radio" name="0900" value="0" checked>
									</td>
									<td>
										<input type="radio" name="0900" value="1">
									</td>
								</tr>

								<tr>
									<td> 09:30 a.m. - 10:00 a.m.</td>
									<td>
										<input type="radio" name="0930" value="0" checked>
									</td>
									<td>
										<input type="radio" name="0930" value="1">
									</td>
								</tr>

								<tr>
									<td> 10:00 a.m. - 10:30 a.m.</td>
									<td>
										<input type="radio" name="1000" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1000" value="1">
									</td>
								</tr>

								<tr>
									<td> 10:30 a.m. - 11:00 a.m.</td>
									<td>
										<input type="radio" name="1030" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1030" value="1">
									</td>
								</tr>

								<tr>
									<td> 11:00 a.m. - 11:30 a.m.</td>
									<td>
										<input type="radio" name="1100" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1100" value="1">
									</td>
								</tr>

								<tr>
									<td> 11:30 a.m. - 12:00 p.m.</td>
									<td>
										<input type="radio" name="1130" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1130" value="1">
									</td>
								</tr>

								<tr>
									<td> 12:00 p.m. - 12:30 p.m.</td>
									<td>
										<input type="radio" name="1200" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1200" value="1">
									</td>
								</tr>

								<tr>
									<td> 12:30 p.m. - 01:00 p.m.</td>
									<td>
										<input type="radio" name="1230" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1230" value="1">
									</td>
								</tr>

								<tr>
									<td> 01:00 p.m. - 01:30 p.m.</td>
									<td>
										<input type="radio" name="1300" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1300" value="1">
									</td>
								</tr>

								<tr>
									<td> 01:30 p.m. - 02:00 p.m.</td>
									<td>
										<input type="radio" name="1330" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1330" value="1">
									</td>
								</tr>

								<tr>
									<td> 02:00 p.m. - 02:30 p.m.</td>
									<td>
										<input type="radio" name="1400" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1400" value="1">
									</td>
								</tr>

								<tr>
									<td> 02:30 p.m. - 03:00 p.m.</td>
									<td>
										<input type="radio" name="1430" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1430" value="1">
									</td>
								</tr>

								<tr>
									<td> 03:00 p.m. - 03:30 p.m.</td>
									<td>
										<input type="radio" name="1500" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1500" value="1">
									</td>
								</tr>


								<tr>
									<td> 03:30 p.m. - 04:00 p.m.</td>
									<td>
										<input type="radio" name="1530" value="0" checked>
									</td>
									<td>
										<input type="radio" name="1530" value="1">
									</td>
								</tr>

							</tbody>
						</table>

						<br />
						
						<input type="submit" value="Submit">
					
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

