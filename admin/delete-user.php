<?php
include 'includes/connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userIdToDelete = $_POST['user_id'];

    $sql = "SELECT * FROM users WHERE id = '$userIdToDelete'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM users WHERE id = '$userIdToDelete'";
        if ($conn->query($sqlDelete) === TRUE) {
            header("Location: users.php?message=Pengguna berhasil dihapus.");
            exit();
        } else {
            echo "Error: " . $sqlDelete . "<br>" . $conn->error;
        }
    } else {
        header("Location: users.php?message=Pengguna tidak ditemukan.");
        exit();
    }
} else {
    header("Location: users.php?message=Metode permintaan tidak valid.");
    exit();
}

$conn->close();
?>
