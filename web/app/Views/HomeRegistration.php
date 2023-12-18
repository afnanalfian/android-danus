<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ProFood</title>
	<link rel = "icon" href = "https://th.bing.com/th/id/OIP.v8fuxEuwnbtOnhrccJpBRgHaHa?w=171&h=180&c=7&r=0&o=5&pid=1.7" type = "image/x-icon">
<style>
*{
    margin: 0%;
    padding: 0%;
}

a:hover, button:hover{
    opacity: 0.9;
}

body{
    background-color: midnightblue;
}

button{
    cursor: pointer;
}

.buttondiv{
    padding-left: 70px;
    padding-top: 30px;
}

.buttondiv button{
    padding-left: 20px;
    text-align: left;
    color: darkslategrey;
    font-size: 20px;
    font-weight: bold;
    height: 40px;
    width: 500px;
    background-color: lightskyblue;
    border: 0px;
    border-radius: 20px;
}

.circle{
	position: absolute;
	top: 0;
    width: 600px;
    height: 600px;
    background-color: mediumblue;
    border-bottom-right-radius: 100%;
}

.circle2{
    position: absolute;
    bottom: 0;
    right: 0;
    width: 250px;
    height: 250px;
    background-color: mediumblue;
    border-top-left-radius: 100%;
}

h1{
    line-height: 65px;
    text-decoration: none;
    padding-left: 50px;
    padding-top: 70px;
    color:springgreen;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 80px;
}

h2{
    color: aqua;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 40px;
    padding-left: 70px;
}

p{
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: whitesmoke;
    padding-left: 70px;
}
</style>
</head>
<body>
    <div class="circle2"></div> 
    <div class="circle">
        <h1>
            &clubs;<span style="color: black;">Pro</span><span style="color: springgreen;">Food</span>
        </h1><br>
        <h2>Selamat datang di ProFood</h2>
        <p>Dibuat untuk penyediaan menu makanan</p><br><br>

        <div class="buttondiv">
            <a href="<?= base_url('/admin/menu') ?>"><button>Pihak Administrasi</button></a>
            <br><br><br>
            <a href="<?= base_url('/user/menu')?>"><button>Pihak Pengguna</button></a>
        </div>
    </div>
</body>
</html>