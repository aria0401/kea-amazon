<?php
require_once(__DIR__ . '/../includes/init.php');

$user = new User();

if (isMethod('post')) {

    $conn = require_once(__DIR__ . '/../includes/db.php');
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->validate()) {

        if ($user->authenticateLogin($conn, $user->password)) {

            if ($user->checkVerified($conn)) {

                $userObj = User::getByEmail($conn, $user->email);

                Auth::login($userObj);
                Url::redirect('/');
            } else {
                $error = 'You have not verified your account yet.';
            }
        } else {
            $error = 'Login incorrect. Make sure you have the right credentials.';
        }
    }
}
?>
<?php $_title = 'Log in'; ?>
<?php require_once(__DIR__ . '/../includes/header.php');  ?>




<div class="container-form-page mt-4">
    <div class=" form p-4">
        <h1>Log in</h1>
        <form method="post">
            <?php if (!empty($error)) : ?>
                <p class="error"><?= $error; ?></p>
            <?php endif; ?>
            <?php if (!empty($user->errors)) : ?>
                <ul>
                    <?php foreach ($user->errors as $error) : ?>
                        <li class="error"><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email" value="<?= htmlspecialchars($user->email); ?>">
            </div>
            <div class="form-group mt-2">
                <label for="password">password</label>
                <input class="form-control" type="password" name="password" id="password" value="<?= htmlspecialchars($user->password); ?>">
            </div>
            <button class="btn primary_button w-100 mt-3">Log in</button>
        </form>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Need help?
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/user/forgot-password.php">Forgot your password?</a></li>
            </ul>
        </div>
    </div>
    <div class="mt-3">
        <a href="/user/sign-up.php">
            <button class="btn w-100 secondary_button">Create your Amazon account</button>
        </a>
    </div>
</div>


<?php require_once(__DIR__ . '/../includes/footer.php'); ?>