<form id="evaluation" action="handle_evaluation.php" method="post">
    <input type="submit" name="type" value="👍" <?php if($liked){echo 'class="active"';}?>>
    <input type="submit" name="type" value="👎" <?php if($disliked){echo 'class="active"';}?>>
    <input type="submit" name="type" value="🎀" <?php if($favorited){echo 'class="active"';}?>>
    <input type="hidden" name="upload_id" value="<?php echo $media->id_upload?>"/>
    <meter id="likeBar"
       min="0" max="100"
       high="0" optimum="100"
       value="<?php echo $media->getLikePercentage();?>">
       <?php echo $media->getLikePercentage();?>% likes
    </meter>
</form>