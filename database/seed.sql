-- Categories
INSERT INTO categories (name, slug, description) VALUES
    ('Fiction',          'fiction',          'Novels, short stories, and other fictional works'),
    ('Non-Fiction',      'non-fiction',      'Biographies, history, science, and essays'),
    ('Science Fiction',  'science-fiction',  'Sci-fi and speculative fiction'),
    ('Fantasy',          'fantasy',          'Fantasy and magical realism'),
    ('Mystery',          'mystery',          'Mystery, thriller, and crime novels'),
    ('Romance',          'romance',          'Romance novels'),
    ('Children',         'children',         'Books for children and young adults'),
    ('Academic',         'academic',         'Textbooks and academic publications');

-- Admin user  (password: admin123)
INSERT INTO users (username, email, password_hash, role) VALUES
    ('admin', 'admin@bookexchange.local', '$2y$12$deOqP86Fbmea1sLtSAzwQedDimvefMD9gTBm6GHK.OH7NhVqfetlO', 'admin');

-- Sample regular user  (password: user123)
INSERT INTO users (username, email, password_hash, role) VALUES
    ('alice', 'alice@example.com', '$2y$12$deOqP86Fbmea1sLtSAzwQedDimvefMD9gTBm6GHK.OH7NhVqfetlO', 'user');

-- Sample books
INSERT INTO books (user_id, category_id, title, author, isbn, description, condition, status) VALUES
    (2, 1, 'The Great Gatsby',    'F. Scott Fitzgerald', '9780743273565', 'A classic novel of the Jazz Age.',         'good',  'available'),
    (2, 3, 'Dune',                'Frank Herbert',        '9780441013593', 'Epic sci-fi saga set on a desert planet.', 'fair',  'available'),
    (2, 4, 'The Hobbit',          'J.R.R. Tolkien',       '9780547928227', 'A fantasy adventure in Middle-earth.',     'good',  'available');
