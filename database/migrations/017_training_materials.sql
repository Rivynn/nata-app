CREATE TABLE training_materials
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    schedule_id INT,

    title VARCHAR(150),

    description TEXT,

    file VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
