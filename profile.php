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
    if(isset($_SESSION['USER']) && $USER['role'] == 1){
    ?>
    <div class="profile">
        <div class="container">
            <div class="profile-content">
                <p class="title-left-20">Профиль > мои записи</p><br>
                <a href="./add_zapic.php" class="btn-1">Записаться на ноготочки</a>
                <div class="zapici-content"><br>
                    <?
                    $user_id = $USER['id'];
                    $sql = "SELECT * FROM add_zapic WHERE id_user = '$user_id'";
                    $result = $link -> query($sql) -> fetchAll(2);
                    foreach($result as $zapic){
                        $id_master = $zapic['id_master'];
                        $sql = "SELECT * FROM masters WHERE id = '$id_master'";
                        $result = $link -> query($sql);
                        $master = $result -> fetch();
                        
                        $id_time = $zapic['id_time'];
                        $sql = "SELECT * FROM times WHERE id = '$id_time'";
                        $result = $link -> query($sql);
                        $time = $result -> fetch();

                        $id_status = $zapic['id_status'];
                        $sql = "SELECT * FROM status WHERE id = '$id_status'";
                        $result = $link -> query($sql);
                        $status = $result -> fetch();
                    ?>
                    <div class="zapici-zapici">
                        <div>
                            <p class="text-bold">Запись № <?=$zapic['id']?></p>
                            <p class="text-16">Мастер: <?=$master['master']?></p>
                            <p class="text-16">Дата: <?=$zapic['date']?></p>
                            <p class="text-16">Время: <?=$time['time']?></p>
                        </div>
                        <p class="text-bold2">Статус: <?=$status['status']?></p>
                    </div><br>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
    <?}else if($USER['role'] == 2){
        echo '<script>document.location.href="admin.php"</script>';
    }else{
        echo '<script>document.location.href="avtoriz.php"</script>';
    }
    ?>
</body>
</html>