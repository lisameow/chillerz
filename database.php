<?php

$server = 'localhost';
$login = 'u1707109_default';
$pass = '';
$name_db = 'u1707109_default';

$link = mysqli_connect($server, $login, $pass, $name_db);
mysqli_set_charset($link, 'utf8');

if ($link == False) 
{
    echo "Соединение не удалось";
}

 ?>