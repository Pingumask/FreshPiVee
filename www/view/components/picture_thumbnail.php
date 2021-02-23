<?php
echo '
    <a href="./view.php?id='.$media->id_upload.'">
        <figure>            
            <img src="./uploads/pictures/'.$media->path.'" alt="'.$media->title.'"/>            
            <figcaption>'.$media->title.'</figcaption>
        </figure>
    </a>';