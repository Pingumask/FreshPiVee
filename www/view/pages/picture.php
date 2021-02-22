<h2><?php echo $media->title; ?></h2>
<img id="viewed_picture" src="<?php echo "./uploads/pictures/".$media->path ?>" alt="<?php echo $media->title ?>"/>
<div id="description"><?php echo $media->description;?></div>
<form id="evaluation">
    <input type="submit" value="👍">
    <input type="submit" value="👎">
    <input type="submit" value="🎀">
    <meter id="likeBar"
       min="0" max="100"
       low="33" high="66"
       value="<?php echo $media->getLikePercentage();?>">
       <?php echo $media->getLikePercentage();?>% likes
    </meter>
</form>
<section id="comments">
    <form action="handle_new_comment.php" method="post">
        <textarea name="comment_content" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="📩"/>
    </form>
    <?php
    foreach($media->getCommentList() as $comment){
        echo '<div class="comment">'.$comment->comment_content.'</div>';
    }
?>
</section>
<section id="recommandations"></section>