<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Punto de Sabor</title>
   <?php
   require "Utils/requireHead.php";
   ?>
   <link rel="stylesheet" href="../CSS/novaRecepta.css">
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
            <div id="nr_wrapper">
               <div id="nr_title">
                  <h2>Nova Recepta</h2>
               </div>
               <div class="nr_input" id="nr_title">
                  <div class="nr_input_title">
                     <label for="r_password">Títol de la Recepta</label>
                  </div>
                  <div class="nr_input_field">
                     <input type="text" name="r_password" id="r_password" placeholder="Títol de la Recepta">
                  </div>
               </div>

            </div>
         </div>
      </main>
      <?php
      require "Page_component/footer.php";
      ?>
   </div>
</body>

</html>