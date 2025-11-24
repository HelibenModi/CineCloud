<pre><?php var_dump(get_defined_vars()); ?></pre>
<?php require 'app/views/templates/headerPublic.php'; ?>
<main class="container py-5">
    <h2>AI Review for <?= isset($title) ? htmlspecialchars($title) : 'Unknown Movie' ?></h2>
    <div class="alert alert-info">
        <?= isset($review) ? nl2br(htmlspecialchars($review)) : 'No review available.' ?>
    </div>
    <a href="/movie/search" class="btn btn-secondary">Search Another Movie</a>
</main>
<?php require 'app/views/templates/footer.php'; ?>
