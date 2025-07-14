<?php
header('Content-Type: application/json');
include_once("../db_connect.php");

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM senior_citizens WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "data" => $row]);
} else {
    echo json_encode(["success" => false, "message" => "No record found."]);
}

$stmt->close();
$conn->close();
?>
