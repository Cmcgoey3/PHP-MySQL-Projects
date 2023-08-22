<?php
	include 'connectdb.php';
	if(isset($_POST['hospital'])) {
		$hospital = $_POST["hospital"];
		
		$hospitalquery = "SELECT hosname, city, prov, numofbed FROM hospital WHERE hoscode='" . $hospital . "'";
		$hospitalresult = mysqli_query($connection, $hospitalquery);
		
		$headdocquery = "SELECT firstname, lastname FROM doctor WHERE licensenum IN (SELECT headdoc FROM hospital WHERE hoscode='" . $hospital . "')";
		$headdocresult = mysqli_query($connection, $headdocquery);
		
		$doctorsquery = "SELECT firstname, lastname FROM doctor WHERE hosworksat='" . $hospital . "'";
		$doctorsresult = mysqli_query($connection, $doctorsquery);
		
		if (!$hospitalresult || !$headdocresult || !$doctorsresult) {
			die("query failed");
		}
		echo "<h2>Hospital Information</h2>";
		echo "<p>";
		while ($row=mysqli_fetch_assoc($hospitalresult)) {
			echo $row["hosname"] . " Hospital, " . $row["city"] . " " . $row["prov"] . ". Number of beds: " . $row["numofbed"] . ".<br />";
		}
		while ($row=mysqli_fetch_assoc($headdocresult)) {
			echo "Head Doctor: " . $row["firstname"] . " " . $row["lastname"] . ".<br />";
		}
		echo "</p>";
		echo "<h2>Hospital's Doctors</h2>";
		echo "<ul>";
		while ($row=mysqli_fetch_assoc($doctorsresult)) {
			echo "<li>";
			echo $row["firstname"] . " " . $row["lastname"];
		}
		echo "</ul>";
		mysqli_free_result($hospitalresult);
		mysqli_free_result($headdocresult);
		mysqli_free_result($doctorsresult);
	} else {
		echo "<h1>NO HOSPITAL SELECTED</h1>";
	}
	mysqli_close($connection);
?>