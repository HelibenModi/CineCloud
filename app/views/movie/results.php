<?php require 'app/views/templates/headerPublic.php'; ?>

<main class="container py-5">

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>

    <?php elseif (!empty($movie)): ?>
        <div class="row mb-5">
            <!-- Movie Poster -->
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" class="img-fluid rounded">
            </div>

            <!-- Movie Details -->
            <div class="col-md-8">
                <h2><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h2>
                <p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
                <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
                <p><strong>Director:</strong> <?= htmlspecialchars($movie['Director']) ?></p>
                <p><strong>Actors:</strong> <?= htmlspecialchars($movie['Actors']) ?></p>
                <p><strong>Runtime:</strong> <?= htmlspecialchars($movie['Runtime']) ?></p>

                <!-- AI Review -->
                <div class="mt-3">
                    <h4>AI Review:</h4>
                    <div class="alert alert-info"><?= nl2br(htmlspecialchars($review)) ?></div>
                </div>
    

                <div class="my-4">
                    <h4>Trailer:</h4>
                    <?php if (!empty($trailer)): ?>
                    <div class="ratio ratio-16x9">
                        <iframe src="<?= $trailer ?>" title="YouTube trailer" allowfullscreen></iframe>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning">Trailer not available.</div>
                    <?php endif; ?>
                </div>


                <!-- Similar Movies -->
               
            </div>
        </div>

        <!-- Rating Form -->
        <?php require 'app/views/movie/rating.php'; ?>

    <?php else: ?>
        <div class="alert alert-warning mt-4">
            No movie found. Please try another title.
        </div>
    <?php endif; ?>

    <!-- Search Another Movie -->
    <div class="mt-3">
        <a href="/movie/search" class="btn btn-light btn-lg me-2">
            <i class="bi bi-search"></i> Search Another Movie
        </a>
    </div>

</main>

<?php require 'app/views/templates/footer.php'; ?>
