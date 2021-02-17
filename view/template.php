<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <title>Fresh PiVee</title>
    </head>
    <body>
        <!--============================= MENU HAUT =========================================-->
            <header id="menu_haut" class="menu">
                <a href="" class="logo">
                    <img src="./ressources/image/LogoFresPiVee.svg" alt="logo Fresh PiVee">
                    <h1>
                        <span class="fresh">Fresh</span>
                        <br/>
                        <span class="pivee">PiVee</span>
                    </h1>
                </a>
                <input type="text" name="search" placeholder="search"/>
                <a href=""><img src="./ressources/image/icone_header/chercher.svg" alt="icone de recherches" id="search_button"></a>
                <a href=""><img src="./ressources/image/icone_header/upload.svg" alt="icone Uploade vidéo ou images"></a>
                <a href=""><img src="./ressources/image/icone_header/avatar.svg" alt="icones Conexions ou inscriptions"></a>
            </header>
        <!--========================= CONTENU  ==============================================-->
            <main>
            <?php include("view/$currentPage.php");?>
            </main>
        <!--========================= navigation ============================================-->
            <nav id="menu_bas" class="menu">
                <a href="" class="logo">
                    <img src="./ressources/image/LogoFresPiVee.svg" alt="logo Fresh PiVee">
                    <h1><span class="fresh">Fresh</span><br/><span class="pivee">PiVee</span></h1>
                </a>
                <a href="./pictures.php" <?php if($currentPage=="pictures"){echo 'class="active_menu"';}?>>
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
                <a href="./contacts.php" href="" <?php if($currentPage=="contacts"){echo 'class="active_menu"';}?>>
                    <img src="./ressources/image/icone_nav/icone_amis.svg" alt="Amis">
                    <span>Amis</span>
                </a>
                <a href="./settings.php" href="" <?php if($currentPage=="settings"){echo 'class="active_menu"';}?>>
                    <img src="./ressources/image/icone_nav/icone_settings.svg" alt="réglages">
                    <span>Préférences</span>
                </a>
            </nav>
    </body>
</html>