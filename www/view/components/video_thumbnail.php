<?php
echo '
    <a href="./view.php?id='.$media->id_upload.'">
        <figure>            
            <video id="viewer">
                <source src="./uploads/videos/'.$media->path.'">
                <p>
                    Votre navigateur ne prend pas en charge les vidéos HTML5.
                </p>
            </video>            
            <figcaption>'.$media->title.'</figcaption>
        </figure>
    </a>';
