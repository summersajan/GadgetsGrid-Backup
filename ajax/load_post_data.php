<?php

require 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['status' => 'error', 'message' => 'Invalid request method']));
}

// Pagination
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 5;



$categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : 'all';

$where = "WHERE p.status = 'published'";

if ($categoryId !== 'all') {
    $categoryId = intval($categoryId);
    $where .= " AND p.category_id = $categoryId";
}



// Count total posts
$countRes = $conn->query("SELECT COUNT(*) as total FROM tbl_posts p $where");
$countRow = $countRes->fetch_assoc();
$totalPosts = intval($countRow['total']);

// Fetch posts
$query = "
    SELECT p.id, p.thumbnail, p.title, p.tags, p.created_at
    FROM tbl_posts p
    $where
    ORDER BY p.created_at DESC
    LIMIT $limit OFFSET $offset
";

$postRes = $conn->query($query);
$posts = [];
while ($row = $postRes->fetch_assoc())
    $posts[] = $row;

echo json_encode([
    'posts' => $posts,
    'totalPosts' => $totalPosts,
    'offset' => $offset,
    'limit' => $limit
]);
?>