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

$id_types = array();
$sql_id_types = "SELECT id, type_name FROM tb_intent";
$result_id_types = $conn->query($sql_id_types);
if ($result_id_types->num_rows > 0) {
    while ($row = $result_id_types->fetch_assoc()) {
        $id_types[$row['id']] = $row['type_name'];
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $id_type = $_POST['id_type'];
    $response_text = $_POST['response_text'];

    $category_id = mysqli_real_escape_string($conn, $category_id);
    $id_type = mysqli_real_escape_string($conn, $id_type);
    $response_text = mysqli_real_escape_string($conn, $response_text);

    $response_sql = "INSERT INTO tb_response (id_kategori, id_type, response) VALUES ('$category_id', '$id_type', '$response_text')";

    if ($conn->query($response_sql) === TRUE) {
        $status = "Response berhasil ditambahkan.";
        header("Location: index.php");
        exit;
    } else {
        $status = "Error: " . $response_sql . "<br>" . $conn->error;
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
        <main>>
            <h2>Add Response</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="category_id">Category:</label><br>
                <select id="category_id" name="category_id">
                    <?php foreach ($categories as $category_id => $category_name) { ?>
                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                    <?php } ?>
                </select><br><br>

                <label for="id_type">Type:</label><br>
                <select id="id_type" name="id_type">
                    <?php foreach ($id_types as $id => $type_name) { ?>
                        <option value="<?php echo $id; ?>"><?php echo $type_name; ?></option>
                    <?php } ?>
                </select><br><br>

                <label for="response_text">Response Text:</label><br>
                <textarea id="response_text" name="response_text"></textarea><br><br>

                <input type="submit" value="Add Response">
            </form>
            </main>
    </section>
        <?php include 'includes/footer.php'; ?>

