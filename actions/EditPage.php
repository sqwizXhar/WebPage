<?php
    session_start();
    require_once '../includes/DbConnect.php';
    require_once '../models/PageManager.php';

    if (!isset($_SESSION['user'])) {
        header('Location: ../Index.php');
        exit();
    }

    $pageManager = new PageManager($pdo);
    $user_id = $_SESSION['user']['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $page = new Page($_POST['id'], $user_id, $_POST['title'], $_POST['content']);
        $pageManager->updatePage($page);
        header('Location: ../Home.php');
        exit();
    } else {
        if (isset($_GET['id'])) {
            $page = $pageManager->getPageById($_GET['id']);
            if (!$page || $page->getUserId() != $user_id) {
                echo "You cannot edit this page.";
                exit();
            }
        } else {
            echo "Page ID is required.";
            exit();
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
</head>
<body>
<h1>Edit Page</h1>
<form action="" method="post">
    <input type="hidden"
           name="id"
           value="<?= $page->getId() ?>"
    >

    <label>
        <input type="text"
               name="title"
               value="<?= $page->getTitle() ?>"
               required
        >
    </label>

    <label>
        <textarea name="content" required><?= $page->getContent() ?></textarea>
    </label>

    <button type="submit">Update Page</button>
</form>
</body>
</html>
