<?php
session_start();
session_destroy();
header("Location: blog.php");
exit();
?>