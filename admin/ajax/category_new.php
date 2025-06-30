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

function saveImage(string $field, string $oldFile = ''): string
{
    global $uploadDir;   // ../../category/

    /* ------------------------------------
       0. Nothing uploaded → keep old file
    ------------------------------------ */
    if (empty($_FILES[$field]['name'])) {
        return $oldFile;
    }

    /* ------------------------------------
       1. Basic validation
    ------------------------------------ */
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        resp(0, 'Image upload failed.');
    }

    $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($ext, $allowed, true)) {
        resp(0, 'Only JPG, PNG, GIF or WEBP allowed.');
    }

    $tmpPath = $_FILES[$field]['tmp_name'];      // current working file
    [$w, $h, $type] = getimagesize($tmpPath) ?: [0, 0, 0];
    if (!$w || !$h) {
        resp(0, 'Invalid image file.');
    }

    /* ------------------------------------
       2. Optional resize (height > 400 px)
    ------------------------------------ */
    $targetH = 400;
    if ($h > $targetH) {
        $scaleW = (int) round($w * $targetH / $h);
        $scaleH = $targetH;

        // create source bitmap
        switch ($type) {
            case IMAGETYPE_JPEG:
                $src = imagecreatefromjpeg($tmpPath);
                break;
            case IMAGETYPE_PNG:
                $src = imagecreatefrompng($tmpPath);
                break;
            case IMAGETYPE_GIF:
                $src = imagecreatefromgif($tmpPath);
                break;
            case IMAGETYPE_WEBP:
                $src = imagecreatefromwebp($tmpPath);
                break;
            default:
                resp(0, 'Unsupported image format.');
        }

        // destination bitmap (preserve alpha where possible)
        $dst = imagecreatetruecolor($scaleW, $scaleH);
        if (in_array($type, [IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true)) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            $trans = imagecolorallocatealpha($dst, 0, 0, 0, 127);
            imagefill($dst, 0, 0, $trans);
        }

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $scaleW, $scaleH, $w, $h);

        /* ---- write resized file into upload folder as temp ---- */
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true)) {
            resp(0, 'Upload directory is not writable.');
        }
        $tmpResized = $uploadDir . 'tmp_' . uniqid('', true) . '.' . $ext;

        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($dst, $tmpResized, 85);
                break;
            case IMAGETYPE_PNG:
                imagepng($dst, $tmpResized);
                break;
            case IMAGETYPE_GIF:
                imagegif($dst, $tmpResized);
                break;
            case IMAGETYPE_WEBP:
                imagewebp($dst, $tmpResized);
                break;
        }

        imagedestroy($src);
        imagedestroy($dst);

        $tmpPath = $tmpResized;      // continue with resized file
    }

    /* ------------------------------------
       3. Move/rename to final filename
    ------------------------------------ */
    $newName = 'category_img_' . uniqid('', true) . '.' . $ext;
    $final = $uploadDir . $newName;

    if (is_uploaded_file($tmpPath)) {
        // original upload not resized → move_uploaded_file()
        if (!move_uploaded_file($tmpPath, $final)) {
            resp(0, 'Unable to move uploaded image.');
        }
    } else {
        // resized (or otherwise already in filesystem) → rename()
        if (!rename($tmpPath, $final)) {
            resp(0, 'Unable to store resized image.');
        }
    }

    /* ------------------------------------
       4. Delete old file (if any)
    ------------------------------------ */
    if ($oldFile && file_exists($uploadDir . $oldFile)) {
        unlink($uploadDir . $oldFile);
    }

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
