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
            <?php
            $recipe_ids = Recipe::GetValidIds();
            if (isset($_GET) && isset($_GET['id']) && in_array($_GET['id'], $recipe_ids)) {
               $id_recipe = $_GET['id'];
               $recipe = new Recipe($id_recipe);
               ?>
               <div id="recipe_title">
                  <h2 id="recipte_title"><?php echo $recipe->getName() ?></h2>
                  <div id="recipe_categories">
                     <?php
                     $categories_ids = $recipe->getCategories();
                     for ($i = 0; $i < count($categories_ids); $i++) {
                        ?>
                        <div class="recipe_category_tag">
                           <p>
                              <?php
                              $tag_obj = new Category($categories_ids[$i]);
                              echo $tag_obj->getName();
                              ?>
                           </p>
                        </div>
                        <?php
                     }
                     ?>
                  </div>
               </div>
               <div id="recipe_info">
                  <div id="recipe_tags">
                     <?php
                     $tags_ids = $recipe->getTags();
                     for ($i = 0; $i < count($tags_ids); $i++) {
                        ?>
                        <div class="recipe_tag_tag">
                           <p>
                              <?php
                              $tag_obj = new Tag($tags_ids[$i]);
                              echo $tag_obj->getName();
                              ?>
                           </p>
                        </div>
                        <?php
                     }
                     ?>
                  </div>
                  <p id="recipe_description"><?php echo $recipe->getDescription() ?></p>
               </div>
               <div id="recipe_img">
                  <img src="https://picsum.photos/700/700" alt="">
               </div>
               <div id="recipe_ingredients">
                  <table>
                     <thead>
                        <tr class="recipe_ingredient_header">
                           <th>INGREDIENT</th>
                           <th colspan=2>QUANTITAT</th>
                        </tr>
                     </thead>
                     <tbody>

                        <?php
                        $ingredients_rcp_ids = $recipe->getIngredients();
                        foreach ($ingredients_rcp_ids as $key => $value) {
                           $ingredient_rcp_obj = new Recipe_Ingredient($value['ingredient_id']);
                           ?>
                           <tr class="recipe_ingredient_row">
                              <td>
                                 <?php
                                 $ingredient = new Ingredient($ingredient_rcp_obj->getIngredientId());
                                 echo $ingredient->getName();
                                 ?>
                              </td>
                              <td>
                                 <?php
                                 echo $ingredient_rcp_obj->getQuantity();
                                 ?>
                              </td>
                              <td>
                                 <?php
                                 $unit = new Unit($ingredient_rcp_obj->getUnitId());
                                 echo $unit->getMetric();
                                 ?>
                              </td>
                           </tr>
                           <?php
                        }
                        ?>

                     </tbody>
                  </table>
               </div>
               <div id="recipe_steps">
                  <?php
                  $steps_recipe_ids = $recipe->getSteps();
                  foreach ($steps_recipe_ids as $key => $value) {
                     $step = new Step($value['id']);
                     var_dump($step);
                     ?>
                     <div class="recipe_step">
                        <div class="recipe_step_number">
                           <p></p>
                        </div>
                        <div class="recipe_step_text">
                           <p></p>
                        </div>
                     </div>
                     <?php
                  }
                  ?>
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