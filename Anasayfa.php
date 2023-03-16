<?php
    require 'connect.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login">
        <div class="login-screen">
            <div class="app-title">
                <h1>Anasayfa</h1>
            </div>
            <form action="process.php" method="post">
            <div class="login-form">
                <div class="control-group">
                    <input type="text" name="metin" class="login-field" placeholder="Metin Gir" id="login-name">
                    <label class="login-field-icon fui-user" for="login-name"></label>
                </div>
                <div class="control-group">
                    <input type="text" name="anahtar" class="login-field" placeholder="Anahtar Gir" id="login-name">
                    <label class="login-field-icon fui-user" for="login-name"></label>
                </div>
                <button href="Anasayfa.php" name="metin-kayit" class="btn btn-primary btn-large btn-block">Metin Gir</button>
                <button href="Anasayfa.php" name="son-kayit-getir" class="btn btn-primary btn-large btn-block">Son Metni Getir</button>
            </div>
            </form>
        </div>
    </div>    

</body>
</html>