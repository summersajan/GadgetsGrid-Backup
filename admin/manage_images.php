<?php include "header.php"; ?>
<?php
require 'config/db.php';

// Fetch all posts for dropdown: id => title
$postRes = $conn->query("SELECT id, title FROM tbl_posts ORDER BY id DESC");
$posts = [];
while ($row = $postRes->fetch_assoc())
    $posts[] = $row;
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<style>
    body {
        background: #f4f6f8;
    }

    .container {
        max-width: 920px;
        background: #fff;
        box-shadow: 0 4px 28px rgba(39, 82, 191, 0.07);
        border-radius: 18px;
        padding: 32px 36px 30px 36px;
        margin: 38px auto 0;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .rounded-thumb {
        width: 74px;
        height: 56px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #dde;
    }

    .modal-content {
        border-radius: 18px;
    }

    .modal-header {
        background: linear-gradient(92deg, #2090ff 0, #81eae2 96%);
        color: #fff;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
    }

    .btn-style {
        border-radius: 18px;
        font-weight: 500;
    }
</style>
<div class="container-fluid my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold">Image Manager</h2>
        <button class="btn btn-style btn-primary" id="openModalBtn">
            <i class="bi bi-plus-circle"></i> Add Image
        </button>
    </div>
    <div id="alertBox"></div>

    <div class="table-responsive">
        <table class="table table-hover align-middle" id="imageTable" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Post</th>
                    <th style="width:120px;">Actions</th>
                </tr>
            </thead>
            <tbody id="imageData"></tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <form id="imageForm" class="modal-content" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Image</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row gy-3">
                <input type="hidden" name="id" id="image_id">
                <div class="col-12">
                    <label class="form-label">Image File <span class="text-danger">*</span></label>
                    <input type="file" name="image_file" id="image_file" class="form-control" accept="image/*">
                    <span id="imagePreview" class="d-block mt-2"></span>
                </div>
                <div class="col-12">
                    <label class="form-label">Post <span class="text-danger">*</span></label>
                    <select name="post_id" id="post_id" class="form-select" required>
                        <option value="">-- Select Post --</option>
                        <?php foreach ($posts as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
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

<!-- JS (always this order): -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));

    function showAlert(msg, type = 'success') {
        $("#alertBox").html(
            `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${msg}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>`
        );
    }

    function fetchImages() {
        $.post('ajax/images.php', { action: 'fetch' }, res => {
            $('#imageData').html(res);

            // DataTable destroy & re-init
            if ($.fn.dataTable.isDataTable('#imageTable')) {
                $('#imageTable').DataTable().destroy();
            }
            $('#imageTable').DataTable({
                ordering: false,
                pageLength: 10,
                lengthChange: false,
                info: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search images..."
                },
                columnDefs: [
                    { orderable: false, targets: [1, 3] }
                ]
            });
        });
    }

    function resetForm() {
        $('#imageForm')[0].reset();
        $('#image_id').val('');
        $('#modalTitle').text('Add Image');
        $('#saveBtn').text('Add');
        $('#imagePreview').html('');
    }

    $(document).ready(function () {
        fetchImages();

        $("#openModalBtn").on("click", function () {
            resetForm();
            imageModal.show();
        });

        // Preview on file select
        $('#image_file').on("change", function () {
            let file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = e => $('#imagePreview').html(`<img src="${e.target.result}" class="rounded-thumb shadow-sm">`);
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').html('');
            }
        });

        // Submit via Ajax, reload after modal hidden
        $('#imageForm').on('submit', function (e) {
            e.preventDefault();
            let fd = new FormData(this);
            const id = $('#image_id').val();
            fd.append("action", id ? "update" : "add");
            $.ajax({
                url: 'ajax/images.php',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: res => {
                    if (res.status === 1) {
                        imageModal.hide();
                        showAlert(res.message, 'success');
                        $('#imageModal').on('hidden.bs.modal', function () {
                            // fetchImages();
                            resetForm();
                            $(this).off('hidden.bs.modal');
                            setTimeout(() => {
                                location.reload();
                            }, 300);
                        });
                    } else showAlert(res.message, 'danger');
                },
                error: () => showAlert("Server error!", "danger")
            });
        });

        // Edit button
        $(document).on('click', '.editBtn', function () {
            const id = $(this).data('id'),
                postid = $(this).data('postid'),
                imgurl = $(this).data('img');
            $('#image_id').val(id);
            $('#post_id').val(postid);
            $('#imagePreview').html(imgurl ? `<img src="../${imgurl}" class="rounded-thumb shadow-sm">` : "");
            $('#modalTitle').text('Edit Image');
            $('#saveBtn').text('Update');
            $('#image_file').val('');
            imageModal.show();
        });

        // Delete button
        $(document).on('click', '.deleteBtn', function () {
            if (!confirm("Delete this image?")) return;
            let id = $(this).data('id');
            $.post('ajax/images.php', { action: 'delete', id }, res => {
                try { res = JSON.parse(res); } catch (e) { }
                if (res.status === 1) {

                    showAlert(res.message);
                    setTimeout(() => {
                        location.reload();
                    }, 300);
                }
                else showAlert(res.message, "danger");
            });
        });
    });
</script>

<?php include "footer.php"; ?>