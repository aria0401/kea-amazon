<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

if (isset($_GET['id'])) {

    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php $_title = 'Admin/article'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>

<div class="container">
    <?php if ($article[0]['category_name']) : ?>
        <h5>Categories:</h5>
        <ul>
            <?php foreach ($article as $a) : ?>
                <li><?= htmlspecialchars($a['category_title']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php if ($article) : ?>
        <article class="row">
            <h2 class="col-12"><?= htmlspecialchars($article[0]['title']); ?></h2>
            <?php if ($article[0]['image_file']) : ?>
                <img class="col-3" src="../uploads/<?= $article[0]['image_file']; ?>" alt="articles image">
            <?php endif; ?>
            <p class="col-12"><?= htmlspecialchars($article[0]['description']); ?></p>
            <p class="col-12"><?= htmlspecialchars($article[0]['price']); ?></p>
        </article>

    <?php else : ?>
        <p>We could not find this article.</p>
    <?php endif; ?>
    <a href="edit-article.php?id=<?= $article[0]['id']; ?>">Edit</a>
    <a href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a>
    <a href="edit-article-image.php?id=<?= $article[0]['id']; ?>">Edit image</a>
</div>



<?php require_once(__DIR__ . '/includes/footer.php'); ?>