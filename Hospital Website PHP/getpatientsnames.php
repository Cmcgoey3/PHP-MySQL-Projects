<?php
	include 'connectdb.php';
	$query = "SELECT firstname, lastname, ohipnum FROM patient";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("query failed");
	}
	while ($row=mysqli_fetch_assoc($result)) {
		echo "<option value='";
		echo $row["ohipnum"] . "'>" . $row["firstname"] . " " . $row["lastname"] . " : " . $row["ohipnum"];
		echo "</option>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>