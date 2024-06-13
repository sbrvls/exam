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
    <div class="registr">
        <div class="container"><br><br>
            <div class="registr-content">
                <?if(isset($_POST['add_zapic'])){
                    $id_master = $_POST['id_master'];
                    $id_user = $USER['id'];
                    $date = $_POST['date'];
                    $id_time = $_POST['id_time'];

                    if(empty($id_master)){
                        $er_master = '<p class="error">Выберите мастера</p>';
                    }

                    if(empty($date)){
                        $er_date = '<p class="error">Выберите дату</p>';
                    }
                    $sql = "SELECT count(*) FROM add_zapic WHERE id_master = '$id_master' AND date = '$date' AND id_time = '$id_time'";
                    $zapic = $link -> query($sql) -> fetchColumn();
                    
                    if(empty($id_time)){
                        $er_time = '<p class="error">Выберите время</p>';
                    }else if($zapic == 1){
                        $er_time = '<p class="error">К сожалению, на это время уже есть запись</p>';
                    }


                    if (empty($er_master) && empty($er_date) && empty($er_time)){
                        $sql = "INSERT INTO add_zapic (id_master, id_user, date, id_time, id_status)
                        VALUES ('$id_master','$id_user','$date','$id_time','1')";
                        $link -> query($sql);
                        echo '<script>document.location.href="profile.php"</script>';
                    }

                }?>
                <form method="POST" class="reg">
                <p class="title-center-24">Запись на ноготочки</p>
                    <label class="label">Выберите мастера</label><br>
                    <select name="id_master" class="input-reg width">
                        <option value="0" class="input-reg">
                            <?
                            $sql = "SELECT * FROM masters";
                            $res =$link -> query($sql);
                            foreach($res as $master){?>
                                <option value="<?=$master['id']?>"><?=$master['master']?></option>
                            <?}
                            ?>
                        </option>
                    </select>
                    <?=$er_master?>
                    <label class="label">Выберите дату</label><br>
                    <input type="date" name="date" class="input-reg">
                    <?=$er_date?>
                    <label class="label">Выберите время</label><br>
                    <select name="id_time" class="input-reg width">
                        <option value="0" class="input-reg">
                            <?
                            $sql = "SELECT * FROM times";
                            $res =$link -> query($sql);
                            foreach($res as $times){?>
                                <option value="<?=$times['id']?>"><?=$times['time']?></option>
                            <?}
                            ?>
                        </option>
                    </select>
                    <?=$er_time?>
                    <br>
                    <input type="submit" name="add_zapic" value="Записаться" class="input-reg-center">
                </form>
            </div>
        </div>
    </div>
    <?}else{
        echo'';
    }?>
</body>
</html>