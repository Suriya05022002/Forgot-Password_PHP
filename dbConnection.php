


<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$database = "college_db";

// Create connection
$connection = mysqli_connect("$server","$username","$password");
$select_db = mysqli_select_db($connection, $database);

// Check connection
if (!$select_db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>