<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="CSS/ViewSessionStudents.css" />
	<title>View Session Student</title>
</head>
<body>
	<div id="wrapper">
		<div id="body">
			<div id="center">	

				<?php
				
				include('../CommonMethods.php');
				//var_dump($_POST);
				$result = explode(',',$_POST["selected"] );
				$sessionID = $result[0];
				$sessionTime = $result[1];


				$debug = false;
				$COMMON = new Common($debug);
				$sql = "SELECT `day`, `month`, `year`,`student0`, `student1`, `student2`, `student3`, `student4`, `student5`, `student6`, `student7`,";
				$sql .= " `student8`, `student9` FROM `GroupAdvisingSessions` WHERE `sessionID` =".$sessionID; 
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				$row = mysql_fetch_array($rs);

				$sessionDate = $row[1]."/".$row[0]."/".$row[2];


				echo('<table border="1px solid black" align="center">');
				echo("\n");
				echo('	<thead>');
				echo("\n");
				echo('		<tr>');
				echo("\n");
				echo('			<th colspan= "3">'.$sessionDate.'</th>');
				echo("\n");
				echo('		<tr>');
				echo("\n");
				echo('			<th colspan= "3">'.$sessionTime.'</th>');
				echo("\n");
				echo('		<tr>');
				echo("\n");
				echo('			<th> Student Name </th>');
				echo("\n");
				echo('			<th> Major </th>');
				echo("\n");
				echo('			<th> UMBC ID </th>');
				echo("\n");
				echo('		</tr>');
				echo("\n");
				echo('	</thead>');
				echo("\n");
							
				echo('	<tbody>');
				echo("\n");


				$debug1 = false;
				$COMMON1 = new Common($debug1);
									
				$row = array_slice($row,3);
				for($i = 0; $i < 10; $i++)
				{
					$studentID = $row[$i];

					if($studentID != "")
					{
						$sql1 = "SELECT `schoolID`, `lastName`, `firstName`, `major` FROM `GroupAdvisingStudents` WHERE `studentID`=".$studentID;
						$rs1 = $COMMON1->executeQuery($sql1, $_SERVER["SCRIPT_NAME"]);
						$row1 = mysql_fetch_assoc($rs1);

						$schoolID = $row1["schoolID"];
						$name = $row1["firstName"]." ".$row1["lastName"];
						$major = $row1["major"];
					}
					else
					{
						$schoolID = "";
						$name = "";
						$major = "";
					}


					echo('		<tr>');
					echo("\n");
					echo('			<td>'.$name.'</td>');
					echo("\n");
					echo('			<td>'.$major.'</td>');
					echo("\n");
					echo('			<td>'.$schoolID.'</td>');
					echo("\n");
					echo('		</tr>');
					echo("\n");
				}

				echo('	</tbody>');
				echo("\n");


				?>
			</div>
		</div>
	</div>
</body>
</html>
