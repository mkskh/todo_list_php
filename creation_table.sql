CREATE TABLE todo_list.todo_list (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title TEXT NULL,
    date_time DATETIME DEFAULT CURRENT_TIMESTAMP NULL,
    checked BOOL DEFAULT FALSE NULL
);