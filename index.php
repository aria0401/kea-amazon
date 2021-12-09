<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

// $articles = Article::getAll($conn);
$categories = Category::getAll($conn);
$publicShop = json_decode(file_get_contents('tsv-parser/shop.txt'));

?>
<?php
$_title = 'Home';
$_nav = true;
$_bodyClass = 'index-page';
?>
<?php require_once(__DIR__ . '/includes/header.php');  ?>

<div class="page-hero">
    <img src="media/amazon_splash1.jpg" alt="hero image">
</div>

<div class="container">
    <?php if (empty($categories)) : ?>
        <p>No articles found.</p>
    <?php else : ?>
        <div class="categories-wrapper row">
            <?php foreach ($categories as $category) : ?>
                <div class="category col-4 col-xl-3 mb-4">
                    <a href="articles-overview.php?category=<?= $category['name']; ?>">
                        <div class="category-item">
                            <h4><?= $category['title']; ?></h4>
                            <img src="media/categories-img/<?= $category['name'] . '.jpg'; ?>" alt="<?= $category['title']; ?>">
                            <p class="a-sm-txt mt-2">Shop now</p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if ($publicShop) : ?>
        <div class="items">
            <?php foreach ($publicShop as $item) : ?>
                <div class="item">
                    <p><?= $item->title_en; ?></p>
                    <img src='https://coderspage.com/2021-F-Web-Dev-Images/<?= $item->image ?>'>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>