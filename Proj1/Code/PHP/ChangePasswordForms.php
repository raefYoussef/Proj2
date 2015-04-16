<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="CSS/ChangePasswordForm.css" />
		<title>Change Password</title>
	</head>

	
	<body>
		<div id="wrapper">
			<div id="body">
				<div id="center">
					<form action="ChangePassword.php" method="post" name="form1" >

						<?php 
							$isAdvisor = $_POST["isAdvisor"];

							// if admin he can schedule any advisor
							if($isAdvisor == "")
							{ 
								// Look up and displays advisor names 			
								include('../CommonMethods.php');
								$debug = false;
								$COMMON = new Common($debug); 

								$sql = "SELECT `id`, `lastName`, `firstName` FROM `Advisors` WHERE 1";
								$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

						 		//creates a drop down
						 		echo("Advisor: "."\n");
								echo('<select name = "isAdvisor">'.'\n');

								// loops through the advisors
								while($row = mysql_fetch_row($rs))
								{
									echo('    '.'<option value ='.$row[0].'>'.
									$row[2]." ".$row[1].'</option>'.'\n');
								}				

								echo('    '.'<option value = 4>Admin</option>'.'\n');
								echo('</select>');

								echo("<br />");

							}

							// if an advisor, he/she cannot schedule other advisors' appts
							else
							{ 
						?>

								<input type="hidden" name="isAdvisor" value= <?php echo($isAdvisor); ?> >			

						<?php

							}

						?>

						<br />



						Enter Password: <input type="password" name="password" maxlength="10" required>
						<br />
						<br />


						
						<input type="submit" value="Submit">

					</form>
				</div>
			</div>
		</div>
	</body>
</html>