<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/Home.css" />
	<title>Advising Menu</title>
</head>
	


<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">

				<div id="greeting"> <h1> <strong> Choose: Student or Advisor </strong></h1> </div>

				<form id="redirect" action="studentMain.php" method="POST">
					<input type= "submit" value="Student">
				</form>

				<form id="redirect" action="index.php" method="POST">
					<input type= "submit" value="Advisor">
				</form>


			</div>
		</div>
	</div>
</body>
</html>
