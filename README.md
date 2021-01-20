# MoneyLaundry

## Requirement

1. Git [Download Git](https://git-scm.com/downloads)
2. Composer [Download Composer](https://getcomposer.org/download/)
3. XAMPP atau sejenisnya [Download XAMPP](https://www.apachefriends.org/download.html)
4. PHP versi ^7.3 atau ^8.0
5. Internet

## Installation

1. Buka Command Prompt / Terminal
2. Pilih directory penyimpanan pada Command Prompt / Terminal contoh:
   - Di macOS
    ```bash
    cd /Applications/XAMPP/xamppfiles/htdocs
    ```
   - Di Windows
    ```bash
    cd C:/xampp/htdocs
    ```
3. Jalankan perintah di Command Prompt / Terminal
```bash
git clone https://github.com/K0Z1/MoneyLaundry.git
```
4. Ubah directory di Command Prompt / Terminal ke MoneyLaundry
```bash
cd MoneyLaundry
```
5. Jalankan perintah di Command Prompt / Terminal
```bash
composer update --ignore-platform-reqs
```
6. Buka aplikasi XAMPP
7. Start server mysql dan apache di XAMPP
8. Buat database di mysql atau sejenisnya dengan nama `db_laundry`
9. Buka Folder Project `MoneyLaundry` copy `.env.example` lalu pastekan ubah nama menjadi `.env` pastikan type filenya adalah `env`
10. Edit file `.env` dengan text editor cari :
    - `DB_DATABASE=db_laundry` (isi nama database), 
    - `DB_USERNAME=root` (isi username database), 
    - `DB_PASSWORD=` (isi dengan password database)
11. Jalankan perintah di Command Prompt / Terminal
```bash
php artisan migrate
```
12. Jalankan perintah di Command Prompt / Terminal
```bash
php artisan db:seed
```
13. Jalankan perintah di Command Prompt / Terminal
```bash
php artisan key:generate
```
14. Jalankan perintah di Command Prompt / Terminal
```bash
php artisan serve
```

## Usage

1. Buka browser masukkan url `127.0.0.1:8000` atau `url` yang ditampilkan pada Command Prompt / Terminal
2. Masukkan nama pengguna `admin` dan password `admin` untuk login sebagai admin
3. Masukkan nama pengguna `owner` dan password `owner` untuk login sebagai owner
4. Masukkan nama pengguna `kasir` dan password `kasir` untuk login sebagai kasir