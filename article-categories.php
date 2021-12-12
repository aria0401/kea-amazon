<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');
$categories = Category::getAll($conn);

if (isset($_GET['id'])) {

    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}


?>
<?php
$_title = 'Article';
$_nav = true;
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
        <div class="col-12 col-sm-9 main-content mt-5">

            <div class="mt-5">
                <?php if ($article) : ?>

                    <article class="row">
                        <?php if ($article[0]['image_file']) : ?>
                            <div class="col-4">
                                <img class="" src="../uploads/<?= $article[0]['image_file']; ?>" alt="articles image">
                            </div>
                        <?php endif; ?>
                        <div class="col-8 row">
                            <h2 class="w-75 mb-4"><?= htmlspecialchars($article[0]['title']); ?></h2>
                            <p class="w-75"><?= htmlspecialchars($article[0]['description']); ?></p>
                            <strong class="">&#36;<?= htmlspecialchars($article[0]['price']); ?></strong>
                            <?php if ($article[0]['category_name']) : ?>
                                <h5 class="">Categories:</h5>
                                <ul>
                                    <?php foreach ($article as $a) : ?>
                                        <li><?= htmlspecialchars($a['category_title']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </article>

                <?php else : ?>
                    <p>We could not find this article.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>


<?php require_once(__DIR__ . '/includes/footer.php'); ?>