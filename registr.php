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
                <?if(isset($_POST['reg'])){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $vodit = $_POST['vodit'];
                    $pass1 = $_POST['pass1'];
                    $pass2 = $_POST['pass2'];
                    $cash_pass = md5($pass1);

                    if(empty($name)){
                        $er_name = '<p class="error">Введите имя</p>';
                    }else if (!preg_match('/^[а-яёА-ЯЁ]+$/u', $name)){
                        $er_name = '<p class="error">Имя должен содержать только кириллицуу</p>';
                    }
                    if(empty($vodit)){
                        $er_vodit = '<p class="error">Введите имя</p>';
                    }

                    $sql_email = "SELECT count(*) FROM users WHERE email = '$email'";
                    $count = $link -> query($sql_email) -> fetchColumn();
                    if(empty($email)){
                        $er_email = '<p class="error">Введите эл. почту</p>';
                    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $er_email = '<p class="error">Неправильный формат почты</p>';
                    }else if($count == 1){
                        $er_email = '<p class="error">Пользователь с такой почтой уже существует</p>';
                    }
                    
                    $count_number = strlen($phone);
                    if(empty($phone)){
                        $er_phone = '<p class="error">Введите номер телефона</p>';
                    }else if($count_number > 11){
                        $er_phone = '<p class="error">Номер телефона должен содержать 11 символов</p>';
                    }else if($count_number < 11){
                        $er_phone = '<p class="error">Номер телефона должен содержать 11 символов</p>';
                    }
                    if(empty($vodit)){
                        $er_vodit = '<p class="error">Введите номер водит. удостоверения</p>';
                    }

                    if(empty($pass1)){
                        $er_pass = '<p class="error">Введите пароль</p>';
                    }else if (strlen($pass1) < 3){
                        $er_pass = '<p class="error">Пароль должен содержать минимум 3 символа</p>';
                    }else if(!preg_match('/\d/', $pass1)){
                        $er_pass = '<p class="error">Пароль должен содержать хотя бы одну цифру</p>';    
                    }else if(empty($pass2)){
                        $er_pass = '<p class="error">Повторите пароль</p>';
                    }else if (isset($pass1) && isset($pass2)){
                        if($pass1 != $pass2){
                            $er_pass = '<p class="error">Пароли не совпадают</p>';
                        }
                    }

                    if (empty($er_name) && empty($er_email) && empty($er_phone) && empty($er_pass) && 
                    empty($er_vodit)){
                        $sql = "INSERT INTO users (name, email, phone, vodit, password, role)
                        VALUES ('$name','$email','$phone','$vodit','$cash_pass','1')";
                        $link -> query($sql);

                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = $link -> query($sql) -> fetch();
                        $_SESSION['USER'] = $result['id'];
                        echo '<script>document.location.href="profile.php"</script>';
                    }
                }?>
                <form method="POST" class="reg">
                <p class="title-center-24">Регистрация</p>
                    <label class="label">Имя</label><br>
                    <input type="text" name="name" class="input-reg">
                    <?=$er_name?>
                    <label class="label">Номер телефона</label><br>
                    <input type="number" name="phone" class="input-reg">
                    <?=$er_phone?>
                    <label class="label">Эл. почта</label><br>
                    <input type="text" name="email" class="input-reg">
                    <?=$er_email?>
                    <label class="label">Водительское удостоверение</label><br>
                    <input type="number" name="vodit" class="input-reg">
                    <?=$er_vodit?>
                    <label class="label">Пароль</label><br>
                    <input type="password" name="pass1" class="input-reg">
                    <?=$er_pass?>
                    <label class="label">Повтор пароля</label><br>
                    <input type="password" name="pass2" class="input-reg">
                    <br>
                    <input type="submit" name="reg" value="Зарегистрироваться" class="input-reg-center">
                </form>
            </div>
        </div>
    </div>
    <?}?>
</body>
</html>