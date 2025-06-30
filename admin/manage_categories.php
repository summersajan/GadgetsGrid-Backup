<?php include "header.php"; ?>
<?php
require 'config/db.php';
// Fetch all posts for dropdown: id => title
$postRes = $conn->query("SELECT id, title FROM tbl_posts ORDER BY id DESC");
$posts = [];
while ($row = $postRes->fetch_assoc())
    $posts[] = $row;
?>

<!-- DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    body {
        background: #f7faff;
    }

    .admin-panel-container {
        max-width: 960px;
        background: #fff;
        box-shadow: 0 8px 30px #2a3c4b10;
        border-radius: 18px;
        padding: 36px 40px 30px 40px;
        margin: 48px auto 0;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 18px !important;
        border: 1px solid #d6e0ef !important;
        padding: 8px 18px !important;
    }

    table.dataTable {
        background: #fff;
    }

    .table thead th {
        background: linear-gradient(92deg, #2090ff10 0, #81eae220 96%);
        font-weight: 600;
        border-bottom: 0;
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

    .modal-footer {
        background: #f8fafc;
        border-top: 0;
    }

    .btn-style {
        border-radius: 16px !important;
        font-weight: 500;
        letter-spacing: 1px;
    }

    .dataTables_paginate .paginate_button {
        border-radius: 50px;
    }
</style>


<div class="container-fluid my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Category Manager</h2>
        <button class="btn btn-primary px-4" id="openModalBtn">
            <i class="bi bi-plus-circle"></i> Add Category
        </button>
    </div>

    <div id="alertBox"></div>

    <div class="table-responsive">
        <table id="categoryTable" class="table table-striped table-bordered align-middle w-100">
            <thead>
                <tr>
                    <th style="width:90px">ID</th>
                    <th>Name&nbsp;&amp;&nbsp;Image</th>
                    <th style="width:150px">Action</th>
                </tr>
            </thead>
            <tbody id="categoryData"></tbody>
        </table>
    </div>
</div>

<!-- ---------- Modal ---------- -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="categoryForm" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="category_id" name="id">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name <span
                            class="text-danger">*</span></label>
                    <input type="text" id="category_name" name="category_name" class="form-control" maxlength="255"
                        required>
                </div>

                <div class="mb-3">
                    <label for="category_image" class="form-label">Category Image</label>
                    <input type="file" id="category_image" name="category_image" accept="image/*" class="form-control">
                    <img id="preview" class="img-thumbnail mt-2 d-none" style="height:90px;object-fit:cover">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="saveBtn">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- ---------- JS ---------- -->
<script>
    const cModal = new bootstrap.Modal(document.getElementById('categoryModal'));

    function showAlert(msg, type = 'success') {
        $('#alertBox').html(`
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${msg}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>`);
    }

    function fetchCategories(cb = null) {
        $.post('ajax/category.php', { action: 'fetch' }, function (html) {
            $('#categoryData').html(html);

            if ($.fn.dataTable.isDataTable('#categoryTable')) $('#categoryTable').DataTable().destroy();
            $('#categoryTable').DataTable({
                pageLength: 10,
                lengthChange: false,
                info: false,
                columnDefs: [{ targets: 2, orderable: false }],
                language: { searchPlaceholder: 'Search category…', search: '_INPUT_' }
            });

            if (typeof cb === 'function') cb();
        });
    }

    function resetForm() {
        $('#categoryForm')[0].reset();
        $('#category_id').val('');
        $('#preview').addClass('d-none').attr('src', '');
        $('#saveBtn').text('Add');
        $('#modalTitle').text('Add Category');
    }

    $(function () {

        fetchCategories();

        $('#openModalBtn').on('click', () => { resetForm(); cModal.show(); });

        /* ---- Add / Update ---- */
        $('#categoryForm').on('submit', function (e) {
            e.preventDefault();

            const id = $('#category_id').val();
            const name = $('#category_name').val().trim();
            if (!name.length) { showAlert('Please enter category name!', 'danger'); return; }

            const fd = new FormData(this);
            fd.append('action', id ? 'update' : 'add');

            $.ajax({
                url: 'ajax/category.php',
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (res) {
                    try {
                        res = JSON.parse(res);
                    } catch (e) {
                        console.error("JSON parse error:", e, res);
                        res = { status: 0, message: 'Server error (invalid JSON response)' };
                    }
                    cModal.hide();
                    if (res.status == 1) {

                        showAlert(res.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 300);
                    } else {
                        showAlert(res.message, 'danger');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", status, error);
                    console.error("Response text:", xhr.responseText);
                    showAlert("AJAX Error: " + error + " (" + status + ")", 'danger');
                }
            });

        });

        /* ---- Edit ---- */
        $(document).on('click', '.editBtn', function () {
            resetForm();
            $('#category_id').val($(this).data('id'));
            $('#category_name').val($(this).data('name'));
            const img = $(this).data('img');
            if (img) {
                $('#preview').attr('src', '' + img).removeClass('d-none');
            }
            $('#saveBtn').text('Update');
            $('#modalTitle').text('Edit Category');
            cModal.show();
        });

        /* ---- Delete ---- */
        $(document).on('click', '.deleteBtn', function () {
            if (!confirm('Delete this category?')) return;
            $.post('ajax/category.php', { action: 'delete', id: $(this).data('id') }, function (res) {
                try { res = JSON.parse(res); } catch { res = { status: 0, message: 'Server error' }; }

                showAlert(res.message, res.status == 1 ? 'success' : 'danger');
                setTimeout(() => {
                    location.reload();
                }, 300);
            });
        });

        /* preview on file change */
        $('#category_image').on('change', function () {
            const [file] = this.files;
            if (file) $('#preview').attr('src', URL.createObjectURL(file)).removeClass('d-none');
        });
    });
</script>
</body>

<?php include "footer.php"; ?>