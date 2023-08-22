<?php
include 'connectdb.php';
$licensenumber = $_POST["lnum"];
$existsquery = "SELECT * FROM doctor WHERE licensenum='" . $licensenumber . "'";
$result1 = mysqli_query($connection, $existsquery);
if (mysqli_num_rows($result1)==0) {
	echo "<h1>DOCTOR DOES NOT EXIST</h1>";
} else {
	$treatingquery = "SELECT * FROM looksafter WHERE licensenum='" . $licensenumber . "'";
	$result2 = mysqli_query($connection, $treatingquery);
	if (mysqli_num_rows($result2)!=0) {
		mysqli_free_result($result2);
		echo "<h1>DOCTOR IS TREATING PATIENTS AND CANNOT BE DELETED</h1>";
	} else {
		mysqli_free_result($result2);
		$hospitalheadquery = "SELECT * FROM hospital WHERE headdoc='" . $licensenumber . "'";
		$result3 = mysqli_query($connection, $hospitalheadquery);
		if (mysqli_num_rows($result3)!=0) {
			mysqli_free_result($result3);
			echo "<h1>DOCTOR IS THE HEAD DOCTOR AT A HOSPITAL AND CANNOT BE DELETED</h1>";
		} else {
			mysqli_free_result($result3);
			echo "<h1>DOCTOR EXISTS AND CAN BE DELETED. ARE YOU SURE YOU WANT TO DELETE?</h1>";
			echo "<form action='confirmdelete.php' method='post'>";
			echo "<button type='submit' id='yes' name='yesorno' value='" . $licensenumber . "'>DELETE</button>";
			echo "</form>";
		}
	}
}
mysqli_free_result($result1);
mysqli_close($connection);
?>