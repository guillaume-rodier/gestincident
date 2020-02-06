-- --------------------------------------------------------
-- Base de données :  GEST_INCIDENT
-- --------------------------------------------------------

DROP DATABASE IF EXISTS GEST_INCIDENT; -- On supprime la base
CREATE DATABASE GEST_INCIDENT; -- On recrée la base
USE GEST_INCIDENT; -- On définit quel base utiliser

--
-- Structure de la table NATURE_INCIDENT
--

CREATE TABLE NATURE_INCIDENT (
  id_nature int(11) AUTO_INCREMENT NOT NULL,
  libelle_nature varchar(255) NOT NULL,
  PRIMARY KEY (id_nature)
);

--
-- Contenu de la table NATURE_INCIDENT
--

INSERT INTO NATURE_INCIDENT VALUES (1, "Informatique");
INSERT INTO NATURE_INCIDENT VALUES (2, "Propreté");
INSERT INTO NATURE_INCIDENT VALUES (3, "Matériel");
INSERT INTO NATURE_INCIDENT VALUES (4, "Santé");
INSERT INTO NATURE_INCIDENT VALUES (5, "Vandalisme");

-- --------------------------------------------------------

--
-- Structure de la table RAPPORTEUR
--

CREATE TABLE RAPPORTEUR (
  id_rapporteur int(11) AUTO_INCREMENT NOT NULL,
  nom_rapporteur varchar(255) NOT NULL,
  prenom_rapporteur varchar(255) NOT NULL,
  PRIMARY KEY (id_rapporteur)
);

--
-- Contenu de la table RAPPORTEUR
--

INSERT INTO RAPPORTEUR VALUES (1, "Idasiak", "Mikaël");
INSERT INTO RAPPORTEUR VALUES (2, "Ammar", "Fethi");
INSERT INTO RAPPORTEUR VALUES (3, "Kintzler", "Agnès");
INSERT INTO RAPPORTEUR VALUES (4, "Laloy", "Hélène");
INSERT INTO RAPPORTEUR VALUES (5, "Plaisance", "Claire");
INSERT INTO RAPPORTEUR VALUES (6, "Blanchard", "Annie");
INSERT INTO RAPPORTEUR VALUES (7, "Daniel", "Gaël");
INSERT INTO RAPPORTEUR VALUES (8, "Dodemont", "Jean-Bernard");

-- --------------------------------------------------------

--
-- Structure de la table ETAT
--

CREATE TABLE ETAT (
  id_etat int(11) AUTO_INCREMENT NOT NULL,
  libelle_etat varchar(255) NOT NULL,
  PRIMARY KEY (id_etat)
);

--
-- Contenu de la table ETAT
--

INSERT INTO ETAT VALUES (1, "Ouvert");
INSERT INTO ETAT VALUES (2, "En Cours");
INSERT INTO ETAT VALUES (3, "Cloturé");

-- --------------------------------------------------------

--
-- Structure de la table INCIDENT
--

CREATE TABLE INCIDENT (
  id_incident int(11) AUTO_INCREMENT NOT NULL,
  idRapporteur int(11) NOT NULL,
  idNature int(11) NOT NULL,
  lieu_incident varchar(255) NOT NULL,
  description_incident text NOT NULL,
  severite_incident varchar(255) NOT NULL,
  date_incident date NOT NULL,
  idEtat int(11) NOT NULL,
  PRIMARY KEY (id_incident),
  FOREIGN KEY (idRapporteur) REFERENCES RAPPORTEUR (id_rapporteur),
  FOREIGN KEY (idNature) REFERENCES NATURE_INCIDENT (id_nature),
  FOREIGN KEY (idEtat) REFERENCES ETAT (id_etat)
);

--
-- Contenu de la table INCIDENT
--

INSERT INTO INCIDENT VALUES (1, 1, 1, "SL 28", "Coupure internet", "IMPORTANT", '2015-03-17', 3);
INSERT INTO INCIDENT VALUES (2, 2, 2, "SL 28", "Présence de rats", "IMPORTANT", '2015-03-25', 3);
INSERT INTO INCIDENT VALUES (3, 8, 3, "SL 28", "Explosion d'un ordinateur", "IMPORTANT", '2015-03-24', 2);
INSERT INTO INCIDENT VALUES (4, 3, 1, "SL 23", "Connexion impossible au serveur", "FAIBLE", '2015-03-17', 2);
INSERT INTO INCIDENT VALUES (5, 4, 1, "SL 28", "PC qui démarre sous ubuntu", "FAIBLE", '2015-03-22', 3);
INSERT INTO INCIDENT VALUES (6, 5, 3, "SL 28", "Étagère cassée", "FAIBLE", '2015-03-18', 1);
INSERT INTO INCIDENT VALUES (7, 6, 3, "SL 28", "Dégâts des eaux", "IMPORTANT", '2015-03-11', 2);
INSERT INTO INCIDENT VALUES (8, 7, 2, "Toilette", "Toilette sale", "FAIBLE", '2015-03-18', 1);
INSERT INTO INCIDENT VALUES (9, 8, 3, "Foyer", "Dégât des eaux", "IMPORTANT", '2015-03-09', 2);
INSERT INTO INCIDENT VALUES (10, 6, 4, "Infirmerie", "Crise d'épilepsie", "IMPORTANT", '2015-03-05', 3);
INSERT INTO INCIDENT VALUES (11, 3, 3, "Couloirs", "Début d'incendie", "IMPORTANT", '2015-03-01', 1);
INSERT INTO INCIDENT VALUES (12, 4, 5, "Couloirs", "Graffiti", "FAIBLE", '2015-03-02', 1);
INSERT INTO INCIDENT VALUES (13, 2, 4, "Infirmerie", "Crise d'angoisse", "IMPORTANT", '2015-03-04', 3);
INSERT INTO INCIDENT VALUES (14, 1, 5, "SL 28", "Vol de vidéo projecteur", "IMPORTANT", '2015-03-02', 1);





