<?php

include '../config/db.php';

function getUserIP()
{
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function isIPBlocked($conn, $ip)
{
    $stmt = $conn->prepare("SELECT attempts FROM tbl_login_attempts WHERE ip_address = ?");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->bind_result($attempts);
    $stmt->fetch();
    $stmt->close();

    return $attempts >= 5;
}

function incrementFailedIP($conn, $ip)
{
    $stmt = $conn->prepare("INSERT INTO tbl_login_attempts (ip_address, attempts) 
        VALUES (?, 1) 
        ON DUPLICATE KEY UPDATE attempts = attempts + 1");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->close();
}

function resetIPAttempts($conn, $ip)
{
    $stmt = $conn->prepare("DELETE FROM tbl_login_attempts WHERE ip_address = ?");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ip = getUserIP();

    if (isIPBlocked($conn, $ip)) {
        echo json_encode(["status" => -6, "usercode" => null, "message" => "Too many failed attempts from your IP. Try again later."]);
        exit;
    }

    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password'] ?? '');

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password, is_verified, login_attempts, usercode FROM tbl_admin WHERE email = ?");
        if (!$stmt) {
            echo json_encode(["status" => "error", "message" => "Database error"]);
            exit;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password, $is_verified, $login_attempts, $usercode);
            $stmt->fetch();

            if ($is_verified == 0) {
                echo json_encode(["status" => -4, "usercode" => null, "message" => "Your account is blocked."]);
            } elseif (password_verify($password, $hashed_password)) {
                if ($is_verified != 1) {
                    echo json_encode(["status" => 0, "usercode" => null, "message" => "Please verify your email first."]);
                } else {
                    // Successful login — reset user & IP attempts
                    $conn->query("UPDATE tbl_admin SET login_attempts = 0 WHERE id = $id");
                    resetIPAttempts($conn, $ip);

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION['admin_usercode_gadget_grids'] = $usercode;

                    echo json_encode(["status" => 1, "message" => "Login successful."]);
                }
            } else {
                $login_attempts++;
                if ($login_attempts >= 4) {
                    $conn->query("UPDATE tbl_admin SET is_verified = 0, login_attempts = $login_attempts WHERE id = $id");
                    echo json_encode(["status" => -5, "usercode" => null, "message" => "Account blocked due to multiple failed login attempts."]);
                } else {
                    $conn->query("UPDATE tbl_admin SET login_attempts = $login_attempts WHERE id = $id");
                    echo json_encode(["status" => -1, "usercode" => null, "message" => "Invalid credentials. Attempt $login_attempts of 4."]);
                }
            }
        } else {
            // Email not found → log failed IP
            incrementFailedIP($conn, $ip);
            echo json_encode(["status" => -2, "usercode" => null, "message" => "User not found."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => -3, "usercode" => null, "message" => "Invalid input."]);
    }

    exit;
}

$conn->close();
?>