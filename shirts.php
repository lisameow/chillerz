<?php 
 include "database.php";
$result = mysqli_query($induction, 'SELECT * FROM `catalog` WHERE `type` = 0 AND `available` = 1');
 ?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="styles.css">
	<title>shirts</title>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>

<script>

    function save_to_storage(id) {
        let all_cookies = document.cookie.split('=');
        if ('basket' == all_cookies[0] && all_cookies[1] != '') {
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

<body class="back_clothes">
    <p class="no_war">нет войне! stop the war!</p>
    <div>
        <a href="https://chillerz.fun" class="marginauto" ><img class="marginauto" src="images/logo_6.svg"/></a>
    </div>

    <div class="go_to_basket">
        <a href="https://chillerz.fun/basket"><img src="images/bicyclist.svg" height="100"></a>
        <a href="https://chillerz.fun/basket" class="go_to_basket_a"><p>добавляй и<br>поехали в корзину</p></a>
    </div>


    <?php
        while($good = mysqli_fetch_assoc($result)) 
        {
            ?>
            <div class="container_clothes">
                <img src="catalog/<?php echo $good['image_front']; ?>.jpeg" width="300" height="300">
                <img src="catalog/<?php echo $good['image_back']; ?>.jpeg" width="300" height="300">
                <div>
                    <p class="title"> <?php echo $good['title']; ?> </p>
                    <p class="description"> <?php echo $good['description']; ?> </p>
                    <p class="size_price">[ <?php echo $good['size']; ?> ]<br>[ <?php echo $good['price']; ?> ₾ ]</p>
                    <button class="buy_button_clothes" id="<?php echo $good['id']; ?>" onclick="save_to_storage(<?php echo $good['id']; ?>);">🤩 💸 🛍</button>
                </div>
            </div>
            <?php 
        }
     ?>
     <script>
        var cookies = document.cookie.split('=')[1].split(',');
        for (let i=0; i<cookies.length; i++) {
            if (cookies[i] != 0) {
                document.getElementById(cookies[i]).disabled = 'true';
            }
        }
    </script>
    
    <div style="height: 20px;"></div>
</body>
</html>