<?php
    $session = session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan <?= $session->get('menu_makanan'); ?> - ProFood</title>
<style>
a{
    text-decoration: none;
    color: black; 
}

a:hover, form [type=submit]:hover{
    opacity: 0.9;
}

body{
    background-color: skyblue;
}

.box{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 20px;
    font-weight: bold;
    margin: 0 auto;
    background-color: whitesmoke;
    padding: 10px;
    border-radius: 10px;
    width: 500px;
    margin-top: 50px;
    margin-bottom: 30px;
}

.error{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 15px;
    background-color: whitesmoke;
    color: red;
    width: 400px;
}

form [type=submit]{  
    cursor: pointer; 
    width: 100%;
    height: 35px;
    font-size: 15px;
    font-weight: bold;
    border-radius: 5px;
    border: 0px; 
    background-color: skyblue;  
}

form [type=text], form [type=password]{
    font-size: 15px;
    width: 100%;
    padding: 5px 10px;
    margin: 7px 0;
    display: inline-block;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1 black solid;
}

.harga{
    font-weight: bold;
}

.username{
    font-weight: bold;
}
</style>
</head>
<body>
    <div class="box">
        <form action="<?= base_url('/order/save') ?>" method="POST">
            <fieldset>
                <legend>Jumlah Pesanan <?= $session->get('menu_makanan'); ?></legend>
                <p>
                    <label>Makanan:</label><br>
                    <input class="username" type="text" readonly name="menu_makanan" value="<?= $session->get('menu_makanan'); ?>" />
                </p>
                <p>
                    <label>Harga (Rp/pcs):</label><br>
                    <input class="harga" type="text" readonly name="harga" value="<?= $session->get('harga'); ?>" />
                </p>
                <p>
                    <label>Jumlah Pesanan:</label><br>
                    <input type="text" name="jumlah" placeholder="isi jumlah pesanan" />
                </p>
                <div class="error">
                    <?php if(isset($validation)):?>
                    <?= $validation->listErrors() ?>
                    <?php endif;?>
                </div>
                    <p>
                    <input type="submit" name="submit" value="Pesan" />
                </p>
            </fieldset>
        </form>
    </div>
</body>
</html>