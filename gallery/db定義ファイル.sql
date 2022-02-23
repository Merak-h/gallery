create database gallery default character set utf8;
show databases;
use gallery;

create table users(
    serial_id integer not null primary key auto_increment,
    user_id varchar(255) not null unique ,
    user_password varchar(255) not null ,
    varsion integer not null default 0
)
desc users;

create table posts(
    post_id integer not null primary key auto_increment,
    title varchar(255),
    image_path varchar(255) not null,
    poster integer not null,
    explanatory varchar(255),
    date datetime not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
);
desc posts;

create table comments(
    comment_id integer not null primary key auto_increment,
    post integer not null,
    commenter integer,
    content varchar(255) not null,
    date datetime not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
);
desc comments;

create table tags(
    post integer,
    tag varchar(255)
);