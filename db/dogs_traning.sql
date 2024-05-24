-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2024 г., 12:51
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dogs_traning`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Appointments`
--

CREATE TABLE `Appointments` (
  `appointment_id` int NOT NULL,
  `service_id` int DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `dog_breed` varchar(100) DEFAULT NULL,
  `dog_age` int DEFAULT NULL,
  `special_instructions` text,
  `dog_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `social_media_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ContactRequests`
--

CREATE TABLE `ContactRequests` (
  `request_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `social_media_link` varchar(255) DEFAULT NULL,
  `date_request` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `NewsEvents`
--

CREATE TABLE `NewsEvents` (
  `news_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `NewsEvents`
--

INSERT INTO `NewsEvents` (`news_id`, `date`, `title`, `content`) VALUES
(1, '2024-04-25', 'Открытие нового тренировочного центра', 'Мы рады сообщить, что открылся новый тренировочный центр для собак нашей компании. Теперь ваш питомец может получить лучшее обучение и заботу от наших профессионалов.'),
(2, '2024-04-20', 'Проведение выставки \"Лучший друг\"', 'Приглашаем всех любителей собак на выставку \"Лучший друг\", которая состоится 5-7 мая. На выставке будут представлены самые разные породы собак, конкурсы и многое другое.'),
(3, '2024-04-15', 'Новая программа обучения \"Альфа Курс\"', 'Мы представляем новую программу обучения для собак \"Альфа Курс\", направленную на развитие лидерских качеств и уверенности.'),
(4, '2024-04-10', 'Продление акции \"Подари другу\"', 'Рады сообщить, что мы продлеваем акцию \"Подари другу\". За каждого приведенного друга вы получаете скидку 20% на следующее занятие.'),
(5, '2024-04-05', 'Обновление графика работы', 'Внимание! С 10 апреля меняется график работы нашего центра. Подробности вы можете узнать на нашем сайте или по телефону.');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `photo_path`) VALUES
(1, 'img/reviews/review1.png'),
(2, 'img/reviews/review2.jpg'),
(3, 'img/reviews/review3.jpg'),
(4, 'img/reviews/review4.jpg'),
(5, 'img/reviews/review5.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `Services`
--

CREATE TABLE `Services` (
  `service_id` int NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Services`
--

INSERT INTO `Services` (`service_id`, `photo_path`, `title`, `description`) VALUES
(1, 'img/services/services1.png', 'Альфа Курс', 'Интенсивный тренинг для собак, направленный на развитие лидерских качеств и уверенности. Подходит для собак, которым требуется укрепление авторитета в стае.'),
(2, 'img/services/services2.png', 'Боевой Патруль', 'Курс по обучению служебных и защитных команд. Идеально подходит для собак, которые будут использоваться в охране или личной безопасности.'),
(3, 'img/services/services3.png', 'Звериный Драйв', 'Динамичные и интенсивные тренировки, укрепляющие физическую форму и инстинкты собаки, с элементами агрессивной игры и спортивного послушания.'),
(4, 'img/services/services4.png', 'Стальное Послушание', 'Строгий курс дрессировки для собак, которые испытывают трудности с подчинением. Включает упражнения на выработку дисциплины и повиновения.'),
(5, 'img/services/services5.png', 'Собачий Бунт', 'Нестандартный метод обучения для упрямых и независимых собак, направленный на налаживание связи между владельцем и питомцем через игру и соревнования.'),
(6, 'img/services/services6.png', 'Гром и Молния', 'Экстремальный курс для энергичных и активных собак, включающий элементы трюков, спорта и активного послушания.'),
(7, 'img/services/services7.png', 'Инстинкт Победы', 'Специализированная программа для соревновательных собак, фокусирующаяся на улучшении навыков и подготовке к выставкам и турнирам.'),
(8, 'img/services/services8.png', 'Территория Альфа', 'Комплексный курс для юных собак, направленный на раннее развитие лидерских качеств и социальной адаптации в стае.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Appointments`
--
ALTER TABLE `Appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Индексы таблицы `ContactRequests`
--
ALTER TABLE `ContactRequests`
  ADD PRIMARY KEY (`request_id`);

--
-- Индексы таблицы `NewsEvents`
--
ALTER TABLE `NewsEvents`
  ADD PRIMARY KEY (`news_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Services`
--
ALTER TABLE `Services`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Appointments`
--
ALTER TABLE `Appointments`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ContactRequests`
--
ALTER TABLE `ContactRequests`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `NewsEvents`
--
ALTER TABLE `NewsEvents`
  MODIFY `news_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Services`
--
ALTER TABLE `Services`
  MODIFY `service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Appointments`
--
ALTER TABLE `Appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `Services` (`service_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
