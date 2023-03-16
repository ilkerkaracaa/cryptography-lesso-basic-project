<?php

ob_start();
session_start();

require 'connect.php';

if(isset($_POST['kayit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_again = @$_POST['password_again'];

    if(!$username){
        echo "Lütfen kullanıcı adınızı girin!";
        header('Refresh:2; register.php');
    }elseif(!$password || !$password_again){
        echo "Lütfen şifrenizi girin!";
        header('Refresh:2; register.php');
    }elseif($password != $password_again){
        echo "Girdiğiniz şifre aynı değil!";
        header('Refresh:2; register.php');
    }else{
        //veritabanı kayıt
        $sorgu = $db->prepare('INSERT INTO users SET user_name = ?, user_password = ?');
        $ekle = $sorgu->execute([
            $username,$password
        ]);
        if($ekle){
            echo "Kayıt Başarılı!";
            header('Refresh:2; index.php');
        }else{
            echo "Kayıt Başarısız!";
            header('Refresh:2; index.php');
        }
    }
}
if(isset($_POST['giris'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(!$username){
        echo "Kullanıcı adınızı girin!";
        header('Refresh:2; index.php');
    }elseif(!$password){
        echo "Şifrenizi girin!";
        header('Refresh:2; index.php');
    }else{
        $kullanici_sor = $db->prepare('SELECT * FROM users WHERE user_name = ? && user_password = ?');
        $kullanici_sor->execute([
            $username,$password
        ]);
        $say = $kullanici_sor->rowCount();
        if($say==1){
            $_SESSION['username']=$username;
            echo "Başarıyla giriş yaptın!";
            header('Refresh:2; Anasayfa.php');
        }else{
            echo "Kullanıcı kayıtlı değil!";
            header('Refresh:2; index.php');
        }
    }
}


    //$chiphers = openssl_get_cipher_methods();
    //echo '<pre>';
    //print_r($chiphers);
    define('CIPHER','AES-128-ECB');

    function encrypt($data,$anahtar){
        return openssl_encrypt($data,CIPHER,$anahtar);
    } 

    function decrypt($data,$anahtar){
        return openssl_decrypt($data,CIPHER,$anahtar);
    } 


if(isset($_POST['metin-kayit'])){
    $metin = $_POST['metin'];
    $anahtar = $_POST['anahtar'];
    if(!$metin){
        echo "Lütfen metin girin!";
        header('Refresh:2; Anasayfa.php');
    }
    else if(!$anahtar){
        echo "Lütfen anahtar girin!";
        header('Refresh:2; Anasayfa.php');
    }else{
        //veritabanı kayıt
        $sorguAnahtar = $db->prepare('INSERT INTO anahtar SET anahtar = ?, anahtar_sahibi = ?');
        $ekle = $sorguAnahtar->execute([
            $anahtar,$_SESSION['username']
        ]);
        $sifreliMetin = encrypt($metin,$anahtar);
        $sorgu = $db->prepare('INSERT INTO texts SET text = ?');
        $ekle = $sorgu->execute([
            $sifreliMetin
        ]);
        if($ekle){
            echo "Kayıt Başarılı!";
            header('Refresh:2; Anasayfa.php');
        }else{
            echo "Kayıt Başarısız!";
            header('Refresh:2; Anasayfa.php');
        }
    }
}


if(isset($_POST['son-kayit-getir'])){
    $servername = "localhost";

    $username = "root";
    
    $password = "root";
    
    $dbname = "projeDb";
    
    $anahtar = $_POST['anahtar'];
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // bağlantıyı test et
    
    if ($conn->connect_error) {
    
        die("Connection failed: " . $conn->connect_error);
    
    } 
    
    
    
    $sql = "select * from texts order by text_id desc limit 1";
    //SELECT texts FROM texts
    
    
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows > 0) {
    
        // her bir satırı döker
        $acilmisMetin;
        while($row = $result->fetch_assoc()) {
    
            $metin = $row["text"];
    
        }
        $geriDonen = decrypt($metin,$anahtar);
        if(!$geriDonen){
            echo $metin;
            header('Refresh:2; Anasayfa.php');
        }else{
            echo $geriDonen;
        }
        //echo decrypt($acilmisMetin,$anahtar);
    
    } else {
    
        echo "0 results";
    
    }
    
    $conn->close();

    
}
?>
