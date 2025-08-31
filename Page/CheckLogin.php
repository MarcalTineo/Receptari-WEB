<?php
require "Utils/requireCRUDs.php";
require "Utils/SessionManager.php";


if (
   $_SERVER["REQUEST_METHOD"] === "POST" &&
   !empty($_POST) &&
   isset($_POST["login_username"]) &&
   !empty($_POST["login_username"])
) {
   //comporovar si l'usuari entrat és Anonymous, ja que no es un usuari valid, i només s'utilitza per usuaris eliminats.
   if ($_POST["login_username"] == "Anonymous") {
      header("Location: login.php?error=1");
      exit();
   }
   //llegir BBDD
   $read = User::readByUsername($_POST['login_username']);

   //comporvar si existeix l'usuari
   if ($read->num_rows == 0) {
      header("Location: login.php?error=0");
      exit();
   }
   //carregar l'objecte usuari
   foreach ($read as $key => $value) {
      $row = $value;
   }
   $user = new User($row['id']);

   //comprovar contrasenya
   if ($user->getPassword() == $_POST['login_password']) {
      //inici sessió
      $session = new SessionManager();
      $session->login($user->getId(), $user->getUsername(), $user->getRoleId());

      header("Location: landing.php");
      exit();

   } else {
      header("Location: login.php?error=2");
      exit();
   }


} else {
   header("Location: login.php");
   exit();
}
?>