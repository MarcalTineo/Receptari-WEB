<?php
require_once "Utils/requireCRUDs.php";

if (
   $_SERVER["REQUEST_METHOD"] === "POST" &&
   !empty($_POST)
) {
   var_dump($_POST);
   //create recipe object
   $newRecipe = new Recipe(0);

   //fill with intrinsec data
   $newRecipe->setName($_POST['nr_title']);
   $newRecipe->setDescription($_POST['nr_description']);
   $newRecipe->setUserAutorId($_POST['nr_autor']);

   //save recipe to database to get an id
   $newRecipeId = $newRecipe->CreateSelf();

   //get the updated recipe from database
   $newRecipe = new Recipe($newRecipeId);

   //category
   $newRecipe->addCategory($_POST['nr_category']);

   //tags
   switch ($_POST['nr_dificultat']) {
      case 'Fàcil':
         $newRecipe->addTag(1);
         break;
      case 'Mitjà':
         $newRecipe->addTag(2);
         break;
      case 'Difícil':
         $newRecipe->addTag(3);
         break;
      default:
         break;
   }

   switch ($_POST['nr_racions']) {
      case '1':
         $newRecipe->addTag(4);
         break;
      case '2':
         $newRecipe->addTag(5);
         break;
      case '4':
         $newRecipe->addTag(6);
         break;
      case '6':
         $newRecipe->addTag(7);
         break;
      case '8':
         $newRecipe->addTag(8);
         break;
      case '10':
         $newRecipe->addTag(9);
         break;
      default:
         break;
   }

   //ingredients
   //decode json
   $ingredients_post = json_decode($_POST['nr_ingredients_array']);
   $ingredients_processed = [];

   //change indexes to work with the recipe object
   foreach ($ingredients_post as $ing_post) {
      $ingredient = [];
      $ingredient['ingredient_id'] = $ing_post[0];
      $ingredient['quantity'] = $ing_post[1];
      $ingredient['unit_id'] = $ing_post[2];
      array_push($ingredients_processed, $ingredient);
   }
   //set ingredients to recipe object
   $newRecipe->setIngredients($ingredients_processed);

   //steps
   //decode json
   $steps_post = json_decode($_POST['nr_step_array']);
   $steps_processed = [];

   //change indexes to work with the recipe object
   foreach ($steps_post as $key => $value) {
      $step = [];
      $step['step_index'] = $key;
      $step['text'] = $value;
      array_push($steps_processed, $step);
   }
   //set ingredients to recipe object
   $newRecipe->setSteps($steps_processed);

   //update database
   $newRecipe->updateSelf();

   $recipe_url = "recepta.php?id=" . $newRecipeId;
   header("Location: " . $recipe_url);

} else {
   header("Location: landing.php");
   exit();
}
?>