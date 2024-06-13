<?
    session_start();
    include('./assets/incl/head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="header">
        <div class="container">
            <div class="header-content">
                <a href="./index.php">
                <h2 class="logo-txt">LOGO</h2>
                </a>
                <?if(isset($_SESSION['USER']) && $USER['role'] == 1){?>
                    <div>
                    <a href="./profile.php" class="btn-header">Профиль</a>
                    <a href="?do=exit" class="btn-header">Выйти</a>
                    </div>
                <?}else if($USER['role'] == 2){?>
                    <div>
                    <a href="./admin.php" class="btn-header">Админ-панель</a>
                    <a href="?do=exit" class="btn-header">Выйти</a>
                    </div>
                <?}else{?>
                    <a href="./avtoriz.php" class="btn-header">Войти</a>
                <?}?>
            </div>
        </div>
    </div>
</body>
</html>