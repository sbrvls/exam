<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
<?
    include('./assets/incl/header.php');
    if(isset($_SESSION['USER'])){
        echo '<script>document.location.href="profile.php"</script>';
    }else{
    ?>
    <div class="registr">
        <div class="container"><br><br>
            <div class="registr-content">
                <?if(isset($_POST['avtoriz'])){
                    $email = $_POST['email'];
                    $pass1 = $_POST['pass1'];
                    $cash_pass = md5($pass1);


                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $user_email = $link -> query($sql) -> fetch();

                    if(empty($email)){
                        $er_email = '<p class="error">Введите эл. почту</p>';
                    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $er_email = '<p class="error">Неправильный формат почты</p>';
                    }else if(empty($user_email)){
                        $er_email = '<p class="error">Вы еще не зареганы</p>';
                    }

                    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$cash_pass'";
                    $user2 = $link -> query($sql) -> fetch();

                    if(empty($pass1)){
                        $er_pass = '<p class="error">Введите пароль</p>';
                    }else if(empty($user2)){
                        $er_pass = '<p class="error">Неверный пароль</p>';
                    }

                    if (empty($er_email) && empty($er_pass)){
                        $_SESSION['USER'] = $user2['id'];
                        echo '<script>document.location.href="profile.php"</script>';
                    }

                }?>
                <form method="POST" class="reg">
                <p class="title-center-24">Вход</p>
                    <label class="label">Эл. почта</label><br>
                    <input type="text" name="email" class="input-reg">
                    <?=$er_email?>
                    <label class="label">Пароль</label><br>
                    <input type="password" name="pass1" class="input-reg">
                    <?=$er_pass?>
                    <br>
                    <input type="submit" name="avtoriz" value="Войти" class="input-reg-center">
                </form>
            </div>
        </div>
    </div>
    <?}?>
</body>
</html>