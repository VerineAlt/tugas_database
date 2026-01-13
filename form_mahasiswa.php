<?php
// default (CREATE)
$isEdit = false;
$id = $nim = $nama = $email = $foto_lama = "";

// if UPDATE
if (isset($_GET['id'])) {
    include 'koneksi.php';

    $isEdit = true;
    $id = $_GET['id'];

    $query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);

    $nim = $data['nim'];
    $nama = $data['nama'];
    $email = $data['email'];
    $foto_lama = $data['foto'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title><?= $isEdit ? 'Update' : 'Tambah' ?> Data Mahasiswa</title>
</head>

<body>

    <h2><?= $isEdit ? 'Update' : 'Tambah' ?> Data Mahasiswa</h2>

    <form action="<?= $isEdit ? 'proses_update.php' : 'proses_simpan.php' ?>" method="POST" enctype="multipart/form-data">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <?php endif; ?>
        <div class="form-group">
            <div class="input-wrapper">
                <label>NIM:</label><br>
                <input type="text" name="nim" <?php if($isEdit): echo 'style="background-color: #EEEEEE"'?> <?php endif;?> value="<?= htmlspecialchars($nim) ?>" <?= $isEdit ? 'readonly' : 'required' ?>><br><br>
            </div>

            <div class="input-wrapper">
                <label>Nama:</label><br>
                <input type="text" name="nama" value="<?= $nama ?>" required><br><br>
            </div>

        </div>

        <div class="form-group">
            <div class="input-wrapper">
                <label>Email:</label><br>
                <input type="email" name="email" value="<?= $email ?>" required><br><br>
            </div>

            <div class="input-wrapper">

                <label>Password:</label><br>
                <input type="password" name="password"  required><br><br>

            </div>
        </div>



        <label>Foto:</label><br>
        <input type="file" name="foto" accept="image/*" id="file-input"><br>

        <?php if ($isEdit && $foto_lama): ?>
            <small>Foto saat ini:</small><br>
            <img src="uploads/<?= $foto_lama ?>" width="100" alt="Tidak ada foto"><br>
            <input type="hidden" name="foto_lama" value="<?= $foto_lama ?>">
        <?php endif; ?>

        <br>
        <button type="submit" class="button"><?= $isEdit ? 'Update' : 'Simpan' ?></button>
    </form>

    <br>
    <a href="/list" class="special-a"> <- Kembali</a>

</body>

</html>