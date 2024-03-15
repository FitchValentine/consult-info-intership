<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Table Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h1>CSV Table Viewer</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">Выберите CSV файл для загрузки:</label>
            <input type="file" class="form-control" id="file" name="file" accept=".csv" required>
        </div>
        <button type="submit" class="btn btn-primary">Загрузить</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];

    if ($file["error"] == UPLOAD_ERR_OK) {
        $fileName = $file["tmp_name"];
        $csv = array_map('str_getcsv', file($fileName));

        echo '<div class="container mt-3">';
        echo '<table class="table table-striped">';
        foreach ($csv as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo 'Ошибка при загрузке файла.';
    }
}
?>
</body>

</html>
