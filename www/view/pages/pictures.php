<h2>Pictures :</h2><?php
foreach($pictures as $pic){
    echo '
    <figure>
        <a href="./view.php?id='.$pic->id_upload.'">
            <img src="./uploads/pictures/'.$pic->path.'" alt="'.$pic->title.'"/>
        </a>
        <figcaption>'.$pic->title.'</figcaption>
    </figure>';
}