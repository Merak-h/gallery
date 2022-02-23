<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>
    <p>既に @<?= $_SESSION['user']['user_id'] ?>としてログイン済みです。</p>
</body>
</html>