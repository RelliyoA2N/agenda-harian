<?php
include "config/koneksi.php";

$judul     = "";
$tanggal   = "";
$jam       = "";
$deskripsi = "";
$prioritas = "";
$pesan_error  = "";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$sql_detail    = "SELECT * FROM kegiatan WHERE id = $id";
$result_detail = mysqli_query($koneksi, $sql_detail);

if (!$result_detail || mysqli_num_rows($result_detail) == 0) {
    header("Location: index.php");
    exit;
}

$data = mysqli_fetch_assoc($result_detail);

$judul     = $data['judul'];
$tanggal   = $data['tanggal'];
$jam       = $data['jam'];
$deskripsi = $data['deskripsi'];
$prioritas = $data['prioritas'];

if (isset($_POST['update'])) {
    $judul     = $_POST['judul'];
    $tanggal   = $_POST['tanggal'];
    $jam       = $_POST['jam'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];

    if ($judul == "" || $tanggal == "" || $jam == "") {
        $pesan_error = "Judul, tanggal, dan jam wajib diisi.";
    } else {
        $sql_update = "UPDATE kegiatan SET
                        judul     = '$judul',
                        tanggal   = '$tanggal',
                        jam       = '$jam',
                        deskripsi = '$deskripsi',
                        prioritas = '$prioritas'
                       WHERE id = $id";

        $query_update = mysqli_query($koneksi, $sql_update);

        if ($query_update) {
            header("Location: index.php");
            exit;
        } else {
            $pesan_error = "Gagal memperbarui kegiatan: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kegiatan - Agenda Harian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="app-container">
    <header class="app-header">
        <h1>
            <i class="fa-solid fa-pen-to-square"></i>
            Edit Kegiatan
        </h1>
        <p>Perbarui informasi kegiatan harianmu.</p>
    </header>

    <main class="app-main single-column">
        <section class="form-section">
            <div class="toolbar-back">
                <a href="index.php" class="btn btn-sm btn-secondary">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Kembali ke Daftar Kegiatan
                </a>
            </div>

            <h2>
                <i class="fa-solid fa-pencil"></i>
                Form Edit Kegiatan
            </h2>

            <?php if ($pesan_error != "") { ?>
                <div class="alert alert-error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <?php echo $pesan_error; ?>
                </div>
            <?php } ?>

            <form action="" method="POST" class="form-kegiatan">
                <div class="form-group">
                    <label for="judul">Judul Kegiatan <span class="required">*</span></label>
                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        value="<?php echo $judul; ?>"
                        required
                    >
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tanggal">Tanggal <span class="required">*</span></label>
                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            value="<?php echo $tanggal; ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="jam">Jam <span class="required">*</span></label>
                        <input
                            type="time"
                            name="jam"
                            id="jam"
                            value="<?php echo substr($jam, 0, 5); ?>"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="prioritas">Prioritas</label>
                    <select name="prioritas" id="prioritas">
                        <option value=""
                            <?php if ($prioritas == "" || $prioritas === null) { echo "selected"; } ?>>
                            -- Pilih Prioritas (opsional) --
                        </option>
                        <option value="rendah"
                            <?php if ($prioritas == "rendah") { echo "selected"; } ?>>
                            Rendah
                        </option>
                        <option value="sedang"
                            <?php if ($prioritas == "sedang") { echo "selected"; } ?>>
                            Sedang
                        </option>
                        <option value="tinggi"
                            <?php if ($prioritas == "tinggi") { echo "selected"; } ?>>
                            Tinggi
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"><?php echo $deskripsi; ?></textarea>
                </div>

                <button type="submit" name="update" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            </form>
        </section>
    </main>
</div>

<script src="assets/js/script.js"></script>
</body>
</html>
