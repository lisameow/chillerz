<?php 
 include "database.php";
$result = mysqli_query($induction, 'SELECT * FROM `catalog` WHERE `type` = 1 AND `available` = 1');
 ?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="styles.css">
	<title>accessories</title>
</head>

<body bgcolor="#FF69B4">
    <p class="no_war">нет войне! stop the war!</p>
    <div>
        <img class="marginauto" src="images/logo_6.svg"/>
    </div>

    <script>
        function save_to_storage(id) {
        let all_cookies = document.cookie.split('=');
        if ('basket' == all_cookies[0]) {
            var items = document.cookie.match(/basket=(.+?)(;|$)/)[1].split(",");
        } else {
            var items = [];
        }
        document.getElementById(id).disabled = 'true';

        items.push(id);
        let str_items = '';
        str_items = items.join(',');
        document.cookie = "basket="+str_items;

        el = document.getElementById(id);
        el.style.background = '#f6daeb'; 
        } 
    </script>

    
    <?php
        while($good = mysqli_fetch_assoc($result)) 
        {
            ?>
            <div class="container_acc">
                <img src="<?php echo $good['image_front']; ?>" width="300" height="300">
                <img src="<?php echo $good['image_back']; ?>" width="300" height="300">
                <div>
                    <p class="title"> <?php echo $good['title']; ?> </p>
                    <p class="description"> <?php echo $good['description']; ?> </p>
                    <p class="size_price">[ <?php echo $good['price']; ?> ₾]</p>
                    <button class="buy_button" id="<?php echo $good['id']; ?>" onclick="save_to_storage(<?php echo $good['id']; ?>);">🤩 💸 🛍</button>
                </div>
            </div>
            <?php 
        }
     ?>
</body>
</html>