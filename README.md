# NAPEC Feedback

Aplikasi feedback pengunjung berbasis **Laravel 13** dengan **MySQL** sebagai database untuk menyimpan data feedback.

## Fitur

- Landing page dengan pilihan bahasa English dan French.
- Form feedback dalam bahasa English dan French.
- Validasi input menggunakan Laravel.
- CSRF protection untuk keamanan form.
- Token form untuk membantu mencegah pengiriman ganda.
- Rate limiting pada pengiriman feedback.
- Penyimpanan data feedback ke database MySQL.
- Halaman sukses setelah feedback berhasil dikirim.

## Teknologi

- **Backend:** Laravel 13
- **Bahasa pemrograman:** PHP 8.3+
- **Database:** MySQL / MariaDB yang kompatibel
- **Database management:** phpMyAdmin atau MySQL Workbench

## Persyaratan Sistem

Pastikan perangkat sudah memiliki:

- PHP 8.3 atau versi yang kompatibel dengan Laravel 13.
- Composer.
- MySQL atau MariaDB yang kompatibel.
- Extension PHP `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, dan `xml`.

## Instalasi

### 1. Clone repository

```bash
git clone https://github.com/bintangputrimhrn/Napec-Pertamina.git
cd Napec-Pertamina
```

Jika repository sudah tersedia di komputer, langsung buka folder proyek melalui terminal.

### 2. Install dependency

```bash
composer install
```

### 3. Konfigurasi environment

Buat file `.env` berdasarkan `.env.example`:

**PowerShell:**

```powershell
Copy-Item .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Buat database MySQL

Buat database dengan nama `napec_feedback` melalui phpMyAdmin atau MySQL:

```sql
CREATE DATABASE napec_feedback
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=napec_feedback
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan konfigurasi MySQL di perangkat masing-masing.

### 5. Jalankan migration

```bash
php artisan migrate
```

Perintah ini membuat tabel database berdasarkan migration yang tersedia di proyek.

Data feedback disimpan pada tabel:

```text
feedback_submissions
```

### 6. Jalankan aplikasi

```bash
php artisan serve
```

Buka alamat berikut di browser:

http://127.0.0.1:8000

## Melihat Data Feedback

Data feedback dapat dilihat melalui phpMyAdmin atau MySQL Workbench.

Jika menggunakan XAMPP:

1. Jalankan MySQL melalui XAMPP Control Panel.
2. Buka phpMyAdmin.
3. Pilih database `napec_feedback`.
4. Buka tabel `feedback_submissions`.
5. Lihat data feedback yang telah dikirim oleh pengunjung.

## Export dan Backup Database

Data dapat diunduh langsung melalui phpMyAdmin.

### Export database sebagai SQL

1. Pilih database `napec_feedback`.
2. Buka menu **Export**.
3. Pilih format SQL.
4. Jalankan export untuk mengunduh file backup.

File SQL dapat digunakan untuk memulihkan database melalui proses import.

### Export data feedback sebagai CSV

1. Pilih tabel `feedback_submissions`.
2. Buka menu **Export**.
3. Pilih format CSV.
4. Jalankan export.

File CSV dapat dibuka menggunakan Microsoft Excel atau aplikasi spreadsheet lainnya.

## Struktur Data

Tabel `feedback_submissions` digunakan untuk menyimpan data feedback, meliputi:

- Informasi pengunjung: `name`, `company_name`, `email`, dan `job_title`.
- Bahasa form: `language`.
- Sumber informasi: `heard_from` dan `heard_from_other`.
- Penilaian booth dan perwakilan: `booth_rating`, `booth_design`, `attention_aspect`, `attention_aspect_other`, dan `representative_rating`.
- Tanggapan pengunjung: `learned_something`, `improvements`, `interested_products`, `presentation_feedback`, `overall_satisfaction`, `recommendation`, dan `additional_comments`.
- Timestamp: `created_at` dan `updated_at`.

## Reset Database untuk Development

Untuk menghapus seluruh data pada tabel dan menjalankan ulang semua migration:

```bash
php artisan migrate:fresh
```

**Perhatian:** Perintah tersebut menghapus tabel beserta seluruh data yang tersimpan di database. Gunakan hanya jika memang ingin mengatur ulang database development.

## Repository

GitHub: https://github.com/bintangputrimhrn/Napec-Pertamina