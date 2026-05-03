# 🏫 School Management System
### Built with Laravel + React

A full-featured multi-tenant School Management System 
built from scratch using Laravel 11 and React.js.

---

## 🚀 Features

- ✅ Multi-School (Tenant) Architecture
- ✅ Role-Based Access Control
  - Super Admin
  - School Admin  
  - Teacher
  - Student
  - Parent
- ✅ Student Management (Full CRUD)
- ✅ Teacher Management (Full CRUD)
- ✅ Course & Enrollment Management
- ✅ Attendance Tracking
- ✅ Marks & Result Sheet
- ✅ Notice Board
- ✅ Separate Dashboards per Role
- ✅ Secure Authentication System
- ✅ Modern Responsive UI

---

## 🛠️ Tech Stack

| Layer     | Technology              |
|-----------|-------------------------|
| Backend   | Laravel 11, PHP 8       |
| Frontend  | React.js, Inertia.js    |
| Database  | MySQL                   |
| Styling   | Bootstrap 5, CSS        |
| Auth      | Laravel Breeze          |

---

## ⚙️ Installation

```bash
# 1. Clone the project
git clone https://github.com/fayazahmedsaand123/school-management-system.git

# 2. Go to project folder
cd school-management-system

# 3. Install PHP dependencies
composer install

# 4. Install Node dependencies
npm install

# 5. Copy environment file
cp .env.example .env

# 6. Generate app key
php artisan key:generate

# 7. Setup your database in .env file
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 8. Run migrations
php artisan migrate

# 9. Run the project
php artisan serve
npm run dev
```

---

## 👨‍💻 Developer

**Fayaz Ahmed**
- GitHub: [@fayazahmedsaand123](https://github.com/fayazahmedsaand123)
- Email: Fayazahmedsaand@gmail.com

---

## 📄 License

This project is open source and available under the 
[MIT License](LICENSE).
