CREATE DATABASE IF NOT EXISTS banco_sonhos;
USE banco_sonhos;

CREATE TABLE sonhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50)
);

CREATE TABLE sonho_tag (
    sonho_id INT,
    tag_id INT,
    PRIMARY KEY (sonho_id, tag_id),
    FOREIGN KEY (sonho_id) REFERENCES sonhos(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE interpretacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sonho_id INT,
    interpretador VARCHAR(100),
    texto TEXT,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sonho_id) REFERENCES sonhos(id) ON DELETE CASCADE
); 

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
); 