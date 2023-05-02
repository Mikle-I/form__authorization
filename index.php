<?php
require "config/config.php";

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $config['title']; ?></title>
    <link rel="stylesheet" href="./style.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body class="back--fon">

    <form class="form" method="POST" action="./auth.php">
      <h1>Вход</h1>
      <input  name="login" type="text" placeholder="Email или телефон"require />
      <input name="password" type="text" placeholder="Password" />
      <div class="g-recaptcha" data-sitekey="6Lf1XtIlAAAAAFpmJ2g7kddchDgf77aRkM9qoxNb"></div>
      <div class="text-danger" id="recaptchaError"></div>
      <button type="submit" class="but__vh">Войти</button>
      <a href="./reg.php"><button type="button" class="but__reg">Зарегистрироваться</button></a> 
    </form>
    
  </body>
</html>
