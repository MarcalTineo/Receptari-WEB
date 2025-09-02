<?php
require_once "SessionManager.php";

$session = new SessionManager();
// var_dump($_SESSION);

// If no user data, start guest session
if (!isset($_SESSION['user_id'])) {
   $session->startGuest();
}

// If logged in, validate
if ($session->isLoggedIn()) {
   $user = new User($session->get("user_id"));
   $session->validate($user);
}
?>