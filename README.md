# NAPEC Feedback — Laravel 13 + MySQL

Versi ini **hanya menggunakan MySQL sebagai penyimpanan data**. Tidak ada Google API, Google Sheets, halaman admin, atau fitur export dari website.

Data feedback disimpan di tabel:

```text
feedback_submissions
```

Untuk mengunduh/cadangkan data, gunakan langsung tool database seperti **phpMyAdmin** atau **MySQL Workbench**. Dengan begitu website tetap sederhana dan database menjadi sumber data utama.

## Fitur website

- Landing page pilihan bahasa: English / France
- Form feedback English dan French
- Validasi Laravel
- CSRF protection
- Token per form untuk mencegah double submit
- Rate limiting submit feedback
- Penyimpanan langsung ke MySQL
- Halaman sukses setelah submit
- Tidak ada halaman admin
- Tidak ada Google API
- Tidak ada Google Sheets
- Tidak ada dependency Excel/PhpSpreadsheet

## 1. Persyaratan

- PHP 8.3+
- Composer
- MySQL 8+ / MariaDB yang kompatibel
- Extension PHP `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `xml`

## 2. Install

Ekstrak ZIP lalu:

```powershell
cd napec-feedback-mysql-final
composer install
```

Buat `.env`:

```powershell
Copy-Item .env.example .env
```

Generate application key:

```powershell
php artisan key:generate
```

## 3. Database MySQL

Buat database:

```sql
CREATE DATABASE napec_feedback CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Isi `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=napec_feedback
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian jalankan:

```powershell
php artisan migrate
```

Tabel feedback yang dibuat:

```text
feedback_submissions
```

## 4. Jalankan website

```powershell
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

Pengunjung hanya berinteraksi dengan halaman form. Tidak ada halaman admin.

## 5. Melihat data melalui MySQL / phpMyAdmin

Jika menggunakan XAMPP:

1. Buka XAMPP.
2. Start **Apache** dan **MySQL**.
3. Buka phpMyAdmin.
4. Pilih database `napec_feedback`.
5. Pilih tabel `feedback_submissions`.
6. Data seluruh pengunjung akan terlihat di sana.

## 6. Download / export data langsung dari database

### Export seluruh database sebagai SQL

Di phpMyAdmin:

```text
napec_feedback
→ Export
→ Quick
→ SQL
→ Export
```

File `.sql` tersebut merupakan backup database dan dapat di-import kembali ke MySQL.

### Export data feedback sebagai CSV

Di phpMyAdmin:

```text
napec_feedback
→ feedback_submissions
→ Export
→ pilih format CSV
→ Export
```

File CSV dapat dibuka menggunakan Microsoft Excel.

Jadi website **tidak memiliki tombol download/export**. Pengelolaan dan pengunduhan data dilakukan langsung dari MySQL/phpMyAdmin.

## 7. Struktur data

Tabel `feedback_submissions` menyimpan:

- language
- name
- company_name
- email
- job_title
- heard_from
- heard_from_other
- booth_rating
- booth_design
- attention_aspect
- attention_aspect_other
- representative_rating
- learned_something
- improvements
- interested_products
- presentation_feedback
- overall_satisfaction
- recommendation
- additional_comments
- created_at
- updated_at

## 8. Reset database saat development

Untuk menghapus seluruh data dan membuat tabel ulang:

```powershell
php artisan migrate:fresh
```

