<?php
session_start();
require_once('admin/function/uvb.php');
require_once('admin/function/logincheck.php');
require_once('admin/function/sessionUpdate.php');
require_once('admin/function/sql_root.php');
class updateController{
    function changeIdForm(){ 
        login_check();
        // 生成したトークンをセッションに保存
        $csrf_token = csrf();
        $_SESSION['csrf_token'] = $csrf_token;
       session_update();
        $user = $_SESSION['user'];
        $serial_id = $user['serial_id'];

         //トランザクションのバージョン管理
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
            if ( ($row = $stmt->fetch(PDO::FETCH_ASSOC)) ) {
                $user = $row;
                $serial_id = $user['serial_id'];
                $varsion = $user['varsion'];
                $account = $user['user_id'];
              }

        }catch (PDOException $e){
          var_dump($e);
          echo '失敗';
        }

        if(isset($_GET['error'])){
            $message='登録処理中にエラーが発生しました。<br>もう一度登録してください。';
        }else{
            $message = '';
        }

    
        include_once('admin/view/updateIdView.php');
        ?>
        <script src="js/idUpdate.js"></script>
        <?php
    }
    function changeIdProcess(){
        // 先に保存したトークンと送信されたトークンが一致するか確認します
        $csrf_token=h($_POST["csrf_token"]);
        token_check($csrf_token,$_SESSION['csrf_token']);


        $newId = h($_POST['id']);
        $serial_id = h($_POST['serial_id']);
        $varsion = h($_POST['varsion']);
        $newVarsion = $varsion+1;
        
            try{
                
                $root = pdo_host();
                $user = pdo_user();
                $pass = pdo_pass();
                $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
                $sql = 'UPDATE users SET user_id = :ID, varsion = :NEW_VARSION WHERE serial_id = :SERIAL_ID AND varsion = :VARSION';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':ID', $newId);
                $stmt->bindParam(':SERIAL_ID', $serial_id);
                $stmt->bindParam(':VARSION', $varsion);
                $stmt->bindParam(':NEW_VARSION', $newVarsion);
                $stmt->execute();
                $row = $stmt->rowCount();
                if($row==1){
                    
                    $_SESSION['user']['user_id'] = $newId;
                    header('Location: infomation.php');
                }else{
                    header('Location: update_id.php?error=true');
                }
                

            }catch (PDOException $e){
              var_dump($e);
              echo '失敗';
            }
            

       // }
    }
}
?>
