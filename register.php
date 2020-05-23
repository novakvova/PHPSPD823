<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $email=$_POST["email"];
    $password=$_POST["pass"];
    $passwordconfirm=$_POST["passconfirm"];
    $file=$_POST["file"];

    include_once("connection_database.php");
    if (!empty($email) && !empty($password)) {
        $sql = "INSERT INTO users (image, email, password) VALUES (?, ?, ?);";
        $stmt= $dbh->prepare($sql);
        $stmt->execute([$file, $email, $password]);

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
    <?php include_once("styles.php")?>
    <link rel="stylesheet" href="register.css">
    <title>Бомба - пітарда</title>
</head>
<body>
<?php include_once ("navbar.php");?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card card-signin flex-row my-5">
                <div class="card-img-left d-none d-md-flex">
                    <!-- Background image for card set in CSS! -->
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Реєстрація</h5>
                    <form class="form-signin" method="post">
                        <div class="form-label-group">
                            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
                            <label for="inputEmail">Email address</label>
                        </div>
                        <hr>

                        <div class="form-label-group">
                            <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="form-label-group">
                            <input name="passconfirm" type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" required>
                            <label for="inputConfirmPassword">Confirm password</label>
                        </div>

                        <div class="form-label-group">
                            <div class="custom-file">
                                <input name="file" type="file" class="custom-file-input" id="inputGroupFile04">
                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
                        <a class="d-block text-center mt-2 small" href="#">Sign In</a>
                        <hr class="my-4">
                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fa fa-google mr-2"></i> Sign up with Google</button>
                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fa fa-facebook-f mr-2"></i> Sign up with Facebook</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("scripts.php")?>
</body>
</html>
