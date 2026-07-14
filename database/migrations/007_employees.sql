CREATE TABLE employees
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL UNIQUE,

    training_field_id INT NOT NULL,

    phone VARCHAR(20) NULL,

    position VARCHAR(100) NULL,

    address TEXT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_employee_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_employee_training_field
        FOREIGN KEY (training_field_id)
        REFERENCES training_fields(id)
        ON DELETE RESTRICT
);