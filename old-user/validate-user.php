<?php

require_once(__DIR__ . '/includes/init.php');


if (!isset($_GET['key']) || strlen($_GET['key']) != 32) {

    Url::redirect('/');
} else {
    if (isMethod('get')) {

        $conn = require_once(__DIR__ . '/includes/db.php');

        $user = new User();
        $verified_user = $user->verifyKey($conn, $_GET['key']);

        if ($verified_user['verification_key'] === $_GET['key']) {

            if ($user->verified($conn, $verified_user['id'])) {

                $message =  'CONGRATS.. you are verified';
            }
        }
    }
}


?>

<?php if ($message) : ?>

    <p><?= $message; ?> </p>
<?php endif; ?>