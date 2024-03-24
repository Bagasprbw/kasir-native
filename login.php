<?php
   session_start();
   if(isset($_SESSION['username'])){
      header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Login</title>
      <meta name="keywords" content="">
      <!-- link css -->
      <?php require_once('layout/_css.php'); ?>
   </head>
   <body>
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="tema/images/logo/logo.png" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form action="_model.php" method="POST">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Username</label>
                              <input type="text" name="username">
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" name="password">
                           </div>
                           <div class="center">
                              <button class="main_bt" name="login">Log in</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <?php require_once('layout/_js.php'); ?>
   </body>
</html>