drop database if exists apiDatabase;
create database if not exists apiDatabase;
use apiDatabase;

create table users(
  id int primary key auto_increment,
  username varchar (100) not null,
  password varchar (100) not null,
  age smallint not null,
  email varchar (200) not null
);