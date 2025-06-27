<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --main: #2563eb;
            /* More vibrant blue */
            --main-light: #dbeafe;
            /* Lighter blue */
            --main-dark: #1e40af;
            /* Darker blue */
            --gray-bg: #f8fafc;
            /* Cooler light gray */
            --dark: #1e293b;
            /* Deep slate blue for text */
            --text-muted: #64748b;
            /* Muted slate blue */
            --br: 16px;
            /* Slightly tighter border radius */
            --transition: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        body {
            background: var(--gray-bg);
            color: var(--dark);


            /* font-family: "Outfit", sans-serif; */
            font-family: "Urbanist", sans-serif;
            /*font-family: "DM Sans", sans-serif;*/
            line-height: 1.5;
        }

        /* Header */
        .sticky-header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(8px);
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.03);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            color: var(--main-dark);
            transition: transform 0.3s var(--transition);
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .navbar-brand img {
            height: 158px;
            width: 158px;
            border-radius: 2px;
            margin-right: 2px;
            transition: transform 0.3s var(--transition);
        }

        .navbar-brand:hover img {
            transform: rotate(5deg);
        }

        /* Search bar */
        .search-container {
            position: relative;
            max-width: 400px;
            margin-left: auto;
        }

        .search-bar {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #fff;
            font-size: 15px;
            padding: 12px 20px 12px 42px;
            width: 100%;
            height: 48px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: all 0.3s var(--transition);
            font-family: "Inter", sans-serif;
        }

        .search-bar:focus {
            border-color: var(--main);
            box-shadow: 0 0 0 3px var(--main-light);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        /* Categories */
        .header-chips-row {
            display: flex;
            overflow-x: auto;
            padding: 12px 0;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE/Edge */
        }

        .header-chips-row::-webkit-scrollbar {
            display: none;
            /* Chrome/Safari */
        }

        .category-chip {
            border-radius: 12px;
            background: #fff;
            color: var(--text-muted);
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            margin-right: 8px;
            border: 1px solid #e2e8f0;
            white-space: nowrap;
            transition: all 0.3s var(--transition);
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        .category-chip::before {
            content: "";
            width: 6px;
            height: 6px;
            background: var(--main);
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            vertical-align: middle;
            transition: all 0.3s var(--transition);
        }

        .category-chip.active,
        .category-chip:hover {
            border-color: var(--main);
            color: var(--main-dark);
            background: var(--main-light);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1);
        }

        .category-chip.active::before,
        .category-chip:hover::before {
            background: var(--main-dark);
            transform: scale(1.3);
        }

        /* Top Section Grid */
        .main-top-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 1024px) {
            .main-top-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .main-top-grid {
                grid-template-columns: 1fr;
            }
        }

        .detail-card {
            max-width: 1080px;
            margin: 36px auto 0;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 18px #eaefff;
            padding: 32px 36px;
        }

        .detail-gallery {
            min-width: 320px;
        }

        .main-img-view {
            height: 340px;
            width: 100%;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 2px 12px #eef4fa;
        }

        .gallery-thumbs {
            gap: 16px;
            margin-top: 16px;
        }

        .thumb-img {
            width: 110px;
            height: 76px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            border: 2px solid #fff;
            box-shadow: 0 1px 6px #f0f2f8;
            transition: border .2s;
        }

        .thumb-img.active {
            border: 2px solid #1976d2;
        }

        .badge-cat {
            background: #e6f4fe;
            color: #178ad2;
            font-size: .98em;
            margin-bottom: 6px;
        }

        .discount-badge {
            background: #fffbe5;
            color: #d59116;
            font-size: .92em;
            border: 1px solid #ffe69a;
            padding: 0.3rem 0.7rem;
            border-radius: 13px;
        }

        .price-wrap {
            font-size: 1.3rem;
            margin-top: 1.1rem;
        }

        .old-price {
            text-decoration: line-through;
            font-size: 1rem;
            color: #b5b5b5;
            margin-right: 6px;
        }

        .card-title {
            font-size: 2.06rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .meta-wrap span {
            display: inline-block;
            margin-right: 15px;
            font-weight: 500;
        }

        .product-link-btn {
            margin-top: 32px;
            font-size: 1.13em;
            font-weight: 500;
        }

        @media(max-width:900px) {
            .detail-card {
                padding: 12px 3vw;
            }
        }

        @media(max-width:600px) {
            .detail-card {
                padding: 6px 0;
            }

            .main-img-view {
                height: 210px;
            }

            .gallery-thumbs {
                gap: 5px;
            }
        }

        /* Section titles */
        .section-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin: 32px 0 24px;
            letter-spacing: -0.3px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 4px;
            background: var(--main);
            border-radius: 2px;
        }

        /* Product Cards */
        .product-card {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.05);
            overflow: hidden;
            transition: all 0.4s var(--transition);
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(30, 41, 59, 0.1);
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.4s var(--transition);
        }

        .product-card:hover img {
            transform: scale(1.03);
        }

        .product-meta-row {
            font-size: 0.85rem;
            margin: 12px 0;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .product-meta-row .meta {
            background: #f1f5f9;
            border-radius: 6px;
            padding: 4px 10px;
            color: var(--main-dark);
            font-weight: 600;
            font-size: 0.8rem;
        }

        .product-card .card-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .product-card .card-text {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--main-dark);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s var(--transition);
        }

        .product-card:hover .product-badge {
            transform: scale(1.1);
            background: #fff;
            color: var(--main);
        }

        .product-date {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 12px;
            display: flex;
            align-items: center;
        }

        .product-date i {
            margin-right: 6px;
            font-size: 0.9rem;
        }

        /* Footer */
        footer {
            margin-top: 80px;
            background: #fff;
            border-top: 1px solid #f1f5f9;
            color: var(--dark);
            padding: 48px 0 24px;
        }

        .footer-logo {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--main-dark);
            margin-bottom: 16px;
            display: inline-block;
        }

        .footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 24px;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--main-dark);
        }

        .footer-social {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
        }

        .footer-social a {
            color: var(--text-muted);
            font-size: 1.2rem;
            transition: color 0.2s, transform 0.2s;
        }

        .footer-social a:hover {
            color: var(--main-dark);
            transform: translateY(-2px);
        }

        .footer-divider {
            border-top: 1px solid #f1f5f9;
            margin: 24px 0;
        }

        .footer-copyright {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .footer-heart {
            color: #f43f5e;
            font-size: 1.1rem;
            vertical-align: middle;
            margin: 0 4px;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s var(--transition) forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        .delay-4 {
            animation-delay: 0.4s;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .main-top-grid {
                grid-template-columns: 1fr 1fr;
            }

            .now-trending-card,
            .side-card,
            .hero-big-card {
                min-height: 280px;
            }
        }

        @media (max-width: 768px) {
            .main-top-grid {
                grid-template-columns: 1fr;
            }

            .search-container {
                max-width: 100%;
                margin: 16px 0;
            }

            .section-title {
                font-size: 1.3rem;
                margin: 24px 0 16px;
            }
        }
    </style>
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
    <link rel="manifest" href="favicons/site.webmanifest">
    <link rel="icon" href="favicons/favicon.ico" type="image/x-icon">

    <!-- Android -->
    <link rel="icon" type="image/png" sizes="192x192" href="favicons/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="favicons/android-chrome-512x512.png">

</head>
<!-- Header -->
<nav class="sticky-header">
    <div class="container-lg">
        <div class="d-flex flex-column">
            <div class="d-flex align-items-center">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center" href="#" style="height:68px;">
                    <img src="images/logo.svg" alt="Gadget Grid logo" />

                </a>

                <!-- Search -->

            </div>


            <!-- Categories -->
            <div class="header-chips-row">
                <!-- Back Button -->
                <span id="backButton" class="btn btn-outline-primary" data-category-id="back">Back</span>
                &nbsp; &nbsp;
                <!-- Category Display -->
                <span id="currentCategoryName" class="category-chip active" data-category-id="all">Category Name</span>
            </div>

        </div>
    </div>
</nav>


<body style="background:#f6fafd;">

    <div class="container-xxl mt-5">
        <div id="postDetail">Loading post...</div>
    </div>
    <section class="container-lg mt-5" id="allPostsSection"></section>
    <footer>
        <div class="container-lg">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="images/logo.svg" alt="Gadget Grid logo" style="height:68px;" />

                    </a>
                    <p style="
                color: var(--text-muted);
                font-size: 0.95rem;
                line-height: 1.6;
              ">
                        Discovering and curating the most innovative gadgets and tech
                        products from around the world.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 style="font-weight: 600; margin-bottom: 16px; color: var(--dark)">
                        Quick Links
                    </h6>
                    <div class="footer-links">
                        <!-- <a href="#">About Us</a>
                        <a href="support@gadgetsgrid.com">Contact</a>
                        <a href="#">Advertise</a>
                        <a href="#">FAQ</a> -->
                        <a href="privacy.php">Privacy Policy</a>
                        <a href="terms.php">Terms</a>

                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 style="font-weight: 600; margin-bottom: 16px; color: var(--dark)">
                        Connect
                    </h6>
                    <div class="footer-social">
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-pinterest"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="footer-copyright mb-3 mb-md-0">
                    &copy; 2025 Gadget Grid. All rights reserved.
                </div>
                <div style="color: #94a3b8; font-size: 0.9rem">
                    Made with <span class="footer-heart">♥</span> by Gadget Grid Team
                </div>
            </div>
        </div>
    </footer>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    var currentPostId = getUrlParam('id');
    var currentCategoryId = null;

    // Helper: get URL param
    function getUrlParam(name) {
        let s = new URLSearchParams(window.location.search);
        return s.get(name);
    }

    // Renders the Post Detail (gallery/desc/buttons)
    function renderPostDetail(d) {

        currentPostId = d.post.id;
        currentCategoryId = d.post.category_id;
        // Gallery markup
        let gallery = `<img id="mainImgView" class="main-img-view mb-3 w-100" src="${d.images[0]}" alt="Main" />`;
        gallery += `<div class="d-flex gallery-thumbs flex-wrap">`;
        d.images.forEach((img, i) => {
            gallery += `<img src="${img}" class="thumb-img${i == 0 ? ' active' : ''}" data-img="${img}" alt="image ${i}">`;
        });
        gallery += `</div>`;

        // Detail info
        let pd = d.post;
        let badges = '';


        console.log(pd);


        $("#currentCategoryName").text(pd.category_name || "All Products");

        if (pd.category_name) badges += `<span class="badge badge-cat px-3 py-2 me-2">${pd.category_name}</span>`;
        if (pd.is_featured == 1) {
            badges += `<span class="badge bg-warning-subtle text-warning-emphasis me-2">Featured</span>`;
        }
        if (pd.is_trending == 1) {
            badges += `<span class="badge bg-danger-subtle text-danger me-2">Trending</span>`;
        }
        if (pd.status == 'draft') badges += `<span class="badge bg-secondary">Draft</span>`;

        let links = '';
        (d.product_links || []).forEach(link => {
            links += `<a class="btn btn-warning product-link-btn d-inline-flex align-items-center mb-2"
                href="${link.product_link}" target="_blank" rel="nofollow noopener">
                <i class="bi bi-cart-check me-2"></i>
                ${link.price !== null && link.price !== "" ? 'Get it for <span class="fw-bold ms-1 me-2">$' + parseFloat(link.price).toFixed(2) + '</span>' : 'Get this Product'}
            </a>`;
        });

        let prices = '';
        if (pd.price || pd.old_price) {
            prices += pd.old_price ? `<span class="old-price me-2 text-decoration-line-through">$${parseFloat(pd.old_price).toFixed(2)}</span>` : '';
            prices += pd.price ? `<span class="fw-bold text-warning-emphasis">$${parseFloat(pd.price).toFixed(2)}</span>` : '';
            if (pd.discount) prices += `<span class="discount-badge ms-2">${pd.discount} OFF</span>`;
        }

        let meta = `<span><i class="bi bi-clock"></i> ${pd.created_at.substr(0, 10)}</span>`;
        if (pd.updated_at && pd.updated_at != pd.created_at)
            meta += `<span class="ms-2">Updated ${pd.updated_at.substr(0, 10)}</span>`;

        let postHtml = `
        <div class="detail-card row gx-5 gy-4">
            <div class="col-12 col-md-6 detail-gallery">${gallery}</div>
            <div class="col-12 col-md-6">
               
                <div class="card-title mb-3">${pd.title}</div>
                 <div class="d-flex mb-2 align-items-center">${badges}</div>
                  <div class="mb-3 meta-wrap text-muted small">${meta}</div>
                ${pd.subtitle ? `<div class="mb-2" style="font-size:0.98em; color:#555; font-family:'Inter', sans-serif;">${pd.subtitle}</div>` : ''}
${pd.body ? `<div class="mb-2" style="font-size:0.90em; font-family:'Inter', sans-serif; color:#333;">${(pd.body).replace(/\n/g, "<br>")}</div>` : ''}

                ${prices ? `<div class="price-wrap mb-2">${prices}</div>` : ''}
                ${links}
            </div>
        </div>
    `;
        $('#postDetail').html(postHtml);

        // Gallery click handler
        $('.thumb-img').on('click', function () {
            $('.thumb-img').removeClass('active');
            $(this).addClass('active');
            $('#mainImgView').attr('src', $(this).attr('data-img'));
        });
    }

    // Render related posts
    function renderPosts(posts) {
        let html = `<h3 class="section-title">Related Products</h3><div class="row g-4">`;
        posts.forEach(post => {
            html += `<div class="col-12 col-sm-6 col-md-3 product-row">
            <div class="card h-100">
                <img src="${post.thumbnail || 'images/default.jpg'}" class="card-img-top" alt="${post.title.replace(/"/g, '&quot;')}" />
                <div class="card-body">
                    <h6 class="card-title">${post.title}</h6>
                    <div class="product-date text-muted small"><i class="bi bi-clock"></i> ${post.created_at.substr(0, 10)}</div>
                    <a href="?id=${post.id}" class="btn btn-outline-primary btn-sm mt-2 w-100">View</a>
                </div>
            </div>
        </div>`;
        });
        html += `</div>`;
        $("#allPostsSection").html(html);
    }

    function renderPosts(posts) {

        let html = `<h3 class="section-title">Related Product</h3><div class="row g-4">`;

        if (posts.length === 0) {
            html += `<div class="col-12"><div class="alert alert-info">No product found</div></div>`;
        } else {
            posts.forEach((post, i) => {
                html += `
                <div class="col-12 col-sm-6 col-md-3 product-row">
                    <a class="text-decoration-none text-dark" href="?id=${post.id}">
                        <div class="product-card animate-fade-in delay-${i}" data-category-id="${post.category_id}">
                            <img src="${post.thumbnail || "images/default.jpg"}" alt="${post.title.replace(/"/g, '&quot;')}" />
                            <div class="p-3">
                                <h6 class="card-title">${post.title}</h6>
                                <div class="product-date"><i class="bi bi-clock"></i> ${timeAgo(post.created_at)}</div>
                            </div>
                        </div>
                    </a>
                </div>
            `;
            });
        }


        html += `</div>`;
        $("#allPostsSection").html(html);
    }
    function timeAgo(dateStr) {
        if (!dateStr) return "";
        let diff = (new Date() - new Date(dateStr)) / (1000 * 60 * 60 * 24);
        if (diff < 1) return "Today";
        if (diff < 2) return "1 day ago";
        if (diff < 7) return Math.floor(diff) + " days ago";
        return new Date(dateStr).toLocaleDateString();
    }


    // LOAD main post via AJAX
    function loadMainPost() {
        $('#postDetail').html('Loading...');
        $.post('ajax/post_api.php', {
            action: 'post',
            id: currentPostId
        }, function (resp) {
            if (resp && resp.post)
                renderPostDetail(resp);
            // load related posts
            loadPosts(resp.post.category_id, resp.post.id)
        }, 'json');
    }
    // LOAD related/other posts (by category, excluding current!)
    function loadPosts(categoryId, excludeId) {
        $.post('ajax/post_api.php', {
            action: 'posts',
            categoryId: categoryId || 'all',
            limit: 8
        }, function (resp) {
            if (resp && resp.posts) {
                let filtered = excludeId ? resp.posts.filter(p => p.id != excludeId) : resp.posts;
                renderPosts(filtered);
            }
        }, 'json');
    }
    // INIT
    $(function () {
        if (!currentPostId) {
            $('#postDetail').html('<div class="alert alert-danger">No post selected! Add <code>?id=XX</code> to URL.</div>');
            return;
        }
        loadMainPost();
    });
    $("#backButton").on("click", function () {
        window.history.back();

    });
</script>

</html>