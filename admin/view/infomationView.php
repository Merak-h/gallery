<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>infomartion</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>
    <h2><?= $account ?></h2>
    <div>
        <ul>
            <li>
                <a href="update_id.php">アカウントID (<?= $account ?>)</a>
            </li>
            <li>
                <a href="update_password.php">パスワード変更</a>
            </li>
            <li>
                <a href="logout.php">ログアウト</a>
            </li>
            <li>
                <a href="delete_account.php">アカウント削除</a>
            </li>
        </ul>
    </div>
</body>
</html>