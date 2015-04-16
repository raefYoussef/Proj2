<!DOCTYPE html>
<html>
<head>
	<link type="test/stylesheet" rel="stylesheet" href="CSS/ViewAdvisorInfo.css" >
	<title>View Advisor Info</title>
</head>
<body>

<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">
				<?php
					include('../CommonMethods.php');
					
					$debug = false;
					$COMMON = new Common($debug); 

					$sql = "SELECT * FROM `Advisors` WHERE 1";
					$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

					$enteredLoop = false;
					while($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
						$enteredLoop = true;

						echo($row["firstName"]." ".$row["lastName"]);
						echo("\n");
						echo("<br />");
						echo("\n");

						echo($row["room"]);
						echo("\n");
						if(!is_null($row["room"]))
						{
							echo("<br />");
							echo("\n");
						}  

						echo($row["phone"]);
						echo("\n");
						if(!is_null($row["phone"]))
						{
							echo("<br />");
							echo("\n");
						}

						echo($row["email"]);
						echo("\n");
						if(!is_null($row["email"]))
						{
							echo("<br />");
							echo("\n");
						}

						echo("<br />");
						echo("\n");
						
					}

				?>
			</div>
		</div>
	</div>
</body>