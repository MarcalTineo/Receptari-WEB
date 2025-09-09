<?php
$recipe = new Recipe($recipe_id);
?>

<a class="rCard_link" href=<?php echo "recepta.php?id=" . $recipe_id ?>>
   <div class="recipeCard" id="<?php "rCard_" . $recipe->getId() ?>">
      <div class="rCard_visuals">
         <div class="rCard_img">
            <img src="https://picsum.photos/500/300" alt="">
         </div>
         <div class="rCard_info">
            <div class="rCard_title">
               <p> <?php echo $recipe->getName() ?> </p>
            </div>
            <div class="rCard_category">
               <div>
                  <?php echo $recipe->getFirstCategoryName() ?>
               </div>
            </div>
            <div class="rCard_description">
               <p><?php echo $recipe->getDescription() ?></p>
            </div>
         </div>
      </div>
      <div class="rCard_interactions">

      </div>
   </div>
</a>