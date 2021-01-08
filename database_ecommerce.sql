create database ecommerce;

use ecommerce;

create table categoriaProduto(
id_categoria int not null auto_increment primary key,
nome_categoria varchar(50) not null
);

insert into categoriaProduto(nome_categoria) values
('Calças'),
('Camisetas'),
('Blusas'),
('Bermudas'),
('Shorts');

create table subCategoria(
id_subCategoria int not null auto_increment primary key,
nome_subCategoria varchar(100),
id_categoria int not null,
foreign key (id_categoria) references categoriaProduto (id_categoria)
);

insert into subCategoria(nome_subCategoria, id_categoria) values
('Calças Jeans', 1),
('Calças de Moletom', 1),
('Calças Masculinas', 1),
('Calças Femininas', 1);

create table produto(
id_produto int not null auto_increment primary key,
nome_produto varchar(50) not null,
preco_produto decimal(10, 2) not null,
estoque int not null,
descricao text(1000) not null,
id_categoria int not null,
img_produto varchar(120) not null,
foreign key (id_categoria) references categoriaProduto (id_categoria)
);

insert into produto(nome_produto, preco_produto, estoque, descricao, id_categoria, img_produto) values
('Calça Nike Dri-FIT Masculina', 280.00, 10, 'As calças Nike Dri-FIT são feitas com jersey macio texturizado com parte de trás escovada para maior conforto e descontração. As pernas afuniladas, o cós elástico e a entretela espaçosa permitem que você se movimente livremente e sem distrações enquanto troca de posições e poses.', 1, 'calcaNike1.jpg');

insert into produto(nome_produto, preco_produto, estoque, descricao, id_categoria, img_produto) values
('Calça Nike Sportswear Masculina', 170.00, 10, 'A Calça Nike Sportswear Woven é feita com tecido ripstop super leve e forrada com mesh. Ela possui um cós elástico para ajudar a deixar o ajuste solto e espaçoso seguro.', 1, 'CalcaNike2.png');

insert into produto(nome_produto, preco_produto, estoque, descricao, id_categoria, img_produto) values
('Calça de Treino Nike Corinthians Masculina', 210.00, 10, 'A Calça Nike Sportswear Woven é feita com tecido ripstop super leve e forrada com mesh. Ela possui um cós elástico para ajudar a deixar o ajuste solto e espaçoso seguro.', 1, 'CalcaNike3.png');

create table subCategoriaProduto(
id_subCategoriaProduto int not null auto_increment primary key,
id_subCategoria int not null,
id_produto int not null,
foreign key (id_subCategoria) references subCategoria (id_subCategoria),
foreign key (id_produto) references produto (id_produto)
);

insert into subCategoriaProduto(id_subCategoria, id_produto) values
(2, 1),
(3, 1);

create table subDescricoes(
id_desc int not null auto_increment primary key,
subDescricao varchar(400) not null,
id_Produto int not null,
foreign key (id_produto) references produto(id_produto)
);

create table cliente(
id_cliente int not null auto_increment primary key,
nome_cliente varchar(60) not null,
email_cliente varchar(100) not null,
senha_cliente varchar(200) not null
);

select * from cliente;

create table endereco(
id_endereco int not null auto_increment primary key,
id_cliente int not null,
UF varchar(2) not null,
cidade varchar(100) not null,
bairro varchar(100) not null,
endereco varchar(100) not null,
numero int not null,
CEP varchar(9) not null,
foreign key (id_cliente) references cliente(id_cliente)
);

select * from cliente;

select * from endereco;

create table pedido(
id_pedido int not null auto_increment primary key,
dt_pedido datetime not null,
id_cliente int not null,
valor_pedido decimal(10, 2) not null,
dt_entrega datetime not null,
foreign key(id_cliente) references Cliente (id_cliente)
);

select * from pedido;

create table produtoPedido(
id_itemPedido int not null auto_increment primary key,
id_produto int not null,
id_pedido int not null,
foreign key (id_produto) references produto(id_produto),
foreign key (id_pedido) references pedido(id_pedido)
);

create table imagemProduto(
id_imagem int not null auto_increment primary key,
img varchar(120) not null,
id_produto int not null,
foreign key(id_produto) references produto(id_produto)
);

insert into imagemProduto(img, id_produto) values
('CalcaNike1.jpg', 2),
('CalcaNike2.png', 2),
('CalcaNike3.png', 2);

create table oferta(
id_oferta int not null auto_increment primary key,
id_produto int not null,
valor_promocao decimal(10, 2) not null,
foreign key(id_produto) references produto (id_produto)
);

insert into oferta(id_produto, valor_promocao) values
(1, 50.00),
(2, 50.00),
(3, 50.00);

select * from oferta O 
inner join produto P on O.id_produto = P.id_produto
inner join categoriaProduto C on P.id_categoria = C.id_categoria
order by id_oferta desc;