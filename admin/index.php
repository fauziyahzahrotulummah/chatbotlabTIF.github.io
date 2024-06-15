<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<!-- CONTENT -->
<section id="content">
    <?php include 'includes/navbar.php'; ?>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <a href="add-tag.php" class="btn-add">
                <i class='bx bx-plus'></i>
                <span class="text">ADD TAG</span>
            </a>
        </div>

        <?php
        include 'includes/connection.php'; // Include database connection file

        // Fetch tag, pattern, and response counts from the database
        $sql = "SELECT COUNT(*) AS total_tags FROM tb_kategori;
                SELECT COUNT(*) AS total_patterns FROM tb_pattern;
                SELECT COUNT(*) AS total_responses FROM tb_response;";
        $conn->multi_query($sql);

        // Initialize variables to store counts
        $total_tags = $total_patterns = $total_responses = 0;

        // Extract counts from query results
        do {
            if ($result = $conn->store_result()) {
                while ($row = $result->fetch_assoc()) {
                    if (isset($row['total_tags'])) {
                        $total_tags = $row['total_tags'];
                    } elseif (isset($row['total_patterns'])) {
                        $total_patterns = $row['total_patterns'];
                    } elseif (isset($row['total_responses'])) {
                        $total_responses = $row['total_responses'];
                    }
                }
                $result->free();
            }
        } while ($conn->next_result());

        // Close database connection
        $conn->close();
        ?>

        <!-- Display tag, pattern, and response counts -->
        <ul class="box-info">
            <li>
                <i class='bx bxs-tag-alt'></i>
                <span class="text">
                    <h3><?php echo $total_tags; ?></h3>
                    <p>Tag</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-circle'></i>
                <span class="text">
                    <h3><?php echo $total_patterns; ?></h3>
                    <p>Pattern</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-message-dots'></i>
                <span class="text">
                    <h3><?php echo $total_responses; ?></h3>
                    <p>Response</p>
                </span>
            </li>
        </ul>

        <!-- Display tagging table -->
        
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>TAGGING</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tagging</th>
                            <th>Action</th>
                            <th>Pattern</th>
                            <th>Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'includes/connection.php'; // Sertakan file koneksi database
                        $no = 1;

                        $sql = "SELECT
                                    k.id_kategori,
                                    k.kategori,
                                    (
                                        SELECT GROUP_CONCAT(p.pattern ORDER BY p.id_pattern ASC SEPARATOR ', ')
                                        FROM tb_pattern p
                                        WHERE p.id_kategori = k.id_kategori
                                    ) AS patterns,
                                    (
                                        SELECT GROUP_CONCAT(r.response ORDER BY r.id_response ASC SEPARATOR ', ')
                                        FROM tb_response r
                                        WHERE r.id_kategori = k.id_kategori
                                    ) AS responses
                                FROM
                                    tb_kategori k
                                ORDER BY
                                    k.id_kategori;";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['kategori'] . "</td>";
                                echo "<td>
                                    <button class='edit-button'><a href='edit-tag.php?tag_id=" . $row['id_kategori'] . "'><i class='fas fa-edit'></i> Edit</a></button>
                                    <span style='margin: 0 5px;'></span>
                                    <button class='delete-button'><a href='delete-tag.php?tag_id=" . $row['id_kategori'] . "'><i class='fas fa-trash-alt'></i> Delete</a></button>
                                </td>";
                        
                                // Pisahkan pola dalam kolom pola dan tambahkan tombol hapus
                                echo "<td>";
                                $patterns = explode(', ', $row['patterns']);
                                foreach ($patterns as $pattern) {
                                    echo "<form method='POST' action='delete-pattern.php' style='display:inline;'>";
                                    echo "<input type='hidden' name='pattern' value='$pattern'>";
                                    echo $pattern . " <button type='submit' class='delete-button'><i class='fas fa-trash-alt'></i></button>";
                                    echo "</form><br>";
                                }
                                // Tambahkan tombol "Tambah" untuk pola
                                echo "<form method='POST' action='add-newpattern.php' style='margin-top: 10px;'>";
                                echo "<input type='hidden' name='id_kategori' value='" . $row['id_kategori'] . "'>";
                                echo "<input type='text' name='new_pattern' placeholder='Pola Baru' required>";
                                echo "<button type='submit' class='add-button'><i class='fas fa-plus'></i> Tambah</button>";
                                echo "</form>";
                                echo "</td>";
                        
                                // Pisahkan respons dalam kolom respons dan tambahkan tombol edit
                                echo "<td>";
                                $responses = explode(', ', $row['responses']);
                                foreach ($responses as $response) {
                                    echo $response . " <a href='edit-response.php?id_response=" . $row['id_kategori'] . "' class='edit-button'><i class='fas fa-edit'></i></a><br>";
                                }
                                echo "</td>";
                        
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Data tidak ditemukan.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


<?php include 'includes/footer.php'; ?>
