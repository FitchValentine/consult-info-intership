<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $message = $_POST["message"] ?? "";

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $uploadDir = 'uploads/';

            // Проверяем существование папки и создаем ее при необходимости
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadFile = $uploadDir . basename($_FILES['file']['name']);

            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                    'file_path' => $uploadFile
                ];

                $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
                file_put_contents('feedback.txt', $jsonData . PHP_EOL, FILE_APPEND | LOCK_EX);

                echo 'Форма успешно отправлена!';
            } else {
                echo 'Ошибка при загрузке файла.';
            }
        } else {
            echo 'Неверный формат email.';
        }
    } else {
        echo 'Не все обязательные поля заполнены.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма обратной связи</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h1>Форма обратной связи</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Имя пользователя *</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail *</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Сообщение *</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Файл (*.jpg, *.png)</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
</body>

</html>
