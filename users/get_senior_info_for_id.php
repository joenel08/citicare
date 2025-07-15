<?php
include '../db_connect.php';

$user_id = $_GET['user_id'];

$qry = $conn->query("SELECT * FROM senior_citizens WHERE user_id = '$user_id'");

if ($qry && $qry->num_rows > 0) {
    $row = $qry->fetch_assoc();

    echo json_encode([
        'status' => 'success',
        'data' => $row
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not found.'
    ]);
}
?>
