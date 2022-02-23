<?php
require_once('uvb.php');
require_once('sql_root.php');
$id = h($_POST['id']);



try{
    $root = pdo_host();
    $user = pdo_user();
    $pass = pdo_pass();
    $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
    $sql = 'SELECT EXISTS(SELECT * FROM users WHERE user_id = :USER_ID)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindvalue(':USER_ID',$id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    foreach($row as $key=>$value){
        $result = $value;
    }
    if($result==0){
        $r= 'notIsset';
    }else{
        $r= 'isset';
    }
    echo $r;
}catch (PDOException $e){
    var_dump($e);
    }
    