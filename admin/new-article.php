<?php

require_once(__DIR__ . '/../includes/init.php');

$article = new Article();
$conn = require_once(__DIR__ . '/../includes/db.php');

$category_ids = [];
$categories = Category::getAll($conn);

if (isMethod('post')) {


    $article->title = $_POST['title'];
    $article->description = $_POST['description'];
    $article->price = $_POST['price'];

    $category_ids = $_POST['category'] ?? [];

    if ($article->validate()) {

        if ($article->create($conn)) {

            $article->setCategories($conn, $category_ids);

            Url::redirect("/admin/article.php?id={$article->id}");
        }
    }
}


?>


<?php $_title = 'Admin/new article'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>

<h2>New Article</h2>

<?php require_once(__DIR__ . '/includes/article-form.php'); ?>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>