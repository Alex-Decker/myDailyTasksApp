CREATE DATABASE IF NOT EXISTS timetracking;
CREATE TABLE IF NOT EXISTS tasks(
    tasks_id int PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL ,
    duration int NOT NULL,
    date DATE NOT NULL

    )
