<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/css/main.css">
    <title><?= $_title ?? 'keazon' ?></title>
</head>

<body class="container <?= $_bodyClass ?? null ?>">
    <header class="mt-5">
        <h1>keazon Admin</h1>
    </header>
    <nav class="mt-5 mb-3">
        <button class="btn">
            <a href="/admin/">Home</a>
        </button>
        <button class="btn">
            <a href="/admin/new-article.php">New Article</a>
        </button>
    </nav>