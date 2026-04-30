# Book Exchange Platform

A circular-economy web platform for exchanging second-hand books between users, built with Laravel, MariaDB, and Bootstrap 5.

## Features

- **Public catalog** — browse and search books by title, author, or category
- **User area** — publish books and manage exchange requests via an inbox
- **Admin area** — manage categories and resolve disputes between users

## Tech stack

| Layer | Choice |
|---|---|
| Backend | Laravel (PHP 8.5) |
| Database | MariaDB 11 |
| CSS Framework | Bootstrap 5 |
| Local dev | Laravel Sail (Docker) |

## Requirements

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/)

## Getting started

### 1. Clone the repository

```bash
git clone <repo-url>
cd book-exchange-platform
```

### 2. Configure environment

```bash
cp .env.example .env
```

Open `.env` and fill in:

```
DB_PASSWORD=          # any password you like for the local MariaDB container
ADMIN_SEED_PASSWORD=  # password for the dev admin account (e.g. admin123)
```

> Each teammate sets their own values — `.env` is never committed to git.

### 3. Install dependencies

```bash
docker run --rm -v "$(pwd)":/app -w /app composer:latest install --no-interaction
```

### 4. Start the stack

```bash
./vendor/bin/sail up --build
```

On first run, Sail builds the app image and MariaDB initialises automatically.

| Service | URL |
|---|---|
| Application | http://localhost |
| phpMyAdmin | http://localhost:8080 |

### 5. Generate application key

```bash
./vendor/bin/sail artisan key:generate
```

### 6. Run migrations and seed

```bash
./vendor/bin/sail artisan migrate --seed
```

This creates all tables and inserts the initial categories, an admin account,
and a sample user. Each teammate runs this once on their own machine —
**no shared database required**.

### 7. Seed accounts

| Role | Username | Email | Password |
|---|---|---|---|
| Admin | `admin` | admin@bookexchange.local | *(your `ADMIN_SEED_PASSWORD`)* |
| User | `alice` | alice@example.com | `user123` |

Regular users can register themselves via `/register`.

## Project structure

```
book-exchange-platform/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Route handlers
│   │   └── Middleware/     # Auth and role guards
│   └── Models/             # Eloquent models: User, Book, Category, Exchange, Dispute
├── database/
│   ├── migrations/         # Table definitions (replaces schema.sql)
│   └── seeders/            # Initial data: categories, users, sample books
├── resources/
│   └── views/              # Blade templates
│       └── layouts/        # Shared header, footer, sidebar
├── routes/
│   └── web.php             # All application routes
├── public/                 # Web root (index.php, assets)
├── storage/app/public/     # Uploaded book cover images
├── compose.yaml            # Sail Docker Compose (app + mariadb + phpmyadmin)
└── como_se_hizo.pdf        # Project report (not tracked in git)
```

## User roles

| Role | Capabilities |
|---|---|
| Guest | Browse catalog, search, view book detail, contact |
| User | All guest capabilities + publish books, manage exchange inbox |
| Admin | All user capabilities + manage categories, resolve disputes |

## Useful Sail commands

```bash
# Stop the stack
./vendor/bin/sail down

# Reset database (re-runs all migrations and seeders)
./vendor/bin/sail artisan migrate:fresh --seed

# Open a shell inside the app container
./vendor/bin/sail shell

# Run tests
./vendor/bin/sail artisan test
```

## Resetting the stack completely

To wipe all containers and volumes:

```bash
./vendor/bin/sail down -v
./vendor/bin/sail up --build
./vendor/bin/sail artisan migrate --seed
```
