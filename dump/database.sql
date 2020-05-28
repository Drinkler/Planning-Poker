create table user
(
    iduser    int auto_increment
        primary key,
    name      varchar(50)                            not null,
    surname   varchar(50)                            not null,
    email     varchar(100)                           not null,
    password  varchar(255)                           not null,
    language  varchar(5) default 'en_EN'             not null,
    confirmed tinyint    default 0                   not null,
    challenge varchar(300)                           not null,
    created   datetime   default current_timestamp() not null,
    constraint user_challenge_uindex
        unique (challenge),
    constraint user_email_uindex
        unique (email)
);

create table lobby
(
    idlobby int auto_increment
        primary key,
    deck    int                                  not null,
    creator int                                  not null,
    created datetime default current_timestamp() not null,
    name    varchar(50)                          not null,
    constraint fk_creator
        foreign key (creator) references user (iduser)
            on delete cascade
);

create table issue
(
    idissue  int auto_increment
        primary key,
    idgithub int                  not null,
    idlobby  int                  not null,
    title    varchar(255)         not null,
    body     varchar(255)         not null,
    active   tinyint(1) default 0 not null,
    constraint issue_lobby_idlobby_fk
        foreign key (idlobby) references lobby (idlobby)
            on delete cascade
);

create table participants
(
    idparticipants int auto_increment
        primary key,
    iduser         int                                  not null,
    idlobby        int                                  not null,
    joined         datetime default current_timestamp() not null,
    constraint fk_idlobby
        foreign key (idlobby) references lobby (idlobby)
            on delete cascade,
    constraint fk_iduser
        foreign key (iduser) references user (iduser)
            on delete cascade
);

create table review
(
    idreview    int auto_increment
        primary key,
    iduser      int                                  not null,
    title       varchar(100)                         not null,
    description varchar(300)                         not null,
    rating      int                                  not null,
    created     datetime default current_timestamp() not null,
    constraint review_user_iduser_fk
        foreign key (iduser) references user (iduser)
            on delete cascade
);

create table vote
(
    idvote  int auto_increment
        primary key,
    iduser  int                         not null,
    idlobby int                         not null,
    vote    varchar(50) charset utf8mb4 not null,
    constraint vote_lobby_idlobby_fk
        foreign key (idlobby) references lobby (idlobby)
            on delete cascade,
    constraint vote_user_iduser_fk
        foreign key (iduser) references user (iduser)
            on delete cascade
);
