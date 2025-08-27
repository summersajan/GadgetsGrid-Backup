<?php
// Get category from URL parameter
$category_slug = isset($_GET['category']) ? $_GET['category'] : null;

/*if (!$category_slug) {
    header('Location: index.php');
    exit();
}*/

// Find category by slug/name
$category_found = null;
$category_id = null;

// This assumes you have a way to get categories - you might need to adjust based on your setup
// For now, using a simple approach matching the slug to category name
$category_map = [
    'health' => ['id' => 1, 'name' => 'Health'],
    'technology' => ['id' => 2, 'name' => 'Technology'],
    'smart-home' => ['id' => 3, 'name' => 'Smart Home'],
    'audio' => ['id' => 4, 'name' => 'Audio'],
    'gaming' => ['id' => 5, 'name' => 'Gaming'],
    'mobile-accessories' => ['id' => 6, 'name' => 'Mobile Accessories'],
    'smartphones' => ['id' => 7, 'name' => 'SmartPhones'],
    'wearables' => ['id' => 8, 'name' => 'Wearables'],
    'news' => ['id' => 9, 'name' => 'News']
];

if (isset($category_map[$category_slug])) {
    $category_found = $category_map[$category_slug];
    $category_id = $category_found['id'];
}

if (!$category_found) {
    header('Location: index.php');
    exit();
}
?>


<body style="background:#f6fafd;">
    <!-- Include your header/navigation here -->
    <?php include_once 'header.php'; // Adjust path as needed ?>

    <!-- Search tag bar -->
    <div class="container-xxl mt-3" id="searchTagBar"></div>

    <!-- Categories -->
    <div class="container-xxl">
        <div id="categoryChips" class="category-chips-container mb-4"></div>
    </div>

    <!-- Back button -->
    <div class="container-xxl mt-3">
        <button id="backButton" class="btn btn-outline-secondary mb-3" style="display:none;">
            <i class="bi bi-arrow-left"></i> Back
        </button>
    </div>

    <!-- Main content -->
    <div class="container-xxl mt-2" id="main-content">
        <div id="postDetail" style="display:none;">Loading post...</div>
    </div>

    <!-- Products grid -->
    <section class="container-lg mt-5" id="allPostsSection"></section>

    <!-- Include your footer here -->
    <?php include_once 'footer.php'; // Adjust path as needed ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Global variables
        let allCategories = [],
            allLoadedPosts = [],
            searchResultsPosts = [],
            currentCategoryId = "<?php echo $category_id; ?>", // Set from PHP
            currentSearch = '',
            commonCategoryPosts = [],
            categoryName = "<?php echo $category_found['name']; ?>",
            activeCategory = null,
            sectionViewMode = "all";

        var currentPostId = getUrlParam('id');

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

        // MAIN INITIALIZATION - Load category products
        $(function () {
            fetchAndRenderAll();
        });

        // Main fetch function for category view
        function fetchAndRenderAll() {
            $.post('ajax/load_index_data.php', {
                featuredOffset: 0,
                trendingOffset: 0,
                allOffset: 0,
                featuredLimit: 12,
                trendingLimit: 12,
                allLimit: 12,
                showSection: sectionViewMode,
                categoryId: getActiveCategoryId(),
                search: currentSearch
            }, function (res) {
                let data = typeof res === "string" ? JSON.parse(res) : res;
                allCategories = data.categories || [];
                let featuredPosts = data.featured || [];
                let trendingPosts = data.trending || [];
                allLoadedPosts = data.posts || [];
                activeCategory = getActiveCategory();

                // Combine all posts for category view
                const allComb = [...featuredPosts, ...trendingPosts, ...allLoadedPosts];
                const map = new Map();
                allComb.forEach(post => {
                    if (post && post.id) map.set(post.id, post);
                });
                commonCategoryPosts = Array.from(map.values());

                renderCategoryChips();
                renderSearchTag();
                renderCategorySection();
            });
        }

        // Category chips rendering
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
                let categoryName = $(this).text().toLowerCase().replace(/\s+/g, '-');

                if (newId === "all") {
                    window.location.href = '/GadgetsGrid/';
                } else {
                    window.location.href = `/GadgetsGrid/${categoryName}`;
                }
            });
        }

        // Search functionality
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
                fetchAndRenderAll();
            });
        }

        $(".search-bar").on("input", function () {
            let val = ($(this).val() || "").trim();
            if (!val) {
                currentSearch = '';
                sectionViewMode = 'all';
                fetchAndRenderAll();
            } else {
                currentSearch = val;
                sectionViewMode = "search";
                fetchAndRenderAll();
            }
        });

        // Render category products
        function renderCategorySection() {
            if (!commonCategoryPosts.length) {
                $("#allPostsSection").html(`<div class="text-center py-5"><h3 class="text-muted">No products found in this category</h3></div>`).show();
                return;
            }

            let html = `<h3 class="section-title"><?php echo $category_found['name']; ?> Products</h3><div class="row g-4">`;
            commonCategoryPosts.forEach((post, i) => html += renderPostCard(post, i));
            html += `</div>`;
            $("#allPostsSection").html(html).show();

            $(".product-card").on("click", function () {
                let pid = $(this).data('postid');
                window.location.href = `/GadgetsGrid/post/id/${pid}`;
            });
        }

        function renderPostCard(post, i) {
            return `
                <div class="col-12 col-sm-6 col-md-3 product-row">
                    <div class="product-card animate-fade-in delay-${i}" data-postid="${post.id}" style="cursor:pointer;">
                      <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #fff;" class="rounded-top">
                        <img src="${post.thumbnail ? post.thumbnail : "images/default.jpg"}" alt="${(post.title || '').replace(/"/g, '&quot;')}" class="w-100 h-100 object-fit-contain rounded-top" />
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
    </script>
</body>

</html>