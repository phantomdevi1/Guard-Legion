<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Новости</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <img src="img/up_image1.svg" alt="" height="80px">
    <div class="toolbar">
        <a href="index.php">Главная</a>
        <a href="news.php">Новости</a>
        <a href="services.php">Услуги</a>
        <a href="contacts.php">Контакты</a>
        <a href="reviews.php">Отзывы</a>
      </div>
    <img src="img/up_image2.svg" alt="" height="80px">
</header>
<div class="news_content">
<p class="content_title">Новости и мероприятия</p>
<div class="news_block-container">
  <?php
  include 'config.php'; 

  $sql = "SELECT news_id, date, title, content FROM NewsEvents ORDER BY date DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Вывод данных каждой новости или мероприятия
      while($row = $result->fetch_assoc()) {
          echo '<div class="news_block">';
          echo '<p class="news_date">' . $row["date"] . '</p>';
          echo '<p class="news_title">' . $row["title"] . '</p>';
          echo '<hr class="news_hr">';
          echo '<p class="news_text">' . $row["content"] . '</p>';
          echo '</div>';
      }
  } else {
      echo "Новостей и мероприятий пока нет";
  }
  $conn->close();
  ?>
</div>
</div>
</body>
</html>