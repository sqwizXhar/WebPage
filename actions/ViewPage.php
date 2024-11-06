<?php
    require_once '../models/PageManager.php';
    require_once '../includes/DbConnect.php';

    $pageManager = new PageManager($pdo);

    if(!isset($_GET['id'])) {
        echo 'Page not found';
        exit();
    }

    $page = $pageManager->getPageById($_GET['id']);
    if(!$page) {
        echo 'Page not found';
        exit();
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page->getTitle() ?></title>
</head>
<body>
    <?= $page->render() ?>
</body>
</html>

