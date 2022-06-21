<?php 

include "database.php";

$result = mysqli_query($link, 'SELECT * FROM `catalog`');

while($catalog = mysqli_fetch_assoc($result))
{
    echo 'Название:', $catalog['title'], ' ', 'Картинка:', $catalog['image'], ' ', 'Размер:', $catalog['size'], ' ', 'Описание:', $catalog['description'], ' ', 'Цена:', $catalog['price'], 'лари';
    echo '<br>';
}

 ?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="/styles.css">
	<title>clothes</title>
</head>
<body bgcolor="#FF69B4">
    <p class="no_war">нет войне! stop the war!</p>
    <div>
        <img class="marginauto" src="images/logo_6.svg"/>
    </div>
    <h1>привет <?php echo $login; ?></h1>
    <h2>вы подключились к бд - <?php echo $name_db; ?></h2>
</body>
</html>