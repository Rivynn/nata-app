DROP TABLE IF EXISTS participant_profiles;
DROP TABLE IF EXISTS schedules;
DROP TABLE IF EXISTS trainers;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS certificates;
DROP TABLE IF EXISTS registrations;
DROP TABLE IF EXISTS trainings;
DROP TABLE IF EXISTS training_fields;
DROP TABLE IF EXISTS participants;
DROP TABLE IF EXISTS users;

CREATE TABLE users
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    username VARCHAR(50) NOT NULL UNIQUE,

    email VARCHAR(100) NOT NULL UNIQUE,

    avatar VARCHAR(255) NULL,

    password VARCHAR(255) NOT NULL,

    role ENUM
    (
        'admin',
        'pegawai',
        'peserta'
    )
    NOT NULL
    DEFAULT 'peserta',

    status ENUM
    (
        'active',
        'inactive',
        'blocked'
    )
    NOT NULL
    DEFAULT 'active',

    last_login_at TIMESTAMP NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);
