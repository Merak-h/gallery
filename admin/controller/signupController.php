<?php 
session_start();
require_once('admin/function/uvb.php');
require_once('admin/function/user.php');
require_once('admin/function/logincheck.php');
require_once('admin/function/sql_root.php');
class signupController{

    function signup(){
      logout_check();
        
        if(isset($_GET['error'])){
            $error = '<p>登録処理中に問題が発生しました。<br> もう一度登録してください。</p>';
        }else{
            $error = '';
        }
        $csrf_token = csrf();
        // 生成したトークンをセッションに保存
        $_SESSION['csrf_token'] = $csrf_token;

        include_once('admin/view/signupView.php');
        ?>
        <script src="js/signup.js"></script>
        <?php
    }

    function process(){
        
        // 先に保存したトークンと送信されたトークンが一致するか確認します
        $csrf_token=h($_POST["csrf_token"]);
        token_check($csrf_token,$_SESSION['csrf_token']);
       
        
        $user_id = h($_POST['user_id']);
        $password = h($_POST['pass1']);
        $user_pass = hash('sha256', $password);
        echo 'ID: '.$user_id;
        echo '<br>';
        echo 'pass: '.$password;
        echo '<br>';
        echo 'pass(hash):'.$user_pass ;
        
        try{
          $root = pdo_root();
          $root = pdo_host();
          $pdouser = pdo_user();
          $pass = pdo_pass();
          $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $pdouser, $pass);
            $sql = 'INSERT INTO users (user_id, user_password) VALUES(:USER_ID, :USER_PASS)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':USER_ID', $user_id);
            $stmt->bindParam(':USER_PASS', $user_pass);
            $stmt->execute();
        }catch (PDOException $e){
          var_dump($e);
          echo '失敗';
        }

        // ログイン処理 ==> user.php に委譲して　userID　とパスワードからレコードがが存在するかどうか
        $user = User::find_account($user_id, $password);
      if ($user) {
        // レコードが見つかった（ログイン成功）場合
        session_regenerate_id();
        $_SESSION['user'] = $user;
        header('Location: main.php');
      } else {
        // レコードが見つからなかった場合のエラー処理
        header('Location: signup.php?error=ture');
      }

    }
}