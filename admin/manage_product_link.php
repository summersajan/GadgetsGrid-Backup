<?php
require 'config/db.php';
$posts = [];
$res = $conn->query("SELECT id, title FROM tbl_posts ORDER BY title ASC");
while ($row = $res->fetch_assoc())
    $posts[] = $row;
?>
<?php include "header.php"; ?>
<style>
    body {
        background: #f6fafd;
    }

    .container {
        max-width: 900px;
        background: #fff;
        border-radius: 16px;
        margin-top: 40px;
        box-shadow: 0 3px 18px #e3eafc;
        padding: 36px;
    }

    .modal-content {
        border-radius: 16px;
    }

    .modal-header {
        background: linear-gradient(92deg, #2090ff 0, #81eae2 96%);
        color: #fff;
        border-radius: 16px 16px 0 0;
    }
</style>
<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

</head>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">



<body>
    <div class="container-fluid my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold mb-0">Product Links Management</h2>
            <button class="btn btn-primary btn-sm" id="openModalBtn">
                <i class="bi bi-plus-lg"></i> Add Product Link
            </button>
        </div>

        <div id="alertBox"></div>

        <div class="table-responsive">
            <!-- NOTE: the ID is required for DataTables -->
            <table id="productLinksTable" class="table table-striped align-middle mb-0" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Post</th>
                        <th style="min-width: 220px;">Product Link</th>
                        <th style="width: 110px;">Price&nbsp;($)</th>
                        <th style="width: 110px;">Action</th>
                    </tr>
                </thead>
                <tbody id="linkData"><!-- rows injected by fetchLinks() --></tbody>
            </table>
        </div>
    </div>
    </div>
    <!--  Modal: Add / Edit Product Link  -->
    <div class="modal fade" id="linkModal" tabindex="-1" aria-modal="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <form class="modal-content" id="linkForm" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Product Link</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row gy-2">
                    <!-- hidden ID for edit -->
                    <input type="hidden" id="link_id" name="id">

                    <div class="col-12">
                        <label for="post_id" class="form-label">Post <span class="text-danger">*</span></label>
                        <select id="post_id" name="post_id" class="form-select" required>
                            <option value="">-- Select Post --</option>
                            <?php foreach ($posts as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="product_link" class="form-label">Product Link <span
                                class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="product_link" name="product_link"
                            placeholder="https://example.com/..." required>
                    </div>

                    <div class="col-12">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="price" name="price"
                            placeholder="Price">
                    </div>
                </div>

                <div class="modal-footer bg-light border-top-0">
                    <button type="submit" class="btn btn-primary" id="saveBtn">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ******************************************************************* -->
    <!--  SCRIPTS – jQuery, Bootstrap JS, DataTables, and your custom code   -->
    <!-- ******************************************************************* -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables (core + Bootstrap-5 adapter) -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        /* ---------- Helpers ---------- */
        const linkModal = new bootstrap.Modal(document.getElementById('linkModal'));

        const showAlert = (msg, type = "success") => {
            $("#alertBox").html(`
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${msg}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`);
        };

        const resetForm = () => {
            $('#linkForm')[0].reset();
            $('#link_id').val("");
            $('#modalTitle').text("Add Product Link");
            $('#saveBtn').text("Add");
        };

        /* ---------- DataTable initialisation / reinitialisation ---------- */
        const initDataTable = () => {
            // Destroy existing instance (avoids re-init errors after Ajax reload)
            if ($.fn.DataTable.isDataTable('#productLinksTable')) {
                $('#productLinksTable').DataTable().destroy();
            }
            $('#productLinksTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                order: [[0, 'desc']],      // newest first
                columnDefs: [
                    { targets: [0, 3, 4], className: 'text-center' }
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search product links..."
                }
            });
        };

        /* ---------- CRUD Ajax ---------- */
        const fetchLinks = () => {
            $.post('ajax/product_links.php', { action: 'fetch' }, data => {
                $('#linkData').html(data);   // server returns <tr> rows
                initDataTable();
            });
        };

        /* ---------- DOM Ready ---------- */
        $(function () {

            /* Load table contents */
            fetchLinks();

            /* Open modal for new link */
            $("#openModalBtn").on('click', () => {
                resetForm();
                linkModal.show();
            });

            /* Add / Update submit */
            $("#linkForm").on('submit', function (e) {
                e.preventDefault();
                const id = $("#link_id").val();

                $.post('ajax/product_links.php', {
                    action: id ? 'update' : 'add',
                    id: id,
                    post_id: $("#post_id").val(),
                    product_link: $("#product_link").val(),
                    price: $("#price").val()
                }, res => {
                    linkModal.hide();
                    showAlert("Saved successfully!", "success");
                    fetchLinks();       // reload table data
                    resetForm();
                }).fail(err => showAlert("Oops! Something went wrong.", "danger"));
            });

            /* Edit button (delegated) */
            $(document).on('click', '.editBtn', function () {
                $("#link_id").val($(this).data("id"));
                $("#post_id").val($(this).data("postid"));
                $("#product_link").val($(this).data("link"));
                $("#price").val($(this).data("price"));

                $('#saveBtn').text("Update");
                $('#modalTitle').text("Edit Product Link");
                linkModal.show();
            });

            /* Delete button (delegated) */
            $(document).on('click', '.deleteBtn', function () {
                if (!confirm("Delete this product link?")) return;

                $.post('ajax/product_links.php', {
                    action: 'delete',
                    id: $(this).data('id')
                }, () => {
                    fetchLinks();
                    showAlert("Deleted successfully!");
                }).fail(err => showAlert("Couldn’t delete the link.", "danger"));
            });
        });
    </script>
</body>



<?php include "footer.php"; ?>