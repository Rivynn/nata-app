CREATE TABLE trainers
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NULL UNIQUE,

    training_field_id INT NOT NULL,

    employee_number VARCHAR(50),

    phone VARCHAR(30),

    email VARCHAR(100),

    institution VARCHAR(150),

    expertise VARCHAR(255),

    biography TEXT,

    avatar VARCHAR(255),

    status ENUM
    (
        'active',
        'inactive'
    )
    DEFAULT 'active',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY(user_id)
        REFERENCES users(id)
        ON DELETE SET NULL,

    FOREIGN KEY(training_field_id)
        REFERENCES training_fields(id)
);
