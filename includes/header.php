<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/../styles/css/main.css">
    <title><?= $_title ?? 'Amazona' ?></title>
</head>

<body class=<?= $_bodyClass ?? null ?>>
    <header>
        <?php if ($_nav) : ?>
            <nav class="navbar navbar-expand-sm navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img class="logo-dark" src="/../media/logo-dark.png" alt="logo">
                    </a>

                    <input type="text" class="form-control w-50">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <?php if (Auth::isLoggedIn()) : ?>
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Hello <?= $_SESSION['username']; ?></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/user/edit-profile.php?id=<?= $_SESSION['id']; ?>">Edit Profile</a></li>
                                        <li><a class="dropdown-item" href="/user/logout.php">Log out</a></li>
                                    </ul>
                                <?php else : ?>
                                    <a class="nav-link dropdown-toggle" href="/user/login.php" role="button" data-bs-toggle="dropdown">Hello, Log in</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item d-flex justify-content-center" href="/user/login.php">
                                                <button class="btn primary_button w-75">Log in</button>
                                            </a></li>
                                        <li class="li-inline">New costumer?<a class="dropdown-item" href="/user/sign-up.php">Start here</a></li>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php else : ?>
            <a class="a-logo" href="/">
                <img class="logo-light mt-3" src="/../media/logo-light.png" alt="logo">
            </a>
        <?php endif; ?>

    </header>