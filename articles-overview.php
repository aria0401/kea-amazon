<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

$articles = Article::getByCategory($conn, $_GET['category']);
$categories = Category::getAll($conn);


?>
<?php
$_title = 'Articles Overview';
$_nav = true;
$_overview = true;
?>
<?php require_once(__DIR__ . '/includes/header.php');  ?>

<?php require_once(__DIR__ . '/includes/sidebar.php');  ?>
<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>
    <div class="items row" id="articlesList">
        <?php foreach ($articles as $article) : ?>
            <div class="item">
                <a href="article.php?id=<?= $article['id']; ?>">
                    <article>
                        <p><?= $article['title']; ?></p>
                        <p><?= $article['price']; ?></p>
                        <?php if ($article['image_file']) : ?>
                            <img src="/uploads/<?= $article['image_file']; ?>" alt="articles image">
                        <?php endif; ?>
                    </article>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <template>
        <a class="a" href="">
            <p class="article_name"></p>
            <img src="" alt="">
        </a>
    </template>



<?php endif; ?>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>