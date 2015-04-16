<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/Login.css" />
		<title>Login</title>
	</head>

	<body>
		<div id="wrapper">
			<div id="body">
		
				<h1> <em>CSEE Undergraduate Advising</em> </h1>

				<div id="login">
					<?php
						if(!is_null($_POST['isValid']))
						{
							echo('<div id="invalid">');
							echo("\n");
							echo('				'.$_POST["isValid"]);
							echo("\n");
							echo("				<br>");
							echo("\n");
							echo('			</div>');
						}
					?>


					<form action="LoginValidation.php" method= "post" name="form1">
						
						<div id="user">Username: <input type="text" name="username"></div>
						
						<br>
						
						<div id="pass"> Password: <input type="password" name="password"></div>
						
						<br>

						<div id="button">
							<input type="submit" value="Sign In">
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>