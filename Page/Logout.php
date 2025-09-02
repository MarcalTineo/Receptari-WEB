<?php
require_once "Utils/SessionManager.php";

$session = new SessionManager();
$session->logout();

header("Location: landing.php");

?>