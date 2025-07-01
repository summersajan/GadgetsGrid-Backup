<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Header with Hamburger Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        :root {
            --chips: #e3343a;
            --chips-light: #ffe3e6;
            --text-muted: #6b7280;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
        }

        .sticky-header {
            background: #fff;
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 2rem;
            letter-spacing: -1.2px;
            color: #222;
            display: flex;
            align-items: center;
            margin-right: 32px;
        }

        .navbar-brand img {
            height: 68px;
            width: 68px;
            border-radius: 2px;
            margin-right: 8px;
            transition: transform 0.3s;
        }

        .search-container {
            position: relative;
            max-width: 540px;
            width: 100%;
            margin: 0 auto;
            flex: 1 1 100%;
        }

        .search-bar {
            border-radius: 24px;
            border: 2px solid #e2e8f0;
            background: #fff;
            font-size: 17px;
            padding: 12px 20px 12px 44px;
            width: 100%;
            height: 50px;
            box-shadow: none;
        }

        .search-bar:focus {
            border-color: #e3343a;
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #969fa6;
            font-size: 1.18em;
        }

        .header-auth-btn {
            border-radius: 24px;
            font-weight: 700;
            font-size: 1em;
            border: 2px solid #e3343a;
            padding: 8px 24px;
            background: transparent;
            color: #e3343a;
            transition: all 0.2s;
        }

        .header-auth-btn.cta {
            background: #e3343a;
            color: #fff;
        }

        .header-auth-btn.cta:hover {
            background: #c5162a;
            color: #fff;
        }

        .header-auth-btn:hover {
            background: #e3343a14;
        }

        .hamburger-btn {
            background: none;
            border: none;
            color: #222;
            padding: 6px;
        }

        @media (min-width: 768px) {

            .hamburger-btn,
            .mobile-toggle-area {
                display: none !important;
            }
        }

        .mobile-toggle-area {
            background-color: #fff;
            border-top: 1px solid #eee;
        }

        .container-lg {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .d-flex {
            display: flex;
        }

        .flex-column {
            flex-direction: column;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .pb-3 {
            padding-bottom: 1rem;
        }

        .w-100 {
            width: 100%;
        }

        .d-none {
            display: none;
        }

        .d-md-flex {
            display: none;
        }

        @media (min-width: 768px) {
            .d-md-flex {
                display: flex !important;
            }
        }

        .d-md-none {
            display: block;
        }

        @media (min-width: 768px) {
            .d-md-none {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="sticky-header">
        <div class="container-lg">
            <div class="d-flex flex-column">
                <!-- Top Row -->
                <div class="d-flex align-items-center py-3 px-2">
                    <!-- Desktop Logo & Search -->
                    <a class="navbar-brand d-none d-md-flex" href="index.php">
                        <img src="images/logo.svg" alt="Gadget Grid logo" />

                    </a>

                    <div class="search-container d-none d-md-block">
                        <i class="bi bi-search search-icon"></i>
                        <input class="search-bar" type="search"
                            placeholder="Search for gadgets, reviews, tech news..." />
                    </div>

                    <!-- Desktop Buttons -->
                    <div class="d-none d-md-flex flex-wrap gap-2 justify-content-end mt-2 mt-md-0 ms-auto">
                        <button class="header-auth-btn">Contact Us</button>
                        <button class="header-auth-btn cta">Subscribe</button>
                    </div>

                    <!-- Hamburger Button (Mobile Only) -->
                    <button class="hamburger-btn d-md-none ms-auto" type="button" id="hamburgerToggle">
                        <i class="bi bi-list" style="font-size: 1.8rem;"></i>
                    </button>
                </div>

                <!-- Mobile Menu Toggle Area -->
                <div class="mobile-toggle-area d-md-none px-3 pb-3" id="mobileMenu" style="display: none;">
                    <!-- Mobile Logo -->
                    <a class="navbar-brand d-flex align-items-center mb-2" href="index.php">
                        <img src="images/logo.svg" alt="Gadget Grid logo" />

                    </a>

                    <!-- Mobile Search -->
                    <div class="search-container mb-3">
                        <i class="bi bi-search search-icon"></i>
                        <input class="search-bar" type="search"
                            placeholder="Search for gadgets, reviews, tech news..." />
                    </div>

                    <!-- Mobile Buttons -->
                    <div class="d-flex flex-column gap-2">
                        <button class="header-auth-btn w-100">Contact Us</button>
                        <button class="header-auth-btn cta w-100">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const toggleBtn = document.getElementById("hamburgerToggle");
        const mobileMenu = document.getElementById("mobileMenu");

        toggleBtn.addEventListener("click", () => {
            mobileMenu.style.display = (mobileMenu.style.display === "block") ? "none" : "block";
        });
    </script>
</body>

</html>