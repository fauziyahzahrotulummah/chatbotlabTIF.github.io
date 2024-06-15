<?php
include 'includes/connection.php';

$status = "";

$id_types = array();
$sql_id_types = "SELECT id, type_name FROM tb_intent";
$result_id_types = $conn->query($sql_id_types);
if ($result_id_types->num_rows > 0) {
    while ($row = $result_id_types->fetch_assoc()) {
        $id_types[$row['id']] = $row['type_name'];
    }
}

$kategori_list = array();
$sql_kategori_list = "SELECT id_kategori, kategori, id_type FROM tb_kategori";
$result_kategori_list = $conn->query($sql_kategori_list);
if ($result_kategori_list->num_rows > 0) {
    while ($row = $result_kategori_list->fetch_assoc()) {
        $kategori_list[] = $row;
    }
}

$pattern_list = array();
$sql_pattern_list = "SELECT id_pattern, pattern, id_kategori FROM tb_pattern";
$result_pattern_list = $conn->query($sql_pattern_list);
if ($result_pattern_list->num_rows > 0) {
    while ($row = $result_pattern_list->fetch_assoc()) {
        $pattern_list[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kategori_id'])) {
    $kategori_id = $_POST['kategori_id'];
    $kategori = $_POST['kategori'];
    $id_type = $_POST['id_type'];

    $kategori_id = mysqli_real_escape_string($conn, $kategori_id);
    $kategori = mysqli_real_escape_string($conn, $kategori);
    $id_type = mysqli_real_escape_string($conn, $id_type);

    $sql = "UPDATE tb_kategori SET kategori = '$kategori', id_type = '$id_type' WHERE id_kategori = '$kategori_id'";

    if ($conn->query($sql) === TRUE) {
        $status = "Kategori berhasil diubah.";
        header("Location: index.php");
        exit;
    } else {
        $status = "Error: " . $sql . "<br>" . $conn->error;
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
        <div class="head-title">
            <h2>Edit Category</h2>
            <?php if (!empty($kategori_list)) { ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-type">
                        <label for="kategori_id">Select Category to Edit:</label>
                        <select id="kategori_id" name="kategori_id">
                            <?php foreach ($kategori_list as $kategori) { ?>
                                <option value="<?php echo $kategori['id_kategori']; ?>">
                                    <?php echo $kategori['kategori']; ?> (Type: <?php echo $id_types[$kategori['id_type']]; ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-add-tag">
                        <label for="kategori">Category Name:</label>
                        <input type="text" id="kategori" name="kategori" required>
                    </div>

                    <div class="form-type">
                        <label for="id_type">Intent Type:</label>
                        <select id="id_type" name="id_type" required>
                            <?php foreach ($id_types as $id => $type_name) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $type_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-add-tag">
                        <input type="submit" value="Edit Category">
                    </div>
                </form>
                <p><?php echo $status; ?></p>
            <?php } else { ?>
                <p>Tidak ada kategori yang tersedia untuk diubah.</p>
            <?php } ?>
    </main>
</section>
<?php include 'includes/footer.php'; ?>

