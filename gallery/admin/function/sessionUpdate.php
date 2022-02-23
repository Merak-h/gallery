<?php
function session_update(){
    require_once('admin/function/sql_root.php');
    $now = time();
        if(isset($_SESSION['user']) && (!isset($_SESSION['user']['last_date']) || $_SESSION['user']['last_date']<$now+10)){
            $serial_id = $_SESSION['user']['serial_id'];
            try{
                $root = pdo_root();
                $root = pdo_host();
                $pdouser = pdo_user();
                $pass = pdo_pass();
                $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $pdouser, $pass);
                $sql = 'SELECT * FROM users WHERE serial_id = :SERIAL_ID';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':SERIAL_ID', $serial_id);
                $stmt->execute();
                if ( ($user = $stmt->fetch(PDO::FETCH_ASSOC)) ) {
                    
                    $a = [
                        'serial_id'=> $user['serial_id'],
                        'user_id'  => $user['user_id'],
                        'last_date'=> $now
                    ];
                    $_SESSION['user'] =$a;
                    
                  }
    
            }catch (PDOException $e){
              var_dump($e);
              echo '失敗';
            }
           
        }
}