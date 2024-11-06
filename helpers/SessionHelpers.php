<?php
//    require_once __DIR__ . '/../models/FormHelper.php';
    require_once '../models/FormHelper.php';

    if (isset($_SESSION['user'])) {
        header('location: Home.php');
        exit();
    }

    $messageClass = '';
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $messageClass = strpos($message, 'successful') !== false ? 'msg-success' : 'msg-error';
        unset($_SESSION['message']);
    }

    $form_data = $_SESSION['form_data'] ?? [];
?>
