<div id="uploader">    
    <form action="./handle_follow.php" method="post">
        <input type="hidden" name="id_upload" value="<?= $media->id_upload;?>"/>
        <input type="hidden" name="id_followed" value="<?= $media->getUploader()->id_user;?>"/>
        <input type="submit" <?php if($followed) echo 'class="active"';?> value="🕵️‍♂️"/>
        <a href="./member.php?id=<?=$media->getUploader()->id_user ?>"><h4><?= $media->getUploader()->nickname;?></h4></a>
    </form>
</div>