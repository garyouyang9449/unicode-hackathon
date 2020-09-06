<?php 
    include('config/connect_db.php');
    $email = $password = '';
    $error = array('email' => '', 'password' => '');

    if(isset($_POST['submit'])){
        // check if email field is empty
        if(empty($_POST['email'])) {
            echo "email error <br />";
            $error['email'] = 'email is empty';
        } else {
            echo htmlspecialchars($_POST['email']);
            $email = $_POST['email'];
        }
        
        // check if password field is empty
        if(empty($_POST['password'])) {
            echo "password is empty <br />";  
            $error['password'] = 'password is emtpy';
        } else {
            echo htmlspecialchars($_POST['password']);
            $password = $_POST['password'];
        }
        if(array_filter($error)) {
            echo ' error';
        } else {
            echo ' no error';
        }
    }
	
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册网页</title>
    <style>
        body {
            background-image: url('register.jpg');
            background-size: 100%;
            background-repeat: no-repeat;

            text-align: center;
            color: pink;
        }
    </style>
</head>


<body>
    <section class="container grey-text">
        <br>
        <br>
        <br>
        <br>
        <h4 class="center">Register</h4>
        <form class="white" action="个人简介.html" method="POST">
            <label>Your Email</label>
            <input type="text" name="email">
            <label>Password</label>
            <input type="text" name="password">
            <br>
            <br>
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
</body>

</html>