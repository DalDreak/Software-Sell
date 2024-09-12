Criação do Banco de Dados no MySQL

CREATE TABLE tipo(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo VARCHAR(100)
);

CREATE TABLE investimentos(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo VARCHAR(100)
);
CREATE TABLE pacotes_extra(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(100)
);

CREATE TABLE status(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo VARCHAR(100)
);


CREATE TABLE software(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo_id INT NOT NULL,
investimento_id INT NOT NULL,
FOREIGN KEY (tipo_id) REFERENCES tipo(id),
FOREIGN KEY (investimento_id) REFERENCES investimento(id)
);

CREATE TABLE software_pacotes(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
software_id INT NOT NULL,
pacotes_extra_id INT NOT NULL,
FOREIGN KEY (software_id) REFERENCES software(id),
FOREIGN KEY (pacotes_extra_id) REFERENCES pacotes_extra(id)
);

CREATE TABLE pedidos(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
software_id INT NOT NULL,
status_id INT NOT NULL,
FOREIGN KEY (software_id) REFERENCES software(id),
FOREIGN KEY (status_id) REFERENCES status(id)
);

INSERT INTO status(tipo) VALUES ("Em produção");
INSERT INTO status(tipo) VALUES ("Em entrega");
INSERT INTO status(tipo) VALUES ("Concluído");

INSERT INTO tipo(tipo) VALUES ("Gestão de Vendas");
INSERT INTO tipo(tipo) VALUES ("Ordem de serviço");
INSERT INTO tipo(tipo) VALUES ("Contas a Pagar");

INSERT INTO investimento(tipo) VALUES ("Alto");
INSERT INTO investimento(tipo) VALUES ("Baixo");

INSERT INTO pacotes_extra(nome) VALUES ("Multiplataforma");
INSERT INTO pacotes_extra(nome) VALUES ("Internacionalização");
INSERT INTO pacotes_extra(nome) VALUES ("Manutenção");
INSERT INTO pacotes_extra(nome) VALUES ("Treinamento");
INSERT INTO pacotes_extra(nome) VALUES ("Customização");
