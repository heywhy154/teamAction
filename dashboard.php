<?php
require_once("./auth/validation.php");
if (isset($_POST['logout']) || !isset($_SESSION['user'])) {
    session::end_session();
    header("location: ./");
}
$user_data = $user->user_profile($_SESSION['user']);
$title = " | " . ucfirst($user_data['username']);
$style_path = "assets/css/dashboard.css";
include_once("./includes/head.php");
include_once("./boards/user_board.php");
include_once("./includes/footer.php");
