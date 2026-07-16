CREATE TABLE training_schedules
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    training_batch_id INT NOT NULL,

    meeting_number INT NOT NULL,

    topic VARCHAR(150) NOT NULL,

    schedule_date DATE NOT NULL,

    start_time TIME NOT NULL,

    end_time TIME NOT NULL,

    room VARCHAR(100),

    notes TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (training_batch_id)
        REFERENCES training_batches(id)
        ON DELETE CASCADE
);
