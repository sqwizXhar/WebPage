<?php
    session_start();
    require_once 'validation/validator.php';

    if (isset($_SESSION['user'])) {
        header('Location: home.php');
        exit();
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
    <title>Sign In</title>
</head>
<body>
<div class="card">

    <div class="container login" id="container">

        <div class="form-container sign-in">

            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <h1>Sign in</h1>

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

                <label for="username" class="label-login">
                    <input type="text"
                           class="login-input"
                           id="username"
                           name="username"
                           placeholder="Username"
                    >
                </label>

                <label for="password" class="label-login">
                    <input type="password"
                           class="login-input"
                           id="password"
                           name="password"
                           placeholder="Password"
                           autocomplete="current-password"
                    >
                </label>

                <button type="submit" class="register-login-btn">Sign In</button>

                <p>
                    No account yet? - <a class="link-to-register" href="register.php">Register an account</a>
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
