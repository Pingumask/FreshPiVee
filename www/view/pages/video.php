<h2><?php echo $media->title; ?></h2>

<video controls id="viewer">
    <source src="./uploads/videos/<?php echo $media->path ?>" type="video/mp4">
    <p>
        Votre navigateur ne prend pas en charge les vidéos HTML5.<br/>
        Voici <a href="./uploads/videos/<?php echo $media->path ?>">un lien pour télécharger la vidéo</a>.
    </p>
</video>

<div id="description"><?php echo $media->description;?></div><?php 
include("./view/components/evaluation_form.php");
include("./view/components/comment_section.php");
include("./view/components/recomandation_section.php");?>