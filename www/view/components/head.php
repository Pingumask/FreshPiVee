<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 

<link rel="stylesheet" href="./style/reset.css">
<link rel="stylesheet" href="./style/style.css"><?php 
if (isset($currentPage) && file_exists("./style/$currentPage.css")){
    printf('<link rel="stylesheet" href="./style/%s.css">',$currentPage);
}?>
<script src="./js/darkMode.js" defer></script>
<title>Fresh PiVee : <?php echo $currentPage;?></title>