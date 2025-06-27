<?php
require '../config/db.php';
require 'security.php';
$action = $_POST['action'] ?? '';

if ($action === 'fetch') {
    // Fetch join with post title for display
    $q = "SELECT i.*, p.title as post_title 
          FROM tbl_images i 
          LEFT JOIN tbl_posts p ON i.post_id=p.id 
          ORDER BY i.id DESC";
    $res = $conn->query($q);
    $output = '';
    while ($row = $res->fetch_assoc()) {
        $img = htmlspecialchars($row['image_url']);
        $title = $row['post_title'] ? htmlspecialchars($row['post_title']) : '<span class="text-danger">[deleted]</span>';
        $output .= "<tr>
      <td>{$row['id']}</td>
      <td><img src='../{$img}' class='rounded-thumb'></td>
      <td>{$title}</td>
      <td>
        <button class='btn btn-sm btn-warning editBtn' 
               data-id='{$row['id']}' 
               data-postid='{$row['post_id']}'
               data-img='{$img}'>Edit</button>
        <button class='btn btn-sm btn-danger deleteBtn'
               data-id='{$row['id']}'>Delete</button>
      </td></tr>";
    }
    echo $output;
    exit;
}

function resp($st, $msg)
{
    echo json_encode(['status' => $st, 'message' => $msg]);
    exit;
}

if ($action === 'add') {
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        $targetDir = "../../images/";
        $filename = time() . '_' . basename($_FILES["image_file"]["name"]);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $targetFile)) {
            $post_id = intval($_POST['post_id']);
            $pathInDB = "images/" . $filename;
            $sql = "INSERT INTO tbl_images (image_url, post_id) VALUES ('$pathInDB', $post_id)";
            if ($conn->query($sql))
                resp(1, "Image uploaded.");
            else
                resp(0, "DB Insert Error.");
        } else {
            resp(0, "File upload failed.");
        }
    } else
        resp(0, "No file chosen.");
}

if ($action === 'update') {
    $id = intval($_POST['id']);
    $post_id = intval($_POST['post_id']);
    $updateQuery = "UPDATE tbl_images SET post_id = $post_id";
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        $targetDir = "../../images/";
        $filename = time() . '_' . basename($_FILES["image_file"]["name"]);
        $targetFile = $targetDir . $filename;
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $targetFile)) {
            $pathInDB = "images/" . $filename;
            $updateQuery .= ", image_url = '$pathInDB'";
        }
    }
    $updateQuery .= " WHERE id = $id";
    if ($conn->query($updateQuery))
        resp(1, "Image updated.");
    else
        resp(0, "Update failed.");
}

if ($action === 'delete') {
    $id = intval($_POST['id']);
    // Remove file
    $res = $conn->query("SELECT image_url FROM tbl_images WHERE id=$id");
    if ($row = $res->fetch_assoc()) {
        $fp = "../../" . $row['image_url'];
        if (is_file($fp))
            unlink($fp);
    }
    if ($conn->query("DELETE FROM tbl_images WHERE id = $id"))
        resp(1, "Image deleted.");
    else
        resp(0, "Delete error.");
}