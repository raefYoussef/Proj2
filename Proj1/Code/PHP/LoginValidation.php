<!-- recieves input -->
<?php
	include('../CommonMethods.php');
	$debug = false;
 	$COMMON = new Common($debug); 

 	// normalizes username
 	$username = strtolower($_POST["username"]);
 	$password = $_POST["password"];

	$sql = "SELECT `isAdvisor` FROM `Users` WHERE `username`= '".$username."' and BINARY `password`='".$password."'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
?>


<!-- if no match redirect to login page -->
<?php if(mysql_num_rows($rs) == 0): ?>

<form id="redirect" action="index.php" method="POST">
		<input type="hidden" name="isValid" value="Invalid username or password">
</form>

<script type="text/javascript">
	document.getElementById("redirect").submit();
</script>

<!-- if a match is found redirect to home page-->
<?php else: ?>

<form id="redirect" action="Home.php" method="POST">
	<input type="hidden" name="isAdvisor" value=
		<?php
			$row = mysql_fetch_assoc($rs);
			echo($row["isAdvisor"]);
		?>
	>
</form>

<script type="text/javascript">
	document.getElementById("redirect").submit();
</script>

<?php endif; ?>

		
	