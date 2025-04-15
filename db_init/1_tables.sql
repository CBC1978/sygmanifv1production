CREATE DATABASE IF NOT EXISTS sygmanifv2prod;
USE sygmanifv2prod;


CREATE TABLE `bonchargement` (
  `idbon` int(11) NOT NULL,
  `idposte` int(11) DEFAULT NULL,
  `typec` varchar(25) NOT NULL,
  `numerovehicule` varchar(80) DEFAULT NULL,
  `nomchaufeur` varchar(60) DEFAULT NULL,
  `idtransitaire` int(11) DEFAULT NULL,
  `marchandise` varchar(80) DEFAULT NULL,
  `poids` double(10,3) DEFAULT NULL,
  `nbrecolis` int(11) DEFAULT NULL,
  `nomdestinataire` varchar(80) DEFAULT NULL,
  `adresse` varchar(80) DEFAULT NULL,
  `datebon` date DEFAULT NULL,
  `createdby` varchar(60) DEFAULT NULL,
  `datecreation` datetime DEFAULT NULL,
  `modifyby` varchar(60) DEFAULT NULL,
  `datemodify` datetime DEFAULT NULL,
  `numbon` varchar(10) DEFAULT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compteur`
--

CREATE TABLE `compteur` (
  `numero` int(11) NOT NULL DEFAULT '0',
  `idposte` int(11) NOT NULL,
  `annee` year(4) NOT NULL DEFAULT '0000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `idgroupe` int(11) NOT NULL,
  `nomgroupe` varchar(50) DEFAULT NULL,
  `ajouter` char(1) DEFAULT NULL,
  `modifier` char(1) DEFAULT NULL,
  `supprimer` char(1) DEFAULT NULL,
  `gereruser` char(1) DEFAULT NULL,
  `administrateur` char(1) DEFAULT NULL,
  `gererfacture` char(1) DEFAULT NULL,
  `statistique` char(1) DEFAULT 'N',
  `statistiquec` char(1) DEFAULT 'N',
  `decideur` varchar(1) NOT NULL,
  `parametre` varchar(1) NOT NULL,
  `paramuser` varchar(1) NOT NULL,
  `conversion` char(1) DEFAULT 'N',
  `FactavoirAp` char(1) DEFAULT 'N',
  `FactavoirAc` char(1) DEFAULT 'N',
  `regrouper` char(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `port`
--

CREATE TABLE `port` (
  `idport` varchar(10) NOT NULL,
  `nomport` varchar(30) DEFAULT NULL,
  `idpays` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `idposte` int(11) NOT NULL,
  `libposte` varchar(50) DEFAULT NULL,
  `nomresponsable` varchar(50) DEFAULT NULL,
  `prenomresponsable` varchar(50) DEFAULT NULL,
  `contactposte` varchar(30) DEFAULT NULL,
  `faxposte` varchar(30) DEFAULT NULL,
  `emailposte` varchar(50) DEFAULT NULL,
  `titreposte` varchar(40) DEFAULT NULL,
  `titreresponsableng` varchar(40) NOT NULL,
  `posteexercice` int(11) DEFAULT NULL,
  `nomministere` varchar(80) DEFAULT NULL,
  `ministryname` varchar(80) DEFAULT NULL,
  `nomdirectiong` varchar(40) DEFAULT NULL,
  `directoryname` varchar(40) DEFAULT NULL,
  `nomsite` varchar(60) DEFAULT NULL,
  `sitename` varchar(60) DEFAULT NULL,
  `pays` varchar(30) DEFAULT NULL,
  `adresseposte` varchar(40) DEFAULT NULL,
  `libelleabrege` varchar(5) DEFAULT NULL,
  `villepost` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `signataire`
--

CREATE TABLE `signataire` (
  `idsignataire` int(11) NOT NULL,
  `nomprenom` varchar(70) DEFAULT NULL,
  `actif` char(9) DEFAULT 'N',
  `idposte` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `transitaire`
--

CREATE TABLE `transitaire` (
  `idtransitaire` int(11) NOT NULL,
  `nomtransitaire` varchar(80) NOT NULL,
  `idposte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` varchar(40) NOT NULL,
  `nomuser` varchar(50) DEFAULT NULL,
  `prenomuser` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `emailuser` varchar(50) DEFAULT NULL,
  `lieudetravail` varchar(50) DEFAULT NULL,
  `idgroupe` int(11) DEFAULT NULL,
  `idposte` int(11) DEFAULT NULL,
  `actif` int(1) DEFAULT '1',
  `id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bonchargement`
--
ALTER TABLE `bonchargement`
  ADD PRIMARY KEY (`idbon`);

--
-- Index pour la table `compteur`
--
ALTER TABLE `compteur`
  ADD PRIMARY KEY (`idposte`,`annee`,`numero`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`idgroupe`);

--
-- Index pour la table `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`idport`),
  ADD KEY `FK_port_idpays` (`idpays`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`idposte`);

--
-- Index pour la table `signataire`
--
ALTER TABLE `signataire`
  ADD PRIMARY KEY (`idsignataire`);

--
-- Index pour la table `transitaire`
--
ALTER TABLE `transitaire`
  ADD PRIMARY KEY (`idtransitaire`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idgroupe` (`idgroupe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bonchargement`
--
ALTER TABLE `bonchargement`
  MODIFY `idbon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `idgroupe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `signataire`
--
ALTER TABLE `signataire`
  MODIFY `idsignataire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transitaire`
--
ALTER TABLE `transitaire`
  MODIFY `idtransitaire` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
