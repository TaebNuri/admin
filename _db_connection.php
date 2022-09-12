<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "_db_";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn){
    echo "fail";
}
?>