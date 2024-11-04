<?php
    session_start();
    require_once 'validation/validator.php';

    if(isset($_SESSION['user'])) {
        header('location: home.php');
    }

    $messageClass = '';
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $messageClass = strpos($message, 'successful') !== false ? 'msg-success' : 'msg-error';
        unset($_SESSION['message']);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="assets/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Sing Up</title>
</head>
<body>
<div class="card">

    <div class="container register" id="container">

        <div class="form-container sign-up">

            <form action="includes/sign_up.php" method="post" enctype="multipart/form-data">

                <h1>Create Account</h1>

                <div class="icons">
                    <a href="#" class="icon">
                        <span class="fa-brands fa-vk"></span>
                    </a>

                    <a href="#" class="icon">
                        <span class="fa-brands fa-github"></span>
                    </a>

                    <a href="#" class="icon">
                        <span class="fa-brands fa-telegram"></span>
                    </a>

                    <a href="#" class="icon">
                        <span class="fa-brands fa-google"></span>
                    </a>
                </div>

                <label for="username" class="label-register">
                    <input type="text"
                           class="register-input"
                           id="username"
                           name="username"
                           placeholder="Username"
                    >
                </label>

                <label for="email" class="label-register">
                    <input type="email"
                           class="register-input"
                           id="email"
                           name="email"
                           placeholder="E-mail"
                    >
                </label>

                <label for="profile_picture" class="label-register">
                    <input type="file"
                           class="register-input"
                           id="profile_picture"
                           name="profile_picture"
                    >
                </label>

                <label for="password" class="label-register">
                    <input type="password"
                           class="register-input"
                           id="password"
                           name="password"
                           placeholder="Password"
                           autocomplete="new-password"
                           minlength="4"
                           maxlength="16"
                    >
                </label>

                <label for="password_confirm" class="label-register">
                    <input type="password"
                           class="register-input"
                           id="password_confirm"
                           name="password_confirm"
                           placeholder="Password confirmation"
                    >
                </label>
                <button type="submit" class="register-login-btn">Sign Up</button>

                <p>
                    already have an account - <a class="link-to-register" href="index.php">log in to your account</a>
                </p>

                <?php if (isset($message)): ?>
                    <p class="<?= $messageClass ?>"><?= $message ?></p>
                <?php endif; ?>
            </form>

        </div>

    </div>

</div>

</body>
</html>
