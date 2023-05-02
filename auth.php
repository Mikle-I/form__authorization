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
  </head>
  <body class="back--fon">
  
  <?php 
  $noCaptha=$_POST['noCaptha'];
  $login= $_POST['login'];
  $password= $_POST['password'];
  $kapha=$_POST['g-recaptcha-response'];
  // редирект для тех кто не ввел логин пароль и капчу
  if(($login=="") && ($password =="") || ($kapha =="") ){
    header('Location: http://back.ru/index.php');
  }
  //капча
 
 $secret = "6Lf1XtIlAAAAAASLo6os4-wWDgClyagUtGuO6a8H";
 $response = $_POST['g-recaptcha-response'];
 $remoteip = $_SERVER['REMOTE_ADDR'];
 $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
 $data = file_get_contents($url);
 $row = json_decode($data);

if ($kapha != 1){
if($row->success == false ){
    header('Location: http://back.ru/index.php');
    exit();
}
}




  $vhod = mysqli_query($connection,"SELECT * FROM `users` WHERE ((`password`= '$password') AND (`tel`= '$login')) OR ((`password`= '$password') AND (`email`= '$login'))"  );
  $user = mysqli_fetch_assoc($vhod);

  if (mysqli_num_rows($vhod)== 0) {
    $setLogin = mysqli_query($connection,"SELECT * FROM `users` WHERE (`login`= '$login')"  );
    $sLogin = mysqli_fetch_assoc($setLogin);
    if (mysqli_num_rows($setLogin) > 0){
    ?>
    <form class="formUser"  action="./index.php">
    <h2>Введен неправильный логин или пароль</h2>
    <div>Вы ввели :</div>
    <div>Логин :<?php echo $login;?></div>
    <div>Пароль :<?php echo $password;?></div>
    <button type="sumbit" class="but__exit">Выйти</button>
  </form>
<?php
    }
    $setPass = mysqli_query($connection,"SELECT * FROM `users` WHERE (`password`= '$password')"  );
    if (mysqli_num_rows($setLogin) == 0)
    
    {
?>

<form class="formUser"  action="./index.php">
    <h2>Пользователь не существует</h2>
    <div>Вы ввели :</div>
    <div>Логин :<?php echo $login;?></div>
    <div>Пароль :<?php echo $password;?></div>
    <button type="sumbit" class="but__exit">Выйти</button>
<?php } 
    ?>
    
  
  <?php
   
}
else {
?>
<?php 
// if( isset($_POST['up_butt'])){
//     // $login= $_POST['login'];
//     // $password= $_POST['password'];
//     mysqli_query($connection, " UPDATE `users` SET `login` = '$_POST[login]', `password` = 'admin' WHERE `users`.`id` = 1");
// }

?>

    
   <form class="formUser"  method="POST" action="./update.php">
      <h2>Ваша карточка</h2>
      <input style="display:none"type="text" name="id" value="<?php echo $user['id'];?>"/>
      <div class="formUser__input"><div>Ваше имя : </div> <input type="text" name="name" value="<?php echo $user['name'];?>"/></div>
      <div class="formUser__input"><div>Логин    :</div> <input type="text" name="login" value="<?php echo $user['login'];?>"/></div>
      <div class="formUser__input"><div>Пароль   : </div> <input type="text" name="password" value="<?php echo $user['password'];?>"/></div>
      <div class="formUser__input"><div>Еmail    : </div> <input type="text" name="email" value="<?php echo $user['email'];?>"/></div>
      <div class="formUser__input"><div>Телефон  : </div> <input type="text" name="tel" value="<?php echo $user['tel'];?>"/></div>
     
      <a href="./index.php"><button type="button"  class="but__exit">Выйти</button></a> 
      <button type="submit" name="up_butt" class="but__exit">Сохранить</button>
      
    </form>
    
    <?php
}

  ?>

    
  </body>
</html>
