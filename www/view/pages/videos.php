<h2>Videos :</h2><?php
foreach($videos as $vid){
    echo '
    <figure>
        <a href="./view.php?id='.$vid->id_upload.'">
            <video id="viewer">
                <source src="./uploads/videos/'.$vid->path.'">
                <p>
                    Votre navigateur ne prend pas en charge les vidéos HTML5.
                </p>
            </video>
        </a>
        <figcaption>'.$vid->title.'</figcaption>
    </figure>';
}