<?php
include '../db_connect.php'; // adjust to your db connection file

header('Content-Type: application/json');

// Make sure user_id is sent via POST
if (!isset($_POST['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Missing user_id"]);
    exit;
}

$user_id = intval($_POST['user_id']);

$sql = "SELECT 
            a.assistance_id,
            a.category,
            a.assistance_type,
            a.assistance_description,
            a.date_given,
            CASE WHEN atd.attendance_id IS NOT NULL THEN 1 ELSE 0 END AS attended
        FROM assistance a
        LEFT JOIN attendance atd 
            ON a.assistance_id = atd.assistance_id 
            AND atd.user_id = ?
        ORDER BY a.date_given DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$assistances = [];
while ($row = $result->fetch_assoc()) {
    $assistances[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $assistances
]);

$stmt->close();
$conn->close();
?>
