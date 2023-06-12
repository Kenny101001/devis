create database devis;
use devis;

CREATE TABLE IF NOT EXISTS `client` (
`id_client` int(20)   AUTO_INCREMENT primary key ,
`nom` varchar(100) ,
`nb_devis` int(30) DEFAULT 0
)  ;

CREATE TABLE IF NOT EXISTS `AchatHistorique` (
`id_achat` int(20) NOT NULL primary key AUTO_INCREMENT,
`id_client` varchar(20) NOT NULL,
`achat` varchar(100) not null,
`quantité` int(100) not null,
`prix` int(100) not null,
`total` int(100) not null,
`pourcentage_tva` int(100) not null,
`total_TVA` int(100) not null,
`nb_devis` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `Achat` (
`id_achat` int(20) NOT NULL primary key AUTO_INCREMENT,
`id_client` varchar(20) NOT NULL,
`achat` varchar(100) not null,
`quantité` int(100) not null,
`prix` int(100) not null,
`total` int(100) not null,
`pourcentage_tva` int(100) not null,
`total_TVA` int(100) not null,
`nb_devis` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `historique` (
`id_historique` int(20) NOT NULL primary key AUTO_INCREMENT,
`id_client` int(20) NOT NULL,
`designation` varchar(100) not null,
`nb_devis` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE or replace view `V_totalClient` as (
SELECT AchatHistorique.id_client , sum(prix*quantité) as total
    FROM `AchatHistorique` GROUP by id_client;
)

CREATE or REPLACE view `V_prixTotal_mois` as ( 
SELECT v_totalclient.`id_client`, MonthName(historique.date) AS mois,v_totalclient.`total` FROM `v_totalclient` 
join historique on v_totalclient.id_client = historique.id_client);

