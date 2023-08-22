<!--
	Programmer Name: 17
	Description: This file is the main page of the project. It references other .php files to get lists, add/delete/update from the database, etc.
-->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 3 Main Page</title>
</head>
<body>
<script src="hospitalinfo.js"></script>
<?php
include 'connectdb.php';
?>
<hr>
<h1>Canadian Hospital Information System</h1>
<h2>Doctors in our system</h2>
<form action="getdoctors.php" method="post">
	<h4>Choose a Field to Sort The Doctors On:</h4>
	<input type="radio" id="lastname" name="nameorbirth" value="lastname" checked>
	<label for="lastname">Sort by Doctor's Last Name</label><br>
	
	<input type="radio" id="birthdate" name="nameorbirth" value="birthdate">
	<label for="birthdate">Sort by Doctor's Birthdate</label><br>
	
	<h4>Choose an Order to Sort The Doctors On:</h4>
	<input type="radio"id="asc" name="ascordesc" value="ASC" checked>
	<label for="asc">Ascending Order</label><br>
	
	<input type="radio"id="desc" name="ascordesc" value="DESC">
	<label for="desc">Descending Order</label><br><br>
	
	<input type="submit" value="Get Doctor Info"><br><br>
</form>
<hr>
<h3>Doctors Sorted By Speciality:</h3>
<form action="getdoctorsbyspeciality.php" method="post">
	<?php
		include 'getspecialities.php';
	?>
	<input type="submit" value="Get Doctor Info"><br><br>
</form>
<br>
<hr>
<h2>Insert a New Doctor</h2>
<form action='addnewdoctor.php' method='post'>
	<h3>Select a Hospital</h3>
	<input type="radio" id="victorialondon" name="hospital" value="ABC" checked>
	<label for="victorialondon">Victoria Hospital, London ON</label><br>
	
	<input type="radio" id="stjoseph" name="hospital" value="BBC">
	<label for="stjoseph">St. Joseph Hospital, London ON</label><br>
	
	<input type="radio" id="zagazig" name="hospital" value="CCE">
	<label for="zagazig">Zagazig Hospital, London ON</label><br>
	
	<input type="radio" id="victoriavictoria" name="hospital" value="DDE">
	<label for="victoriavictoria">Victoria Hospital, Victoria BC</label><br><br>
	
	<label for="fname">First name:</label><br>
	<input type="text" id="fname" name="fname"><br><br>
	
	<label for="lname">Last name:</label><br>
	<input type="text" id="lname" name="lname"><br><br>
	
	<label for="lnum">License Number:</label><br>
	<input type="text" id="lnum" name="lnum"><br><br>
	
	<label for="ldate">License Date (yyyy-mm-dd):</label><br>
	<input type="text" id="ldate" name="ldate"><br><br>
	
	<label for="bdate">Birth Date (yyyy-mm-dd):</label><br>
	<input type="text" id="bdate" name="bdate"><br><br>
	
	<label for="speciality">Speciality:</label><br>
	<input type="text" id="speciality" name="speciality"><br><br>
	
	<input type="submit" value="Create New Doctor">
</form>
<br>
<hr>
<h2>Delete A Doctor</h2>
<form action="deletedoctor.php" method="post">
	<label for="lnum">License Number of Doctor to be Deleted:</label><br>
	<input type="text" id="lnum" name="lnum"><br><br>
	<input type="submit" value="Delete Doctor">
</form>
<br>
<hr>
<h2>Assign a Doctor To a Patient</h2>
<form action="makerelationship.php" method="post">
	<label for="doctor">Choose a Doctor:</label>
	<select name="doctor" id="doctor">
		<?php
			include "getdoctorsnames.php"
		?>
	</select>
	<br><br>
	<label for="patient">Choose a Patient:</label>
	<select name="patient" id="patient">
		<?php
			include "getpatientsnames.php"
		?>
	</select>
	<br><br>
	<input type="submit" value="Assign Doctor To Patient">
</form>
<br>
<hr>
<h2>Get Patient Information</h2>
<form action="getpatients.php" method="post">
	<label for="doctor">Choose a Doctor:</label>
	<select name="doctor" id="doctor">
		<?php
			include "getdoctorsnames.php"
		?>
	</select>
	<br><br>
	<input type="submit" value="Find Doctor's Patients">
</form>
<br>
<hr>
<h2>Get Hospital Information</h2>
<form action="gethospitalinformation.php" method="post">
	<?php
		include 'gethospitals.php'
	?>
	<input type="submit" value="Get Hospital Information">
</form>
</form>
<br>
<hr>
<h2>Change Hospital's Number of Beds</h2>
<form action="changebeds.php" method="post">
	<h3>Select a Hospital</h3>
	<?php
		include 'gethospitals.php'
	?>
	<br>
	<label for="numofbed">New Bed Count: </label>
	<input type="text" id="numofbed" name="numofbed"><br><br>
	<input type="submit" value="Update Hospital's Bed Count">
</form>
</body>
</html>