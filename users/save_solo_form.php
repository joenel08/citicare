<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../db_connect.php");


// Get form data
$user_id = $_POST['user_id'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$middle_name = $_POST['middle_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$extension_name = $_POST['extension_name'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
$civil_status = $_POST['civil_status'] ?? '';
$education = $_POST['education'] ?? '';
$religion = $_POST['religion'] ?? '';
$monthly_income = $_POST['monthly_income'] ?? '';
$email = $_POST['email'] ?? '';
$pantawid_beneficiary = $_POST['pantawid_beneficiary'] ?? '0';
$barangay = $_POST['barangay'] ?? '';
$municipality = $_POST['municipality'] ?? '';
$province = $_POST['province'] ?? '';
$solo_parent_type = $_POST['solo_parent_type'] ?? '';
$solo_parent_since = $_POST['solo_parent_since'] ?? '';
$other_classification = $_POST['other_classification'] ?? '';
$needs_problems = $_POST['needs_problems'] ?? '';
$family_resources = $_POST['family_resources'] ?? '';
$certify_information = $_POST['certify_information'] ?? '0';
$children = json_decode($_POST['children'] ?? '[]', true);

// Insert basic info
$sql = "INSERT INTO solo_parent_applications (
    user_id, first_name, middle_name, last_name, extension_name, birthdate, age, gender, civil_status, 
    education, religion, monthly_income, email, pantawid_beneficiary, barangay, municipality, 
    province, solo_parent_type, solo_parent_since, other_classification, needs_problems, 
    family_resources, certify_information, status, date_submitted
) VALUES (
    '$user_id', '$first_name', '$middle_name', '$last_name', '$extension_name', '$birthdate', '$age', '$gender', 
    '$civil_status', '$education', '$religion', '$monthly_income', '$email', '$pantawid_beneficiary', 
    '$barangay', '$municipality', '$province', '$solo_parent_type', '$solo_parent_since', 
    '$other_classification', '$needs_problems', '$family_resources', '$certify_information', 'Pending', NOW()
)";

if (mysqli_query($conn, $sql)) {
    $application_id = mysqli_insert_id($conn);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Insert failed: " . mysqli_error($conn)]);
    exit;
}

// Insert children
if (!empty($children)) {
    foreach ($children as $child) {
        $c_name = $child['name'] ?? '';
        $c_age = $child['age'] ?? '';
        $c_relationship = $child['relationship'] ?? '';
        $c_disability = isset($child['disability']) && $child['disability'] ? 1 : 0;
        $c_education = $child['education'] ?? '';
        $c_occupation = $child['occupation'] ?? '';

        $childSql = "INSERT INTO solo_parent_children (
            application_id, name, age, relationship, disability, education, occupation
        ) VALUES (
            '$application_id', '$c_name', '$c_age', '$c_relationship', '$c_disability', '$c_education', '$c_occupation'
        )";

        mysqli_query($conn, $childSql);
    }
}

// Handle file uploads
// $uploadDir = 'assets/uploads/' . $application_id . '/';
$uploadDir = __DIR__ . '/assets/uploads/' . $application_id . '/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$fileFields = [
    'birth_proof' => 'birth_proof',
    'residency_proof' => 'residency_proof',
    'income_proof' => 'income_proof',
    'affidavit' => 'affidavit',
    'other_documents' => 'other_documents',
    'photo_id' => 'photo_id'
];

$filePaths = [];
foreach ($fileFields as $field => $prefix) {
    if (!empty($_FILES[$field]['name'])) {
        $fileExt = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
        $fileName = $prefix . '_' . time() . '.' . $fileExt;
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES[$field]['tmp_name'], $filePath)) {
            $filePaths[$field] = $filePath;
        }
    }
}

// Update application with file paths
if (!empty($filePaths)) {
    $updateFields = [];
    foreach ($fileFields as $field => $column) {
        $value = $filePaths[$field] ?? null;
        if ($value) {
            $updateFields[] = "$column = '" . mysqli_real_escape_string($conn, $value) . "'";
        }
    }

    if (!empty($updateFields)) {
        $updateSql = "UPDATE solo_parent_applications SET " . implode(', ', $updateFields) . " WHERE id = '$application_id'";
        mysqli_query($conn, $updateSql);
    }
}

mysqli_close($conn);

http_response_code(200);
echo json_encode([
    "status" => "success",
    "message" => "Application submitted successfully",
    "application_id" => $application_id
]);
?>
