CREATE TABLE schedules
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    training_id INT NOT NULL,

    trainer_id INT NOT NULL,

    title VARCHAR(150) NULL,

    location VARCHAR(150) NOT NULL,

    room VARCHAR(100) NULL,

    start_date DATE NOT NULL,

    end_date DATE NOT NULL,

    start_time TIME NOT NULL,

    end_time TIME NOT NULL,

    max_participants INT NOT NULL DEFAULT 30,

    notes TEXT NULL,

    status ENUM
    (
        'draft',
        'scheduled',
        'ongoing',
        'completed',
        'cancelled'
    )
    DEFAULT 'draft',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_schedule_training
        FOREIGN KEY (training_id)
        REFERENCES trainings(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_schedule_trainer
        FOREIGN KEY (trainer_id)
        REFERENCES trainers(id)
        ON DELETE RESTRICT
);