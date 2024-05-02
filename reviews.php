<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <img src="img/up_image1.svg" alt="" height="80px">
    <div class="toolbar">
        <a href="index.html">Главная</a>
        <a href="">Новости</a>
        <a href="">Услуги</a>
        <a href="">Контакты</a>
        <a href="reviews.php">Отзывы</a>
    </div>
    <img src="img/up_image2.svg" alt="" height="80px">
</header>

<div class="content_reviews">
    <p class="content_title">Отзывы</p>
    <div class="statistick_reviews_block">
        <div class="statistick_block">
            <p class="quantity_statistick">1000+</p>
            <p class="text_statictick">обученных собак</p>
        </div>
        <div class="statistick_block">
            <p class="quantity_statistick">1000+</p>
            <p class="text_statictick">довольных клиентов</p>
        </div>
    </div>
    <div class="reviews_slider">
        <?php
      include 'config.php';

        // Запрос к базе данных для получения изображений отзывов
        $sql = "SELECT photo_path FROM reviews";
        $result = $conn->query($sql);

        // Вывод изображений в слайдере
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<img src="' . $row['photo_path'] . '" alt="Отзыв" class="slide" />';
            }
        } else {
            echo "0 результатов";
        }
        $conn->close();
        ?>
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const slides = document.querySelectorAll(".reviews_slider img");
        let currentSlide = 0;

        function showSlide(n) {
            slides.forEach(slide => slide.style.display = "none");
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].style.display = "block";
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        const prevButton = document.querySelector(".prev");
        prevButton.addEventListener("click", prevSlide);

        const nextButton = document.querySelector(".next");
        nextButton.addEventListener("click", nextSlide);

        showSlide(currentSlide);
    });
</script>

</body>
</html>