<?php session_start();
// Include the database connection
require 'db_connect.php';
            
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

// SQL query to retrieve all blog posts
$query = "SELECT * FROM posts";
$result = mysqli_query($conn, $query);

// If there are no posts, redirect to the login page
if (mysqli_num_rows($result) == 0) {
    header("Location: ./login.html");
    exit();
}

// SQL query to fetch distinct months for dropdown
$monthQuery = "SELECT DISTINCT DATE_FORMAT(created_at, '%Y-%m') as month FROM posts";
$monthResult = mysqli_query($conn, $monthQuery);

// Fetch distinct months into an array
$months = [];
while ($row = mysqli_fetch_assoc($monthResult)) {
    $months[] = $row['month'];
}

// Fetch posts for the selected month
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : 'all';
$postQuery = ($selectedMonth == 'all') ? "SELECT * FROM posts" : "SELECT * FROM posts WHERE DATE_FORMAT(created_at, '%Y-%m') = '$selectedMonth'";
$postResult = mysqli_query($conn, $postQuery);

// Fetch the blog posts into an array
$posts = [];
while ($row = mysqli_fetch_assoc($postResult)) {
    $posts[] = $row;
}

// Quicksort algorithm implementation

// Partition function: Reorganizes the array based on pivot
function partition(&$arr, $low, $high, $key) {
    $pivot = $arr[intval(($low + $high) / 2)]; // Middle element as pivot
    $i = $low;
    $j = $high;
    
    while ($i <= $j) {
        // Move the left pointer to the right until finding an element larger than the pivot
        while (strtotime($arr[$i][$key]) > strtotime($pivot[$key])) {
            $i++;
        }
        // Move the right pointer to the left until finding an element smaller than the pivot
        while (strtotime($arr[$j][$key]) < strtotime($pivot[$key])) {
            $j--;
        }
        
        // Swap elements if necessary
        if ($i <= $j) {
            $temp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $temp;
            $i++;
            $j--;
        }
    }
    
    return $i;
}

// Quicksort function: Recursively sorts the array
function quicksort(&$arr, $low, $high, $key) {
    if ($low < $high) {
        $pi = partition($arr, $low, $high, $key);
        quicksort($arr, $low, $pi - 1, $key);  // Sort the left subarray
        quicksort($arr, $pi, $high, $key);     // Sort the right subarray
    }
}

// Sort the months in descending order
quicksort($months, 0, count($months) - 1, 0);

// Sort the posts in descending order by created_at timestamp
quicksort($posts, 0, count($posts) - 1, 'created_at');
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
            <p class="section-text-p1">View</p>
            <h1 class="title">My Posts</h1>
            <form id="dropdown-menu" method="GET">
                <label for="month">Select Month:</label>
                <select name="month" id="month">
                    <option value="all" <?= ($selectedMonth == 'all') ? 'selected' : ''; ?>>Show All</option>
                    <?php foreach ($months as $month): ?>
                        <option value="<?= $month; ?>" <?= ($selectedMonth == $month) ? 'selected' : ''; ?>>
                            <?= date("F Y", strtotime($month . "-01")); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Filter</button>
            </form>
            <?php
            foreach ($posts as $row) {
                echo "<p class='post-date'>Posted on " . format_date($row['created_at']) . "</p>";
                echo "<h2 class='post-title'>{$row['title']}</h2>";
                echo "<p class='post-content'>{$row['content']}</p><hr>";
            }
            ?>
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