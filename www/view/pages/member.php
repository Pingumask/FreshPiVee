<div id="uploader">    
    <form action="./handle_follow.php" method="post">
        <input type="hidden" name="id_followed" value="<?php echo $member->id_user;?>"/>
        <input type="submit" <?php if($followed) echo 'class="active"';?> value="🕵️‍♂️"/>
        <h2><?php echo $member->nickname;?></h2>
        <p><?=$member->getSignedUp()?></p>
    </form>
    
</div>

<h2>Uploads</h2>
<section id="uploads"><?php
    foreach($member->getUploads() as $media){
        if($media->media_type=="video"){
            include("./view/components/video_thumbnail.php");
        }
        elseif($media->media_type=="picture"){
            include("./view/components/picture_thumbnail.php");
        }
    }?>
</section>