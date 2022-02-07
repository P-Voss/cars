create table car
(
    carid serial not null
        constraint car_carid_pk
            primary key,
    brand varchar(255) not null,
    model varchar(255) not null,
    hp int default 1,
    color char(7) default '#ffffff',
    price decimal(9,2)
);

create index car_carid_index
	on car (carid);

