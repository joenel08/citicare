<?php
include_once("../db_connect.php");

$targetDir = "../assets/uploads/";

function uploadFile($inputName, $targetDir)
{
    if (!isset($_FILES[$inputName]))
        return null;
    $filename = time() . "_" . basename($_FILES[$inputName]["name"]);
    $targetPath = $targetDir . $filename;
    if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetPath)) {
        // return only filename for DB saving
        return $filename;
    }
    return null;
}

function generateUniqueApplicationNo($conn)
{
    do {
        $appNo = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        $check = $conn->prepare("SELECT sc_id FROM senior_citizens WHERE application_no = ?");
        $check->bind_param("s", $appNo);
        $check->execute();
        $check->store_result();
    } while ($check->num_rows > 0);
    $check->close();
    return $appNo;
}

$applicationNo = generateUniqueApplicationNo($conn);

// Upload images
$birthProof = uploadFile("birth_proof", $targetDir);
$residencyProof = uploadFile("residency_proof", $targetDir);
$photoId = uploadFile("photo_id", $targetDir);

$stmt = $conn->prepare("INSERT INTO senior_citizens (
    user_id, application_no, first_name, middle_name, last_name, birthdate, age, gender, civil_status,
    education, occupation, place_of_birth, contact_no, barangay, municipality, province,
    emergency_name, emergency_contact, emergency_relationship, social_pensioner, retiree, retiree_desc,
    is_gsis, health_status, birth_proof, residency_proof, photo_id,
    qr_code, idCard_no, is_verified,
    date_registered
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$qr_code = null;
$idCard_no = null;
$is_verified = 0;

$stmt->bind_param(
    "isssssssssssssssssiiissssssssi",
    $_POST["user_id"],
    $applicationNo,
    $_POST["first_name"],
    $_POST["middle_name"],
    $_POST["last_name"],
    $_POST["birthdate"],
    $_POST["age"],
    $_POST["gender"],
    $_POST["civil_status"],
    $_POST["education"],
    $_POST["occupation"],
    $_POST["place_of_birth"],
    $_POST["contact_no"],
    $_POST["barangay"],
    $_POST["municipality"],
    $_POST["province"],
    $_POST["emergency_name"],
    $_POST["emergency_contact"],
    $_POST["emergency_relationship"],
    $_POST["social_pensioner"],
    $_POST["retiree"],
    $_POST["retiree_desc"],
    $_POST["is_gsis"],
    $_POST["health_status"],
    $birthProof,      // just filename
    $residencyProof,  // just filename
    $photoId,         // just filename
    $qr_code,
    $idCard_no,
    $is_verified
);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Senior record saved.",
        "application_no" => $applicationNo,
        "user_id" => $_POST["user_id"],
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
