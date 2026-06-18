-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 déc. 2025 à 09:14
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `m2_valres`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_salle`
--

CREATE TABLE `categorie_salle` (
  `id` int(2) NOT NULL,
  `libelle` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `categorie_salle`
--

INSERT INTO `categorie_salle` (`id`, `libelle`) VALUES
(10, 'Réunion'),
(20, 'Conférence'),
(30, 'Formation');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `salle_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `periode` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `utilisateur_id`, `salle_id`, `date`, `periode`) VALUES
(5, 1, 100, '2025-12-08 08:43:57', 1),
(6, 2, 200, '2025-12-13 08:43:57', 2),
(7, 3, 100, '2025-12-17 08:43:57', 1),
(8, 4, 100, '2025-12-20 08:43:57', 1),
(9, 5, 100, '2025-12-21 08:43:57', 1),
(10, 1, 100, '2025-12-23 08:43:57', 2),
(11, 6, 100, '2025-12-28 08:43:57', 1),
(12, 2, 200, '2025-12-28 08:43:57', 1),
(13, 3, 300, '2025-12-28 08:43:57', 1);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `salle_nom` varchar(32) NOT NULL,
  `categorie` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `salle_nom`, `categorie`) VALUES
(100, 'Salle Alpha', 10),
(200, 'Salle Bêta', 20),
(300, 'Salle Gamma', 30);

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

CREATE TABLE `structures` (
  `id` int(11) NOT NULL,
  `libelle` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `structures`
--

INSERT INTO `structures` (`id`, `libelle`) VALUES
(1, 'Siège Social'),
(2, 'Agence Ouest');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `utilisateur_id` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `structure_id` int(2) NOT NULL,
  `structure_nom` varchar(80) NOT NULL,
  `structure_adresse` varchar(80) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='utilisateurs ';

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`utilisateur_id`, `nom`, `prenom`, `structure_id`, `structure_nom`, `structure_adresse`, `mail`) VALUES
(1, 'Dupont', 'Jean', 1, '', '', 'jean.dupont@email.com'),
(2, 'Martin', 'Sophie', 1, '', '', 'sophie.martin@email.com'),
(3, 'Durand', 'Paul', 2, '', '', 'paul.durand@email.com'),
(4, 'Lefebvre', 'Alice', 1, '', '', 'alice.lefebvre@email.com'),
(5, 'Moreau', 'Lucas', 2, '', '', 'lucas.moreau@email.com'),
(6, 'Bernard', 'Julie', 1, '', '', 'julie.bernard@email.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie_salle`
--
ALTER TABLE `categorie_salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainteUtilisateurId` (`utilisateur_id`),
  ADD KEY `contrainteSalleId` (`salle_id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainteCategorieId` (`categorie`);

--
-- Index pour la table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`utilisateur_id`),
  ADD KEY `contrainteStructureId` (`structure_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `contrainteSalleId` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `contrainteUtilisateurId` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`);

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `contrainteCategorieId` FOREIGN KEY (`categorie`) REFERENCES `categorie_salle` (`id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `contrainteStructureId` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
