-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2021 at 10:14 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dummy`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`); 

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `tenant_user`
--

CREATE TABLE `tenant_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `database_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `website_url` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `tenant_twitter_details`
--

CREATE TABLE `tenant_twitter_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_twitter_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_nickname` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `total_followers` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `total_tweets` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `favorites` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `twitter_follower_details`
--

CREATE TABLE `twitter_follower_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_twitter_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_follower_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `follower_name` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `follower_username` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `twitter_public_metrices_details`
--

CREATE TABLE `twitter_public_metrices_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_twitter_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tweet_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tweet_text` varchar(2555) COLLATE utf8mb4_unicode_ci NULL,
  `retweet_count` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `reply_count` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `like_count` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `quote_count` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

