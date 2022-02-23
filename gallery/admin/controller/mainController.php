
<?php
session_start();
require_once('admin/function/sqlprocess.php');
require_once('admin/function/sessionUpdate.php');
//エラー確認用
  //ini_set( 'display_errors', 1 );
  //ini_set( 'error_reporting', E_ALL );

class GalleryController {

    // ギャラリー画面を表示する
    function gallery() {
      //galleryの一覧を取得
      $sql = 'SELECT * FROM posts LEFT JOIN users ON posts.poster = users.serial_id ';
      $posts = gallery::select($sql,'','',false,true);
      //アカウント名を取得
      if(isset($_SESSION['user'])){
        session_update();
        $account = $_SESSION['user']['user_id'];
      }else{
        $account=null;
      }
      
      if($account!== null){
        $atAccount = '@'.$account;
      }else{
        $atAccount = '';
      }
      $input='';
      include('admin/view/mainView.php');
      include_once('admin/view/searchView.php');
      include_once('admin/view/galleryView.php');
      ?>
    
      <?php
    }
}

