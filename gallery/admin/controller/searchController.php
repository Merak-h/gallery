<?php
session_start();
require_once('admin/function/uvb.php');
require_once('admin/function/sqlprocess.php');
require_once('admin/function/sql_root.php');


class searchController{
    function search(){
        $input = h($_GET['value']);
        if(strpos($_SERVER['HTTP_REFERER'],'main.php')==false){
            $back_to = '<a><a href="main.php">galleryへ戻る</a></div><a href="'.$_SERVER['HTTP_REFERER'].'">前のページへ戻る</a>';
        }else{
            $back_to = '<a href="'.$_SERVER['HTTP_REFERER'].'">前のページへ戻る</a>';
        }
        
        echo '<h1><a href="main.php">Gallery</a></h1>';
        include_once('admin/view/searchView.php');
    }
    function process(){
        $input = h($_GET['value']);
        //正規表現で＃の取り除き＆条件の配列化
        $pattern='/[＃]+|[#]+|\s+/u';
        $valueArr = preg_split($pattern, $input);

        $posts = [];
        try{
          $root = pdo_root();
          $root = pdo_host();
          $user = pdo_user();
          $pass = pdo_pass();
          $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
          //SQLの作成s
          $join = '';
          $where = '';
          foreach ($valueArr as $i=>$value){
            $join = $join.' JOIN tags AS tag'.$i.' ON posts.post_id = tag'.$i.'.post ';
            if($i!==0){
              $where = $where.' AND';
            }
            $where = $where.' tag'.$i.'.tag LIKE :VALUE'.$i;
          }
          $sql='SELECT post_id, image_path, user.user_id FROM posts JOIN users AS user ON posts.poster = user.serial_id'.$join.' WHERE'.$where.' ORDER BY date DESC';
          
          $stmt = $pdo->prepare($sql);
          foreach ($valueArr as $i=>$value){
            $stmt->bindvalue(':VALUE'.$i,'%'.$value.'%');
          }
          $stmt->execute();
          
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($posts, $row);
            }
        } catch (PDOException $e){
            var_dump($e);
            echo '失敗';
        }
      
            $len = count($posts);
          include_once('admin/view/search_resulteView.php');
          include_once('admin/view/galleryView.php');
        }
            
        
}
        

?>