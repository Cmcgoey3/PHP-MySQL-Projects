<?php
 include 'connectdb.php';	
 $speciality = $_POST["speciality"]; //get selected ordering value from the form
 $query = "SELECT * FROM doctor WHERE speciality=" . '"' . $speciality . '"';
 if(isset($_POST['speciality'])) {
	echo "<h2>All Doctor Information for Doctors Whose Speciality is " . $speciality . "</h2>";
	$result = mysqli_query($connection, $query);
	echo "<ul>";
	while ($row=mysqli_fetch_assoc($result)) {
			echo '<li>';
			echo $row["firstname"] . " " . $row["lastname"] .". Hospital: " . $row["hosworksat"] . ". Date of birth: " . $row["birthdate"] . ". License Number: " . $row["licensenum"] . ". License Date: " . $row["licensedate"] . ". Speciality: " . $row["speciality"];
	}
	echo "</ul>";
	mysqli_free_result($result);
	mysqli_close($connection);
 }
 else {
	 echo "<h1>No speciality selected</h1>";
	 mysqli_close($connection);
 }
 ?>
 
