<?php
    session_start();
    require_once '../models/PageManager.php';
    require_once '../models/StaticPage.php';
    require_once '../models/BlogPage.php';
    require_once '../includes/DbConnect.php';

    if (!isset($_SESSION['user'])) {
        header('Location: ../IIndex.php');
        exit();
    }

    $pageManager = new PageManager($pdo);
    $userId = $_SESSION['user']['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_POST['type'] ?? null;
        $title = $_POST['title'] ?? null;
        $content = $_POST['content'] ?? null;

        if ($type && $title && $content) {
            if ($type == 'static') {
                $page = new StaticPage(null, $userId, $title, $content);
            } else if ($type == 'blog') {
                $publishDate = date('Y-m-d');
                $page = new BlogPage(null, $userId, $title, $content, $publishDate);
            }
            if ($page) {
                $pageManager->addPage($page);
                header('Location: ../Home.php');
                exit();
            }
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
</head>
<body>
<h1>Create New Page</h1>
<form action="" method="post">
    <label for="type">Select Page Type:
        <select name="type" id="type" required>
            <option value="static">Static Page</option>
            <option value="blog">Blog Page</option>
        </select>
    </label>

    <label>
        <input type="text"
               name="title"
               placeholder="Title"
               required
        >
    </label>

    <label>
        <textarea name="content"
                  placeholder="Content"
                  required
        >
        </textarea>
    </label>

    <button type="submit">Create Page</button>
</form>
</body>
</html>
