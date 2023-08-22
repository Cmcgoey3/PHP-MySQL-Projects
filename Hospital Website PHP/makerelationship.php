<?php
	include 'connectdb.php';
	$licensenum = $_POST["doctor"];
	$ohipnum = $_POST["patient"];
	$query = "SELECT * FROM looksafter WHERE licensenum='" . $licensenum . "' AND ohipnum='" . $ohipnum . "'";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("query failed");
	}
	if (mysqli_num_rows($result)!=0) {
		echo "<h1>PATIENT DOCTOR RELATIONSHIP ALREADY EXISTS</h1>";
	} else {
        $insertquery = "INSERT INTO looksafter values('" . $licensenum . "', '" . $ohipnum . "')";
        if (!mysqli_query($connection, $insertquery)) {
            die("Error: insert failed" . mysqli_error($connection));
        }
		echo "<h1>NEW RELATIONSHIP CREATED!</h1>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>