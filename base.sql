create database devis;
use devis;

CREATE TABLE IF NOT EXISTS `client` (
`id_client` int(20)   AUTO_INCREMENT primary key ,
`nom` varchar(100) ,
`nb_devis` int(30) DEFAULT 0
)  ;

CREATE TABLE IF NOT EXISTS `AchatHistorique` (
`id_achat` int(20)  AUTO_INCREMENT primary key,
`id_client` varchar(20) ,
`achat` varchar(100) ,
`quantité` int(100) ,
`prix` int(100) ,
`nb_devis` int(20) 
)  ;

CREATE TABLE IF NOT EXISTS `Achat` (
`id_achat` int(20)  AUTO_INCREMENT primary key,
`id_client` varchar(20) ,
`achat` varchar(100) ,
`quantité` int(100) ,
`prix` int(100) ,
`nb_devis` int(20) 
)  ;

CREATE TABLE IF NOT EXISTS `historique` (
`id_historique` int(20)   AUTO_INCREMENT primary key,
`id_client` int(20) ,
`designation` varchar(100) ,
`nb_devis` int(20) 
)  ;
