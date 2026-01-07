<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $conn->real_escape_string($_POST['nim']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Proses upload foto
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        if (!is_dir('uploads')) mkdir('uploads', 0755, true);
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $valid_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($ext), $valid_ext)) {
            $foto = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto);
        } else {
            echo "Format foto tidak valid.";
            exit;
        }
    }

    $sql = "INSERT INTO mahasiswa (nim, nama, email, password, foto)
            VALUES ('$nim', '$nama', '$email', '$password', '$foto')";

    if ($conn->query($sql) === TRUE) {
        header('Location: /list');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
