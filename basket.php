<?php 
 include "database.php";

 if (isset($_COOKIE["basket"])) echo "basket: " . $_COOKIE["basket"] . "<br>";
 $basket = $_COOKIE["basket"];
 $result = mysqli_query($induction, "SELECT * FROM `catalog` WHERE `id` in ($basket) " );

  ?>

<script>
    let all = [];
    let clothes = localStorage.getItem('basket_clothes').split(",");
    let accessories = localStorage.getItem('basket_accessories').split(",");

    function remove_storage() {
        localStorage.clear();
        window.location.reload();
    }

    function delete_item(id) {
        document.getElementById('button_'+String(id)).disabled = 'true';
        el = document.getElementById(id);
        el.style.background = '#653959';
        el.style.opacity = '0.4';
        var index = all.indexOf(id);
        all.splice(index, 1);

        if (id in clothes) {
            var index = clothes.indexOf(String(id));
            clothes.splice(index, 1);
            localStorage.removeItem('basket_clothes');
            localStorage.setItem('basket_clothes', clothes);
        } else {
            var index = accessories.indexOf(String(id));
            accessories.splice(index, 1);
            localStorage.removeItem('basket_accessories');
            localStorage.setItem('basket_accessories', clothes);
        }
        
    }

    function get_items() {
        for (let i = 0; i < clothes.length; i++) {
            if (clothes[i]>='0') {
                all.push(Number(clothes[i]));
            }
        }

        for (let i = 0; i < accessories.length; i++) {
            if (accessories[i]>='0') {
                all.push(Number(accessories[i]));
            }
        }

        all_str = all.join(',');
        document.cookie = "basket="+all_str;

    }
</script>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="styles.css">
	<title>basket</title>
</head>
<body bgcolor="#FF69B4" onload="get_items();">
    <p class="no_war">нет войне! stop the war!</p>
    <div>
        <img class="marginauto" src="images/logo_6.svg"/>
    </div>

    <?php
        while($good = mysqli_fetch_assoc($result)) 
        {
            ?>
            <div class="container_basket">
                <img src="<?php echo $good['image_front']; ?>" width="300" height="300">
                <img src="<?php echo $good['image_back']; ?>" width="300" height="300">
                <div>
                    <p class="title"><?php echo $good['title']; ?></p>
                    <p class="description"><?php echo $good['description']; ?></p>
                    <p class="size_price">[ <?php echo $good['size']; ?> ]<br>[ <?php echo $good['price']; ?> ]</p>
                </div>
                <nav class="cover" id="<?php echo $good['id']; ?>"></nav>
            </div>
            <button class="delete_item" id="button_<?php echo $good['id']; ?>" onclick="delete_item(<?php echo $good['id']; ?>);">
                <p>больше не хочу купить ;(</p>
            </button>
            <?php
        }
     ?>

    <div class="anketa">
        <h2>🌸 Анкета для подружек 🌸</h2>
        <form>
            <input type="text" required placeholder="тебя зовут *"> <br>
            <input type="text" required placeholder="твой телеграм *"> <br>
            <input type="text" placeholder="твой любимый цвет"> <br>
            <input type="text" placeholder="твоё любимое блюдо"> <br>
            <input type="text" placeholder="твоё супергеройское имя"> <br>
        </form>
        <button onclick="remove_storage();">
            оТПрАвИТь!!
        </button>
    </div>
    
</body>
</html>