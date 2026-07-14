CREATE TABLE registrations
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    training_id INT NOT NULL,

    motivation TEXT NULL,

    status ENUM
    (
        'pending',
        'approved',
        'rejected',
        'completed'
    )
    DEFAULT 'pending',

    /*
    |--------------------------------------------------------------------------
    | Approval
    |--------------------------------------------------------------------------
    */

    approved_by INT NULL,

    approved_at TIMESTAMP NULL,

    /*
    |--------------------------------------------------------------------------
    | Rejection
    |--------------------------------------------------------------------------
    */

    rejected_by INT NULL,

    rejected_at TIMESTAMP NULL,

    rejected_reason TEXT NULL,

    /*
    |--------------------------------------------------------------------------
    | Completion
    |--------------------------------------------------------------------------
    */

    completed_by INT NULL,

    completed_at TIMESTAMP NULL,

    /*
    |--------------------------------------------------------------------------
    | Timestamp
    |--------------------------------------------------------------------------
    */

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    /*
    |--------------------------------------------------------------------------
    | Foreign Key
    |--------------------------------------------------------------------------
    */

    CONSTRAINT fk_registration_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_registration_training
        FOREIGN KEY (training_id)
        REFERENCES trainings(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_registration_approved_by
        FOREIGN KEY (approved_by)
        REFERENCES users(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_registration_rejected_by
        FOREIGN KEY (rejected_by)
        REFERENCES users(id)
        ON DELETE SET NULL,

    CONSTRAINT fk_registration_completed_by
        FOREIGN KEY (completed_by)
        REFERENCES users(id)
        ON DELETE SET NULL
);