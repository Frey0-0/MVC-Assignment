
CREATE TABLE users(
    username varchar(255),
    password varchar(255),
    status int
);

CREATE TABLE books(
    name varchar(80),
    username varchar(80),
    quantity int,
    date int,
    month int,
    year int,
    status int
);

CREATE TABLE adminreq(
    username varchar(255),
    password varchar(255)
);

INSERT INTO users VALUES("Thor","$2y$10$yifnRRLNU1Edr8mBo1ibnOn1AZHqzEcZz7AO24vWNtRE2lp3Nmrpe",1);

INSERT INTO books VALUES("Maths",NULL,10,NULL,NULL,NULL,NULL);
INSERT INTO books VALUES("Physics",NULL,20,NULL,NULL,NULL,NULL);
INSERT INTO books VALUES("Chemistry",NULL,30,NULL,NULL,NULL,NULL);
INSERT INTO books VALUES("English",NULL,40,NULL,NULL,NULL,NULL);
INSERT INTO books VALUES("Computer",NULL,50,NULL,NULL,NULL,NULL);