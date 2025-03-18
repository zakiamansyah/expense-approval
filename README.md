# Expense Approval System

Expense Approval System adalah aplikasi berbasis Laravel untuk mengelola proses persetujuan pengeluaran dengan beberapa tahap persetujuan. Proyek ini mendukung dokumentasi API menggunakan Swagger dan pengujian otomatis menggunakan PHPUnit.

---

## Fitur Utama
- Menambahkan approver.
- Menambahkan tahap approval.
- Menambahkan pengeluaran.
- Menyetujui pengeluaran berdasarkan tahap approval.
- Dokumentasi API menggunakan Swagger UI.
- Pengujian otomatis menggunakan PHPUnit.

---

## Persyaratan Sistem
- PHP >= 8.0
- Composer
- MySQL
- Laravel >= 9.x

---

## 📌 Instalasi
1. Clone repository:
    ```sh
    git clone https://github.com/username/expense-approval.git
    cd expense-approval
    ```
2. Install dependencies:
    ```sh
    composer install
    ```
3. Copy file `.env`:
    ```sh
    cp .env.example .env
    ```
4. Konfigurasi database di `.env`
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=expense_approval
    DB_USERNAME=root
    DB_PASSWORD=
    ```
5. Generate app key:
    ```sh
    php artisan key:generate
    ```
6. Jalankan migration:
    ```sh
    php artisan migrate
    ```

## 🚀 Menjalankan Aplikasi
```sh
php artisan serve
```
Akses API di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 📖 Dokumentasi API dengan Swagger
```sh
php artisan l5-swagger:generate
```
Akses Swagger UI di: [http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)

## ✅ Menjalankan PHPUnit Test dengan Database Testing
```sh
php artisan migrate --env=testing
php artisan test
```

## 📖 Dokumentasi API

Dokumentasi API dibuat menggunakan Swagger. Berikut adalah beberapa endpoint utama yang tersedia:

### Approver
- **POST** `/api/v1/approvers`  
     Menambahkan approver baru.

### Approval Stages
- **POST** `/api/v1/approval-stages`  
     Menambahkan tahap approval baru.

### Expense
- **POST** `/api/v1/expense`  
     Menambahkan pengeluaran baru.
- **PATCH** `/api/v1/expense/{id}/approve`  
     Menyetujui pengeluaran berdasarkan ID.
- **GET** `/api/v1/expense/{id}`  
     Mengambil detail pengeluaran berdasarkan ID.

---

## Struktur Proyek

1. **app/Http/Controllers**  
    Berisi controller untuk menangani request API. Controller hanya bertanggung jawab untuk menerima request, memvalidasi input, dan memanggil repository untuk logika bisnis.

2. **app/Http/Requests**  
    Berisi FormRequest untuk validasi input. Setiap endpoint yang memerlukan validasi memiliki FormRequest sendiri.

3. **app/Models**  
    Berisi model untuk tabel database. Model digunakan untuk mendefinisikan relasi antar tabel dan properti yang dapat diisi (fillable).

4. **app/Repositories**  
    Berisi repository untuk mengelola logika akses data. Setiap model memiliki repository sendiri. Contoh:
    - ApproverRepository: Mengelola data approver.
    - ApprovalStageRepository: Mengelola data tahap approval.
    - ExpenseRepository: Mengelola data pengeluaran.
    - ApprovalRepository: Mengelola data persetujuan.

5. **routes/api.php**  
    Berisi definisi rute API. Rute memetakan URL ke controller yang sesuai.

6. **tests/Feature**  
    Berisi pengujian fungsional menggunakan PHPUnit. Pengujian ini memastikan bahwa semua fitur berjalan sesuai dengan aturan yang telah ditentukan.