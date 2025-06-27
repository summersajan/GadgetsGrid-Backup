<?php
require '../config/db.php';
require 'security.php';
$action = $_POST['action'] ?? '';
function now()
{
    return date("Y-m-d H:i:s");
}

// === Fetch Categories for lookup ===
$catRes = $conn->query("SELECT id, category_name FROM tbl_category");
$catArr = [];
while ($cr = $catRes->fetch_assoc())
    $catArr[$cr['id']] = $cr['category_name'];

// === FETCH POSTS ===
if ($action == 'fetch') {
    $res = $conn->query("SELECT * FROM tbl_posts ORDER BY id DESC");
    $out = "";
    while ($row = $res->fetch_assoc()) {
        $thumb = $row['thumbnail'] ? "<img src='../{$row['thumbnail']}' class='thumbnail'>" : 'N/A';
        $catName = isset($catArr[$row['category_id']]) ? htmlspecialchars($catArr[$row['category_id']]) : "<span class='text-danger'>Unknown</span>";
        $out .= "<tr>
      <td>{$row['id']}</td>
      <td>{$thumb}</td>
      <td>{$row['title']}</td>
      <td>{$catName}</td>
      <td>{$row['status']}</td>
      <td>
        <button class='btn btn-warning btn-sm editBtn'
          data-id='{$row['id']}'
          data-title=\"" . htmlspecialchars($row['title'], ENT_QUOTES) . "\"
          data-subtitle=\"" . htmlspecialchars($row['subtitle'], ENT_QUOTES) . "\"
          data-category_id=\"" . $row['category_id'] . "\"
          data-body=\"" . htmlspecialchars($row['body'], ENT_QUOTES) . "\"
          data-tags=\"" . htmlspecialchars($row['tags'] ?? '', ENT_QUOTES) . "\"
          data-status=\"" . htmlspecialchars($row['status'], ENT_QUOTES) . "\"
          data-featured=\"" . $row['is_featured'] . "\"
          data-trending=\"" . $row['is_trending'] . "\">Edit</button>
        <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Delete</button>
     </td>
    </tr>";
    }
    echo $out;
    exit;
}

// === ADD OR UPDATE POST ===
if ($action == 'add' || $action == 'update') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $subtitle = $conn->real_escape_string($_POST['subtitle'] ?? '');
    $category_id = intval($_POST['category_id'] ?? 0);
    $body = $conn->real_escape_string($_POST['body'] ?? '');
    $tags = $conn->real_escape_string($_POST['tags'] ?? ''); // NEW: get and escape tags
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $is_trending = isset($_POST['is_trending']) ? 1 : 0;
    $status = $conn->real_escape_string($_POST['status'] ?? '');
    $thumbnailPath = '';

    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $uploadDir = '../../images/';
        $filename = time() . '_' . basename($_FILES['thumbnail']['name']);
        $target = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
            $thumbnailPath = "images/" . $filename;
        } else {
            echo json_encode(['status' => 0, 'message' => "Thumbnail upload failed."]);
            exit;
        }
    }

    if ($action == 'add') {
        $thumbPart = $thumbnailPath ? "'$thumbnailPath'" : "NULL";
        $sql = "INSERT INTO tbl_posts (title, subtitle, category_id, body, tags, thumbnail, is_featured, is_trending, created_at, updated_at, status)
      VALUES ('$title', '$subtitle', $category_id, '$body', '$tags', $thumbPart, $is_featured, $is_trending, '" . now() . "', '" . now() . "', '$status')";
        if ($conn->query($sql))
            echo json_encode(['status' => 1, 'message' => "Post added successfully."]);
        else
            echo json_encode(['status' => 0, 'message' => "Insert error: " . $conn->error]);
    } else {
        $thumbSQL = $thumbnailPath ? ", thumbnail='$thumbnailPath'" : "";
        $sql = "UPDATE tbl_posts SET title='$title', subtitle='$subtitle', category_id=$category_id, body='$body', tags='$tags', is_featured=$is_featured, is_trending=$is_trending, status='$status', updated_at='" . now() . "' $thumbSQL WHERE id=$id";
        if ($conn->query($sql))
            echo json_encode(['status' => 1, 'message' => "Post updated successfully."]);
        else
            echo json_encode(['status' => 0, 'message' => "Update error: " . $conn->error]);
    }
    exit;
}

// === DELETE POST ===
if ($action == 'delete') {
    $id = intval($_POST['id']);
    $res = $conn->query("SELECT thumbnail FROM tbl_posts WHERE id=$id");
    if ($row = $res->fetch_assoc()) {
        $thumb = "../../" . $row['thumbnail'];
        if (file_exists($thumb) && !empty($row['thumbnail']))
            unlink($thumb);
    }
    if ($conn->query("DELETE FROM tbl_posts WHERE id=$id")) {
        echo json_encode(['status' => 1, 'message' => "Post deleted."]);
    } else {
        echo json_encode(['status' => 0, 'message' => "Could not delete."]);
    }
    exit;
}
?>