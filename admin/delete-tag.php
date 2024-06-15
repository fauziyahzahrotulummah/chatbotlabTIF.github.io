<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'includes/connection.php';

if (isset($_GET['tag_id'])) {
    $tag_id = $_GET['tag_id'];

    $delete_patterns_sql = "DELETE FROM tb_pattern WHERE id_kategori='$tag_id'";
    if ($conn->query($delete_patterns_sql) === TRUE) {
        $delete_responses_sql = "DELETE FROM tb_response WHERE id_kategori='$tag_id'";
        if ($conn->query($delete_responses_sql) === TRUE) {
            $delete_tag_sql = "DELETE FROM tb_kategori WHERE id_kategori='$tag_id'";
            if ($conn->query($delete_tag_sql) === TRUE) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error deleting tag: " . $conn->error;
            }
        } else {
            echo "Error deleting responses: " . $conn->error;
        }
    } else {
        echo "Error deleting patterns: " . $conn->error;
    }
}

$conn->close();
?>
