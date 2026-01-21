# 🚀 Laravel Task Manager API

Restful API sederhana namun powerful untuk manajemen tugas harian. Proyek ini dibangun untuk mendemonstrasikan kemampuan pengembangan Backend menggunakan **Laravel**, arsitektur **REST API**, dan manajemen **Database Relasional**.

## 🛠 Teknologi yang Digunakan

- **Framework:** Laravel 10/11
- **Language:** PHP 8.x
- **Database:** MySQL
- **Tools:** Postman (untuk testing), Git

## 📝 Fitur & Roadmap

Berikut adalah status pengembangan fitur saat ini:

- [x] **Setup Project & Database** (Migrations)
- [x] **Task Management (CRUD)**
    - [x] Melihat daftar tugas (`GET`)
    - [x] Membuat tugas baru (`POST`)
    - [x] Detail tugas spesifik (`GET`)
    - [x] Update tugas (`PUT`)
    - [x] Hapus tugas (`DELETE`)
- [ ] **Kategori Tugas** (Relasi One-to-Many)
- [ ] **Authentication** (Register & Login dengan Sanctum)
- [ ] **Filter & Sorting** (Filter berdasarkan status/kategori)
- [ ] **API Documentation**

## 🔌 Dokumentasi Endpoint (Sementara)

| Method   | Endpoint          | Deskripsi                  | Status   |
| :------- | :---------------- | :------------------------- | :------- |
| `GET`    | `/api/tasks`      | Mengambil semua data tugas | ✅ Ready |
| `POST`   | `/api/tasks`      | Membuat tugas baru         | ✅ Ready |
| `GET`    | `/api/tasks/{id}` | Melihat detail 1 tugas     | ✅ Ready |
| `PUT`    | `/api/tasks/{id}` | Update data tugas          | ✅ Ready |
| `DELETE` | `/api/tasks/{id}` | Menghapus tugas            | ✅ Ready |

## 💻 Cara Menjalankan Project (Installation)

Jika Anda ingin mencoba menjalankan project ini di lokal:

1.  **Clone Repository**

    ```bash
    git clone [https://github.com/Ryonandha/laravel-task-api.git](https://github.com/Ryonandha/laravel-task-api.git)
    cd laravel-task-api
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    ```

3.  **Setup Environment**
    - Duplikat file `.env.example` menjadi `.env`.
    - Sesuaikan konfigurasi database (DB_DATABASE, DB_USERNAME, dll).

4.  **Generate Key & Migrate**

    ```bash
    php artisan key:generate
    php artisan migrate
    ```

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

---

_Dibuat sebagai bagian dari latihan portofolio Backend Developer._
