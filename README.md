# 🍽️ Restaurant Manager

A Laravel restaurant management application with meal and category administration, user authentication, MongoDB Atlas integration, Docker support, and Vercel deployment configuration.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-47A248?style=flat-square&logo=mongodb&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=flat-square&logo=docker&logoColor=white)
![Vercel](https://img.shields.io/badge/Vercel-000000?style=flat-square&logo=vercel&logoColor=white)

## ✨ Features

- 🔐 Authentication (login, register, logout)
- 🍽️ Meal management — create, edit, delete, and view meals
- 📂 Category management for organizing meals
- 🗄️ MongoDB Atlas as the database backend
- 🐳 Docker support for containerized deployment
- 🚀 Vercel deployment configuration

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 10+ |
| Templates | Blade |
| Database | MongoDB Atlas (via mongodb driver) |
| Deployment | Docker, Vercel |

## 🚀 Getting Started

```bash
git clone https://github.com/AbanobGeorgeSamir/Restaurant.git
cd Restaurant

cp .env.example .env
# Set DB_CONNECTION=mongodb, MONGODB_URI, DB_DATABASE

composer install
npm install
php artisan key:generate
php artisan serve
npm run dev
```

**Or with Docker:**
```bash
docker compose up --build
```

## 👤 Author

**Abanoub George Samir** — [LinkedIn](https://www.linkedin.com/in/abanob-george-samir) · [GitHub](https://github.com/AbanobGeorgeSamir)