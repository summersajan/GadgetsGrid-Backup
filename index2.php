<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Gadget Grid</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
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
      font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
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
      height: 68px;
      width: 68px;
      border-radius: 10px;
      margin-right: 10px;
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

    /* Hero Cards */
    .hero-big-card {
      border-radius: var(--br);
      overflow: hidden;
      min-height: 520px;
      background: #ddd no-repeat center/cover;
      box-shadow: 0 8px 24px rgba(30, 41, 59, 0.08);
      position: relative;
      display: flex;
      align-items: flex-end;
      transition: transform 0.4s var(--transition),
        box-shadow 0.4s var(--transition);
    }

    .hero-big-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(30, 41, 59, 0.12);
    }

    .hero-big-card-title {
      position: absolute;
      left: 24px;
      bottom: 24px;
      color: #fff;
      font-weight: 700;
      font-size: 2rem;
      line-height: 1.2;
      letter-spacing: -0.5px;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
      max-width: 80%;
    }

    .hero-tag {
      display: inline-block;
      background: rgba(30, 41, 59, 0.8);
      color: #fff;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-bottom: 12px;
    }

    .side-card {
      border-radius: var(--br);
      overflow: hidden;
      background: #fff;
      height: 100%;
      min-height: 520px;
      display: flex;
      align-items: flex-end;
      position: relative;
      box-shadow: 0 8px 24px rgba(30, 41, 59, 0.08);
      transition: transform 0.4s var(--transition),
        box-shadow 0.4s var(--transition);
    }

    .side-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(30, 41, 59, 0.12);
    }

    .side-card-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      z-index: 1;
      left: 0;
      top: 0;
    }

    .side-card-content {
      z-index: 2;
      padding: 20px;
      background: linear-gradient(to bottom,
          rgba(0, 0, 0, 0) 0%,
          rgba(0, 0, 0, 0.7) 100%);
      color: #fff;
      width: 100%;
    }

    .side-card-tag {
      display: inline-block;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(4px);
      border-radius: 6px;
      padding: 4px 12px;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      margin-bottom: 10px;
    }

    .side-card-content h5 {
      font-size: 1.1rem;
      font-weight: 700;
      line-height: 1.4;
      margin: 0;
    }

    /* Now Trending */
    .now-trending-card {
      border-radius: var(--br);
      background: linear-gradient(135deg,
          var(--main) 0%,
          var(--main-dark) 100%);
      padding: 24px;
      color: #fff;
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.15);
      height: 100%;
      min-height: 320px;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
      transition: transform 0.4s var(--transition),
        box-shadow 0.4s var(--transition);
    }

    .now-trending-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(37, 99, 235, 0.2);
    }

    .now-trending-card::before {
      content: "";
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle,
          rgba(255, 255, 255, 0.1) 0%,
          rgba(255, 255, 255, 0) 70%);
      transform: rotate(30deg);
      pointer-events: none;
    }

    .now-trending-card .trend-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .now-trending-card h5 {
      font-weight: 700;
      font-size: 1.2rem;
      margin: 0;
    }

    .now-trending-card .view-all-link {
      color: #fff;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      opacity: 0.9;
      transition: opacity 0.2s;
      display: flex;
      align-items: center;
    }

    .now-trending-card .view-all-link:hover {
      opacity: 1;
      text-decoration: underline;
    }

    .now-trending-card .view-all-link i {
      margin-left: 4px;
      font-size: 0.8rem;
    }

    .now-trending-list {
      list-style: none;
      padding: 0;
      margin: 0;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-around;
    }



    .now-trending-list li {
      display: flex;
      align-items: flex-start;
      font-weight: 500;
      margin-bottom: 12px;
      line-height: 1.4;
      gap: 8px;
      font-size: 0.95rem;
    }

    .now-trending-list .trend-num {
      width: 28px;
      height: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #fff;
      color: var(--main);
      border-radius: 50%;
      font-weight: 700;
      margin-right: 8px;
      font-size: 0.9rem;
      flex-shrink: 0;
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
  <!-- Favicon icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
  <link rel="manifest" href="favicons/site.webmanifest">
  <link rel="icon" href="favicons/favicon.ico" type="image/x-icon">

  <!-- Android -->
  <link rel="icon" type="image/png" sizes="192x192" href="favicons/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="512x512" href="favicons/android-chrome-512x512.png">

</head>

<body>
  <!-- Header -->
  <nav class="sticky-header">
    <div class="container-lg">
      <div class="d-flex flex-column">
        <div class="d-flex align-items-center">
          <!-- Logo -->
          <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="images/logo.svg" alt="Gadget Grid logo" style="height:36px;" class="rounded-circle me-2" />
            G
          </a>
          <!-- Search -->
          <div class="search-container ms-auto" style="position:relative; display:inline-block;">
            <i class="bi bi-search search-icon"></i>
            <input class="search-bar" type="search" placeholder="Search gadgets, tech, reviews..."
              style="padding-left:125px;" />
            <span class="trending-inside-input badge bg-info text-dark"
              style="display:none; position:absolute; left:35px; top:7px; z-index:3; font-size:0.96em; cursor:pointer;">
              Trending <span class="remove-trending" style="margin-left:3px;cursor:pointer;">&times;</span>
            </span>
          </div>
        </div>

        <!-- Categories (will be loaded dynamically) -->
        <div class="header-chips-row mt-2" id="categoryChips"></div>
      </div>
    </div>
  </nav>

  <section class="top-section container-lg mt-4" id="top-section">
    <div class="row g-4 align-items-stretch">
      <!-- Large hero card -->
      <div class="col-lg-8">
        <div class="hero-big-card animate__animated animate__fadeIn h-100" id="exclusiveLaunchContainer">
          <!-- JS will render content here -->
        </div>
      </div>
      <!-- Now Trending -->
      <div class="col-lg-4">
        <div class="now-trending-card animate__animated animate__fadeIn h-100" data-aos="fade-up" data-aos-delay="300">
          <div class="trend-top d-flex justify-content-between align-items-center">
            <h5>Now Trending</h5>
            <a href="#" class="view-all-link">View All <i class="bi bi-arrow-right"></i></a>
          </div>
          <ul class="now-trending-list" id="nowTrendingList">
            <!-- JS will render list here -->
          </ul>
        </div>
      </div>
    </div>
  </section>




  <!-- Featured Section (dynamic) -->
  <section class="container-lg my-4" id="featuredSection">


  </section>

  <section class="container-lg my-4" id="trendingSection"></section>
  <!-- All Posts Section -->
  <section class="container-lg mt-5" id="allPostsSection"></section>
  <div class="d-flex justify-content-center mt-3">
    <button id="loadMoreBtn" class="btn btn-outline-primary" style="display:none;">Load More</button>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container-lg">
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="footer-logo">Gadget Grid</div>
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
            <a href="#">About Us</a>
            <a href="support@gadgetsgrid.com">Contact</a>
            <a href="#">Advertise</a>
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms</a>
            <a href="#">FAQ</a>
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


  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


  <script>
    let allCategories = [],
      allLoadedPosts = [],
      featuredPosts = [],
      trendingPosts = [],
      allTotalPosts = 0,
      nextOffset = 0;
    const POSTS_PER_PAGE = 1;

    $(function () {
      fetchAndRenderFirst();

      function fetchAndRenderFirst() {
        $.post('ajax/load_home_data.php', { offset: 0, limit: POSTS_PER_PAGE }, function (res) {
          let data = typeof res === "string" ? JSON.parse(res) : res;
          allCategories = data.categories || [];
          featuredPosts = data.featured || [];
          trendingPosts = data.trending || [];
          allLoadedPosts = data.posts || [];
          allTotalPosts = data.totalPosts || 0;
          nextOffset = allLoadedPosts.length;

          renderCategoryChips();
          renderAllFilteredSections();
          toggleLoadMore();

          console.log("All data:", data);

          // Top-section dynamic rendering
          renderTopSectionWithHomeData(data);

          $("#loadMoreBtn").off("click").on("click", function () {
            fetchPostsFromServer(nextOffset);
          });
        });
      }

      function fetchPostsFromServer(offset) {
        $.post('ajax/load_home_data.php', { offset: offset, limit: POSTS_PER_PAGE }, function (res) {
          let data = typeof res === "string" ? JSON.parse(res) : res;
          let newPosts = data.posts || [];
          allLoadedPosts = allLoadedPosts.concat(newPosts);
          nextOffset = allLoadedPosts.length;
          allTotalPosts = data.totalPosts || allTotalPosts;
          renderAllFilteredSections();
          toggleLoadMore();
        });
      }

      function fetchFilteredPosts(categoryId, searchTerm) {
        $.post('ajax/load_home_data.php', {
          filter: 1,
          categoryId: categoryId,
          search: searchTerm
        }, function (res) {
          let data = typeof res === "string" ? JSON.parse(res) : res;
          allLoadedPosts = data.posts || [];
          renderAllFilteredSections();
          $("#loadMoreBtn").hide();
        });
      }

      function renderCategoryChips() {
        let chips = `<span class="category-chip active" data-category-id="all">All Categories</span>`;
        allCategories.forEach(c =>
          chips += `<span class="category-chip" data-category-id="${c.id}">${c.category_name}</span>`
        );
        $("#categoryChips").html(chips);

        $(".category-chip").off("click").on("click", function () {
          $(".category-chip").removeClass("active");
          $(this).addClass("active");
          let catId = getActiveCategoryId();
          let search = getSearchValue();
          if (catId === 'all' && !search) {
            // Reset to default load
            fetchAndRenderFirst();
          } else {
            fetchFilteredPosts(catId, search);
          }
        });
      }

      $(".search-bar").on("input", function () {
        let catId = getActiveCategoryId();
        let search = getSearchValue();
        if (catId === 'all' && !search) {
          fetchAndRenderFirst();
        } else {
          fetchFilteredPosts(catId, search);
        }
      });

      function getActiveCategoryId() {
        return ($(".category-chip.active").data("category-id") || "all").toString();
      }

      function getSearchValue() {
        return ($(".search-bar").val() || "").toLowerCase().trim();
      }

      function filterPosts(posts) {
        let catId = getActiveCategoryId();
        let search = getSearchValue();
        return posts.filter(post => matchesCategory(post, catId) && matchesSearch(post, search));
      }

      function matchesCategory(post, categoryId) {
        if (categoryId === 'all') return true;
        return String(post.category_id) === categoryId;
      }

      function matchesSearch(post, s) {
        if (!s) return true;
        return (
          (post.title && post.title.toLowerCase().includes(s)) ||
          (post.tags && post.tags.toLowerCase().includes(s)) ||
          (post.category_name && post.category_name.toLowerCase().includes(s))
        );
      }

      function renderAllFilteredSections() {
        let isSearching = !!getSearchValue();

        // Featured
        if (!isSearching) {
          let filteredFeatured = filterPosts(featuredPosts);
          let html = `<h3 class="section-title">Featured This Week</h3><div class="row g-4">`;
          if (!filteredFeatured.length) {
            html += `<div class="col-12"><div class="alert alert-info">No featured posts.</div></div>`;
          } else {
            filteredFeatured.forEach((post, i) => html += renderPostCard(post, i));
          }
          html += `</div>`;
          $("#featuredSection").html(html);
        } else {
          $("#featuredSection").empty(); // hide section when searching
        }

        // Trending
        if (!isSearching) {
          let filteredTrending = filterPosts(trendingPosts);
          let html = `<h3 class="section-title">Trending</h3><div class="row g-4">`;
          if (!filteredTrending.length) {
            html += `<div class="col-12"><div class="alert alert-info">No trending posts.</div></div>`;
          } else {
            filteredTrending.forEach((post, i) => html += renderPostCard(post, i));
          }
          html += `</div>`;
          $("#trendingSection").html(html);
        } else {
          $("#trendingSection").empty(); // hide section when searching
        }

        // All Posts
        let filteredAll = filterPosts(allLoadedPosts.concat(featuredPosts, trendingPosts));
        let html = `<h3 class="section-title">All</h3><div class="row g-4">`;
        if (!filteredAll.length) {
          html += `<div class="col-12"><div class="alert alert-info">No product found</div></div>`;
        } else {
          filteredAll.forEach((post, i) => html += renderPostCard(post, i));
        }
        html += `</div>`;
        $("#allPostsSection").html(html);
      }

      function toggleLoadMore() {
        if (nextOffset < allTotalPosts) {
          $("#loadMoreBtn").show();
        } else {
          $("#loadMoreBtn").hide();
        }
      }

      function renderPostCard(post, i) {
        return `
    <div class="col-12 col-sm-6 col-md-3 product-row">
      <a href="post.php?id=${post.id}" class="text-decoration-none text-dark">
        <div class="product-card animate-fade-in delay-${i}" data-category-id="${post.category_id || ''}">
          <img src="${post.thumbnail ? post.thumbnail : "images/default.jpg"}" alt="${(post.title || '').replace(/"/g, '&quot;')}" />
          <div class="p-3">
            <div class="product-meta-row">
              <span class="meta" style="background:#e8f1fd;color:#5786f2">
                ${post.category_name || ''}
              </span>
            </div>
            <h6 class="card-title">${post.title}</h6>
            ${post.tags ? `<div class="mb-1">
              ${post.tags.split(',').map(tag => `<span class="badge rounded-pill bg-success me-1">${tag.trim()}</span>`).join('')}
            </div>` : ""}
            <div class="product-date"><i class="bi bi-clock"></i> ${timeAgo(post.created_at)}</div>
          </div>
        </div>
      </a>
    </div>
    `;
      }

      function timeAgo(dateStr) {
        if (!dateStr) return "";
        let diff = (new Date() - new Date(dateStr)) / (1000 * 60 * 60 * 24);
        if (diff < 1) return "Today";
        if (diff < 2) return "1 day ago";
        if (diff < 7) return Math.floor(diff) + " days ago";
        return new Date(dateStr).toLocaleDateString();
      }


      function renderTopSectionWithHomeData(data) {
        // 1. Exclusive Launch: latest post (using all arrays, removing duplicates)
        let postsArr = [].concat(
          data.posts || [],
          data.featured || [],
          data.trending || []
        );

        let seenIds = {};
        let mergedArr = [];
        postsArr.forEach(post => {
          if (post && !seenIds[post.id]) {
            mergedArr.push(post);
            seenIds[post.id] = true;
          }
        });

        // Sort all by created_at desc (newest first)
        mergedArr.sort(function (a, b) {
          return new Date(b.created_at) - new Date(a.created_at);
        });

        // Take the latest post for Exclusive Launch
        let latest = mergedArr.length > 0 ? mergedArr[0] : null;

        let exHtml;
        if (latest) {
          exHtml = `
            <span class="hero-big-card-title">
                <span class="hero-tag">EXCLUSIVE LAUNCH</span>
                ${sanitizeHTML(latest.title || "Latest Post")}
            </span>
            <a href="post.php?id=${latest.id}" class="stretched-link"></a>
            <style>
                #exclusiveLaunchContainer {
                    background-image: url('${latest.thumbnail ? latest.thumbnail : 'images/spa.jpg'}');
                    background-size:cover;
                    background-position:center;
                }
            </style>
        `;
        } else {
          exHtml = `<span class="hero-big-card-title">
            <span class="hero-tag">EXCLUSIVE LAUNCH</span>
            No Latest Post
        </span>`;
        }
        $('#exclusiveLaunchContainer').html(exHtml);

        // 2. Trending: USE data.trending DIRECTLY!
        let trendPosts = data.trending || [];
        let trendHtml = '';
        if (!trendPosts.length) {
          trendHtml = '<li><span>No trending posts.</span></li>';
        } else {
          trendPosts.slice(0, 10).forEach((post, idx) => {
            trendHtml += `
              <li>
                <span class="trend-num">${idx + 1}</span>
                <a href="post.php?id=${post.id}" class="text-decoration-none" style="color:white">${sanitizeHTML(post.title || 'Untitled')}</a>
              </li>
            `;
          });
        }
        $('#nowTrendingList').html(trendHtml);
      }

      function sanitizeHTML(str) {
        return (str || "").replace(/[&<>"']/g, function (m) {
          return { "&": "&amp;", "<": "&lt;", ">": "&gt;", "\"": "&quot;", "'": "&#39;" }[m]
        });
      }

      /* $(document).on("click", ".view-all-link", function (e) {
         e.preventDefault();
         $("#featuredSection").hide();
         $("#top-section").hide();
         $("#allPostsSection").hide();
         $("#trendingSection").show();
       });*/
      // --------- END TOP SECTION RENDER -----------

      function showTrendingInputTag() {
        $('.trending-inside-input').show();
        // Optional: visually focus input and clear its value (if you want)
        // $('.search-bar').val('');
      }
      function hideTrendingInputTag() {
        $('.trending-inside-input').hide();
      }

      // On VIEW ALL click show tag and only trending
      $(document).on("click", ".view-all-link", function (e) {
        e.preventDefault();
        $("#featuredSection").hide();
        $("#allPostsSection").hide();
        $("#top-section").hide();
        $("#trendingSection").show();
        showTrendingInputTag();
      });

      // Remove Trending chip on X click, show all sections again
      $(document).on("click", ".trending-inside-input .remove-trending", function (e) {
        e.stopPropagation();
        hideTrendingInputTag();
        $("#featuredSection").show();
        $("#allPostsSection").show();
        $("#top-section").show();

        $("#trendingSection").show();
      });

      // Also hide tag when user starts searching or changes filters
      $(".search-bar").on("input", function () {
        hideTrendingInputTag();
      });
      $(document).on("click", ".category-chip", function () {
        hideTrendingInputTag();
      });


    });
  </script>

</body>

</html>