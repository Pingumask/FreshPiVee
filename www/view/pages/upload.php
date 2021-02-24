<h2>Upload</h2>
<?php
if (isset($_SESSION['error'])){
    echo '<div class="error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
?>
<form action="handle_upload.php" method="post" enctype="multipart/form-data">
    <label for="title">Title : </label>
    <input type="text" name="title" id="title" placeholder="Title"/>
    <label for="description">Description :</label>
    <textarea name="description" id="description" placeholder="Description"></textarea>
    <label for="upload">Your file :</label>
    <input type="file" name="upload" id="upload" placeholder="Your file"/>
    <input type="submit" value="📤"/>
</form>