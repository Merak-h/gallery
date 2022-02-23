<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>
<form action="updatePass_action.php" method="POST">
    <div><?= $help ?></div>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="hidden" name="serial_id" value="<?= $serial_id ?>">
        <input type="hidden" name="varsion" value="<?= $varsion ?>">
            <div id="pass1Help"></div>
            <input type="password" id="pass1" name="pass1" placeholder="新しいパスワードを入力" required>
            <div id="pass2Help"></div>
            <input type="password" id="pass2" name="pass2" placeholder="パスワードの確認" required>
            <a href="infomation.php">キャンセル</a>
            <button id="button">変更</button>
        </form>
</body>
</html>