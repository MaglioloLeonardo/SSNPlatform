create table tweb.farmacia
(
    Nome      varchar(50) not null,
    Indirizzo varchar(50) not null,
    Città     varchar(50) not null,
    primary key (Nome, Indirizzo)
);

create table tweb.utente
(
    Nome                varchar(50) not null,
    Cognome             varchar(50) not null,
    Codice_fiscale      varchar(50) not null,
    Data_nascita        date        not null,
    Indirizzo_residenza varchar(50) not null,
    Email               varchar(50) not null
        primary key,
    Password            varchar(64) not null,
    Città_residenza     varchar(50) not null,
    Città_nascita       varchar(50) not null
);

create table tweb.farmacista
(
    Email     varchar(50) not null
        primary key,
    Nome      varchar(50) not null,
    Indirizzo varchar(50) not null,
    constraint farmacista_ibfk_1
        foreign key (Email) references tweb.utente (Email),
    constraint farmacista_ibfk_2
        foreign key (Nome, Indirizzo) references tweb.farmacia (Nome, Indirizzo)
);

create index Nome
    on tweb.farmacista (Nome, Indirizzo);

create table tweb.medico
(
    Email varchar(50) not null
        primary key,
    constraint medico_ibfk_1
        foreign key (Email) references tweb.utente (Email)
);

create table tweb.ricetta
(
    ID               int auto_increment
        primary key,
    Data_emissione   date        not null,
    Dose_giornaliera int         not null,
    Durata_terapia   int         not null,
    Esenzione        tinyint(1)  not null,
    Nome_principio   varchar(50) not null,
    Medico           varchar(50) not null,
    Utente           varchar(50) not null,
    constraint ricetta_ibfk_1
        foreign key (Medico) references tweb.medico (Email),
    constraint ricetta_ibfk_2
        foreign key (Utente) references tweb.utente (Email)
);

create table tweb.acquisto
(
    Numero_confezioni  int           not null,
    Costo_paziente     decimal(6, 2) not null,
    Costo              decimal(6, 2) not null,
    Data_vendita       date          not null,
    Nome_Farmaco       varchar(50)   not null,
    Produttore_farmaco varchar(50)   not null,
    ID_ricetta         int           not null
        primary key,
    Farmacista         varchar(50)   not null,
    Nome_farmacia      varchar(50)   not null,
    Indirizzo_farmacia varchar(50)   not null,
    constraint acquisto_ibfk_1
        foreign key (ID_ricetta) references tweb.ricetta (ID),
    constraint acquisto_ibfk_2
        foreign key (Farmacista) references tweb.farmacista (Email),
    constraint acquisto_ibfk_3
        foreign key (Nome_farmacia, Indirizzo_farmacia) references tweb.farmacia (Nome, Indirizzo)
);

create index Farmacista
    on tweb.acquisto (Farmacista);

create index Nome_farmacia
    on tweb.acquisto (Nome_farmacia, Indirizzo_farmacia);

create index Medico
    on tweb.ricetta (Medico);

create index Utente
    on tweb.ricetta (Utente);

