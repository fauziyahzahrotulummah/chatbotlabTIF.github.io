<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbot";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah sesi sudah dimulai, jika belum maka mulai sesi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, alihkan ke halaman login
    header("Location: login.php");
    exit();
}
?>
