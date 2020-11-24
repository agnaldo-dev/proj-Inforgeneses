USE proj_info;

CREATE TABLE IF NOT EXISTS usuarios (
     id INT NOT NULL AUTO_INCREMENT,
     nome VARCHAR(100) NULL,
     email VARCHAR(100) NULL UNIQUE,
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

insert into cursos(nome,valor) values('Medicina',300.0);
insert into cursos(nome,valor) values('Matematica',200.0);

CREATE TABLE IF NOT EXISTS tipo_pagamentos (
     id INT NOT NULL AUTO_INCREMENT,
     tipo VARCHAR(100) NULL,
     
     PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS pagamentos (
     id INT NOT NULL AUTO_INCREMENT,
     tipo_pagamento_id VARCHAR(100) NULL,
     pedido_id INT NULL,
     valor double(10,2) NULL,
     data_pagamento date NULL,

     PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS pedidos (
     id INT NOT NULL AUTO_INCREMENT,
     usuario_id INT NULL,
     data_pedido DATE NULL,
     estado VARCHAR(20),

     PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS pedidos_cursos (
     id INT NOT NULL AUTO_INCREMENT,
     pedido_id VARCHAR(100) NULL,
     curso_id INT NULL,
     
     PRIMARY KEY (id)
);
