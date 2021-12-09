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


$image = new Image();

if (isMethod('post')) {

    $image->file_error = $_FILES['file']['error'];
    $image->file_size = $_FILES['file']['size'];
    $image->file_name = $_FILES['file']['name'];

    if ($image->validate()) {

        $destination = $image->fileName()[0];
        $filename = $image->fileName()[1];

        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

            $previous_image = $article->image_file;

            if ($article->setImageFile($conn, $filename)) {

                if ($previous_image) {
                    unlink("../uploads/$previous_image"); //to delete a file in PHP
                }

                Url::redirect("/admin/article.php?id={$article->id}");
            }
        } else {
            echo 'Unable to move uploaded file';
        }
    }
}

?>


<?php $_title = 'Admin/edit image'; ?>
<?php require_once(__DIR__ . '/includes/header.php'); ?>

<?php if ($article) : ?>

    <article>
        <h2><?= $article->title; ?></h2>
        <p><?= $article->description; ?></p>
        <?php if ($article->image_file) : ?>
            <img src="../uploads/<?= $article->image_file; ?>" alt="articles image">
            <a href="delete-article-image.php?id=<?= $article->id; ?>">Delete</a>
        <?php endif; ?>
    </article>

<?php else : ?>
    <p>We could not find this article.</p>
<?php endif; ?>



<?php if (!empty($image->errors)) : ?>
    <ul>
        <?php foreach ($image->errors as $error) : ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <div>
        <label for="file">Image file</label>
        <input type="file" name="file" id="file">
    </div>
    <button>Upload</button>
</form>


<?php require_once(__DIR__ . '/includes/footer.php'); ?>