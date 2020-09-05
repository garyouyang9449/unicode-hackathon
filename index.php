<?php 
	include('config/connect_db.php');
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登陆网页</title>
    <style>
        .box {

            border-style: none;
            position: absolute;
            width: 500px;
            height: 400px;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 50px;
            background-color: white;
        }

        .box .登录 {
            font-size: 35px;

        }

        .box p a {
            text-decoration: none;
        }

        .box .shuru .xiezi {
            border: 0px;
        }

        .box .next {
            position: absolute;
            top: 350px;
            left: 350px;
            background-color: rgb(12, 12, 134);
            font-size: 20px;
            color: white;
            border-color: rgb(12, 12, 134);

        }
    </style>
</head>

<body background="E:\html\images\py.PNG">
    <div class="box">
        <img src="E:\html\images\微软图标.png" height="90" width="170">
        <br>
        <strong class="登录">登录</strong>
        <br>
        <br>
        <div class="shuru">
            <input type="text" class="xiezi" placeholder="电子邮件、电话或 Skype">
        </div>
        <hr>
        <p>没有账户？<a href="#">创建一个！</a></p>
        <p><a href="#">使用安全密钥登陆</a></p>
        <p><a href="#">登陆选项</a></p>
        <input type="button" class="next" value="下一步" style="width:190px;height:50px">

    </div>

</body>

</html>