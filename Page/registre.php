<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Punto de Sabor</title>
   <?php
   require "Utils/requireHead.php";
   ?>
   <link rel="stylesheet" href="../CSS/registre.css">
   <script src="../JS/registre.js"></script>
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
            <form action="ProcessRegister.php" method="post">
               <div id="registre_container">
                  <h2 id="registre_title">Registra un nou Usuari</h2>
                  <h3 id="registre_section_name">Nom</h3>
                  <div class="registre_input" id="registre_nom">
                     <div class="registre_input_title">
                        <label for="r_nom">Nom</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="text" name="r_nom" id="r_nom" placeholder="Nom" required>
                     </div>
                  </div>
                  <div class="registre_input" id="registre_cognom1">
                     <div class="registre_input_title">
                        <label for="r_cognom1">Primer Cognom</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="text" name="r_cognom1" id="r_cognom1" placeholder="Primer Cognom" required>
                     </div>
                  </div>
                  <div class="registre_input" id="registre_cognom2">
                     <div class="registre_input_title">
                        <label for="r_cognom2">Primer Cognom</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="text" name="r_cognom2" id="r_cognom2" placeholder="Segon Cognom">
                     </div>
                  </div>
                  <h3 id="registre_section_contact">Contacte</h3>
                  <div class="registre_input" id="registre_email">
                     <div class="registre_input_title">
                        <label for="r_email">E-mail</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="text" name="r_email" id="r_email" placeholder="E-mail">
                     </div>
                  </div>
                  <div class="registre_input" id="registre_tel">
                     <div class="registre_input_title">
                        <label for="r_tel">Telèfon</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="text" name="r_tel" id="r_tel" placeholder="Telèfon">
                     </div>
                  </div>
                  <div class="registre_input" id="registre_address">
                     <div class="registre_input_title">
                        <label for="r_address">Adreça</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="text" name="r_address" id="r_address" placeholder="Adreça">
                     </div>
                  </div>
                  <h3 id="registre-section-login">Informació de Login</h3>
                  <div class="registre_input" id="registre_username">
                     <div class="registre_input_title">
                        <label for="r_username">Nom d'usuari</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="text" name="r_username" id="r_username" placeholder="Nom d'usuari">
                     </div>
                  </div>
                  <div class="registre_input" id="registre_password">
                     <div class="registre_input_title">
                        <label for="r_password">Contrasenya</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="password" name="r_password" id="r_password" placeholder="Contrasenya">
                     </div>
                  </div>
                  <div class="registre_input" id="registre_Rpassword">
                     <div class="registre_input_title">
                        <label for="r_Rpassword">Repeteix la contrasenya</label>
                     </div>
                     <div class="registre_input_field">
                        <input type="password" name="r_Rpassword" id="r_Rpassword"
                           placeholder="Repeteix la contrasenya">
                     </div>
                  </div>
                  <div id="register_submit">
                     <input type="submit" value="Registra">
                  </div>
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