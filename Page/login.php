<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Punto de Sabor</title>
   <?php
   require "Utils/requireHead.php";
   ?>
   <link rel="stylesheet" href="../CSS/login.css">
</head>

<body>
   <?php
   require "Utils/requireCRUDs.php";
   require "Utils/CheckSession.php";
   ?>
   <div id="page_wrapper">
      <?php
      require "Page_component/header.php";
      ?>
      <main>
         <div id="content">
            <form action="CheckLogin.php" method="post">
               <div id="login_box">
                  <h2>Inicia la sessió</h2>
                  <?php
                  if (!empty($_GET)) {
                     switch ($_GET['error']) {
                        case 0: //usuari o contrasenya incorrectes
                           ?>
                           <p id="login_error_msg">L'usuari o la contrasenya son incorrectes.</p>
                           <?php
                           break;
                        case 1: //usuari anonymous
                           ?>
                           <p id="login_error_msg">L'usuari Anonymous no és vàlid.</p>
                           <?php
                           break;
                     }
                  }
                  ?>
                  <label for="login_username">Nom d'usuari</label>
                  <input type="text" name="login_username" id="login_username" class="login_input">
                  <label for="login_password">Contrasenya</label>
                  <input type="pasword" name="login_password" id="login_password" class="login_input">
                  <input type="submit" value="Inicia la sessió" id="login_submit">
                  <a href="registre.php">
                     <div id="login_register_button">
                        <p>No tens un compte? Registra't</p>
                     </div>
                  </a>
               </div>
            </form>
         </div>
      </main>
      <?php
      require "Page_component/footer.php";
      ?>
   </div>
</body>

</html>