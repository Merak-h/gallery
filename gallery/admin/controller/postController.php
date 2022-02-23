<?php
session_start();
require_once('admin/function/sqlprocess.php');
require_once('admin/function/uvb.php');
require_once('admin/function/logincheck.php');
//require_once('admin/function/loginStat.php');
//ini_set( 'display_errors', 1 );
//ini_set( 'error_reporting', E_ALL );


    class postController {

        // ギャラリー画面を表示する
        function post() {
            $back = 'main.php';
            //account_status('admin/view/postView.php');
            login_check();
            $account = $_SESSION['user']['user_id'];
            include_once('admin/view/postView.php');
            
            
              
        }
        //post_actionの処理
        function process(){
            
            $image= $_FILES['image'];
            $title= h($_POST['title']).'';
            $tag= h($_POST['tag']);
            $description= h($_POST['discription']).'';
            // 画像の中身でハッシュ値を作って、それをパスにする
            //$image_hash = hash_file('md5', $image['tmp_name']);
            // 現在時刻から画像を命名。
            $image_hash = 'IMG_'.date("YmdHis"). substr(explode(".", (microtime(true) . ""))[1], 0, 3);
            $imagePath='images/'.$image_hash.'.png';
            //写真の保存
            if(isset($image)){
                move_uploaded_file(
                    $image['tmp_name'],$imagePath
                );
            }
            $user= $_SESSION['user'];
            $serial= intval($user['serial_id']);
            $input=[
              'title'=>$title,
              'image_path'=>$imagePath,
              'poster'=>$serial,
              'explanatory'=>$description
            ];
            //postの登録
            $post_id = gallery::insert('posts',$input);
            //ここからtagの登録
            $pattern='/[#|＃]([a-zA-Z0-9ぁ-んァ-ヴｦ-ﾟ一-龠_!@&%.\+*?^$(){}=!<>|:-\[\]]*)/u';
            if (preg_match_all($pattern, $tag, $tags, PREG_SET_ORDER)){
            }
            for( $i=0; $i<count($tags);$i++){
              $value = $tags[$i][1];
              if($value==''){
                continue;
              }
              $input=[
                'post'=>$post_id,
                'tag'=>$value,
              ];
              gallery::insert('tags',$input);
            }
          
            header('Location: main.php');
     
        }
    }
