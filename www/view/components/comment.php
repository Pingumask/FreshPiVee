<div class="comment">
    <h4><?= $comment->getuser()->nickname;?></h4>
    <em><?= $comment->getCommentTime();?></em>
    <?= $comment->comment_content;?>
</div>
