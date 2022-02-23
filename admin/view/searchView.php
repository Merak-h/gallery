<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
</head>
<body>

    <div>
    <form action="search.php" method="get">
    <input type="text" name="value" placeholder="#search" value="<?= $input ?>" required>
    <input type="submit" value="検索">
    </form>
    </div>
    <div></div>
</body>
</html>