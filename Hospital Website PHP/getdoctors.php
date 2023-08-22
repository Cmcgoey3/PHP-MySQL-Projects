<?php
 // Programmer Name: 17
 //	Description: This file obtains doctors in a specific order based on what is passed through.
 include 'connectdb.php';	
 $ordering = $_POST["nameorbirth"]; //get selected ordering value from the form
 $ascordesc = $_POST["ascordesc"];
 if ($ordering == "lastname") {
	if ($ascordesc == "ASC") {
		$query = "SELECT * FROM doctor ORDER BY lastname ASC";
		echo "<h2>Doctors Ordered By Last Name in Ascending Order</h2>";
	} 
	if ($ascordesc == "DESC") {
		$query = "SELECT * FROM doctor ORDER BY lastname DESC";
		echo "<h2>Doctors Ordered By Last Name in Descending Order</h2>";
	} 
 }
 if ($ordering == "birthdate") {
	if ($ascordesc == "ASC") {
		$query = "SELECT * FROM doctor ORDER BY birthdate ASC";
		echo "<h2>Doctors Ordered By Birthdate in Ascending Order</h2>";
	} 
	if ($ascordesc == "DESC") {
		$query = "SELECT * FROM doctor ORDER BY birthdate DESC";
		echo "<h2>Doctors Ordered By Birthdate in Descending Order</h2>";
	} 
 }
 if(isset($_POST['nameorbirth'])) {
	$result = mysqli_query($connection, $query);
	if (!$result) {
		die("query failed");
	}
	echo "<ul>"; //put the doctors in an ordered bulleted list
		while ($row=mysqli_fetch_assoc($result)) {
			echo '<li>';
			echo $row["firstname"] . " " . $row["lastname"] .". Hospital: " . $row["hosworksat"] . ". Date of birth: " . $row["birthdate"] . ". License Number: " . $row["licensenum"] . ". License Date: " . $row["licensedate"] . ". Speciality: " . $row["speciality"];
		}
	echo "</ul>"; //end the bulleted list
 }
 mysqli_close($connection);
?>
