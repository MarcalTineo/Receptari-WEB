<?php
require_once "Utils/requireCRUDs.php";

if (
   $_SERVER["REQUEST_METHOD"] === "POST" &&
   !empty($_POST)
) {

   var_dump($_POST);



} else {
   header("Location: landing.php");
   exit();
}
?>