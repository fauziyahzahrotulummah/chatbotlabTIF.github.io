<?php
include 'includes/connection.php';

$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pattern = $_POST['pattern'];

    $pattern = mysqli_real_escape_string($conn, $pattern);

    $delete_sql = "DELETE FROM tb_pattern WHERE pattern='$pattern'";

    if ($conn->query($delete_sql) === TRUE) {
        $status = "Pattern berhasil dihapus.";
    } else {
        $status = "Error: gagal dihapus" . $delete_sql . "<br>" . $conn->error;
    }
}

$conn->close();

header("Location: index.php");
exit;
?>
