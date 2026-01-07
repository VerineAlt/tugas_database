<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /list');
    exit;
}

$id = $_POST['id'] ?? null;
$nim = $_POST['nim'] ?? '';
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$foto_lama = $_POST['foto_lama'] ?? '';

if (!$id) {
    die('Missing id');
}

// handle upload
$foto = $foto_lama;
if (!empty($_FILES['foto']['name'])) {
    if (!is_dir('uploads')) mkdir('uploads', 0755, true);
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = time() . '_' . uniqid() . '.' . $ext;
    if (!move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/$foto")) {
        die('Upload failed');
    }
    if ($foto_lama && file_exists("uploads/$foto_lama")) {
        @unlink("uploads/$foto_lama");
    }
}

// use prepared statement to update by id
$stmt = $conn->prepare("UPDATE mahasiswa SET nim = ?, nama = ?, email = ?, foto = ? WHERE id = ?");
$stmt->bind_param('ssssi', $nim, $nama, $email, $foto, $id);
if (!$stmt->execute()) {
    die('Update failed: ' . $stmt->error);
}
$stmt->close();

header('Location: /list');
exit;
