<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1><a href="main.php">Gallery</a></h1>
<a href="<?= $_SERVER['HTTP_REFERER'] ?>">前のページへ戻る</a>
    <div>
        <img src="<?= $postInfo['image_path'] ?>" style="width: 200px;">
        <p><?= $postInfo['title'] ?></p>
        
        <a href="account.php?account=<?= $postInfo['user_id'] ?>">@<?= $postInfo['user_id'] ?></a>
        <p><?= $postInfo['explanatory'] ?></p>
        <?php foreach($tags as $tag){ ?>
           
            <a href="search.php?value=<?= $tag['tag'] ?>">#<?= $tag['tag'] ?></a>
       <?php } ?>
      
    </div>
     
    
</body>
</html>