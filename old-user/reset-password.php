<?php

require_once(__DIR__ . '/includes/init.php');

$user = new User();
$expiredKey = false;
$updated = false;

if (!isset($_GET['key']) || strlen($_GET['key']) != 16) {

    Url::redirect('/');
} else {
    $conn = require_once(__DIR__ . '/includes/db.php');
    $user->forgot_password_key = $_GET['key'];

    if (!$user->authenticateKey($conn)) {

        $expiredKey = true;
    } else {
        if (isMethod('post')) {

            $user->newPassword = $_POST['new_password'];
            $user->confirmPassword = $_POST['confirm_password'];

            if ($user->validate()) {
                if ($user->updatePassword($conn)) {

                    $updated = true;
                }
            }
        }
    }
}


$_title = 'Reset Password';


?>

<?php require_once(__DIR__ . '/includes/header.php'); ?>

<?php if ($updated) : ?>
    <h3 class="mt-5">Your password has been succesfully changed.</h3>
    <h5>You can log in now!!!<a class="mx-2" href="/login.php">Log in</a></h5>
<?php else : ?>
    <h3 class="mt-5">Reset your password</h3>
    <?php if ($expiredKey) : ?>
        <p style="color:brown">This link has expired.</p>
    <?php endif; ?>

    <div class="container">
        <form method="post">
            <?php if (!empty($user->errors)) : ?>
                <ul>
                    <?php foreach ($user->errors as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-group">
                <label for="new_password">New password</label>
                <input class="form-control" type="text" name="new_password" id="new_password" value="<?= htmlspecialchars($user->newPassword); ?>">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input class="form-control" type="text" name="confirm_password" id="confirm_password" value="<?= htmlspecialchars($user->confirmPassword); ?>">
            </div>
            <button class="btn">reset</button>
        </form>
    </div>


<?php endif; ?>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>