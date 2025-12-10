<?php
include "config/koneksi.php";

$judul     = "";
$tanggal   = "";
$jam       = "";
$deskripsi = "";
$prioritas = "";

$pesan_sukses = "";
$pesan_error  = "";

if (isset($_POST['simpan'])) {
    $judul     = $_POST['judul'];
    $tanggal   = $_POST['tanggal'];
    $jam       = $_POST['jam'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];

    if ($judul == "" || $tanggal == "" || $jam == "") {
        $pesan_error = "Judul, tanggal, dan jam wajib diisi.";
    } else {
        $sql = "INSERT INTO kegiatan (judul, tanggal, jam, deskripsi, prioritas)
                VALUES ('$judul', '$tanggal', '$jam', '$deskripsi', '$prioritas')";

        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            $pesan_sukses = "Kegiatan berhasil ditambahkan.";

            $judul     = "";
            $tanggal   = "";
            $jam       = "";
            $deskripsi = "";
            $prioritas = "";
        } else {
            $pesan_error = "Gagal menambahkan kegiatan: " . mysqli_error($koneksi);
        }
    }
}

$sql_kegiatan    = "SELECT * FROM kegiatan ORDER BY tanggal ASC, jam ASC";
$result_kegiatan = mysqli_query($koneksi, $sql_kegiatan);
$total_kegiatan  = $result_kegiatan ? mysqli_num_rows($result_kegiatan) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Agenda / Jadwal Kegiatan Harian</title>
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
                <i class="fa-solid fa-calendar-check"></i>
                Agenda Kegiatan Harian
            </h1>
            <p>Catat dan kelola jadwal kegiatanmu setiap hari.</p>
        </header>

        <main class="app-main single-column">
            <section class="form-section">
                <h2>
                    <i class="fa-solid fa-plus-circle"></i>
                    Tambah Kegiatan
                </h2>

                <?php if ($pesan_sukses != "") { ?>
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        <?php echo $pesan_sukses; ?>
                    </div>
                <?php } ?>

                <?php if ($pesan_error != "") { ?>
                    <div class="alert alert-error">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <?php echo $pesan_error; ?>
                    </div>
                <?php } ?>

                <form action="" method="POST" class="form-kegiatan">
                    <div class="form-group">
                        <label for="judul">
                            Judul Kegiatan <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            value="<?php echo $judul; ?>"
                            placeholder="Contoh: Belajar PHP, Meeting tim, dll"
                            required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="tanggal">
                                Tanggal <span class="required">*</span>
                            </label>
                            <input
                                type="date"
                                name="tanggal"
                                id="tanggal"
                                value="<?php echo $tanggal; ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="jam">
                                Jam <span class="required">*</span>
                            </label>
                            <input
                                type="time"
                                name="jam"
                                id="jam"
                                value="<?php echo $jam; ?>"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prioritas">Prioritas</label>
                        <select name="prioritas" id="prioritas">
                            <option value=""
                                <?php if ($prioritas == "") { echo "selected"; } ?>>
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
                        <textarea
                            name="deskripsi"
                            id="deskripsi"
                            rows="3"
                            placeholder="Tambahkan detail kegiatan, lokasi, dll"><?php echo $deskripsi; ?></textarea>
                    </div>

                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Kegiatan
                    </button>
                </form>
            </section>

            <section class="list-section">
                <h2>
                    <i class="fa-solid fa-list-check"></i>
                    Daftar Kegiatan
                </h2>

                <p class="empty-text info-count">
                    <i class="fa-regular fa-clock"></i>
                    Total kegiatan terdaftar:
                    <strong><?php echo $total_kegiatan; ?></strong>
                </p>

                <?php
                if ($result_kegiatan && $total_kegiatan > 0) {
                ?>
                    <div class="table-wrapper">
                        <table class="table-kegiatan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Prioritas</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result_kegiatan)) {
                                    $tanggal_tampil = date("d-m-Y", strtotime($row['tanggal']));
                                    $jam_tampil     = substr($row['jam'], 0, 5);

                                    $badge = "";
                                    if ($row['prioritas'] == "tinggi") {
                                        $badge = "<span class='badge badge-high'>Tinggi</span>";
                                    } elseif ($row['prioritas'] == "sedang") {
                                        $badge = "<span class='badge badge-medium'>Sedang</span>";
                                    } elseif ($row['prioritas'] == "rendah") {
                                        $badge = "<span class='badge badge-low'>Rendah</span>";
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['judul']; ?></td>
                                        <td><?php echo $tanggal_tampil; ?></td>
                                        <td><?php echo $jam_tampil; ?></td>
                                        <td><?php echo $badge; ?></td>
                                        <td>
                                            <?php
                                            if ($row['deskripsi'] != "") {
                                                echo nl2br($row['deskripsi']);
                                            }
                                            ?>
                                        </td>
                                        <td class="aksi">
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </a>
                                            <a
                                                href="delete.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus kegiatan ini?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                } else {
                ?>
                    <p class="empty-text">
                        <i class="fa-regular fa-circle-check"></i>
                        Belum ada kegiatan. Silakan tambahkan kegiatan baru di form di atas.
                    </p>
                <?php
                }
                ?>
            </section>
        </main>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
