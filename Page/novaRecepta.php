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
            <form action="ProcessNewRecipe.php" method="post">
               <!-- gets user id -->
               <input type="hidden" name="nr_autor" value="<?php echo $session->get('user_id') ?>">
               <div id="nr_wrapper">
                  <div id="nr_title">
                     <h2>Nova Recepta</h2>
                  </div>
                  <!-- titol de la recepta -->
                  <div class="nr_input" id="nr_title_field">
                     <div class="nr_input_title">
                        <label for="nr_title">Títol de la Recepta</label>
                     </div>
                     <div class="nr_input_field">
                        <input type="text" name="nr_title" id="nr_titleRecepta" placeholder="Títol de la Recepta">
                     </div>
                  </div>

                  <!-- categoria -->
                  <div class="nr_input" id="nr_category_field">
                     <div class="nr_input_title">
                        <label for="nr_category">Categoria</label>
                     </div>
                     <div class="nr_input_field">
                        <select name="nr_category" id="nr_category" required>
                           <option value="null" disabled selected>Categories</option>
                           <?php
                           $categories = Category::readAll();
                           foreach ($categories as $key => $value) {
                              ?>
                              <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                              <?php
                           }
                           ?>
                        </select>
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
                        <input type="hidden" name="nr_dificultat" class="nr_input_selection">
                     </div>
                  </div>
                  <div class="nr_input" id="nr_rations_field">
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
                        <input type="hidden" name="nr_racions" class="nr_input_selection">
                     </div>
                  </div>
                  <div class="nr_input" id="nr_description_field">
                     <div class="nr_input_title">
                        <label for="nr_description">Descripció breu</label>
                     </div>
                     <div class="nr_input_field">
                        <textarea name="nr_description" id="nr_description" rows="6"
                           placeholder="Descripció breu"></textarea>
                        <!-- <input type="textarea" name="nr_description" id="nr_description" placeholder="Descripció breu"
                        rows="5"> -->
                     </div>
                  </div>
                  <h3 id="nr_section_ingredients">Ingredients</h3>
                  <div id="nr_ingredient_table">
                     <input type="hidden" name="nr_ingredients_array" id="nr_ingredients_array">
                     <div class="nr_ingredient_row" id="nr_ingredient_header">
                        <div class="nr_ingredient_row_addrow"></div>
                        <div class="nr_ingredient_row_name">Ingredient</div>
                        <div class="nr_ingredient_row_quantity">Quantitat</div>
                        <div class="nr_ingredient_row_unit">Unitat de mesura</div>
                     </div>
                     <div class="nr_ingredient_row" id="nr_ingredient_row_template">
                        <div class="nr_ingredient_row_addrow">
                           <p>+</p>
                        </div>
                        <div class="nr_ingredient_row_name">
                           <select name="nr_ingredient" id="nr_ingredient">
                              <option value="" selected disabled>Ingredient</option>
                              <?php
                              $ingredients = Ingredient::readAll();
                              foreach ($ingredients as $key => $value) {
                                 ?>
                                 <option value="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></option>
                                 <?php
                              }
                              ?>
                           </select>
                        </div>
                        <div class="nr_ingredient_row_quantity">
                           <input type="text" name="nr_ingredient_q" id="nr_ingredient_q">
                        </div>
                        <div class="nr_ingredient_row_unit">
                           <select name="nr_ingredient_u" id="nr_ingredient_u">
                              <option value="" disabled selected>Unitat</option>
                              <?php
                              $units = Unit::readAll();
                              foreach ($units as $key => $value) {
                                 ?>
                                 <option value="<?php echo $value['metric'] ?>"><?php echo $value['metric'] ?></option>
                                 <?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="nr_ingredient_row">
                        <div class="nr_ingredient_row_addrow">
                           <p>+</p>
                        </div>
                        <div class="nr_ingredient_row_name">
                           <select name="nr_ingredient0" id="nr_ingredient0">
                              <option value="" selected disabled>Ingredient</option>
                              <?php
                              $ingredients = Ingredient::readAll();
                              foreach ($ingredients as $key => $value) {
                                 ?>
                                 <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                 <?php
                              }
                              ?>
                           </select>
                        </div>
                        <div class="nr_ingredient_row_quantity">
                           <input type="text" name="nr_ingredient_q0" id="nr_ingredient_q0">
                        </div>
                        <div class="nr_ingredient_row_unit">
                           <select name="nr_ingredient_u0" id="nr_ingredient_u0">
                              <option value="" disabled selected>Unitat</option>
                              <?php
                              $units = Unit::readAll();
                              foreach ($units as $key => $value) {
                                 ?>
                                 <option value="<?php echo $value['id'] ?>"><?php echo $value['metric'] ?></option>
                                 <?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>

                  </div>
                  <h3 id="nr_section_steps">Passos</h3>
                  <div id="nr_steps">
                     <input type="hidden" name="nr_step_array" id="nr_step_array">
                     <div id="nr_step_navbar">
                        <div id="nr_step_navbar_left">
                           <svg xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                              <path fill="currentColor"
                                 d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z" />
                           </svg>
                        </div>
                        <div id="nr_step_navbar_step_number">STEP NUMBER</div>
                        <div id="nr_step_navbar_right">
                           <svg xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                              <path fill="currentColor"
                                 d="M566.6 342.6C579.1 330.1 579.1 309.8 566.6 297.3L406.6 137.3C394.1 124.8 373.8 124.8 361.3 137.3C348.8 149.8 348.8 170.1 361.3 182.6L466.7 288L96 288C78.3 288 64 302.3 64 320C64 337.7 78.3 352 96 352L466.7 352L361.3 457.4C348.8 469.9 348.8 490.2 361.3 502.7C373.8 515.2 394.1 515.2 406.6 502.7L566.6 342.7z" />
                           </svg>
                        </div>
                        <div id="nr_step_navbar_create">
                           <svg xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                              <path fill="currentColor"
                                 d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z" />
                           </svg>
                        </div>
                     </div>
                     <div class="nr_input nr_input_steps">
                        <div class="nr_input_title">
                           <label id="nr_step_number_label">Pas 0</label>
                        </div>
                        <div class="nr_input_field">
                           <textarea name="" id="nr_step_number" rows="6" placeholder="Descriu les accions del pas 0"
                              class="nr_textarea_lock"></textarea>
                           <!-- <input type="textarea" name="nr_description" id="nr_description" placeholder="Descripció breu"
                        rows="5"> -->
                        </div>
                     </div>
                  </div>
                  <input id="nr_submit" type="submit" value="Publica">

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