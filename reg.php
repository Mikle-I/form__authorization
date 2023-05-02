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
 

    <form class="formReg" method="POST" action="./reg.php">
      <h2>Регистрация</h2>
<div class="erorrs">
      <?php 

    
        

        if( isset($_POST['add'])){
            $login= $_POST['login'];
            $password= $_POST['password'];
            $password2= $_POST['password2'];
            $name= $_POST['name'];
            $email= $_POST['email'];
            $tel= $_POST['tel'];  
            $errors = array();
            // // проверка на наличие в базе
             $testTel = mysqli_query($connection,"SELECT * FROM `users` WHERE (`tel`= '$tel')");
             $testEm = mysqli_query($connection,"SELECT * FROM `users` WHERE (`email`= '$email')");
            $testLog = mysqli_query($connection,"SELECT * FROM `users` WHERE (`login`= '$login')");

            if (mysqli_num_rows($testTel) > 0){
             $errors[]='Такой телефон уже занят';
            
            }
            if (mysqli_num_rows($testEm) > 0){
             $errors[]='Такой емайл уже занят';
            
               }
            if (mysqli_num_rows($testLog) > 0){
             $errors[]='Такой Login уже занят';
            }

        if ($name == ''){
            $errors[]='Введите имя!';
        }
        if ($password == ''){
            $errors[]='Введите пароль!';
        }
        if ($password != $password2){
            $errors[]='Вы ввели разные пароли!';
        }
        if ($login == ''){
            $errors[]='Введите логин!';
        }
        if ($email == ''){
            $errors[]='Введите емайл!';
        }
        if ( $tel == ''){
            $errors[]='Введите телефон!';
        }

        if (empty($errors)){
             echo "регистрация успешна".'<hr>';
            mysqli_query($connection, "INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `tel`) VALUES (NULL, '$login', '$password', '$email', '$name', '$tel')");
            $_POST = array();
            $errors = array();
            header( "refresh:2;url=http://back.ru/index.php" );
        } else {
            echo $errors['0'].'<hr>';
        }
        }


?>
</div>
      
      <input name="name" type="text" placeholder="Ваше имя" require value="<?php echo $_POST['name'] ?>"/>
      <input name="login" type="text" placeholder="Логин" require value="<?php echo $_POST['login'] ?>"/>
      <input name="password" type="text" placeholder="Пароль" require />
      <input name="password2" type="text" placeholder="Повторите Пароль " require />
      <input name="email" type="text" placeholder="Еmail"require value="<?php echo $_POST['email'] ?>"/>
      <input name="tel" type="text" placeholder="Телефон" require value="<?php echo $_POST['tel'] ?>"/>
      <input type="submit" class="but__add" name="add" value="Регистрация">
    </form>
  </body>
</html>
