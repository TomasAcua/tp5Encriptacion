CREATE DATABASE encryptionDB;

USE encryptionDB;

CREATE TABLE encrypted_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    encrypted_file LONGBLOB NOT NULL,
    key_text TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
