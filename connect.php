<?php
try {
    $db = new PDO("mysql:host=localhost; dbname=projeDb; charset=utf8",'root','root');
    //echo "Veritabanı bağlantısı başarılı!";
} catch(Exception $e) {
    echo $e->getMessage();
}

?>