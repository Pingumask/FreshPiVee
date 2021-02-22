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