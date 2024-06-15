
<?php include 'includes/connection.php';

$status = "";

$id_types = array();
$sql_id_types = "SELECT id, type_name FROM tb_intent";
$result_id_types = $conn->query($sql_id_types);
if ($result_id_types->num_rows > 0) {
    while ($row = $result_id_types->fetch_assoc()) {
        $id_types[$row['id']] = $row['type_name'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori = $_POST['kategori'];
    $id_type = $_POST['id_type'];

    $kategori = mysqli_real_escape_string($conn, $kategori);
    $id_type = mysqli_real_escape_string($conn, $id_type);

    $sql = "INSERT INTO tb_kategori (kategori, id_type) VALUES ('$kategori', '$id_type')";

    if ($conn->query($sql) === TRUE) {
        $status = "Kategori berhasil ditambahkan.";
        header("Location:add-pattern.php");
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
        <main>>
            <div class="head-title">
                <h2>Add Category</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-add-tag">
                        <label for="kategori">Category Name:</label>
                        <input type="text" id="kategori" name="kategori">
                    </div>

                    <div class="form-type">
                        <label for="id_type">Intent Type:</label>
                        <select id="id_type" name="id_type">
                            <?php foreach ($id_types as $id => $type_name) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $type_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-add-tag">
                        <input type="submit" value="Add Category">
                    </div>
                </form>
                <p><?php echo $status; ?></p>
            </div>
            
        </main>
        </section>
        <?php include 'includes/footer.php'; ?>
        