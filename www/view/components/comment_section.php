<section id="comments">
    <form action="handle_new_comment.php" method="post">
        <input type="hidden" name="id_upload" value="<?php echo $media->id_upload?>" />
        <textarea name="comment_content" id="comment_content" cols="30" rows="10"></textarea>
        <input type="submit" value="📩"/>
    </form>
    <?php
    foreach($media->getCommentList() as $comment){
        include("./view/components/comment.php");
    }?>
</section>