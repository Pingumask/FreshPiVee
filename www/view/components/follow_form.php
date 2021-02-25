<div id="uploader">
    <h4><?php echo $media->getUploader()->nickname;?><h4> 
    <form action="./handle_follow.php" method="post">
        <input type="hidden" name="id_upload" value="<?php echo $media->id_upload;?>"/>
        <input type="hidden" name="id_followed" value="<?php echo $media->getUploader()->id_user;?>"/>
        <input type="submit" <?php if($followed) echo 'class="active"';?> value="🕵️‍♂️"/>
    </form>
</div>