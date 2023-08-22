<?php
	include 'connectdb.php';
	$newbeds = $_POST['numofbed'];
	$hospital = $_POST['hospital'];
	if(isset($_POST['hospital'])) {
		if ($newbeds < 0) {
			echo "<h1>CANNOT ENTER A NEGATIVE AMOUNT OF BEDS</h1>";
		} else {
			$updatequery = "UPDATE hospital SET numofbed='" . $newbeds . "' WHERE hoscode='" . $hospital . "'";
			if (!mysqli_query($connection, $updatequery)) {
				die("Error: insert failed" . mysqli_error($connection));
			}
			echo "<h1>NUMBER OF BEDS UPDATED</h1>";
		}
	} else {
		echo "<h1>NO HOSPITAL SELECTED</h1>";
	}
	mysqli_close($connection);
?>