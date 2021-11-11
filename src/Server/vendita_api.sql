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
    FOREIGN KEY(utente_id) REFERENCES utente(id),
    FOREIGN KEY(prodotto_id) REFERENCES prodotto(id),
    FOREIGN KEY(distretto_id) REFERENCES distretto(id)
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
    FOREIGN KEY(utente_id) REFERENCES utente(id),
    FOREIGN KEY(prodotto_id) REFERENCES prodotto(id),
    FOREIGN KEY(distretto_id) REFERENCES distretto(id)
);

CREATE TABLE richiesta_vendita
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    data_contratto DATE,
    vendita_id INT,
    richiesta_id INT,
    FOREIGN KEY(vendita_id) REFERENCES vendita(id),
    FOREIGN KEY(richiesta_id) REFERENCES richiesta(id)
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