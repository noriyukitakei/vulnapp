CREATE DATABASE if NOT EXISTS todo CHARACTER SET utf8mb4;
use todo;
CREATE TABLE IF NOT EXISTS todos (
    id BIGINT NOT NULL AUTO_INCREMENT,
    body VARCHAR(1024),
    PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    PRIMARY KEY (username)
);

insert into users values('user01','password');
insert into users values('user02','password');
insert into users values('user03','password');

insert into todos(body) values('どんと来い脆弱性');
insert into todos(body) values('ラーメン食べたい');
