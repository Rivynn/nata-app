CREATE TABLE assessment_scores
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    assessment_id INT,

    assessment_item_id INT,

    score DECIMAL(5,2),

    FOREIGN KEY(assessment_id)
        REFERENCES assessments(id),

    FOREIGN KEY(assessment_item_id)
        REFERENCES assessment_items(id)
);
