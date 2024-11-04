<?php
    session_start();
    require_once 'models/PageManager.php';
    require_once 'includes/db_connect.php';

    if (!isset($_SESSION['user'])) {
        header('Location: ../index.php');
        exit();
    }

    $pageManager = new PageManager($pdo);
    $user_id = $_SESSION['user']['id'];

    $pages = $pageManager->getAllPages($user_id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/main.css">
    <title>Home</title>
</head>
<body>
<div class="home-card">

    <div class="profile-container">

        <div class="profile-info">

            <h1>Welcome, <?= $_SESSION['user']['username'] ?>!</h1>

            <img src="<?= $_SESSION['user']['profile_picture'] ?>" alt="Profile Picture" width="100">

            <p>Email: <?= $_SESSION['user']['email'] ?></p>

            <h2>Your Pages:</h2>
            <?php foreach ($pages as $page): ?>
                <div class="page">
                    <a href="actions/view_page.php?id=<?= $page->getId() ?>" target="_blank">
                        <?= $page->getTitle() ?>
                    </a>

                    <a href="actions/edit_page.php?id=<?= $page->getId() ?>">Edit</a>

                    <form class="actions-pages" action="actions/delete_page.php" method="post" style="display:inline;">
                        <input type="hidden"
                               name="id"
                               value="<?= $page->getId() ?>"
                        >

                        <button class="delete-btn" type="submit"
                                onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>

            <h2>Add New Page:</h2>
            <form class="form-page" action="actions/create_page.php" method="post">

                <label for="type">
                    Select Page Type:
                </label>

                <select name="type" id="type" required>
                    <option value="static">Static Page</option>
                    <option value="blog">Blog Page</option>
                </select>

                <label for="title" class="label-title">Title:</label>

                <input type="text"
                       name="title"
                       id="title"
                       placeholder="Title"
                       required
                >

                <label for="content" class="label-content">Content:</label>

                <textarea name="content"
                          id="content"
                          placeholder="Content"
                          required
                ></textarea>

                <button class="create-page-btn" type="submit">Create Page</button>
            </form>

            <a href="includes/log_out.php" class="logout-btn">Log out</a>

            <script src="js/autoGrow.js"></script>
        </div>

    </div>

</div>

</body>
</html>
