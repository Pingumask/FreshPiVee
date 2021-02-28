<form id="evaluation" action="handle_evaluation.php" method="post">
    <div>
        <input type="submit" name="type" value="👍" <?php if($liked){echo 'class="active"';}?> />
        <input type="submit" name="type" value="👎" <?php if($disliked){echo 'class="active"';}?> />
        <input type="submit" name="type" value="🎀" <?php if($favorited){echo 'class="active"';}?> />
        <input type="hidden" name="upload_id" value="<?=$media->id_upload?>" />
    </div>
    <div id="likeBarContainer" title="<?=$media->getLikePercentage();?>% likes">
        <div id="likeBar" style="width:<?=$media->getLikePercentage();?>%"></div>
    </div>
</form>