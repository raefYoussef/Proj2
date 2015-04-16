<!-- recieves input and prints greeting -->
<?php
	include('../CommonMethods.php');
	$isAdvisor = $_POST["isAdvisor"];
	

	if($isAdvisor != "")
	{

		$debug = false;
		$COMMON = new Common($debug); 

		$sql = "SELECT `lastName`, `firstName`FROM `Advisors` WHERE `id`= ".$isAdvisor;
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_array($rs);

		$name = $row["firstName"]." ".$row["lastName"];
	}

	else
	{
		$name = "Admin"; 
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/Home.css" />
	<title>Home</title>
</head>
	


<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">

				<div id="greeting"> <h1> <strong> <?php echo("Welcome ".$name); ?> </strong></h1> </div>

				<form id="redirect" action="EditSchedule.php" method="POST">
					<input type="hidden" name="isAdvisor" value= <?php echo($isAdvisor); ?> >
					<input type= "submit" value="Schedule/Edit Appointments">
				</form>

				<form id="redirect" action="ViewSchedule.php" method="POST">
					<input type="hidden" name="isAdvisor" value= <?php echo($isAdvisor); ?> >
					<input type= "submit" value="View Schedule">
				</form>

				<form id="redirect" action="AccountInformation.php" method="POST">
					<input type="hidden" name="isAdvisor" value= <?php echo($isAdvisor); ?> >
					<input type= "submit" value="Account Information">
				</form>

			</div>
		</div>
	</div>
</body>
</html>
	

