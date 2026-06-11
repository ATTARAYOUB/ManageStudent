# � School Management System

A full-featured school management web application built with **Laravel 12**, **Bootstrap 5**, and **MySQL**. Manage students, teachers, courses, enrollments, and grades — with role-based access control, live search, and interactive charts.

---

## ✨ Features

| Feature | Description |
|---|---|
| **Role-based access** | Admin (full control) and Teacher (read-only, own students) |
| **Students** | CRUD, photo upload, section assignment, teacher linking |
| **Teachers** | CRUD, auto-created login account, subject management |
| **Courses** | CRUD, schedule & room tracking, student enrollment |
| **Grades** | Enter grades 0–20 per student per course, auto letter grade |
| **Administrators** | CRUD, full system access accounts |
| **Dashboard** | Live stat cards, Bar chart (students/section), Doughnut chart (enrollments/course) |
| **Live Search** | Instant table filtering + suggestion dropdown on all list pages |
| **User Guide** | Dedicated `/help` page with full documentation |
| **Pagination** | Custom styled pagination on all list pages |

---

## �️ Tech Stack

- **Backend:** PHP 8.2, Laravel 12
- **Frontend:** Blade templates, Bootstrap 5, Font Awesome 5, Chart.js 4
- **Database:** MySQL (via XAMPP)
- **Auth:** Laravel Breeze (session-based)

---

## ⚙️ Requirements

- PHP 8.2+
- Composer
- MySQL (XAMPP recommended)
- Node.js (only if you want to rebuild frontend assets)

---

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/ManageStudent.git
cd ManageStudent
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Copy environment file and configure

```bash
cp .env.example .env
```

Open `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ManageStudent
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate app key

```bash
php artisan key:generate
```

### 5. Create the database

Open **phpMyAdmin** (or MySQL CLI) and create a database named `ManageStudent`.

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Seed the database (optional — creates sample admin + data)

```bash
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=SampleDataSeeder
```

Default admin credentials after seeding:
- **Email:** `admin@school.com`
- **Password:** `password`

### 8. Start the server

```bash
php artisan serve
```

Visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/        # StudentController, TeacherController, CourseController, etc.
│   ├── Middleware/          # RoleMiddleware (admin / teacher)
│   └── Requests/
├── Models/                 # Student, Teacher, Course, Enrollment, Administrator, User
resources/
└── views/
    ├── students/           # index, create, edit, show
    ├── teachers/           # index, create, edit, show
    ├── courses/            # index, create, edit, show
    ├── administrators/     # index, create, edit, show
    ├── dashboard.blade.php
    ├── help.blade.php      # User Guide page
    └── layout.blade.php    # Main layout with navbar & sidebar
routes/
└── web.php                 # All application routes
```

---

## 👤 User Roles

| Role | Access |
|---|---|
| **Admin** | Full CRUD on all entities, manage grades, view all charts |
| **Teacher** | View own students & courses only, cannot create/delete |

---

## 📊 Grade Scale

| Grade | Score |
|---|---|
| A+ | 18 – 20 |
| A  | 16 – 17.5 |
| B  | 14 – 15.5 |
| C  | 12 – 13.5 |
| D  | 10 – 11.5 |
| F  | 0 – 9.5 |

---

## 📸 Screenshots

<img width="1887" height="886" alt="Screenshot 2026-06-11 202907" src="https://github.com/user-attachments/assets/aad8274d-8b07-4623-b7bb-525a80c819bd" />
<img width="1918" height="917" alt="Screenshot 2026-06-11 202847" src="https://github.com/user-attachments/assets/73e0531a-bccd-4bf1-ae9e-e2b210d7f329" />
<img width="1918" height="953" alt="Screenshot 2026-06-11 202829" src="https://github.com/user-attachments/assets/7785bb0b-6a37-4ca9-b05f-f03b39b6666d" />
<img width="402" height="298" alt="Screenshot 2026-06-11 202757" src="https://github.com/user-attachments/assets/d4eb8b84-90fd-4ea1-bb64-a70b37bb2318" />
<img width="1918" height="481" alt="Screenshot 2026-06-11 202750" src="https://github.com/user-attachments/assets/d6cec07e-f8d0-47e1-af77-169a0bcba1d8" />
<img width="1832" height="890" alt="Screenshot 2026-06-11 202729" src="https://github.com/user-attachments/assets/156c55a0-761f-47d1-8252-c5c5b30244dd" />
<img width="1913" height="908" alt="Screenshot 2026-06-11 200658" src="https://github.com/user-attachments/assets/149becb2-7221-465b-bbb6-7a9a7178108b" />
<img width="1918" height="966" alt="Screenshot 2026-06-11 203044" src="https://github.com/user-attachments/assets/3173e9c8-5bb6-4f33-9aea-9d5a0653ce72" />
<img width="1913" height="913" alt="Screenshot 2026-06-11 203001" src="https://github.com/user-attachments/assets/39ba7700-6ec1-4a04-8f02-8ce1f468a9fc" />
<img width="1917" height="917" alt="Screenshot 2026-06-11 202946" src="https://github.com/user-attachments/assets/25ec9cbb-b070-4eee-b4fd-fe98eef93486" />
<img width="1918" height="847" alt="Screenshot 2026-06-11 202926" src="https://github.com/user-attachments/assets/307c563c-077b-4df0-b04b-b48b366258f9" />

---

## 🤝 Author

**ATTAR AYOUB**  
Laravel Developer  

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
