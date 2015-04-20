<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/ViewSessionStudents.css" />
	<title>Results</title>
</head>
<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">	

				<?php
				
				include('../CommonMethods.php');
				$debug = false;
				$COMMON = new Common($debug);
				//var_dump($_POST);

				$result = explode(',',$_POST["selected"] );
				$sessionID = $result[0];
				$sessionTime = $result[1];

				$info = explode(',',$_POST["info"] );
				$campusID = $info[0];
				$firstName = $info[1];
				$lastName = $info[2];
				$major = $info[3];


				
				//the following sequence is just so you can't break the system
				$sql = "SELECT * FROM `IndividualAdvisingStudents` WHERE `schoolID`= '$campusID'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				$row = mysql_fetch_assoc($rs);
	
					if($row['schoolID'] == $campusID) //check if student already in database by ID
					{
						echo ("You're already in the database!"
						."<br>". "Click here to view or delete your existing appointment.");

						die();
					}
	

				$sql = "INSERT INTO `IndividualAdvisingStudents`(`studentID`, `schoolID`, `lastName`, `firstName`, `major`, `registrationTime`) 
					VALUES ('','$campusID','$lastName','$firstName','$major','')";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				
				$sql = "SELECT * FROM `IndividualAdvisingStudents` WHERE `schoolID` = '$campusID'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				$row = mysql_fetch_row($rs);
				$studentID = $row[0];
				//echo ("student id is: " . $studentID);

					
				$sql = "UPDATE `IndividualAdvisingAppts` SET `studentID`=" . $studentID 
					." WHERE `apptID` = ".$sessionID;
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

				//echo ("info is ".$campusID.$firstName.$lastName.$major. "and sessionID is ".$sessionID);




				?>

				Successfully signed up for individual advising.
			</div>
		</div>
	</div>
</body>
</html>
