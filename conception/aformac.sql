-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  jeu. 07 fév. 2019 à 09:36
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
-- Structure de la table `apour`
--

CREATE TABLE `apour` (
  `idReponse` int(9) NOT NULL,
  `idNote` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

CREATE TABLE `contient` (
  `idQuestion` int(9) NOT NULL,
  `idQuestionnaire` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `est`
--

CREATE TABLE `est` (
  `idUtilisateur` int(9) NOT NULL,
  `idLieu` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fini`
--

CREATE TABLE `fini` (
  `idReponse` int(9) NOT NULL,
  `idResultat` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `idFormation` int(9) NOT NULL,
  `NomFormation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

CREATE TABLE `lieux` (
  `idLieu` int(9) NOT NULL,
  `LieuFormation` varchar(255) DEFAULT NULL
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
-- Structure de la table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `idQuestionnaire` int(9) NOT NULL,
  `NomQuestionnaire` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `idQuestion` int(9) NOT NULL,
  `IntituleQuestion` varchar(255) DEFAULT NULL,
  `idReponse` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponds`
--

CREATE TABLE `reponds` (
  `idUtilisateur` int(9) NOT NULL,
  `idReponse` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `idReponse` int(9) NOT NULL,
  `IntituleReponse` varchar(255) DEFAULT NULL,
  `idQuestion` int(9) DEFAULT NULL
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
  `NomRole` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idRole`, `NomRole`) VALUES
(1, 'SuperAdmin'),
(2, 'Admin'),
(3, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `selectionne`
--

CREATE TABLE `selectionne` (
  `idReponse` int(9) NOT NULL,
  `idType` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `suit`
--

CREATE TABLE `suit` (
  `idUtilisateur` int(9) NOT NULL,
  `idFormation` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `idType` int(9) NOT NULL,
  `NomType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(9) NOT NULL,
  `NomUtilisateur` varchar(255) DEFAULT NULL,
  `PrenomUtilisateur` varchar(255) DEFAULT NULL,
  `PseudoUtilisateur` varchar(255) NOT NULL,
  `MotDePasse` varchar(60) DEFAULT NULL,
  `DateEntreeFormation` date DEFAULT NULL,
  `idRole` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `NomUtilisateur`, `PrenomUtilisateur`, `PseudoUtilisateur`, `MotDePasse`, `DateEntreeFormation`, `idRole`) VALUES
(1, 'Fabien', '', '', 'coucou', '2019-02-07', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apour`
--
ALTER TABLE `apour`
  ADD PRIMARY KEY (`idReponse`,`idNote`),
  ADD KEY `FK_aPour_idNote` (`idNote`);

--
-- Index pour la table `contient`
--
ALTER TABLE `contient`
  ADD PRIMARY KEY (`idQuestion`,`idQuestionnaire`),
  ADD KEY `FK_contient_idQuestionnaire` (`idQuestionnaire`);

--
-- Index pour la table `est`
--
ALTER TABLE `est`
  ADD PRIMARY KEY (`idUtilisateur`,`idLieu`),
  ADD KEY `FK_Est_idLieu` (`idLieu`);

--
-- Index pour la table `fini`
--
ALTER TABLE `fini`
  ADD PRIMARY KEY (`idReponse`,`idResultat`),
  ADD KEY `FK_fini_idResultat` (`idResultat`);

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
-- Index pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`idQuestionnaire`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idQuestion`),
  ADD KEY `FK_Questions_idReponse` (`idReponse`);

--
-- Index pour la table `reponds`
--
ALTER TABLE `reponds`
  ADD PRIMARY KEY (`idUtilisateur`,`idReponse`),
  ADD KEY `FK_Reponds_idReponse` (`idReponse`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `FK_Reponses_idQuestion` (`idQuestion`);

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
-- Index pour la table `selectionne`
--
ALTER TABLE `selectionne`
  ADD PRIMARY KEY (`idReponse`,`idType`),
  ADD KEY `FK_Selectionne_idType` (`idType`);

--
-- Index pour la table `suit`
--
ALTER TABLE `suit`
  ADD PRIMARY KEY (`idUtilisateur`,`idFormation`),
  ADD KEY `FK_Suit_idFormation` (`idFormation`);

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
  ADD KEY `FK_Utilisateurs_idRole` (`idRole`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apour`
--
ALTER TABLE `apour`
  MODIFY `idReponse` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contient`
--
ALTER TABLE `contient`
  MODIFY `idQuestion` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `est`
--
ALTER TABLE `est`
  MODIFY `idUtilisateur` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fini`
--
ALTER TABLE `fini`
  MODIFY `idReponse` int(9) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `reponds`
--
ALTER TABLE `reponds`
  MODIFY `idUtilisateur` int(9) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idRole` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `selectionne`
--
ALTER TABLE `selectionne`
  MODIFY `idReponse` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suit`
--
ALTER TABLE `suit`
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
  MODIFY `idUtilisateur` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apour`
--
ALTER TABLE `apour`
  ADD CONSTRAINT `FK_aPour_idNote` FOREIGN KEY (`idNote`) REFERENCES `notes` (`idNote`),
  ADD CONSTRAINT `FK_aPour_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `FK_contient_idQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`idQuestion`),
  ADD CONSTRAINT `FK_contient_idQuestionnaire` FOREIGN KEY (`idQuestionnaire`) REFERENCES `questionnaires` (`idQuestionnaire`);

--
-- Contraintes pour la table `est`
--
ALTER TABLE `est`
  ADD CONSTRAINT `FK_Est_idLieu` FOREIGN KEY (`idLieu`) REFERENCES `lieux` (`idLieu`),
  ADD CONSTRAINT `FK_Est_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `fini`
--
ALTER TABLE `fini`
  ADD CONSTRAINT `FK_fini_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`),
  ADD CONSTRAINT `FK_fini_idResultat` FOREIGN KEY (`idResultat`) REFERENCES `resultat` (`idResultat`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_Questions_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`);

--
-- Contraintes pour la table `reponds`
--
ALTER TABLE `reponds`
  ADD CONSTRAINT `FK_Reponds_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`),
  ADD CONSTRAINT `FK_Reponds_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `FK_Reponses_idQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`idQuestion`);

--
-- Contraintes pour la table `selectionne`
--
ALTER TABLE `selectionne`
  ADD CONSTRAINT `FK_Selectionne_idReponse` FOREIGN KEY (`idReponse`) REFERENCES `reponses` (`idReponse`),
  ADD CONSTRAINT `FK_Selectionne_idType` FOREIGN KEY (`idType`) REFERENCES `types` (`idType`);

--
-- Contraintes pour la table `suit`
--
ALTER TABLE `suit`
  ADD CONSTRAINT `FK_Suit_idFormation` FOREIGN KEY (`idFormation`) REFERENCES `formations` (`idFormation`),
  ADD CONSTRAINT `FK_Suit_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `FK_Utilisateurs_idRole` FOREIGN KEY (`idRole`) REFERENCES `roles` (`idRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
