<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Punto de Sabor</title>
   <?php
   require "Utils/requireHead.php";
   ?>
   <link rel="stylesheet" href="../CSS/recepta.css">
</head>
<body>
   <?php require "Utils/requireCRUDs.php"; ?>
   <div id="page_wrapper">
      <?php
      require "Page_component/header.php";
      ?>
      <main>
         <div id="content">
            <?php
            $recipe_ids = Recipe::GetValidIds();
            if (isset($_GET) && isset($_GET['id']) && in_array($_GET['id'], $recipe_ids)) {
               $id_recipe = $_GET['id'];
               $recipe = new Recipe($id_recipe);
               ?>
               <div id="recipe_title">
                  <h2 id="recipte_title"><?php echo $recipe->getName() ?></h2>
                  <div id="recipe_categories">
                     CATEGORIES
                  </div>

               </div>
               <div id="recipe_info">
                  <div id="recipe_tags">
                     TAGS
                  </div>
                  <p id="recipe_description"><?php echo $recipe->getDescription() ?></p>
               </div>
               <div id="recipe_img">
                  <img src="https://picsum.photos/700/700" alt="">
               </div>
               <div id="recipe_ingredients">
                  asd
               </div>
               <div id="recipe_steps">
                  dsaSTEPS
               </div>
               <?php
            } else {
               require "Utils/failToLoadPage.php";
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