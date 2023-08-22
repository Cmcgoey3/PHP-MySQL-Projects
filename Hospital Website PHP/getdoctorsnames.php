<?php
	include 'connectdb.php';
	$query = "SELECT firstname, lastname, licensenum FROM doctor";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("query failed");
	}
	while ($row=mysqli_fetch_assoc($result)) {
		echo "<option value='";
		echo $row["licensenum"] . "'>" . $row["firstname"] . " " . $row["lastname"] . " " . $row["licensenum"];
		echo "</option>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>