<?php
$host = 'localhost:3306';
$user = 'laurencikj';
$password = 'hesloheslo';
$database = 'laurencikj_simple_app';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>