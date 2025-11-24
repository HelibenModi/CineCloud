<?php require 'app/views/templates/headerPublic.php'; ?>
<main class="d-flex justify-content-center align-items-center text-center" style="min-height: 80vh;">
    <div>
        <h1 class="display-4 fw-bold">Welcome to CineCloud</h1>
        <p class="lead">The Show Must Go On.</p>
        <form method="get" action="/movie/index" class="d-flex justify-content-center mt-4">
            <input type="text" name="title" class="form-control form-control-lg w-50" placeholder="Enter movie title..." required>
            <button type="submit" class="btn btn-primary btn-lg ms-3">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>
</main>
<?php if (isset($_GET['logout'])): ?>
<script>
    var toast = new bootstrap.Toast(document.getElementById('logoutToast'));
    toast.show();
</script>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="logoutToast" class="toast align-items-center text-bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                You have been logged out successfully.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<?php endif; ?>
<?php require 'app/views/templates/footer.php'; ?>