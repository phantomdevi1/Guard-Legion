<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администратор</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
</head>
<body>

<header>
    <img src="img/up_image1.svg" alt="" height="80px">    
    <p>Администратор</p>      
    <img src="img/up_image2.svg" alt="" height="80px">
</header>

<div class="admin_toolbar">
    <a class="admin_toolbar-btn" href="new_service.php">Добавить услугу</a>
    <a class="admin_toolbar-btn" href="new_reviews.php">Добавить отзыв</a>
    <a class="admin_toolbar-btn" href="new_news.php">Добавить новость</a>
    <a class="admin_toolbar-btn" href="view_services.php">Посмотреть запись на тренировки</a>
    <a class="admin_toolbar-btn" href="view_callback.php">Посмотреть заявки на звонок</a>
    <a class="admin_exit" href="index.php">Выйти</a>
</div>

<div class="admin_content">
    <h2>Добавление услуги</h2>
    <?php
session_start();

// Подключение к базе данных
include 'config.php';

// Проверка авторизации
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка наличия всех обязательных полей
    if (isset($_POST['title'], $_POST['description']) && isset($_FILES['photo'])) {
        // Получение данных из формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        // Получение информации о загруженном файле
        $file_name = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_path = "img/services/" . $file_name;

        // Перемещение загруженного файла в папку на сервере
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Подготовка SQL-запроса для добавления новой записи в таблицу Services
            $sql_insert = "INSERT INTO Services (photo_path, title, description) VALUES ('$file_path', '$title', '$description')";

            // Попытка выполнения SQL-запроса
            if ($conn->query($sql_insert) === TRUE) {
                echo "<p>Новая услуга успешно добавлена.</p>";
            } else {
                echo "Ошибка: " . $sql_insert . "" . $conn->error;
            }
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        echo "<p>Все поля должны быть заполнены.</p>";
    }
}
?>
    <form class="new_services_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="photo">Фото:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>
        <label for="title">Название услуги:</label>
        <input type="text" id="title" name="title" required>
        <label for="description">Описание:</label>
        <textarea id="description" name="description" required></textarea>
        <input class="submit_new_services" type="submit" value="Добавить">
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
