CREATE TABLE assessment_items
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    training_field_id INT,

    name VARCHAR(100),

    weight DECIMAL(5,2),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
