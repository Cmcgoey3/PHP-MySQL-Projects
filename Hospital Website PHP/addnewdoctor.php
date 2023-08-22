<?php
 include 'connectdb.php';
 $hospital = $_POST["hospital"];
 $first = $_POST["fname"];
 $last = $_POST["lname"];
 $licensenum = $_POST["lnum"];
 $licensedate = $_POST["ldate"];
 $birthdate = $_POST["bdate"];
 $speciality = $_POST["speciality"];

 $querytestdoctorexists = "SELECT * FROM doctor WHERE licensenum='" . $licensenum . "'";
 $result1 = mysqli_query($connection, $querytestdoctorexists);

if (mysqli_num_rows($result1)==0) {
		mysqli_free_result($result1);
        $insertquery = "INSERT INTO doctor values('" . $licensenum . "', '" . $first . "', '" . $last . "', '" . $licensedate . "', '" . $birthdate . "', '" . $hospital . "', '" . $speciality . "')";
        if (!mysqli_query($connection, $insertquery)) {
                die("Error: insert failed" . mysqli_error($connection));
        }
        echo "<h1>NEW DOCTOR WAS ADDED!</h1>";
} else {
        echo "<h1>DOCTOR WITH THE GIVEN LICENSE NUMBER ALREADY EXISTS PLEASE GO BACK AND TRY AGAIN</h1>";
 }
mysqli_close($connection);
 ?>

