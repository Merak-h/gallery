<?php
session_start();
require_once('admin/function/uvb.php');
require_once('admin/function/sqlprocess.php');

//ini_set( 'display_errors', 1 );
//ini_set( 'error_reporting', E_ALL );


class commentController{
  /*
    //このfunctionはcontentにて実装
    function form(){
      $account = account_status('匿名さん');
        // 生成したトークンをセッションに保存
        $csrf_token = csrf();
        $_SESSION['csrf_token'] = $csrf_token;
        $post = h($_POST['post']);
        include_once('admin/view/commentView.php');
    }
    */
    
    function process(){
        // 先に保存したトークンと送信されたトークンが一致するか確認します
        $csrf_token=h($_POST["csrf_token"]);
        token_check($csrf_token,$_SESSION['csrf_token']);
        $post = h($_POST['post']);
        $comment = h($_POST["comment"]);
        if(isset($_SESSION['user'])){
          $commenter = $_SESSION['user']['serial_id'];
        }else{
          $commenter = null;
        }
        $input=[
          'post'=>$post,
          'commenter'=>$commenter,
          'content'=>$comment
        ];
        gallery::insert('comments',$input);
        /*
        try{
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=gallery;charset=utf8;', 'root', '');
            $stmt = $pdo->prepare(
              'INSERT INTO comments(post, commenter, content) VALUES(:POST, :COMMENTER, :CONTENT)'
            );
            $stmt->bindParam(':POST', $post);
            $stmt->bindParam(':COMMENTER', $commenter);
            $stmt->bindParam(':CONTENT', $comment);
            $stmt->execute();
            
           
          } catch (PDOException $e){
            var_dump($e);
            echo '失敗';
          }*/
          

          header('Location: content.php?post='.$post);

    }
}
?>