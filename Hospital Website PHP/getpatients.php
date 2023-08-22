<?php
	include 'connectdb.php';
	$licensenum = $_POST["doctor"];
	$query = "SELECT firstname, lastname, ohipnum FROM patient WHERE patient.ohipnum IN (SELECT ohipnum FROM looksafter WHERE licensenum='" . $licensenum . "')";
	$result = mysqli_query($connection,$query);
	if (!$result) {
		die("query failed");
	}
	if (mysqli_num_rows($result)==0) {
		echo "<h1>THIS DOCTOR TREATS NO PATIENTS</h1>";
	} else {
		echo "<h1>THE DOCTOR YOU SELECTED TREATS THE FOLLOWING PATIENTS</h1>";
		echo "<ul>";
		while ($row=mysqli_fetch_assoc($result)) {
			echo "<li>";
			echo $row["firstname"] . $row["lastname"] . ". OHIP Number: " . $row["ohipnum"];
		}
		echo "</ul>";
	}
	mysqli_close($connection);
	mysqli_free_result($result);
?>