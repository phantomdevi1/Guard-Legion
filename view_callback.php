<?php
session_start();

// Подключение к базе данных
include 'config.php';

// Проверка авторизации
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Запрос к базе данных
$sql = "SELECT request_id, name, phone_number, social_media_link, date_requests FROM ContactRequests";
$result = $conn->query($sql);
?>

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
    <h2>Заявки на звонок</h2>
    <table class="admin_table">
        <tr>
            <th>Имя</th>
            <th>Номер телефона</th>
            <th>Ссылка на соц. сеть</th>
            <th>Дата</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td><a href='" . $row["social_media_link"] . "' target='_blank'>" . "Ссылка" . "</a></td>";
                echo "<td>" . $row["date_requests"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Нет доступных заявок</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
