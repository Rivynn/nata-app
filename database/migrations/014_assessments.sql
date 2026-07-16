CREATE TABLE assessments
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    registration_id INT NOT NULL,

    trainer_id INT NOT NULL,

    attendance_score DECIMAL(5,2),

    discipline_score DECIMAL(5,2),

    theory_score DECIMAL(5,2),

    practice_score DECIMAL(5,2),

    final_score DECIMAL(5,2),

    grade VARCHAR(5),

    notes TEXT,

    passed BOOLEAN,

    assessed_at DATETIME,

    FOREIGN KEY(registration_id)
        REFERENCES registrations(id),

    FOREIGN KEY(trainer_id)
        REFERENCES trainers(id)
);
