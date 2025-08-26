<?php

date_default_timezone_set('Asia/Manila'); // Set to your timezone
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
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

if (strpos($contact, '09') === 0) {
    $contact = '+639' . substr($contact, 2);
}

// ✅ Check if contact already exists
$check = $conn->prepare("SELECT * FROM users WHERE contact_info = ?");
$check->bind_param("s", $contact);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $verified = $row['verified'];

    if ($verified == 1) {
        echo json_encode([
            "status" => "already_verified",
            "message" => "Account already verified. Please log in."
        ]);
    } else {
        // Resend OTP
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        $update = $conn->prepare("UPDATE users SET otp_code = ?, otp_expiry = ? WHERE contact_info = ?");
        $update->bind_param("sss", $otp, $expiry, $contact);
        $update->execute();
        $update->close();

        echo json_encode([
            "status" => "resend_otp",
            "message" => "OTP resent. Please verify.",
            "otp" => $otp
        ]);
    }

    $check->close();
    $conn->close();
    exit;
}
$check->close();

// ✅ Proceed with new registration
$otp = rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));
$isVerified = 0;
$stmt = $conn->prepare("INSERT INTO users (contact_info, password, user_type, otp_code, otp_expiry, verified) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $contact, $password, $userType, $otp, $expiry,$isVerified);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "otp" => $otp]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
