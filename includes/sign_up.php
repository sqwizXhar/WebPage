<?php
    session_start();
    require_once 'db_connect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        if ($password === $password_confirm) {

            $path = 'uploads/' . time() . $_FILES['profile_picture']['name'];
            if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../' . $path)) {
                $_SESSION['message'] = 'error loading file';
                header('location: ../register.php');
                exit();
            }

            $password = md5($password);

            $query = 'INSERT INTO user_data (username, email, profile_picture, password) VALUES (:username, :email, :profile_picture, :password)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                'profile_picture' => $path,
                ':password' => $password
            ]);

            $_SESSION['message'] = 'Registration was successful!';
            header('location: ../index.php');
            exit();

        } else {
            $_SESSION["message"] = 'Passwords do not match!';
            header('Location: ../register.php');
            exit();
        }
    }
?>


