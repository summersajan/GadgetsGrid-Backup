<?php

require 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['status' => 'error', 'message' => 'Invalid request method']));
}


header("Content-Type: application/json");
$action = $_POST['action'] ?? '';

if ($action === 'post') {
    // === Single Post Detail Request ===

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if (!$id)
        die(json_encode(['error' => 'Invalid post ID']));

    $p = $conn->query("SELECT p.*, c.category_name
        FROM tbl_posts p
        LEFT JOIN tbl_category c ON c.id=p.category_id
        WHERE p.id=$id LIMIT 1");
    if (!$p || !$post = $p->fetch_assoc())
        die(json_encode(['error' => 'Not found.']));

    // IMAGES: gallery comes first (if any), then thumbnail and others
    $imgs = [];
    $imgsQ = $conn->query("SELECT image_url FROM tbl_images WHERE post_id=$id ORDER BY id ASC");
    while ($im = $imgsQ->fetch_assoc())
        $imgs[] = $im['image_url'];
    if ($post['thumbnail'] && !in_array($post['thumbnail'], $imgs))
        array_unshift($imgs, $post['thumbnail']);
    if (!$imgs)
        $imgs[] = 'images/default.jpg'; // fallback img

    // Product links:
    $links = [];
    $plQ = $conn->query("SELECT * FROM tbl_product_links WHERE post_id=$id");
    while ($l = $plQ->fetch_assoc())
        $links[] = $l;

    // RETURN all info
    echo json_encode([
        'post' => $post,
        'images' => $imgs,
        'product_links' => $links
    ]);
    exit;
}

if ($action === 'posts') {
    // === Posts list (optionally filter/category/paginate) ===
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 5;
    $categoryId = $_POST['categoryId'] ?? 'all';
    $where = "WHERE p.status='published'";
    if ($categoryId !== 'all')
        $where .= " AND p.category_id=" . (int) $categoryId;

    $rows = [];
    $res = $conn->query("SELECT p.id, p.thumbnail, p.title, p.tags, p.created_at
      FROM tbl_posts p $where
      ORDER BY p.created_at DESC
      LIMIT $limit OFFSET $offset");
    while ($r = $res->fetch_assoc())
        $rows[] = $r;

    $countRes = $conn->query("SELECT COUNT(*) total FROM tbl_posts p $where");
    $total = $countRes->fetch_assoc()['total'] ?? 0;

    echo json_encode(['posts' => $rows, 'totalPosts' => $total, 'offset' => $offset, 'limit' => $limit]);
    exit;
}

die(json_encode(['error' => 'Invalid action']));
?>