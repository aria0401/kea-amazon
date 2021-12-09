<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');
$categories = Category::getAll($conn);


?>
<?php
$_title = 'Article';
$_nav = true;
?>
<?php require_once(__DIR__ . '/includes/header.php');  ?>
<?php require_once(__DIR__ . '/includes/sidebar.php');  ?>
<div class="container">
    <h1>This page is article. Here i'll show the article with id <?= $_GET['id']; ?></h1>
</div>
<div class="items row" id="articlesList"></div>
<template>
    <a href="">
        <p class="article_name"></p>
        <img src="" alt="">
    </a>
</template>



<?php require_once(__DIR__ . '/includes/footer.php'); ?>