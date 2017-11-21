-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Lis 2017, 10:39
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(15, 'Java '),
(16, 'PHP'),
(28, 'HTML5'),
(29, 'CSS'),
(31, 'python');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(2, 10, 'Krzysztof Heigel', 'kfheigel@gmail.com', 'This is a typical and normal comment', 'Approved', '2017-10-02'),
(3, 2, 'Cindy', 'kh@gmail.com', 'I am the best mdel in the world', 'Approved', '2017-10-04'),
(5, 8, 'Kasia Smasia', 'kasia@kasia.com', 'sfdghjhgdsae', 'Approved', '2017-10-04'),
(6, 2, 'Peter', 'peter@pet.com', 'This is just another coment', 'Approved', '2017-10-04'),
(7, 2, 'Andrew', 'andrew@garfield.com', 'This lasagna stinks!', 'Approved', '2017-10-04'),
(8, 2, 'hualin', 'nua@lin.com', 'hi my name is hualin', 'Approved', '2017-10-04'),
(9, 11, 'kokorino', 'koko@o2.pl', 'Hey its jus  a omoent', 'Unapproved', '2017-10-17'),
(11, 11, 'dddd', 'Dd#22rf@gmail.co', 'fsa', 'Approved', '2017-10-30');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(52, 12, 'PHP is the best!', 'Krzysztof Heigel', 'Gambit', '2017-11-08', 'image_2.jpg', '<p>Lalalalalal</p>', 'bezrobotny na etacie', 0, 'published', 7),
(53, 29, 'Python the most accurate language', '', 'klekseusz', '2017-11-09', 'image_4.jpg', '<p><span style=\"color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\">DziÄ™ki </span><img class=\"_1ift _2560 img\" style=\"border: 0px; display: inline-block; pointer-events: none; vertical-align: middle; height: 16px; margin: 0px 1px; width: 16px; color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\" src=\"https://www.facebook.com/images/emoji.php/v9/z75/1/16/1f618.png\" alt=\"ðŸ˜˜\" /><span style=\"color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\"> chuj musiaÅ‚ tak nagle mnie zaatakowaÄ‡</span></p>', 'python, users, language', 0, 'published', 3),
(54, 23, 'test 1', '', 'klekseusz', '2017-11-09', 'image_3.jpg', '<p>content</p>', 'java', 0, 'published', 0),
(62, 15, 'test 1', '', 'klekseusz', '2017-11-08', 'image_3.jpg', '<p>content</p>', 'java', 0, 'published', 4),
(63, 28, 'Python the most accurate language', '', 'klekseusz', '2017-11-09', 'image_4.jpg', '<p><span style=\"color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\">DziÄ™ki </span><img class=\"_1ift _2560 img\" style=\"border: 0px; display: inline-block; pointer-events: none; vertical-align: middle; height: 16px; margin: 0px 1px; width: 16px; color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\" src=\"https://www.facebook.com/images/emoji.php/v9/z75/1/16/1f618.png\" alt=\"ðŸ˜˜\" /><span style=\"color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\"> chuj musiaÅ‚ tak nagle mnie zaatakowaÄ‡</span></p>', 'python, users, language', 0, 'published', 1),
(66, 15, 'test 1', '', 'klekseusz', '2017-11-09', 'image_3.jpg', '<p>content</p>', 'java', 0, 'published', 1),
(67, 15, 'test 1', '', 'klekseusz', '2017-11-09', 'image_3.jpg', '<p>content</p>', 'java', 0, 'published', 0),
(68, 12, 'Python the most accurate language', '', 'klekseusz', '2017-11-09', 'image_4.jpg', '<p><span style=\"color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\">DziÄ™ki </span><img class=\"_1ift _2560 img\" style=\"border: 0px; display: inline-block; pointer-events: none; vertical-align: middle; height: 16px; margin: 0px 1px; width: 16px; color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\" src=\"https://www.facebook.com/images/emoji.php/v9/z75/1/16/1f618.png\" alt=\"ðŸ˜˜\" /><span style=\"color: #4b4f56; font-family: Helvetica, Arial, sans-serif; font-size: 12px; white-space: pre-wrap; background-color: #f1f0f0;\"> chuj musiaÅ‚ tak nagle mnie zaatakowaÄ‡</span></p>', 'python, users, language', 0, 'published', 2),
(69, 12, 'PHP is the best!', '', 'Gambit', '2017-11-10', 'image_2.jpg', '<p>Lalalalalal</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'bezrobotny na etacie', 0, 'published', 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(4, 'Go_Pingu', 'pingwin', 'Kasia', 'Mirowska', 'go_pingu@pingwin.pl', '2017-04-14 13.44.59.jpg', 'Subscriber', '', ''),
(8, 'WubbaLubba', 'mortysmith', 'Morty', 'Sanchez', 'c137@dimension.com', '', 'Subscriber', '', ''),
(11, 'squanch_cat', 'squanch', 'quenchy', 'squanch', 'quenchi@squanch.com', '', 'Subscriber', '', ''),
(12, 'Kokokokokoko', 'kokokoko', 'Kokonauta', 'kurwa', 'koko@koko.pl', '', 'Subscriber', '', ''),
(15, 'Marcopolo', 'marcopolo', 'Marko', 'Polo', 'marco@polo.pl', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', ''),
(17, 'Gambit', 'ssdfghj', 'Robert', 'Sandro', 'gambit344@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', ''),
(19, 'demo', '$1$Dc/.Qe3.$iB8yW/C5vtXJoH/TAAiXk/', 'demo', 'demon', 'demo@yahoo.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(20, 'new_user', '$2y$10$Bwsv9Ov7FeeUUi2dG7JHrOeqFhI2a3aMyu3Heq7RXu0j6Mvc5dEt.', '', '', 'user@at.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(21, 'peter', '$2y$10$NTkAg2y.7XdAylXGNlcHqun1xTj8PheovztSHkhd84bJFu0Nt4BBO', '', '', 'peter@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(22, 'peteee', '$2y$10$wJP0HKlrWEyeELR.f7xuk.etLejV.b5XWf/W1X1bh3JIqMKDWqi6m', 'Pete', 'William', 'peeeet@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(26, 'klekseusz', '', 'Krzysztof', 'Heigel', 'kfheigel@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(6, 'sl9nlba6cjpbikk7vltvb2lub6', 1510089776),
(7, '2s752miuge232cq6d71tlumrm2', 1510150804),
(8, 'j6271uuek9rfoceg3c87rhsj01', 1510234196),
(9, 'ca9191lble4m8ac7r2ittv0at0', 1510261122),
(10, '1rmsml036j79i09vgqqtsf5vs0', 1510314830),
(11, 'dcu0qdprutudtdd2t1l0j0u9v7', 1510729053),
(12, 'lri95mmaqec4sipu0pcu7hl3k6', 1510831461),
(13, 'ha96ark8o1ockpcu3kic1taeo3', 1511124950),
(14, 'hdouu5oa203naog6no5jrb18i3', 1511177783);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT dla tabeli `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
