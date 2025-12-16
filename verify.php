<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Dokumen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Document Verification</h1>
    <p class="subtitle">Cek Keaslian Dokumen Digital</p>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="doc" required>
        <button>Verify Document</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $storage = __DIR__ . "/storage/";
    $hashFile = $storage . "original_hash.txt";

    $hashUpload = hash_file('sha256', $_FILES['doc']['tmp_name']);
    $hashAsli = trim(file_get_contents($hashFile));

    if ($hashUpload === $hashAsli) {
        echo "<div class='result success'>";
        echo "<b>✔ DOKUMEN ASLI</b><br><br>";
    } else {
        echo "<div class='result error'>";
        echo "<b>✖ DOKUMEN PALSU / TELAH DIUBAH</b><br><br>";
    }

    echo "Hash Upload:";
    echo "<div class='hash-box'>$hashUpload</div>";

    echo "Hash Tersimpan:";
    echo "<div class='hash-box'>$hashAsli</div>";

    echo "</div>";
}

?>
</div>

<div class="footer">
Sistem Informasi Terdesentralisasi • Verifikasi Publik
</div>
</body>
</html>