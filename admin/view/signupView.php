<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>
    <h2>新規登録</h2>
    <p>試作品なのでセキュリティーに考慮されていないので、普段使用しているものや、容易に想像つくものの使用はやめて下さい。
    </p>
    <?= $error ?>
    
    <div>
        <form action="signup_action.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>"> 

            <div id="idHelp"></div>
            <input type="text" id="id" name="user_id" placeholder="ID" required>

            <div id="pass1Help"></div>
            <input type="password" id="pass1" name="pass1" placeholder="パスワードを設定" required>

            <div id="pass2Help"></div>
            <input type="password" id="pass2" name="pass2" placeholder="パスワードの確認" required> 
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>">キャンセル</a>
            <button id="button">登録</button>          
        </form>
    </div>
</body>
</html>