<?php
// Ensure database connection is included
include_once("../db_connect.php");

// Set the response header to application/json
header('Content-Type: application/json');

// --- Error Handler for JSON response ---
// This function ensures the script always returns valid JSON, even on a fatal error.
function sendJsonError($message, $stmt = null, $conn = null) {
    // Clear any previous output (like the initial <br /> tags from a PHP warning/error)
    if (ob_get_length()) {
        ob_end_clean();
    }
    header('Content-Type: application/json');
    echo json_encode([
        "success" => false,
        "error" => $message
    ]);
    if ($stmt) @$stmt->close(); // Use @to suppress potential errors if stmt is null or closed
    if ($conn) @$conn->close();
    exit;
}
// ---------------------------------------

// --- Global Exception Handler for JSON response ---
// This catches uncaught exceptions (like mysqli_sql_exception) and sends clean JSON.
set_exception_handler(function ($exception) use ($conn) {
    sendJsonError("A server exception occurred: " . $exception->getMessage(), null, $conn);
});
// --------------------------------------------------------

$targetDir = "../assets/uploads/";

// 🔹 File upload helper
function uploadFile($inputName, $targetDir)
{
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    // Sanitizing filename slightly and prepending timestamp
    $filename = time() . "_" . preg_replace('/[^a-zA-Z0-9\._-]/', '_', basename($_FILES[$inputName]["name"]));
    $targetPath = $targetDir . $filename;

    if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetPath)) {
        return $filename; // store only filename in DB
    }
    return null;
}

// 🔹 Generate unique application number for pwd_application
function generateUniqueApplicationNo($conn)
{
    do {
        $appNo = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        // Using a prepared statement for the check is good practice
        $check = $conn->prepare("SELECT pwd_id FROM pwd_application WHERE application_no = ?");
        $check->bind_param("s", $appNo);
        $check->execute();
        $check->store_result();
    } while ($check->num_rows > 0);

    $check->close();
    return $appNo;
}

$applicationNo = generateUniqueApplicationNo($conn);

// 🔹 Collect POST data and sanitize/cast (REFINED LOGIC)

// Integers: Explicitly cast to integer or null for 'i' binding parameter
$user_id = filter_var($_POST['user_id'] ?? null, FILTER_VALIDATE_INT) ?? null;
$age = filter_var($_POST['age'] ?? null, FILTER_VALIDATE_INT) ?? null;

// Strings: Trim all strings for robustness against whitespace
$applicationType = trim($_POST['applicationType'] ?? '');
$first_name = trim($_POST['first_name'] ?? '');
$middle_name = trim($_POST['middle_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$suffix = trim($_POST['suffix'] ?? '');

$birthdate = trim($_POST['birthdate'] ?? '');




$gender = trim($_POST['gender'] ?? '');
$civil_status = trim($_POST['civil_status'] ?? '');
$place_of_birth = trim($_POST['place_of_birth'] ?? '');
$barangay = trim($_POST['barangay'] ?? '');
$type_of_disability = trim($_POST['type_of_disability'] ?? '');
$cause_of_disability = trim($_POST['cause_of_disability'] ?? '');
$cause_of_disability_type = trim($_POST['cause_of_disability_type'] ?? '');
$education = trim($_POST['education'] ?? '');
$occupation = trim($_POST['occupation'] ?? '');
$status_of_employment = trim($_POST['status_of_employment'] ?? '');
$type_of_employment = trim($_POST['type_of_employment'] ?? '');
$category_of_employment = trim($_POST['category_of_employment'] ?? '');
$organization_affiliation = trim($_POST['organization_affiliation'] ?? '');
$contact_person = trim($_POST['contact_person'] ?? '');
$office_address = trim($_POST['office_address'] ?? '');
$contact_information = trim($_POST['contact_information'] ?? '');
$sss_no = trim($_POST['sss_no'] ?? '');
$gsis_no = trim($_POST['gsis_no'] ?? '');
$pagibig_no = trim($_POST['pagibig_no'] ?? '');
$psn_no = trim($_POST['psn_no'] ?? '');
$philhealth_no = trim($_POST['philhealth_no'] ?? '');
$father_lastname = trim($_POST['father_lastname'] ?? '');
$father_firstname = trim($_POST['father_firstname'] ?? '');
$father_middlename = trim($_POST['father_middlename'] ?? '');
$mother_lastname = trim($_POST['mother_lastname'] ?? '');
$mother_firstname = trim($_POST['mother_firstname'] ?? '');
$mother_middlename = trim($_POST['mother_middlename'] ?? '');
$guardian_lastname = trim($_POST['guardian_lastname'] ?? '');
$guardian_firstname = trim($_POST['guardian_firstname'] ?? '');
$guardian_middlename = trim($_POST['guardian_middlename'] ?? '');


// 🔹 Upload files
$birth_proof = uploadFile("birth_proof", $targetDir);
$indegency_certificate = uploadFile("indegency_certificate", $targetDir);
$medical_certificate = uploadFile("medical_certificate", $targetDir);
$photo_id = uploadFile("photo_id", $targetDir);

// 🔹 Insert into DB
$sql = "INSERT INTO pwd_application
(user_id, applicationType, application_no, first_name, middle_name, last_name, suffix,
 birthdate, age, gender, civil_status, place_of_birth, barangay,
 type_of_disability, cause_of_disability, cause_of_disability_type,
 education, occupation, status_of_employment, type_of_employment,
 category_of_employment, organization_affiliation, contact_person, office_address, contact_information,
 sss_no, gsis_no, pagibig_no, psn_no, philhealth_no,
 father_lastname, father_firstname, father_middlename,
 mother_lastname, mother_firstname, mother_middlename,
 guardian_lastname, guardian_firstname, guardian_middlename,
 birth_proof, indegency_certificate, medical_certificate, photo_id, date_of_application)
VALUES
(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";

// Attempt preparation and check for failure
if (!($stmt = $conn->prepare($sql))) {
    // If prepare fails, use the error handler to send clean JSON
    sendJsonError("SQL Prepare failed: " . $conn->error, null, $conn);
}

$stmt->bind_param(
    "issssssisssssssssssssssssssssssssssssssssss",
    $user_id, $applicationType, $applicationNo, $first_name, $middle_name, $last_name, $suffix,
    $birthdate, $age, $gender, $civil_status, $place_of_birth, $barangay,
    $type_of_disability, $cause_of_disability, $cause_of_disability_type,
    $education, $occupation, $status_of_employment, $type_of_employment,
    $category_of_employment, $organization_affiliation, $contact_person, $office_address, $contact_information,
    $sss_no, $gsis_no, $pagibig_no, $psn_no, $philhealth_no,
    $father_lastname, $father_firstname, $father_middlename,
    $mother_lastname, $mother_firstname, $mother_middlename,
    $guardian_lastname, $guardian_firstname, $guardian_middlename,
    $birth_proof, $indegency_certificate, $medical_certificate, $photo_id
);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "pwd_id" => $stmt->insert_id,
        "user_id" => $user_id,
        "application_no" => $applicationNo
    ]);
} else {
    // If execute fails, use the error handler
    sendJsonError("SQL Execution failed: " . $stmt->error, $stmt, $conn);
}

$stmt->close();
$conn->close();

// The uploadFile and generateUniqueApplicationNo functions are defined above in this file now
// to ensure the provided script is self-contained and runnable.
?>
