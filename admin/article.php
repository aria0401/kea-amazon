<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);
} else {
    $article = null;
}
?>


<?php $_title = 'Admin/article'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>


<?php if ($article) : ?>

    <article>
        <h2><?= htmlspecialchars($article->title); ?></h2>
        <?php if ($article->image_file) : ?>
            <img src="../uploads/<?= $article->image_file; ?>" alt="articles image">
        <?php endif; ?>
        <p><?= htmlspecialchars($article->description); ?></p>
        <p><?= htmlspecialchars($article->price); ?></p>
    </article>

<?php else : ?>
    <p>We could not find this article.</p>
<?php endif; ?>
<a href="edit-article.php?id=<?= $article->id; ?>">Edit</a>
<a href="delete-article.php?id=<?= $article->id; ?>">Delete</a>
<a href="edit-article-image.php?id=<?= $article->id; ?>">Edit image</a>



<?php require_once(__DIR__ . '/includes/footer.php'); ?>