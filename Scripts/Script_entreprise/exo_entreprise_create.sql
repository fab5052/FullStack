DROP DATABASE IF EXISTS `exo_entreprise`;
CREATE DATABASE IF NOT EXISTS `exo_entreprise`;
USE `exo_entreprise`;

CREATE TABLE dept (
	nodept 		varchar(50) NOT NULL PRIMARY KEY,
	nom 		varchar(50) NOT NULL,
	noregion 	varchar(50) NOT NULL
);

CREATE TABLE employe(
	noemp 		int NOT NULL PRIMARY KEY,
	nom 		varchar(50) NOT NULL,
	prenom 		varchar(50) NOT NULL,
	dateemb 	datetime NOT NULL,
	nosup 		varchar(50) NULL,
	titre 		varchar(50) NOT NULL,
	nodep 		varchar(50) NOT NULL REFERENCES dept(nodept),
	salaire 	decimal(18, 0) NOT NULL,
	tauxcom 	decimal(18, 0) NULL
);



INSERT INTO  dept  ( `nodept` ,  `nom` ,  `noregion` ) VALUES 
(10, 'finance', '1'),
(20, 'atelier', '2'),
(30, 'atelier', '3'),
(31, 'vente', '1'),
(32, 'vente', '2'),
(33, 'vente', '3'),
(34, 'vente', '4'),
(35, 'vente', '5'),
(41, 'distribution', '1'),
(42, 'distribution', '2'),
(43, 'distribution', '3'),
(44, 'distribution', '4'),
(45, 'distribution', '5'),
(50, 'administration', '1'),
(60, 'directeur','8');




INSERT INTO  employe  ( `noemp` ,  `nom` ,  `prenom` ,  `dateemb` ,  `nosup` ,  `titre` ,  `nodep` ,  `salaire` ,  `tauxcom` ) VALUES 
(1, 'patamob', 'adhémar', '20000326', NULL, 'président', '50', 50000, NULL),
(2, 'zeublouse', 'agathe', '20000415', '1', 'dir.distrib', '41', 35000, NULL),
(3, 'kuzbidon', 'alex', '20000505', '1', 'dir.vente', '31', 34000, NULL),
(4, 'locale', 'anasthasie', '20000525', '1', 'dir.finance', '10', 36000, NULL),
(5, 'teutmaronne', 'armand', '20000614', '1', 'dir.administratif', '50', 36000, NULL),
(6, 'zoudanlkou', 'debbie', '20000704', '2', 'chef entrepot', '41', 25000, NULL),
(7, 'rivenbusse', 'elsa', '20000724', '2', 'chef entrepot', '42', 24000, NULL),
(8, 'ardelpic', 'helmut', '20000813', '2', 'chef entrepot', '43', 23000, NULL),
(9, 'peursconla', 'humphrey', '20000902', '2', 'chef entrepot', '44', 22000, NULL),
(10, 'vrante', 'helena', '20000922', '2', 'chef entrepot', '45', 21000, NULL),
(11, 'melusine', 'enfaillite', '20001012', '3', 'représentant', '31', 25000, 10),
(12, 'eurktumeme', 'odile', '20001101', '3', 'représentant', '32', 26000, 12),
(13, 'hotdeugou', 'olaf', '20001121', '3', 'représentant', '33', 27000, 10),
(14, 'odlavieille', 'pacome', '20001211', '3', 'représentant', '34', 25000, 15),
(15, 'amartakaldire', 'quentin', '20001221', '3', 'représentant', '35', 23000, 17),
(16, 'traibien', 'samira', '20001231', '6', 'secrétaire', '41', 15000, NULL),
(17, 'fonfec', 'sophie', '20010110', '6', 'secrétaire', '41', 14000, NULL),
(18, 'fairent', 'teddy', '20010120', '7', 'secrétaire', '42', 13000, NULL),
(19, 'blaireur', 'terry', '20010209', '7', 'secrétaire', '42', 13000, NULL),
(20, 'ajerre', 'tex', '20010209', '8', 'secrétaire', '43', 13000, NULL),
(21, 'chmonfisse', 'thierry', '20010219', '8', 'secrétaire', '43', 12000, NULL),
(22, 'phototetedemort', 'thomas', '20010219', '9', 'secrétaire', '44', 22500, NULL),
(23, 'kaecoute', 'xavier', '20010301', '9', 'secrétaire', '34', 11500, NULL),
(24, 'adrouille-toutltan', 'yves', '20010311', '10', 'secrétaire', '45', 11000, NULL),
(25, 'anchier', 'yvon', '20010321', '10', 'secrétaire', '45', 10000, NULL),
(26, 'Herbomel', 'logan', '20021217', '10', 'dir.finance', '60', 40000, NULL),
(27, 'Herbomel', 'andre', '19620405', '10', 'chef entrepot', '45', 30000, NULL),
(28, 'Herbomel', 'sandra', '19720611', '10', 'secrétaire', '45', 25000, NULL);




-- UPDATE employe 
-- SET salaire = salaire*1.17
-- WHERE  noemp = 17;

-- UPDATE dept 
-- SET nom ='Logistique'
-- WHERE nodept = 45 ;


-- DELETE FROM  employe
-- WHERE noemp = 28;








