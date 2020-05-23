<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once("styles.php")?>
    <title>Бомба - пітарда</title>
</head>
<body>
<?php include_once ("navbar.php");?>
<?php include_once ("connection_database.php");?>
<!--    $a=12;-->
<!--    $b="13";-->
<!--    $c=$a+$b;-->
<!--    $d=$a.$b;-->
<!--    echo "<h1>Hello PHP =".$c." - ".$d."</h1>";-->
<div class="container">
    <h1>Головна сторінка</h1>
    <div class="row">
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT u.id, u.email, u.image FROM users AS u";
            $stmt= $dbh->prepare($sql);
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td scope="row">
                        <?php echo $row['image'];?>
                    </td>
                    <td> <?php echo $row['email']; ?> </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once("scripts.php")?>
</body>
</html>