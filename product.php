<?php include 'header.php'; ?>



<body style="background:#f6fafd;">
    <!-- Search tag bar -->
    <div class="container-xxl mt-3" id="searchTagBar"></div>

    <!-- Categories - ALWAYS VISIBLE -->
    <div class="container-xxl">
        <div id="categoryChips" class="category-chips-container mb-4"></div>
    </div>



    <!-- Main content -->
    <div class="container-lg mt-5" id="main-content">
        <div id="postDetail" style="display:none;">Loading post...</div>
    </div>


    <!-- Products grid -->
    <section class="container-lg mt-5" id="allPostsSection"></section>
</body>




<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<script>
    // Global variables
    let allCategories = [],
        allLoadedPosts = [],
        searchResultsPosts = [],
        currentCategoryId = "all",
        currentSearch = '',
        commonCategoryPosts = [],
        categoryName = "All Gadgets",
        activeCategory = null,
        sectionViewMode = "all";

    function detectPostId() {
        // First check query param (for old links)
        let id = getUrlParam('id');
        if (id) return id;

        // Then check if URL looks like /post/22
        let match = window.location.pathname.match(/\/product\/(\d+)/);
        if (match) return match[1];

        return null;
    }

    var currentPostId = detectPostId();


    // Helper functions
    function getUrlParam(name) {
        let s = new URLSearchParams(window.location.search);
        return s.get(name);
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

    function getActiveCategoryId() {
        return currentCategoryId;
    }

    function getActiveCategory() {
        return allCategories.find(c => c.id.toString() === currentCategoryId) ?? null;
    }

    // MAIN INITIALIZATION
    $(function () {
        if (currentPostId) {
            // Load specific post detail view
            loadMainPost();
            loadCategories(); // Load categories for navigation
        } else {
            // Show grid view with categories and search
            fetchAndRenderAll();
        }
    });

    // Load categories for navigation
    function loadCategories() {
        $.post('../ajax/load_index_data.php', {
            featuredOffset: 0,
            trendingOffset: 0,
            allOffset: 0,
            featuredLimit: 1,
            trendingLimit: 1,
            allLimit: 1,
            showSection: "all",
            categoryId: "all",
            search: ""
        }, function (res) {
            let data = typeof res === "string" ? JSON.parse(res) : res;
            allCategories = data.categories || [];
            renderCategoryChips();
        });
    }

    // Main fetch function for grid view
    function fetchAndRenderAll() {
        $.post('../ajax/load_index_data.php', {
            featuredOffset: 0,
            trendingOffset: 0,
            allOffset: 0,
            featuredLimit: 12,
            trendingLimit: 12,
            allLimit: 12,
            showSection: sectionViewMode,
            categoryId: sectionViewMode === "search" ? "all" : getActiveCategoryId(),
            search: currentSearch
        }, function (res) {
            let data = typeof res === "string" ? JSON.parse(res) : res;
            allCategories = data.categories || [];
            let featuredPosts = data.featured || [];
            let trendingPosts = data.trending || [];
            allLoadedPosts = data.posts || [];
            activeCategory = getActiveCategory();

            // Combine all posts for category view
            if (activeCategory && sectionViewMode !== "search") {
                const allComb = [...featuredPosts, ...trendingPosts, ...allLoadedPosts];
                const map = new Map();
                allComb.forEach(post => {
                    if (post && post.id) map.set(post.id, post);
                });
                commonCategoryPosts = Array.from(map.values());
            } else {
                commonCategoryPosts = [];
            }

            // Global search results
            if (sectionViewMode === "search" && currentSearch) {
                const allComb = [...featuredPosts, ...trendingPosts, ...allLoadedPosts];
                const map = new Map();
                allComb.forEach(post => {
                    if (post && post.id) map.set(post.id, post);
                });
                searchResultsPosts = Array.from(map.values());
            }

            renderCategoryChips();
            renderSearchTag();
            renderSections();
        });
    }

    // 1. CATEGORY FUNCTIONALITY - ALWAYS VISIBLE
    function renderCategoryChips() {
        const categoryIcons = {
            "all": "apps", "technology": "swap_vert", "health": "assignment",
            "smart-home": "home", "audio": "music_note", "gaming": "widgets",
            "mobile-accessories": "smartphone", "smartphones": "bookmark",
            "wearables": "watch", "news": "notes"
        };

        let chips = `<span class="category-chip" data-category-id="all">
            <span class="cat-icon material-icons">${categoryIcons["all"]}</span>All</span>`;

        allCategories.forEach(c => {
            let key = c.category_name.toString().toLowerCase().replace(/\s+/g, '-');
            let icon = categoryIcons[key] || "label";
            chips += `<span class="category-chip" data-category-id="${c.id}">
                <span class="cat-icon material-icons">${icon}</span>${c.category_name}</span>`;
        });
        $("#categoryChips").html(chips);

        $(".category-chip").removeClass("active");
        $(`.category-chip[data-category-id='${currentCategoryId}']`).addClass("active");

        $(".category-chip").off("click").on("click", function (e) {




            $(".category-chip").removeClass("active");
            $(this).addClass("active");
            let newId = $(this).data("category-id").toString();
            currentCategoryId = newId;
            sectionViewMode = 'all';
            currentSearch = '';
            $(".search-bar").val("");

            // Hide post detail, show grid
            $("#postDetail").hide();
            $("#backButton").hide();
            $("#allPostsSection").show();

            $("#relatedProductsContainer").remove();

            fetchAndRenderAll();
        });
    }

    // 2. SEARCH FUNCTIONALITY
    function renderSearchTag() {
        let html = "";
        if (sectionViewMode === "search" && currentSearch) {
            html = `<div style="background:#e1f3fb;color:#298CB9;font-weight:600;font-size:1rem;margin-bottom:11px;padding:12px 26px;border-radius:12px;display:flex;align-items:center;">
                    Search: <span style="font-weight:bold;margin-left:4px">${escapeHtml(currentSearch)}</span>
                    <button class="btn btn-link btn-sm ps-2 ms-2" style="color:#155986;font-size:1.2rem;" id="clearSearchBtn">&#10006;</button></div>`;
        }
        $("#searchTagBar").html(html);
        $("#clearSearchBtn").off("click").on("click", function () {
            $(".search-bar").val("");
            currentSearch = "";
            sectionViewMode = "all";
            //fetchAndRenderAll();
            window.location.href = '../';
        });
    }

    $(".search-bar").on("input", function () {
        let val = ($(this).val() || "").trim();
        if (!val) {
            currentSearch = '';
            sectionViewMode = 'all';
            searchResultsPosts = [];
            $("#postDetail").hide();
            $("#backButton").hide();

            $("#allPostsSection").show();

            fetchAndRenderAll();
            $("#relatedProductsContainer").remove();
        } else {
            currentSearch = val;
            sectionViewMode = "search";
            currentCategoryId = "all";
            $("#postDetail").hide();
            $("#backButton").hide();
            $("#allPostsSection").show();

            fetchAndRenderAll();
            $("#relatedProductsContainer").remove();
        }
    });

    // Grid sections
    function renderSections() {
        if (sectionViewMode === "search" && currentSearch) {
            $("#allPostsSection").hide();
            $("#searchResultsSection").remove();
            $("<div id='searchResultsSection'></div>").appendTo("#main-content");
            renderSearchResultsSection();
        } else if (activeCategory) {
            $("#searchResultsSection").remove();
            renderCommonCategorySection();
        } else {
            $("#searchResultsSection").remove();
            renderAllPostsSection();
        }
    }

    function renderCommonCategorySection() {
        if (!commonCategoryPosts.length) {
            $("#allPostsSection").html(`<div class="text-center py-5"><h3 class="text-muted">No products found</h3></div>`).show();
            return;
        }
        let html = `<h3 class="section-title">${activeCategory.category_name} Products</h3><div class="row g-4">`;
        commonCategoryPosts.forEach((post, i) => html += renderPostCard(post, i));
        html += `</div>`;
        $("#allPostsSection").html(html).show();
        $(".product-card").on("click", function () {
            let pid = $(this).data('postid');
            currentPostId = pid;
            window.history.pushState({}, '', `${pid}`);
            loadMainPost();
        });
    }

    function renderAllPostsSection() {
        if (!allLoadedPosts.length) {
            $("#allPostsSection").html(`<div class="text-center py-5"><h3 class="text-muted">No products found</h3></div>`).show();
            return;
        }
        let html = `<h3 class="section-title">All Products</h3><div class="row g-4">`;
        allLoadedPosts.forEach((post, i) => html += renderPostCard(post, i));
        html += `</div>`;
        $("#allPostsSection").html(html).show();
        $(".product-card").on("click", function () {
            let pid = $(this).data('postid');
            currentPostId = pid;
            window.history.pushState({}, '', `${pid}`);
            loadMainPost();
        });
    }

    function renderSearchResultsSection() {
        if (!searchResultsPosts.length) {
            $("#searchResultsSection").html(`<h3 class="section-title">Search Results</h3><p>No products found for "${currentSearch}".</p>`).show();
            return;
        }
        let html = `<h3 class="section-title">Search Results for "${currentSearch}"</h3><div class="row g-4">`;
        searchResultsPosts.forEach((post, i) => html += renderPostCard(post, i));
        html += `</div>`;
        $("#searchResultsSection").html(html).show();
        $(".product-card").on("click", function () {
            let pid = $(this).data('postid');
            currentPostId = pid;
            window.history.pushState({}, '', `${pid}`);
            loadMainPost();
        });
    }

    function renderPostCard(post, i) {
        return `
            <div class="col-12 col-sm-6 col-md-3 product-row">
                <div class="product-card animate-fade-in delay-${i}" data-postid="${post.id}" style="cursor:pointer;">
                  <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #fff;" class="rounded-top">
                    <img src="../${post.thumbnail ? post.thumbnail : "images/default.jpg"}" alt="${(post.title || '').replace(/"/g, '&quot;')}" class="w-100 h-100 object-fit-contain rounded-top" />
                  </div>
                  <div class="p-3">
                    <div class="product-meta-row">
                      <span class="meta" style="background:#e8f1fd;color:#5786f2">${post.category_name || ''}</span>
                    </div>
                    <h6 class="card-title text-truncate-2">${post.title}</h6>
                    ${post.tags ? `<div class="mb-1">${post.tags.split(',').map(tag => `<span class="badge rounded-pill bg-success me-1">${tag.trim()}</span>`).join('')}</div>` : ""}
                    <div class="product-date"><i class="bi bi-clock"></i> ${timeAgo(post.created_at)}</div>
                  </div>
                </div>
            </div>
        `;
    }

    // 3. MAIN POST LAYOUT
    function renderPostDetail(d) {
        currentCategoryId = d.post.category_id;
        categoryName = d.post.category_name || "All Gadgets";

        // Gallery markup
        let gallery = `
            <div style="display: flex; justify-content: center;">
              <div style="aspect-ratio: 1 / 1; width: 95%; overflow: hidden; background: #fff;" class="rounded">
                <img id="mainImgView" class="main-img-view mb-3 w-100 h-100 rounded" src="../${d.images?.[0] || d.post.thumbnail}" alt="Main" />
              </div>
            </div>
        `;

        if (d.images && d.images.length > 1) {
            gallery += `<div class="d-flex gallery-thumbs flex-wrap mt-2 gap-2" style="margin-left:12px;">`;
            d.images.forEach((img, i) => {
                gallery += `<img src="../${img}" class="thumb-img rounded${i === 0 ? ' active' : ''}" data-img="../${img}" alt="image ${i}" style="height: 70px; width: auto; object-fit: contain;" />`;
            });
            gallery += `</div>`;
        }

        const pd = d.post;
        let badges = '';
        const prices = [];
        const metaArr = [];

        if (pd.category_name) badges += `<span class="badge badge-cat px-3 py-2 me-2">${pd.category_name}</span>`;
        if (pd.is_featured == 1) badges += `<span class="badge bg-warning-subtle text-warning-emphasis me-2">Featured</span>`;
        if (pd.is_trending == 1) badges += `<span class="badge bg-danger-subtle text-danger me-2">Trending</span>`;
        if (pd.status === 'draft') badges += `<span class="badge bg-secondary">Draft</span>`;

        let links = '';
        (d.product_links || []).forEach(link => {
            links += `<a class="btn btn-warning product-link-btn d-inline-flex align-items-center mb-2"
        href="${link.product_link}" target="_blank" rel="nofollow noopener">
        <i class="bi bi-cart-check me-2"></i>
        Buy it Now
    </a>`;
        });

        if (pd.old_price) prices.push(`<span class="old-price me-2 text-decoration-line-through">$${(+pd.old_price).toFixed(2)}</span>`);
        if (pd.price) prices.push(`<span class="fw-bold text-warning-emphasis">$${(+pd.price).toFixed(2)}</span>`);
        if (pd.discount) prices.push(`<span class="discount-badge ms-2">${pd.discount} OFF</span>`);

        metaArr.push(`<i class="bi bi-clock"></i> ${pd.created_at.substr(0, 10)}`);
        if (pd.updated_at && pd.updated_at !== pd.created_at) metaArr.push(`Updated ${pd.updated_at.substr(0, 10)}`);

        const postHtml = `
           <div class="w-100" style="padding:1rem; margin-top: -55px;">
                  <div class="detail-card row gx-5 gy-4 w-100">
                <div class="col-12 col-md-6 detail-gallery">${gallery}</div>
                <div class="col-12 col-md-6">
                  <div class="card-title mb-3">${pd.title}</div>
                  <div class="d-flex mb-2 align-items-center">${badges}</div>
                  <div class="mb-3 meta-wrap text-muted small">${metaArr.join(' · ')}</div>
                  ${pd.subtitle ? `<div class="mb-2" style="font-size:0.98em; color:#555; font-family:'Inter', sans-serif;">${pd.subtitle}</div>` : ''}
                  ${pd.body ? `<div class="mb-2" style="font-size:0.90em; font-family:'Inter', sans-serif; color:#333;">${(pd.body).replace(/\n/g, "<br>")}</div>` : ''}
                  ${prices.length ? `<div class="price-wrap mb-2">${prices.join('')}</div>` : ''}
                  ${links}
                </div>
              </div>
            </div>
        `;
        $('#postDetail').html(postHtml);
        setTimeout(() => {
            $('.thumb-img').on('click', function () {
                $('.thumb-img').removeClass('active');
                $(this).addClass('active');
                $('#mainImgView').attr('src', $(this).attr('data-img'));
            });
        }, 100);
    }

    function loadMainPost() {
        if (!currentPostId) return;

        $('#postDetail').html('<div style="padding:2em;text-align:center;">Loading...</div>');

        // Show post detail layout
        $("#categoryChips").show(); // CATEGORIES STILL VISIBLE
        $("#allPostsSection").hide();
        $("#searchResultsSection").hide();
        $("#postDetail").show();
        $("#backButton").show();

        $.post('../ajax/post_api.php', { action: 'post', id: currentPostId }, function (resp) {
            if (resp && resp.post) {
                renderPostDetail(resp);
                // LOAD RELATED PRODUCTS - This is the key line that was missing proper execution
                loadRelatedProducts(resp.post.category_id, resp.post.id);



            } else {
                $('#postDetail').html('<div class="alert alert-warning">Post not found!</div>');
            }
        }, 'json').fail(function () {
            $('#postDetail').html('<div class="alert alert-danger">Error loading post!</div>');
        });
    }

    // 4. RELATED POSTS LAYOUT - COMPLETE IMPLEMENTATION
    function loadRelatedProducts(categoryId, excludeId) {
        $.post('../ajax/post_api.php', {
            action: 'posts',
            categoryId: categoryId || 'all',
            limit: 8
        }, function (resp) {
            if (resp && resp.posts) {
                let filtered = excludeId ? resp.posts.filter(p => p.id != excludeId) : resp.posts;
                renderRelatedProductsSection(filtered);
            }
        }, 'json');
    }

    function renderRelatedProductsSection(posts) {
        // Create a new section for related products BELOW the post detail
        let relatedHtml = `<div class="container-lg mt-5" id="relatedProductsContainer">
            <h3 class="section-title">Related Products</h3>
            <div class="row g-4">`;

        if (!posts.length) {
            relatedHtml += `<div class="col-12"><div class="alert alert-info">No related products found</div></div>`;
        } else {
            posts.forEach((post, i) => {
                relatedHtml += `
                    <div class="col-12 col-sm-6 col-md-3 product-row">
                        <div class="product-card animate-fade-in delay-${i}" data-postid="${post.id}" style="cursor:pointer;">
                          <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #fff;" class="rounded-top">
                            <img src="../${post.thumbnail ? post.thumbnail : "images/default.jpg"}" 
                                 alt="${(post.title || '').replace(/"/g, '&quot;')}" 
                                 class="w-100 h-100 object-fit-contain rounded-top" />
                          </div>
                          <div class="p-3">
                            <div class="product-meta-row">
                              <span class="meta" style="background:#e8f1fd;color:#5786f2">${categoryName || ''}</span>
                            </div>
                            <h6 class="card-title text-truncate-2">${post.title}</h6>
                            ${post.tags ? `<div class="mb-1">
                              ${post.tags.split(',').map(tag => `<span class="badge rounded-pill bg-success me-1">${tag.trim()}</span>`).join('')}
                            </div>` : ""}
                            <div class="product-date"><i class="bi bi-clock"></i> ${timeAgo(post.created_at)}</div>
                          </div>
                        </div>
                    </div>
                `;
            });
        }

        relatedHtml += `</div></div>`;

        // Remove existing related products section and add new one
        $("#relatedProductsContainer").remove();
        $("#main-content").after(relatedHtml);

        // Add click handlers for related products
        $("#relatedProductsContainer .product-card").on("click", function () {
            let pid = $(this).data("postid");
            currentPostId = pid;
            window.history.pushState({}, '', `${pid}`);
            loadMainPost();
        });
    }

    // Back button
    $("#backButton").on("click", function () {
        $("#postDetail").hide();
        $("#backButton").hide();
        $("#relatedProductsContainer").remove(); // Remove related products when going back
        $("#allPostsSection").show();
        currentPostId = null;
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        fetchAndRenderAll();
    });
</script>











<?php include 'footer.php'; ?>