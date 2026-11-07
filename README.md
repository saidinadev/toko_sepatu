# Langkah - Toko Sepatu Online (E-Commerce)

Proyek e-commerce toko sepatu berbasis PHP & MySQL, dilengkapi halaman admin dengan fitur CRUD.

## Anggota Kelompok

| No | Nama Lengkap    | NIM        |
|----|-----------------|------------|
| 1  | Saidina Damsik  | 2522105090 |
| 2  | Mitha Rifanti   | 2522105067 |
| 3  | Irfan Mulyanto  | 2522105098 |

## Fitur

**Pelanggan:** daftar & masuk, lihat produk, keranjang, checkout, riwayat pesanan.

**Admin (`/admin`) - Fitur CRUD tabel master:**

| Tabel master | Create | Read | Update | Delete | File |
|---|---|---|---|---|---|
| `products` (Produk) | Tambah produk | Daftar produk | Edit produk | Hapus produk | `admin/index.php`, `admin/edit.php` |
| `categories` (Kategori) | Tambah kategori | Daftar kategori | Ubah nama | Hapus kategori | `admin/kategori.php` |

Admin juga dapat mengubah status pesanan masuk.

## Cara Pasang (XAMPP/Laragon)

1. Salin folder `toko-sepatu` ke `htdocs`, nyalakan Apache dan MySQL.
2. Impor `database.sql` lewat phpMyAdmin.
3. Sesuaikan user/password MySQL di `config.php`.
4. Buka `http://localhost/toko-sepatu`.

Akun admin: `admin@toko.test` / `admin123` (segera ganti password).
