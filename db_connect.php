<?php 

$conn = new mysqli('localhost', 'root', '', 'citicare_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
