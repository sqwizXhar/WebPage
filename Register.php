<?php
    require_once 'helpers/SessionHelper.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/main.css">
    <title>Sign Up</title>
</head>
<body>
<div class="card">

    <div class="container register" id="container">

        <div class="form-container sign-up">

            <form action="includes/SignUp.php" method="post" enctype="multipart/form-data">

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
                           value="<?php echo htmlspecialchars($form_data['username'] ?? '', ENT_QUOTES); ?>"
                    >
                </label>

                <label for="email" class="label-register">
                    <input type="email"
                           class="register-input"
                           id="email"
                           name="email"
                           placeholder="E-mail"
                           value="<?php echo htmlspecialchars($form_data['email'] ?? '', ENT_QUOTES); ?>"
                    >
                </label>

                <label for="profile_picture" class="label-register">
                    <span class="file-upload">Choose profile picture
                        <input type="file"
                               id="profile_picture"
                               name="profile_picture"
                               accept="image/jpeg,image/jpg,image/png,image/gif,image/bmp"
                        >
                    </span>
                </label>

                <div class="input-wrapper">
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

                        <span class="toggle-password">
                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                        </span>
                    </label>
                </div>


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
                    already have an account - <a class="link-to-register" href="Index.php">log in to your account</a>
                </p>

                <?php if (isset($message)): ?>
                    <p class="<?= $messageClass ?>"><?= $message ?></p>
                <?php endif; ?>
            </form>

        </div>

    </div>

</div>
    <script src="js/FileUpload.js"></script>

    <script src=js/TogglePassword.js></script>
</body>
</html>
