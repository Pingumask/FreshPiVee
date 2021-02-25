<h2><?=$media->title?></h2>
<img id="viewer" src="<?="./uploads/pictures/".$media->path ?>" alt="<?=$media->title?>"/><?php
include("./view/components/follow_form.php");?>
<div id="description"><?=$media->description?></div><?php 
include("./view/components/evaluation_form.php");
include("./view/components/comment_section.php");
include("./view/components/recomandation_section.php");?>