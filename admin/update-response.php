<?php
include 'includes/connection.php';

$status = "";

$categories = array();
$sql_categories = "SELECT id_kategori, kategori FROM tb_kategori";
$result_categories = $conn->query($sql_categories);
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[$row['id_kategori']] = $row['kategori'];
    }
}

$types = array();
$sql_types = "SELECT DISTINCT type FROM tb_intent";
$result_types = $conn->query($sql_types);
if ($result_types->num_rows > 0) {
    while ($row = $result_types->fetch_assoc()) {
        $types[] = $row['type'];
    }
}

if (isset($_GET['id_response'])) {
    $id_response = $_GET['id_response'];

    $sql = "SELECT * FROM tb_response WHERE id_response = $id_response";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    } else {
        $status = "Data tidak ditemukan.";
    }
} else {
    $status = "ID response tidak ditemukan.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_response = $_POST['id_response'];
    $category_id = $_POST['category_id'];
    $type = $_POST['type'];
    $response_text = $_POST['response_text'];

    $id_response = mysqli_real_escape_string($conn, $id_response);
    $category_id = mysqli_real_escape_string($conn, $category_id);
    $type = mysqli_real_escape_string($conn, $type);
    $response_text = mysqli_real_escape_string($conn, $response_text);

    $sql = "UPDATE tb_response SET id_kategori='$category_id', type='$type', response='$response_text' WHERE id_response=$id_response";

    if ($conn->query($sql) === TRUE) {
        $status = "Response berhasil diperbarui.";
    } else {
        $status = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Response</title>
</head>
<body>
    <h2>Edit Response</h2>
    <?php if (isset($response)) { ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id_response" value="<?php echo $response['id_response']; ?>">

            <label for="category_id">Category:</label><br>
            <select id="category_id" name="category_id">
                <?php foreach ($categories as $category_id => $category_name) { ?>
                    <option value="<?php echo $category_id; ?>" <?php if ($category_id == $response['id_kategori']) echo 'selected'; ?>><?php echo $category_name; ?></option>
                <?php } ?>
            </select><br><br>

            <label for="type">Type:</label><br>
            <select id="type" name="type">
                <?php foreach ($types as $type) { ?>
                    <option value="<?php echo $type; ?>" <?php if ($type == $response['type']) echo 'selected'; ?>><?php echo $type; ?></option>
                <?php } ?>
            </select><br><br>

            <label for="response_text">Response Text:</label><br>
            <textarea id="response_text" name="response_text"><?php echo $response['response']; ?></textarea><br><br>

            <input type="submit" value="Update Response">
        </form>
    <?php } else { ?>
        <p><?php echo $status; ?></p>
    <?php } ?>
</body>
</html>
