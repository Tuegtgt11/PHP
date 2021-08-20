DROP DATABASE IF EXISTS library;
create database if not exists library;

use library;

drop table if exists books;
create table books (
    bookid int(11) AUTO_INCREMENT,
    authorid int(11),
    title varchar(55),
    ISBN varchar(25),
    pub_year SMALLINT(6),
    available tinyint(4),
    primary key (bookid));

insert into books values (1, 1,'The Two Towers ','0-261-10236-1','2002',1 );
insert into books values (2, 1,'Roots ','0-261-10246-4','2022',1 );
insert into books values (3, 2,'The Hobbits ','0-261-10336-2','2012',1 );
insert into books values (4, 3,'The Sum of All Fears ','0-261-10536-3','1902',1 );
insert into books values (5, 3,'The Tues Day ','0-261-10136-5','1992',1 );

select * from books;