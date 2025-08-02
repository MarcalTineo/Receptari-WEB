<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Punto de Sabor</title>
   <?php
   require "Utils/requireHead.php";
   ?>

   <!-- page css -->
   <link rel="stylesheet" href="../CSS/novetats.css">
   <link rel="stylesheet" href="../CSS/recipeCard.css">

</head>
<body>
   <?php
   require "Utils/requireCRUDs.php";
   ?>
   <div id="page_wrapper">
      <?php
      require "Page_component/header.php";
      ?>
      <main>
         <div id="content">
            <?php
            $recipe_id = 1;
            for ($i = 0; $i < 6; $i++) {
               require "Page_component/recipeCard.php";
            }
            ?>
         </div>
      </main>
      <?php

      require "Page_component/footer.php";
      ?>
   </div>
</body>
</html>