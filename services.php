<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Услуги</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <img src="img/up_image1.svg" alt="" height="80px">
    <div class="toolbar">
        <a href="index.html">Главная</a>
        <a href="news.php">Новости</a>
        <a href="services.php">Услуги</a>
        <a href="contacts.php">Контакты</a>
        <a href="reviews.php">Отзывы</a>
    </div>
    <img src="img/up_image2.svg" alt="" height="80px">
</header>
<div class="content_services">
  <p class="content_title">Услуги</p>
  <div class="services_blocks-container">
  <?php
  include 'config.php'; // Подключаем файл с настройками для базы данных
  
  $sql = "SELECT service_id, photo_path, title, description FROM Services";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Вывод данных каждой услуги
      while($row = $result->fetch_assoc()) {
          echo '<div class="service_block">';
          echo '<p class="title_service_block">' . $row["title"] . '</p>';
          echo '<img src="' . $row["photo_path"] . '" alt="" class="service_image">';
          echo '<div class="service_info">';
          echo '<p class="title_service_block">' . $row["title"] . '</p>';
          echo '<hr class="service-block-hr">';
          echo '<p class="description_service_block">' . $row["description"] . '</p>';
          echo '<button class="take_service-btn" id="' . $row["service_id"] . '" onclick="window.location.href = \'choose_service.php?id=' . $row["service_id"] . '\';">Выбрать</button>';
          echo '</div>';
          echo '</div>';
      }
  } else {
      echo "Упс... Услуг пока не предоставляется";
  }
  $conn->close();
  ?>
  </div>
</div>
</body>
</html>