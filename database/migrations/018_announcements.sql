CREATE TABLE announcements
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    batch_id INT,

    title VARCHAR(150),

    content TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
