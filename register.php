<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploaddir = '/xampp/htdocs/images/';
    $imagefile = $_FILES['image']['name'];
    $name =$_POST["name"];
    $surname =$_POST["surname"];
    $phone =$_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $passwordconfirm = $_POST["passconfirm"];
    $file = $imagefile;
    include_once("conection_database.php");
    if(mb_strlen($password)<6 || mb_strlen($password)>20) {
        header("Location: register.php");
        exit();
    }
      if (!empty($email) && !empty("$password") && $password == $passwordconfirm && !empty($name) && !empty($surname) && !empty($phone)) {
        $sql = "INSERT INTO `users` (`image`, `name`, `surname`, `phone`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$file, $name, $surname, $phone, $email, md5($password)]);
        move_uploaded_file($_FILES['image']['tmp_name'], "$uploaddir" . $_FILES['image']['name']);
        header("Location: index.php");
        exit();
    }
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
    <link rel="stylesheet" href="register.css">
    <title>Бомба - пітарда</title>
</head>
<body>
<?php include_once("navbar.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card card-signin flex-row my-5">
                <div class="card-img-left d-none d-md-flex">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Реєстрація</h5>
                    <form name="registration" class="form-signin" method="post" enctype="multipart/form-data" action="">
                        <div class="form-label-group">
                            <input name="name" type="text" id="name" class="form-control"
                                   placeholder="Ім'я" required>
                            <label for="name">Ім'я</label>
                        </div>
                        <div class="form-label-group">
                            <input name="surname" type="text" id="surname" class="form-control"
                                   placeholder="Прізвище" required>
                            <label for="surname">Прізвище</label>
                        </div>
                        <div class="form-label-group">
                            <input name="phone" type="text" id="phone" class="form-control"
                                   placeholder="Телефон" required>
                            <label for="phone">Телефон</label>
                        </div>
                        <div class="form-label-group">
                            <input name="email" type="email" id="inputEmail" class="form-control"
                                   placeholder="Електронна пошта" required>
                            <label for="inputEmail">Електронна пошта</label>
                        </div>
                        <hr>
                        <div class="form-label-group">
                            <input name="pass" type="password" id="inputPassword" class="form-control"
                                   placeholder="Пароль" required>
                            <label for="inputPassword">Пароль</label>
                        </div>
                        <div class="form-label-group">
                            <input name="passconfirm" type="password" id="inputConfirmPassword" class="form-control"
                                   placeholder="Підтвердження пароля" required>
                            <label for="inputConfirmPassword">Підтвердження пароля</label>
                        </div>

                        <div class="form-label-group">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="inputGroupFile04">
                                <label class="custom-file-label" for="inputGroupFile04">Вибрати файл</label>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Зареєструватись</button>
                        <a class="d-block text-center mt-2 small" href="login.php">Увійти</a>
                        <hr class="my-4">
                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i
                                    class="fa fa-google mr-2"></i> Реєстрація за допомогою Google
                        </button>
                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i
                                    class="fa fa-facebook-f mr-2"></i> Реєстрація за допомогою Facebook
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("scripts.php") ?>
</body>
</html>
