<?php
include_once("../db_connect.php");

$data = json_decode(file_get_contents("php://input"));

if ($data === null) {
    echo json_encode(["status" => "error", "message" => "Invalid or missing JSON input"]);
    exit;
}

$contact = $data->contact_info ?? null;
$password = isset($data->password) ? password_hash($data->password, PASSWORD_BCRYPT) : null;
$userType = $data->user_type ?? null;

if (!$contact || !$password || !$userType) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

$otp = rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

$stmt = $conn->prepare("INSERT INTO users (contact_info, password, user_type, otp_code, otp_expiry) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $contact, $password, $userType, $otp, $expiry);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "otp" => $otp]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
