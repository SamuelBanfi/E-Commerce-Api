DROP DATABASE IF EXISTS vendita_api;
CREATE DATABASE vendita_api;
USE vendita_api;

CREATE TABLE utente
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(25) NOT NULL,
    cognome VARCHAR(25) NOT NULL,
    nome_utente VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL,
    codice VARCHAR(60) NOT NULL
);

CREATE TABLE prodotto
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(25)
);

CREATE TABLE distretto
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(25)
);

CREATE TABLE vendita
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descrizione TEXT,
    immagine MEDIUMBLOB NOT NULL,
    utente_id INT NOT NULL,
    prodotto_id INT NOT NULL,
    distretto_id INT NOT NULL,
    FOREIGN KEY(utente_id) REFERENCES utente(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(prodotto_id) REFERENCES prodotto(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(distretto_id) REFERENCES distretto(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE richiesta
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descrizione TEXT,
    immagine MEDIUMBLOB NOT NULL,
    utente_id INT,
    prodotto_id INT,
    distretto_id INT,
    FOREIGN KEY(utente_id) REFERENCES utente(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(prodotto_id) REFERENCES prodotto(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(distretto_id) REFERENCES distretto(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE richiesta_vendita
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    data_contratto DATE,
    vendita_id INT,
    richiesta_id INT,
    venditore_id INT,
    acquirente_id INT,
    concluso_venditore TINYINT(1) DEFAULT 0,
    concluso_acquirente TINYINT(1) DEFAULT 0,
    FOREIGN KEY(vendita_id) REFERENCES vendita(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(richiesta_id) REFERENCES richiesta(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(venditore_id) REFERENCES utente(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(acquirente_id) REFERENCES utente(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE messaggi
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    committente_id INT,
    destinatario_id INT,
    messaggio TEXT,
    FOREIGN KEY(committente_id) REFERENCES utente(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(destinatario_id) REFERENCES utente(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

INSERT INTO prodotto(nome) VALUES("Famiglia di api");
INSERT INTO prodotto(nome) VALUES("Nucleo di api");
INSERT INTO prodotto(nome) VALUES("Ape regina");

INSERT INTO distretto(nome) VALUES("Mendrisio");
INSERT INTO distretto(nome) VALUES("Lugano");
INSERT INTO distretto(nome) VALUES("Locarno");
INSERT INTO distretto(nome) VALUES("Vallemaggia");
INSERT INTO distretto(nome) VALUES("Bellinzona");
INSERT INTO distretto(nome) VALUES("Riviera");
INSERT INTO distretto(nome) VALUES("Blenio");
INSERT INTO distretto(nome) VALUES("Leventina");

DROP USER IF EXISTS beecommerce;
CREATE USER beecommerce IDENTIFIED BY "Beecommerce2021!";
GRANT SELECT, INSERT, UPDATE, DELETE ON vendita_api.* TO beecommerce;