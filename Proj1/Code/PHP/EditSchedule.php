<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/EditSchedule.css" />
	<title>Edit Schedule</title>
</head>
	
<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">

				<div id="button">
					<form id="redirect" action="IndividualApptForms.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="Schedule Individual Appointments">
					</form>
				</div>

				<div id="button">
					<form id="redirect" action="RmIndividualApptForms.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="Cancel Individual Appointments">
					</form>
				</div>

				<div id="button">
					<form id="redirect" action="GroupSessionForms.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="Schedule Group Sessions">
					</form>
				</div>

				<div id="button">
					<form id="redirect" action="RmGroupSessionForms.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="Cancel Group Sessions">
				</form>

			</div>
		</div>
	</div>
</body>
</html>