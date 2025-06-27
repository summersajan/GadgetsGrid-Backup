<?php
require '../config/db.php';
require 'security.php';
$action = $_POST['action'] ?? '';

if ($action === "fetch") {
    $res = $conn->query("SELECT l.*, p.title FROM tbl_product_links l 
                         LEFT JOIN tbl_posts p ON l.post_id = p.id 
                         ORDER BY l.id DESC");
    $data = "";
    while ($row = $res->fetch_assoc()) {
        $data .= "<tr>
            <td>{$row['id']}</td>
            <td>" . htmlspecialchars($row['title']) . "</td>
            <td><a href='" . htmlspecialchars($row['product_link']) . "' target='_blank'>" . htmlspecialchars($row['product_link']) . "</a></td>
            <td>" . ($row['price'] !== null ? '$' . number_format($row['price'], 2) : '') . "</td>
            <td>
                <button class='btn btn-warning btn-sm editBtn' 
                        data-id='{$row['id']}' 
                        data-postid='{$row['post_id']}'
                        data-link=\"" . htmlspecialchars($row['product_link'], ENT_QUOTES) . "\"
                        data-price=\"" . htmlspecialchars($row['price']) . "\">Edit</button>
                <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Delete</button>
            </td>
        </tr>";
    }
    echo $data;
    exit;
}

if ($action === "add") {
    $post_id = intval($_POST['post_id']);
    $link = $conn->real_escape_string($_POST['product_link']);
    $price = isset($_POST['price']) && $_POST['price'] !== '' ? floatval($_POST['price']) : 'NULL';
    $conn->query("INSERT INTO tbl_product_links (post_id, product_link, price) VALUES ($post_id, '$link', $price)");
    echo "success";
    exit;
}

if ($action === "update") {
    $id = intval($_POST['id']);
    $post_id = intval($_POST['post_id']);
    $link = $conn->real_escape_string($_POST['product_link']);
    $price = isset($_POST['price']) && $_POST['price'] !== '' ? floatval($_POST['price']) : 'NULL';
    $conn->query("UPDATE tbl_product_links SET post_id=$post_id, product_link='$link', price=$price WHERE id=$id");
    echo "success";
    exit;
}

if ($action === "delete") {
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM tbl_product_links WHERE id=$id");
    echo "success";
    exit;
}
?>