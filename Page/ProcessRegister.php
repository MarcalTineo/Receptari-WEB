<?php
require_once "Utils/requireCRUDs.php";
require "Utils/SessionManager.php";

if (
   $_SERVER["REQUEST_METHOD"] === "POST" &&
   !empty($_POST)
) {
   var_dump($_POST);
   //check data against database
   //email, phone number and username must be unique.
   $conn = (new Connection("localhost", "root", "", "receptari"))->connect();

   $username = $_POST['r_username'];
   $email = $_POST['r_email'];
   $phone = $_POST['r_tel'];

   $resultUsername = $conn->query("SELECT * FROM users WHERE username = '$username'");
   $resultEmail = $conn->query("SELECT * FROM users WHERE email = '$email'");
   $resultPhone = $conn->query("SELECT * FROM users WHERE phone = '$phone'");

   $conn->close();

   if ($resultEmail->num_rows != 0 || $resultUsername->num_rows != 0 || $resultPhone->num_rows != 0) {
      //data repeated -> send back to register page.
      //TO DO: error flags to inform user.
      var_dump("FAIL");
      header("Location: registre.php");
      exit();
   } else {
      //create an empty user.
      $user = new User(0);

      //set values to user object
      $user->setName($_POST['r_nom']);
      $user->setSurname1($_POST['r_cognom1']);
      $user->setSurname2($_POST['r_cognom2']);
      $user->setEmail($_POST['r_email']);
      $user->setPhone($_POST['r_tel']);
      $user->setAddress($_POST['r_address']);
      $user->setUsername($_POST['r_username']);
      $user->setPassword($_POST['r_password']);
      $user->setRoleId(2);
      $user->setRecipesCreated(0);
      $user->setLastAccess(date('Y-m-d H:i:s'));

      //create user at the database
      $user->createSelf();

      //login the user
      $session = new SessionManager();
      $session->login($user->getId(), $user->getUsername(), $user->getRoleId());

      //return to landing page
      header("Location: landing.php");
      exit();
   }
}

?>