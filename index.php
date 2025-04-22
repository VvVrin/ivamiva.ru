<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <h1>Добро пожаловать!</h1>
        
        <?php
        class Page {
            protected $name;
            protected $template;

            public function __construct() {
                $this->name = "page";
                $this->template = "<div><p>It is a default page</p></div>";
            }

            public function getName() {
                return $this->name;
            }

            public function getTemplate() {
                return $this->template;
            }

            public function render() {
                echo $this->template;
            }
        }

        class BlogPage extends Page {
            public function __construct() {
                $this->name = "blog";
                $this->template = $this->generateTemplate();
            }

            private function generateTemplate() {
                return '
<div class="buttons">
  <a href="newpage.php" class="button">Перейти</a>
</div>

<style>
  .button {
    display: inline-block;
    padding: 10px 20px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
  }
</style>
';
            }
        }

        $blogPage = new BlogPage();
        $blogPage->render();
        ?>
        
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
