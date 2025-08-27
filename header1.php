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

            --chips: #e11d48;

            --chips-light: #fef2f2;
        }

        body {


            color: var(--dark);
            /* font-family: "Outfit", sans-serif; */
            font-family: "Urbanist", sans-serif;
            /*font-family: "DM Sans", sans-serif;*/
            line-height: 1.6;
            background: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
            border: 1px solid #eee;
            margin: 10px 10px 0 10px;
        }


        .sticky-header {
            background: #f8f9fa;
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;

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

        .navbar-brand .brand-red {
            color: #e3343a;
            font-weight: 900;
            margin-left: -6px;
        }

        .navbar-brand img {
            height: 158px;
            width: 158px;
            border-radius: 2px;
            margin-right: 2px;
            transition: transform 0.3s var(--transition);
        }

        .search-container {
            position: relative;
            max-width: 540px;
            width: 100%;
            margin: 0 auto;
            /* centers the container */
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
            font-family: "Poppins", "Segoe UI", Roboto, sans-serif;
            transition: border-color 0.22s;
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

        /* Auth Buttons */
        .header-auth-btn {
            border-radius: 24px;
            font-weight: 700;
            font-size: 1em;
            border: 2px solid #e3343a;
            padding: 8px 24px;
            margin-left: 12px;
            background: transparent;
            color: #e3343a;
            transition: all 0.2s;
        }

        .header-auth-btn.cta {
            background: #e3343a;
            color: #fff;
            border-color: #e3343a;
        }

        .header-auth-btn.cta:hover {
            background: #c5162a;
            color: #fff;
        }

        .header-auth-btn:hover {
            background: #e3343a14;
        }

        :root {
            --chips: #fb3958;
            /* Example primary color for active */
            --text-muted: #6B7280;
            /* Muted text/icon color */
        }

        .category-chip-scroll {
            display: flex;
            flex-direction: row;
            align-items: center;
            overflow-x: auto;
            overflow-y: visible;
            border-bottom: 2px solid #f3f4f6;
            border-top: 2px solid #f3f4f6;
            -webkit-overflow-scrolling: touch;
            touch-action: pan-x;
            overscroll-behavior-x: contain;

            /* Hide scrollbars by default */
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        .category-chip-scroll::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .header-chips-row {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0.5rem;
            width: max-content;
            /* prevent chips wrapping on small containers */
            flex-wrap: nowrap;
            margin: 0;
        }

        /* Style for buttons/chips */
        .category-chip {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 0;
            background: transparent;
            color: #374151;
            padding: 0 22px;
            font-size: 15px;
            font-weight: 270;
            margin: 0;
            border: none;
            border-bottom: 3px solid transparent;
            border-top: 3px solid transparent;
            height: 53px;
            flex: 0 0 auto;
            min-width: 60px;
            max-width: 190px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
            transition: background .22s, color .22s, border-bottom .22s;
            box-sizing: border-box;
        }

        .category-chip .cat-icon {
            width: 21px;
            height: 21px;
            color: var(--text-muted);
            flex-shrink: 0;
            opacity: 0.92;
            display: flex;
            align-items: center;
        }

        .category-chip.active,
        .category-chip:hover {
            color: var(--chips);
            background: rgba(251, 233, 236, 0.30);
            border-bottom: 3px solid var(--chips);
        }

        .category-chip.active .cat-icon,
        .category-chip:hover .cat-icon {
            color: var(--chips);
        }

        .category-chip:not([data-category-id="all"]).active,
        .category-chip:not([data-category-id="all"]):hover {
            font-weight: 600;
        }

        .category-chip::before,
        .category-chip::after {
            display: none !important;
        }

        /* Tablet breakpoint */
        @media (max-width: 900px) {
            .category-chip {
                font-size: 14px;
                min-width: 70px;
                max-width: 100px;
                padding: 0 13px;
            }

            .header-chips-row {
                gap: .3rem;
            }
        }

        /* Mobile: shrink chips, show bottom scrollbar visually */
        @media (max-width: 600px) {
            .category-chip {
                font-size: 13px;
                min-width: 60px;
                max-width: 92px;
                padding: 0 9px;
            }

            .header-chips-row {
                gap: .15rem;
            }

            .category-chip-scroll {
                scrollbar-width: thin;
                /* Firefox */
                scrollbar-color: #dedede #f9fafb;
                /* Thumb/track */
            }

            .category-chip-scroll::-webkit-scrollbar {
                display: block;
                height: 6px;
                /* Show thin bottom scrollbar */
                background: #f9fafb;
            }

            .category-chip-scroll::-webkit-scrollbar-thumb {
                background: #dedede;
                border-radius: 3px;
            }

            .category-chip-scroll::-webkit-scrollbar-track {
                background: #f9fafb;
            }
        }

        @media (min-width: 1140px) {
            .category-chip-scroll {
                justify-content: center;
            }

            .header-chips-row {
                width: auto;
                margin: 0 auto;
                justify-content: center;
            }
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

        @media (max-width: 768px) {
            .sticky-header .d-flex.align-items-center {
                flex-direction: column;
                align-items: flex-start;
                padding: 1em;
            }

            .navbar-brand img {
                height: 158px;
                width: 158px;
                margin-bottom: 12px;
            }

            .search-container {
                width: 100%;
                margin: 12px 0;
            }

            .search-bar {
                height: 44px;
                font-size: 15px;
            }

            .header-auth-btn {
                width: 100%;
                text-align: center;
                margin: 8px 0 0 0;
                padding: 10px;
                font-size: 0.95em;
            }

            .header-auth-btn.cta {
                margin-top: 8px;
            }


        }

        @media (max-width: 768px) {
            .sticky-header .d-flex.align-items-center {
                justify-content: center;
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

        /* Hover effect */
        .now-trending-list li:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Adjust as needed */
            transform: translateX(4px);
        }


        .now-trending-list li {
            display: flex;
            align-items: flex-start;
            font-weight: 500;
            margin-bottom: 12px;
            line-height: 1.4;
            gap: 8px;
            font-size: 0.95rem;
            padding: 6px 10px;
            border-radius: 6px;
            transition: background-color 0.3s ease-out, transform 0.3s ease-out;
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

        .detail-card {
            max-width: 100%;
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
            margin: 8px 0 24px;
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
            margin-top: -14px;
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

        @media (max-width: 767px) {
            #logo-div {
                display: none !important;
            }

            #logo-div1 {
                display: flex !important;
            }


            #btn-contact {
                display: none !important;
            }
        }

        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (max-width: 767px) {
            .footer-links {
                align-items: center;
                justify-content: center;
            }

            .footer-social {
                justify-content: center !important;
            }

            .footer-social a {
                font-size: 1.4rem;
            }

            footer {
                padding: 32px 16px;
                text-align: center;
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

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">




</head>


<!-- Header -->
<nav class="sticky-header">
    <div class="container-lg">



        <div class="d-flex flex-column">
            <div class="d-flex align-items-center py-3 px-2" style="background : #fafafb">
                <!-- Logo: text, not image -->
                <a class="navbar-brand d-flex align-items-center" id="logo-div" href="/" style="margin-left: 20px;">
                    <img src="images/logo.svg" alt="Gadget Grid logo" style="height:68px;" />
                </a>
                <!-- Search Bar -->

                <a class="align-items-center" id="logo-div1" href="/" style="display:none;">
                    <img src="images/logo.svg" alt="Gadget Grid logo" />

                </a>
                <div class="search-container">

                </div>

                <div class="d-flex flex-wrap gap-2 justify-content-end mt-2 mt-md-0" id="btn-contact">
                    <button class="header-auth-btn">Contact Us</button>
                    <button class="header-auth-btn cta">Subscribe</button>
                </div>

            </div>
            <!-- Categories row -->



        </div>
    </div>

</nav>
<div class="category-chip-scroll" style=" border-bottom: 2px solid #f3f4f6; background:#fff;
            border-top: 2px solid #f3f4f6;">

    <div class="header-chips-row mt-0 justify-content-center" id="categoryChips">


    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    document.getElementById("btn-contact").addEventListener("click", function () {
        // Redirect to contact page
        window.location.href = "contact";


    });
</script>