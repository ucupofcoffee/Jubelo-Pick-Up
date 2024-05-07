# Jubelo-Pick-Up

Deskripsi
Tulis deskripsi singkat tentang proyek Anda di sini.

Instalasi
Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda.

Prasyarat
Pastikan Anda telah menginstal PHP, Composer, dan MySQL di sistem Anda sebelum melanjutkan.

Langkah 1: Clone repositori
Clone repositori ini ke dalam direktori lokal Anda.

bash
Copy code
git clone https://github.com/nama-username/nama-proyek.git
Langkah 2: Install dependensi
Masuk ke direktori proyek dan instal dependensi dengan Composer.

bash
Copy code
cd nama-proyek
composer install
Langkah 3: Konfigurasi Lingkungan
Salin file .env.example menjadi .env. Kemudian, atur koneksi basis data dan konfigurasi lain yang diperlukan di dalamnya.

bash
Copy code
cp .env.example .env
Langkah 4: Generate Key
Generate kunci aplikasi baru.

bash
Copy code
php artisan key:generate
Langkah 5: Jalankan Migrasi
Jalankan migrasi untuk membuat skema basis data.

bash
Copy code
php artisan migrate
Langkah 6: Jalankan Server
Terakhir, jalankan server Laravel.

bash
Copy code
php artisan serve
Sekarang Anda dapat mengakses proyek Laravel Anda di http://localhost:8000.
