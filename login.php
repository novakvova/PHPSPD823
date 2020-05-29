<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["pass"];
    $password=md5($password);
    include_once("conection_database.php");
    $sql= "SELECT * FROM `users` WHERE `email`= '$login' AND  `password`='$password'";
    $rezault=$dbh->query($sql);
    $user=$rezault->fetch();
    if($user==false) {
        header("Location: login.php");
        exit();
    }
    setcookie('user', $user['email'], time()+3600, "/");
    header("Location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once("styles.php") ?>
    <link rel="stylesheet" href="login.css">
    <title>Бомба - пітарда</title>
</head>
<body>
<?php
include_once("navbar.php");
include_once("conection_database.php");
?>
<div class="container">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="images/photo-1469594292607-7bd90f8d3ba4.png" id="icon" alt="User Icon" />
            </div>
            <form action="" method="post">
                <input type="text" id="login" class="fadeIn second" name="login" placeholder="Електронна пошта">
                <input type="password" id="password" class="fadeIn third" name="pass" placeholder="Пароль">
                <input type="submit" class="fadeIn fourth" value="Увійти">
            </form>
            <div id="formFooter">
                <a class="underlineHover" href="#">Забули пароль?</a>
            </div>
        </div>
    </div>
</div>
<?php include_once("scripts.php") ?>
</body>
</html>

