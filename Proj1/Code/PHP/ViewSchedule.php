<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/ViewSchedule.css" />
	<title>View Schedule</title>
</head>
	
<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">
				<div id="button">
					<form id="redirect" action="ViewIndvApptForm.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="View Individual Appointments">
					</form>
				</div>

				<div id="button">
					<form id="redirect" action="ViewGroupSessionForms.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="View Group Sessions">
					</form>
				</div>
				
			</div>
		</div>
	</div>
</body>
</html>