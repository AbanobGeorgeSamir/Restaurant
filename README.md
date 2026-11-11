# Restaurant Manager

Laravel restaurant management application with meal and category administration, user accounts and a MongoDB Atlas database. It ships with Docker support and a Vercel deployment configuration.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-47A248?style=flat-square&logo=mongodb&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=flat-square&logo=docker&logoColor=white)
![Vercel](https://img.shields.io/badge/Vercel-000000?style=flat-square&logo=vercel&logoColor=white)

<!-- Add screenshots here, for example: ![Home](docs/home.png) -->

## Features

- Home page listing meals, with a filter by category (`/category/{id}`)
- Create, edit and delete meals (name, slug, description, price, image and category)
- Create, edit and delete categories
- Registration, login, logout and profile management through Laravel Breeze
- MongoDB documents through the `mongodb/laravel-mongodb` driver and Eloquent-style models
- PHPUnit feature tests for authentication and profile flows

## Tech Stack

| Layer | Technologies |
| --- | --- |
| Backend | PHP 8.2+, Laravel 12, Laravel Breeze |
| Database | MongoDB Atlas via `mongodb/laravel-mongodb` |
| Frontend | Blade templates, Tailwind CSS, Alpine.js, Vite |
| Tooling | Docker, Docker Compose, PHPUnit |
| Hosting | Vercel configuration (`vercel.json`) |

## Getting Started

**Requirements:** PHP 8.2+ with the `mongodb` extension, Composer, Node.js and a MongoDB Atlas database.

```bash
git clone https://github.com/AbanobGeorgeSamir/Restaurant.git
cd Restaurant

cp .env.example .env
# set DB_CONNECTION=mongodb, MONGODB_URI and MONGODB_DATABASE in .env

composer install
npm install
php artisan key:generate
npm run build
php artisan serve
```

### With Docker

```bash
cp .env.example .env     # fill in MONGODB_URI, then run: php artisan key:generate --show
docker compose up --build
```

The app is served on `http://localhost:8000`. Docker Compose reads every secret from your local `.env` file, which is git-ignored. Never write credentials into `docker-compose.yml` or commit them.

## Testing

```bash
php artisan test
```

## Author

**Abanoub George Samir** · Junior Full-Stack Developer · [Portfolio](https://devabanobgeorge.vercel.app) · [LinkedIn](https://www.linkedin.com/in/abanob-george-samir) · [GitHub](https://github.com/AbanobGeorgeSamir)
