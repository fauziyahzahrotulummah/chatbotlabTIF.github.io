<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include 'includes/navbar.php'; ?>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>USERS</h1>
            </div>
            <a href="add-user.php" class="btn-add">
                <i class='bx bx-plus' ></i>
                <span class="text">ADD</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>USERS</h3>
                    <i class='bx bx-search' ></i>
                    <i class='bx bx-filter' ></i>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'includes/connection.php';

                        $sql = "SELECT * FROM users";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['password'] . "</td>";
                                echo "<td>
                                        <form method='POST' action='delete-user.php'>
                                            <input type='hidden' name='user_id' value='" . $row['id'] . "'>
                                            <button type='submit'><i class='fas fa-trash-alt'></i> Delete</button>
                                        </form>
                                    </td>";
                        
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data pengguna.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
                    </section>

    <?php
if(isset($_GET['message'])) {
    echo "<p>" . $_GET['message'] . "</p>";
}
?>

<?php include 'includes/footer.php'; ?>
