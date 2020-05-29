<?php
if($_COOKIE['user']=='') {
    header("Location: login.php");
}
else{
    setcookie('user', $user['email'], time()-3600, "/");
    header("Location: index.php");
}

