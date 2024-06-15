<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <p>Anda telah berhasil logout. <a href="login.php">Login lagi</a></p>
</body>
</html>
