<?php
declare(strict_types=1);

class Page {
    private string $name;
    private string $template;

    public function __construct() {
        $this->name = "page";
        $this->template = "<div class='page-content'><h1>Стандартная страница</h1><p>Это содержимое по умолчанию</p></div>";
    }

    public function render(): void {
        echo $this->template;
    }

    protected function setName(string $name): void {
        $this->name = $name;
    }

    protected function setTemplate(string $template): void {
        $this->template = $template;
    }

    public function getName(): string {
        return $this->name;
    }
}

class BlogPage extends Page {
    public function __construct() {
        parent::__construct();
        $this->setName("blog");
        $this->setTemplate($this->generateBlogTemplate());
    }

    private function generateBlogTemplate(): string {
        return <<<HTML
<div class="blog-content">
    <h1>Блог</h1>
    <div class="articles">
        <article class="article">
            <h2>Карточка адин</h2>
            <p>Погода сегодня не очен(</p>
        </article>
        <article class="article">
            <h2>Карточка дыва</h2>
            <p>Завтра ещё хуже</p>
        </article>
    </div>
</div>
<style>
    .blog-content, .page-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }
    .articles {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .article {
        flex: 1 1 300px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        background: #f9f9f9;
    }
</style>
HTML;
    }
}

// Навигация
function renderNavigation(): void {
    echo <<<HTML
<nav class="site-navigation">
    <a href="?page=page" class="nav-link">Стандартная страница</a>
    <a href="?page=blog" class="nav-link">Страница блога</a>
</nav>
<style>
    .site-navigation {
        background: #f5f5f5;
        padding: 15px;
        margin-bottom: 20px;
    }
    .nav-link {
        display: inline-block;
        padding: 8px 16px;
        margin-right: 10px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }
    .nav-link:hover {
        background: #0056b3;
    }
</style>
HTML;
}

// Основная логика
function getPageFromRequest(): Page {
    $pageType = $_GET['page'] ?? 'page';
    $pageType = htmlspecialchars($pageType);

    switch ($pageType) {
        case 'blog':
            return new BlogPage();
        case 'page':
        default:
            return new Page();
    }
}

// Рендеринг страницы
renderNavigation();
$currentPage = getPageFromRequest();
$currentPage->render();
?>
