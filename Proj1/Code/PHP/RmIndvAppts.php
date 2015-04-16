<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/RmIndvAppts.css" />
	<title>Remove Appointment Results</title>
</head>
<body>
		<div id="wrapper">
			<div id="body">
				<div id="center">
					<?php
					include('../CommonMethods.php');

					//var_dump($_POST);
					$debug = false;
					$COMMON = new Common($debug);

					foreach ($_POST as $key => $value)
					{
						$sql = "DELETE FROM `IndividualAdvisingAppts` WHERE `apptID` =".$value;
						$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					}

					if(sizeof($_POST) != 0)
					{
						if(sizeof($_POST) == 1)
							{
								echo('<div id="message">');
								echo("Appointment is successfully removed");
								echo('</div>');
							}

						else
						{
							echo('<div id="message">');
							echo("Appointments are successfully removed");
							echo('</div>');
						}
					}
					
				?>	
			</div>
		</div>
	</div>	
</body>
</html>
