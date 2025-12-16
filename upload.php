<!DOCTYPE html>
<html>
<head>
    <title>Upload Dokumen Asli</title>
    <link rel="stylesheet" href="upload.css">
</head>
<body>

<div class="container">
    <h1>Document Registration</h1>
    <p class="subtitle">Sistem Anti Pemalsuan Dokumen</p>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="doc" required>
        <button>Register Document</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $storage = __DIR__ . "/storage/";
    if (!is_dir($storage)) {
        mkdir($storage, 0777, true);
    }

    $hash = hash_file('sha256', $_FILES['doc']['tmp_name']);
    file_put_contents($storage . "original_hash.txt", $hash);
    move_uploaded_file($_FILES['doc']['tmp_name'], $storage . "original.bin");

    echo "<div class='result success'>";

    echo "<b>✔ Dokumen berhasil diregistrasi</b><br><br>";
    echo "SHA-256 Hash:";
    echo "<div class='hash-box'>$hash</div>";
    echo "</div>";
}
?>
</div>

<div class="footer">
    Sistem Informasi Terdesentralisasi • Praktikum Blockchain
</div>
</body>
</html>