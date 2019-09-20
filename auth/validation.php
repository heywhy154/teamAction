<?php
require_once(dirname(__DIR__) . "/includes/db.php");
include_once("session.php");
include_once("user.php");
if (isset($_GET['e'])) {
    $str = hex2bin($_GET['e']);
    if ($user->verify_user($str) == true) {
        $account_verified = true;
    } else {
        header("location: ../");
    }
}
if (isset($_POST['login'])) {
    $userarr = ["em" => $_POST['email'], "p" => $_POST['password']];
    $hashed_password = $user->login($userarr)['password'];
    if (password_verify($_POST["password"], $hashed_password)) {
        $user_id = $user->login($userarr)['id'];
        session::start_session($user_id);
        header("location: dashboard");
    } else {
        $error = true;
    }
}
if (isset($account_verified) == true) :
    $style_path = "assets/css/index.css";
    $title = null;
    include_once("../includes/head.php");
    ?>

    <div class="d-flex h-100 w-100 position-absolute justify-content-center align-items-center">
        <form class="text-center">
            <p>Your account has been verified, You can now login</p>
            <a href="../" class="btn btn-success">Login</a>
        </form>
    </div>

<?php
    include_once("../includes/footer.php");
endif; ?>