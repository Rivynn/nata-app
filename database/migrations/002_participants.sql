CREATE TABLE participants
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL UNIQUE,

    phone VARCHAR(20),

    gender ENUM(
        'L',
        'P'
    ) NULL,

    birth_date DATE NULL,

    address TEXT NULL,

    education VARCHAR(100) NULL,

    institution VARCHAR(150) NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_participant_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);