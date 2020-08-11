-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 10 août 2020 à 15:41
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gbaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

CREATE TABLE `acteurs` (
  `id_acteur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`id_acteur`, `nom`, `description`, `image`) VALUES
(1, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. <br/>\r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.\r\n', 'CDE.png'),
(2, 'Formation & Co', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition : <br/>\r\n	un financement jusqu’à 30 000€ ;\r\n	un suivi personnalisé et gratuit ;\r\n	une lutte acharnée contre les freins sociétaux et les stéréotypes.\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.\r\n', 'formation_co.png'),
(3, 'Protect People', 'Protectpeople finance la solidarité nationale.<br/>\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\n	sociale : nous garantissons la fiabilité des données sociales ;\r\n	économique : nous apportons une contribution aux activités économiques.\r\n', 'protectpeople.png'),
(4, 'DSA France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.<br/>\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.<br/>\r\nNotre philosophie : s’adapter à chaque entreprise.<br/>\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises\r\n', 'Dsa_france.png');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_post` int(11) NOT NULL,
  `id_acteurs` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_post`, `id_acteurs`, `id_user`, `date`, `commentaire`) VALUES
(128, 2, 15, '2020-08-10 11:25:33', 'Formation &amp; Co'),
(129, 2, 18, '2020-08-10 11:26:12', 'Essaie Vick'),
(130, 2, 19, '2020-08-10 11:26:54', 'Essaie Bach'),
(131, 3, 15, '2020-08-10 15:27:03', 'Essaie');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp(),
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reponse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `date_inscription`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
(15, '2020-07-30 14:14:25', 'Degroise', 'Dimitri', 'DimitriA', '$2y$10$5MCyTo.xOGZK4avjw3QcsusJoP5880ovl.JLKUDN3N1KHW5U1YwcG', 'Club de foot préférer ', '$2y$10$LaF7xoZ//SepAidihwA9wOQtpr5zro7ayyXKLmmCS2.3DpUzNPBgy'),
(18, '2020-08-07 19:39:15', 'Bertorelli', 'Victorine', 'Vick', '$2y$10$7nlZCoRL4oeKpDKtF3HFCux0mdSK5qmdvb0lY.0PY1xglw3hdeLWy', 'Parfum préféré', '$2y$10$OyS4J3GNsZtQXSuDaezc3uX0H2a40sH/38boEzKYDS2lY7KdwJ1hy'),
(19, '2020-08-08 11:19:43', 'Mouloude', 'Bachir', 'Bach', '$2y$10$nKLJL7ht79f.v8lqMo76Q.dmxxBxCC64C4sHnXGibgLg5j8UTwz..', 'Ville de naissance', '$2y$10$21oKGa2uwcq./7nmUUcWg.2VAbtNe0ROg1jApcDwU8mjs6Mc9bx1C');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id_vote` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id_vote`, `id_user`, `id_acteur`, `vote`) VALUES
(76, 15, 3, 2),
(84, 18, 3, 1),
(86, 18, 4, 2),
(87, 18, 1, 2),
(88, 15, 1, 1),
(106, 15, 4, 2),
(114, 18, 2, 2),
(116, 15, 2, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteurs`
--
ALTER TABLE `acteurs`
  ADD PRIMARY KEY (`id_acteur`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id_vote`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteurs`
--
ALTER TABLE `acteurs`
  MODIFY `id_acteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
