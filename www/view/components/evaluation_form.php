<form id="evaluation" action="handle_evaluation.php" method="post">
    <div>
        <input type="submit" name="type" value="👍" <?php if($liked){echo 'class="active"';}?> />
        <input type="submit" name="type" value="👎" <?php if($disliked){echo 'class="active"';}?> />
        <input type="submit" name="type" value="🎀" <?php if($favorited){echo 'class="active"';}?> />
        <input type="hidden" name="upload_id" value="<?php echo $media->id_upload?>" />
    </div>
    <div id="likeBarContainer" title="<?php echo $media->getLikePercentage();?>% likes">
        <div id="likeBar" style="width:<?php echo $media->getLikePercentage();?>%"></div>
    </div>
</form>