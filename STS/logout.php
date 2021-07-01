<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["kullanici_adi"]);
header("Location:login.php");
?>
