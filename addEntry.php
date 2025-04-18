<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $title = '';
    $content = '';
} else {
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title'], ENT_QUOTES) : '';
    $content = isset($_POST['content']) ? htmlspecialchars($_POST['content'], ENT_QUOTES) : '';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Post</title>
        <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/mediaqueries.css">
        <link rel="stylesheet" href="./css/form.css">
        <script src="./js/script.js" defer></script>
        <script src="./js/addEntry.js" defer></script>
    </head>
    <body>
        <header>
            <nav id="desktop-nav">
                <div class="logo">Vlad Virlan</div>
                <div>
                    <ul class="nav-links">
                        <li><a href="./blog.php">Home</a></li>
                        <?php if (!isset($_SESSION['email'])): ?>
                            <li><a href="./login.html">Login</a></li>
                        <?php else: ?>
                            <li><a href="./logout.php">Logout</a></li>
                        <?php endif; ?>
                        <li><a href="./addEntry.php">Add Post</a></li>
                        <li><a href="./viewBlog.php">View Posts</a></li>
                        <li><a href="./index.html">Portfolio</a></li>
                    </ul>
                </div>
            </nav>
            <nav id="hamburger-nav">
                <div class="logo">Vlad Virlan</div>
                <div class="hamburger-menu">
                    <div class="hamburger-icon" id="mobile-nav-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="menu-links">
                        <li><a href="./blog.php" id="mobile-home-link">Home</a></li>
                        <?php if (!isset($_SESSION['email'])): ?>
                            <li><a href="./login.html" id="mobile-login-link">Login</a></li>
                        <?php else: ?>
                            <li><a href="./logout.php" id="mobile-logout-link">Logout</a></li>
                        <?php endif; ?>
                        <li><a href="./addEntry.php" id="mobile-addpost-link">Add Post</a></li>
                        <li><a href="./viewBlog.php" id="mobile-viewblog-link">View Posts</a></li>
                        <li><a href="./index.html" id="mobile-portfolio-link">Portfolio</a></li>
                    </div>
                </div>
            </nav>
        </header>
        <form action="addPost.php" method="POST">
            <fieldset>
                <legend>Add Post</legend>
                <div class="input-box" id="title-input-box">
                    <input type="text" id="title" name="title" placeholder="Title" autocomplete="off" value="<?= $title ?>">
                </div>
                <div class="input-box" id="content-input-box">
                    <textarea name="content" id="content" placeholder="Enter your text here" autocomplete="off"><?= $content ?></textarea>
                </div>
                <input type="hidden" id="preview-mode" name="preview" value="false">
                <div class="buttons">
                    <button type="submit" id="add-post-button">Add Post</button>
                    <button type="button" id="preview-button">Preview</button>
                    <button type="reset">Clear</button>
                </div>
            </fieldset>
        </form>
        <footer>
            <nav>
                <div class="nav-links-container">
                    <ul class="nav-links">
                        <li><a href="./blog.php">Home</a></li>
                        <?php if (!isset($_SESSION['email'])): ?>
                            <li><a href="./login.html">Login</a></li>
                        <?php else: ?>
                            <li><a href="./logout.php">Logout</a></li>
                        <?php endif; ?>
                        <li><a href="./addEntry.php">Add Post</a></li>
                        <li><a href="./viewBlog.php">View Posts</a></li>
                        <li><a href="./index.html">Portfolio</a></li>
                    </ul>
                </div>
            </nav>
            <p>Copyright &#169; 2025 Andrei-Vlad Pisaltu-Virlan. All Rights Reserved.</p>
        </footer>
    </body>
</html>