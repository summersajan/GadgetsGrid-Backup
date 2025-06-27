<?php
// ── REQUEST-METHOD CHECK ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);                       // “Method Not Allowed”
    die(json_encode(['status' => 'invalid request']));
}

// ── SESSION & ADMIN VALIDATION ───────────────────────────────────────
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_usercode_gadget_grids'])) {
    http_response_code(401);                       // “Unauthorized”
    die(json_encode(['status' => 'unauthorized']));
}

$pdfUserCode = $_SESSION['admin_usercode_gadget_grids'];
$stmt = $conn->prepare("SELECT usercode FROM tbl_admin WHERE usercode = ?");

if (!$stmt) {                                     // DB error → fail closed
    http_response_code(500);
    die(json_encode(['status' => 'db-error']));
}

$stmt->bind_param("s", $pdfUserCode);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {                    // session is bogus
    session_destroy();
    http_response_code(401);
    die(json_encode(['status' => 'unauthorized']));
}

?>