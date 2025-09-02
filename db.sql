CREATE DATABASE futebol_db
USE futebol_db

CREATE TABLE times (
    id INT AUTO_INCREMENT PRIMARY KEY;
    nome VARCHAR(120) NOT NULL UNIQUE;
    cidade VARCHAR(120)
);
CREATE TABLE jogadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    time_id INT NOT NULL,
    nome VARCHAR(120) NOT NULL UNIQUE,
    posicao ENUM ('GOL','ZAG','LAT','VOL','MEI','ATA'),
    numero_camisa INT NOT NULL,
    CONSTRAINT fk_id_time FOREIGN KEY (time_id) REFERENCES times(id);
);

CREATE TABLE partidas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_partida DATE NOT NULL,
    mandante_id INT NOT NULL,
    visitante_id INT NOT NULL,
    gols_mandante INT DEFAULT 0,
    gols_visitante INT DEFAULT 0;
    CONSTRAINT fk_par_mand FOREIGN KEY (mandandante_id) REFERENCES times (id)
    CONSTRAINT fk_par_vis FOREIGN KEY (visitante_id) REFERENCES times (id)
)

INSERT INTO times (nome, cidade) VALUES 
('flamengo','Rio de Janeiro'),
('Gremio', 'Porto Alegre'),
('Sao Paulo', 'Sao Paulo');

INSERT INTO jogadores (time_id, nome, posicao, numero_camisa) VALUES
(1, 'Arrascata', 'MEI', 10),
(2, 'Lucas Moura', 'MEI', 7),
(3, 'Garomel', 'ATA', 4);

INSERT INTO partidas (data_partida, mandante_id, visitante_id, gols_mandante, gols_visitante) 
VALUES (CURDATE(),1,3,1,1);
