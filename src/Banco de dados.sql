create database nacantina;
use nacantina;
-- tabela usuario
create table usuario
(
id_usuario int auto_increment,
nome_usuario varchar(50),
numero varchar(50),
email varchar(50),
palavra_pass varchar(50),
endereco_usuario varchar(50),
primary key(id_usuario)
)charset=utf8;
-- tabela produto
create table produto
(
id_produto int auto_increment,
nome_produto varchar(50),
marca varchar(50),
imagem varchar(255),
preco INT,
quantidade_stock INT,
disponibilidade_produto varchar(50),
data_adicao datetime,
gramas INT NOT NULL, 
primary key(id_produto)
)charset=utf8;
CREATE TABLE reserva (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    id_usuario INT NOT NULL,
    tempo_limite TIME NOT NULL,
    quantidade_compra INT,
    endereco VARCHAR(50),
    total_compra INT,
    troco_compra INT,
    estado_produto ENUM('na cesta', 'pendente') NOT NULL,
    data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
);
INSERT INTO produto (nome_produto, marca, preco, imagem, gramas) VALUES
('Coxa de Frango', 'Agraneu', 600, 'bolacha.svg', 100),
('Sambapito', 'Yogueta', 100, 'bolacha.svg', 100),
('Chouriço', 'Sicasal', 1000, 'bolacha.svg', 1000),
('Bolacha', 'Betna', 400, 'bolacha.svg', 400),
('Chinelo', 'Havaiana', 4500, 'bolacha.svg', 4500),
('Perfume', 'U_NIQUE', 3500, 'bolacha.svg', 50),
('Perfume', 'OPHYLIA', 2300, 'bolacha.svg', 50),
('Tênis', 'Nike', 18000, 'bolacha.svg', 20),
('Papa', 'Nestum', 2500, 'bolacha.svg', 100),
('iogurte Danone', ' Danone', 220, 'iogurte.svg', 100),
('Água Mineral', 'Fontana', 100, 'bolacha.svg', 500);