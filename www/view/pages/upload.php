<h2>Upload</h2>
<form action="handle_upload.php" method="post" enctype="multipart/form-data">
    <label for="title">Title : </label>
    <input type="text" name="title" id="title" placeholder="Title"/>
    <label for="description">Description :</label>
    <textarea name="description" id="description" placeholder="Description"></textarea>
    <label for="upload">Your file :</label>
    <input type="file" name="upload" id="upload" placeholder="Your file"/>
    <input type="submit" value="📤"/>
</form>