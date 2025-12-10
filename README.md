# Aplikasi Agenda / Jadwal Kegiatan Harian

Aplikasi web sederhana untuk mencatat dan mengelola jadwal kegiatan harian.  
Dibuat menggunakan **PHP + MySQL** dan berjalan di lingkungan **Laragon / XAMPP**.

---

## 🎯 Tujuan Aplikasi

- Mencatat kegiatan harian (belajar, meeting, kerja, dll).
- Menampilkan daftar kegiatan dalam bentuk tabel yang rapi.
- Memudahkan edit dan hapus kegiatan yang sudah tercatat.
- Memberi tanda prioritas kegiatan (rendah, sedang, tinggi).

---

## 🧩 Fitur Utama

- **Create** → Tambah kegiatan baru.
- **Read** → Lihat semua kegiatan dalam tabel.
- **Update** → Edit kegiatan tertentu.
- **Delete** → Hapus kegiatan dengan konfirmasi.
- Otomatis mengisi **tanggal hari ini** dan **jam sekarang** pada form.
- Badge warna berbeda untuk prioritas:
  - Merah = Tinggi
  - Kuning = Sedang
  - Hijau = Rendah

---

## 🛠 Teknologi yang Digunakan

- PHP (Native, tanpa framework)
- MySQL
- HTML
- CSS (custom, layout responsive sederhana)
- JavaScript (untuk auto tanggal & jam)
- Font Awesome (icon)

---

## 📂 Struktur Folder

```text
agenda-harian/
│
├─ index.php          -> Halaman utama (form tambah + daftar kegiatan)
├─ edit.php           -> Halaman edit kegiatan
├─ delete.php         -> Proses hapus kegiatan
│
├─ config/
│   └─ koneksi.php    -> Koneksi ke database MySQL
│
└─ assets/
    ├─ css/
    │   └─ style.css  -> Style tampilan aplikasi
    └─ js/
        └─ script.js  -> Auto isi tanggal & jam
