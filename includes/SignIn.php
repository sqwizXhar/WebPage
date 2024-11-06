<?php
    require_once '../includes/DbConnect.php';
    require_once '../models/FormHelper.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = FormHelper::clearData($_POST['username']);
        $password = md5(FormHelper::clearData($_POST['password']));

        FormHelper::setFormData([
            'username' => $username
        ]);

        $checkUserQuery = 'SELECT * FROM user_data WHERE username = :username';
        $stmt = $pdo->prepare($checkUserQuery);
        $stmt->execute([
            ':username' => $username]
        );

        if ($stmt->rowCount() > 0) {
            $checkPasswordQuery = 'SELECT * FROM user_data WHERE username = :username AND password = :password';
            $stmt = $pdo->prepare($checkPasswordQuery);
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
                FormHelper::clearFormData();
                header('Location: ../Home.php');
                exit();
            } else {
                $_SESSION['message'] = 'Invalid password';
                $_SESSION['form_data']['password'] = '';
                header('Location: ../Index.php');
                exit();
            }
        } else {
            $_SESSION['message'] = 'User does not exist';
            FormHelper::clearFormData();
            header('Location: ../Index.php');
            exit();
        }
    }
?>
