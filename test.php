<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>5 Cards per Row</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        .product-card {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.05);
            overflow: hidden;
            transition: all 0.4s ease;
            height: 100%;
        }

        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .product-meta-row .meta {
            background: #e8f1fd;
            color: #5786f2;
        }

        /* Custom 5-column layout */
        .col-5th {
            width: 20%;
            padding: 10px;
        }

        @media (max-width: 991.98px) {
            .col-5th {
                width: 50%;
            }
        }

        @media (max-width: 575.98px) {
            .col-5th {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex flex-wrap" id="cardContainer"></div>
    </div>

    <script>
        const cardData = [
            { title: "Cleer Audio Arc 3: Open-Ear Earbuds for Active Lifestyles and 50 Hours of On-the-Go Use", category: "Technology", tags: ["AI", "ML", "Future"], image: "images/1751695318_WhatsApp Image 2025-07-05 at 11.24.33 AM.jpeg", timeAgo: "2 hours ago" },
            { title: "Health Tips", category: "Health", tags: ["Wellness", "Fitness", "Nutrition"], image: "images/1751695318_WhatsApp Image 2025-07-05 at 11.24.33 AM.jpeg", timeAgo: "1 day ago" },
            { title: "Finance 101", category: "Finance", tags: ["Savings", "Investing", "Budgeting"], image: "images/1751695318_WhatsApp Image 2025-07-05 at 11.24.33 AM.jpeg", timeAgo: "3 hours ago" },
            { title: "Space Discovery", category: "Science", tags: ["NASA", "Planets", "Research"], image: "images/1751695318_WhatsApp Image 2025-07-05 at 11.24.33 AM.jpeg", timeAgo: "5 days ago" },
            { title: "Travel Diaries", category: "Travel", tags: ["Adventure", "Destinations", "Tips"], image: "images/1751695318_WhatsApp Image 2025-07-05 at 11.24.33 AM.jpeg", timeAgo: "8 hours ago" },
            { title: "Cooking Secrets", category: "Food", tags: ["Recipes", "Healthy", "Quick Meals"], image: "images/1751695318_WhatsApp Image 2025-07-05 at 11.24.33 AM.jpeg", timeAgo: "6 hours ago" }
        ];

        const container = document.getElementById('cardContainer');

        cardData.forEach((post, index) => {
            container.innerHTML += `
            <div class="col-5th">
                <div class="product-card">
                    <img src="${post.image}" alt="${post.title}" />
                    <div class="p-3">
                        <div class="product-meta-row mb-2">
                            <span class="meta px-2 py-1 rounded">${post.category}</span>
                        </div>
                        <h6 class="card-title mb-2">${post.title}</h6>
                        <div class="mb-2">
                            ${post.tags.map(tag => `<span class="badge rounded-pill bg-success me-1">${tag}</span>`).join('')}
                        </div>
                        <div class="product-date text-muted">
                            <i class="bi bi-clock me-1"></i> ${post.timeAgo}
                        </div>
                    </div>
                </div>
            </div>
        `;
        });
    </script>

</body>

</html>