<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once("styles.php") ?>
    <link rel="stylesheet" href="profile.css">
    <title>Бомба - пітарда</title>
</head>
<body>
<?php
include_once("navbar.php");
include_once("conection_database.php");
$sql = "SELECT u.id, u.email, u.image FROM users AS u";
$stmt = $dbh->prepare($sql);
$stmt->execute();
?>
<div class="container">
    <div class="container bootstrap snippets">
        <div class="row" id="user-profile">
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="main-box clearfix">
                    <h2><?= $name . " " . $surname ?></h2>
                    <img src="/images/<?= $image ?>" alt="" class="profile-img img-responsive center-block">

                    <div class="profile-message-btn center-block text-center">
                        <a href="#" class="btn btn-success">
                            <i class="fa fa-envelope"></i> Надіслати повідомлення
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="main-box clearfix">
                    <div class="profile-header">
                        <h3><span>Інформація про користувача ID: <?= $id ?></span></h3>
                        <a href="#" class="btn btn-primary edit-profile">
                            <i class="fa fa-pencil-square fa-lg"></i> Редагувати профіль
                        </a>
                    </div>

                    <div class="row profile-user-info">
                        <div class="col-sm-8">
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Ім'я
                                </div>
                                <div class="profile-user-details-value">
                                    <?= $name ?>
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Прізвище
                                </div>
                                <div class="profile-user-details-value">
                                    <?= $surname ?>
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Електронна пошта
                                </div>
                                <div class="profile-user-details-value">
                                    <?= $email ?>
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Телефон
                                </div>
                                <div class="profile-user-details-value">
                                    <?= $phone ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("scripts.php") ?>
</body>
</html>
