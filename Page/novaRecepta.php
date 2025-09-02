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
   <script src="../JS/novaRecepta.js"></script>
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
               <div class="nr_input" id="nr_dificulty_field">
                  <div class="nr_input_title">
                     <label for="nr_title">Dificultat</label>
                  </div>
                  <div class="nr_input_select">
                     <div class="nr_tag">
                        <p>Fàcil</p>
                     </div>
                     <div class="nr_tag">
                        <p>Mitjà</p>
                     </div>
                     <div class="nr_tag">
                        <p>Difícil</p>
                     </div>
                     <p class="nr_input_selection"></p>
                  </div>
               </div>
               <div class="nr_input" id="nr_dificulty_field">
                  <div class="nr_input_title">
                     <label for="nr_title">Racions</label>
                  </div>
                  <div class="nr_input_select">
                     <div class="nr_tag ">
                        <p>1</p>
                     </div>
                     <div class="nr_tag">
                        <p>2</p>
                     </div>
                     <div class="nr_tag">
                        <p>4</p>
                     </div>
                     <div class="nr_tag">
                        <p>6</p>
                     </div>
                     <div class="nr_tag">
                        <p>8</p>
                     </div>
                     <div class="nr_tag">
                        <p>10</p>
                     </div>
                     <p class="nr_input_selection"></p>
                  </div>
               </div>
               <h3 id="nr_section_ingredients">Ingredients</h3>
               <h3 id="nr_section_steps">Passos</h3>


            </div>
         </div>
      </main>
      <?php
      require "Page_component/footer.php";
      ?>
   </div>
</body>

</html>