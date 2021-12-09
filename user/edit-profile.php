<?php
require_once(__DIR__ . '/../includes/init.php');

$conn = require_once(__DIR__ . '/../includes/db.php');
$newUser = new User();

$firstname;
$lastname;
$email;

if (isMethod('get')) {

    $current_user = User::getById($conn, $_GET['id']);

    //display current values in the form
    $firstname = $current_user->first_name;
    $lastname = $current_user->last_name;
    $email = $current_user->email;
}

if (isMethod('post')) {

    $newUser->firstname = $_POST['first_name'];
    $newUser->lastname = $_POST['last_name'];
    $newUser->email = $_POST['email'];
    $newUser->password = $_POST['password'];
    $newUser->id = $userID;

    //display new values in the form
    $firstname = $newUser->firstname;
    $lastname = $newUser->lastname;
    $email = $newUser->email;


    if ($newUser->validate()) {

        if ($newUser->authenticateEmail($conn)) {

            if ($newUser->updateProfile($conn)) {

                $message = 'Your profile has been updated';
                $_SESSION['username'] = $newUser->firstname;
            }
        }
    }
}

$_title = 'Edit Profile';
?>

<?php require_once(__DIR__ . '/../includes/header.php'); ?>

<?php if ($message) : ?>
    <div class="container-form-page send-message mt-4">
        <div class="form p-4">
            <h4 class=""><?= $message; ?></h4>
            <p class="mt-4">Back to shop now!!!</p>
            <div class="mt-3">
                <a href="/">
                    <button class="btn w-100 primary_button">Home</button>
                </a>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container-form-page mt-4">
        <div class=" form p-4">
            <h1 class="">Edit profile</h1>
            <?php if (!empty($user_not_found)) : ?>
                <p class="mt-3" class="error"><?= $user_not_found; ?></p>
            <?php endif; ?>
            <form method="post">

                <?php if (!empty($newUser->errors)) : ?>
                    <ul>
                        <?php foreach ($newUser->errors as $error) : ?>
                            <li class="error"><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input class="form-control" type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($firstname); ?>" placeholder="New first name">
                </div>
                <div class="form-group mt-2">
                    <label for="last_name">Last Name</label>
                    <input class="form-control" type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($lastname); ?>" placeholder="New last name">
                </div>
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="<?= htmlspecialchars($email); ?>" placeholder="New email">
                </div>
                <div class="form-group mt-2">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="<?= htmlspecialchars($newUser->password); ?>" placeholder="New password">
                </div>
                <button class="btn primary_button w-100 mt-3">Edit Profile</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>