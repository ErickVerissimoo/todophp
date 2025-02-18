DROP TABLE IF EXISTS tarefa;
DROP TABLE IF EXISTS usuario;



CREATE TABLE IF NOT EXISTS usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    email VARCHAR(90) UNIQUE NOT NULL,
    password varchar(90) not null 
);

CREATE TABLE IF NOT EXISTS tarefa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(90) NOT NULL UNIQUE,
    description VARCHAR(400) NOT NULL,
    scheduled TIMESTAMP NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES usuario(id)
);
