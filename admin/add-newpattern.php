<?php
// Include the file containing the database connection details
include 'includes/connection.php';

// Assume form data is being received via POST
$new_pattern = $_POST['new_pattern'] ?? null;
$id_kategori = $_POST['id_kategori'] ?? null;
$id_type = $_POST['id_type'] ?? '2'; // Set default value to 2 if id_type is null

// Validate the required fields
if ($id_type !== '2') {
    die("Error: id_type tidak valid. Please make sure 'id_type' is provided. id_type should always be 2 if not provided.");
}

// Create a connection to the database (from the included file)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape special characters in a string for use in an SQL statement
$new_pattern_escaped = mysqli_real_escape_string($conn, $new_pattern);
$id_kategori_escaped = mysqli_real_escape_string($conn, $id_kategori);
$id_type_escaped = mysqli_real_escape_string($conn, $id_type);

// Prepare and execute the SQL query
$sql = "INSERT INTO tb_pattern (pattern, id_kategori, id_type) VALUES ('$new_pattern_escaped', '$id_kategori_escaped', '$id_type_escaped')";

if ($conn->query($sql) === TRUE) {
    // Redirect to index.php
    // header("Location: index.php"); // Remove redirection

    // Close the connection
    $conn->close();

    // Output JavaScript to scroll to the added pattern
    echo "<script>window.location.href = 'index.php#added-pattern';</script>";
    exit; // Ensure script stops executing after redirection
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
