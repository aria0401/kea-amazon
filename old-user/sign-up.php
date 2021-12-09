<?php

require_once(__DIR__ . '/includes/init.php');

$user = new User();
$sent = false;
$accountExists = false;

if (isMethod('post')) {

    $conn = require_once(__DIR__ . '/includes/db.php');

    $user->firstname = $_POST['first_name'];
    $user->lastname = $_POST['last_name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->verification_key = bin2hex(random_bytes(16));
    $user->forgot_password_key = bin2hex(random_bytes(8));
    $userId;


    if ($user->validate()) {

        if (!$user->authenticateEmail($conn)) {
            if ($user->create($conn)) {

                $message = 'a verification message has been sent to ' . $user->email;

                $_message = "Thank you for signing up. 
                    <a href='http://localhost:8888/validate-user.php?key=$user->verification_key'>
                    Click here to verify your account
                    </a>";

                $_to_email = $user->email;

                $_subject = 'Thank you for sign up';

                require_once(__DIR__ . '/vendor/send-email.php');


                $newUser = User::getById($conn, $user->id);
                // var_dump($newUser);
            }
        } else {
            $accountExists = true;
        }
    }
}


?>
<?php $_title = 'Sign up'; ?>
<?php require_once(__DIR__ . '/includes/header.php');  ?>

<?php if ($message) : ?>
    <p><?= $message; ?></p>
<?php else : ?>
    <h3 class="mt-5">Sign up</h3>

    <?php if ($accountExists) : ?>
        <p style="color:brown">An account with this email address already exists.</p>
    <?php endif; ?>

    <?php if (!empty($user->errors)) : ?>
        <ul>
            <?php foreach ($user->errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="first_name">First name</label>
                <input class="form-control" type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($user->firstname); ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($user->lastname); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email" value="<?= htmlspecialchars($user->email); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" value="<?= htmlspecialchars($user->password); ?>">
            </div>
            <button class="btn">Sign up</button>
        </form>
        <div class="mt-3">
            <p>Or log in if you have an account <a href="/login.php">Log in</a></p>

        </div>
    </div>

<?php endif; ?>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>