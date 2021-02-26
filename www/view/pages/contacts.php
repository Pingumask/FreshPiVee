<h2>Contacts</h2><?php
foreach($medias as $media){
    if($media->media_type=="video"){
        include("./view/components/video_thumbnail.php");
    }
    elseif($media->media_type=="picture"){
        include("./view/components/picture_thumbnail.php");
    }
}?>