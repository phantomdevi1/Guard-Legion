<?php
include 'config.php';

// Получаем категории услуг
$services = [];
$sql = "SELECT service_id, title FROM Services";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

// Получаем выбранный service_id из URL, если он есть
$selectedServiceId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Обрабатываем отправку формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST['service_id'];
    $full_name = $_POST['full_name'];
    $dog_breed = $_POST['dog_breed'];
    $dog_age = $_POST['dog_age'];
    $special_instructions = $_POST['special_instructions'];
    $dog_name = $_POST['dog_name'];
    $phone_number = $_POST['phone_number'];
    $social_media_link = $_POST['social_media_link'];

    $errors = [];

    if (!preg_match("/^[a-zA-ZА-Яа-я\s]+$/u", $full_name)) {
        $errors[] = "ФИО должно содержать только буквы и пробелы.";
    }
    if (!preg_match("/^[a-zA-ZА-Яа-я\s]+$/u", $dog_breed)) {
        $errors[] = "Порода собаки должна содержать только буквы и пробелы.";
    }
    if (!preg_match("/^[a-zA-ZА-Яа-я\s]+$/u", $dog_name)) {
        $errors[] = "Имя собаки должно содержать только буквы и пробелы.";
    }
    if (!preg_match("/^[0-9]+$/", $phone_number)) {
        $errors[] = "Номер телефона должен содержать только цифры.";
    }

    if (empty($errors)) {
      $sql = "INSERT INTO Appointments (service_id, full_name, dog_breed, dog_age, special_instructions, dog_name, phone_number, social_media_link) VALUES ('$service_id', '$full_name', '$dog_breed', '$dog_age', '$special_instructions', '$dog_name', '$phone_number', '$social_media_link')";

      if ($conn->query($sql) === TRUE) {
          echo "<script>alert('Запись успешно добавлена');</script>";
      } else {
          echo "<script>alert('Ошибка: " . $sql . "<br>" . $conn->error . "');</script>";
      }
  } else {
      foreach ($errors as $error) {
          echo "<script>alert('$error');</script>";
      }
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись</title>
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
<div class="content_services">
  <p class="content_title">Запись на занятие</p>
  <form class="choose_service_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="service_id">Выберите услугу:</label>
    <select name="service_id" id="service_id" required>
      <?php foreach ($services as $service): ?>
        <option value="<?php echo $service['service_id']; ?>" <?php if ($selectedServiceId == $service['service_id']) echo 'selected'; ?>>
          <?php echo $service['title']; ?>
        </option>
      <?php endforeach; ?>
    </select>
    
    <input type="text" name="full_name" placeholder="ФИО" required>
    <input type="text" name="dog_breed" placeholder="Порода собаки" required>
    <input type="number" name="dog_age" placeholder="Возраст собаки" required>
    <input type="text" name="dog_name" placeholder="Имя собаки" required>
    <input type="text" name="phone_number" placeholder="Номер телефона" required>
    <input type="text" name="social_media_link" placeholder="Ссылка на соц. сети" required>
    <textarea name="special_instructions" placeholder="Особые инструкции"></textarea>
    
    <input class="choose_service-btn" type="submit" value="Записаться">
  </form>
</div>
</body>
</html>
