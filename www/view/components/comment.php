<div class="comment">
    <h4><?php echo $comment->getuser()->nickname;?></h4>
    <em><?php echo $comment->getCommentTime();?></em>
    <?php echo $comment->comment_content;?>
</div>
