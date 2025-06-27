</div> <!-- End main-content -->
</div> <!-- End d-flex -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const toggleSidebar = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const closeSidebar = document.getElementById("closeSidebar");

    toggleSidebar?.addEventListener("click", () => {
        sidebar.classList.add("show");
    });

    closeSidebar?.addEventListener("click", () => {
        sidebar.classList.remove("show");
    });
</script>
</body>

</html>