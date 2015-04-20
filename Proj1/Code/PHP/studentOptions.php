<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/Home.css" />
	<title>Home</title>
</head>
	
<?php
	include('../CommonMethods.php');
	$debug = false;
 	$COMMON = new Common($debug); 

	$sql = "SELECT `schoolID` FROM `IndividualAdvisingStudents` WHERE `schoolID`= '$_POST[campusID]'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_assoc($rs);
	
	if($row['schoolID'] == $_POST[campusID]) //check if student already in database by ID
	{
		echo ("You're already in the database!"
		."<br>". "Click here to view or delete your existing appointment.");

		die();
	}

?>

<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">

				<div id="greeting"> <h1> <strong> <?php echo("Welcome ".$_POST[firstName]." ".$_POST[lastName]); ?> </strong></h1> </div>

				<form id="redirect" action="signUpInd.php" method="POST">
					<input type="hidden" name="campusID" value=<?php echo ($_POST[campusID]); ?>>
					<input type="hidden" name="firstName" value=<?php echo ($_POST[firstName]); ?>>
					<input type="hidden" name="lastName" value=<?php echo ($_POST[lastName]); ?>>
					<input type="hidden" name="major" value=<?php echo ($_POST[major]); ?>>
					<input type= "submit" value="Sign up for an Individual Appointment">
				</form>

				<form id="redirect" action="signUpGroup.php" method="POST">
					<input type= "submit" value="Sign up for a Group Appointment">
				</form>

			</div>
		</div>
	</div>
</body>
</html>
	