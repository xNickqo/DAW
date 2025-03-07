DROP DATABASE IF EXISTS reservas;
CREATE DATABASE reservas;

USE reservas;

DROP TABLE IF EXISTS aerolineas;
create table aerolineas (id_aerolinea varchar(2) not null, nombre_aerolinea varchar(50) not null) ENGINE=InnoDB;
alter table aerolineas add constraint pk_aerolinea primary key (id_aerolinea);
insert into aerolineas (id_aerolinea, nombre_aerolinea) values
('IB','IBERIA'),
('AC','AIR CANADA'),
('EK','FLY EMIRATES'),
('UX','AIR EUROPA');


DROP TABLE IF EXISTS vuelos;
DROP TABLE IF EXISTS vuelos;
CREATE TABLE vuelos (
    id_vuelo INT(5) NOT NULL, 
    origen VARCHAR(50) NOT NULL, 
    destino VARCHAR(50), 
    fechahorasalida TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    fechahorallegada TIMESTAMP NULL,  -- Permitir NULL para evitar error
    id_aerolinea VARCHAR(2), 
    precio_asiento FLOAT(8), 
    asientos_disponibles INT(3),
    CONSTRAINT pk_vuelos PRIMARY KEY (id_vuelo),
    CONSTRAINT fk_vuelos FOREIGN KEY (id_aerolinea) REFERENCES aerolineas(id_aerolinea)
) ENGINE=InnoDB;


alter table vuelos add constraint pk_vuelos primary key (id_vuelo);
alter table vuelos add constraint fk_vuelos foreign key (id_aerolinea) references aerolineas(id_aerolinea);

insert into vuelos (id_vuelo,origen,destino, fechahorasalida, fechahorallegada, id_aerolinea, precio_asiento, asientos_disponibles) values
(1,'MADRID','PRAGA','2024-06-06 13:15:00','2024-06-06 15:45:00','IB',100,180),
(2,'MADRID','PRAGA','2024-06-07 13:15:00','2024-06-07 15:45:00','IB',125,179),
(3,'MADRID','PRAGA','2024-06-08 13:15:00','2024-06-08 15:45:00','IB',100,180),
(4,'MADRID','DUBAI','2024-06-06 15:10:00','2024-06-07 00:35:00','EK',450,350),
(5,'MADRID','DUBAI','2024-06-08 15:10:00','2024-06-09 00:35:00','EK',500,350),
(6,'BARCELONA','TORONTO','2024-05-01 09:00:00','2024-05-01 13:00:00','AC',650,250),
(7,'BARCELONA','TORONTO','2024-05-02 09:00:00','2024-05-02 13:00:00','AC',650,250),
(8,'BARCELONA','TORONTO','2024-05-03 09:00:00','2024-05-03 13:00:00','AC',650,250),
(9,'BARCELONA','TORONTO','2024-05-04 09:00:00','2024-05-04 13:00:00','AC',750,250),
(10,'BARCELONA','TORONTO','2024-05-05 09:00:00','2024-05-05 13:00:00','AC',850,250),
(11,'PALMA MALLORCA','MADRID','2024-05-01 09:00:00','2024-05-01 10:00:00','UX',50,150),
(12,'BARCELONA','MADRID','2024-05-02 09:00:00','2024-05-02 10:00:00','UX',65,150),
(13,'BARCELONA','MADRID','2024-05-03 09:00:00','2024-05-03 10:00:00','UX',100,1);



DROP TABLE IF EXISTS clientes;

create table clientes (dni varchar(9) not null, nombre varchar(40) not null, apellidos varchar(40) not null, sexo varchar(1) not null, 
fecha_nacimiento date not null, email varchar(40) not null) ENGINE=InnoDB;

alter table clientes add constraint pk_clientes primary key (dni);

insert into clientes (dni , nombre , apellidos , sexo , fecha_nacimiento, email) values
('12345678K','FERNANDO', 'ALONSO VEGA','H','1981-01-25','fernando.alonso@gmail.com'),
('11111111A','CARLOS', 'SAINZ LOPEZ','H','1979-04-15','carlos.sainz@gmail.com'),
('22222222B','CAROLINA', 'MARIN LOPEZ','M','1989-02-02','carolina.marin@gmail.com');


DROP TABLE IF EXISTS reservas;
create table reservas (id_reserva varchar(5), id_vuelo integer(5) not null, dni_cliente varchar(9), 
					   fecha_reserva timestamp, num_asientos integer(3), preciototal float(8)) ENGINE=InnoDB;

alter table reservas add constraint pk_reservas primary key (id_reserva,id_vuelo, dni_cliente,fecha_reserva);

alter table reservas add constraint fk_reservas1 foreign key (dni_cliente) references clientes(dni);
alter table reservas add constraint fk_reservas2 foreign key (id_vuelo) references vuelos(id_vuelo);

insert into reservas (id_reserva, id_vuelo, dni_cliente, fecha_reserva, num_asientos, preciototal) values
('R0001',2,'12345678K','2024-02-01 13:00:00',1,125),
('R0002',13,'12345678K','2024-02-01 13:30:00',3,300),
('R0002',11,'12345678K','2024-02-01 13:30:00',1,50),
('R0002',1,'12345678K','2024-02-01 13:30:00',1,100);


commit;	