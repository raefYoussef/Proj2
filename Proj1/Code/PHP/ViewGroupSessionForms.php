<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/ViewGroupSessionForm.css" />
	<title>Group Appointments Input</title>
</head>

<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">

				<form action="ViewGroupSession.php" method="post" name="form" >
				
					
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


				<input type="submit" value="Submit">
					
				</form>
			</div>
		</div>
	</div>
</body>
</html>
