<?php 
require "config/config.php";

if( isset($_POST['up_butt'])){
     mysqli_query($connection, " UPDATE `users` SET 
      `login` = '$_POST[login]',
      `password` = '$_POST[password]',
      `email` = '$_POST[email]',
      `tel` = '$_POST[tel]',
      `name` = '$_POST[name]'   WHERE `users`.`id` = '$_POST[id]'");
?>
 <link rel="stylesheet" href="./style.css" />
 <body class="back--fon">
<form class="formUserUP" method="POST" action="./auth.php">
    <h2 style="font-size:20px;margin-bottom: 30px;">Данные пользователя успешно обновлены</h2>
      <input type="hidden" name="login"value="<?php echo $_POST['tel'];?>"/> 
      <input type="hidden" name="password" value="<?php echo $_POST['password'];?>"/> 
      <input type="hidden" name="g-recaptcha-response" value="1"/>
    <button type="sumbit" name="back" class="but__exit">Назад</button>
  </form>
</body>
<?php

    }
    

?>