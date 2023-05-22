
DROP DATABASE tp_php;

CREATE DATABASE tp_php;

USE tp_php;

CREATE TABLE users
	(id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	pseudo varchar(50) NOT NULL UNIQUE,
	passwd varchar(100) NOT NULL UNIQUE
	);

#INSERT INTO users (pseudo,email, annee_naissance) VALUES ('Sarra','sarrabargui@yahoo.fr',1905);
#INSERT INTO users (pseudo,email, annee_naissance) VALUES ('David','david@laposte.net',1985);
#INSERT INTO users (pseudo,email, annee_naissance) VALUES ('Naïma','nmkr@hotmail.fr',1995);

CREATE TABLE todolist
	(id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_user int NOT NULL,
	id_numero int NOT NULL,
	titre varchar(200) NOT NULL,
	description varchar(1000) NOT NULL,
	date date NOT NULL,
	date_modif date,
	CONSTRAINT FK_users_todolist FOREIGN KEY (id_user) REFERENCES user(id)   #,
      # CONSTRAINT AK_todolist UNIQUE(id_user, titre)
	
	);

INSERT INTO todolist (id_user, id_numero, titre, description,date) VALUES (1,1,'aller au marché','me réserver du temps libre pour aller au marché','1952-05-04');
INSERT INTO todolist (id_user, id_numero, titre, description,date) VALUES (1,2,'faire la java','apprendre la javascript',NOW());
INSERT INTO todolist (id_user, id_numero, titre, description,date) VALUES (1,3,'aller au marché','me réserver du temps libre pour aller','1963-05-04');
INSERT INTO todolist (id_user, id_numero, titre, description,date) VALUES (1,4,'faire un château de sable','aller ','1963-05-04');
