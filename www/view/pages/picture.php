<h2><?php echo $media->title; ?></h2>
<img id="viewer" src="<?php echo "./uploads/pictures/".$media->path ?>" alt="<?php echo $media->title ?>"/>
<div id="description"><?php echo $media->description;?></div><?php 
include("./view/components/evaluation_form.php");
include("./view/components/comment_section.php");
include("./view/components/recomandation_section.php");?>