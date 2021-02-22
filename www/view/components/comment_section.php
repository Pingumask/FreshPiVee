<section id="comments">
    <form action="handle_new_comment.php" method="post">
        <textarea name="comment_content" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="📩"/>
    </form>
    <?php
    foreach($media->getCommentList() as $comment){
        echo '<div class="comment">'.$comment->comment_content.'</div>';
    }?>
</section>