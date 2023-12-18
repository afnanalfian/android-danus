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

    <div class="settings">
        <h3>Mengubah menu makanan</h3><br>
        <form action="<?= base_url('/menu/update'); ?>" method="POST">
            <p>
                <input style="width: 40%;" type="text" name="makanan" placeholder="nama makanan" value="<?= $menu->menu_makanan; ?>"> &emsp;
                <input style="width: 20%;" type="text" name="harga" placeholder="harga makanan" value="<?= $menu->harga; ?>"> 
                <input type="hidden" name="id" value=<?= $menu->id; ?>>
            </p>
            <br>
            <p>
                <input class="edit" type="submit" value="Perbarui">
                <!-- <input class="edit" type="submit" value="Hapus"> -->
            </p>            
        </form>
    </div>
</body>
</html>