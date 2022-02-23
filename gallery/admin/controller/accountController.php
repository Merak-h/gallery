<?php
session_start();
require_once('admin/function/uvb.php');
require_once('admin/function/sqlprocess.php');
require_once('admin/function/logincheck.php');
require_once('admin/function/sessionUpdate.php');

class accountControler{
    function view(){
        session_update();

        $user = $_SESSION['user'];
        $user_id = $user['user_id'];
        $account = h($_GET['account']);
        if($account==''){
            login_check();
        }
        if ($user_id===$account){
            $info = '<a href="infomation.php">情報管理</a>';
        }else{
            $info = '';
        }
            
        $array[] = $account;
        $atAccount = '@'.$account;
        $sql = 'SELECT * FROM posts LEFT JOIN users ON posts.poster = users.serial_id ';
        $posts = gallery::select($sql,'user_id',$array,false,true);
        include_once('admin/view/accountView.php');
        if($posts===Array()){
            echo '<p>アップロードされた写真がありません。</p>';
            if($user_id===$account){
                echo '<a href="post.php">初めての投稿をしてみる</a>';
            }
        }
        include_once('admin/view/galleryView.php');
    }
    
      
}
?>