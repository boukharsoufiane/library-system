CREATE TABLE membre (
id_membre INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
first_name VARCHAR(50) NOT NULL,
last_name VARCHAR(50) NOT NULL,
username VARCHAR(50) NOT NULL,
email VARCHAR(30) NOT NULL,
phone VARCHAR(13) NOT NULL,
type_membre VARCHAR(30) NOT NULL,
ID_card VARCHAR(13) NOT NULL,
date_inscription DATE NOT NULL,
banned INT NOT NULL,
password VARCHAR(1000) NOT NULL
);

CREATE TABLE ouvrage (
id_ouvrage INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name_ouvrage VARCHAR(50) NOT NULL,
state_ouvrage VARCHAR(50) NOT NULL,
date_achat DATE NOT NULL,
date_edition DATE NOT NULL,
type_ouvrage VARCHAR(50) NOT NULL,
pages_ouvrage INT NOT NULL,
image_main VARCHAR(1000) NOT NULL
);

CREATE TABLE reservation (
id_reservation INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
date_reservation DATE NOT NULL,
state_reservation VARCHAR(200) NOT NULL,
id_membre INT NOT NULL,
id_ouvrage INT NOT NULL,
FOREIGN KEY (id_membre) REFERENCES membre(id_membre),
FOREIGN KEY (id_ouvrage) REFERENCES ouvrage(id_ouvrage)
);

CREATE TABLE gerant (
id_gerant INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
first_name VARCHAR(50) NOT NULL,
last_name VARCHAR(50) NOT NULL,
email VARCHAR(30) NOT NULL,
password_system VARCHAR(1000) NOT NULL,
password VARCHAR(1000) NOT NULL
);

CREATE TABLE emprunts (
id_emprunt INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
date_emprunt DATE NOT NULL,
date_retour DATE NULL,
id_reservation INT NOT NULL,
id_gerant_valide INT NOT NULL,
id_gerant_retour INT NULL,
FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation),
FOREIGN KEY (id_gerant_valide) REFERENCES gerant(id_gerant),
FOREIGN KEY (id_gerant_retour) REFERENCES gerant(id_gerant)
);

CREATE TABLE gestion (
id_gestion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
id_ouvrage INT NOT NULL,
id_gerant INT NOT NULL,
type_operation VARCHAR(50) NOT NULL,
date_operation DATE NOT NULL,
FOREIGN KEY (id_ouvrage) REFERENCES ouvrage(id_ouvrage),
FOREIGN KEY (id_gerant) REFERENCES gerant(id_gerant)
);

CREATE INDEX idx_id_res ON reservation (id_reservation);
CREATE INDEX idx_id_ouv ON ouvrage (id_ouvrage);
CREATE INDEX idx_id_ger ON gerant (id_gerant);
CREATE INDEX idx_id_mem ON membre (id_membre);
CREATE INDEX idx_id_emp ON emprunts (id_emprunt);
CREATE INDEX idx_id_ges ON gestion (id_gestion);


