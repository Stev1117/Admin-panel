<?php
$host = "localhost";
$user = "root";
$pass = "";  // ← change this if needed
$dbname = "sevi";  // ← change this

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
