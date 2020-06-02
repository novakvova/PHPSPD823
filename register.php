<?php
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/images/';
    //$imagefile = $_FILES['image']['name'];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $passwordconfirm = $_POST["passconfirm"];
    $file_name = uniqid() . '.jpg';
    $file = $uploaddir . $file_name;
    include_once("conection_database.php");
    if (mb_strlen($password) < 6 || mb_strlen($password) > 20) {
        $error = "Вкажіть пароль мін 6 символів";
    }

    if (empty($email) || empty("$password") || $password != $passwordconfirm ||
        empty($name) || empty($surname) || empty($phone)) {
        $error = "Вкажіть значення у полях";
    }
    if (empty($error)) {
        $sql = "INSERT INTO `users` (`image`, `name`, `surname`, `phone`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$file_name, $name, $surname, $phone, $email, md5($password)]);
        $data=$_POST["imgBase64"];
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        file_put_contents($file, $data);

        ///move_uploaded_file($_FILES['image']['tmp_name'], $file);
        header("Location: index.php");
        exit();
    }
} else {
    $name = "";
    $surname = "";
    $phone = "";
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
    <link rel="stylesheet" href="node_modules/cropperjs/dist/cropper.min.css">
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
                    <?php if (!empty($error)) { ?>
                        <div>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        </div>
                    <?php } ?>
                    <form name="registration" class="form-signin" method="post" enctype="multipart/form-data" action="">
                        <div class="form-label-group">
                            <input name="name" type="text" id="name" class="form-control"
                                   placeholder="Ім'я" value="<?= $name ?>">
                            <label for="name">Ім'я</label>
                        </div>
                        <div class="form-label-group">
                            <input name="surname" type="text" id="surname" class="form-control"
                                   placeholder="Прізвище">
                            <label for="surname">Прізвище</label>
                        </div>
                        <div class="form-label-group">
                            <input name="phone" type="text" id="phone" class="form-control"
                                   placeholder="Телефон">
                            <label for="phone">Телефон</label>
                        </div>
                        <div class="form-label-group">
                            <input name="email" type="email" id="inputEmail" class="form-control"
                                   placeholder="Електронна пошта">
                            <label for="inputEmail">Електронна пошта</label>
                        </div>
                        <hr>
                        <div class="form-label-group">
                            <input name="pass" type="password" id="inputPassword" class="form-control"
                                   placeholder="Пароль">
                            <label for="inputPassword">Пароль</label>
                        </div>
                        <div class="form-label-group">
                            <input name="passconfirm" type="password" id="inputConfirmPassword" class="form-control"
                                   placeholder="Підтвердження пароля">
                            <label for="inputConfirmPassword">Підтвердження пароля</label>
                        </div>

                        <div class="form-label-group">
                            <img src="images/noimage.jpg" id="select_file"
                                 class="btn rounded-circle mx-auto d-block"
                                 width="200px" alt="noimage">
                            <input type="file" id="input_file" style="display: none;"/>
                            <input type="hidden" id="imgBase64" name="imgBase64" />
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Зареєструватись
                        </button>
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

<?php include_once("cropper-modal.php"); ?>

<?php include_once("scripts.php") ?>
<script src="node_modules/cropperjs/dist/cropper.min.js"></script>
<script>
    $(function () {

        //скритий інпут для вибора файла
        $input_file = $("#input_file");
        //фото по якому клікаємо для вибору файла
        $select_file = $("#select_file");

        //модалка для вибору файла
        $dialogCropper=$("#cropperModal");

        //при клікові по фото - робимо клік по інпуту для вибору файла
        $select_file.on("click", function () {
            $input_file.click();
        });

        //якщо користувач вибрав файл на ПК
        $input_file.on("change", function() {
            if (this.files && this.files.length) {
                //Беремо перший файл, який обрав користувач
                let file = this.files[0];
                var reader = new FileReader();
                //коли завершили читання файлу, відобраємо діалогове вікно для кропера і змінюємо фото у кропері
                reader.onload = function(e) {
                    let image = new Image();
                    image.src = e.target.result;
                    image.onload=function () {
                        if (image.height < 300 && image.width < 300) {
                            alert("Ваше фото має розмір " + image.width + " x " + image.height + ", а повино бути більше за 300 пікселів");
                            return false;
                        }
                        $dialogCropper.modal('show');
                        cropper.replace(e.target.result);
                    }
                }
                //Починаємо зчитувати файл, який обрав користувач
                reader.readAsDataURL(file);
            }
        });

        //Фото (тег img) у діалоговому вікні із яким працює кропер
        const imgPreview = document.getElementById('preview-img');
        //Налаштування кроперра
        const cropper = new Cropper(imgPreview, {
            aspectRatio: 1/1,
            viewMode: 1,
            autoCropArea: 0.5,
            crop(event) {
                // console.log(event.detail.x);
                // console.log(event.detail.y);
                // console.log(event.detail.width);
                // console.log(event.detail.height);
                // console.log(event.detail.rotate);
                // console.log(event.detail.scaleX);
                // console.log(event.detail.scaleY);
            },
           // if(cropper.width()<300 || cropper.height()<300)
           //  alert("Фото повино бути більше за 300 пікселів");
        });

        //клікнули на кнопку повернути фото
        $("#img-rotation").on("click",function (e) {
            e.preventDefault();
            cropper.rotate(45);
        });

        //Натиснули кнопку обрізати фото
        $("#cropImg").on("click", function (e) {
            e.preventDefault();
            //Отримали фото із кропера
            var imgContent = cropper.getCroppedCanvas().toDataURL();
            //відобразили фото на формі
            $select_file.attr("src", imgContent);
            $("#imgBase64").val(imgContent);
            //скриваємо діалогове вікно
            $dialogCropper.modal('hide');
        });

        //клікнули на кнопку Відмінити
        $("#cropCancel").on("click",function (e) {
            e.preventDefault();
            cropper.reset();
        });



    });
</script>
</body>
</html>
