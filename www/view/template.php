<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("view/components/head.php");?>
    </head>
    <body>
            <?php include("view/components/top_menu.php");?>
            <main>
                <?php include("view/pages/$currentPage.php");?>
            </main>
            <?php include("view/components/nav_menu.php");?>
    </body>
</html>