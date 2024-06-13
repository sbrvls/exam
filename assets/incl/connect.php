<?
try{
    $link = new PDO ("mysql:host=localhost; dbname=proect",'root', '');
}catch(PDOException $e){
    echo $e;
}
?>