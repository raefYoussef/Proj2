<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/studentMain.css" />
		<title>Student Main</title>
	</head>

	<body>
		<div id="wrapper">
			<div id="body">
		
				<h1> <em>Enter the following:</em> </h1>

					<form action="studentOptions.php" method= "post" name="form1">
						
						<div id="all">First Name: <input type="text" name="firstName"></div>
						
						<br>
						
						<div id="all">Last Name: <input type="text" name="lastName"></div>
						
						<br>

						<div id="all">Campus ID: <input type="text" name="campusID"></div>
						
						<br>
						
						<div id="all">Major: <input type="text" name="major"></div>
						
						<br>

						<div id="button">
							<input type="submit" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>