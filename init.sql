CREATE TABLE `book` (
  `id` int NOT NULL,
  `checklist_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `priority_id` int NOT NULL,
  `book_status_id` int NOT NULL,
  `retailer_id` int NOT NULL,
  `image_path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `book` (`id`, `checklist_id`, `title`, `price`, `priority_id`, `book_status_id`, `retailer_id`, `image_path`) VALUES
(1, 1, 'One Piece 3 em 1 Vol. 21', 84.9, 3, 2, 1, 'onepiece.jpg'),
(2, 1, 'Jojo\'s Bizarre Adventure Parte 6: Stone Ocean Vol. 01', 49.9, 3, 2, 1, 'upload_6559369f40c05_61cvbcw06CL._SY522_.jpg'),
(3, 1, 'Chainsaw Man Vol. 15', 39.9, 3, 2, 1, 'upload_655942d5338ea_719Xx+xrSPL._SY522_.jpg'),
(5, 1, 'Kaiju N.° 8 Vol. 10', 39.9, 3, 2, 1, 'upload_655a38c2795d9_61YQD6u5liL._SY522_.jpg'),
(9, 6, 'One Piece 3 em 1 Vol. 20', 84.9, 3, 2, 1, 'upload_655ccd3c48631_71W6h4tXXZL._SY522_.jpg'),
(10, 6, 'Jojo\'s Bizarre Adventure Parte 5: Golden Wind Vol. 10', 44.9, 3, 2, 1, 'upload_655ccd97eb2f8_61hfGlcV+rL._SY522_.jpg'),
(11, 6, 'Black Clover Vol. 35', 34.9, 3, 2, 1, 'upload_655cd1138552d_61QdxeHjucL._SY522_.jpg'),
(12, 6, 'One Piece Receitas Piratas 01', 99.9, 3, 2, 1, 'upload_655cd144b992d_71C3501ES7L._SY522_.jpg'),
(16, 8, 'Sangatsu no Lion: O Leao de Marco - Vol. 04', 37.8, 3, 5, 1, 'upload_655cd606d1d32_71RZUiFUXVL._SY522_.jpg');

CREATE TABLE `book_status` (
  `id` int NOT NULL,
  `book_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `book_status` (`id`, `book_status`) VALUES
(1, 'Pendente'),
(2, 'Comprado em pre-venda'),
(3, 'Pago'),
(4, 'Comprado'),
(5, 'Recebido');

CREATE TABLE `checklist` (
  `id` int NOT NULL,
  `checklist_month` int NOT NULL,
  `checklist_year` int NOT NULL,
  `checklist_type_id` int NOT NULL,
  `total_expense` float DEFAULT NULL,
  `average_expense` float DEFAULT NULL,
  `first_image_path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `checklist` (`id`, `checklist_month`, `checklist_year`, `checklist_type_id`, `total_expense`, `average_expense`, `first_image_path`) VALUES
(1, 1, 2024, 1, 214.6, 239.6, 'onepiece.jpg'),
(6, 12, 2023, 1, 264.6, 264.6, 'upload_655ccd3c48631_71W6h4tXXZL._SY522_.jpg'),
(8, 10, 2023, 2, 37.8, 37.8, 'upload_655cd606d1d32_71RZUiFUXVL._SY522_.jpg');

CREATE TABLE `checklist_type` (
  `id` int NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `checklist_type` (`id`, `type`) VALUES
(1, 'monthly'),
(2, 'extra');

CREATE TABLE `month` (
  `id` int NOT NULL,
  `month` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `month` (`id`, `month`) VALUES
(1, 'Janeiro'),
(2, 'Fevereiro'),
(3, 'Marco'),
(4, 'Abril'),
(5, 'Maio'),
(6, 'Junho'),
(7, 'Julho'),
(8, 'Agosto'),
(9, 'Setembro'),
(10, 'Outubro'),
(11, 'Novembro'),
(12, 'Dezembro');


CREATE TABLE `priority` (
  `id` int NOT NULL,
  `priority` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `priority` (`id`, `priority`) VALUES
(1, 'Baixa'),
(2, 'Media'),
(3, 'Alta');

CREATE TABLE `retailer` (
  `id` int NOT NULL,
  `retailer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `retailer` (`id`, `retailer`) VALUES
(1, 'Amazon'),
(2, 'Panini');

ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_id` (`checklist_id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `book_status_id` (`book_status_id`),
  ADD KEY `retailer_id` (`retailer_id`);

ALTER TABLE `book_status`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_type_id` (`checklist_type_id`);

ALTER TABLE `checklist_type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `retailer`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `book_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `checklist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `checklist_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `priority`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `retailer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`checklist_id`) REFERENCES `checklist` (`id`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`book_status_id`) REFERENCES `book_status` (`id`),
  ADD CONSTRAINT `book_ibfk_4` FOREIGN KEY (`retailer_id`) REFERENCES `retailer` (`id`);

ALTER TABLE `checklist`
  ADD CONSTRAINT `checklist_ibfk_1` FOREIGN KEY (`checklist_type_id`) REFERENCES `checklist_type` (`id`);