/*
|--------------------------------------------------------------------------|
| 				          Base de Datos Blog_Master					       |
|--------------------------------------------------------------------------|
*/
	CREATE DATABASE IF NOT EXISTS blog_master;
	USE blog_master;

	CREATE TABLE usuarios(
		id int(255) auto_increment not null,
		nombre varchar (100) not null,
		apellidos varchar (255) not null,
		email varchar(255) not null,
		password varchar(100) not null,
		fecha timestamp DEFAULT CURRENT_TIMESTAMP,
		CONSTRAINT pk_usuarios PRIMARY KEY(id),
		CONSTRAINT uq_email UNIQUE(email) 
	)ENGINE=innoDb; 

	CREATE TABLE categorias(
		id int(255) auto_increment not null,
		nombre varchar(255) not null,
		fecha timestamp DEFAULT CURRENT_TIMESTAMP,
		CONSTRAINT pk_categorias PRIMARY KEY(id)
	)ENGINE=innoDb; 

	CREATE TABLE entradas(
		id int(255) auto_increment not null,
		usuario_id int(255),
		categoria_id int(255),
		titulo varchar(255) not null,
		descripcion MEDIUMTEXT,
		fecha timestamp DEFAULT CURRENT_TIMESTAMP,
		CONSTRAINT pk_entradas PRIMARY KEY(id),
		CONSTRAINT fk_entrada_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
		CONSTRAINT fk_entrada_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
	)ENGINE=innoDb; 
