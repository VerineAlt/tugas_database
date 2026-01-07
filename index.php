<?php
$page = $_GET['page'] ?? 'list';

switch ($page) {
    case 'create':
        require 'form_mahasiswa.php';
        break;

    case 'edit':
        require 'form_mahasiswa.php';
        break;

    case 'hapus':
        require 'proses_hapus.php';
        break;

    case 'list':
        require 'list.php';
        break;

    default:
        require 'list.php';
}
