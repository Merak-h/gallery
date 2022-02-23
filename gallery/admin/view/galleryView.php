<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="style/gallery.css">
<link rel="stylesheet" href="style/html5reset-1.6.1.css">
<body>
<div id="contents" class="contents">
   <?php foreach($posts as $post){ ?>
        <div class="content">
            <a class="post" href="content.php?post=<?=$post['post_id']?>">
            <img src="<?= $post['image_path'] ?>">
            </a>
            <a class="account" href="account.php?account=<?=$post['user_id']?>">
                    <p>@<?= $post['user_id'] ?></p>
            </a>
        </div>
    <?php } ?>
</div>
</body>
</html>