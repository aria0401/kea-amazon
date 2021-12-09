<?php

require_once(__DIR__ . '/includes/init.php');

$user = new User();
$sent = false;


if (isMethod('post')) {

    $conn = require_once(__DIR__ . '/includes/db.php');

    $user->email = $_POST['email'];

    if ($user->validate()) {

        $key = User::getByEmail($conn, $user->email, 'forgot_password_key');


        if ($user->authenticateEmail($conn)) {

            $message = 'A verification message has been sent to ' . $user->email;

            $_message = "A last new message from reset your password. 
                <a href='http://localhost:8888/reset-password.php?key={$key->forgot_password_key}'>
                Click here to reset your password.
                </a>";

            $_to_email = $user->email;

            $_subject = 'Reset password request';

            require_once(__DIR__ . '/vendor/send-email.php');
        } else {
            $user_not_found = 'It seems like you do not have an account yet';
        }
    }
}



$_title = 'Forgot Password';


?>

<?php require_once(__DIR__ . '/includes/header.php'); ?>

<?php if ($message) : ?>
    <p class="mt-5"><?= $message; ?></p>
<?php else : ?>

    <h3 class="mt-5">Forgot password?</h3>


    <?php if (!empty($user_not_found)) : ?>
        <p class="mt-3" style="color:brown"><?= $user_not_found; ?></p>
    <?php else : ?>
        <p>You can reset your password here</p>
    <?php endif; ?>

    <div class="container">
        <?php if (!empty($user->errors)) : ?>
            <ul>
                <?php foreach ($user->errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="Your email address" value="<?= htmlspecialchars($user->email); ?>">
            </div>
            <button class="btn">Reset</button>
        </form>
    </div>

<?php endif; ?>


<?php require_once(__DIR__ . '/includes/footer.php'); ?>