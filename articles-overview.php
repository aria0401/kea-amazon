<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');
$categories = Category::getAll($conn);

if (isMethod('get')) {

    $articles = Article::getByCategory($conn, $_GET['category']);

    foreach ($categories as $category) {
        if ($category['name'] == $_GET['category']) {
            $categoryTitle = $category['title'];
        }
    }
}



?>
<?php
$_title = 'Articles Overview';
$_nav = true;
$_overview = 'filter-overview';
?>
<?php require_once(__DIR__ . '/includes/header.php');  ?>

<?php require_once(__DIR__ . '/includes/sidebar.php');  ?>

<h1 class="category-title"> <?= $categoryTitle; ?> </h1>
<p class="not-found"> <?= empty($articles) ? 'No articles found' : null; ?> </p>

<div class="items row" id="articlesList">
    <?php foreach ($articles as $article) : ?>
        <div class="item">
            <a href="article.php?id=<?= $article['id']; ?>">
                <article>
                    <p><?= $article['title']; ?></p>
                    <p>Price: <?= $article['price']; ?></p>
                    <p>ID: <?= $article['id']; ?></p>
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





<?php require_once(__DIR__ . '/includes/footer.php'); ?>