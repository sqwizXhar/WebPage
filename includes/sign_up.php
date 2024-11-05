<?php
    require_once '../includes/db_connect.php';
    require_once '../helpers/validation_helpers.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = clear_data($_POST['username']);
        $email = clear_data($_POST['email']);
        $password = clear_data($_POST['password']);
        $password_confirm = clear_data($_POST['password_confirm']);

        set_form_data([
            'username' => $username,
            'email' => $email
        ]);

        if (check_password_match($password, $password_confirm)) {

            $check_user_query = 'SELECT * FROM user_data WHERE username = :username';
            $stmt = $pdo->prepare($check_user_query);
            $stmt->execute([':username' => $username]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = 'Username already taken';
                header('Location: ../register.php');
                exit();
            }

            $path = 'uploads/' . time() . $_FILES['profile_picture']['name'];
            if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../' . $path)) {
                $_SESSION['message'] = 'Error loading file';
                header('Location: ../register.php');
                exit();
            }

            $password = md5($password);

            $query = 'INSERT INTO user_data (username, email, profile_picture, password) VALUES (:username, :email, :profile_picture, :password)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':profile_picture' => $path,
                ':password' => $password
            ]);

            $_SESSION['username_for_login'] = $username;
            $_SESSION['message'] = 'Registration was successful!';
            clear_form_data();
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['message'] = 'Passwords do not match!';
            header('Location: ../register.php');
            exit();
        }
    }
?>
