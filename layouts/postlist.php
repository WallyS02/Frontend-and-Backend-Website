<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <h1>Welcome to the gallery! Feel free to add new posts</h1>
  <ul>
    <?php foreach ($posts as $post): ?>
    <li>
      <h3><?= $post->title ?></h3>
      <a href="images/water_<?= $post->image_name ?>">
        <img src="images/min_<?= $post->image_name ?>" alt="" />
      </a>
      <h3><?= $post->author ?></h3>
    </li>
    <?php endforeach; ?>
  </ul>
  <form action="/postsPage" method="GET">
  <?php for ($i = 1; $i <= $nr+1; $i++):?>
    <input type="submit" value="<?= $i ?>" name="submit<?= $i ?>">
    <input type="hidden" value="<?= $i ?>" name="<?= $i ?>">
  <?php endfor ?>
    <input type="hidden" value="<?= $i ?>" name="id">
  </form>
</body>
</html>