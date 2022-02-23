<?php
session_start();
require_once('admin/function/uvb.php');
require_once('admin/function/logincheck.php');
require_once('admin/function/sql_root.php');
class updatePassController{
   
    function PassConfForm(){
        login_check();
        // 生成したトークンをセッションに保存
        $csrf_token = csrf();
        $_SESSION['csrf_token'] = $csrf_token;
        $help = '';
        if(isset($_GET['error'])==true){
            $help = '<p style="color:red;">パスワードが一致しません</p>';
        }
        include_once('admin/view/updatePassConfView.php');
    }
    function PassConfProcess(){
        //POSTデータ及びSESSIONデータの取得
        $id =$_SESSION['user']['serial_id'];
        $t = h($_POST['csrf_token']);
        $pass = h($_POST['password']);
        //token の整合性の確認
        token_check($t,$_SESSION['csrf_token']);
        
        //passの整合性の確認
        try{
            $root = pdo_root();
            $root = pdo_host();
            $user = pdo_user();
            $pdopass = pdo_pass();
            $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pdopass);
            $stmt = $pdo->prepare('SELECT * FROM users WHERE serial_id = :SERIAL_ID AND user_password=:PASSWORD');
            $stmt->bindParam(':SERIAL_ID',$id);
            $stmt->bindParam(':PASSWORD', hash('sha256', $pass));

            $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
                    var_dump($e);
        }
        if (isset($row['serial_id'])==$id) {
            header('Location: update_password_set.php');  
        }else{
            header('Location: update_password.php?error=true');        
        }
        
    }

    function PassChangeForm(){
        // 生成したトークンをセッションに保存
        $csrf_token = csrf();
        $_SESSION['csrf_token'] = $csrf_token;
        $serial_id = $_SESSION['user']['serial_id'];
        
        
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
           
            if ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
              
                $user = $row;
                $serial_id = $user['serial_id'];
                $varsion = $user['varsion'];
                $account = $user['user_id'];
              }
              

        }catch (PDOException $e){
          var_dump($e);
          echo '失敗';
        }

        $help = '';
        if(isset($_GET['error'])){
            $help = '<p style="color:red;">パスワードが変更できませんでした。<br>再度お試し下さい。</p>';
        }
        include_once('admin/view/updatePassView.php');
        ?>
        <script src="js/checkPass.js"></script>
        <?php
       
                   
                  
    }
    function changePassProcess(){

        // 先に保存したトークンと送信されたトークンが一致するか確認します
        $csrf_token=h($_POST["csrf_token"]);
        token_check($csrf_token,$_SESSION['csrf_token']);

        $pass = h($_POST['pass1']);
        $pass = hash('sha256', $pass);
        $serial_id = h($_POST['serial_id']);
        $varsion = h($_POST['varsion']);
        $newVarsion = $varsion+1;



        
        try{
            $root = pdo_root();
            $root = pdo_host();
            $pdouser = pdo_user();
            $pdopass = pdo_pass();
            $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $pdouser, $pdopass);
            $sql = 'UPDATE users SET user_password = :PASS, varsion = :NEW_VARSION WHERE serial_id = :SERIAL_ID AND varsion = :VARSION';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':PASS', $pass);
            $stmt->bindParam(':SERIAL_ID', $serial_id);
            $stmt->bindParam(':VARSION', $varsion);
            $stmt->bindParam(':NEW_VARSION', $newVarsion);
            $stmt->execute();
            
            $row = $stmt->rowCount();
            if($row==1){
                //セッションのuser配列の更新
                $user['user_password'] = $pass;           
                $_SESSION['user']['user_password'] = $pass;            
                header('Location: infomation.php');
            }else{
                header('Location: update_password_set.php?error=true');
            }
            

        }catch (PDOException $e){
          var_dump($e);
          echo '失敗';
        }
        
    

    }
}
?>


<?php
/*


try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=gallery;charset=utf8;', 'root', '');
    $stmt = $pdo->prepare('SELECT * FROM users WHERE serial_id = :SERIAL_ID AND user_password=:PASSWORD');
    $stmt->bindParam(':SERIAL_ID',$id);
    $stmt->bindParam(':PASSWORD', hash('sha256', $pass));

    $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e){
            var_dump($e);
}


try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=gallery;charset=utf8;', 'root', '');
    $sql = 'UPDATE users SET user_password = :PASS WHERE serial_id = :SERIAL_ID';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':PASS', $pass);
    $stmt->bindParam(':SERIAL_ID', $serial_id);
    $stmt->execute();
    
    //セッションのuser配列の更新
    $user['user_password'] = $pass;
    $_SESSION['user'] = $user;
    header('Location: infomation.php');

}catch (PDOException $e){
  var_dump($e);
  echo '失敗';
}
*/