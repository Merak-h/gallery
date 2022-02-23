<?php
session_start();
require_once('admin/function/sqlprocess.php');
require_once('admin/function/uvb.php');
require_once('admin/function/sessionUpdate.php');
class contentController {
    function content(){

        $csrf_token = csrf();
        $_SESSION['csrf_token'] = $csrf_token;
        $post = h($_GET['post']);
        $postArr[] = $post;
        //tag一覧生成
        $sql = 'SELECT * FROM posts LEFT JOIN users ON posts.poster = users.serial_id';
        $result = gallery::select($sql,'post_id',$postArr);
        $postInfo = $result[0];
        //tag一覧生成
        $sql = 'SELECT * FROM tags';
        $tags = gallery::select($sql,'post',$postArr);
        //コメント欄生成
        $sql = 'SELECT * FROM comments LEFT JOIN users ON comments.commenter = users.serial_id';
        $comments = gallery::select($sql,'post',$postArr,false,true);
      
        
        if($_SESSION['user']['user_id']==''){
            $account = '匿名さん';
        }else{
            session_update();
            $account = '@'.$_SESSION['user']['user_id'];
        }
        include('admin/view/contentView.php');
        include_once('admin/view/commentView.php');
    }

       
          
    function process(){
        echo h($_POST["csrf_token"]);
        // 先に保存したトークンと送信されたトークンが一致するか確認します
        //$csrf_token=h($_POST["csrf_token"]);
        //token_check($csrf_token,$_SESSION['csrf_token']);
        $post = h($_POST['post']);
        $comment = h($_POST["comment"]);
        $commenter = $_SESSION['user']['serial_id'];
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