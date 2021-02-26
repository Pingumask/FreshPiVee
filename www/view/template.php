<?php require_once('./model/session.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("view/components/head.php");?>
    </head>
    <body <?php if(isset($_SESSION['dark'])){echo 'class="dark"';}?>>
            <?php include("view/components/top_menu.php");?>
            <main page="<?=$currentPage;?>">
                <?php include("view/pages/$currentPage.php");?>
            </main>
            <?php include("view/components/nav_menu.php");?>
    </body>
</html>