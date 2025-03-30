<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: viewBlog.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>