<?php
session_start();

// Подключение к базе данных
include 'config.php';

// Проверка авторизации
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

// Запрос к базе данных для заявок на звонок
$sql_callback = "SELECT request_id, name, phone_number, social_media_link, date_requests FROM ContactRequests";
$result_callback = $conn->query($sql_callback);

// Запрос к базе данных для записей на тренировки
$sql_appointments = "SELECT appointment_id, service_id, full_name, dog_breed, dog_age, special_instructions, dog_name, phone_number, social_media_link FROM Appointments";
$result_appointments = $conn->query($sql_appointments);

// Функция для получения данных из таблицы Services по service_id
function getServiceData($conn, $service_id) {
    $sql_service = "SELECT title, photo_path, description FROM Services WHERE service_id = $service_id";
    $result_service = $conn->query($sql_service);
    $service_data = $result_service->fetch_assoc();
    return $service_data;
}
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
    <a class="admin_exit" href="?logout">Выйти</a>
</div>

<div class="admin_content">


    <h2>Записи на тренировки</h2>
    <table class="admin_table">
        <tr>
            <th>Имя владельца</th>
            <th>Порода собаки</th>
            <th>Возраст собаки</th>
            <th>Выбранный курс</th>
            <th>Дополнительная информация</th>            
            <th>Номер телефона</th>
            <th>Ссылка на соц. сеть</th>
        </tr>
        <?php
        if ($result_appointments->num_rows > 0) {
            while ($row = $result_appointments->fetch_assoc()) {
                // Получение данных о услуге по service_id
                $service_data = getServiceData($conn, $row["service_id"]);
                echo "<tr>";
                echo "<td>" . $row["full_name"] . "</td>";
                echo "<td>" . $row["dog_breed"] . "</td>";
                echo "<td>" . $row["dog_age"] . "</td>";
                echo "<td>" . $service_data["title"] . "</td>";
                echo "<td>" . $row["special_instructions"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td><a href='" . $row["social_media_link"] . "' target='_blank'>" . "Ссылка" . "</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Нет доступных записей на тренировки</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
