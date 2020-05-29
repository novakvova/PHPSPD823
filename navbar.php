<?php
$reg = "Реєстрація";
$log= "Вхід";
$profile="login.php";
if(isset($_COOKIE['user'])){
    $user=$_COOKIE['user'];
    include_once("conection_database.php");
    $sql= "SELECT *  FROM `users` WHERE `email`= '$user'";
    $rezault=$dbh->query($sql);
    $user=$rezault->fetch(PDO::FETCH_ASSOC);
    $id=$user["id"];
    $name=$user["name"];
    $surname=$user["surname"];
    $phone=$user["phone"];
    $email=$user["email"];
    $image=$user["image"];
    $reg = $name." ".$surname;
    $log = "Вихід";
    $profile="profile.php";
}
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="/" class="navbar-brand">Бомба</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="/" class="nav-item nav-link">Головна</a>
            <a href=<?=$profile?> class="nav-item nav-link">Профіль</a>
            <a href="#" class="nav-item nav-link">Повідомлення</a>
            <a href="#" class="nav-item nav-link disabled" tabindex="-1">Звіт</a>
        </div>
        <div class="navbar-nav ml-auto">
            <a href="reg.php" class="nav-item nav-link"><?=$reg ?></a>
            <a href="exit.php" class="nav-item nav-link"><?=$log ?></a>
        </div>
    </div>
</nav>