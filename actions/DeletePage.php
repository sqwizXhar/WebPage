<?php
    session_start();
    require_once '../includes/DbConnect.php';
    require_once '../models/PageManager.php';

    if (!isset($_SESSION['user'])) {
        header('Location: ../Index.php');
        exit();
    }

    $pageManager = new PageManager($pdo);
    $userId = $_SESSION['user']['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $page = $pageManager->getPageById($_POST['id']);
        if ($page && $page->getUserId() == $userId) {
            $pageManager->removePage($_POST['id']);
        }
        header('Location: ../Home.php');
        exit();
    } else {
        echo 'ID is required';
    }
?>
