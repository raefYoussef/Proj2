<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/ChangePassword.css" />
	<title>Change Password</title>
</head>
<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">
				<?php
				//var_dump($_POST);
				include('../CommonMethods.php');
				$debug = false;
				$COMMON = new Common($debug); 

				$sql = "UPDATE `raef1`.`Users` SET `password` = '".$_POST["password"]."' WHERE `Users`.`userID` =".$_POST["isAdvisor"].";";

				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

				echo('<div id="message">');
				echo("Password is successfully changed");
				echo('</div>');
				?>
			</div>
		</div>
	</div>
</body>
</html>
