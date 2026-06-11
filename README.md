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

> Add screenshots here after deployment.

---

## 🤝 Author

**ATTAR AYOUB**  
Laravel Developer  

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
