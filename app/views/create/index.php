<?php require 'app/views/templates/headerPublic.php'; ?>
<style>
    body {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        min-height: 100vh;
        color: #fff;
    }
</style>

<main class="d-flex align-items-center justify-content-center vh-100">
    <div class="w-100" style="max-width: 400px;">
        <h1 class="text-center mb-4 fw-bold">Create Account</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="/create/register" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-lg">Register</button>
        </form>

    
    </div>
</main>

<?php require 'app/views/templates/footer.php'; ?>
