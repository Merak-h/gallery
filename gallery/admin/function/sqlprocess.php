<?php
require_once('admin/function/sql_root.php');

            //エラー確認用
            //ini_set( 'display_errors', 1 );
            //ini_set( 'error_reporting', E_ALL );

class gallery{
    //galleryのpost一覧の取得
    static function select($sqls,$culmn=null,$array=null,$like=false,$order=false,$count=null){
    //static function select($sqls,$culmn,$array,$like,$order,$count){
        //降順に表示する場合
        $or='';
        if($order!=null){
            $or = ' ORDER BY date DESC';
        }
        //個数制限をつける場合の処理
        $limit='';
        if($count!=null){
            $limit = ' LIMIT '.$count;
        }
        //SQL
        $posts=[];
        try{
            $root = pdo_root();
            $root = pdo_host();
            $user = pdo_user();
            $pass = pdo_pass();
            $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
            //where以下の文を生成
            $sqla='';
            if($array!=null){
                for($i=0;$i<count($array);$i++){
                    if($i==0){
                        if($like==false){
                            $sqla= ' WHERE '.$culmn.' = :VALUE'.$i;
                        }else{
                            $sqla= ' WHERE '.$culmn.' like :VALUE'.$i;
                        }
                        
                    }else{
                        if($like==false){
                            $sqla=$sqla.' OR '.$culmn.' = :VALUE'.$i;
                        }else{
                            $sqla=$sqla.' OR '.$culmn.' like :VALUE'.$i;
                        }
                    }
                }
            }
            $stmt = $pdo->prepare($sqls.$sqla.$or.$limit);
            if($array!=null){
                foreach($array as $i=>$value){
                    if($like==false){
                        $stmt->bindvalue(':VALUE'.$i,$value);
                    }else{
                        $value = '%'.$value.'%';
                        $stmt->bindvalue(':VALUE'.$i,$value);
                    }
                }
            }
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($posts, $row);
            }
            return $posts;
        }catch (PDOException $e){
        var_dump($e);
        }
    }
    static function insert($in,$array){
        
        try{
            $key= array_keys($array);
            $contents = '';
            $values='';
            foreach($key as $i=>$value){
                if($i==0){
                    $contents=$contents.$value;
                    $values=$values.':'.$value;
                }else{
                    $contents=$contents.','.$value;
                    $values=$values.', '.':'.$value;
                }
            }
            $root = pdo_root();
            $root = pdo_host();
            $user = pdo_user();
            $pass = pdo_pass();
            $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
            $stmt = $pdo->prepare('INSERT INTO '.$in.'('.$contents.') VALUES('.$values.')');
            foreach($array as $content=>$value){
                $stmt->bindvalue(':'.$content,$value);
            }
            $stmt->execute();
            $post_id = $pdo->lastInsertId();
        } catch (PDOException $e){
            var_dump($e);
            echo '失敗';
        }
        return $post_id;
    }




}

?>