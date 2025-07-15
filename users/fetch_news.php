<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include DB connection
include '../db_connect.php';

// Prepare the query
$query = "SELECT * FROM news_publications ORDER BY created_at DESC";

$result = $conn->query($query);

$news = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $news[] = [
            'n_id' => $row['n_id'],
            'news_title' => $row['news_title'],
            'pub_date' => $row['pub_date'],
            'category' => $row['category'],
            'content' => $row['content'],
            'attachment' => !empty($row['attachment']) 
                ? $row['attachment'] 
                : null
        ];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $news
    ]);
} else {
    echo json_encode([
        'status' => 'empty',
        'message' => 'No news found.'
    ]);
}

$conn->close();
?>
