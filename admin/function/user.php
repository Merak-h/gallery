<?php
require_once('admin/function/sql_root.php');
class User{

    static function find_account($id, $pass){
        $user = null;
        try {
          $root = pdo_root();
          $root = pdo_host();
          $user = pdo_user();
          $pdopass = pdo_pass();
          $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pdopass);
            $stmt = $pdo->prepare('SELECT*FROM users WHERE user_id=:USER_ID '.'AND user_password=:PASSWORD');
            $stmt->bindParam(':USER_ID', $id);
            $stmt->bindParam(':PASSWORD', hash('sha256', $pass));
            $stmt->execute();
            if ( ($row = $stmt->fetch(PDO::FETCH_ASSOC)) ) {
                $user = $row;
              }
            } catch (PDOException $e){
              var_dump($e);
            }
            return $user;
        
    }
}