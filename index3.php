<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Gadgets Grid - Discover Innovative Tech & Smart Gadgets</title>
  <meta name="description"
    content="Explore the latest smart gadgets, health devices, audio tech, and trending tech products on Gadgets Grid. Curated reviews and product highlights updated weekly." />
  <meta name="keywords"
    content="gadgets, smart gadgets, tech news, health devices, trending tech, gadget reviews, technology blog, smart home, wearables" />
  <meta name="author" content="Gadget Grid Team" />
  <meta name="robots" content="index, follow" />

  <!-- Canonical URL -->
  <link rel="canonical" href="https://gadgetsgrid.com/" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://gadgetsgrid.com/" />
  <meta property="og:title" content="Gadgets Grid - Discover Innovative Tech & Smart Gadgets" />
  <meta property="og:description"
    content="Curated list of smart and trending gadgets including health, wearables, audio tech, and more." />
  <meta property="og:image" content="https://gadgetsgrid.com/favicons/fav.jpeg" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Gadgets Grid - Discover Innovative Tech & Smart Gadgets" />
  <meta name="twitter:description"
    content="Explore health gadgets, smart home tech, trending accessories, and expert reviews on Gadgets Grid." />
  <meta name="twitter:image" content="https://gadgetsgrid.com/favicons/fav.jpeg" />

  <!-- Favicon -->
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
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
      line-height: 1.6;
    }


    /* Header */
    .sticky-header {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(8px);
      box-shadow: 0 1px 15px rgba(0, 0, 0, 0.03);
      padding: 2px 0;
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
      font-family: "Poppins", "Segoe UI", Roboto, sans-serif;
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
      padding: 2px 0;
      scrollbar-width: none;

      -ms-overflow-style: none;

    }

    .header-chips-row::-webkit-scrollbar {
      display: none;

    }

    .category-chip-scroll,

    #categoryChips {

      display: flex;

      overflow-x: auto;

      -webkit-overflow-scrolling: touch;

      scroll-snap-type: x proximity;

      gap: .5rem;

      padding-bottom: 4px;

    }

    .category-chip-scroll::-webkit-scrollbar,
    #categoryChips::-webkit-scrollbar {

      height: 4px;

    }

    .category-chip-scroll::-webkit-scrollbar-track,
    #categoryChips::-webkit-scrollbar-track {
      background: transparent;

    }

    .category-chip-scroll::-webkit-scrollbar-thumb,
    #categoryChips::-webkit-scrollbar-thumb {
      background: rgba(0, 0, 0, .35);

      border-radius: 2px;
    }


    .category-chip-scroll,
    #categoryChips {
      scrollbar-width: thin;

      scrollbar-color: rgba(0, 0, 0, .35) transparent;
    }


    @media (hover: none) {

      .category-chip-scroll::-webkit-scrollbar-thumb,
      #categoryChips::-webkit-scrollbar-thumb {
        visibility: visible;
      }
    }

    .category-chip {
      position: relative;
      scroll-snap-align: start;
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
      overflow: hidden;

      flex: 0 0 auto;
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

    .category-chip.clicked {
      transform: scale(0.95);
    }

    .category-chip.active::before,
    .category-chip:hover::before {
      background: var(--main-dark);
      transform: scale(1.3);
    }

    .category-chip::after {
      content: '';
      position: absolute;
      top: var(--ripple-y, 50%);
      left: var(--ripple-x, 50%);
      transform: translate(-50%, -50%) scale(0);

      width: 100px;
      height: 100px;
      background: rgba(0, 0, 0, 0.1);
      border-radius: 50%;
      opacity: 0;
      pointer-events: none;
      transition: transform 0.4s ease, opacity 0.8s ease;
    }

    .category-chip.ripple::after {
      transform: translate(-50%, -50%) scale(2.5);
      opacity: 1;
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

    /* ============================= */
    /*         Now Trending Card     */
    /* ============================= */
    .now-trending-card {
      border-radius: var(--br);
      background: linear-gradient(135deg, var(--main) 0%, var(--main-dark) 100%);
      padding: 24px;
      color: #fff;
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.15);
      height: 100%;
      min-height: 320px;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
      transition: transform 0.4s var(--transition), box-shadow 0.4s var(--transition);
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
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
      transform: rotate(30deg);
      pointer-events: none;
    }

    /* ============================= */
    /*         Header Section        */
    /* ============================= */
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

    /* ============================= */
    /*       Trending List Items     */
    /* ============================= */
    .now-trending-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: block;
    }

    .now-trending-list li {
      margin-bottom: 0.75rem;
    }

    .now-trending-list li a {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      color: #fff;
      text-decoration: none;
      padding: 0.4rem 0.75rem;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .now-trending-list li a:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    /* radial light effect */
    .now-trending-list li a::before {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: inherit;
      background: radial-gradient(circle at 0% 50%, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
      transform: scaleX(0);
      transform-origin: 0% 50%;
      transition: transform 0.35s var(--transition);
      z-index: 0;
      pointer-events: none;
    }

    .now-trending-list li a:hover {
      background: rgba(255, 255, 255, 0.1);
      transform: translateX(6px);
    }

    .now-trending-list li a:hover::before {
      transform: scaleX(1);
    }

    /* optional: animate chevron/icon */
    .now-trending-list li a i {
      transition: transform 0.35s var(--transition);
      z-index: 1;
    }

    .now-trending-list li a:hover i {
      transform: translateX(2px) rotate(15deg);
    }

    /* numbered circle */
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
  <link rel="icon" type="image/png" sizes="32x32" href="favicons/fav.jpeg">
  <link rel="icon" type="image/png" sizes="16x16" href="favicons/fav.jpeg">
  <link rel="manifest" href="favicons/site.webmanifest">
  <link rel="icon" href="favicons/favicon.ico" type="image/x-icon">

  <!-- Android -->
  <link rel="icon" type="image/png" sizes="192x192" href="favicons/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="512x512" href="favicons/android-chrome-512x512.png">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">




</head>


<!-- Header -->
<nav class="sticky-header">
  <div class="container-lg">
    <div class="d-flex flex-column">
      <div class="d-flex align-items-center">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="images/logo.svg" alt="Gadget Grid logo" style="height:68px;" />

        </a>
        <!-- Search -->
        <div class="search-container ms-auto">
          <i class="bi bi-search search-icon"></i>
          <input class="search-bar" type="search" placeholder="Search gadgets, tech, reviews..." />
        </div>
      </div>

      <!-- Categories (will be loaded dynamically) -->

      <div class="category-chip-scroll">
        <div class="header-chips-row mt-2" id="categoryChips"></div>
      </div>

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

<section class="container-lg" id="categoryImage" style="margin-top: -8px; ">
</section>



<!-- Featured Section (dynamic) -->
<section class="container-lg my-4" id="featuredSection">


</section>


<div id="searchTagBar" style="margin-bottom: 0.5rem"></div>

<section class="container-lg my-4" id="trendingSection">

</section>
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


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



<script>
  let allCategories = [],
    featuredPosts = [],
    trendingPosts = [],
    allLoadedPosts = [],
    nowTrendingPosts = [],
    heroPost = null,
    activeCategory = null,
    totalFeatured = 0,
    totalTrending = 0,
    totalAllPosts = 0,
    featuredOffset = 0, trendingOffset = 0, allOffset = 0,
    sectionViewMode = "all";
  currentSearch = '';

  const FEATURED_PAGE_SIZE = 4, TRENDING_PAGE_SIZE = 4, ALL_PAGE_SIZE = 4;

  $(function () {
    fetchAndRenderAll();

    function fetchAndRenderAll() {
      $.post('ajax/load_index_data.php', {
        featuredOffset: 0,
        trendingOffset: 0,
        allOffset: 0,
        featuredLimit: FEATURED_PAGE_SIZE,
        trendingLimit: TRENDING_PAGE_SIZE,
        allLimit: ALL_PAGE_SIZE,
        showSection: sectionViewMode,
        categoryId: getActiveCategoryId(),
        search: currentSearch
      }, function (res) {
        let data = typeof res === "string" ? JSON.parse(res) : res;

        allCategories = data.categories || [];
        heroPost = data.hero || null;
        featuredPosts = data.featured || [];
        trendingPosts = data.trending || [];
        allLoadedPosts = data.posts || [];
        nowTrendingPosts = data.nowTrending || [];
        totalFeatured = data.totalFeatured || 0;
        totalTrending = data.totalTrending || 0;
        totalAllPosts = data.totalPosts || 0;
        featuredOffset = featuredPosts.length;
        trendingOffset = trendingPosts.length;
        allOffset = allLoadedPosts.length;

        activeCategory = getActiveCategory();




        renderTagAboveMain();
        renderCategoryChips();
        renderHeroCardOrCategoryBanner();
        renderNowTrendingSidebar();
        renderSections();
      });
    }

    function fetchAndRenderAll1() {
      $.post('ajax/load_index_data.php', {
        featuredOffset: 0,
        trendingOffset: 0,
        allOffset: 0,
        featuredLimit: FEATURED_PAGE_SIZE,
        trendingLimit: TRENDING_PAGE_SIZE,
        allLimit: ALL_PAGE_SIZE,
        showSection: sectionViewMode,
        categoryId: getActiveCategoryId(),
        search: currentSearch
      }, function (res) {
        let data = typeof res === "string" ? JSON.parse(res) : res;

        allCategories = data.categories || [];
        heroPost = data.hero || null;
        featuredPosts = data.featured || [];
        trendingPosts = data.trending || [];
        allLoadedPosts = data.posts || [];
        nowTrendingPosts = data.nowTrending || [];
        totalFeatured = data.totalFeatured || 0;
        totalTrending = data.totalTrending || 0;
        totalAllPosts = data.totalPosts || 0;
        featuredOffset = featuredPosts.length;
        trendingOffset = trendingPosts.length;
        allOffset = allLoadedPosts.length;

        activeCategory = getActiveCategory();




        renderTagAboveMain();
        renderCategoryChips();
        renderHeroCardOrCategoryBanner();
        renderNowTrendingSidebar();
        renderSections();
        $("#top-section").hide();
      });
    }




    function renderTagAboveMain() {
      let html = "";
      if (sectionViewMode === "search" && currentSearch) {
        html = `<div style="background:#e1f3fb;color:#298CB9;font-weight:600;font-size:1rem;
                     margin-bottom:11px;padding:12px 26px;border-radius:12px;display:flex;align-items:center;">
                        Search: <span style="font-weight:bold;margin-left:4px">${escapeHtml(currentSearch)}</span>
                        <button class="btn btn-link btn-sm ps-2 ms-2" style="color:#155986;font-size:1.2rem;" id="clearSearchBtn" aria-label="Close">&#10006;</button>
                    </div>`;
      }
      if (sectionViewMode === "trending") {
        html = `<div style="background:#e4eefd;color:#3879b6;font-weight:600;font-size:1rem;
                        margin-bottom:11px;padding:12px 26px;border-radius:12px;display:flex;align-items:center;">
                        Trending
                        <button class="btn btn-link btn-sm ps-2 ms-2" style="color:#205386;font-size:1.2rem;" id="clearTrendingBtn" aria-label="Close">&#10006;</button>
                    </div>`;
      }
      $("#searchTagBar").html(html);

      $("#clearSearchBtn").off("click").on("click", function () {
        $(".search-bar").val("");
        currentSearch = "";
        sectionViewMode = "all";
        fetchAndRenderAll();
      });
      $("#clearTrendingBtn").off("click").on("click", function () {
        sectionViewMode = "all";
        currentSearch = "";
        fetchAndRenderAll();
      });
    }

    function reloadSection(section) {
      let opts = {
        featuredOffset,
        trendingOffset,
        allOffset,
        featuredLimit: FEATURED_PAGE_SIZE,
        trendingLimit: TRENDING_PAGE_SIZE,
        allLimit: ALL_PAGE_SIZE,
        showSection: section,
        categoryId: getActiveCategoryId(),
        search: currentSearch
      };
      if (section === 'trending') opts.trendingOffset = trendingOffset;
      if (section === 'featured') opts.featuredOffset = featuredOffset;
      if (section === 'all') opts.allOffset = allOffset;
      $.post('ajax/load_index_data.php', opts, function (res) {
        let data = typeof res === "string" ? JSON.parse(res) : res;
        if (section === 'featured') {
          featuredPosts = featuredPosts.concat(data.featured || []);
          featuredOffset = featuredPosts.length;
          totalFeatured = data.totalFeatured;
          renderFeaturedSection();
        }
        else if (section === 'trending') {
          trendingPosts = trendingPosts.concat(data.trending || []);
          trendingOffset = trendingPosts.length;
          totalTrending = data.totalTrending;
          renderTrendingSection();
        }
        else if (section === 'all') {
          allLoadedPosts = allLoadedPosts.concat(data.posts || []);
          allOffset = allLoadedPosts.length;
          totalAllPosts = data.totalPosts;
          renderAllPostsSection();
        }
      });
    }


    let currentCategoryId = "all"; // default

    function renderCategoryChips() {
      let chips = `<span class="category-chip" data-category-id="all">All Categories</span>`;
      allCategories.forEach(c =>
        chips += `<span class="category-chip" data-category-id="${c.id}">${c.category_name}</span>`
      );
      $("#categoryChips").html(chips);

      // Apply "active" class based on selected category
      $(".category-chip").removeClass("active");
      $(`.category-chip[data-category-id='${currentCategoryId}']`).addClass("active");




      $(".category-chip").off("click").on("click", function (e) {
        let $this = $(this);

        // Ripple effect
        let offset = $this.offset();
        let x = e.pageX - offset.left;
        let y = e.pageY - offset.top;

        $this.css('--ripple-x', `${x}px`);
        $this.css('--ripple-y', `${y}px`);
        $this.addClass('ripple');

        setTimeout(() => $this.removeClass('ripple'), 400); // remove after animation

        // Active logic
        let catid = $this.data("category-id").toString();
        currentCategoryId = catid;
        $(".category-chip").removeClass("active");
        $this.addClass("active");

        sectionViewMode = 'all';
        featuredOffset = trendingOffset = allOffset = 0;
        featuredPosts = [];
        trendingPosts = [];
        allLoadedPosts = [];
        currentSearch = '';
        $(".search-bar").val("");

        fetchAndRenderAll();
      });


    }




    function getActiveCategoryId() {
      return ($(".category-chip.active").data("category-id") || "all").toString();
    }
    function getActiveCategory() {
      const catId = getActiveCategoryId();
      if (catId === 'all') return null;
      return allCategories.find(c => c.id == catId) || null;
    }

    // SEARCH
    $(".search-bar").on("input", function () {
      let val = ($(this).val() || "").trim();
      console.log(val);
      if (!val) {
        currentSearch = '';
        sectionViewMode = 'all';
        fetchAndRenderAll();
      } else {
        currentSearch = val;
        sectionViewMode = "all";
        featuredPosts = [];
        trendingPosts = [];
        allLoadedPosts = [];
        featuredOffset = trendingOffset = allOffset = 0;

        fetchAndRenderAll1();

      }
    });


    function renderHeroCard() {
      if (!heroPost) return;

      let exHtml;
      if (heroPost) {
        exHtml = `
            <span class="hero-big-card-title">
                <span class="hero-tag">EXCLUSIVE LAUNCH</span>
                ${escapeHtml(heroPost.title || "Latest Post")}
            </span>
            <a href="post.php?id=${heroPost.id}" class="stretched-link"></a>
            <style>
        #exclusiveLaunchContainer {
    background-image: url('${heroPost.thumbnail ? heroPost.thumbnail : "images/spa.jpg"}');
    background-size: cover; /* Fills width & height */
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    height: 500px; /* or whatever height you want */
}


            </style>
        `;
      } else {
        exHtml = `<span class="hero-big-card-title">
            <span class="hero-tag">EXCLUSIVE LAUNCH</span>
            No Latest Post
        </span>`;
      }

      $("#exclusiveLaunchContainer").html(exHtml);






    }



    function renderHeroCardOrCategoryBanner() {
      if (sectionViewMode === "search" || sectionViewMode === "trending") {
        $("#exclusiveLaunchContainer").hide();
        $("#categoryImage").hide();
        $(".now-trending-card").hide();
        $("#top-section").hide();
        return;
      }

      $("#top-section").show();

      if (activeCategory) {
        let image = activeCategory.category_image ? activeCategory.category_image : "category/default-category.jpg";

        let html = `<div style="height:400px; position:relative; border-radius:12px; overflow:hidden; box-shadow:0 5px 18px rgba(0,0,0,0.08);">
   <img src="category/${image}" style="width:100%; height:100%; margin:auto;">
    <div style="position:absolute; left:0; bottom:0; padding:28px 38px; color:#fff; font-size:2.2rem; background:linear-gradient(to top,rgba(0,0,0,0.60) 65%,rgba(0,0,0,0.05)); border-radius:0 0 12px 12px; font-weight:700;">
        ${activeCategory.category_name}
    </div>
</div>`;

        $("#exclusiveLaunchContainer").hide();
        $(".now-trending-card").hide();
        $("#categoryImage").show().html(html);
      } else {
        renderHeroCard();
        $("#exclusiveLaunchContainer").show();
        $(".now-trending-card").show();
        $("#categoryImage").hide();
      }
    }



    // Now Trending sidebar
    function renderNowTrendingSidebar() {
      if (activeCategory || sectionViewMode === "search" || sectionViewMode === "trending") {
        $("#nowTrendingList").empty();
        return;
      }
      if (!nowTrendingPosts.length) {
        $("#nowTrendingList").html(`<li>No trending products.</li>`);
        return;
      }
      let html = '';
      nowTrendingPosts.forEach((post, i) => {
        html += `<li>
                <span class="trend-num">${i + 1}</span>
                <a href="post.php?id=${post.id}" style="text-decoration:none;color:inherit">${(post.title ? post.title : '').substring(0, 38) + (post.title.length > 38 ? '...' : '')}</a>
            </li>`;
      });
      $("#nowTrendingList").html(html);

      $('.view-all-link').off('click').on('click', function (e) {
        e.preventDefault();
        sectionViewMode = 'trending';
        featuredPosts = []; trendingPosts = []; allLoadedPosts = [];
        featuredOffset = trendingOffset = allOffset = 0;
        $(".search-bar").val("");
        fetchAndRenderAll();
      });
    }

    function renderSections() {
      if (sectionViewMode === "trending") {
        $("#featuredSection").hide();
        $("#allPostsSection").hide();
        $("#top-section").hide();
        renderTrendingSection();
      } else if (sectionViewMode === "search") {
        $("#featuredSection").hide();
        $("#trendingSection").hide();
        $("#allPostsSection").show();
        renderAllPostsSection();
      } else {
        renderFeaturedSection();
        renderTrendingSection();
        renderAllPostsSection();
      }
    }

    function renderFeaturedSection() {
      if (!featuredPosts.length) {
        $("#featuredSection").hide();
        return;
      }
      let html = `<h3 class="section-title">Featured This Week</h3><div class="row g-4">`;
      featuredPosts.forEach((post, i) => html += renderPostCard(post, i));
      html += `</div>
            <div class="d-flex justify-content-center my-2">
                <button id="featuredLoadMoreBtn" class="btn btn-outline-primary" ${featuredOffset >= totalFeatured ? "style='display:none'" : ""}>Load More</button>
            </div>`;
      $("#featuredSection").html(html).show();

      $("#featuredLoadMoreBtn").off("click").on("click", function () {
        reloadSection('featured');
      });
    }
    function renderTrendingSection() {
      if (!trendingPosts.length) {
        $("#trendingSection").hide();
        return;
      }
      let html = `<h3 class="section-title">Trending</h3><div class="row g-4">`;
      trendingPosts.forEach((post, i) => html += renderPostCard(post, i));
      html += `</div>
        <div class="d-flex justify-content-center my-2">
            <button id="trendingLoadMoreBtn" class="btn btn-outline-primary" ${trendingOffset >= totalTrending ? "style='display:none'" : ""}>Load More</button>
        </div>`;
      $("#trendingSection").html(html).show();

      $("#trendingLoadMoreBtn").off("click").on("click", function () {
        reloadSection('trending');
      });
    }
    function renderAllPostsSection() {
      if (!allLoadedPosts.length) {
        $("#allPostsSection").hide();
        return;
      }
      let title = (activeCategory ? (activeCategory.category_name + " Products") : (sectionViewMode === "search" ? "Search Results" : "All"));
      let html = `<h3 class="section-title">${title}</h3><div class="row g-4">`;
      allLoadedPosts.forEach((post, i) => html += renderPostCard(post, i));
      html += `</div>
        <div class="d-flex justify-content-center my-2">
            <button id="allLoadMoreBtn" class="btn btn-outline-primary" ${allOffset >= totalAllPosts ? "style='display:none'" : ""}>Load More</button>
        </div>`;
      $("#allPostsSection").html(html).show();

      $("#allLoadMoreBtn").off("click").on("click", function () {
        reloadSection('all');
      });
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
    function escapeHtml(s) {
      return (s || "").replace(/[<>"'&]/g, c => ({
        '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;', '&': '&amp;'
      }[c]));
    }
    function timeAgo(dateStr) {
      if (!dateStr) return "";
      let diff = (new Date() - new Date(dateStr)) / (1000 * 60 * 60 * 24);
      if (diff < 1) return "Today";
      if (diff < 2) return "1 day ago";
      if (diff < 7) return Math.floor(diff) + " days ago";
      return new Date(dateStr).toLocaleDateString();
    }
  });
  window.addEventListener('pageshow', function (event) {
    if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
      // Clear the search bar
      const searchInput = document.querySelector('.search-bar');
      if (searchInput) {
        searchInput.value = '';
      }

    }
  });
</script>

</body>

</html>