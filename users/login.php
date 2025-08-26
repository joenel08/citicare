<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once("../db_connect.php");

$data = json_decode(file_get_contents('php://input'));

$contact_info = isset($data->contact_info) ? $data->contact_info : null;

$contact_info = isset($data->contact_info) ? $data->contact_info : null;

if ($contact_info !== null) {
    // Remove any non-digit characters (optional, for cleaner input)
    $contact_info = preg_replace('/\D/', '', $contact_info);

    // Convert numbers starting with '0' to '+63'
    if (preg_match('/^0\d{10}$/', $contact_info)) {
        $contact_info = '+63' . substr($contact_info, 1);
    } elseif (preg_match('/^63\d{10}$/', $contact_info)) {
        $contact_info = '+' . $contact_info;
    }
}

$password = isset($data->password) ? $data->password : null;

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed"]);
    exit();
}

$sql = "SELECT id, contact_info, password, user_type, verified FROM users WHERE contact_info = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $contact_info);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $userId = $row['id'];
        $userType = $row['user_type'];
        $verified = (int) $row['verified'];

        $response = [
            "status" => "success",
            "id" => $userId,
            "user_type" => $userType,
            "verified" => $verified,
            "has_profile" => false
        ];

        if ($userType === "Senior Citizen") {
            $profileSql = "SELECT * FROM senior_citizens WHERE user_id = ? ";
            $profileStmt = $conn->prepare($profileSql);
            $profileStmt->bind_param("i", $userId);
            $profileStmt->execute();
            $profileResult = $profileStmt->get_result();

            if ($profileRow = $profileResult->fetch_assoc()) {
                $response["has_profile"] = true;
                $response["profile"] = $profileRow;
            }
        }

        echo json_encode($response);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid password"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "User not found"]);
}
