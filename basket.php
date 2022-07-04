<?php 
 include "database.php";
 $basket = $_COOKIE["basket"];
 if ($basket != '') {
    $result = mysqli_query($induction, "SELECT * FROM `catalog` WHERE `id` in ($basket) " );
 }
 
 if(isset($_POST['name']) && isset($_POST['tg']) && isset($_POST['color']) && isset($_POST['food']) && isset($_POST['superhero']) && isset($_POST['order']))
 {
     $name = $_POST['name'];
     $tg = $_POST['tg'];
     $color = $_POST['color'];
     $food = $_POST['food'];
     $superhero = $_POST['superhero'];
     $order = $_POST['order'];
     
     $basket = $_COOKIE["basket"];

     $query = "INSERT INTO orders VALUES (NULL, '{$name}', '{$tg}', '{$order}', '{$color}', '{$food}', '{$superhero}')";
     $induction->query($query);
     
 }
 
 ?>

<script>
    let all = [];
    var items = document.cookie.match(/basket=(.+?)(;|$)/)[1].split(",");
    
    function send() {
        var items_str = document.cookie.match(/basket=(.+?)(;|$)/)[1];
        document.getElementById("order").value = items_str;
        alert('спасибо за чиловый заказ!! в ближайшее время я свяжусь с вами');
        document.cookie = "basket=";
        document.location.href = "https://chillerz.fun/";
    }

    function delete_item(id) {
        document.getElementById('button_'+String(id)).disabled = 'true';
        el = document.getElementById(id);
        el.style.background = '#653959';
        el.style.opacity = '0.4';
        var index = all.indexOf(id);
        all.splice(index, 1);

        var index = items.indexOf(String(id));
        items.splice(index, 1);
        let str_items = '';
        str_items = items.join(',');
        document.cookie = "basket="+str_items;
    }
    

</script>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<title>basket</title>
</head>
<body bgcolor="#FF69B4">

    <p class="no_war">нет войне! stop the war!</p>
    <div>
        <a href="https://chillerz.fun" class="marginauto" ><img class="marginauto" src="images/logo_6.svg"/></a>
    </div>
    
    <div class="empty_basket" id="empty_basket"></div>
    
    <script>
        var basket_state = document.cookie.match(/basket=(.+?)(;|$)/);
        if (basket_state==null) {
            el = document.getElementById('empty_basket');
            el.innerHTML = 'корзина пока пуста;( <br>';
            el.innerHTML += 'скорее добавляйте товары или просто заполняйте анкету';
        }
    </script>
    
    <?php
        if ($basket != '') { 
            while($good = mysqli_fetch_assoc($result)) 
            {
                ?>
                <div class="container_basket">
                    <img src="catalog/<?php echo $good['image_front']; ?>.jpeg" width="300" height="300">
                    <img src="catalog/<?php echo $good['image_back']; ?>.jpeg" width="300" height="300">
                    <div>
                        <p class="title"><?php echo $good['title']; ?></p>
                        <p class="description"><?php echo $good['description']; ?></p>
                        <p class="size_price">[ <?php echo $good['size']; ?> ]<br>[ <?php echo $good['price']; ?> ₾ ]</p>
                    </div>
                    <nav class="cover" id="<?php echo $good['id']; ?>"></nav>
                </div>
                <button class="delete_item" id="button_<?php echo $good['id']; ?>" onclick="delete_item(<?php echo $good['id']; ?>);">
                    <p>больше не хочу купить ;(</p>
                </button>
                <?php
            }
        }
     ?>

    <div class="anketa">
        <h2>🌸 Анкета для подружек 🌸 (и&nbsp;заказов)</h2>
        <form action="basket.php" method="POST" onSubmit="return send();">
            <input type="text" name="name" required placeholder="тебя зовут *"> <br>
            <input type="text" name="tg" required placeholder="твой телеграм *"> <br>
            <input type="text" name="color" placeholder="твой любимый цвет"> <br>
            <input type="text" name="food" placeholder="твоё любимое блюдо"> <br>
            <input type="text" name="superhero" placeholder="твоё супергеройское имя"> <br>
            <input type="hidden" name="order" id="order">
            <button type="submit">
                оТПрАвИТь!!
            </button>
        </form>
    </div>
    <div style="height: 1px;"></div>
    
</body>
</html>