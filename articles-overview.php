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
$_bodyClass = 'overview-page';
?>
<?php require_once(__DIR__ . '/includes/header.php');  ?>

<div class="container-fluid overview-container" id="main-sidebar">
    <button class="openbtn d-none-desktop" onclick="openNav()">☰ See more categories</button>
    <div id="mySidebar" class="sidebar d-none-desktop">
        <?php require(__DIR__ . '/includes/sidebar.php');  ?>
    </div>
    <div class="row">
        <div class="col-3 sidebar-desktop d-none-mobile">
            <?php require(__DIR__ . '/includes/sidebar.php');  ?>
        </div>
        <div class="col-11 col-sm-9 mx-auto main-content">
            <h2 class="category-title mt-5"> <?= $categoryTitle; ?> </h2>
            <p class="not-found"> <?= empty($articles) ? 'No articles found' : null; ?> </p>

            <div class="d-flex-wrap" id="articlesList">
                <?php foreach ($articles as $article) : ?>
                    <div class="item  mx-auto p-lg-4">
                        <a class="article_a" href="article.php?id=<?= $article['id']; ?>">
                            <article>
                                <?php if ($article['image_file']) : ?>
                                    <img class="article_img mb-3" src="/uploads/<?= $article['image_file']; ?>" alt="articles image">
                                <?php endif; ?>
                                <p class="article_name f-08r"><?= $article['title']; ?></p>
                                <strong class="article_price">&#36;<?= $article['price']; ?></strong>
                            </article>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <template class="article-template">
                <div class="item mx-auto p-lg-4">
                    <a class="article_a" href="">
                        <article>
                            <img class="article_img mb-3" src="" alt="">
                            <p class="article_name f-08r"></p>
                            <strong class="article_price"></strong>
                        </article>
                    </a>
                </div>
            </template>
        </div>
    </div>

</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>