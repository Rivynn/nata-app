CREATE TABLE training_batches
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    training_id INT NOT NULL,

    trainer_id INT NOT NULL,

    code VARCHAR(30),

    batch_name VARCHAR(100),

    start_date DATE,

    end_date DATE,

    max_participants INT,

    room VARCHAR(100),

    status ENUM
    (
        'draft',
        'registration',
        'running',
        'completed',
        'cancelled'
    ),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY(training_id)
        REFERENCES trainings(id),

    FOREIGN KEY(trainer_id)
        REFERENCES trainers(id)
);
