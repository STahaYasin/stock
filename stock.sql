-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 feb 2018 om 03:40
-- Serverversie: 10.1.10-MariaDB
-- PHP-versie: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `asx465stock_addresses`
--

CREATE TABLE `asx465stock_addresses` (
  `asx465stock_addresses_id` int(11) NOT NULL,
  `asx465stock_addresses_street` varchar(50) NOT NULL,
  `asx465stock_addresses_nr` varchar(20) NOT NULL,
  `asx465stock_addresses_zip` varchar(20) NOT NULL,
  `asx465stock_addressecity` varchar(20) NOT NULL,
  `asx465stock_addresses_country` varchar(20) NOT NULL,
  `asx465stock_addresses_type` int(1) NOT NULL,
  `asx465stock_addresses_oid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `asx465stock_addresses`
--

INSERT INTO `asx465stock_addresses` (`asx465stock_addresses_id`, `asx465stock_addresses_street`, `asx465stock_addresses_nr`, `asx465stock_addresses_zip`, `asx465stock_addressecity`, `asx465stock_addresses_country`, `asx465stock_addresses_type`, `asx465stock_addresses_oid`) VALUES
(8, 'Langestuivenbergstra', '44', '2000', 'Antwerpen', 'Belgie', 2, 13),
(9, 'Kerhanse sokagi', '69', '2400', 'Mol', 'jhljh', 2, 14);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dsl856stock_users`
--

CREATE TABLE `dsl856stock_users` (
  `dsl856stock_users_id` int(11) NOT NULL,
  `dsl856stock_users_fname` varchar(10) NOT NULL,
  `dsl856stock_users_mname` varchar(10) NOT NULL,
  `dsl856stock_users_lname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `dsl856stock_users`
--

INSERT INTO `dsl856stock_users` (`dsl856stock_users_id`, `dsl856stock_users_fname`, `dsl856stock_users_mname`, `dsl856stock_users_lname`) VALUES
(23, 'Taha', 'Yasin', 'Savran'),
(26, 'kerim', '', 'savran');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rdl632stock_emails`
--

CREATE TABLE `rdl632stock_emails` (
  `rdl632stock_emails_id` int(11) NOT NULL,
  `rdl632stock_emails_uid` int(11) NOT NULL,
  `rdl632stock_emails_email` varchar(25) NOT NULL,
  `rdl632stock_emails_ok` int(1) NOT NULL,
  `rdl632stock_emails_date` varchar(20) NOT NULL,
  `rdl632stock_emails_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `rdl632stock_emails`
--

INSERT INTO `rdl632stock_emails` (`rdl632stock_emails_id`, `rdl632stock_emails_uid`, `rdl632stock_emails_email`, `rdl632stock_emails_ok`, `rdl632stock_emails_date`, `rdl632stock_emails_type`) VALUES
(17, 23, 'savrantaha@hotmail.com', 0, '30/Jan/2018 21:56:22', 1),
(20, 26, 'savrankerim@hotmail.com', 0, '31/01/2018 01:52:33', 1),
(24, 13, 'info@tahayasin.be', 0, '01/02/2018 00:12:35', 2),
(25, 14, 'lk', 0, '01/02/2018 00:14:32', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sha243stock_shoprelations`
--

CREATE TABLE `sha243stock_shoprelations` (
  `sha243stock_shoprelations_id` int(11) NOT NULL,
  `sha243stock_shoprelations_uid` int(11) NOT NULL,
  `sha243stock_shoprelations_sid` int(11) NOT NULL,
  `sha243stock_shoprelations_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sha243stock_shoprelations`
--

INSERT INTO `sha243stock_shoprelations` (`sha243stock_shoprelations_id`, `sha243stock_shoprelations_uid`, `sha243stock_shoprelations_sid`, `sha243stock_shoprelations_type`) VALUES
(3, 23, 13, 1),
(4, 23, 14, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sho785stock_shops`
--

CREATE TABLE `sho785stock_shops` (
  `sho785stock_shops_id` int(11) NOT NULL,
  `sho785stock_shops_name` varchar(30) NOT NULL,
  `sho785stock_shops_btw` varchar(30) NOT NULL,
  `sho785stock_shops_code` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sho785stock_shops`
--

INSERT INTO `sho785stock_shops` (`sho785stock_shops_id`, `sho785stock_shops_name`, `sho785stock_shops_btw`, `sho785stock_shops_code`) VALUES
(13, 'Mevlana', 'not implemented yet', 'code'),
(14, 'Hallo', 'not implemented yet', 'code');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sqz264stock_verifycodes`
--

CREATE TABLE `sqz264stock_verifycodes` (
  `sqz264stock_verifycodes_id` int(11) NOT NULL,
  `sqz264stock_verifycodes_eid` int(11) NOT NULL,
  `sqz264stock_verifycodes_code` varchar(10) NOT NULL,
  `sqz264stock_verifycodes_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sqz264stock_verifycodes`
--

INSERT INTO `sqz264stock_verifycodes` (`sqz264stock_verifycodes_id`, `sqz264stock_verifycodes_eid`, `sqz264stock_verifycodes_code`, `sqz264stock_verifycodes_date`) VALUES
(12, 17, '3169', '30/Jan/2018 21:56:22'),
(15, 20, '3169', '31/01/2018 01:52:33');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vfm184stock_passwords`
--

CREATE TABLE `vfm184stock_passwords` (
  `vfm184stock_passwords_id` int(11) NOT NULL,
  `vfm184stock_passwords_uid` int(11) NOT NULL,
  `vfm184stock_passwords_hash` varchar(128) NOT NULL,
  `vfm184stock_passwords_salt` varchar(128) NOT NULL,
  `vfm184stock_passwords_challenge` varchar(32) NOT NULL,
  `vfm184stock_passwords_challenge_end` varchar(20) NOT NULL,
  `vfm184stock_passwords_version` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `vfm184stock_passwords`
--

INSERT INTO `vfm184stock_passwords` (`vfm184stock_passwords_id`, `vfm184stock_passwords_uid`, `vfm184stock_passwords_hash`, `vfm184stock_passwords_salt`, `vfm184stock_passwords_challenge`, `vfm184stock_passwords_challenge_end`, `vfm184stock_passwords_version`) VALUES
(8, 23, '47c2d10cd0a065ea0b7fe50233579a5a96edab833d68978fafbb1b186dde3bcc219dd328e75782fe376889074e806e77a64042708ced745a411341d156366fa0', 'fede9303a9ebfe33dc7cfeb5a678c19aa2cea216a6a130a0060141f39a39594600501f35d7fdd4aa47be93fe238b990878f73a1d283276a9f80d0ef60c66a1f6', '', '', 1),
(11, 26, '22deb2fb20b13ad50dc60f2a18af0c3652793169a4cab1b2bb83ae13e1d7db775ab240954b22b7b844df506e791ea4d15170fa90b7a07514379720072e55079c', '8de8cd350c10374449efc373b13d93ce81a6f24f5a20394f156e057d5d7cf88190837f0e6d4c880aa00a229f2c496c84919a66b1eab3af8673d4675f85d1926b', '', '', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `asx465stock_addresses`
--
ALTER TABLE `asx465stock_addresses`
  ADD PRIMARY KEY (`asx465stock_addresses_id`);

--
-- Indexen voor tabel `dsl856stock_users`
--
ALTER TABLE `dsl856stock_users`
  ADD PRIMARY KEY (`dsl856stock_users_id`);

--
-- Indexen voor tabel `rdl632stock_emails`
--
ALTER TABLE `rdl632stock_emails`
  ADD PRIMARY KEY (`rdl632stock_emails_id`);

--
-- Indexen voor tabel `sha243stock_shoprelations`
--
ALTER TABLE `sha243stock_shoprelations`
  ADD PRIMARY KEY (`sha243stock_shoprelations_id`);

--
-- Indexen voor tabel `sho785stock_shops`
--
ALTER TABLE `sho785stock_shops`
  ADD PRIMARY KEY (`sho785stock_shops_id`);

--
-- Indexen voor tabel `sqz264stock_verifycodes`
--
ALTER TABLE `sqz264stock_verifycodes`
  ADD PRIMARY KEY (`sqz264stock_verifycodes_id`);

--
-- Indexen voor tabel `vfm184stock_passwords`
--
ALTER TABLE `vfm184stock_passwords`
  ADD PRIMARY KEY (`vfm184stock_passwords_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `asx465stock_addresses`
--
ALTER TABLE `asx465stock_addresses`
  MODIFY `asx465stock_addresses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `dsl856stock_users`
--
ALTER TABLE `dsl856stock_users`
  MODIFY `dsl856stock_users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT voor een tabel `rdl632stock_emails`
--
ALTER TABLE `rdl632stock_emails`
  MODIFY `rdl632stock_emails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT voor een tabel `sha243stock_shoprelations`
--
ALTER TABLE `sha243stock_shoprelations`
  MODIFY `sha243stock_shoprelations_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `sho785stock_shops`
--
ALTER TABLE `sho785stock_shops`
  MODIFY `sho785stock_shops_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT voor een tabel `sqz264stock_verifycodes`
--
ALTER TABLE `sqz264stock_verifycodes`
  MODIFY `sqz264stock_verifycodes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `vfm184stock_passwords`
--
ALTER TABLE `vfm184stock_passwords`
  MODIFY `vfm184stock_passwords_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
