CREATE DATABASE IF NOT EXISTS robot_control;
USE robot_control;

CREATE TABLE IF NOT EXISTS robot_state (
    id INT PRIMARY KEY,
    command CHAR(1) NOT NULL
);

INSERT INTO robot_state (id, command)
VALUES (1, 'S')
ON DUPLICATE KEY UPDATE command='S';

-- =====================================
-- Speech to Text Logs
-- =====================================

CREATE TABLE IF NOT EXISTS speech_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    spoken_text TEXT NOT NULL,
    detected_command VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);