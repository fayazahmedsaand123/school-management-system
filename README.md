# 🏫 Multitenant School Management System

A full-stack SaaS-style School Management System built with **Laravel 9** and **React (Inertia.js)**.
This project demonstrates real-world **multitenancy** using a shared database approach,
where each school (tenant) has its own isolated data using `tenant_id`.

## 🎯 Project Goal
To build a scalable school management platform where multiple schools
can independently manage their own students, teachers, courses and enrollments
— all from a single Laravel application.

## ✨ Features
- 🏫 Multiple Schools (Multitenancy with tenant_id)
- 👨‍🏫 Teacher Management (CRUD)
- 🧑‍🎓 Student Management (CRUD)
- 📚 Course Management (Assign Teachers to Courses)
- 📝 Enrollment System (Enroll Students to Courses)
- 📊 Dashboard with Live Stats
- 🔄 School Switching System
- 🔐 Authentication System (Login, Register, Logout)
- ⚡ Fast React Frontend with Inertia.js

## 🛠️ Tech Stack
| Technology | Purpose |
|------------|---------|
| Laravel 9 | Backend Framework |
| PHP | Server Language |
| MySQL | Database |
| React | Frontend UI |
| Inertia.js | SPA without API |
| Vite | Asset Bundler |
| Laravel Breeze | Authentication |

## 📦 Installation

```bash
# Clone the project
git clone https://github.com/fayazahmedsaand123/school-management-system.git

# Go to project folder
cd school-management-system

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Update .env with your database credentials
DB_DATABASE=school_management
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Run the app
npm run dev
php artisan serve
```

## 📸 Modules
- **Dashboard** — Live stats for schools, teachers, students, courses, enrollments
- **Schools** — Add and manage multiple schools (tenants)
- **Teachers** — Manage teachers per school
- **Students** — Manage students per school
- **Courses** — Assign teachers to courses
- **Enrollments** — Enroll students into courses

## 👨‍💻 Developer
**Fayaz Ahmed Saand**
- 📧 Email: Fayazahmedsaand@gmail.com
- 🐙 GitHub: [@fayazahmedsaand123](https://github.com/fayazahmedsaand123)
- 📍 Hyderabad, Sindh, Pakistan

## 📄 License
This project is open source and available under the [MIT License](LICENSE).
