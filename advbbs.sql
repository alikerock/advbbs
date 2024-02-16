-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-02-16 07:43
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `advbbs`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `hit` int(11) DEFAULT NULL,
  `thumbsup` int(11) DEFAULT NULL,
  `lock_post` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `name`, `pw`, `title`, `content`, `date`, `hit`, `thumbsup`, `lock_post`) VALUES
(1, '그린', '$2y$10$342YsJRoFjIgK.w34i1I8.L.gcgvuRgaE0uXdJJZj5zQ.Cpy4fxPe', '그린 테스트', '본문 입니다.\r\n본문 입니다.\r\n본문 입니다.\r\n본문 입니다.', '2024-02-15', 4, NULL, NULL),
(2, '이도령', '1234', '가나다라마바사아자차카파타하', '반갑습니다.', '2024-02-14', NULL, NULL, NULL),
(3, '테스트', '$2y$10$vuX15Hvf6pK980MbVJ61/.vjr3w/3/0DGaVlSzZxdNeYC/gqxpWFS', '테스트 제목', '테스트 내용', '2024-02-15', NULL, NULL, NULL),
(4, '그린', '$2y$10$P5tfazVCFeBlCeya.iE0yOjDDcRW4Btf.WnRFmg1vZ7cxZ7tUq17e', '그린 테스트', '본문 입니다.\r\n본문 입니다.\r\n본문 입니다.\r\n본문 입니다.', '2024-02-15', 8, NULL, NULL),
(5, 'test', '$2y$10$SR6cr4OX1PMsbiKOiDp/tOFSVYeHkgRD6GTvmtzT3QORR0FF3eIB6', '비밀글 테스트', '비밀글 테스트비밀글 테스트', '2024-02-16', 7, NULL, 1),
(6, '비밀글 테스트2', '$2y$10$ZDYOspa4t.xwvtEA1poeKudVq4TzkTHFpyU5YxrcRnBQJ96rbLEsu', '비밀글 테스트2', '비밀글 테스트2비밀글 테스트2비밀글 테스트2', '2024-02-16', 19, NULL, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `reply`
--

CREATE TABLE `reply` (
  `idx` int(11) NOT NULL,
  `b_idx` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `reply`
--

INSERT INTO `reply` (`idx`, `b_idx`, `name`, `password`, `content`, `date`) VALUES
(1, 0, '아무개', '$2y$10$nl.hVjDa5N7XArrM5R6hmeFdN5gNbRMq8EznAHTCmtkEBcqzh1IKW', '글 잘봤습니다.', '2024-02-16 04:20:07'),
(2, 0, '아무개', '$2y$10$AzVMwfyfZhvluu9XsYvq8eWk698EIHNRNX6Dt01zgcEMwfb..I8g.', '글 잘 봤습니다.', '2024-02-16 04:22:03'),
(3, 6, '아무개', '$2y$10$rZykEiB9YNQVPGNOtmwZru.160PUCc3EDvxnbeDTIPzHxZybzTNAe', '댓글 입니다.', '2024-02-16 04:34:07'),
(4, 6, '홍길동', '$2y$10$dBePF6EfXbXvrcSURXiYbO5chCG.AOlR1eyXJnaZiZn48jh7s1vWC', '반갑습니다.', '2024-02-16 04:40:39');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `reply`
--
ALTER TABLE `reply`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
