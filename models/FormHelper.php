<?php
    session_start();
    class FormHelper {
        public static function clearData($val): string {
            $val = trim($val);
            $val = stripslashes($val);
            $val = strip_tags($val);
            return htmlspecialchars($val);
        }

        public static function checkPasswordMatch($password, $password_confirm): bool {
            return $password === $password_confirm;
        }
    
        public static function setFormData($data) {
            $_SESSION['form_data'] = $data;
        }

        public static function getFormData() {
            return $_SESSION['form_data'] ?? [];
        }

        public static function clearFormData() {
            unset($_SESSION['form_data']);
        }
    }
?>
