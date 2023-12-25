CREATE DATABASE museu;
USE museu;

CREATE TABLE grupo (
id_grupo INT NOT NULL UNIQUE AUTO_INCREMENT,
nome_grupo VARCHAR (50) NOT NULL,
qtd INT NOT NULL,
PRIMARY KEY(id_grupo)
);

CREATE TABLE visita(
id_visita INT NOT NULL UNIQUE AUTO_INCREMENT,
id_grupo INT NOT NULL,
id_atracao INT NOT NULL,
data_visita DATE NOT NULL,
PRIMARY KEY (id_visita),
FOREIGN KEY (id_grupo) REFERENCES grupo(id_grupo),
FOREIGN KEY (id_atracao) REFERENCES atracao(id_atracao)
);


CREATE TABLE atracao(
id_atracao INT NOT NULL UNIQUE AUTO_INCREMENT,
titulo VARCHAR (50) NOT NULL,
artista VARCHAR (50) NOT NULL,
descricao VARCHAR(100) NOT NULL,
PRIMARY KEY (id_atracao)
);