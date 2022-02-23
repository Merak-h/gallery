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
</ul>
</body>
</html>