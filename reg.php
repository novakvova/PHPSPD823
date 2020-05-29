<?php
if($_COOKIE['user']=='') {
    header("Location: register.php");
}
else{
    header("Location: profile.php");
}