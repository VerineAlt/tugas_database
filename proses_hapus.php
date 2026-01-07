<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: /list");
    exit;
}

$id = $_GET['id'];

// get photo name first
$stmt = $conn->prepare("SELECT foto FROM mahasiswa WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($fotoName);
$stmt->fetch();
$stmt->close();

if ($fotoName) {
    $path = "uploads/" . $fotoName;
    if (file_exists($path)) {
        @unlink($path);
    }
}

// delete data
$stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();

header("Location: /list");
exit;
