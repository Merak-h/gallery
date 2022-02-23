<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account</title>
</head>
<body>
    <h1><a href="main.php">Gallery</a></h1>
    <h2><?= $atAccount ?></h2>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>">戻る</a>
    <?= $info ?>
</body>
</html>