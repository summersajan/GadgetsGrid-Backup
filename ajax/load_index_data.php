<?php
require 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['status' => 'error', 'message' => 'Invalid request method']));
}

header("Content-Type: application/json");

$featuredOffset = isset($_POST['featuredOffset']) ? intval($_POST['featuredOffset']) : 0;
$trendingOffset = isset($_POST['trendingOffset']) ? intval($_POST['trendingOffset']) : 0;
$allOffset = isset($_POST['allOffset']) ? intval($_POST['allOffset']) : 0;
$featuredLimit = isset($_POST['featuredLimit']) ? intval($_POST['featuredLimit']) : 4;
$trendingLimit = isset($_POST['trendingLimit']) ? intval($_POST['trendingLimit']) : 4;
$allLimit = isset($_POST['allLimit']) ? intval($_POST['allLimit']) : 4;
$categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : 'all';
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

$categories = [];
$catRes = $conn->query("SELECT id, category_name, category_image FROM tbl_category ORDER BY id");
while ($cat = $catRes->fetch_assoc())
    $categories[] = $cat;

$where = "WHERE p.status='published'";
if ($categoryId !== 'all') {
    $categoryId = intval($categoryId);
    $where .= " AND p.category_id = $categoryId";
}
if ($search !== '') {
    $searchSafe = $conn->real_escape_string($search);
    $where .= " AND (
        p.title LIKE '%$searchSafe%' OR
        p.tags LIKE '%$searchSafe%' OR
        c.category_name LIKE '%$searchSafe%'
    )";
}

// Posts
$getPosts = function ($extraWhere, $limit, $offset) use ($conn, $where) {
    $sql = "SELECT p.id, p.thumbnail, p.title, p.tags, p.created_at, p.category_id, c.category_name
        FROM tbl_posts p
        LEFT JOIN tbl_category c ON p.category_id = c.id
        $where $extraWhere
        ORDER BY p.created_at DESC
        LIMIT $limit OFFSET $offset";
    $res = $conn->query($sql);
    $arr = [];
    while ($row = $res->fetch_assoc())
        $arr[] = $row;
    return $arr;
};

$getCount = function ($extraWhere = '') use ($conn, $where) {
    $sql = "SELECT COUNT(*) as total
        FROM tbl_posts p
        LEFT JOIN tbl_category c ON p.category_id = c.id
        $where $extraWhere";
    $res = $conn->query($sql);
    $arr = $res->fetch_assoc();
    return intval($arr['total']);
};

// Hero (latest)
$hero = $getPosts('', 1, 0);
if ($hero && isset($hero[0]['id'])) {
    $heroId = intval($hero[0]['id']);
    $imgRes = $conn->query("SELECT image_url FROM tbl_images WHERE post_id = $heroId");
    $images = [];
    while ($img = $imgRes->fetch_assoc()) {
        $images[] = $img['image_url'];
    }
    $hero[0]['images'] = $images;
}
// Featured and Trending
$featured = $getPosts("AND p.is_featured=1", $featuredLimit, $featuredOffset);
$trending = $getPosts("AND p.is_trending=1", $trendingLimit, $trendingOffset);

// Exclude for 'All'
$excludeIds = [];
foreach ($featured as $f)
    $excludeIds[] = intval($f['id']);
foreach ($trending as $t)
    if (!in_array(intval($t['id']), $excludeIds))
        $excludeIds[] = intval($t['id']);
$excludeWhere = count($excludeIds) ? (" AND p.id NOT IN (" . implode(',', $excludeIds) . ")") : '';

$all = $getPosts($excludeWhere, $allLimit, $allOffset);

// Now Trending Sidebar
$nowTrending = $getPosts("AND p.is_trending=1", 10, 0);

echo json_encode([
    'categories' => $categories,
    'hero' => $hero ? $hero[0] : null,
    'featured' => $featured,
    'trending' => $trending,
    'posts' => $all,
    'nowTrending' => $nowTrending,
    'totalFeatured' => $getCount("AND p.is_featured=1"),
    'totalTrending' => $getCount("AND p.is_trending=1"),
    'totalPosts' => $getCount($excludeWhere),
]);