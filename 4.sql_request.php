<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL запрос
$sql = "SELECT u.firstName, u.lastName, c.city
        FROM user u
        JOIN city c ON u.city = c.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Выводим данные каждого пользователя
    while($row = $result->fetch_assoc()) {
        echo "Имя: " . $row["firstName"]. " " . $row["lastName"]. " - Город: " . $row["city"]. "<br>";
    }
} else {
    echo "0 результатов";
}

$conn->close();

?>