<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - ProFood</title>
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
        <form action="<?= base_url('/user/login/auth') ?>" method="POST">
            <fieldset>
            <legend>Pihak Pengguna</legend>
            <p>
                <label>Email:</label><br>
                <input type="text" name="email" placeholder="isi email" />
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password" placeholder="isi password" />
            </p>
            <div class="error">
                <?php if(session()->getFlashdata('msg')):?>
                <?= session()->getFlashdata('msg') ?>
                <?php endif;?>
            </div>
            <!-- <p>
                <label><input type="checkbox" name="remember" value="remember" /> Remember me</label>
            </p> -->
            <p>
                <input type="submit" name="submit" value="Sign In" />
            </p>
            <p>
                <a href="<?= base_url('user/signup') ?>">Registrasi</a>
            </p>
            </fieldset>
        </form>
    </div>
</body>
</html>