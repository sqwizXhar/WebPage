<?php
    session_start();
    require_once 'db_connect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $_POST['username'];
        $password = md5($_POST['password']);

//        $_SESSION['validation'] = [];
//
//        if(empty($username)){
//            $_SESSION['validation']['username'] = "Invalid username";
//        }
//
//        if(empty($password)){
//            $_SESSION['validation']['password'] = "Invalid password";
//        }
//
//        if(!empty($_SESSION['validation'])){
//            header('location: login.php');
//            exit();
//        }

        $found_user = 'SELECT * FROM user_data WHERE username = :username AND password = :password';
        $stmt = $pdo->prepare($found_user);
        $stmt->execute([
            'username' => $username,
            'password' => $password
        ]);

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'profile_picture' => $user['profile_picture'],
            ];

            header('Location: ../home.php');
        }
        else{
            $_SESSION['message'] = 'Invalid username or password';
            header("location: ../login.php");
        }
}
