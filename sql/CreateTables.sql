create table item
(
	id serial not null primary key,
	name varchar(255) not null,
	producer varchar(255) not null
);

create table storelist
(
	id serial not null primary key references item(id),
	count int,
	price int not null
);

create table customer
(
	id serial not null primary key,
	name varchar(255) not null
);

create table sale_logs
(
	id serial not null primary key,
	customer_id int not null references customer(id),
	item_id int not null references item(id),
	count int not null default 1,
	time timestamptz default now()
);