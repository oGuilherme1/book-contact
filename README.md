### link do youtube: https://youtu.be/EWATfzCkPEc

# App Laravel

This repository contains a Laravel application

## 🚀 Installation

**To install the application on your machine, follow the steps below:**

```bash
git clone https://github.com/oGuilherme1/book-contact.git
```

```bash
cp .env.example .env
```
Set these values ​​in your .env with your data
- DB_DATABASE=your_database `Default: laravel`
- DB_USERNAME=your_username `Default: root`
- DB_PASSWORD=your_password `Default: r00t`

```bash
docker-compose up -d
```

```bash
docker exec -it laravel_betabit bash
```

```bash
php artisan key:generate
```

Wait a few seconds for the laravel server to start, otherwise the command below displays a connection error

```bash
php artisan migrate
```
