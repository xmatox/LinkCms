<?php
$sql = "CREATE TABLE IF NOT EXISTS `".$prefix."catadmins` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `parent` int(2) NOT NULL,
  `ordre` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

INSERT INTO `".$prefix."catadmins` (`id`, `nom`, `controller`, `action`, `parent`, `ordre`) VALUES
(0, 'Catégories Mere', '', '', 0, 0),
(8, 'Rubriques Admin', 'Catadmins', 'index', 0, 90),
(21, 'Menu', 'menugroupes', 'list', 0, 2),
(15, 'Utilisateurs', 'Users', 'index', 0, 10),
(20, 'Rubriques', 'rubriques', 'list', 0, 0),
(22, 'Contenus', 'contenutypes', 'list', 0, 4),
(23, 'Graphisme', 'graphelements', 'edit', 0, 3),
(24, 'Zone', 'zoneelements', 'edit', 23, 1),
(25, 'Général', 'graphelements', 'edit', 23, 0),
(26, 'Paramètre', 'parametres', 'edit', 0, 8),
(27, 'Paramètre', 'parametres', 'edit', 26, 0),
(28, 'Langues', 'Languages', 'list', 26, 1),
(29, 'Css', 'styles', 'edit', 26, 3);

CREATE TABLE IF NOT EXISTS `".$prefix."contenutypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `table` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

INSERT INTO `".$prefix."contenutypes` (`id`, `nom`, `table`) VALUES
(0, 'Categorie', ''),
(1, 'Pages Libres', 'Pageslibres'),
(2, 'Diaporamas', 'Diaporamas'),
(7, 'Forms', 'Forms'),
(8, 'Multiples', 'Multiples'),
(10, 'Htmls', 'Htmls'),
(16, 'Google maps', 'Googlemaps');

CREATE TABLE IF NOT EXISTS `".$prefix."diaporamas` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `".$prefix."diaporamas` (`id`, `nom`, `selection`, `width`, `height`, `url`, `contenu`, `speed`, `pause`, `scroll`, `metatitle`, `metadescription`) VALUES
(1, 'Encart', 'vierge.jpg', 200, 150, '', '', 0, 0, '', '', ''),
(2, 'Entete', 'diapo_3.jpg', 695, 142, '', '', 1000, 5000, 'vertical', '', ''),
(3, 'Logo', 'defaut_logo.png', 303, 114, '/', '', 0, 0, '', '', ''),
(5, 'Réalisations', NULL, 750, 400, '', '<h1>Les Réalisations</h1><p>Voici quelques une de nos réalisations :</p>', 1000, 3000, 'fade', '', ''),
(6, 'Accueil', NULL, 780, 300, '', '', 1000, 5000, 'horizontal', '', '');

CREATE TABLE IF NOT EXISTS `".$prefix."elementtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `table` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

INSERT INTO `".$prefix."elementtypes` (`id`, `nom`, `table`) VALUES
(0, 'Langues', 'Languages'),
(1, 'Menus', 'Menugroupes'),
(2, 'Pages Libres', 'Pageslibres'),
(3, 'Diaporamas', 'Diaporamas'),
(8, 'Forms', 'Forms'),
(10, 'Htmls', 'Htmls'),
(18, 'Google maps', 'Googlemaps');

CREATE TABLE IF NOT EXISTS `".$prefix."formelements` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `".$prefix."formelements` (`id`, `nom`, `type`, `content`, `position`, `label`, `obligatoire`, `alignement`, `width`, `form_id`) VALUES
(1, 'Nom', 'text', '', 3, 1, 1, 'V', 150, 1),
(2, 'Texte intro', 'infomulti', '<h2>My Company</h2><p>	3 avenue Delarue<br />75000 Luchon</p><p>	Tel : 09 87 65 43 21</p><p>	Veuillez remplir tous les champs du formulaire</p>', 1, 0, 0, 'H', 400, 1),
(3, 'Email', 'text', '', 4, 1, 1, 'V', 200, 1),
(4, 'Texte', 'textarea', '', 5, 1, 0, 'V', 200, 1);

CREATE TABLE IF NOT EXISTS `".$prefix."forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `sendfrom` varchar(150) NOT NULL,
  `sendto` varchar(150) NOT NULL,
  `metatitle` varchar(150) DEFAULT NULL,
  `metadescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `".$prefix."forms` (`id`, `nom`, `sendfrom`, `sendto`, `metatitle`, `metadescription`) VALUES
(1, 'Contact', 'thomas.abadie@gmail.com', 'xmatox@free.fr', '', '');

CREATE TABLE IF NOT EXISTS `".$prefix."googlemaps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `contenu` text,
  `width` int(5) NOT NULL,
  `height` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `".$prefix."googlemaps` (`id`, `nom`, `adresse`, `contenu`, `width`, `height`) VALUES
(1, 'Luchon', 'Luchon', `<h2>Luchon</h2><p>	<img alt='' src='/cms/app/webroot/img/upload/images/thermes-luchon-13.jpg' style='width: 145px; height: 100px; float: left; margin-left: 10px; margin-right: 10px; ' /><b style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Luchon&nbsp;</b><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>est une&nbsp;</span><a href='http://fr.wikipedia.org/wiki/Commune_(France)' style='text-decoration: none; color: rgb(11, 0, 128); background-image: none; font-family: sans-serif; font-size: 13px; line-height: 19px; ' title='Commune (France)'>commune fran&ccedil;aise</a><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;situ&eacute;e dans le&nbsp;</span><a href='http://fr.wikipedia.org/wiki/D%C3%A9partement_fran%C3%A7ais' style='text-decoration: none; color: rgb(11, 0, 128); background-image: none; font-family: sans-serif; font-size: 13px; line-height: 19px; ' title='Département français'>d&eacute;partement</a><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;de la&nbsp;</span><a href='http://fr.wikipedia.org/wiki/Haute-Garonne' style='text-decoration: none; color: rgb(11, 0, 128); background-image: none; font-family: sans-serif; font-size: 13px; line-height: 19px; ' title='Haute-Garonne'>Haute-Garonne</a><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;et la r&eacute;gion&nbsp;</span><a href='http://fr.wikipedia.org/wiki/Midi-Pyr%C3%A9n%C3%A9es' style='text-decoration: none; color: rgb(11, 0, 128); background-image: none; font-family: sans-serif; font-size: 13px; line-height: 19px; ' title='Midi-Pyrénées'>Midi-Pyr&eacute;n&eacute;es</a><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>. Elle est surnomm&eacute;e &laquo;&nbsp;la reine des Pyr&eacute;n&eacute;es&nbsp;&raquo;. Ville thermale et climatique, elle est la station la plus fr&eacute;quent&eacute;e des&nbsp;</span><a href='http://fr.wikipedia.org/wiki/Pyr%C3%A9n%C3%A9es' style='text-decoration: none; color: rgb(11, 0, 128); background-image: none; font-family: sans-serif; font-size: 13px; line-height: 19px; ' title='Pyrénées'>Pyr&eacute;n&eacute;es</a><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>.</span></p>`, 400, 400);

CREATE TABLE IF NOT EXISTS `".$prefix."graphelements` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

INSERT INTO `".$prefix."graphelements` (`id`, `nom`, `active`, `width`, `height`, `fondcolor`, `fondimg`, `fondimgfolder`, `fondimgpos`, `fondimgrepeat`, `border`, `borderradius`, `margin`, `padding`, `float`, `textsize`, `textcolor`, `textalign`, `textgras`, `textfont`) VALUES
(1, 'fond', 1, NULL, NULL, '#555555', 'defaut_fond_4fd09ee40456f.jpg', NULL, '', 'repeat-x', NULL, NULL, '0px 0px 0px 0px ', '0px 0px 0px 0px ', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'contenu', 1, 1000, NULL, '#ffffff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'tete', 1, 1000, 168, '', 'defaut_tete_4fe1a3ab8505e.jpg', NULL, '', '', NULL, NULL, '0px 0px 0px 0px ', '0px 0px 0px 0px ', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'pied', 1, NULL, 31, '#1286eb', '', NULL, '', '', NULL, NULL, '0px 0px 0px 0px ', '0px 0px 0px 0px ', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'droite', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'gauche', 1, 210, NULL, '#ffffff', '', NULL, '', '', NULL, NULL, '0px 0px 0px 0px ', '0px 0px 0px 0px ', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'centre', 1, 780, NULL, '#ffffff', '', NULL, '', '', NULL, NULL, '0px 0px 0px 0px ', '10px 0px 0px 10px ', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'menu_Entete', 1, 200, 28, '', 'defaut_fondmenu_4fe1a3c79956c.jpg', NULL, '', 'repeat-x', '0px #ffffff solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '12px 0px 0px 0px ', 'left', '12pt', '#ffffff', 'center', 'bold', 'Verdana'),
(9, 'menu_Entete_roll', 1, NULL, NULL, '#eb9d17', '', NULL, '', '', '0px  solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '12px 0px 0px 0px ', '', '12', '#052df5', 'center', 'bold', 'Verdana'),
(10, 'menu_Entete_sous', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'menu_Entete_sousrl', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'menu_Encart', 1, 190, 28, '#0088ff', 'ff0000', NULL, '', '', '1px #95b9f0 solid', '10px 10px 10px 10px ', '0px 0px 10px 0px ', '12px 0px 0px 10px ', '', '#ffffff', '#ffffff', 'left', 'bold', NULL),
(13, 'menu_Encart_roll', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'ze_2', 1, 1000, 40, '', 'defaut_fondmenu_4fd7579f1bb5d.jpg', '', 'repeat-x', '0px  solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '0px 0px 0px 0px ', 'left', '', '', 'left', 'normal', NULL),
(17, 'ze_4', 1, 190, NULL, '#ffffff', '', NULL, '', '', '2px #3584fa solid', '10px 10px 10px 10px ', '15px 10px 5px 5px ', '5px 5px 5px 5px ', '', '', '', 'left', 'normal', NULL),
(19, 'ze_6', 1, 190, NULL, '', '', NULL, '', '', '0px  solid', '0px 0px 0px 0px ', '10px 10px 0px 5px ', '0px 0px 0px 0px ', '', '', '', 'left', 'normal', NULL),
(21, 'ze_8', 1, 200, NULL, '#ffffff', '', NULL, '', '', '2px #3584fa solid', '10px 10px 10px 10px ', '10px 0px 10px 5px ', '0px 0px 0px 0px ', '', '', '', 'left', 'normal', NULL),
(22, 'ze_9', 1, NULL, NULL, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '5px 0px 0px 0px ', '', '', '', 'left', 'bold', NULL),
(23, 'ze_10', 1, 695, 142, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 1px ', '0px 0px 0px 0px ', 'left', '', '', 'left', 'normal', NULL),
(26, 'ze_11', 1, NULL, NULL, '', 'defaut_tete_4fe1a389db734.jpg', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '0px 0px 0px 0px ', 'left', '', '', 'left', 'normal', NULL),
(27, 'ze_12', 1, 42, NULL, '#d3def2', '', NULL, '', '', '1px #436bb0 solid', '5px 5px 5px 5px ', '8px 0px 0px 930px ', '3px 2px 2px 6px ', 'left', '', '', 'left', 'normal', NULL),
(30, 'ze_fo1', 1, 400, NULL, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '', '', '', 'left', 'normal', NULL),
(36, 'menu_Accueil', 1, 100, 60, '#b4caf0', '', NULL, '', '', '1px #a1a1a1 solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '40px 0px 0px 0px ', '', '', '', 'center', 'bold', ''),
(37, 'menu_Accueil_roll', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'ze_me6', 1, NULL, NULL, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '0px 0px 10px 0px ', '', '', '', 'left', 'normal', NULL),
(39, 'ze_me7', 1, 650, 294, '#d3e0eb', '', NULL, '', '', '1px #8f8f8f solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '10px 0px 0px 20px ', 'left', '', '', 'left', 'normal', NULL),
(41, 'ze_me9', 1, 100, NULL, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '0px 0px 0px 0px ', 'left', '', '', 'left', 'normal', NULL),
(42, 'ze_me10', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'ze_me13', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'ze_me14', 1, NULL, NULL, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 40px ', '0px 0px 0px 0px ', '', '', '', 'left', 'normal', NULL),
(47, 'ze_me15', 1, NULL, NULL, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 0px ', '0px 0px 0px 0px ', 'left', '', '', 'left', 'normal', NULL),
(48, 'ze_me16', 1, NULL, NULL, '', '', NULL, '', '', '0px #000000 solid', '0px 0px 0px 0px ', '0px 0px 0px 20px ', '0px 0px 0px 0px ', 'left', '', '', 'left', 'normal', NULL);

CREATE TABLE IF NOT EXISTS `".$prefix."htmls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `contenuhtml` text NOT NULL,
  `contenucss` text NOT NULL,
  `contenujs` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `".$prefix."htmls` (`id`, `nom`, `contenuhtml`, `contenucss`, `contenujs`) VALUES
(1, 'test lala', '<a href='#' class='lala ' onclick='oui();return false;'>oui</a><img src=''/cms/img/content/anteiflag.jpg'' alt=''anteiflag.jpg'' />', '.lala{ border:1px #951684 solid !important; display:block; height:20px; width:200px; text-align:center; padding-top:6px }', 'function oui(){ alert('lala'); }');

CREATE TABLE IF NOT EXISTS `".$prefix."i18n` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=335 ;

INSERT INTO `".$prefix."i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(3, 'fre', 'Rubrique', 0, 'nom', 'Catégories Mère'),
(4, 'fre', 'Rubrique', 0, 'url', ''),
(13, 'fre', 'Rubrique', 4, 'nom', 'Présentation'),
(14, 'fre', 'Rubrique', 4, 'url', ''),
(15, 'fre', 'Rubrique', 5, 'nom', 'Activités'),
(16, 'fre', 'Rubrique', 5, 'url', ''),
(29, 'fre', 'Pageslibre', 1, 'nom', 'Accueil'),
(30, 'fre', 'Pageslibre', 1, 'contenu', '<p> 	Bonjour</p> '),
(31, 'fre', 'Pageslibre', 2, 'nom', 'Présentation'),
(32, 'fre', 'Pageslibre', 2, 'contenu', '<p> 	Bonjour,</p> <p> 	jn iedhyo f ohsof hd &nbsp;sioh dui dh fuhdsufh uds hf dhfu hdfh du hfdu hfuh fuhdf hdu fhds hfud fu hfu hdu hfu h fhd fuh dh u hufhdu hfu dhgu fhud hf fdh u fhd ufhd h.</p> <p> 	<img alt='' src='/cms/img/upload/images/maryse.jpg' style='margin-left: 10px; margin-right: 10px; float: left; width: 200px; height: 300px; ' /><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat. Proin feugiat, augue non elementum posuere, metus purus iaculis lectus, et tristique ligula justo vitae magna.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Aliquam convallis sollicitudin purus. Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus. Fusce vulputate sem at sapien. Vivamus leo. Aliquam euismod libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo. Suspendisse cursus rutrum augue. Nulla tincidunt tincidunt mi. Curabitur iaculis, lorem vel rhoncus faucibus, felis magna fermentum augue, et ultricies lacus lorem varius purus. Curabitur eu amet.</i></p> '),
(33, 'fre', 'Pageslibre', 3, 'nom', 'Encart'),
(34, 'fre', 'Pageslibre', 3, 'contenu', '<p style='text-align: center; '> 	<span style='color:#ff0000;'><span style='font-size: 16px; '><strong>Titre Encarts</strong></span></span></p> <p style='text-align: center; '> 	fh dsfhh fhsdo h &nbsp;hdjish<br /> 	&nbsp;yds qg df sgkf gkdg<br /> 	&nbsp;</p> <p style='text-align: center; '> 	<img alt='' src='/cms/img/upload/images/maryse-ouellet-diva-sexy-2.jpg' style='width: 133px; height: 200px; ' /></p> '),
(35, 'fre', 'Pageslibre', 4, 'nom', 'Entete'),
(36, 'fre', 'Pageslibre', 4, 'contenu', '<p> 	<span style='font-family:verdana,geneva,sans-serif;'><span style='font-size: 16px; '><span style='color: rgb(128, 0, 128); '><strong>Bienvenue sur le site</strong></span></span></span></p> '),
(37, 'fre', 'Pageslibre', 5, 'nom', 'Activités'),
(38, 'fre', 'Pageslibre', 5, 'contenu', '<p> 	&nbsp;fudshfu dfuh s h rdhfuhu fuhfg h fdg hu hfg hfdgh h<br /> 	&nbsp;fsuifgi sfgh sihfhdhu o<br /> 	&nbsp;fsuifhu hds fiuhsdfu h d fhui dshfu hdu hfud hfu hd fhu dhfu hdu hf ui dhfuihdi ghd</p> '),
(39, 'fre', 'Pageslibre', 6, 'nom', 'Pied de page'),
(40, 'fre', 'Pageslibre', 6, 'contenu', '<p style='text-align: center; '> 	<span style='color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: small; '>&copy; 2012 - Mentions l&eacute;gales - Cr&eacute;ation et d&eacute;veloppement : SOMA Cr&eacute;ation</span></p> '),
(41, 'eng', 'Pageslibre', 1, 'nom', 'Home'),
(42, 'eng', 'Pageslibre', 1, 'contenu', '<p> 	Hello</p> '),
(49, 'eng', 'Pageslibre', 2, 'nom', 'Presentation'),
(50, 'eng', 'Pageslibre', 2, 'contenu', '<p> 	&nbsp;</p> <p> 	Hi,</p> <p> 	jn iedhyo f ohsof hd &nbsp;sioh dui dh fuhdsufh uds hf dhfu hdfh du hfdu hfuh fuhdf hdu fhds hfud fu hfu hdu hfu h fhd fuh dh u hufhdu hfu dhgu fhud hf fdh u fhd ufhd h.</p> <p> 	<img alt='' src='/cms/img/upload/images/maryse.jpg' style='margin-left: 10px; margin-right: 10px; float: left; width: 200px; height: 300px; ' /><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat. Proin feugiat, augue non elementum posuere, metus purus iaculis lectus, et tristique ligula justo vitae magna.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Aliquam convallis sollicitudin purus. Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus. Fusce vulputate sem at sapien. Vivamus leo. Aliquam euismod libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo. Suspendisse cursus rutrum augue. Nulla tincidunt tincidunt mi. Curabitur iaculis, lorem vel rhoncus faucibus, felis magna fermentum augue, et ultricies lacus lorem varius purus. Curabitur eu amet.</i></p> '),
(51, 'eng', 'Pageslibre', 3, 'nom', 'Encart'),
(52, 'eng', 'Pageslibre', 3, 'contenu', '<p style='text-align: center; '> 	<span style='color: rgb(255, 0, 0); '><span style='font-size: 16px; '><strong>Title Encarts</strong></span></span></p> <p style='text-align: center; '> 	fh dsfhh fhsdo h &nbsp;hdjish<br /> 	&nbsp;yds qg df sgkf gkdg<br /> 	&nbsp;</p> <p style='text-align: center; '> 	<img alt='' src='/cms/img/upload/images/maryse-ouellet-diva-sexy-2.jpg' style='width: 133px; height: 200px; ' /></p> '),
(53, 'eng', 'Pageslibre', 4, 'nom', 'Header'),
(54, 'eng', 'Pageslibre', 4, 'contenu', '<p> 	<strong style='color: rgb(128, 0, 128); font-family: verdana, geneva, sans-serif; font-size: 16px; '>Welcome to the website</strong></p> '),
(55, 'eng', 'Pageslibre', 5, 'nom', ''),
(56, 'eng', 'Pageslibre', 5, 'contenu', ''),
(57, 'eng', 'Pageslibre', 6, 'nom', 'Footer'),
(58, 'eng', 'Pageslibre', 6, 'contenu', '<p style='text-align: center; '> 	<span style='color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: small; '>&copy; 2012 - Mentions l&eacute;gales - Cr&eacute;ation et d&eacute;veloppement : SOMA Cr&eacute;ation</span></p> '),
(59, 'spa', 'Pageslibre', 1, 'nom', ''),
(60, 'ger', 'Pageslibre', 1, 'nom', ''),
(61, 'spa', 'Pageslibre', 1, 'contenu', '<p> 	Olla</p> '),
(62, 'ger', 'Pageslibre', 1, 'contenu', '<p> 	Allo</p> '),
(67, 'fre', 'Rubrique', 6, 'nom', 'Professionnel'),
(71, 'fre', 'Rubrique', 6, 'url', ''),
(75, 'fre', 'Rubrique', 1, 'nom', 'Accueil'),
(79, 'fre', 'Rubrique', 1, 'url', ''),
(83, 'fre', 'Rubrique', 8, 'nom', 'L''entreprise'),
(87, 'fre', 'Rubrique', 8, 'url', ''),
(91, 'fre', 'Rubrique', 9, 'nom', 'Contact'),
(95, 'fre', 'Rubrique', 9, 'url', ''),
(111, 'spa', 'Pageslibre', 2, 'nom', 'Présentation'),
(112, 'ger', 'Pageslibre', 2, 'nom', ''),
(113, 'spa', 'Pageslibre', 2, 'contenu', '<p> 	Olla,</p> <p> 	jn iedhyo f ohsof hd &nbsp;sioh dui dh fuhdsufh uds hf dhfu hdfh du hfdu hfuh fuhdf hdu fhds hfud fu hfu hdu hfu h fhd fuh dh u hufhdu hfu dhgu fhud hf fdh u fhd ufhd h.</p> <p> 	<img alt='' src='/cms/img/upload/images/maryse.jpg' style='margin-left: 10px; margin-right: 10px; float: left; width: 200px; height: 300px; ' /><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat. Proin feugiat, augue non elementum posuere, metus purus iaculis lectus, et tristique ligula justo vitae magna.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Aliquam convallis sollicitudin purus. Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus. Fusce vulputate sem at sapien. Vivamus leo. Aliquam euismod libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo. Suspendisse cursus rutrum augue. Nulla tincidunt tincidunt mi. Curabitur iaculis, lorem vel rhoncus faucibus, felis magna fermentum augue, et ultricies lacus lorem varius purus. Curabitur eu amet.</i></p> '),
(114, 'ger', 'Pageslibre', 2, 'contenu', ''),
(115, 'fre', 'Form', 1, 'nom', 'Contact'),
(116, 'eng', 'Form', 1, 'nom', 'Contacts'),
(117, 'spa', 'Form', 1, 'nom', ''),
(118, 'ger', 'Form', 1, 'nom', ''),
(119, 'fre', 'Formelement', 1, 'nom', 'Nom'),
(120, 'eng', 'Formelement', 1, 'nom', 'Name'),
(121, 'spa', 'Formelement', 1, 'nom', ''),
(122, 'ger', 'Formelement', 1, 'nom', ''),
(123, 'fre', 'Formelement', 1, 'content', ''),
(124, 'eng', 'Formelement', 1, 'content', ''),
(125, 'spa', 'Formelement', 1, 'content', ''),
(126, 'ger', 'Formelement', 1, 'content', ''),
(127, 'fre', 'Formelement', 2, 'nom', 'Civilité'),
(128, 'eng', 'Formelement', 2, 'nom', ''),
(129, 'spa', 'Formelement', 2, 'nom', ''),
(130, 'ger', 'Formelement', 2, 'nom', ''),
(131, 'fre', 'Formelement', 2, 'content', 'Mlle;Mme;Mr'),
(132, 'eng', 'Formelement', 2, 'content', ''),
(133, 'spa', 'Formelement', 2, 'content', ''),
(134, 'ger', 'Formelement', 2, 'content', ''),
(135, 'fre', 'Formelement', 3, 'nom', 'Texte intro'),
(136, 'eng', 'Formelement', 3, 'nom', ''),
(137, 'spa', 'Formelement', 3, 'nom', ''),
(138, 'ger', 'Formelement', 3, 'nom', ''),
(139, 'fre', 'Formelement', 3, 'content', '<h2> 	My Company</h2> <p> 	3 avenue Delarue<br /> 	75000 Luchon</p> <p> 	&nbsp;</p> <p> 	Tel : 09 87 65 43 21</p> <p> 	&nbsp;</p> <p> 	Veuillez remplir tous les champs du formulaire</p> '),
(140, 'eng', 'Formelement', 3, 'content', ''),
(141, 'spa', 'Formelement', 3, 'content', ''),
(142, 'ger', 'Formelement', 3, 'content', ''),
(152, 'fre', 'Diaporama', 3, 'contenu', ''),
(153, 'fre', 'Diaporama', 2, 'contenu', ''),
(154, 'fre', 'Diaporama', 1, 'contenu', ''),
(155, 'eng', 'Diaporama', 1, 'contenu', ''),
(156, 'spa', 'Diaporama', 1, 'contenu', ''),
(157, 'ger', 'Diaporama', 1, 'contenu', ''),
(158, 'fre', 'Diaporama', 5, 'contenu', '<h1> 	Les R&eacute;alisations</h1> <p> 	Voici quelques une de nos r&eacute;alisations :</p> <p> 	&nbsp;</p> '),
(159, 'eng', 'Diaporama', 5, 'contenu', '<p> 	The realisation</p> '),
(160, 'spa', 'Diaporama', 5, 'contenu', '<p> 	Les R&eacute;alisations</p> '),
(161, 'ger', 'Diaporama', 5, 'contenu', ''),
(162, 'fre', 'Rubrique', 10, 'nom', 'Nos Réalisations'),
(166, 'fre', 'Rubrique', 10, 'url', 'LEs réalisations de l''entreprise'),
(170, 'eng', 'Diaporama', 2, 'contenu', ''),
(171, 'spa', 'Diaporama', 2, 'contenu', ''),
(172, 'ger', 'Diaporama', 2, 'contenu', ''),
(173, 'eng', 'Diaporama', 3, 'contenu', ''),
(174, 'spa', 'Diaporama', 3, 'contenu', ''),
(175, 'ger', 'Diaporama', 3, 'contenu', ''),
(176, 'fre', 'Rubrique', 11, 'nom', 'Accueil 2'),
(180, 'fre', 'Rubrique', 11, 'url', ''),
(184, 'fre', 'Rubrique', 12, 'nom', 'Présentation'),
(188, 'fre', 'Rubrique', 12, 'url', ''),
(192, 'fre', 'Diaporama', 6, 'contenu', ''),
(193, 'eng', 'Diaporama', 6, 'contenu', ''),
(194, 'spa', 'Diaporama', 6, 'contenu', ''),
(195, 'ger', 'Diaporama', 6, 'contenu', ''),
(196, 'fre', 'Pageslibre', 7, 'nom', 'Contenu accueil'),
(197, 'eng', 'Pageslibre', 7, 'nom', ''),
(198, 'spa', 'Pageslibre', 7, 'nom', ''),
(199, 'ger', 'Pageslibre', 7, 'nom', ''),
(200, 'fre', 'Pageslibre', 7, 'contenu', '<p> 	hifdo hfs odhf hdi hfhs f oi</p> <p> 	&nbsp;hufdosqd</p> <p> 	fdy suqgfuyidgsqfiq</p> '),
(201, 'eng', 'Pageslibre', 7, 'contenu', ''),
(202, 'spa', 'Pageslibre', 7, 'contenu', ''),
(203, 'ger', 'Pageslibre', 7, 'contenu', ''),
(204, 'fre', 'Rubrique', 4, 'metatitle', ''),
(205, 'fre', 'Rubrique', 4, 'metadescription', ''),
(211, 'fre', 'Rubrique', 12, 'metatitle', ''),
(213, 'fre', 'Rubrique', 12, 'metadescription', ''),
(214, 'fre', 'Rubrique', 1, 'metatitle', 'My Company - Everything and Nothing'),
(215, 'fre', 'Rubrique', 1, 'metadescription', 'My Company, Nous faisons tous et principalement rien'),
(216, 'fre', 'Rubrique', 5, 'metatitle', ''),
(217, 'fre', 'Rubrique', 5, 'metadescription', ''),
(218, 'fre', 'Rubrique', 8, 'metatitle', ''),
(219, 'fre', 'Rubrique', 8, 'metadescription', ''),
(220, 'fre', 'Rubrique', 9, 'metatitle', ''),
(221, 'fre', 'Rubrique', 9, 'metadescription', ''),
(222, 'fre', 'Rubrique', 10, 'metatitle', 'Nos réalisations'),
(223, 'fre', 'Rubrique', 10, 'metadescription', 'Réalisations de notre activité'),
(224, 'fre', 'Rubrique', 11, 'metatitle', NULL),
(225, 'fre', 'Rubrique', 11, 'metadescription', NULL),
(226, 'eng', 'Rubrique', 10, 'nom', ''),
(227, 'eng', 'Rubrique', 10, 'url', ''),
(228, 'eng', 'Rubrique', 10, 'metatitle', ''),
(229, 'eng', 'Rubrique', 10, 'metadescription', ''),
(230, 'eng', 'Rubrique', 1, 'nom', 'Home'),
(231, 'eng', 'Rubrique', 1, 'url', ''),
(232, 'eng', 'Rubrique', 1, 'metatitle', 'My Company - Everything and Nothing'),
(233, 'eng', 'Rubrique', 1, 'metadescription', 'My Company, we do everything and mainly nothing'),
(258, 'eng', 'Rubrique', 4, 'nom', ''),
(259, 'eng', 'Rubrique', 4, 'url', ''),
(260, 'eng', 'Rubrique', 4, 'metatitle', ''),
(261, 'eng', 'Rubrique', 4, 'metadescription', ''),
(262, 'eng', 'Rubrique', 5, 'nom', ''),
(263, 'eng', 'Rubrique', 5, 'url', ''),
(264, 'eng', 'Rubrique', 5, 'metatitle', ''),
(265, 'eng', 'Rubrique', 5, 'metadescription', ''),
(266, 'eng', 'Rubrique', 8, 'nom', ''),
(267, 'eng', 'Rubrique', 8, 'url', ''),
(268, 'eng', 'Rubrique', 8, 'metatitle', ''),
(269, 'eng', 'Rubrique', 8, 'metadescription', ''),
(270, 'eng', 'Rubrique', 9, 'nom', ''),
(271, 'eng', 'Rubrique', 9, 'url', ''),
(272, 'eng', 'Rubrique', 9, 'metatitle', ''),
(273, 'eng', 'Rubrique', 9, 'metadescription', ''),
(290, 'fre', 'Rubrique', 18, 'nom', 'trest'),
(291, 'eng', 'Rubrique', 18, 'nom', ''),
(292, 'fre', 'Rubrique', 18, 'url', ''),
(293, 'eng', 'Rubrique', 18, 'url', ''),
(294, 'fre', 'Rubrique', 18, 'metatitle', ''),
(295, 'eng', 'Rubrique', 18, 'metatitle', ''),
(296, 'fre', 'Rubrique', 18, 'metadescription', ''),
(297, 'eng', 'Rubrique', 18, 'metadescription', ''),
(298, 'fre', 'Rubrique', 19, 'nom', 'tres'),
(299, 'eng', 'Rubrique', 19, 'nom', ''),
(300, 'fre', 'Rubrique', 19, 'url', ''),
(301, 'eng', 'Rubrique', 19, 'url', ''),
(302, 'fre', 'Rubrique', 19, 'metatitle', ''),
(303, 'eng', 'Rubrique', 19, 'metatitle', ''),
(304, 'fre', 'Rubrique', 19, 'metadescription', ''),
(305, 'eng', 'Rubrique', 19, 'metadescription', ''),
(306, 'fre', 'Rubrique', 13, 'nom', 'carte'),
(307, 'eng', 'Rubrique', 13, 'nom', ''),
(308, 'fre', 'Rubrique', 13, 'url', ''),
(309, 'eng', 'Rubrique', 13, 'url', ''),
(310, 'fre', 'Rubrique', 13, 'metatitle', ''),
(311, 'eng', 'Rubrique', 13, 'metatitle', ''),
(312, 'fre', 'Rubrique', 13, 'metadescription', ''),
(313, 'eng', 'Rubrique', 13, 'metadescription', ''),
(314, 'fre', 'Formelement', 4, 'nom', 'Email'),
(315, 'eng', 'Formelement', 4, 'nom', ''),
(316, 'fre', 'Formelement', 4, 'content', ''),
(317, 'eng', 'Formelement', 4, 'content', ''),
(318, 'fre', 'Formelement', 5, 'nom', 'Texte'),
(319, 'eng', 'Formelement', 5, 'nom', ''),
(320, 'fre', 'Formelement', 5, 'content', ''),
(321, 'eng', 'Formelement', 5, 'content', ''),
(322, 'fre', 'Rubrique', 1, 'metakeyword', 'My Company,Everything,Nothing'),
(323, 'eng', 'Rubrique', 1, 'metakeyword', 'My Company,Everything,Nothing'),
(324, 'fre', 'Rubrique', 4, 'metakeyword', NULL),
(325, 'fre', 'Rubrique', 5, 'metakeyword', NULL),
(326, 'fre', 'Rubrique', 6, 'metakeyword', NULL),
(327, 'fre', 'Rubrique', 8, 'metakeyword', NULL),
(328, 'fre', 'Rubrique', 9, 'metakeyword', NULL),
(329, 'fre', 'Rubrique', 10, 'metakeyword', NULL),
(330, 'fre', 'Rubrique', 11, 'metakeyword', NULL),
(331, 'fre', 'Rubrique', 12, 'metakeyword', NULL),
(332, 'fre', 'Rubrique', 13, 'metakeyword', NULL),
(333, 'fre', 'Rubrique', 18, 'metakeyword', NULL),
(334, 'fre', 'Rubrique', 19, 'metakeyword', NULL);

CREATE TABLE IF NOT EXISTS `".$prefix."languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prefix` varchar(3) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `".$prefix."languages` (`id`, `nom`, `prefix`, `active`) VALUES
(1, 'Français', 'fre', 1),
(2, 'Anglais', 'eng', 1),
(6, 'Espagnol', 'spa', 0),
(7, 'Allemand', 'ger', 0),
(8, 'Japonnais', 'jap', 0),
(9, 'Russe', 'rus', 0),
(10, 'Chinois', 'chi', 0);

CREATE TABLE IF NOT EXISTS `".$prefix."menugroupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `graphelement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `".$prefix."menugroupes` (`id`, `nom`, `mobile`, `graphelement_id`) VALUES
(1, 'Entete', 1, 8),
(2, 'Encart', 0, 12),
(3, 'Accueil', 0, 36);

CREATE TABLE IF NOT EXISTS `".$prefix."menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `ordre` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `rubrique_id` int(11) NOT NULL,
  `menugroupe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

INSERT INTO `".$prefix."menus` (`id`, `nom`, `ordre`, `parent`, `rubrique_id`, `menugroupe_id`) VALUES
(3, '', 1, 0, 11, 2),
(5, '', 2, 0, 13, 2),
(8, '', 2, 0, 8, 1),
(11, '', 1, 0, 1, 1),
(12, '', 4, 0, 9, 1),
(13, '', 3, 0, 10, 1),
(14, '', 2, 0, 10, 3),
(15, '', 3, 0, 9, 3),
(16, '', 1, 0, 11, 3);

CREATE TABLE IF NOT EXISTS `".$prefix."multipleelements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordre` int(11) NOT NULL,
  `elementtype_id` int(11) DEFAULT NULL,
  `contenupage_id` int(11) DEFAULT NULL,
  `graphelement_id` int(11) DEFAULT NULL,
  `multiple_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

INSERT INTO `".$prefix."multipleelements` (`id`, `ordre`, `elementtype_id`, `contenupage_id`, `graphelement_id`, `multiple_id`) VALUES
(6, 1, 3, 6, 38, 1),
(7, 3, 2, 7, 39, 1),
(9, 2, 1, 3, 41, 1),
(10, 4, 2, 2, 42, 1),
(15, 0, 18, 1, 47, 4),
(16, 0, 8, 1, 48, 4);

CREATE TABLE IF NOT EXISTS `".$prefix."multiples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `".$prefix."multiples` (`id`, `nom`) VALUES
(1, 'Accueil'),
(4, 'Contact');

CREATE TABLE IF NOT EXISTS `".$prefix."pageslibres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `contenu` text NOT NULL,
  `metatitle` varchar(150) DEFAULT NULL,
  `metadescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO `".$prefix."pageslibres` (`id`, `nom`, `contenu`, `metatitle`, `metadescription`) VALUES
(1, 'Accueil', '<p> 	Bonjour</p> ', '', ''),
(2, 'Présentation', '<p> 	Bonjour,</p> <p> 	jn iedhyo f ohsof hd &nbsp;sioh dui dh fuhdsufh uds hf dhfu hdfh du hfdu hfuh fuhdf hdu fhds hfud fu hfu hdu hfu h fhd fuh dh u hufhdu hfu dhgu fhud hf fdh u fhd ufhd h.</p> <p> 	<img alt='' src='/cms/img/upload/images/maryse.jpg' style='margin-left: 10px; margin-right: 10px; float: left; width: 200px; height: 300px; ' /><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat. Proin feugiat, augue non elementum posuere, metus purus iaculis lectus, et tristique ligula justo vitae magna.</i><span style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>&nbsp;</span><i style='color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13px; line-height: 19px; '>Aliquam convallis sollicitudin purus. Praesent aliquam, enim at fermentum mollis, ligula massa adipiscing nisl, ac euismod nibh nisl eu lectus. Fusce vulputate sem at sapien. Vivamus leo. Aliquam euismod libero eu enim. Nulla nec felis sed leo placerat imperdiet. Aenean suscipit nulla in justo. Suspendisse cursus rutrum augue. Nulla tincidunt tincidunt mi. Curabitur iaculis, lorem vel rhoncus faucibus, felis magna fermentum augue, et ultricies lacus lorem varius purus. Curabitur eu amet.</i></p> ', '', ''),
(3, 'Encart', '<p style='text-align: center; '> 	<span style='color:#ff0000;'><span style='font-size: 16px; '><strong>Titre Encarts</strong></span></span></p> <p style='text-align: center; '> 	fh dsfhh fhsdo h &nbsp;hdjish<br /> 	&nbsp;yds qg df sgkf gkdg<br /> 	&nbsp;</p> <p style='text-align: center; '> 	<img alt='' src='/cms/img/upload/images/maryse-ouellet-diva-sexy-2.jpg' style='width: 133px; height: 200px; ' /></p> ', '', ''),
(4, 'Entete', '<p> 	<span style='font-family:verdana,geneva,sans-serif;'><span style='font-size: 16px; '><span style='color: rgb(128, 0, 128); '><strong>Bienvenue sur le site</strong></span></span></span></p> ', '', ''),
(5, 'Activités', '<p> 	&nbsp;fudshfu dfuh s h rdhfuhu fuhfg h fdg hu hfg hfdgh h<br /> 	&nbsp;fsuifgi sfgh sihfhdhu o<br /> 	&nbsp;fsuifhu hds fiuhsdfu h d fhui dshfu hdu hfud hfu hd fhu dhfu hdu hf ui dhfuihdi ghd</p> ', '', ''),
(6, 'Pied de page', '<p style='text-align: center; '> 	<span style='color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: small; '>&copy; 2012 - Mentions l&eacute;gales - Cr&eacute;ation et d&eacute;veloppement : SOMA Cr&eacute;ation</span></p> ', '', ''),
(7, 'Contenu accueil', '<p> 	hifdo hfs odhf hdi hfhs f oi</p> <p> 	&nbsp;hufdosqd</p> <p> 	fdy suqgfuyidgsqfiq</p> ', '', '');

CREATE TABLE IF NOT EXISTS `".$prefix."parametres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `".$prefix."parametres` (`id`, `intitule`, `nom`, `value`) VALUES
(1, 'Nom du site', 'nomsite', 'My Company'),
(2, 'Langue par defaut', 'langue', 'fre'),
(3, 'Dossier du site', 'prefix', '/cms'),
(4, 'Logo', 'logo', 'cena_spinwwe_cb_4ff6c9edd419b.jpg'),
(5, 'Favicon', 'icone', '1');

CREATE TABLE IF NOT EXISTS `".$prefix."rubriques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

INSERT INTO `".$prefix."rubriques` (`id`, `nom`, `url`, `parent`, `metatitle`, `metadescription`, `metakeyword`, `created`, `modified`, `contenutype_id`, `contenupage_id`) VALUES
(0, 'Catégories Mère', '', 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 4),
(1, 'Accueil', '', 0, 'My Company - Everything and Nothing', 'My Company, Nous faisons tous et principalement rien', 'My Company,Everything,Nothing', '0000-00-00 00:00:00', '2012-07-06 10:53:26', 1, 4),
(4, 'Présentation', '', 8, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2),
(5, 'Activités', '', 8, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 5),
(8, 'L''entreprise', '', 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 4),
(9, 'Contact', '', 0, '', '', '', '0000-00-00 00:00:00', '2012-07-06 10:26:17', 8, 4),
(10, 'Nos Réalisations', '', 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 5),
(11, 'Accueil 2', '', 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 1),
(12, 'Présentation', '', 1, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2),
(13, 'carte', '', 0, '', '', '', '2012-07-06 09:52:41', '2012-07-06 09:52:41', 15, 1);

CREATE TABLE IF NOT EXISTS `".$prefix."styles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `style` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

INSERT INTO `".$prefix."styles` (`id`, `nom`, `style`, `value`) VALUES
(1, 'Police du texte', 'font-family', 'Verdana'),
(2, 'Taille du texte', 'font-size', '12px'),
(3, 'Couleur du texte', 'color', '#000000'),
(4, 'Taille des liens', 'a_font-size', '12px'),
(5, 'Couleur des liens', 'a_color', '#3e6bde'),
(6, 'texte des liens', 'a_text-decoration', 'none'),
(7, 'Taille des liens (survol)', 'ah_fontsize', '12px'),
(8, 'Couleur des liens (survol)', 'ah_color', '#63abeb'),
(9, 'Texte des liens (survol)', 'ah_text-decoration', 'underline'),
(10, 'Police des titres', 'h1_font-family', 'Impact'),
(11, 'Couleur des titres', 'h1_color', '#1a4fb8'),
(12, 'Taille des titres', 'h1_font-size', '24px');

CREATE TABLE IF NOT EXISTS `".$prefix."users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `".$prefix."users` (`id`, `username`, `password`, `role`, `nom`, `prenom`, `created`, `modified`) VALUES
(4, 'soma', 'e0916741d0a763c1e0fc80e37527b4d8e768da15', 'admin', 'Soma', 'Creation', '0000-00-00 00:00:00', '2012-07-06 12:40:53');

CREATE TABLE IF NOT EXISTS `".$prefix."zoneelements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `ordre` int(11) NOT NULL,
  `elementtype_id` int(11) DEFAULT NULL,
  `contenupage_id` int(11) DEFAULT NULL,
  `graphelement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

INSERT INTO `".$prefix."zoneelements` (`id`, `nom`, `ordre`, `elementtype_id`, `contenupage_id`, `graphelement_id`) VALUES
(2, '', 4, 1, 1, 3),
(4, '', 2, 2, 3, 6),
(6, '', 1, 1, 2, 6),
(8, '', 3, 3, 1, 6),
(9, '', 0, 2, 6, 4),
(10, '', 3, 3, 2, 3),
(11, '', 2, 3, 3, 3),
(12, '', 1, 0, 0, 3),
(13, '', 1, NULL, NULL, NULL),
(14, '', 2, NULL, NULL, NULL),
(15, '', 2, NULL, NULL, NULL);
";
?>