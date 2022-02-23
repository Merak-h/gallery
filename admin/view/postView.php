<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>
    <h2>投稿</h2>
    <!--<a href="<?= $back ?>">戻る</a>-->
    <a href="<?= $_SERVER['HTTP_REFERER']; ?>">戻る</a>
    <p><?= $account ?>として投稿する</p>
    <div>
    <form action="post_action.php" method="POST" enctype="multipart/form-data">
    <div>
    <label>写真を選択</label>
    </div>
    <input type="file" name="image" accept="image/*" required>
    <div>
    <label>タイトル</label>
    </div>
    <input type="text" name="title">
    <div>
    <label>タグ</label>
    </div>
    <textarea name="tag" placeholder="例）#tag #cat #swimming_cat"></textarea>
    <div>
    <label>説明</label>
    </div>
    <textarea name="discription"></textarea>
    <div>
    <button>投稿する</button>
    </div>
    </form>
    </div>
</body>
</html>