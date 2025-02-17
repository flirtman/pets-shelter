<?php
$server = "localhost";
$user = "root";
$pass = "root";
$db = "pets_shelter";

$conn = new mysqli($server, $user, $pass, $db);

if($conn->connect_error){
    die("connection not working " . $conn->connect_error);
}