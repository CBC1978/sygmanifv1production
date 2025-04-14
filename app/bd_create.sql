

create table typeop (
idtypeop int auto_increment primary key,
nomtypeop varchar(60) not null,
unique(nomtypeop));

create table domainea(
iddomainea int auto_increment primary key,
nomdomainea varchar(60) not null,
unique(nomdomainea));

create table produit(
idprod int auto_increment primary key,
nomprod varchar(70) not null,
unique(nomprod));

create table operateur(
idop int auto_increment primary key,
nomope varchar(70) not null,
adresseop varchar(70) not null,
telephoneop1 varchar(15) not null,
telephoneop2 varchar(15),
telephoneop3 varchar(15),
faxop varchar(15),
emailop1 varchar(40),
emailop2 varchar(40),
localisationgeo varchar(100),
villeop varchar(70),
paysop varchar(70),
Personnedecontact varchar(80),
idtypeop int references typeop(idtypeop),
iddomainea int references domainea(iddomainea),
unique(nomope,adresseop),
unique(nomope,telephoneop1),
unique(telephoneop1),
unique(nomope,emailop1));

create table detailoprod(
iddetail int auto_increment primary key,
idop int references operateur(idop),
idprod int references produit(idprod) ,
unique(idop,idprod));

