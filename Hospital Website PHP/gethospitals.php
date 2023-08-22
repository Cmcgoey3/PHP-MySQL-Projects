<?php
	include 'connectdb.php';
	$query = "SELECT hoscode, hosname, city, prov FROM hospital";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("query failed");
	}
	while ($row=mysqli_fetch_assoc($result)) {
		echo '<input type="radio" name="hospital" value="' . $row["hoscode"] . '">';
		echo $row["hosname"] . " Hospital, " . $row["city"] . " " . $row["prov"] . "<br>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>