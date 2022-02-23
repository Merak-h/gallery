<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change ID</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>
    <h1>IDを変更する</h1>
    <div>
    <p style="color: red;"><?= $message ?></p>
    <div id="help"></div>
    <form action="update_action.php" method="POST">
    <input type="hidden" id="csrfToken" name="csrf_token" value="<?= $csrf_token ?>">
    <input type="hidden" name="serial_id" value="<?= $serial_id ?>">
    <input type="hidden" name="varsion" value="<?= $varsion ?>">
    <input type="text" id="id" name="id" value="<?= $account ?>" required>
    <button id="button">変更</button>
    <a href="infomation.php">キャンセル</a>
    </form>
    </div>
</body>
</html>