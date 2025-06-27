<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <style>
        body {
            background: #f4f6fa;
        }

        .side-nav {
            background: linear-gradient(120deg, #1f80e0, #41dedf 96%);
            color: #fff;
            min-height: 100vh;
            padding-top: 32px;
            transition: transform 0.3s ease-in-out;
        }

        .side-nav .nav-link {
            color: #dbeefe;
            font-size: 1.06rem;
            border-radius: 6px;
            margin: 4px 0;
            padding: 10px 20px;
            transition: all .17s;
        }

        .side-nav .nav-link.active,
        .side-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.13);
            color: #fff;
        }

        .side-nav .nav-link.logout {
            color: #f8d7da !important;
        }

        .main-content {
            margin-left: 220px;
            padding: 35px;
        }

        @media (max-width: 900px) {
            .side-nav {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                width: 220px;
                height: 100vh;
                z-index: 1050;
            }

            .side-nav.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 18px;
            }
        }

        .admin-header {
            padding: 0px 30px 15px 0;
            background: none;
        }
    </style>
</head>

<script>
    fetch('ajax/check_session.php')
        .then(response => response.json())
        .then(data => {
            if (data.status !== 'authorized') {
                window.location.href = 'admin_login.php';
            }
        })
        .catch(error => {
            console.error('Session check failed:', error);
            window.location.href = 'admin_login.php';
        });
</script>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="side-nav d-flex flex-column p-3 position-fixed" style="width:220px;min-width:180px;">
            <!-- Close button (visible only on mobile) -->
            <button id="closeSidebar" class="btn btn-outline-light d-lg-none align-self-end mb-3">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="h4 fw-bold mb-4">
                <i class="bi bi-shield-lock"></i> Admin Panel
            </div>

            <ul class="nav nav-pills flex-column gap-1 mb-auto">
                <li><a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? ' active' : ''; ?>"
                        href="index.php"><i class="bi bi-newspaper me-2"></i>Posts</a></li>
                <li><a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'manage_categories.php' ? ' active' : ''; ?>"
                        href="manage_categories.php"><i class="bi bi-tags me-2"></i>Categories</a></li>
                <li><a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'manage_images.php' ? ' active' : ''; ?>"
                        href="manage_images.php"><i class="bi bi-image me-2"></i>Images</a></li>
                <li><a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'manage_product_link.php' ? ' active' : ''; ?>"
                        href="manage_product_link.php"><i class="bi bi-image me-2"></i>Product Links</a></li>
                <li class="mt-4">
                    <a class="nav-link logout fw-semibold" href="ajax/logout.php"><i
                            class="bi bi-box-arrow-right me-2"></i>Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <div class="flex-grow-1 main-content">
            <header class="admin-header d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <!-- Hamburger menu for small screens -->
                    <button id="toggleSidebar" class="btn btn-outline-secondary d-lg-none">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="h5 fw-semibold m-0">Admin Panel</div>
                </div>
            </header>