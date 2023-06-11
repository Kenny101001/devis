create database devis;
use devis;

CREATE TABLE IF NOT EXISTS `client` (
`id_client` int(20) NOT NULL primary key,
`nom` varchar(100) NOT NULL,
`nb_devis` int(30) DEFAULT 0,
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `Achat` (
`id_achat` int(20) NOT NULL primary key,
`id_client` varchar(20) NOT NULL,
`achat` varchar(100) not null,
`quantité` int(100) not null,
`prix` int(100) not null
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `historique` (
`id_historique` int(20) NOT NULL primary key,
`id_client` int(20) NOT NULL,
`designation` varchar(100) not null,
`nb_devis` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
