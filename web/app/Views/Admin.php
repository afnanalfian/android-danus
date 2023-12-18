<?php 
    $session = session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Administrasi - ProFood</title>
<style>
*{
margin: 0%;
padding: 0%;
}

.admin{
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0%;
}

.admin thead, .admin tbody{
    text-align: center;
}

.admin th{
    border: 1px black solid;
    background-color: darkslateblue;
    color: white;
    height: 30px;
}

.admin td{
    border: 1px black solid;
    height: 30px;
}

.admin td:nth-child(1) {
    width: 20%;
}

.admin td:nth-child(2) {
    width: 80%;
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
    border-radius: 10px;
    border: 1px gray solid;
    height: 30px;
}

.fixed-th td:nth-child(1) {
    padding:5px 10px;
    width: 80%;
}

.fixed-th td:nth-child(2) {
    width: 10%;
}

.fixed-th td:nth-child(3) {
    width: 10%;
}

form{
    margin: 0% auto;
}

form [type=submit], form [type=button]{  
    cursor: pointer; 
    width: 10%;
    height: 35px;
    font-size: 15px;
    font-weight: bold;
    border-radius: 5px;
    border: 0px; 
    background-color: skyblue;  
}

form [type=text]{
    font-size: 15px;
    width: 40%;
    padding: 5px 10px;
    margin: 7px 0;
    display: inline-block;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1 black solid;
}

.list{
    margin: 0 auto;
    width: 93%;
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

textarea{
    width: 99%;
    padding: 10px 5px;
    border: 1px black solid;
    margin: 7px 0px;
    border-radius: 5px;
}
</style>
</head>
<body>
    <nav>
        <p>&clubs;<span style="color: black;">Pro</span><span style="color: springgreen;">Food</span></p>
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
                <td>Jabatan</td>
                <td>&nbsp;: <?= $session->get('jabatan'); ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>&nbsp;: <?= $session->get('email'); ?></td>
            </tr>
            <div style="float: right;">
                <a href="<?= base_url('/admin/profile/'.$session->get('id')) ?>"><button style="margin-bottom: 10px;">Ubah Profil</button></a><br>
                <a href="<?= base_url('/admin/logout') ?>"><button>Sign Out</button></a>
            </div>
        </table>
    </div>

    <div class="settings">
        <table class="admin">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($admin as $row) : ?>
                <tr>
                    <td>
                        <?= $row['username']; ?>
                    </td>
                    <td>
                        <?= $row['email']; ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table><br>
        <p>
            <a style="text-style = none;" href="<?= base_url('/admin/signup') ?>"><button>Tambah akun</button></a>
        </p>
    </div>

    <div class="settings">
        <h3>Membuat menu makanan baru</h3><br>
        <form action="<?= base_url('/menu/save') ?>" method="POST">
            <p>
                <input style="width: 40%;" type="text" name="makanan" placeholder="nama makanan"> &emsp;
                <input style="width: 20%;" type="text" name="harga" placeholder="harga makanan"> 
            </p>
            <br>
            <p>
                <input type="submit" value="Simpan Menu">&emsp;
            </p>            
        </form>
    </div>

    <div class="list">
        <a href="<?= base_url('/admin/order')?>"><button style="width: 100%;">Daftar Pesanan</button></a>
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
                        <a href="<?= base_url('/menu/edit/'.$row['id']); ?>"><button style="width: 100%;">Ubah</button></a>
                    </p>
                </td>
                <td>
                    <p>
                        <a href="<?= base_url('/menu/delete/'.$row['id']); ?>"><button style="width: 100%;">Hapus</button></a>
                    </p>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>