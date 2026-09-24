# Portofolio Sapar

![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-5.6-FDAE4B)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-8-646CFF?logo=vite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)

Aplikasi web portofolio pribadi yang terdiri dari halaman publik yang responsif dan panel admin untuk mengelola seluruh konten secara dinamis, mulai dari profil, keahlian, proyek, sertifikat, layanan, galeri, hingga pesan masuk, tanpa perlu mengubah kode program.

---

## Daftar Isi

1. [Gambaran Umum](#gambaran-umum)
2. [Fitur Utama](#fitur-utama)
3. [Teknologi](#teknologi)
4. [Prasyarat](#prasyarat)
5. [Instalasi](#instalasi)
6. [Konfigurasi Environment](#konfigurasi-environment)
7. [Menjalankan Aplikasi](#menjalankan-aplikasi)
8. [Panel Admin](#panel-admin)
9. [Routing](#routing)
10. [Skema Database](#skema-database)
11. [Struktur Direktori](#struktur-direktori)
12. [Deployment](#deployment)
13. [Keamanan dan Catatan Konfigurasi](#keamanan-dan-catatan-konfigurasi)
14. [Lisensi](#lisensi)

---

## Gambaran Umum

Proyek ini dibangun dengan Laravel dan Filament. Konten pada halaman publik diambil dari database dan dikelola melalui panel admin, sehingga pembaruan portofolio dapat dilakukan kapan saja. Hanya data yang ditandai *visible* yang ditampilkan kepada pengunjung, dan urutan tampilnya dapat diatur.

## Fitur Utama

**Halaman Publik**

- Halaman utama satu halaman (*single page*) dengan section Home, About, Skills, Projects, Certificates, Services, dan Contact.
- Halaman galeri terpisah pada `/gallery`.
- Formulir kontak dengan validasi. Pesan disimpan ke database dan diteruskan melalui email SMTP.
- Data profil bawaan (*fallback*) ditampilkan bila profil belum diisi melalui panel admin.

**Panel Admin**

| Resource | Deskripsi |
| --- | --- |
| Profiles | Nama, jabatan, tentang, foto, tautan CV, media sosial, email, dan lokasi |
| Skills | Nama, logo, kategori, level, deskripsi, dan urutan tampil |
| Projects | Thumbnail, deskripsi, tautan GitHub dan demo, status, *featured*, serta relasi ke skill |
| Certificates | Nama, penerbit, gambar, tanggal terbit, ID dan URL kredensial, serta kategori |
| Services | Nama layanan, harga, ikon, deskripsi, dan urutan tampil |
| Galleries | Judul, deskripsi, gambar, dan urutan tampil |
| Messages | Pesan masuk dari formulir kontak beserta status baca |

## Teknologi

| Lapisan | Teknologi |
| --- | --- |
| Bahasa dan framework | PHP ^8.3, Laravel ^13.17 |
| Panel admin | Filament 5.6 |
| Frontend | Blade, Tailwind CSS ^4, Vite ^8 |
| Database | MySQL |
| Email | SMTP |
| Pengujian | PHPUnit ^12 |
| Standar kode | Laravel Pint |

## Prasyarat

- PHP 8.3 atau lebih baru dengan ekstensi `mbstring`, `openssl`, `pdo_mysql`, `fileinfo`, `intl`, dan `gd` (atau `imagick`)
- Composer 2
- Node.js dan npm
- MySQL atau MariaDB

## Instalasi

1. Clone repository dan masuk ke direktori proyek.

   ```bash
   git clone <url-repository>
   cd portofolio-sapar
   ```

2. Pasang dependensi PHP dan JavaScript.

   ```bash
   composer install
   npm install
   ```

3. Siapkan file environment dan buat application key.

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Bila `.env.example` tidak tersedia, gunakan contoh pada bagian [Konfigurasi Environment](#konfigurasi-environment).

4. Buat database kosong (misalnya `db_portofolio`), lalu jalankan migrasi.

   ```bash
   php artisan migrate
   ```

5. Hubungkan direktori storage agar berkas unggahan dapat diakses publik.

   ```bash
   php artisan storage:link
   ```

6. Build aset frontend.

   ```bash
   npm run build
   ```

7. Buat akun administrator.

   ```bash
   php artisan make:filament-user
   ```

## Konfigurasi Environment

Contoh konfigurasi minimum pada file `.env`:

```env
APP_NAME="Portofolio Sapar"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_portofolio
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
FILESYSTEM_DISK=public

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-anda@example.com
MAIL_PASSWORD=app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email-anda@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

> Bila menggunakan Gmail, gunakan **App Password** dan bukan kata sandi akun. Verifikasi dua langkah harus diaktifkan terlebih dahulu.

## Menjalankan Aplikasi

Mode pengembangan:

```bash
composer run dev
```

Atau jalankan secara terpisah pada dua terminal:

```bash
php artisan serve
npm run dev
```

| Halaman | URL |
| --- | --- |
| Website | http://127.0.0.1:8000 |
| Galeri | http://127.0.0.1:8000/gallery |
| Panel admin | http://127.0.0.1:8000/admin |

Menjalankan pengujian:

```bash
composer test
```

## Panel Admin

Panel admin tersedia di `/admin` dan hanya dapat diakses dengan akun yang telah dibuat. Alur pengisian konten yang disarankan:

1. **Profiles**: lengkapi data diri. Hanya profil pertama yang ditampilkan pada website.
2. **Skills**: tambahkan keahlian beserta logonya.
3. **Projects**: tambahkan proyek dan hubungkan dengan skill yang digunakan.
4. **Certificates, Services, Galleries**: lengkapi sesuai kebutuhan.
5. **Messages**: tinjau pesan yang masuk dari pengunjung.

Kolom `is_visible` dan `display_order` mengatur tampil atau tidaknya sebuah data serta urutan tampilnya.

## Routing

| Method | URI | Keterangan |
| --- | --- | --- |
| GET | `/` | Halaman utama portofolio |
| POST | `/contact/send` | Mengirim pesan dari formulir kontak |
| GET | `/gallery` | Halaman galeri |
| GET | `/login` | Pengalihan ke `/admin/login` |
| ANY | `/admin/*` | Panel admin Filament |

## Skema Database

| Tabel | Kolom utama |
| --- | --- |
| `profiles` | name, title, about, short_description, full_description, avatar, photo, cv_link, github_url, linkedin_url, instagram_url, email, location |
| `skills` | name, logo, image, category, level, description, display_order, is_visible |
| `projects` | name, thumbnail, description, github_url, demo_url, status, featured, display_order, is_visible |
| `project_skill` | project_id, skill_id (tabel pivot) |
| `certificates` | name, issuer, image, issue_date, credential_id, credential_url, category, is_visible |
| `services` | name, description, price, icon, display_order, is_visible |
| `galleries` | title, description, image, display_order, is_visible |
| `messages` | name, email, subject, message, is_read |

Relasi: `Project` dan `Skill` memiliki hubungan *many-to-many* melalui tabel `project_skill`.

## Struktur Direktori

```text
portofolio-sapar/
├── app/
│   ├── Filament/Admin/Resources/   # Resource panel admin
│   ├── Http/Controllers/           # HomeController, ContactController
│   ├── Mail/                       # ContactFormMail
│   ├── Models/                     # Model Eloquent
│   └── Providers/Filament/         # Konfigurasi AdminPanelProvider
├── database/
│   ├── migrations/                 # Skema database
│   └── seeders/
├── public/                         # Entry point dan aset hasil build
├── resources/
│   ├── css/
│   ├── js/
│   └── views/                      # welcome, gallery, layout, template email
├── routes/web.php
├── storage/app/public/             # Berkas unggahan
└── tests/
```

## Deployment

Langkah umum untuk lingkungan produksi:

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build

php artisan migrate --force
php artisan storage:link

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Pada `.env` produksi, pastikan:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com
```

Arahkan *document root* web server ke direktori `public/`. Bila `QUEUE_CONNECTION=database` dan email dikirim melalui antrean, jalankan worker dengan `php artisan queue:work` (disarankan dikelola oleh Supervisor).

## Keamanan dan Catatan Konfigurasi

- File `.env` berisi kredensial dan tidak boleh di-commit ke repository. File ini sudah tercantum pada `.gitignore`.
- Alamat penerima email formulir kontak saat ini ditulis langsung pada `HomeController::sendMessage()`. Disarankan memindahkannya ke variabel environment atau file konfigurasi.
- Aktifkan `APP_DEBUG=false` pada lingkungan produksi.
- Gunakan kata sandi yang kuat untuk akun administrator.

## Lisensi

Proyek ini dibuat untuk keperluan portofolio pribadi. Framework Laravel dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## Penulis

**Sapar Hidayat. S**