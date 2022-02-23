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
<p>試作品なのでセキュリティーに考慮されていないので、普段使用しているものや、容易に想像つくものの使用はやめて下さい。
    </p>
    <div id="form">
        <form action="updatePassConf_action.php" method="POST">
            <div><?= $help ?></div>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="password" name="password" placeholder="現在のパスワード" required>
            <a href="infomation.php">キャンセル</a>
            <button>変更</button>
        </form>
    </div>

    
</body>
</html>