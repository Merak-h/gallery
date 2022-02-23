<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>

    <h2>ログイン</h2>
    <div>
        <form action="login_action.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            
            <p><?= $errorMassage ?></p>
            <label>@</label><input type="text" name="user_id" placeholder="ユーザーID" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <input type="submit" value="ログインする">
        </form>
    </div>
    <a href="signup.php">新規登録</a>
</body>
</html>