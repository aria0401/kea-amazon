<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

// $articles = Article::getAll($conn);
$categories = Category::getAll($conn);
// $publicShop = json_decode(file_get_contents('tsv-parser/shop.txt'));

?>
<?php
$_title = 'Home';
$_nav = true;
?>
<?php require_once(__DIR__ . '/includes/header.php');  ?>

<div class="container mt-5">

    <?php if ($categories) : ?>
        <div class="categories-wrapper row">
            <?php foreach ($categories as $category) : ?>
                <div class="category col-3">
                    <a href="articles-overview.php?category=<?= $category['name']; ?>">
                        <div>
                            <p><?= $category['title']; ?></p>
                            <img src="media/categories-img/<?= $category['name'] . '.png'; ?>" alt="<?= $category['title']; ?>">
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (empty($articles)) : ?>
        <p>No articles found.</p>
    <?php else : ?>
        <div class="items">
            <?php foreach ($articles as $article) : ?>
                <div class="item">
                    <a href="article.php?id=<?= $article['id'] ?>">
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