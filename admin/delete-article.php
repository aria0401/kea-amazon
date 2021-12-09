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

    if ($article->delete($conn)) {
        Url::redirect("/admin/index.php");
    }
}

?>


<?php $_title = 'Admin/delete article'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>



<h2>Delete Article</h2>
<form method="post">
    <p>Are you sure you want to delete this article: <?= $article->title; ?> ?</p>
    <button>Delete</button>
    <a href="article.php?id=<?= $article->id; ?>">Cancel</a>
</form>



<?php require_once(__DIR__ . '/includes/footer.php'); ?>