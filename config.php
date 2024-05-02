<?
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dogs_traning";

        // Создание подключения
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверка подключения
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
?>