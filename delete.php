<?php
include "config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

if ($id > 0) {
    $sql_delete = "DELETE FROM kegiatan WHERE id = $id";
    mysqli_query($koneksi, $sql_delete);
}

header("Location: index.php");
exit;
?>
