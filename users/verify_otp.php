<?php
include_once("../db_connect.php");

$data = json_decode(file_get_contents("php://input"));
$contact = $data->contact_info;
$otp = $data->otp;

$query = "SELECT * FROM users WHERE contact_info = ? AND otp_code = ? AND otp_expiry >= NOW()";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $contact, $otp);
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
