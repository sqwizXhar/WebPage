    <?php
    function clear_data($val): string {
        $val = trim($val);
        $val = stripslashes($val);
        $val = strip_tags($val);
        return htmlspecialchars($val);
    }

    $username = isset($_POST['username']) ? clear_data($_POST['username']) : '';
    $email = isset($_POST['email']) ? clear_data($_POST['email']) : '';

    $pattern_username = '/^[A-Za-z0-9()]+$/';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($username)) {
            $_SESSION['message'] = "Invalid username";
            $flag = true;
        } elseif (!preg_match($pattern_username, $username)) {
            $_SESSION['message'] = "Username must contain only letters and numbers";
            $flag = true;
        }

        if (empty($email)) {
            $err['email'] = "Invalid email";
            $flag = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err['email'] = "Email format is incorrect";
        }

        if (empty($password)) {
            $_SESSION['message'] = "Invalid password";
            $flag = true;
        }

        if ($flag) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    ?>

