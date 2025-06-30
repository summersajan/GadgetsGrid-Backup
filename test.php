<html>

<head>
    <title>Test Page</title>
    <style>

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .detail-card {
            max-width: 100%;
            margin: 36px auto 0;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 18px #eaefff;
            padding: 32px 36px;
        }
    </style>
    <p style="font-family:Urbanist, sans-serif;"> Hello</p>
    <p style="font-family:Mulish, sans-serif;"> Hello</p>
    <div class="detail-card row gx-5 gy-4" style="width:100%;">
        <div class="col-12 col-md-6 detail-gallery">hi</div>
        <div class="col-12 col-md-6">
            <div class="card-title mb-3">hello</div>
            <div class="d-flex mb-2 align-items-center">${badges}</div>
            <div class="mb-3 meta-wrap text-muted small">${meta}</div>
            ${pd.subtitle ? `<div class="mb-2" style="font-size:0.98em; color:#555; font-family:'Inter', sans-serif;">
                ${pd.subtitle}</div>` : ''}
            ${pd.body ? `<div class="mb-2" style="font-size:0.90em; font-family:'Inter', sans-serif; color:#333;">
                ${(pd.body).replace(/\n/g, "<br>")}</div>` : ''}
            ${prices ? `<div class="price-wrap mb-2">${prices}</div>` : ''}
            ${links}
        </div>
    </div>

</html>