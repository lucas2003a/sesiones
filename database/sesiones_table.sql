create database sesiones;
use sesiones;

create table usuarios
(
	idusuario		int auto_increment primary key,
    apellidos		varchar(40)		not null,
    nombres			varchar(40)		not null,
    email			varchar(40)		not null,
    claveacceso		varchar(40)		not null,
    nivelacceso		varchar(40)		not null,
    telefono		varchar(40)		not null,
    create_at		datetime		not null default now(),
    inactive_at		datetime		null ,
	update_at		datetime		null,
    constraint uk_email unique(email)
)engine = innodb;

insert into usuarios
	(apellidos, nombres, email, claveacceso, nivelacceso)
	values
		('GONZALES','KATHERIN','katy@gmail.com','12345','INV'),
        ('TASAYCO','ROXANA','roxy@gmail.com','12345','AST'),
        ('HERNANDEZ','CRISTINA','cris@gmail.com','12345','ADMIN');
        
update usuarios set
	claveacceso = '';