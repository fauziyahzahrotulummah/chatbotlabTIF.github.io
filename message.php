<?php
$python = "C:\\Users\\fauziyah_ummah\\Anaconda3\\python.exe"; 
$scriptPath = "C:\\xampp\\htdocs\\chatbot\\"; 
$script = $scriptPath . "preprocessing.py"; 

$conn = mysqli_connect("localhost", "root", "", "chatbot");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$input = isset($_POST['isi_message']) ? $_POST['isi_message'] : '';

if (!empty($input)) {
    $command = "$python $script \"$input\"";
    $output = shell_exec($command);
    $matches = json_decode($output);

    if (!empty($matches)) {
        foreach ($matches as $response) {
            echo nl2br($response) . "<br>"; 
        }
        exit();
    } else {
        echo "Tidak ada respons yang ditemukan setelah preprocessing.<br>";
    }
} else {
    echo "Tidak ada pesan yang dikirim.<br>";
}

// Tutup koneksi database
mysqli_close($conn);
?>
