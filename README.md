# Book Exchange Platform

A circular-economy web platform for exchanging second-hand books between users, built with PHP 8.5, MariaDB, and Bootstrap 5.

## Features

- **Public catalog** — browse and search books by title, author, or category
- **User area** — publish books and manage exchange requests via an inbox
- **Admin area** — manage categories and resolve disputes between users

## Tech stack

| Layer | Choice |
|---|---|
| Backend | PHP 8.5 |
| Database | MariaDB 10.11 |
| CSS Framework | Bootstrap 5 |
| Web server | Apache 2.4 |
| Local dev | Docker Compose |

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

Edit `.env` with your preferred credentials (the defaults work fine for local dev).

### 3. Start the stack

```bash
docker compose up --build
```

The first run pulls images, builds the app container, and initialises the database with the schema and seed data automatically.

| Service | URL |
|---|---|
| Application | http://localhost:8000 |
| phpMyAdmin | http://localhost:8080 |

### 4. Seed accounts

| Role | Username | Password |
|---|---|---|
| Admin | `admin` | `admin123` |
| User | `alice` | `admin123` |

## Project structure

```
book-exchange-platform/
├── admin/                  # Admin-only pages
├── css/                    # Custom styles (Bootstrap overrides)
├── database/
│   ├── schema.sql          # Table definitions, auto-loaded on first start
│   └── seed.sql            # Initial categories, users, and sample books
├── docker/
│   └── apache.conf         # Apache virtual host config
├── includes/
│   ├── db.php              # PDO connection (include in every page)
│   ├── auth.php            # Session helpers: is_logged_in(), require_role()
│   ├── header.php          # Shared header, navbar, and sidebar
│   └── footer.php          # Shared footer with required links
├── uploads/covers/         # Uploaded book cover images (Docker-managed volume)
├── .env.example            # Environment variable template
├── compose.yml
├── Dockerfile
└── como_se_hizo.pdf        # Project report (not tracked in git)
```

## User roles

| Role | Capabilities |
|---|---|
| Guest | Browse catalog, search, view book detail, contact |
| User | All guest capabilities + publish books, manage exchange inbox |
| Admin | All user capabilities + manage categories, resolve disputes |

## Resetting the database

To wipe all data and re-run schema + seed:

```bash
docker compose down -v
docker compose up --build
```

## Stopping the stack

```bash
docker compose down
```
