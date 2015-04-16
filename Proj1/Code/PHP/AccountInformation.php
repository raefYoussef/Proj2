<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/AccountInformation.css" />
	<title>Edit Schedule</title>
</head>
	
<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">

				<?php if($_POST['isAdvisor'] == ""): ?>

					<div id="button">
					<form id="redirect" action="ChangePasswordForms.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="Change Password">
					</form>
					</div>

					<div id="button">
					<form id="redirect" action="ViewAdvisorInfo.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="View Advisor Info">
					</form>
					</div>


				<?php else: ?>

					<div id="button">
					<form id="redirect" action="ChangePasswordForms.php" method="POST">
						<input type="hidden" name="isAdvisor" value= <?php echo($_POST["isAdvisor"]); ?> >
						<input type= "submit" value="Change Password">
					</form>
					</div>


				<?php endif; ?>

			</div>
		</div>
	</div>
</body>
</html>