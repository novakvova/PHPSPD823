<?php include_once("conection_database.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once("styles.php") ?>
    <title>Бомба - пітарда</title>
</head>
<body>
<?php
include_once("navbar.php");
?>
<div class="container">
    <h1>Головна сторінка</h1>
    <div class="row">
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">Фото</th>
                <th scope="col">Ім'я</th>
                <th scope="col">Прізвище</th>
                <th scope="col">Телефон</th>
                <th scope="col">Електорнна пошта</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT u.id, u.name, u.surname, u.phone, u.email, u.image FROM users AS u";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td>
                        <img src="<?= "/images/" . $row['image']; ?>" height="30px"/>
                    </td>
                    <td>
                        <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <?php echo $row['surname']; ?>
                    </td>
                    <td>
                        <?php echo $row['phone']; ?>
                    </td>
                    <td>
                        <?php echo $row['email']; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once("scripts.php") ?>
</body>
</html>