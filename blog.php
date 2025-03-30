<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog</title>
        <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/mediaqueries.css">
        <script src="./js/script.js" defer></script>
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
        <section id="main">
            <p class="section-text-p1">Welcome To</p>
            <h1 class="title">My Blog</h1>
            <div style="margin-top: 2rem; display: flex; justify-content: center; align-items: center; flex-direction: column; gap: 1rem;"> <!-- REMOVE THIS -->
                <a href="./viewBlog.php"><button class="btn btn-color-2">View Posts</button></a>
                <?php if (!isset($_SESSION['email'])): ?>
                    <a href="./login.html"><button class="btn btn-color-2">Login</button></a>
                <?php else: ?>
                    <h2>Welcome Admin</h2>
                    <a href="./addEntry.php"><button class="btn btn-color-2">Add Post</button></a>
                    <a href="./logout.php"><button class="btn btn-color-2">Logout</button></a>
                <?php endif; ?>
            </div>
        </section>
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