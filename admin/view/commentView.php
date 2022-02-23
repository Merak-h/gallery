<!DOCTYPE html>
<html lang="ja">
<body>
    <h2>コメント</h2>
    <div>
        <p><?= $account ?>としてコメントする</p>
        <form action="content_action.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="hidden" name="post" value="<?= $post ?>">
        <textarea name="comment" placeholder="コメントを書く。"></textarea>
        <button>投稿する</button>
        </form>
    </div>
    <div>
    <?php foreach($comments as $comment){ ?>
       <?php if(isset($comment['user_id'])){ ?>
        <a href="account.php?account=<?= $comment['user_id'] ?>">@<?= $comment['user_id'] ?></a>
       <?php }else{ ?>
       <p>匿名さん</p>
        <?php } ?>
       <p><?= $comment['date'] ?></p>
       <p><?= $comment['content'] ?></p>
       <?php } ?>
    </div>
</body>
</html>