USE proj_info;

CREATE TABLE IF NOT EXISTS usuarios (
     id INT NOT NULL AUTO_INCREMENT,
     nome VARCHAR(100) NULL,
     email VARCHAR(100) NULL,
     senha VARCHAR(100) NULL,
     PRIMARY KEY (id)
);

insert into usuarios(nome,email,senha) values('ana','ana@sts.com','123456');

CREATE TABLE IF NOT EXISTS cursos (
     id INT NOT NULL AUTO_INCREMENT,
     nome VARCHAR(100) NULL,
     valor double(10,2) NULL,
     PRIMARY KEY (id)
);

insert into cursos(nome,valor) values('medicina',10.0);

