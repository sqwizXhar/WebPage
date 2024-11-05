<?php
    session_start();
    function clear_data($val) {
        $val = trim($val);
        $val = stripslashes($val);
        $val = strip_tags($val);
        return htmlspecialchars($val);
    }

    function check_password_match($password, $password_confirm) {
        return $password === $password_confirm;
    }

    function set_form_data($data) {
        $_SESSION['form_data'] = $data;
    }

    function get_form_data() {
        return $_SESSION['form_data'] ?? [];
    }

    function clear_form_data() {
        unset($_SESSION['form_data']);
    }
?>
