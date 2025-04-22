<?php
include '../includes/db.php';

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = pg_escape_string($_POST['title']);
    $content = pg_escape_string($_POST['content']);
   
    $result = pg_query_params(
        $db_conn,
        "INSERT INTO articles (title, content) VALUES ($1, $2)",
        [$title, $content]
    );
   
    if ($result) {
        header("Location: /articles.php");
        exit;
    } else {
        echo "Ошибка: " . pg_last_error($db_conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить статью</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        
        h1 {
            color: #444;
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            background: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #2980b9;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        textarea {
            min-height: 200px;
            resize: vertical;
        }
        
        input[type="submit"] {
            background: #2ecc71;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
        }
        
        input[type="submit"]:hover {
            background: #27ae60;
        }
        
        .error {
            color: #e74c3c;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="btn">На главную</a>
        <a href="/articles.php" class="btn">Статьи</a>
        
        <h1>Добавить новую статью</h1>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="content">Содержание:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            
            <input type="submit" value="Опубликовать">
        </form>
    </div>
</body>
</html>
