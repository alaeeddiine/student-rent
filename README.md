# Student Rent

Student rental platform — final study project (ISTA Driouch).

## Description

Web application connecting students with rental properties: browse listings, manage bookings, and save favorite properties.

## Tech stack

- Laravel 12, PHP 8.2
- MySQL
- Blade templates, Vite

## Database

Migrations cover: `properties`, `contacts`, `favorite_properties`, `bookings`, and occupancy status.

## Getting started

1. Install PHP dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Configure the environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Set your database credentials in `.env`, then run the migrations:

```bash
php artisan migrate
```

5. Start the development server:

```bash
php artisan serve
```
