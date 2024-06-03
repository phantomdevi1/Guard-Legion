<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Защита от SQL-инъекций
    $login = $conn->real_escape_string($login);
    $password = $conn->real_escape_string($password);

    // Поиск пользователя в базе данных
    $sql = "SELECT id FROM users WHERE login='$login' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['login'] = $login;
        echo "<script>window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Ошибка авторизации: неверный логин или пароль');</script>";
        echo "<script>document.getElementById('authModal').style.display='block';</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Главная</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
</head>
<body>
    <div class="index_up_panel">
        <img src="img/up_image1.svg" alt="" class="up_image_first" />
        <p onclick="document.getElementById('authModal').style.display='block'">Сторожевой Легион</p>
        <img src="img/up_image2.svg" alt="" class="up_image_second" />
    </div>
    <header>
        <div class="toolbar">
            <a href="index.html">Главная</a>
            <a href="news.php">Новости</a>
            <a href="services.php">Услуги</a>
            <a href="contacts.php">Контакты</a>
            <a href="reviews.php">Отзывы</a>
        </div>
    </header>
    <!-- Модальное окно для авторизации -->
    <div id="authModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('authModal').style.display='none'">&times;</span>
            <form id="loginForm" method="POST" action="">
                <label for="login">Логин:</label>
                <input type="text" id="login" name="login" required>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Войти</button>
            </form>
        </div>
    </div>
    <div class="hello_block">
        <p class="hello_block_title">
            Воспитанная собака – лучший друг человека. Мы поможем добиться результата.
        </p>
        <p class="hello_block_text">
            -Научим понимать собаку без слов <br />
            -Уже после одного занятия собака научится слышать Вас<br />
            -Гарантируем качество - работаем по официальному договору<br />
            -Эксклюзивные услуги по специальной дрессировке собак
        </p>
        <img src="img/index_first.svg" alt="" />
    </div>
    <div class="about_me_block">
        <p class="about_me_title">О нас</p>
        <p class="about_me_text">
            Наш центр – это команда профессионалов, готовых помочь Вам и Вашему питомцу даже в самых сложных случаях. Мы нацелены на получение положительного результата. В нашем центре работают настоящие профессионалы своего дела, они отзывчивы и по-настоящему любят наших четвероногих друзей. <br />
            Мы занимаемся дрессировкой собак любых пород и возраста. У нас собраны разные методики и подходы в коррекции поведения и научении собак требуемым навыкам. На сегодняшний день кинологический центр «Сторожевой Легион» имеет высокопрофессиональных специалистов в России, готовых подготовить Вашу собаку по уникальным методикам поисковой работы и предоставить эксклюзивные услуги по разным направлениям.
        </p>
    </div>
    <div class="index_team_block">
        <p class="index_team_title">Команда</p>
        <div class="index_team_admin">
            <p class="index_admin_text">Администрация</p>
            <div class="team_carts">
                <div class="team_cart_block">
                    <img src="img/admin1.svg" alt="" />
                    <p>Кристина Дубовик</p>
                </div>
                <div class="team_cart_block">
                    <img src="img/admin2.svg" alt="" />
                    <p>Александра Мыщина</p>
                </div>
                <div class="team_cart_block">
                    <img src="img/admin3.svg" alt="" />
                    <p>Валерий Киселёв</p>
                </div>
            </div>
        </div>
        <div class="index_team_handlers">
            <p class="index_handlers_text">Кинологи</p>
            <div class="team_carts">
                <div class="team_cart_block">
                    <img src="img/handlers1.svg" alt="" />
                    <p class="team_cart_name">Анастасия Мельникова</p>
                </div>
                <div class="team_cart_block">
                    <img src="img/handlers2.svg" alt="" />
                    <p class="team_cart_name">Сергей Данилов</p>
                </div>
                <div class="team_cart_block">
                    <img src="img/handlers3.svg" alt="" />
                    <p class="team_cart_name">Артём Каримов</p>
                </div>
                <div class="team_cart_block">
                    <img src="img/handlers4.svg" alt="" />
                    <p class="team_cart_name">Александр Громов</p>
                </div>
                <div class="team_cart_block">
                    <img src="img/handlers5.svg" alt="" />
                    <p class="team_cart_name">Андрей Прохоров</p>
                </div>
                <div class="team_cart_block">
                    <img src="img/handlers6.svg" alt="" />
                    <p class="team_cart_name">Владислав Боровцкий</p>
                </div>
            </div>
        </div>
    </div>
    <div class="motivation_index_block">
        <p>
            Сделай своего пса настоящим MVP. <br />
            Каждая тренировка - шаг к совершенству
        </p>
        <button onclick="document.location='services.php'">Начать занятия</button>
    </div>
    <script>
        // Закрытие модального окна при клике вне его
        window.onclick = function(event) {
            var modal = document.getElementById('authModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>

