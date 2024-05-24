<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Контакты</title>
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
<div class="contacts_content">
<p class="content_title">Контакты</p>
<div class="phone_contacts-container">
  <p>Телефон</p>
  <a href="tel:+79201548208">+7(920)-154-82-08</a>
</div>
<div class="adress_contacts-container">
  <p class="adress_contacts-title">Адрес</p>
  <p class="adress_contacts-text">Город Тверь проспект Чайковского, 23</p>
</div>
<div class="socseti_contacts-container">
  <p class="socseti_contacts-title">Соцсети</p>
  <div class="socseti_contacts-href">
    <a href=""><img src="img/vk.svg" alt=""></a>
    <a href=""><img src="img/tg.svg" alt=""></a>
  </div>
</div>
<form method="POST" class="callback_form">
  <p>
    Остались вопросы?
    <br>
    Мы с вами свяжемся!
  </p>
  <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $social_media_link = $_POST['social_media_link'];
        $date_request = date('Y-m-d');

        include 'config.php';

        // Подготовка и выполнение SQL-запроса
        $stmt = $conn->prepare("INSERT INTO ContactRequests
         (name, phone_number, social_media_link, date_requests)
          VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone_number,
         $social_media_link, $date_request);

        if ($stmt->execute()) {
          echo "Ваша заявка успешно отправлена!";
        } else {
          echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
      }
    ?>
  <input class="callback_input_text" type="text" name="name" placeholder="Имя" required>
  <input class="callback_input_text" type="text" name="phone_number" placeholder="Номер телефона" required>
  <input class="callback_input_text" type="text" name="social_media_link" placeholder="Ссылка на соц.сеть">
  <input class="callback_submit_btn" type="submit" value="Запросить звонок">
</form>
</div>
<iframe class="map_contacts" src="https://yandex.ru/map-widget/v1/?um=constructor%3Af469ad7330633598263920bdcff3110744a8b92ef493b4ee47cb5182b94077b7&amp;source=constructor" frameborder="0"></iframe>

</body>
</html>
