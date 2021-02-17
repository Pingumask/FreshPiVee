<nav id="nav_menu" class="menu">
    <a href="" class="logo">
        <img src="./ressources/image/LogoFresPiVee.svg" alt="logo Fresh PiVee">
        <h1><span class="fresh">Fresh</span><br/><span class="pivee">PiVee</span></h1>
    </a>
    <a href="" <?php if($currentPage=="pictures"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_picture.svg" alt="mes images">
        <span>Images</span>
    </a>
    <a href="./videos.php" <?php if($currentPage=="videos"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_video.svg" alt="Uploade de vidéo ou images">
        <span>Vidéos</span>
    </a>
    <a href="./" id="home_button" <?php if($currentPage=="trending"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_accueil.svg" alt="icone d'accueil">
        <span>Tendances</span>
    </a>
    <a href="" href="" <?php if($currentPage=="contacts"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_amis.svg" alt="Amis">
        <span>Amis</span>
    </a>
    <a href="" href="" <?php if($currentPage=="settings"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_settings.svg" alt="réglages">
        <span>Préférences</span>
    </a>
</nav>