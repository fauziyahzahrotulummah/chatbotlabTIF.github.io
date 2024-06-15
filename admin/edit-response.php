<?php
session_start();

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

$id_types = array();
$sql_id_types = "SELECT id, type_name FROM tb_intent";
$result_id_types = $conn->query($sql_id_types);
if ($result_id_types->num_rows > 0) {
    while ($row = $result_id_types->fetch_assoc()) {
        $id_types[$row['id']] = $row['type_name'];
    }
}

$response_id = isset($_GET['id_response']) ? intval($_GET['id_response']) : 0;
$response_data = array();
if ($response_id > 0) {
    $sql_response = "SELECT id_kategori, id_type, response FROM tb_response WHERE id_response = '$response_id'";
    $result_response = $conn->query($sql_response);
    if ($result_response->num_rows > 0) {
        $response_data = $result_response->fetch_assoc();
    } else {
        $status = "Response not found.";
    }
} else {
    $status = "Invalid response ID.";
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && $response_id > 0) {
    $category_id = $_POST['category_id'];
    $id_type = $_POST['id_type'];
    $response_text = $_POST['response_text'];

    $category_id = mysqli_real_escape_string($conn, $category_id);
    $id_type = mysqli_real_escape_string($conn, $id_type);
    $response_text = mysqli_real_escape_string($conn, $response_text);

    $update_sql = "UPDATE tb_response SET id_kategori='$category_id', id_type='$id_type', response='$response_text' WHERE id_response='$response_id'";

    if ($conn->query($update_sql) === TRUE) {
        $status = "Response berhasil diperbarui.";
        header("Location: index.php");
        exit;
    } else {
        $status = "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include 'includes/navbar.php'; ?>
    <!-- NAVBAR -->
    <main>
        <h2>Edit Response</h2>
        <?php if ($status) { echo "<p>$status</p>"; } ?>
        <?php if (!empty($response_data)) { ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id_response=" . $response_id; ?>">
            <label for="category_id">Category:</label><br>
            <select id="category_id" name="category_id">
                <?php foreach ($categories as $category_id => $category_name) { ?>
                    <option value="<?php echo $category_id; ?>" <?php echo $response_data['id_kategori'] == $category_id ? 'selected' : ''; ?>>
                        <?php echo $category_name; ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <label for="id_type">Type:</label><br>
            <select id="id_type" name="id_type">
                <?php foreach ($id_types as $id => $type_name) { ?>
                    <option value="<?php echo $id; ?>" <?php echo $response_data['id_type'] == $id ? 'selected' : ''; ?>>
                        <?php echo $type_name; ?>
                    </option>
                <?php } ?>
            </select><br><br>

            <label for="response_text">Response Text:</label><br>
            <textarea id="response_text" name="response_text"><?php echo htmlspecialchars(isset($response_data['response']) ? $response_data['response'] : ''); ?></textarea><br><br>

            <input type="submit" value="Update Response">
        </form>
        <?php } ?>
    </main>
</section>
<script src="script.js"></script>
</body>
</html>
