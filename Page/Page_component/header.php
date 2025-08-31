<header>
   <div id="header_title">
      <img src="../IMG/icon.png" alt="">
      <h1>PUNTO DE SABOR</h1>
   </div>
   <div id="header_searchbar">
      <form action="">
         <input type="search">
         <button type="submit">Search</button>
      </form>
   </div>
   <nav id="header_nav">
      <ul>
         <li id="header_nav_inici" class="nav_button"><a href="landing.php">INICI</a></li>
         <li id="header_nav_novetats" class="nav_button"><a href="novetats.php">NOVETATS</a></li>
         <li id="header_nav_categories" class="nav_button"><a href="categories.php">CATEGORIES</a></li>
         <li id="header_nav_contacte" class="nav_button"><a href="contacta.php">CONTACTA</a></li>
      </ul>
   </nav>

   <div id="header_user_tools">
      <?php
      if ($session->isLoggedIn()) {
         ?>
         <div id="header_logged_user">
            <div id="header_profile" class="header_user_tools_button">
               <a href="perfil.php">Perfil</a>
            </div>
            <div id="header_create_recipe" class="header_user_tools_button">
               <a href="novaRecepta.php">Nova Recepta</a>
            </div>
         </div>
         <?php
      } else {
         ?>
         <div id="header_viewer_user">
            <div id="header_login" class="header_user_tools_button">
               <a href="login.php">Login</a>
            </div>
            <div id="header_register" class="header_user_tools_button">
               <a href="registre.php">Registra't</a>
            </div>
         </div>
         <?php
      }
      ?>
   </div>
</header>