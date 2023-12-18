<?php 
    $session = session();
    $model = new App\Models\OrderModel;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Pengguna - ProFood</title>
<style>
*{
    margin: 0%;
    padding: 0%;
}

body{
    background-color: gainsboro;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
}

button{
    cursor: pointer;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    height: 40px;
    width: 150px;
    background-color: midnightblue;
    color: whitesmoke;
    border: 0px;
    border-radius: 10px;
}

.fixed-th {
    margin: 0% auto;
    width: 95%;
    border-collapse: separate;
    border-spacing: 10px 20px;
}

.fixed-th td{
    background-color: whitesmoke;
    border: 1px gray solid;
    height: 30px;
    border-radius: 10px;
}

.fixed-th td:nth-child(1) {
    width: 90%;
    padding: 5px 10px;
}

.fixed-th td:nth-child(2) {
    width: 10%;
}

img{
    width: 150px;
    height: 150px;
    margin-right: 10px;
    border: 5px darkslategrey solid;
    border-radius: 100%;
}

nav{
    background-color: midnightblue;
    color: springgreen;
    padding: 20px 40px;
    font-size: 30px;
    font-weight: bold;
}

.profile{
    margin: 0% auto;
    margin-top: 40px;
    max-width: 90%;
    padding: 20px;
    font-size: 20px;
    background-color: whitesmoke;
    border-radius: 10px;
    border: 1px gray solid;
}

.settings{
    margin: 0% auto;
    margin-top: 20px;
    margin-bottom: 20px;
    max-width: 90%;
    padding: 20px;
    background-color: whitesmoke;
    border-radius: 10px;
    border: 1px gray solid;
}

.token{
    margin: 0% auto;
    margin-top: 20px;
    max-width: 90%;
    padding: 20px;
    font-size: 20px;
    background-color: whitesmoke;
    border-radius: 10px;
    border: 1px gray solid;
}

textarea{
    width: 100%;
    font-size: 15px;
    resize: none;
}

.user{
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0%;
}

.user thead{
    text-align: center;
}

.user th{
    border: 1px black solid;
    background-color: darkslateblue;
    color: white;
    height: 30px;
}

.user td{
    padding-left: 5px;
    border: 1px black solid;
    height: 30px;
}

.user td:nth-child(1) {
    width: 40%;
}

.user td:nth-child(2) {
    width: 30%;
}

.user td:nth-child(3) {
    width: 30%;
}
</style>
</head>
<body>
    <nav>
        <p>&#10004;<span style="color: black;">Pro</span><span style="color: springgreen;">Abs</span></p>
    </nav>

    <div class="profile">
        <table>
            <tr>
                <td>Username</td>
                <td>&nbsp;: <?= $session->get('username'); ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>&nbsp;: <?= $session->get('nama'); ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>&nbsp;: <?= $session->get('alamat'); ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>&nbsp;: <?= $session->get('email'); ?></td>
            </tr>
            <div style="float: right;">
                <a href="<?= base_url('/user/profile/'.$session->get('id')) ?>"><button style="margin-bottom: 10px;">Ubah Profil</button></a><br>
                <a href="<?= base_url('/user/logout') ?>"><button>Sign Out</button></a>
            </div>
        </table>
    </div>

    <!-- <div class="token">
        <p>Token Pengguna</p><br>
        <textarea name="token" readonly id="token" rows="5"><?= $session->get('token'); ?></textarea>
    </div> -->

    <div class="settings">
        <h3>Daftar Antrian Pembeli</h3><br>
        <table class="user">
            <thead>
                <tr>
                    <th>Pembeli</th>
                    <th>Makanan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($order as $row) : 
                ?>
                <tr>
                    <td>
                        <?= $row['username'];?>
                    </td>
                    <td>
                        <?= $row['menu_makanan']; ?>(<?= $row['jumlah']?>x)
                    </td>
                    <td>
                        Rp<?= $row['harga']; ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table><br>
    </div>

    <table class="fixed-th">
        <tbody>
            <?php foreach ($menu as $row) : ?>
                <tr>
                    <td>
                        <?= $row['menu_makanan'],' - Rp',$row['harga'];?>
                    </td>
                    <td>
                        <p>
                            <a href="<?= base_url('/user/order/'.$row['id']); ?>"><button style="width: 100%;">Pesan</button></a>
                        </p>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
        </table>
</body>
</html>