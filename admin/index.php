<?php

require_once(__DIR__ . '/../includes/init.php');

$conn = require_once(__DIR__ . '/../includes/db.php');

$articles = Article::getAll($conn);


?>
<?php $_title = 'Home-Admin'; ?>

<?php require_once(__DIR__ . '/includes/header.php'); ?>


<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>
    <div>
        <?php foreach ($articles as $article) : ?>
            <div>
                <article>
                    <a href="article.php?id=<?= $article['id'] ?>"> <?= htmlspecialchars($article['title']); ?></a>
                </article>
            </div>
        <?php endforeach; ?>
    </div>


<?php endif; ?>


<?php require_once(__DIR__ . '/includes/footer.php'); ?>