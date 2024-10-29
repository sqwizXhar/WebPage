<?php
    session_start();

    if(isset($_SESSION['user'])) {
        header('location: home.php');
    }

    $messageClass = '';
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $messageClass = strpos($message, 'successful') !== false ? 'msg-success' : 'msg-error';
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
    <title>Sing In</title>
</head>
<body>
<div class="card">

    <div class="container" id="container">

        <div class="form-container sign-in">

            <form action="includes/sign_in.php" method="post">
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

                <label for="username">
                    <input type="text"
                           id="username"
                           name="username"
                           placeholder="Username"
                           required
                    >
                </label>

                <label for="password">
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="Password"
                           autocomplete="current-password"
                           required
                    >
                </label>

                <button type="submit">Sign In</button>

                <p>
                    no account yet? - <a class="link" href="register.php">register an account</a>
                </p>

                <?php if (isset($_SESSION['message'])): ?>
                    <p class="<?= $messageClass ?>"><?= $_SESSION['message'] ?></p>
                <?php endif; unset($_SESSION['message']); ?>

            </form>

        </div>

    </div>

</div>

</body>
</html>

