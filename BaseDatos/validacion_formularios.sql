create schema db_libros;
use db_libros;

create table libros(
	titulo varchar(200) primary key,
    paginas int not null,
    autor varchar(60) not null
);

select * from libros;
#drop schema db_libros;