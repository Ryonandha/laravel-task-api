# Laravel Task Manager API

RESTful API untuk manajemen tugas harian: CRUD lengkap, autentikasi Sanctum, filtering & pagination. Dibangun untuk mendemonstrasikan arsitektur backend Laravel yang bersih dan terstruktur.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP_8.3-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-000000?logo=mysql&logoColor=white)

## Endpoint

| Method | Endpoint | Deskripsi |
|---|---|---|
| POST | `/api/register` | Registrasi user |
| POST | `/api/login` | Login → dapatkan token |
| GET | `/api/tasks` | Daftar tugas (filter: status, search, pagination) |
| POST | `/api/tasks` | Buat tugas baru |
| GET | `/api/tasks/{id}` | Detail tugas |
| PUT | `/api/tasks/{id}` | Update tugas |
| DELETE | `/api/tasks/{id}` | Hapus tugas |

Semua endpoint butuh token `Authorization: Bearer <token>` kecuali register & login.

## Menjalankan lokal

```bash
git clone https://github.com/Ryonandha/laravel-task-api.git
cd laravel-task-api
composer install
cp .env.example .env && php artisan key:generate
# atur DB_CONNECTION, DB_DATABASE, dll. di .env
php artisan migrate --seed
php artisan serve
```

Test via Postman/Insomnia: import `postman/collection.json` (tersedia di repo).

---

Dibuat oleh [Ryonandha](https://github.com/Ryonandha) · 2026