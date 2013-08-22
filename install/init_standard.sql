
CREATE TABLE IF NOT EXISTS `__PREFIXcontenutypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `table` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXdiaporamas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `selection` varchar(100) DEFAULT NULL,
  `width` int(5) NOT NULL,
  `height` int(5) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `contenu` text,
  `speed` int(10) DEFAULT '1000',
  `pause` int(10) DEFAULT '5000',
  `scroll` varchar(50) DEFAULT 'horizontal',
  `metatitle` varchar(150) DEFAULT NULL,
  `metadescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXelementtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `table` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `__PREFIXformelements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `type` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `position` int(11) DEFAULT NULL,
  `label` tinyint(1) NOT NULL,
  `obligatoire` tinyint(1) DEFAULT NULL,
  `alignement` varchar(20) DEFAULT NULL,
  `width` int(3) DEFAULT NULL,
  `form_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXforms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `sendfrom` varchar(150) NOT NULL,
  `sendto` varchar(150) NOT NULL,
  `metatitle` varchar(150) DEFAULT NULL,
  `metadescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXgooglemaps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `contenu` text,
  `width` int(5) NOT NULL,
  `height` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXgraphelements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `width` varchar(11) DEFAULT NULL,
  `height` varchar(11) DEFAULT NULL,
  `fondcolor` varchar(15) DEFAULT NULL,
  `fondimg` varchar(100) DEFAULT NULL,
  `fondimgfolder` varchar(50) NOT NULL,
  `fondimgpos` varchar(50) DEFAULT NULL,
  `fondimgrepeat` varchar(15) DEFAULT NULL,
  `border` varchar(25) DEFAULT NULL,
  `borderradius` varchar(25) DEFAULT NULL,
  `margin` varchar(25) DEFAULT NULL,
  `padding` varchar(25) DEFAULT NULL,
  `float` varchar(15) DEFAULT NULL,
  `textsize` varchar(15) DEFAULT NULL,
  `textcolor` varchar(15) DEFAULT NULL,
  `textalign` varchar(15) DEFAULT NULL,
  `textgras` varchar(15) DEFAULT NULL,
  `textfont` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;  

CREATE TABLE IF NOT EXISTS `__PREFIXi18n` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXlanguages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prefix` varchar(3) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXmenugroupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `mobile` tinyint(1) NOT NULL,
  `graphelement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXmenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `ordre` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `rubrique_id` int(11) NOT NULL,
  `menugroupe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXpageslibres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `contenu` text NOT NULL,
  `metatitle` varchar(150) DEFAULT NULL,
  `metadescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXparametres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXrubriqueelements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordre` int(11) NOT NULL,
  `contenutype_id` int(11) DEFAULT NULL,
  `contenupage_id` int(11) DEFAULT NULL,
  `graphelement_id` int(11) DEFAULT NULL,
  `rubrique_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXrubriques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `img_btn` varchar(150) DEFAULT NULL,
  `img_btn_actif` varchar(150) DEFAULT NULL,
  `url` varchar(150) NOT NULL,
  `parent` int(11) NOT NULL,
  `metatitle` varchar(150) NOT NULL,
  `metadescription` varchar(255) NOT NULL,
  `metakeyword` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `contenutype_id` int(11) DEFAULT NULL,
  `contenupage_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXstyles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `style` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXusers` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

CREATE TABLE IF NOT EXISTS `__PREFIXzoneelements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `ordre` int(11) NOT NULL,
  `elementtype_id` int(11) DEFAULT NULL,
  `contenupage_id` int(11) DEFAULT NULL,
  `graphelement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ; 

INSERT INTO `__PREFIXcontenutypes` (`id`, `nom`, `table`) VALUES
(666, 'Categorie', ''),
(1, 'Pages Libres', 'Pageslibres'),
(2, 'Diaporamas', 'Diaporamas'),
(3, 'Forms', 'Forms') ;

UPDATE  `__PREFIXcontenutypes` SET  `id` =  '0' WHERE  `id` =666 ;

INSERT INTO `__PREFIXelementtypes` (`id`, `nom`, `table`) VALUES
(666, 'Langues', 'Languages'),
(1, 'Menus', 'Menugroupes'),
(2, 'Pages Libres', 'Pageslibres'),
(3, 'Diaporamas', 'Diaporamas'),
(4, 'Forms', 'Forms') ;

UPDATE  `__PREFIXelementtypes` SET  `id` =  '0' WHERE  `id` =666 ;

INSERT INTO `__PREFIXgraphelements` (`id`, `nom`, `active`, `width`, `height`, `fondcolor`, `fondimg`, `fondimgpos`, `fondimgrepeat`, `border`, `borderradius`, `margin`, `padding`, `float`, `textsize`, `textcolor`, `textalign`, `textgras`, `textfont`) VALUES
(1, 'fond', 1, NULL, NULL, '#555555', 'defaut_fond_4fd09ee40456f.jpg', '', 'repeat-x', NULL, NULL, '0px 0px 0px 0px ', '0px 0px 0px 0px ', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'contenu', 1, 1000, NULL, '#ffffff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'tete', 1, 1000, 168, '', 'defaut_tete_4fe1a3ab8505e.jpg', '', '', NULL, NULL, '0px 0px 0px 0px ', '0px 0px 0px 0px ', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'pied', 1, NULL, 31, '#1286eb', '', '', '', NULL, NULL, '0px 0px 0px 0px ', '0px 0px 0px 0px ', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'droite', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'gauche', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'centre', 1, 990, NULL, '#ffffff', '', '', '', NULL, NULL, '0px 0px 0px 0px ', '10px 0px 0px 10px ', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'menu_Général', 1, 200, 28, '', 'defaut_fondmenu_4fe1a3c79956c.jpg', '', 'repeat-x', '0px #ffffff solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '12px 0px 0px 0px ', 'left', '12pt', '#ffffff', 'center', 'bold', 'Verdana'),
(9, 'menu_Général_roll', 1, NULL, NULL, '#eb9d17', '', '', '', '0px  solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '12px 0px 0px 0px ', '', '12', '#052df5', 'center', 'bold', 'Verdana'),
(10, 'ze_1', 1, 1000, 40, '', 'defaut_fondmenu_4fd7579f1bb5d.jpg', '', 'repeat-x', '0px  solid', '0px 0px 0px 0px ', '130px 0px 0px 0px ', '0px 0px 0px 0px ', 'left', '', '', 'left', 'normal', NULL) ;

INSERT INTO `__PREFIXi18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'fre', 'Rubrique', 0, 'nom', 'Catégories Mère'),
(2, 'fre', 'Rubrique', 0, 'url', ''),
(3, 'fre', 'Rubrique', 0, 'metatitle', ''),
(4, 'fre', 'Rubrique', 0, 'metadescription', ''),
(5, 'fre', 'Rubrique', 0, 'metakeyword', ''),
(6, 'fre', 'Rubrique', 1, 'nom', 'Accueil'),
(7, 'fre', 'Rubrique', 1, 'url', ''),
(8, 'fre', 'Rubrique', 1, 'metatitle', ''),
(9, 'fre', 'Rubrique', 1, 'metadescription', ''),
(10, 'fre', 'Rubrique', 1, 'metakeyword', ''),
(11, 'fre', 'Pageslibre', 1, 'nom', 'Accueil'),
(12, 'fre', 'Pageslibre', 1, 'contenu', '<h1>\r\n  Bienvenue sur ...</h1>\r\n<p>\r\n Nous vous remer&ccedil;ions d&#39;utiliser ...</p>\r\n<p>\r\n Vous pouvez vous connecter &agrave; la console d&#39;administration<a href="admin666"><strong> ici</strong></a></p>\r\n<p>\r\n  Par d&eacute;faut votre login est votre <strong>adresse e-mail</strong> et le mot de passe : <strong>123123</strong><br />\r\n  <em>Pensez &agrave; le modifier d&egrave;s votre premi&egrave;re connection</em></p>\r\n<p>\r\n &nbsp;</p>\r\n<p>\r\n Pour plus de s&eacute;curit&eacute;s, nous vous conseillons de <strong>supprimer le dossier install</strong>.</p>\r\n<p>\r\n  &nbsp;</p>\r\n<p>\r\n N&#39;h&eacute;sitez pas &agrave; nous faire des retour sur ...@...</p>\r\n<p>\r\n  &nbsp;</p>\r\n<p>\r\n &nbsp;</p>\r\n<p>\r\n &nbsp;</p>\r\n<p>\r\n &nbsp;</p>\r\n') ;


INSERT INTO `__PREFIXlanguages` (`id`, `nom`, `prefix`, `active`, `admin`) VALUES
(1, 'Français', 'fre', 1, 1),
(2, 'Anglais', 'eng', 0, 0),
(3, 'Espagnol', 'spa', 0, 0),
(4, 'Allemand', 'ger', 0, 0),
(5, 'Japonnais', 'jap', 0, 0),
(6, 'Russe', 'rus', 0, 0),
(7, 'Chinois', 'chi', 0, 0) ;

INSERT INTO `__PREFIXmenugroupes` (`id`, `nom`, `mobile`, `graphelement_id`) VALUES
(1, 'Général', 1, 8) ;


INSERT INTO `__PREFIXmenus` (`id`, `nom`, `ordre`, `parent`, `rubrique_id`, `menugroupe_id`) VALUES
(1, '', 1, 0, 1, 1) ;

INSERT INTO `__PREFIXpageslibres` (`id`, `nom`, `contenu`, `metatitle`, `metadescription`) VALUES
(1, 'Accueil', '', '', '') ;

INSERT INTO `__PREFIXrubriques` (`id`, `nom`, `img_btn`, `img_btn_actif`, `url`, `parent`, `metatitle`, `metadescription`, `metakeyword`, `created`, `modified`, `contenutype_id`, `contenupage_id`) VALUES
(666, 'Catégories Mère','','','', 0, '', '', '', NOW(), NOW(), 1, 1),
(1, 'Accueil','','','', 0, 'My Company - Everything and Nothing', 'My Company, Nous faisons tous et principalement rien', 'My Company,Everything,Nothing', NOW(), NOW(), 1, 1) ;

UPDATE  `__PREFIXrubriques` SET  `id` =  '0' WHERE  `id` =666 ;

INSERT INTO `__PREFIXstyles` (`id`, `nom`, `style`, `value`) VALUES
(1, 'Police du texte', 'font-family', 'Verdana'),
(2, 'Taille du texte', 'font-size', '14px'),
(3, 'Couleur du texte', 'color', '#000000'),
(4, 'Taille des liens', 'a_font-size', '14px'),
(5, 'Couleur des liens', 'a_color', '#3e6bde'),
(6, 'texte des liens', 'a_text-decoration', 'none'),
(7, 'Taille des liens (survol)', 'ah_fontsize', '14px'),
(8, 'Couleur des liens (survol)', 'ah_color', '#63abeb'),
(9, 'Texte des liens (survol)', 'ah_text-decoration', 'underline'),
(10, 'Police des titres', 'h1_font-family', 'Arial'),
(11, 'Couleur des titres', 'h1_color', '#000000'),
(12, 'Taille des titres', 'h1_font-size', '30px'),
(13, 'Police des sous-titres', 'h2_font-family', 'Arial'),
(14, 'Couleur des sous-titres', 'h2_color', '#000000'),
(15, 'Taille des sous-titres', 'h2_font-size', '24px') ;

INSERT INTO `__PREFIXzoneelements` (`id`, `nom`, `ordre`, `elementtype_id`, `contenupage_id`, `graphelement_id`) VALUES
(1, '', 0, 1, 1, 3) ;