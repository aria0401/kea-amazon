<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

if (isset($_POST['category_id'])) {


    $articles = Article::getByCategoryID($conn, $_POST['category_id']);

    $encode = json_encode($articles, JSON_PRETTY_PRINT);
    echo $encode;
}
