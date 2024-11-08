<?php
    session_start();
    require_once '../includes/DbConnect.php';
    require_once '../models/FormHelper.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = FormHelper::clearData($_POST['username']);
        $email = FormHelper::clearData($_POST['email']);
        $password = FormHelper::clearData($_POST['password']);
        $passwordConfirm = FormHelper::clearData($_POST['password_confirm']);

        FormHelper::setFormData([
            'username' => $username,
            'email' => $email
        ]);

        if (empty($username) || empty($email) || empty($password) || empty($passwordConfirm) || empty($_FILES['profile_picture']['name'])) {
            $_SESSION['message'] = 'Please fill in all fields, including the profile picture.';
            header('Location: ../Register.php');
            exit();
        }

        if (!FormHelper::checkPasswordMatch($password, $passwordConfirm)) {
            $_SESSION['message'] = 'Passwords do not match!';
            header('Location: ../Register.php');
            exit();
        }

        $checkUserQuery = 'SELECT * FROM user_data WHERE username = :username';
        $stmt = $pdo->prepare($checkUserQuery);
        $stmt->execute([':username' => $username]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'Username already taken';
            header('Location: ../Register.php');
            exit();
        }

        $path = 'uploads/' . time() . '_' . $_FILES['profile_picture']['name'];
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Error loading file';
            header('Location: ../Register.php');
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
        FormHelper::clearFormData();
        header('Location: ../Index.php');
        exit();
    }
?>
