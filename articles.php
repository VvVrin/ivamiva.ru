<?php
include 'includes/db.php';

// Получение статей из базы данных
$result = pg_query($db_conn, "SELECT * FROM articles ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список статей</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .article {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
            background: #ffffff;
            transition: box-shadow 0.3s;
        }
        .article:hover {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            margin: 0 0 10px;
        }
        p {
            margin: 0 0 10px;
        }
        small {
            color: #999;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button-container a {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Список статей</h1>
    <div class="button-container">
        <a href="pages/add_articte.php">Добавить статью</a>
    </div>
    
    <?php
    // Отображение статей
    while ($row = pg_fetch_assoc($result)) {
        echo "<div class='article'>
                <h2>{$row['title']}</h2>
                <p>{$row['content']}</p>
                <small>Создано: {$row['created_at']}</small>
              </div>";
    }
    ?>
</div>

</body>
</html>
