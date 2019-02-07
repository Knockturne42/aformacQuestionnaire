-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  jeu. 07 fév. 2019 à 13:22
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `aformac`
--

-- --------------------------------------------------------

--
-- Structure de la table `apournote`
--

CREATE TABLE `apournote` (
  `idReponse` int(9) NOT NULL,
  `idNote` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `appartientquestion`
--

CREATE TABLE `appartientquestion` (
  `idReponse` int(9) NOT NULL,
  `idQuestion` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contenuquestionnaire`
--

CREATE TABLE `contenuquestionnaire` (
  `idQuestion` int(9) NOT NULL,
  `idQuestionnaire` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `donnereponse`
--

CREATE TABLE `donnereponse` (
  `idUtilisateur` int(9) NOT NULL,
  `idReponse` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `idFormation` int(9) NOT NULL,
  `nomFormation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

CREATE TABLE `lieux` (
  `idLieu` int(9) NOT NULL,
  `lieuFormation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `idNote` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `obtientresultat`
--

CREATE TABLE `obtientresultat` (
  `idReponse` int(9) NOT NULL,
  `idResultat` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `idQuestionnaire` int(9) NOT NULL,
  `nomQuestionnaire` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `idQuestion` int(9) NOT NULL,
  `intituleQuestion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `idReponse` int(9) NOT NULL,
  `intituleReponse` varchar(255) DEFAULT NULL,
  `idType` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE `resultat` (
  `idResultat` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `idRole` int(9) NOT NULL,
  `nomRole` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `selocalise`
--

CREATE TABLE `selocalise` (
  `idUtilisateur` int(9) NOT NULL,
  `idLieu` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `suitformation`
--

CREATE TABLE `suitformation` (
  `idUtilisateur` int(9) NOT NULL,
  `idFormation` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `idType` int(9) NOT NULL,
  `nomType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(9) NOT NULL,
  `nomUtilisateur` varchar(255) DEFAULT NULL,
  `prenomUtilisateur` varchar(255) DEFAULT NULL,
  `motDePasse` varchar(60) DEFAULT NULL,
  `dateEntreeFormation` date DEFAULT NULL,
  `idRole` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apournote`
--
ALTER TABLE `apournote`
  ADD PRIMARY KEY (`idReponse`,`idNote`),
  ADD KEY `FK_aPourNote_idNote` (`idNote`);

--
-- Index pour la table `appartientquestion`
--
ALTER TABLE `appartientquestion`
  ADD PRIMARY KEY (`idReponse`,`idQuestion`),
  ADD KEY `FK_appartientQuestion_idQuestion` (`idQuestion`);

--
-- Index pour la table `contenuquestionnaire`
--
ALTER TABLE `contenuquestionnaire`
  ADD PRIMARY KEY (`idQuestion`,`idQuestionnaire`),
  ADD KEY `FK_contenuQuestionnaire_idQuestionnaire` (`idQuestionnaire`);

--
-- Index pour la table `donnereponse`
--
ALTER TABLE `donnereponse`
  ADD PRIMARY KEY (`idUtilisateur`,`idReponse`),
  ADD KEY `FK_donneReponse_idReponse` (`idReponse`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`idFormation`);

--
-- Index pour la table `lieux`
--
ALTER TABLE `lieux`
  ADD PRIMARY KEY (`idLieu`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`idNote`);

--
-- Index pour la table `obtientresultat`
--
ALTER TABLE `obtientresultat`
  ADD PRIMARY KEY (`idReponse`,`idResultat`),
  ADD KEY `FK_obtientResultat_idResultat` (`idResultat`);

--
-- Index pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`idQuestionnaire`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `FK_reponses_idType` (`idType`);

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD PRIMARY KEY (`idResultat`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `selocalise`
--
ALTER TABLE `selocalise`
  ADD PRIMARY KEY (`idUtilisateur`,`idLieu`),
  ADD KEY `FK_seLocalise_idLieu` (`idLieu`);

--
-- Index pour la table `suitformation`
--
ALTER TABLE `suitformation`
  ADD PRIMARY KEY (`idUtilisateur`,`idFormation`),
  ADD KEY `FK_suitFormation_idFormation` (`idFormation`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`idType`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `FK_utilisateurs_idRole` (`idRole`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apournote`
--
ALTER TABLE `apournote`
  MODIFY `idReponse` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `appartientquestion`
--
ALTER TABLE `appartientquestion`
  MODIFY `idReponse` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contenuquestionnaire`
--
ALTER TABLE `contenuquestionnaire`
  MODIFY `idQuestion` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `donnereponse`
--
ALTER TABLE `donnereponse`
  MODIFY `idUtilisateur` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `idFormation` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieux`
--
ALTER TABLE `lieux`
  MODIFY `idLieu` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `idNote` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `obtientresultat`
--
ALTER TABLE `obtientresultat`
  MODIFY `idReponse` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `idQuestionnaire` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `idQuestion` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `idReponse` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `resultat`
--
ALTER TABLE `resultat`
  MODIFY `idResultat` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `idRole` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `selocalise`
--
ALTER TABLE `selocalise`
  MODIFY `idUtilisateur` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suitformation`
--
ALTER TABLE `suitformation`
  MODIFY `idUtilisateur` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `idType` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(9) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apournote`
--
ALTER TABLE `apournote`
  ADD CONSTRAINT `FK_aPourNote_idNote` FOREIGN KEY (`idNote`) REFERENCES `notes` (`idNote`),
  ADD CONSTRAINT `FK_aPourNote_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`);

--
-- Contraintes pour la table `appartientquestion`
--
ALTER TABLE `appartientquestion`
  ADD CONSTRAINT `FK_appartientQuestion_idQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`idQuestion`),
  ADD CONSTRAINT `FK_appartientQuestion_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`);

--
-- Contraintes pour la table `contenuquestionnaire`
--
ALTER TABLE `contenuquestionnaire`
  ADD CONSTRAINT `FK_contenuQuestionnaire_idQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`idQuestion`),
  ADD CONSTRAINT `FK_contenuQuestionnaire_idQuestionnaire` FOREIGN KEY (`idQuestionnaire`) REFERENCES `questionnaires` (`idQuestionnaire`);

--
-- Contraintes pour la table `donnereponse`
--
ALTER TABLE `donnereponse`
  ADD CONSTRAINT `FK_donneReponse_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`),
  ADD CONSTRAINT `FK_donneReponse_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `obtientresultat`
--
ALTER TABLE `obtientresultat`
  ADD CONSTRAINT `FK_obtientResultat_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`),
  ADD CONSTRAINT `FK_obtientResultat_idResultat` FOREIGN KEY (`idResultat`) REFERENCES `resultat` (`idResultat`);

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `FK_reponses_idType` FOREIGN KEY (`idType`) REFERENCES `types` (`idType`);

--
-- Contraintes pour la table `selocalise`
--
ALTER TABLE `selocalise`
  ADD CONSTRAINT `FK_seLocalise_idLieu` FOREIGN KEY (`idLieu`) REFERENCES `lieux` (`idLieu`),
  ADD CONSTRAINT `FK_seLocalise_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `suitformation`
--
ALTER TABLE `suitformation`
  ADD CONSTRAINT `FK_suitFormation_idFormation` FOREIGN KEY (`idFormation`) REFERENCES `formations` (`idFormation`),
  ADD CONSTRAINT `FK_suitFormation_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `FK_utilisateurs_idRole` FOREIGN KEY (`idRole`) REFERENCES `roles` (`idRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
