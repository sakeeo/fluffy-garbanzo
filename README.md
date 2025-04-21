# 🔐 PHP Brute Force Login & Directory (Educational Purposes Only)

Repository ini berisi dua skrip PHP sederhana untuk melakukan **simulasi brute force login** dan **brute force direktori** pada aplikasi berbasis web. Skrip ini hanya ditujukan untuk **tujuan edukasi dan pengujian keamanan di lingkungan yang aman atau laboratorium pribadi**.

> ⚠️ Harap digunakan secara etis. Dilarang digunakan terhadap sistem yang tidak kamu miliki atau tidak memiliki izin eksplisit.

---

## 📂 Isi Repository

- `bf_pass.php` – Skrip untuk brute force login (form login).
- `bf_dir.php` – Skrip untuk brute force direktori (mendeteksi folder tersembunyi).
- `passwordlist.txt` – Wordlist yang digunakan oleh kedua skrip.

---

## 🚀 Cara Menggunakan

### 1. Clone Repository

```bash
git clone https://github.com/sakeeo/fluffy-garbanzo.git
cd fluffy-garbanzo
```

---

### 2. Jalankan Brute Force Directory

```bash
php bf_dir.php
```

Skrip ini akan:

- Membaca wordlist dari `passwordlist.txt`
- Menyusun URL target direktori berdasarkan isi wordlist
- Mengecek status HTTP untuk melihat apakah direktori tersebut ada (200/301/403)

---

### 3. Jalankan Brute Force Login

```bash
php bf_pass.php
```

Skrip ini akan:

- Mengirim permintaan login ke form target
- Menggunakan username yang ditentukan (default: `admin`)
- Mencoba password dari `passwordlist.txt`
- Mendeteksi keberhasilan login berdasarkan respon halaman (misalnya mengandung teks `Selamat datang` atau status `302` redirect)

---

## 🧪 Contoh Wordlist (`passwordlist.txt`)

```
123456
admin
admin123
qwerty
password
letmein
test123
```

---

## ⚙️ Konfigurasi Manual

Jika kamu ingin mengubah URL target login atau deteksi keberhasilan:

### Ubah URL dan username di `bf_pass.php`:

```php
$loginUrl = "http://localhost/simulasi-traversal/login.php";
$username = "admin";
```

### Ubah pola deteksi sukses login:

```php
if (strpos($response, "Selamat datang") !== false || $httpCode == 302)
```

---

## 📌 Catatan Tambahan

- Untuk skrip login, pastikan kamu tahu nama field `username` dan `password` yang digunakan pada form login target.
- Untuk skrip direktori, pastikan server web aktif dan bisa diakses dari PHP script ini.

---

## 📜 Lisensi

MIT License — Bebas digunakan untuk pembelajaran dan pengujian etis.

---

## ✍️ Author

- [sakeeo](https://github.com/sakeeo)
