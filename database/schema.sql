CREATE TABLE IF NOT EXISTS users (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role          ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL UNIQUE,
    slug        VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE IF NOT EXISTS books (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id      INT UNSIGNED NOT NULL,
    category_id  INT UNSIGNED NOT NULL,
    title        VARCHAR(200) NOT NULL,
    author       VARCHAR(150) NOT NULL,
    isbn         VARCHAR(20),
    description  TEXT,
    condition    ENUM('new', 'good', 'fair', 'poor') NOT NULL,
    cover_image  VARCHAR(255),
    status       ENUM('available', 'pending', 'exchanged') NOT NULL DEFAULT 'available',
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)     REFERENCES users(id)      ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS exchanges (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    requester_id INT UNSIGNED NOT NULL,
    book_id      INT UNSIGNED NOT NULL,
    owner_id     INT UNSIGNED NOT NULL,
    message      TEXT,
    status       ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (requester_id) REFERENCES users(id)  ON DELETE CASCADE,
    FOREIGN KEY (book_id)      REFERENCES books(id)  ON DELETE CASCADE,
    FOREIGN KEY (owner_id)     REFERENCES users(id)  ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS disputes (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    exchange_id INT UNSIGNED NOT NULL,
    reporter_id INT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    status      ENUM('open', 'resolved') NOT NULL DEFAULT 'open',
    admin_id    INT UNSIGNED,
    resolution  TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (exchange_id) REFERENCES exchanges(id) ON DELETE CASCADE,
    FOREIGN KEY (reporter_id) REFERENCES users(id)     ON DELETE CASCADE,
    FOREIGN KEY (admin_id)    REFERENCES users(id)     ON DELETE SET NULL
);
