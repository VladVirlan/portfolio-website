<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Function to format the date with the day of the month including ordinal suffix
function format_date($timestamp) {
    $date = new DateTime($timestamp);
    $day = $date->format('j');
    $suffix = '';
    
    // Determine the correct ordinal suffix
    if ($day == 1 || $day == 21 || $day == 31) {
        $suffix = 'st';
    } elseif ($day == 2 || $day == 22) {
        $suffix = 'nd';
    } elseif ($day == 3 || $day == 23) {
        $suffix = 'rd';
    } else {
        $suffix = 'th';
    }
    
    // Format the date
    return $date->format('j') . $suffix . ' ' . $date->format('F Y, H:i \U\T\C');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES);

    date_default_timezone_set('UTC');
    $created_at = date('Y-m-d H:i:s');

    if (isset($_POST['preview']) && $_POST['preview'] == "true") {
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Blog Posts</title>
                <link rel="stylesheet" href="./css/reset.css">
                <link rel="stylesheet" href="./css/style.css">
                <link rel="stylesheet" href="./css/form.css">
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
                                <?php if (!isset($_SESSION["email"])): ?>
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
                                <?php if (!isset($_SESSION["email"])): ?>
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
                    <p class="section-text-p1">Preview</p>
                    <h1 class="title">Your Post</h1>
                    <p class="post-date">Posted on <?php echo format_date($created_at) ?></p>
                    <h2 class="post-title"><?php echo $title ?></h2>
                    <p class="post-content"><?php echo $content ?></p><hr>
                    
                    <div class="buttons">
                        <form class="preview-form" action="addPost.php" method="POST">
                        <input class="hidden" type="text" name="title" value="<?php echo $title ?>">
                        <textarea class="hidden" name="content"><?php echo $content ?></textarea>
                        <input type="hidden" name="preview" value="false">
                        <button type="submit">Add Post</button>
                        </form>
                        
                        <form class="preview-form" action="addEntry.php" method="POST">
                        <input class="hidden" type="text" name="title" value="<?php echo $title ?>">
                        <textarea class="hidden" name="content"><?php echo $content; ?></textarea>
                        <button type="submit">Edit Post</button>
                        </form>
                    </div>
                </section>
                <footer>
                    <nav>
                        <div class="nav-links-container">
                            <ul class="nav-links">
                                <li><a href="./blog.php">Home</a></li>
                                <?php if (!isset($_SESSION["email"])): ?>
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
        <?php
    } else {
        $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $created_at);

        if ($stmt->execute()) {
            header("Location: viewBlog.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>