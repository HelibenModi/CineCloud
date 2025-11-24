<?php require 'app/views/templates/headerPublic.php'; ?>

<style>
.hero {
    min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 40px;
    background: linear-gradient(to bottom right, 135deg, #0f2027, #203a43, #2c5364);
}

.hero h1 {
    font-weight: 700;
}

.hero p {
    font-size: 1.25rem;
    color: #555;
}
</style>

<section class="hero">
    <div>
        <h1 class="display-3">CineCloud</h1>
        <p class="mt-3"></p>

        <div class="mt-4">
            <a href="/login/index" class="btn btn-primary btn-lg me-2">
                Login
            </a>
            <a href="/create/index" class="btn btn-outline-primary btn-lg">
                Signup
            </a>
        </div>

        <p class="mt-4 text-muted"></p>
    </div>
</section>

<?php require 'app/views/templates/footer.php'; ?>
