<form method="post" action="/movie/rate">
    <input type="hidden" name="movie_title" value="<?= htmlspecialchars($movie['Title']) ?>">
    <h4 class="mt-4">Rate this movie:</h4>
    <div class="d-flex">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <button type="submit" name="rating" value="<?= $i ?>" class="btn btn-outline-warning me-2">
                <?= str_repeat('<i class="bi bi-star-fill"></i>', $i) ?>
            </button>
        <?php endfor; ?>
    </div>
</form>
