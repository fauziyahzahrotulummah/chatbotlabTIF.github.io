<?php
include 'includes/connection.php'; 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = $conn->real_escape_string($username);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "User berhasil ditambahkan.";
        header("Location: users.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>ADD USER</h1>
                </div>
                <a href="#" class="btn-add">
                    <i class='bx bx-plus' ></i>
                    <span class="text">ADD</span>
                </a>
            </div>

            <?php if(isset($_SESSION['success_message'])): ?>
                <div class="success-message"><?php echo $_SESSION['success_message']; ?></div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <div class="form-add-user">
                <form method="post" action="add-user.php">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                    <br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                    <br>
                    <button type="submit">Register</button>
                </form>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

<?php include 'includes/footer.php'; ?>
