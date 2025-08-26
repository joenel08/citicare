<?php
date_default_timezone_set('Asia/Manila'); // Set to your timezone
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once("../db_connect.php");


$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->contact_info, $data->otp)) {
    echo json_encode(["status" => "error", "message" => "Missing data."]);
    exit;
}

$contact = $data->contact_info;
$otp = $data->otp;

// Convert to +639 format if starts with 09
if (strpos($contact, '09') === 0) {
    $contact = '+639' . substr($contact, 2);
}

// Get PHP current time
$now = date('Y-m-d H:i:s');

// Query with PHP time instead of MySQL NOW()
$query = "SELECT * FROM users WHERE contact_info = ? AND otp_code = ? AND otp_expiry >= ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $contact, $otp, $now);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $update = $conn->prepare("UPDATE users SET verified = 1 WHERE contact_info = ?");
    $update->bind_param("s", $contact);
    $update->execute();
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid or expired OTP."]);
}

$stmt->close();
$conn->close();
?>
