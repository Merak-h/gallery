<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ギャラリーアプリ</title>
</head>
<body>
<h1>ギャラリーアプリ</h1>
<ul>
<?php
foreach(glob('*.php') as $filename){
?>
    <li><a href="<?= $filename ?>"><?= $filename ?> ↗︎</a></li>
<?php
}
?>
<?php
require_once('admin/function/sql_root.php');
try {
    $root = pdo_root();
    $root = pdo_host();
    $user = pdo_user();
    $pass = pdo_pass();
    $pdo = new PDO('mysql:host='.$root.';charset=utf8;', $user, $pass);
      //$stmt = $pdo->prepare('SELECT * FROM users');
      //$stmt->execute();
      /*
      if ( ($row = $stmt->fetch(PDO::FETCH_ASSOC)) ) {
          print_r($row);
        }else{
            echo '取得できませんでした。';
        }*/
      } catch (PDOException $e){
        echo '<br>';
        echo 'ーーーーーーーーーーーーーー｜SQL エラー｜ーーーーーーーーーーーーーー';
        echo '<br>';
        var_dump($e);
        echo '<br>';
      }

?>
</ul>
</body>
</html>