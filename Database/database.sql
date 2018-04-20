use efof_gestaff_2018;
create table if not EXISTS utente(
    nome varchar(50) not null,
    cognome varchar(50) not null,
    username varchar(50), 
    email varchar(50),
    password varchar(50),
    n_cellulare int not null,
    n_ufficio int not null,
    admin tinyint,
    proprietario tinyint,
    stato int,
    primary key(username)
);
create table if not EXISTS appartamento(
	id int auto_increment primary key,
    bambini tinyint,
    fumatori tinyint,
    piantina blob,
    animali tinyint,
    titolo varchar(50),
    regione varchar(50),
    n_locali int,
    posteggio tinyint,
    paese varchar(50),
    ammobiliato tinyint,
    ubicazione varchar(50),
    commenti text,
    email_prop varchar(50),
    username_prop varchar(50),
    password_prop varchar(50),
    foreign key(username_prop) references utente(username) on delete cascade on update cascade
);

create table if not EXISTS foto(
    id int AUTO_INCREMENT PRIMARY KEY,
	foto blob,
    id_appartamento int,
    foreign key(id_appartamento) REFERENCES appartamento(id) on delete cascade on update cascade
);
create table if not EXISTS accessori(
	nome varchar(30) primary KEY,
    id_appartamento int,
    foreign key(id_appartamento) REFERENCES appartamento(id) on delete cascade on update cascade
);
create table if not EXISTS tipo(
	tipo varchar(50) primary KEY
);
create table if not EXISTS prezzo(
	prezzo int,
    tipo varchar(50),
    id_appartamento int,
    foreign key(tipo) references tipo(tipo) on delete cascade on update cascade,
    foreign key(id_appartamento) references appartamento(id) on delete cascade on update cascade,
    primary key (prezzo, tipo, id_appartamento)
);
create table if not EXISTS spesa(
	id int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(50),
    prezzo int,
    id_appartamento int,
    foreign key(id_appartamento) references appartamento(id) on delete cascade on update cascade
);
create table if not EXISTS riserva(
	data_inizio date,
    data_fine date,
    id_appartamento int,
    username_utente varchar(50),
    email_utente varchar(50),
    password_utente varchar(50),
    primary key(data_inizio, data_fine, id_appartamento, username_utente, email_utente, password_utente),
    foreign key(id_appartamento) references appartamento(id) on delete cascade on update cascade,
    foreign key(username_utente) references utente(username) on delete cascade on update cascade
);
