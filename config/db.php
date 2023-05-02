<?php
require_once "config.php";
$connection = mysqli_connect(
    $config['db']['server'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['name']
);
if ($connection == false){
    echo 'Не удалось подключиться к базе данных!<br>';
    echo mysqli_connect_error();
    exit();
}
// $res =mysqli_query($connection, "SELECT * FROM `users`" );
// $r1= mysqli_fetch_assoc($res);
// print_r( $r1);