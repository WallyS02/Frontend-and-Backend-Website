<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <h1>Send a photo, title, author and watermark: </h1>
  <form action="/post" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title"><br>
    <input type="text" name="author" placeholder="Author"><br><br>
    <input type="file" name="image" id="image"><br>
    <input type="text" name="watermark" placeholder="Watermark"><br>
    <input type="submit" value="Send" name="submit">
  </form>
</body>
</html>
