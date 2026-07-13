<?php
// config/db.php

$host = "localhost";
$username = "root";
$password = "";
$database = "smartcanteen";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8");
?>
