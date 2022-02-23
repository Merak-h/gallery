<?php
session_start();
require_once('admin/function/user.php');
require_once('admin/function/uvb.php');
require_once('admin/function/logincheck.php');

class loginController {

  function login() {
      logout_check();
    
      // ギャラリー画面を表示する
      $csrf_token = csrf();
      // 生成したトークンをセッションに保存
      $_SESSION['csrf_token'] = $csrf_token;
      if(isset($_GET['error'])){
        $errorMassage= '正しくありません。';
      }else{
        $errorMassage= '';
      }
      include('admin/view/loginView.php');
        
  }

      //login_action.phpの処理をここでする。
    function loginProcess(){

            
      // 先に保存したトークンと送信されたトークンが一致するか確認します
      $csrf_token=h($_POST["csrf_token"]);
      token_check($csrf_token,$_SESSION['csrf_token']);

        $user_id = h($_POST['user_id']);
        $password = h($_POST['password']);
        //echo $user_id;

         // ログイン処理 ==> user.php に委譲して　userID　とパスワードからレコードがが存在するかどうか
      $user = User::find_account($user_id, $password);
      if ($user) {
        // レコードが見つかった（ログイン成功）場合
        session_regenerate_id();
        $_SESSION['user'] = $user;
        header('Location: main.php');
      } else {
        // レコードが見つからなかった場合のエラー処理
        header('Location: login.php?error=ture');
      }
        //header('Location: gallery.php');
    }
}
