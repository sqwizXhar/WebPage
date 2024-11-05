<?php
    require_once '../includes/db_connect.php';
    require_once '../helpers/validation_helpers.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = clear_data($_POST['username']);
        $password = md5(clear_data($_POST['password']));

        set_form_data([
            'username' => $username
        ]);

        $check_user_query = 'SELECT * FROM user_data WHERE username = :username';
        $stmt = $pdo->prepare($check_user_query);
        $stmt->execute([
            ':username' => $username]
        );

        if ($stmt->rowCount() > 0) {
            $check_password_query = 'SELECT * FROM user_data WHERE username = :username AND password = :password';
            $stmt = $pdo->prepare($check_password_query);
            $stmt->execute([
                'username' => $username,
                'password' => $password
            ]);

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'profile_picture' => $user['profile_picture'],
                ];
                clear_form_data();
                header('Location: ../home.php');
                exit();
            } else {
                $_SESSION['message'] = 'Invalid password';
                $_SESSION['form_data']['password'] = '';
                header('Location: ../index.php');
                exit();
            }
        } else {
            $_SESSION['message'] = 'User does not exist';
            clear_form_data();
            header('Location: ../index.php');
            exit();
        }
    }
?>
