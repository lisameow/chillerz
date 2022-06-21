<?php

$server = 'localhost';
$login = 'u1707109_default';
$pass = '';
$name_db = 'u1707109_default';

$induction = mysqli_connect($server, $login, $pass, $name_db);
mysqli_set_charset($induction, 'utf8');

if ($induction == False) 
{
    echo "Соединение не удалось";
}

 ?>