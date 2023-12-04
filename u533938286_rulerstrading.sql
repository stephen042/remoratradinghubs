-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2023 at 09:11 AM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u533938286_rulerstrading`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `element_id` int(11) NOT NULL,
  `datasource` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`element_id`, `datasource`) VALUES
(1, '{\"account_id\":\"c30e4068b677f032cd2314c953fc4b0g138d423c50a8835e672ef01e09db5bf9\",\"account_role\":\"Manager\",\"username\":\"Rulerstradingfx\",\"full_names\":\"Rulerstradingfx\",\"email_address\":\"info@rulerstradingfx.live\",\"phone_number\":\"+234 012 345 6789\",\"country\":\"Georgia\",\"password\":\"$2y$10$6e5Vs1USx5VjCP.DsDy8LuWQBnyhurmAYqHCaJR349BKuTS0ARtV.\",\"registration_date\":\"9th Aug 2023\",\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"admin eth\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"admin doge\"}'),
(13, '{\"account_id\":\"d8af244d4b168e761ea048730bf0cd81190fec086db52c82af3a0070a179f3ad\",\"account_role\":\"Investor\",\"username\":\"Nodex\",\"full_names\":\"Excel Nodex\",\"email_address\":\"excelnodex@gmail.com\",\"phone_number\":\"+234 012 345 6789\",\"country\":\"Bahamas\",\"password\":\"$2y$10$jONIKEl6n\\/PF4\\/NHwiOZt.4JKy\\/6h5OtNceobrMCoe1EkWfei5\\/K2\",\"registration_date\":\"11th Aug 2023\",\"account_balance\":0,\"account_earnings\":0,\"transaction_token\":\"TXN--5620652725\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}'),
(14, '{\"account_id\":\"81693840b620a1b6c08d8d4e80a849da195389f3ea4e917bc0388a1075e2d4ec\",\"account_role\":\"Investor\",\"username\":\"Fredgeorge \",\"full_names\":\"Fred George \",\"email_address\":\"fred62374@gmail.com\",\"phone_number\":\"+4426668854\",\"country\":\"United States\",\"password\":\"$2y$10$MmHLbf87Kz287bZNNILwoesOOiQcVkxm08CNlet3.bkH9SY\\/Hrx0O\",\"registration_date\":\"25th Sep 2023\",\"account_balance\":4000,\"account_earnings\":200,\"transaction_token\":\"\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}'),
(15, '{\"account_id\":\"74bcdc507b67a02f17c03a23bb0e0c854f242ceccdf8591bf5bf749752fe0b16\",\"account_role\":\"Investor\",\"username\":\"Libby BARD \",\"full_names\":\"Libby Ann Bard\",\"email_address\":\"libbybard@gmail.com\",\"phone_number\":\"12708759258\",\"country\":\"United States\",\"password\":\"$2y$10$ZSkvuuENTwveceFKkkRECuwlgCUWeErQlD42AQdG118DnLmRQMaHK\",\"registration_date\":\"28th Sep 2023\",\"account_balance\":16450,\"account_earnings\":29198,\"transaction_token\":\"\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}'),
(16, '{\"account_id\":\"05b739dd62c828720fe40821847ad6f2b2843a242f5a0506ad0dce5c5fdbb2dd\",\"account_role\":\"Investor\",\"username\":\"maxpayasia\",\"full_names\":\"max asia\",\"email_address\":\"maxpay.asia1@gmail.com\",\"phone_number\":\"4477356784646\",\"country\":\"Saint Helena\",\"password\":\"$2y$10$vyF\\/NlolbJT3KeynzIcdHuJArrjMm864W2nKyYZJ69iQXBFbZshC.\",\"registration_date\":\"13th Oct 2023\",\"account_balance\":0,\"account_earnings\":0,\"transaction_token\":\"\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}'),
(17, '{\"account_id\":\"5fc870a942f3525a3f0ba92281c1aae2a4c7a79e206e766d932ffa2d14f281b5\",\"account_role\":\"Investor\",\"username\":\"CJBECK \",\"full_names\":\"Cynthia Beckman\",\"email_address\":\"beckmanc719@gmail.com\",\"phone_number\":\"2706195408\",\"country\":\"United States\",\"password\":\"$2y$10$OYBWAbOCzgqCDJtAsNHy9ufim7fHYejH7UW7znJpvMf\\/Jpgh4XX9y\",\"registration_date\":\"13th Oct 2023\",\"account_balance\":0,\"account_earnings\":0,\"transaction_token\":\"\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}'),
(18, '{\"account_id\":\"1fc4c1632e6db919da1da5f4bd6073aec2dd18bce9aa9b97ab065cfab07ebcef\",\"account_role\":\"Investor\",\"username\":\"patyhernandez0316\",\"full_names\":\"Patricia Hernandez \",\"email_address\":\"patyhernandez0316@yahoo.com\",\"phone_number\":\"5402089410\",\"country\":\"United States\",\"password\":\"$2y$10$MYK7SksciIrf7Yi298znFu8TIDnI4ETea0iIedJBvhoKG0RQTpd2q\",\"registration_date\":\"2nd Nov 2023\",\"account_balance\":0,\"account_earnings\":0,\"transaction_token\":\"\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}'),
(19, '{\"account_id\":\"b94fc2acae2d39d99e860d95ed128ee85945f5496a07f246e6cb8c65216ffa56\",\"account_role\":\"Investor\",\"username\":\"Enjoli_Joubert\",\"full_names\":\"Enjoli Joubert\",\"email_address\":\"enjoli.joubert@gmail.com\",\"phone_number\":\"(646)886-0987\",\"country\":\"United States\",\"password\":\"$2y$10$xpFIYLt.FmCHbqejHhc0tuSdzjwpjuKYEyzC7DokEJNPkmTxl8Ui.\",\"registration_date\":\"4th Nov 2023\",\"account_balance\":180,\"account_earnings\":45,\"transaction_token\":\"\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}'),
(20, '{\"account_id\":\"1544c132d4a3b5f630bbefaf3b2e67c60ae5e8d98cb693df581b801e8d156228\",\"account_role\":\"Investor\",\"username\":\"Mom_of_3\",\"full_names\":\"Bernice Oliveras\",\"email_address\":\"darleneb950@gmail.com\",\"phone_number\":\"9496859545\",\"country\":\"United States\",\"password\":\"$2y$10$0Zfvzdw1nxzyo0MsAmsV1uVpxjr7DO0E6r1XxOfTLIy7lIzymyDsq\",\"registration_date\":\"4th Nov 2023\",\"account_balance\":0,\"account_earnings\":0,\"transaction_token\":\"\",\"investment_plan\":\"-- \\/ --\",\"amount_invested\":0,\"bitcoin_wallet_address\":\"\",\"ethereum_wallet_address\":\"\",\"tether_wallet_address\":\"\",\"dogecoin_wallet_address\":\"\"}');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `element_id` int(11) NOT NULL,
  `datasource` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`element_id`, `datasource`) VALUES
(8, '{\"transaction_id\":\"67ae3c2729d2e4798bbdc9875648c46458c6e604db17bbaa39e631f63c34b29d\",\"account_id\":\"05b739dd62c828720fe40821847ad6f2b2843a242f5a0506ad0dce5c5fdbb2dd\",\"transaction_date\":\"13th Oct 2023\",\"transaction_status\":\"Pending\",\"amount\":\"2222\",\"category\":\"Credit TXN\",\"proof_img\":\"954b03632cd426230b80b07bea974d55f74b86ec5918a8b12c632d181cf0be9a.php\",\"ewallet\":\"Ethereum [ETH]\"}');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `element_id` int(11) NOT NULL,
  `datasource` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`element_id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`element_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`element_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
