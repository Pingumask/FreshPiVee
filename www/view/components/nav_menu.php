<nav id="menu_bas" class="menu">
    <a href="./" class="logo">
        <img src="./ressources/image/LogoFresPiVee.svg" alt="logo Fresh PiVee">
        <h1><span class="fresh">Fresh</span><br/><span class="pivee">PiVee</span></h1>
    </a>
    <a href="./pictures.php" <?php if($currentPage=="pictures"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_picture.svg" alt="mes images">
        <span>Pictures</span>
    </a>
    <a href="./videos.php" <?php if($currentPage=="videos"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_video.svg" alt="Uploade de vidéo ou images">
        <span>Videos</span>
    </a>
    <a href="./" id="home_button" <?php if($currentPage=="trending"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_accueil.svg" alt="icone d'accueil">
        <span>Trending</span>
    </a>
    <a href="./contacts.php" href="" <?php if($currentPage=="contacts"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_amis.svg" alt="Amis">
        <span>Contacts</span>
    </a>
    <a href="./settings.php" href="" <?php if($currentPage=="settings"){echo 'class="active_menu"';}?>>
        <img src="./ressources/image/icone_nav/icone_settings.svg" alt="réglages">
        <span>Settings</span>
    </a>
</nav>