<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);

    if (!$article) {
        die("article not found");
    }
} else {
    die("id not supplied, article not found");
}

$category_ids = array_column($article->getCategories($conn), 'id');
$categories = Category::getAll($conn);

if (isMethod('post')) {

    $article->title = $_POST['title'];
    $article->description = $_POST['description'];
    $article->price = $_POST['price'];

    $category_ids = $_POST['category'] ?? [];

    if ($article->validate()) {

        if ($article->update($conn)) {

            $article->setCategories($conn, $category_ids);

            Url::redirect("/admin/article.php?id={$article->id}");
        }
    }
}

?>


<?php $_title = 'Admin/edit article'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>


<div class="container mb-5">
    <h2 class="my-3">Edit Article</h2>
    <?php require_once(__DIR__ . '/includes/article-form.php'); ?>
</div>


<?php require_once(__DIR__ . '/includes/footer.php'); ?>