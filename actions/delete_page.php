<?php
    session_start();
    require_once '../includes/db_connect.php';
    require_once '../models/PageManager.php';

    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    }

    $pageManager = new PageManager($pdo);
    $user_id = $_SESSION['user']['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $page = $pageManager->getPageById($_POST['id']);
        if ($page && $page->getUserId() == $user_id) {
            $pageManager->removePage($_POST['id']);
        }
        header('Location: ../home.php');
        exit();
    } else {
        echo 'ID is required';
    }
?>
