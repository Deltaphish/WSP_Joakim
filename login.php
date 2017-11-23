<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="./CSS/main.css">
        <link rel="stylesheet" type="text/css" href="./CSS/login.css">
    </head>
    <body>
        <?php
            if(!empty($_GET['error'])){
              echo "Login Failed";
            }
         ?>
        <form action="login-handler.php" method="POST">
            <input type="text" name="username" placeholder="Username" id="Username"/>
            <input type="password" name="password" placeholder="Password" id="Password"/><br>
            <input type="submit" value="Login" id="Submit"/>
        </form>
    </body>
</html>
