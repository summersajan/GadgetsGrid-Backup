<?php include "header.php"; ?>
<?php

require 'config/db.php';

// Fetch categories for dropdown
$catRes = $conn->query("SELECT id, category_name FROM tbl_category ORDER BY category_name ASC");
$categories = [];
while ($row = $catRes->fetch_assoc()) {
    $categories[] = $row;
}
?>

<!-- Bootstrap 5 CSS (optional if already in header) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons (for action buttons) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<!-- Quill editor CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(120deg, #e0eafc, #cfdef3);
    }

    .container {
        max-width: 950px;
        background: #fff;
        box-shadow: 0 4px 16px rgba(50, 90, 120, 0.05);
        border-radius: 16px;
        margin: 40px auto 0 auto;
        padding: 32px 32px 24px 32px;
    }

    .table-wrapper {
        background: #f9fbff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(55, 90, 110, 0.03);
    }

    h2 {
        font-weight: 700;
        color: #374151;
    }

    img.thumbnail {
        width: 55px;
        height: 40px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .btn-style {
        border-radius: 24px;
        padding: 6px 28px;
        font-size: 1rem;
    }

    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 6px 24px 0 rgba(0, 0, 0, .08);
    }

    .modal-header {
        background: linear-gradient(90deg, #136a8a 0%, #267871 100%);
        color: #fff;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        border-bottom: none;
    }

    .modal-title {
        font-weight: 600;
    }

    .modal-body {
        background: #f8fafd;
    }

    .form-check-label {
        font-size: .97rem;
        color: #555;
    }

    /* For tags styling */
    .badge-tag {
        font-size: 1.0rem;
        background: #45a078;
        padding: 0.5rem;
        display: inline-flex;
        align-items: center;
    }

    .badge-tag .btn-close {
        margin-left: 0.5rem;
    }
</style>

<div class="container-fluid my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Posts</h2>
        <button class="btn btn-style btn-primary" id="openModalBtn">
            <i class="bi bi-plus-circle"></i> Add Post
        </button>
    </div>
    <div id="alertBox"></div>
    <div class="table-wrapper">
        <table class="table table-striped align-middle" id="postTable" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th style="width:120px;">Action</th>
                </tr>
            </thead>
            <tbody id="postData"></tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="postForm" enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
            <div class="modal-header p-3">
                <h5 class="modal-title" id="modalTitle">Add Post</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body g-2 row">
                <input type="hidden" id="post_id" name="id">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select id="category_id" name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="body" class="form-label">Post Content</label>
                    <div id="editor-container" style="height: 350px;"></div>
                    <textarea id="body" name="body" style="display:none;"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="tags" class="form-label">Tags (max 5)</label>
                    <input type="text" class="form-control" id="tagInput" placeholder="Enter tags separated by commas">
                    <div id="tagContainer" class="mt-2"></div>
                    <input type="hidden" id="tags" name="tags">
                </div>
                <div class="col-md-2 mb-1">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured">
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                </div>
                <div class="col-md-2 mb-1">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="is_trending" name="is_trending">
                        <label class="form-check-label" for="is_trending">Trending</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-top-0">
                <button type="submit" class="btn btn-style btn-primary" id="saveBtn">Add</button>
                <button type="button" class="btn btn-style btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- jQuery first! -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<!-- Quill editor JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    // --- TAGS LOGIC ---
    let tags = [];
    const tagInput = document.getElementById('tagInput');
    const tagContainer = document.getElementById('tagContainer');
    const tagsHidden = document.getElementById('tags');

    function updateTags() {
        tagContainer.innerHTML = tags.map((tag, index) =>
            `<span class="badge badge-tag me-1">
                ${tag}
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="removeTag(${index})"></button>
            </span>`
        ).join('');
        tagsHidden.value = tags.join(',');
    }
    window.removeTag = function (index) {
        tags.splice(index, 1);
        updateTags();
    };
    function setTags(tagStr) {
        tags = [];
        if (tagStr) {
            tags = tagStr.split(',').map(tag => tag.trim()).filter(tag => tag !== "");
        }
        updateTags();
    }
    if (tagInput) {
        tagInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ',') {
                event.preventDefault();
                const newTags = tagInput.value.split(',').map(tag => tag.trim()).filter(tag => tag !== "");
                tags = [...new Set([...tags, ...newTags])].slice(0, 5);
                updateTags();
                tagInput.value = '';
            }
        });
    }

    // --- DATATABLE, AJAX, QUILL, BOOTSTRAP ---
    var quill;
    let postModal;
    function showAlert(msg, type = "success") {
        $("#alertBox").html(`<div class="alert alert-${type} alert-dismissible fade show" role="alert">${msg}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`);
    }

    function resetForm() {
        $("#postForm")[0].reset();
        $("#post_id").val("");
        $("#saveBtn").text("Add");
        $("#modalTitle").text("Add Post");
        tags = [];
        updateTags();
        if (quill) quill.setContents([{ insert: '\n' }]);
    }

    function fetchPosts() {
        $.post("ajax/posts.php", { action: "fetch" }, function (res) {
            $("#postData").html(res);

            // DataTables init or re-init
            if ($.fn.dataTable.isDataTable('#postTable')) {
                $('#postTable').DataTable().destroy();
            }
            $('#postTable').DataTable({
                ordering: true,
                pageLength: 10,
                lengthChange: false,
                info: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search post..."
                },
                columnDefs: [
                    { orderable: false, targets: [1, 5] }
                ]
            });
        });
    }

    $(function () {
        postModal = new bootstrap.Modal(document.getElementById('postModal'));

        fetchPosts();

        // - Quill rich text initialization
        var editorContainer = document.getElementById('editor-container');
        if (editorContainer) {
            quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        ['link', 'image'],
                        [{ list: 'ordered' }, { list: 'bullet' }]
                    ]
                }
            });
        }

        $("#openModalBtn").on("click", function () {
            resetForm();
            postModal.show();
        });

        // Save (add/update)
        $("#postForm").submit(function (e) {
            e.preventDefault();
            if (quill) $("#body").val(quill.root.innerHTML);
            $("#tags").val(tags.join(","));
            let formData = new FormData(this);
            const id = $('#post_id').val();
            formData.append("action", id ? "update" : "add");
            $.ajax({
                url: "ajax/posts.php",
                type: "POST",
                data: formData,
                contentType: false, processData: false,
                dataType: "json",
                success: function (res) {
                    postModal.hide();
                    if (res.status == 1) {

                        showAlert(res.message, "success");
                        // fetchPosts();
                        resetForm();
                        setTimeout(() => {
                            location.reload();
                        }, 300);
                    } else {
                        showAlert(res.message, "danger");
                    }
                },
                error: function (xhr, status, error) {
                    showAlert(`Error: ${status} - ${error}`, "danger");
                }
            });
        });

        // Edit Post
        $(document).on("click", ".editBtn", function () {
            let el = $(this);
            $("#post_id").val(el.data("id"));
            $("#title").val(el.data("title"));
            $("#subtitle").val(el.data("subtitle"));
            $("#category_id").val(el.data("category_id"));
            $("#status").val(el.data("status"));
            $("#is_featured").prop("checked", el.data("featured") == 1);
            $("#is_trending").prop("checked", el.data("trending") == 1);
            $("#saveBtn").text("Update");
            $("#modalTitle").text("Edit Post");
            $("#thumbnail").val(""); // Reset file input

            if (quill) {
                quill.root.innerHTML = el.data("body") || "";
            } else {
                $("#body").val(el.data("body"));
            }
            setTags(el.data("tags") || "");

            postModal.show();
        });

        // Delete Post
        $(document).on("click", ".deleteBtn", function () {
            if (!confirm("Are you sure to delete this post?")) return;
            let id = $(this).data("id");
            $.post("ajax/posts.php", { action: "delete", id }, function (res) {
                try { res = JSON.parse(res); } catch (e) { res = { status: 0, message: "Invalid response." }; }
                if (res.status == 1) {
                    showAlert(res.message, "success");
                    setTimeout(() => {
                        location.reload();
                    }, 200);
                } else showAlert(res.message, "danger");
            });
        });
    });
</script>

<?php include "footer.php"; ?>