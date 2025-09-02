<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Punto de Sabor</title>
   <?php
   require "Utils/requireHead.php";
   ?>
   <link rel="stylesheet" href="../CSS/perfil.css">
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
            <div id="perfil_container">

               <?php
               $user = new $user($session->get("user_id"));

               ?>
               <div id="perfil_title">
                  <h2>Perfil d'Usuari</h2>

                  <a href="Logout.php">Surt de la sessió</a>
               </div>
               <h3 id="perfil_section_name">Nom</h3>
               <div class="perfil_input" id="perfil_nom">
                  <div class="perfil_input_title">
                     <label for="r_nom">Nom</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="text" name="r_nom" id="r_nom" placeholder="Nom" disabled="true"
                        value="<?php echo $user->getName() ?>">
                  </div>
               </div>
               <div class="perfil_input" id="perfil_cognom1">
                  <div class="perfil_input_title">
                     <label for="r_cognom1">Primer Cognom</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="text" name="r_cognom1" id="r_cognom1" placeholder="Primer Cognom" disabled="true"
                        value="<?php echo $user->getSurname1() ?>">
                  </div>
               </div>
               <div class="perfil_input" id="perfil_cognom2">
                  <div class="perfil_input_title">
                     <label for="r_cognom2">Primer Cognom</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="text" name="r_cognom2" id="r_cognom2" placeholder="Segon Cognom" disabled="true"
                        value="<?php echo $user->getSurname2() ?>">
                  </div>
               </div>
               <h3 id="perfil_section_contact">Contacte</h3>
               <div class="perfil_input" id="perfil_email">
                  <div class="perfil_input_title">
                     <label for="r_email">E-mail</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="text" name="r_email" id="r_email" placeholder="E-mail" disabled="true"
                        value="<?php echo $user->getEmail() ?>">
                  </div>
               </div>
               <div class="perfil_input" id="perfil_tel">
                  <div class="perfil_input_title">
                     <label for="r_tel">Telèfon</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="text" name="r_tel" id="r_tel" placeholder="Telèfon" disabled="true"
                        value="<?php echo $user->getPhone() ?>">
                  </div>
               </div>
               <div class="perfil_input" id="perfil_address">
                  <div class="perfil_input_title">
                     <label for="r_address">Adreça</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="text" name="r_address" id="r_address" placeholder="Adreça" disabled="true"
                        value="<?php echo $user->getAddress() ?>">
                  </div>
               </div>
               <h3 id="perfil-section-login">Informació de Login</h3>
               <div class="perfil_input" id="perfil_username">
                  <div class="perfil_input_title">
                     <label for="r_username">Nom d'usuari</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="text" name="r_username" id="r_username" placeholder="Nom d'usuari" disabled="true"
                        value="<?php echo $user->getUsername() ?>">
                  </div>
               </div>
               <div class="perfil_input" id="perfil_password">
                  <div class="perfil_input_title">
                     <label for="r_password">Contrasenya</label>
                  </div>
                  <div class="perfil_input_field">
                     <input type="password" name="r_password" id="r_password" placeholder="Contrasenya" disabled="true"
                        value="<?php echo $user->getPassword() ?>">
                  </div>
               </div>
               <h3 id="perfil_section_myRecipes">Les meves receptes</h3>
            </div>
         </div>
      </main>
      <?php
      require "Page_component/footer.php";
      ?>
   </div>
</body>

</html>