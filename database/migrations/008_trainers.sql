CREATE TABLE trainers
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    training_field_id INT NOT NULL,

    name VARCHAR(100) NOT NULL,

    phone VARCHAR(30) NULL,

    email VARCHAR(100) NULL,

    institution VARCHAR(150) NULL,

    expertise VARCHAR(150) NULL,

    certificate VARCHAR(255) NULL,

    biography TEXT NULL,

    avatar VARCHAR(255) NULL,

    status ENUM
    (
        'active',
        'inactive'
    ) DEFAULT 'active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_trainer_training_field
        FOREIGN KEY (training_field_id)
        REFERENCES training_fields(id)
        ON DELETE CASCADE
);