CREATE TABLE trainings
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    training_field_id INT NOT NULL,

    name VARCHAR(150) NOT NULL,

    description TEXT,

    quota INT DEFAULT 0,

    duration INT DEFAULT 0,

    location VARCHAR(255),

    registration_open DATE,

    registration_close DATE,

    status ENUM('draft','open','closed')
        DEFAULT 'draft',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY(training_field_id)
        REFERENCES training_fields(id)
        ON DELETE CASCADE
);