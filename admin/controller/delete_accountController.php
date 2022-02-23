<?php
session_start();
require_once('admin/function/logincheck.php');
require_once('admin/function/sessionUpdate.php');
require_once('admin/function/sql_root.php');
class delete_accountController{
    function view(){
        login_check();
        include_once('admin/view/delete_accountView.php');
    }

    function process(){
        session_update();
        $user = $_SESSION['user'];
        $serial_id = $user['serial_id'];

        try{
            $root = pdo_root();
            $root = pdo_host();
            $user = pdo_user();
            $pass = pdo_pass();
            $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
            $sql = 'DELETE FROM users WHERE serial_id = :SERIAL_ID';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':SERIAL_ID', $serial_id);
            $stmt->execute();

         

        }catch (PDOException $e){
          var_dump($e);
          echo '失敗';
        }

        try{
            $root = pdo_root();
            $root = pdo_host();
            $user = pdo_user();
            $pass = pdo_pass();
            $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
            $sql = 'DELETE FROM comments WHERE commenter = :SERIAL_ID';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':SERIAL_ID', $serial_id);
            $stmt->execute();
        }catch (PDOException $e){
          var_dump($e);
          echo '失敗';
        } 
        
        try{
            $root = pdo_root();
            $root = pdo_host();
            $user = pdo_user();
            $pass = pdo_pass();
            $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
            $sql = 'DELETE FROM posts WHERE poster = :SERIAL_ID';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':SERIAL_ID', $serial_id);
            $stmt->execute();
        }catch (PDOException $e){
          var_dump($e);
          echo '失敗';
        }


        $_SESSION = array();
        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }
        session_destroy();
        header('Location: main.php');


    }
}
