<?php
    require_once 'validation_helpers.php';

    if (isset($_SESSION['user'])) {
        header('location: home.php');
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
