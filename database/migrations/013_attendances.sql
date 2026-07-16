CREATE TABLE attendances
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    schedule_id INT NOT NULL,

    registration_id INT NOT NULL,

    status ENUM
    (
        'present',
        'late',
        'permission',
        'sick',
        'absent'
    ),

    check_in_at DATETIME,

    notes TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(schedule_id)
        REFERENCES training_schedules(id),

    FOREIGN KEY(registration_id)
        REFERENCES registrations(id)
);
