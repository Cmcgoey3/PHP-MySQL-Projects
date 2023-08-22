<?php
include 'connectdb.php';
$licensenumber = $_POST["yesorno"];
$deletequery = "DELETE FROM doctor WHERE licensenum='" . $licensenumber . "'";
$result = mysqli_query($connection, $deletequery);
echo "<h1>DOCTOR DELETED</h1>";
mysqli_close($connection);
?>