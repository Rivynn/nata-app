CREATE TABLE certificates
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    registration_id INT NOT NULL,

    certificate_number VARCHAR(100) NOT NULL UNIQUE,

    verification_code VARCHAR(100) NOT NULL UNIQUE,

    file VARCHAR(255) NULL,

    issued_at DATETIME NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_certificate_registration
        FOREIGN KEY (registration_id)
        REFERENCES registrations(id)
        ON DELETE CASCADE
);