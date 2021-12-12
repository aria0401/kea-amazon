<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);
    $title = $article->title;
    $description = $article->description;


    if (!$article) {
        die("article not found");
    }
} else {
    die("id not supplied, article not found");
}


$image = new Image();

if (isMethod('post')) {

    $previous_image = $article->image_file;
    if ($article->setImageFile($conn, null)) {

        if ($previous_image) {
            unlink("../uploads/$previous_image");
        }
        Url::redirect("/admin/article.php?id={$article->id}");
    }
}

?>


<?php $_title = 'Admin/delete image'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>

<div class="container">
    <h2 class="my-3">Delete Article Image</h2>
    <div class="row">
        <?php if ($article->image_file) : ?>
            <img class="col-4" src="../uploads/<?= $article->image_file; ?>" alt="articles image">
        <?php endif; ?>
    </div>
    <form method="post">
        <p class="mt-3">Are you sure you want to delete this image?</p>
        <button class="btn">Delete</button>
        <a href="edit-article-image.php?id=<?= $article->id; ?>">Cancel</a>
    </form>
</div>


<?php require_once(__DIR__ . '/includes/footer.php'); ?>