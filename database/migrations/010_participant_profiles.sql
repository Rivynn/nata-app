CREATE TABLE participant_profiles
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    participant_id INT NOT NULL UNIQUE,

    /*
    |--------------------------------------------------------------------------
    | Identitas
    |--------------------------------------------------------------------------
    */

    nik CHAR(16) NULL UNIQUE,

    birth_place VARCHAR(100) NULL,

    religion ENUM(
        'Islam',
        'Kristen',
        'Katolik',
        'Hindu',
        'Buddha',
        'Konghucu'
    ) NULL,

    marital_status ENUM(
        'belum_menikah',
        'menikah',
        'cerai'
    ) NULL,

    /*
    |--------------------------------------------------------------------------
    | Alamat
    |--------------------------------------------------------------------------
    */

    province VARCHAR(100) NULL,

    city VARCHAR(100) NULL,

    district VARCHAR(100) NULL,

    village VARCHAR(100) NULL,

    postal_code VARCHAR(10) NULL,

    /*
    |--------------------------------------------------------------------------
    | Pendidikan
    |--------------------------------------------------------------------------
    */

    major VARCHAR(100) NULL,

    graduation_year YEAR NULL,

    /*
    |--------------------------------------------------------------------------
    | Pekerjaan
    |--------------------------------------------------------------------------
    */

    employment_status ENUM(
        'belum_bekerja',
        'bekerja',
        'wirausaha',
        'pelajar',
        'mahasiswa',
        'lainnya'
    ) DEFAULT 'belum_bekerja',

    occupation VARCHAR(150) NULL,

    company_name VARCHAR(150) NULL,

    /*
    |--------------------------------------------------------------------------
    | Pelatihan
    |--------------------------------------------------------------------------
    */

    training_goal TEXT NULL,

    skill TEXT NULL,

    /*
    |--------------------------------------------------------------------------
    | Kontak Darurat
    |--------------------------------------------------------------------------
    */

    emergency_contact_name VARCHAR(100) NULL,

    emergency_contact_phone VARCHAR(20) NULL,

    /*
    |--------------------------------------------------------------------------
    | Dokumen
    |--------------------------------------------------------------------------
    */

    photo VARCHAR(255) NULL,

    ktp_file VARCHAR(255) NULL,

    ijazah_file VARCHAR(255) NULL,

    cv_file VARCHAR(255) NULL,

    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    is_completed BOOLEAN NOT NULL DEFAULT FALSE,

    completed_at TIMESTAMP NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_participant_profile
        FOREIGN KEY (participant_id)
        REFERENCES participants(id)
        ON DELETE CASCADE
);
