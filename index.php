<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

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
        <div class="slick-container">
            <h2 class="p-5 pb-0">Best Sellers</h2>
            <div class="carousel">
                <?php foreach ($publicShop as $item) : ?>
                    <div class="p-4">
                        <div class="slick-item">
                            <div class="mb-3">
                                <p class="details mb-1"><?= $item->tittle_en; ?></p>
                                <strong>&#36;<?= $item->price; ?>.00</strong>
                            </div>
                            <div class="img">
                                <img src='https://coderspage.com/2021-F-Web-Dev-Images/<?= $item->image ?>'>
                            </div>
                            <p class="a-sm-txt">Shop now</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <!-- <div class="slick-container">
        <h2>Best Sellers</h2>
        <div class="carousellll">
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-2.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-3.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-4.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-5.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-2.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-6.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-2.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-8.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-2.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
            <div class="p-4">
                <div class="p-4 slick-item">
                    <img src="uploads/a-shop-9.jpg" alt="">
                    <p>some text</p>
                </div>
            </div>
        </div>
    </div> -->

</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>