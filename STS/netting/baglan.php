<?php

try {
    $db=new PDO("mysql:host=localhost;dbname=sts", 'root','');
    //echo "veri tabanı bağlantısı başarılı";
} catch (PDOExpception $e)
{
    echo $e->getMessage();
}

?>