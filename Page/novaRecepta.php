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
               <div class="nr_input" id="nr_title_field">
                  <div class="nr_input_title">
                     <label for="nr_title">Títol de la Recepta</label>
                  </div>
                  <div class="nr_input_field">
                     <input type="text" name="nr_title" id="nr_titleRecepta" placeholder="Títol de la Recepta">
                  </div>
               </div>
               <div class="nr_input" id="nr_category_field">
                  <div class="nr_input_title">
                     <label for="nr_category">Categoria</label>
                  </div>
                  <div class="nr_input_field">
                     <select name="nr_category" id="nr_category">
                        <option value="" disabled selected>Categories</option>
                        <?php
                        $categories = Category::readAll();
                        foreach ($categories as $key => $value) {
                           ?>
                           <option value="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></option>
                           <?php
                        }
                        ?>
                     </select>
                     <!-- <input type="text" name="nr_category" id="nr_category" placeholder="Categoria"> -->
                  </div>
               </div>
               <div class="nr_input" id="nr_tags_field">
                  <div id="nr_difficulty">
                     <div class="nr_tag nr_tag_selected">
                        <p>Fàcil</p>
                     </div>
                     <div class="nr_tag nr_tag_unselected">
                        <p>Mitjà</p>
                     </div>
                     <div class="nr_tag nr_tag_unselected">
                        <p>Difícil</p>
                     </div>
                  </div>
                  <div id="nr_servings">
                     <div class="nr_tag nr_tag_selected">
                        <p>1</p>
                     </div>
                     <div class="nr_tag nr_tag_unselected">
                        <p>2</p>
                     </div>
                     <div class="nr_tag nr_tag_unselected">
                        <p>4</p>
                     </div>
                     <div class="nr_tag nr_tag_unselected">
                        <p>6</p>
                     </div>
                     <div class="nr_tag nr_tag_unselected">
                        <p>8</p>
                     </div>
                     <div class="nr_tag nr_tag_unselected">
                        <p>10</p>
                     </div>
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