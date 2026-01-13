<?php
include 'koneksi.php';
$result = $conn->query("SELECT * FROM mahasiswa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        img {
            width: 100px;
        }
    </style>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="/create" class="button">Tambah Data</a><br><br>

    <table>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>";
            if ($row['foto']) {
                echo "<img src='uploads/" . htmlspecialchars($row['foto']) . "' alt='Foto'>";
            } else {
                echo "Tidak ada foto";
            }
            echo "</td>";
            echo "<td>
                <a href='/edit?id=" . $row['id'] . "' class='button'>Edit</a> |
                <a class='button' href='/hapus?id=" . $row['id'] . "' onclick=\"return confirm('Yakin ingin hapus data?')\">Hapus</a>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
