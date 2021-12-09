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

if (isMethod('post')) {

    $article->title = $_POST['title'];
    $article->description = $_POST['description'];
    $article->price = $_POST['price'];

    if ($article->validate()) {

        if ($article->update($conn)) {

            Url::redirect("/admin/article.php?id={$article->id}");
        }
    }
}

?>


<?php $_title = 'Admin/edit article'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>



<h1>edit</h1>


<?php require_once(__DIR__ . '/includes/article-form.php'); ?>
<?php require_once(__DIR__ . '/includes/footer.php'); ?>