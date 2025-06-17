<?php
include 'db.php';
$name = $_POST['name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$points = $_POST['points'];

$stmt = $conn->prepare("INSERT INTO users (name, password, points) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $name, $password, $points);
$stmt->execute();
header("Location: index.php");
