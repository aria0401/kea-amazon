<?php
require_once(__DIR__ . '/includes/init.php');

$user = new User();

if (isMethod('post')) {

    $conn = require_once(__DIR__ . '/includes/db.php');
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
<?php require_once(__DIR__ . '/includes/header.php');  ?>
<h3 class="mt-5">Log in</h3>

<?php if (!empty($error)) : ?>
    <p style="color:brown"><?= $error; ?></p>
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
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email" value="<?= htmlspecialchars($user->email); ?>">
        </div>
        <div class="form-group">
            <label for="password">password</label>
            <input class="form-control" type="password" name="password" id="password" value="<?= htmlspecialchars($user->password); ?>">
        </div>
        <button class="btn">Log in</button>
    </form>
    <p class="mt-3">Forgot password? <a href="/forgot-password.php">Click here</a></p>
</div>

<div class="mt-3">
    <p>Or sign up <a href="/sign-up.php">here</a></p>

</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>