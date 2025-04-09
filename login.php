<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        if ($password == $stored_password) {
            $_SESSION['email'] = $email;
            header("Location: addEntry.php");
            exit();
        } else {
            header("Location: login.html?error=1");
            exit();
        }
    } else {
        header("Location: login.html?error=1");
        exit();
    }
}
?>