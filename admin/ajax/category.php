<?php
require '../config/db.php';
require 'security.php';

/* ---------- basic helpers ---------- */
function resp($st, $msg)
{
    echo json_encode(['status' => $st, 'message' => $msg]);
    exit;
}
$uploadDir = '../../category/';

function saveImage($field, $oldFile = ''): string
{
    if (empty($_FILES[$field]['name']))
        return $oldFile;              // nothing uploaded

    /* validate */
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK)
        resp(0, 'Image upload failed!');
    $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($ext, $allowed))
        resp(0, 'Only JPG, PNG, GIF, WEBP allowed');

    /* store */
    $newName = "category_img_" . uniqid('', true) . '.' . $ext;
    global $uploadDir;
    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $uploadDir . $newName))
        resp(0, 'Can’t move uploaded image');

    /* remove old */
    if ($oldFile && file_exists($uploadDir . $oldFile))
        unlink($uploadDir . $oldFile);
    return $newName;
}
/* ----------------------------------- */

$action = $_POST['action'] ?? '';

/* ---------- FETCH -------------- */
if ($action === 'fetch') {
    $res = $conn->query("SELECT * FROM tbl_category ORDER BY id DESC");
    $rows = '';
    while ($row = $res->fetch_assoc()) {
        $name = htmlspecialchars($row['category_name']);
        $img = htmlspecialchars($row['category_image']);
        $thumb = $img ? "<img src='../category/$img' class='me-2 rounded' style='width:50px;height:50px;object-fit:cover'>" : '';
        $rows .= "
            <tr>
                <td>{$row['id']}</td>
                <td>$thumb $name</td>
                <td>
                    <button class='btn btn-sm btn-warning editBtn'
                            data-id='{$row['id']}'
                            data-name=\"" . htmlspecialchars($row['category_name'], ENT_QUOTES) . "\"
                            data-img='../category/$img'>Edit</button>
                    <button class='btn btn-sm btn-danger deleteBtn' data-id='{$row['id']}'>Delete</button>
                </td>
            </tr>";
    }
    echo $rows;
    exit;
}

/* ---------- ADD -------------- */
if ($action === 'add') {
    $name = trim($conn->real_escape_string($_POST['category_name'] ?? ''));
    if (!$name)
        resp(0, 'Category name required!');

    $image = saveImage('category_image');
    if (!$conn->query("INSERT INTO tbl_category (category_name, category_image) VALUES ('$name', '$image')"))
        resp(0, 'DB insert failed');

    resp(1, 'Category added.');
}

/* ---------- UPDATE -------------- */
if ($action === 'update') {
    $id = intval($_POST['id'] ?? 0);
    $name = trim($conn->real_escape_string($_POST['category_name'] ?? ''));
    if (!$id || !$name)
        resp(0, 'Invalid data!');

    /* get current file */
    $oldImg = '';
    if ($rs = $conn->query("SELECT category_image FROM tbl_category WHERE id=$id"))
        $oldImg = $rs->fetch_assoc()['category_image'] ?? '';

    $newImg = saveImage('category_image', $oldImg);
    $conn->query("UPDATE tbl_category SET category_name='$name', category_image='$newImg' WHERE id=$id");
    resp(1, 'Category updated.');
}

/* ---------- DELETE -------------- */
if ($action === 'delete') {
    $id = intval($_POST['id'] ?? 0);
    if (!$id)
        resp(0, 'Invalid ID');

    /* remove file */
    if ($rs = $conn->query("SELECT category_image FROM tbl_category WHERE id=$id")) {
        $img = $rs->fetch_assoc()['category_image'] ?? '';
        if ($img && file_exists($uploadDir . $img))
            unlink($uploadDir . $img);
    }
    $conn->query("DELETE FROM tbl_category WHERE id=$id");
    resp(1, 'Category deleted.');
}

/* fallthrough */
resp(0, 'Unknown action');
