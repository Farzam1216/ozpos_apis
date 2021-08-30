-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 08:42 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mealup_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '؋'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'Afl'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '₼'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', 'Лв.'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£\r\n'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '៛'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '₱'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', 'GH₵'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', '₹'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '﷼'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '₪'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '₸'),
(64, 'Korea (North)', 'Won', 'KPW', '₩'),
(65, 'Korea (South)', 'Won', 'KRW', '₩'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'Лв'),
(67, 'Laos', 'Kips', 'LAK', '	₭'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', 'Ден\r\n'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '₹'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '₹'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '₦'),
(88, 'North Korea', 'Won', 'KPW', '₩'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '﷼'),
(91, 'Pakistan', 'Rupees', 'PKR', '₹'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'zł'),
(97, 'Qatar', 'Rials', 'QAR', '﷼'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '₽'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼'),
(102, 'Serbia', 'Dinars', 'RSD', 'ع.د'),
(103, 'Seychelles', 'Rupees', 'SCR', '₹'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '₩'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₹'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '฿'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '₺'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '₫\r\n'),
(130, 'Yemen', 'Rials', 'YER', '﷼'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_person`
--

CREATE TABLE `delivery_person` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `lat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_online` tinyint(1) NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `licence_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_identity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `licence_doc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_zone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `notification` int(11) DEFAULT NULL,
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_zone`
--

CREATE TABLE `delivery_zone` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_zone_area`
--

CREATE TABLE `delivery_zone_area` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vendor_id` text DEFAULT NULL,
  `location` text NOT NULL,
  `radius` int(11) NOT NULL,
  `lat` text NOT NULL,
  `lang` text NOT NULL,
  `delivery_zone_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `contact` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_white_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_black_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `help_line_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_availability` tinyint(1) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isItemTax` int(11) DEFAULT NULL,
  `item_tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isPickup` tinyint(1) DEFAULT NULL,
  `isSameDayDelivery` tinyint(1) DEFAULT NULL,
  `vendor_distance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_notification` tinyint(4) DEFAULT NULL,
  `customer_app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_auth_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_notification` tinyint(4) DEFAULT NULL,
  `driver_app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_auth_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_notification` tinyint(4) DEFAULT NULL,
  `vendor_app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_auth_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_and_condition` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `help` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '#6777EF',
  `settlement_days` int(11) DEFAULT NULL,
  `is_driver_accept_multipleorder` int(11) DEFAULT NULL,
  `driver_accept_multiple_order_count` int(11) DEFAULT NULL,
  `driver_assign_km` int(11) DEFAULT NULL,
  `driver_vehical_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_earning` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_acc_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification` tinyint(1) DEFAULT NULL,
  `verification_email` tinyint(1) DEFAULT NULL,
  `verification_phone` tinyint(1) DEFAULT NULL,
  `twilio_auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `radius` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_auto_refrese` int(11) DEFAULT NULL,
  `mail_mailer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_host` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_username` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_mail` tinyint(1) DEFAULT NULL,
  `vendor_mail` tinyint(1) DEFAULT NULL,
  `driver_mail` tinyint(1) DEFAULT NULL,
  `ios_customer_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios_vendor_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios_driver_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios_customer_app_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios_vendor_app_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios_driver_app_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_customer_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_vendor_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_driver_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_customer_app_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_vendor_app_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_driver_app_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_verify` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`id`, `cancel_reason`, `company_white_logo`, `company_black_logo`, `favicon`, `business_name`, `contact_person_name`, `contact`, `business_address`, `country`, `tax_id`, `timezone`, `currency`, `currency_symbol`, `help_line_no`, `start_time`, `end_time`, `business_availability`, `message`, `isItemTax`, `item_tax`, `tax_type`, `vendor_name`, `driver_name`, `isPickup`, `isSameDayDelivery`, `vendor_distance`, `customer_notification`, `customer_app_id`, `customer_auth_key`, `customer_api_key`, `driver_notification`, `driver_app_id`, `driver_auth_key`, `driver_api_key`, `vendor_notification`, `vendor_app_id`, `vendor_auth_key`, `vendor_api_key`, `privacy_policy`, `terms_and_condition`, `help`, `about_us`, `site_color`, `settlement_days`, `is_driver_accept_multipleorder`, `driver_accept_multiple_order_count`, `driver_assign_km`, `driver_vehical_type`, `driver_earning`, `company_details`, `twilio_acc_id`, `verification`, `verification_email`, `verification_phone`, `twilio_auth_token`, `twilio_phone_no`, `radius`, `driver_auto_refrese`, `mail_mailer`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from_address`, `customer_mail`, `vendor_mail`, `driver_mail`, `ios_customer_version`, `ios_vendor_version`, `ios_driver_version`, `ios_customer_app_url`, `ios_vendor_app_url`, `ios_driver_app_url`, `android_customer_version`, `android_vendor_version`, `android_driver_version`, `android_customer_app_url`, `android_vendor_app_url`, `android_driver_app_url`, `map_key`, `license_code`, `client_name`, `license_verify`, `created_at`, `updated_at`) VALUES
(1, '[\"Lorem ispum is doner sumit aemit da cost\",\"I have multiple order\",\"Other Reason\"]', '60b75a0d8c403.png', 'meAlup.png', 'favicon.png', 'MealUp', 'MealUp', '1234567890', 'gondal road rajkot', 'INDIA', 'aqw', 'Asia/Kolkata', 'USD', '$', NULL, '08:00 am', '08:00 pm', 1, NULL, 0, '5', 'GST', 'resturant', 'delivery person', 1, 1, '50', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '#06C168', 15, 0, NULL, 5000, '[{\"vehical_type\":\"car\",\"license\":\"yes\"},{\"vehical_type\":\"bike\",\"license\":\"yes\"},{\"vehical_type\":\"bicycle\",\"license\":\"no\"}]', '[{\"min_km\":\"5\",\"max_km\":\"10\",\"charge\":\"100\"},{\"min_km\":\"10\",\"max_km\":\"20\",\"charge\":\"200\"}]', NULL, NULL, 0, 0, 0, NULL, NULL, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-10-27 05:55:00', '2021-06-05 04:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `file`, `image`, `direction`, `status`, `created_at`, `updated_at`) VALUES
(1, 'english', 'english.json', 'english.png', 'ltr', 1, '2021-02-08 05:42:03', '2021-02-08 05:42:03'),
(2, 'spanish', 'spanish.json', 'spanish.png', 'ltr', 1, '2021-02-08 05:55:04', '2021-02-13 08:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `menu_category_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
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
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_17_042024_create_admin_table', 2),
(5, '2020_10_17_113922_create_delivery_zone_table', 3),
(6, '2020_10_20_060155_create_promo_code_table', 4),
(7, '2020_10_21_053738_create_delivery_person_table', 5),
(8, '2020_10_21_094358_create_cuisine_table', 6),
(9, '2020_10_21_122833_create_vendor_table', 7),
(10, '2020_10_22_071431_create_banner_table', 8),
(11, '2020_10_23_101913_create_country_management_table', 9),
(12, '2020_10_26_113317_create_menu_table', 10),
(13, '2020_10_27_042136_create_faq_table', 11),
(14, '2020_10_27_090145_create_general_setting_table', 12),
(15, '2020_10_28_065215_create_submenu_table', 13),
(16, '2020_10_28_100818_create_vendor_discount_table', 14),
(17, '2020_10_28_132419_create_working_hours_table', 15),
(18, '2020_10_29_112903_create_payment_setting_table', 16),
(19, '2020_10_30_043620_create_state_management_table', 17),
(20, '2020_10_30_052700_create_city_management_table', 18),
(21, '2020_10_30_134644_create_menu_category_table', 19),
(22, '2020_10_31_072226_create_vendor_bank_details_table', 20),
(23, '2020_10_31_092418_create_submenu_cutsomization_type_table', 21),
(24, '2020_10_31_105854_create_submenu_cutsomization_item_table', 22),
(25, '2020_10_31_141812_create_order_setting_item_table', 23),
(26, '2020_11_02_090529_create_notification_template_table', 24),
(30, '2020_11_10_095338_create_order_table', 25),
(31, '2020_11_10_103502_create_order_child_table', 26),
(32, '2020_11_12_091024_create_user_address_table', 27),
(33, '2020_11_25_071555_create_settlements_table', 28),
(34, '2016_06_01_000001_create_oauth_auth_codes_table', 29),
(35, '2016_06_01_000002_create_oauth_access_tokens_table', 29),
(36, '2016_06_01_000003_create_oauth_refresh_tokens_table', 29),
(37, '2016_06_01_000004_create_oauth_clients_table', 29),
(38, '2016_06_01_000005_create_oauth_personal_access_clients_table', 29),
(39, '2021_02_08_104107_create_language_table', 30),
(40, '2021_02_15_141741_create_refaund_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification_template`
--

CREATE TABLE `notification_template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `spanish_notification_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spanish_mail_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_template`
--

INSERT INTO `notification_template` (`id`, `subject`, `title`, `notification_content`, `mail_content`, `spanish_notification_content`, `spanish_mail_content`, `created_at`, `updated_at`) VALUES
(1, 'book order', 'book order', 'dear {user_name} your order is arrived successfully from {app_name}', 'dear {user_name}<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; your order is arrived successfully&nbsp;<br><br>from:{app_name}<br>{contact}', 'querido {user_name}, su pedido llegó correctamente de {app_name}', 'Querido {user_name}<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Su Pedido Llegó Correctamente<br><br>De: {spp_name}<br>{contact}', '2020-11-02 04:12:05', '2021-02-11 07:23:41'),
(2, 'change status', 'change status', 'Dear {user_name} We Would Like To Inform You That Your Order {order_id} On {date} Is Successfully {order_status} from {company_name}', '<p>dear {user_name} We Would Like To Inform You That Your order {order_id} On {date} Is Successfully {order_status}</p><p>From : {company_name}</p>', 'Estimado {user_name}, nos gustaría informarle que su pedido {order_id} en {date} fue exitoso {order_status} de {company_name}', '<p><span style=\"background-color: rgb(248, 249, 250); color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 14px; text-transform: none; white-space: pre-wrap;\">Estimado {user_name}, nos gustaría informarle que su pedido {order_id} el {date} se realizó correctamente {order_status}</span></p><p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 28px; text-transform: none; white-space: pre-wrap; background-color: rgb(248, 249, 250);\"><span style=\"font-size: 14px;\">De: {company_name}</span></span><br></p>', '2020-11-02 04:15:37', '2021-02-16 06:45:52'),
(7, 'forgot password', 'forgot password', 'dear {user_name} your new password is {password}', 'dear {user_name}&nbsp;&nbsp;your new password is {password}<br>', 'Querida {user_name} tu nueva contraseña es {contraseña}', 'querido {user_name}&nbsp; &nbsp;tu nueva contraseña es {password} <br>', '2020-11-05 01:29:26', '2021-02-11 08:38:28'),
(8, 'verification', 'verification', 'dear {user_name} your otp is {otp}', '<p>dear {user_name} your otp is {otp}</p><p>from {app_name}</p>', 'Querida {user_name} tu otp es {otp} de {app_name}', '<p> querida {user_name} tu otp es {otp} </p> <p> de {app_name} </p>', '2020-11-28 09:30:42', '2021-02-11 07:16:59'),
(9, 'delivery person order', 'delivery person order', 'dear {driver_name} Recently Booked Order Near {address} From {vendor_name}', '<p>dear {driver_name} recently booked order near {address} from {vendor_name}<br></p>', 'Querida {driver_name} Pedido recientemente reservado cerca de {dirección} De {vendor_name}', '<p> querido {driver_name} pedido recientemente reservado cerca de {address} de {vendor_name} <br> </p>', '2020-12-22 19:44:14', '2021-02-11 07:16:59'),
(10, 'vendor order', 'vendor order', 'Dear {Vendor_name} We Liked To Inform You That Recently Booked Order. Order Id : {Order_id} , User Name : {User_name}', '<p>Dear {Vendor_name} We Liked To Inform You That Recently Booked Order.</p><hr><p>Order Id : {Order_id}</p><p>User Name : {User_name}</p>', 'Estimado {Vendor_name}, nos gustaría informarle sobre el pedido reservado recientemente. ID de pedido: {Order_id}, nombre de usuario: {User_name}', '<p> Estimado {Vendor_name}, nos gustaría informarle sobre el pedido reservado recientemente. </p> <hr> <p> ID del pedido: {Order_id} </p> <p> Nombre de usuario: {User_name} </p>', '2020-12-25 05:04:19', '2021-02-11 07:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0053924b33bf7ac5fe87004c39f14c311a18671769494a471680dc7d6d96f8c9e6bdf7e08a95486c', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:50:43', '2020-12-24 15:50:43', '2021-12-24 10:50:43'),
('010d7b8dbc6bfd7a2756b674ee89418effd489af2b4c8da61b83b9e97720ccdccfd60b12238c9856', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:16:30', '2020-12-05 17:16:30', '2021-12-05 12:16:30'),
('02982aeeb43a4a2a45183087554a92829eb23bd86e957bdeb5481fcb34ee095402bad43d8734cb7a', 76, 1, 'mealUp', '[]', 0, '2020-12-03 22:30:31', '2020-12-03 22:30:31', '2021-12-03 17:30:31'),
('0471a7d54c172debd29ed2bb154c7e7dec30bf19813288a009a1f7aa81723aae2a51b29f01162d95', 10, 1, 'food delivery', '[]', 0, '2020-12-23 19:42:39', '2020-12-23 19:42:39', '2021-12-23 14:42:39'),
('04f934311a9a521f49e62dffb62e91d91d73711e83ca9036fd56ee38d8dd4a319831fed33fb1adb4', 76, 1, 'mealUp', '[]', 0, '2020-12-12 22:40:20', '2020-12-12 22:40:20', '2021-12-12 17:40:20'),
('06cf105497b2a3bb0e9ba2455bbf47140c6572c911c0e83132c81985db479f6e0c0846f343b03ff6', 76, 1, 'mealUp', '[]', 0, '2020-12-12 19:40:14', '2020-12-12 19:40:14', '2021-12-12 14:40:14'),
('07dcd4d12d1344ef174583b7c14da9ae27356ff47dd5f1490d597b26d7b0ca01274f5a32de3276e6', 76, 1, 'mealUp', '[]', 0, '2020-12-05 20:17:25', '2020-12-05 20:17:25', '2021-12-05 15:17:25'),
('0823ba7c4c11452b93aa9bd981237033eea60d6d402a5f1eeda78d9295a5d1980b5861a85836fbbf', 76, 1, 'mealUp', '[]', 0, '2020-12-11 15:37:59', '2020-12-11 15:37:59', '2021-12-11 10:37:59'),
('088efb8c4aab818f71191a472d7548020a2c49f951c7736d9cb6fb2fae1aaea0facea89d8ab2e0d4', 94, 1, 'mealUp', '[]', 0, '2021-01-04 04:58:31', '2021-01-04 04:58:31', '2022-01-04 10:28:31'),
('08c26d4294ee05c3d2786c1dc718f076e5a213f852c7111805286187e3138f4739cab03d76524c1b', 76, 1, 'mealUp', '[]', 0, '2020-12-08 21:32:23', '2020-12-08 21:32:23', '2021-12-08 16:32:23'),
('0af2191d931381eba32a2f87d5ff547311cf4688ffa18aa9237e39c2551b7496398e7342c0948233', 10, 1, 'food delivery', '[]', 0, '2020-12-23 22:36:40', '2020-12-23 22:36:40', '2021-12-23 17:36:40'),
('0b528ce482b64204aaa070222b0e4f3b9f97a1736ceaf96c1c7c04193b7f138efe522fdc98818d42', 62, 1, 'food delivery', '[]', 0, '2020-12-01 06:10:24', '2020-12-01 06:10:24', '2021-12-01 11:40:24'),
('0c24f5b37b3c3a078dfd7012e7acc7ab121c2fa153a92a8fcf53b5742f5deff2c664a9c77656ed28', 10, 1, 'food delivery', '[]', 0, '2020-12-23 19:45:55', '2020-12-23 19:45:55', '2021-12-23 14:45:55'),
('0d07e7a03deb51fa85df469f3ad654080de3411307ffed36a31cb739e59d07fa5a945a7f23ace963', 10, 1, 'food delivery', '[]', 0, '2020-12-24 16:19:08', '2020-12-24 16:19:08', '2021-12-24 11:19:08'),
('0f5fb8294f7648282ab53d5282383a5301db2484609a379f85477faa9e4c6943079937eca44b411d', 3, 1, 'food delivery', '[]', 0, '2020-12-21 14:42:32', '2020-12-21 14:42:32', '2021-12-21 09:42:32'),
('113a195ce32c17864bfd073aee98791010836d051e01f9145156e4bbf8c801cb887fee73e8b0a732', 10, 1, 'food delivery', '[]', 0, '2020-12-23 17:13:36', '2020-12-23 17:13:36', '2021-12-23 12:13:36'),
('120e5c3a878a89bea2f571bea4c840af08dd3753cb9da1a1a201172b68917083c416ce0b55252c3c', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:04:44', '2020-12-23 23:04:44', '2021-12-23 18:04:44'),
('1322081129788e2d9566f4d226cd3ba7ba80997016b40c22a2fa65ea9113a5c04ed96530d396e86d', 58, 1, 'food delivery', '[]', 0, '2020-11-28 11:48:23', '2020-11-28 11:48:23', '2021-11-28 17:18:23'),
('135eeb296aba294d6af6d1e2c5dcfebd1b1353fa118ba92147aeee2ca66b41680407a1057acb9bcc', 76, 1, 'mealUp', '[]', 0, '2020-12-12 16:47:01', '2020-12-12 16:47:01', '2021-12-12 11:47:01'),
('13c9bfb157b154f4abab8dd6100a42f93f0a02979c26d7a69d7a4ad1dc1c3ce67b6fa6b7ef71f381', 76, 1, 'mealUp', '[]', 0, '2020-12-14 19:52:21', '2020-12-14 19:52:21', '2021-12-14 14:52:21'),
('17c4b1323030ec37f507c468e43b60c7f97ddeb3c4db44860a2ea424fcb3838f95d81bdcd586b4be', 76, 1, 'mealUp', '[]', 0, '2020-12-14 17:09:34', '2020-12-14 17:09:34', '2021-12-14 12:09:34'),
('184f881a027233926b36d5bc6e65f2c019abfae5bb53f06c7e22a15991f9f99e9fc5e483e6b62d7a', 76, 1, 'mealUp', '[]', 0, '2020-12-26 07:27:33', '2020-12-26 07:27:33', '2021-12-26 12:57:33'),
('187fcf6fb30b3f61a16f732c5d186bac9f8d33974aa03256f5cfa9272a107a61a7bece0a42c41751', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:54:26', '2020-12-22 22:54:26', '2021-12-22 17:54:26'),
('1ab9abc8bfbcf4a329dead5e5dbccff42a771ef54993fbdc1a8c66d7c3d482833970b40943bb3ab4', 58, 1, 'food delivery', '[]', 0, '2020-11-28 10:41:43', '2020-11-28 10:41:43', '2021-11-28 16:11:43'),
('1be81b8a977d8d408c5a6f3f2d624bd68d6721d5b618945ad57ac8a459e780c6e8ee2c08d6e37a42', 61, 1, 'food delivery', '[]', 0, '2020-11-28 11:25:31', '2020-11-28 11:25:31', '2021-11-28 16:55:31'),
('1c58b4afe4773a2a51419904d1982406f126448ed385e58f578bfc2ea73d71f2cf1bbb93c88d790f', 3, 1, 'food delivery', '[]', 0, '2020-12-22 22:07:07', '2020-12-22 22:07:07', '2021-12-22 17:07:07'),
('1dcc51b555b863cd086a760134479854f43fb8657d35ea8f2bff80092b267fafcf18fa8eaa30ab60', 76, 1, 'mealUp', '[]', 0, '2020-12-15 14:40:50', '2020-12-15 14:40:50', '2021-12-15 09:40:50'),
('1dfef1870f7cf332c8c045072551589f2204d2e5cde96e38b7139dc9bb3c5e3c454370490df23c25', 76, 1, 'mealUp', '[]', 0, '2020-12-12 20:00:55', '2020-12-12 20:00:55', '2021-12-12 15:00:55'),
('2054162e019ac06a0a5edaa520bd955ced9f2f51898b1f64b0e2b9a1c0ab3aa212740781e901165a', 76, 1, 'mealUp', '[]', 0, '2020-12-14 16:26:19', '2020-12-14 16:26:19', '2021-12-14 11:26:19'),
('21f37634a888fe8522a36249df5d1da7a5e56f70929d2dc910f3271e1de5d7131f467d5017eb54f8', 76, 1, 'mealUp', '[]', 0, '2020-12-25 13:13:26', '2020-12-25 13:13:26', '2021-12-25 18:43:26'),
('231c56558c0ef395524da8fe87178fd13923741f73ffc82048eed4027732cc2d1bbee72a2ef1277d', 10, 1, 'food delivery', '[]', 0, '2020-12-23 22:58:50', '2020-12-23 22:58:50', '2021-12-23 17:58:50'),
('23b9140884db8a63e1f4ab0e3fa4df8e22d677fed4676b29aaa175f1dcc9f8f696b3d85b7120bd97', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:29:06', '2020-12-24 15:29:06', '2021-12-24 10:29:06'),
('2464e1cf9a7d6f65fb6a4ad705f67b60576b87655b69ed1cdecb283e9abf7a0c55d191d4dcec66ef', 76, 1, 'mealUp', '[]', 0, '2020-12-12 21:15:56', '2020-12-12 21:15:56', '2021-12-12 16:15:56'),
('25e7139b1802caeb5c954bcf62c6516ed6382eee549d9ad9fad9468b106746973b9842d831a0d258', 3, 1, 'food delivery', '[]', 0, '2020-12-22 15:18:39', '2020-12-22 15:18:39', '2021-12-22 10:18:39'),
('263a635c7232258d479df62fc5015feceb83f8981613580d525bbfb1dcd1a81a04d8b3a0fafb595d', 76, 1, 'mealUp', '[]', 0, '2020-12-14 22:00:25', '2020-12-14 22:00:25', '2021-12-14 17:00:25'),
('268f2e71f916d77e3e5adb9a5d1fe9c60b62e5758adb01de9093ff81a732890810842140364d40f7', 76, 1, 'mealUp', '[]', 0, '2020-12-04 23:44:19', '2020-12-04 23:44:19', '2021-12-04 18:44:19'),
('270abb8a543ee82a9b718981cb868c72c1f937451749e40e7ea43b5806c24d5255cb4448d0119452', 10, 1, 'food delivery', '[]', 0, '2020-12-23 21:56:07', '2020-12-23 21:56:07', '2021-12-23 16:56:07'),
('272387fab2c7101c10bc65ad326a7b0f471dd8942cefecd54b92809f53cdda27a96fba5170c8f124', 76, 1, 'mealUp', '[]', 0, '2020-12-12 21:27:09', '2020-12-12 21:27:09', '2021-12-12 16:27:09'),
('273f8d2dedfda452a4665e25d499308ce8990bb868d5c14eefec24bb2dbcd1583edb41d925548798', 9, 1, 'food delivery', '[]', 0, '2020-12-23 21:26:33', '2020-12-23 21:26:33', '2021-12-23 16:26:33'),
('278b4eed023be49a71d8e681b3a9152ce1fa5aa29d2058ef3154b4a4ff80909c3c58480ca84485a8', 76, 1, 'mealUp', '[]', 0, '2020-12-15 15:21:48', '2020-12-15 15:21:48', '2021-12-15 10:21:48'),
('27db136d97e906c6983417b070ae5c992fecf630f0895ada79235fa2832cdcf908365ff3654c7d88', 8, 1, 'food delivery', '[]', 0, '2020-12-22 22:08:39', '2020-12-22 22:08:39', '2021-12-22 17:08:39'),
('2818af4d6c9fefab20a087c56253391e51d2080a296c403f874fd21b2a446fa0c47237351d1374f8', 71, 1, 'mealUp', '[]', 0, '2020-12-02 16:59:50', '2020-12-02 16:59:50', '2021-12-02 11:59:50'),
('294f6abeb8d7fda3163c31b5a5bbb8f23fe837aa9f9d489d4a72ba4beb21516cde6d5ae9ee55f358', 94, 1, 'mealUp', '[]', 0, '2021-01-04 04:57:58', '2021-01-04 04:57:58', '2022-01-04 10:27:58'),
('295ecf531c8f5146c7975bd886711200bfb5989a59fd501f156bba6f7396cd291e5d6f7118e30df9', 76, 1, 'mealUp', '[]', 0, '2020-12-12 19:33:23', '2020-12-12 19:33:23', '2021-12-12 14:33:23'),
('2c47fd108f862c52b309e6986d4487a1fcbffae36cb17cea6c60bc5caac0d875c55561af92ed94a6', 76, 1, 'mealUp', '[]', 0, '2020-12-04 23:39:43', '2020-12-04 23:39:43', '2021-12-04 18:39:43'),
('2e165159a9d96614d7e24f0b82e108161b99067e196ff901a5bee0316a7dab2b1c1138f4d7a24771', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:43:03', '2020-12-24 15:43:03', '2021-12-24 10:43:03'),
('2f39e97f3194a54858455b3aa876305f32e54f4b7c50d14e8948f7fd3f19988aa004a1fca573e565', 76, 1, 'mealUp', '[]', 0, '2020-12-04 15:19:12', '2020-12-04 15:19:12', '2021-12-04 10:19:12'),
('30aa24a7733c279c1d89aa71c390e7a516e8c5019cb15383882934320faac57062c8c65bcc815e9f', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:58:33', '2020-12-24 15:58:33', '2021-12-24 10:58:33'),
('321169284ad9bae8b49804d77546fd1395224796cbf72a20cfe8f3c2972285ba1e9016a9e303ef27', 76, 1, 'mealUp', '[]', 0, '2020-12-14 20:37:41', '2020-12-14 20:37:41', '2021-12-14 15:37:41'),
('3333947264d24caac0b538a4784c3fbf1ae923ff5d9276b95069ee914cc04e27c6255d5edec2fa14', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:43:00', '2020-12-02 22:43:00', '2021-12-02 17:43:00'),
('34abc5b0cc702bc1f0aa1208547defdc57983f16deb08d551989fb4808141a91317b1373a610c4bb', 62, 1, 'food delivery', '[]', 0, '2020-11-28 11:48:45', '2020-11-28 11:48:45', '2021-11-28 17:18:45'),
('34b31026916e0a1195773e0804435fd226edd774d0097c75729532eddb3cce3d334961333343f7f0', 76, 1, 'mealUp', '[]', 0, '2020-12-03 20:17:32', '2020-12-03 20:17:32', '2021-12-03 15:17:32'),
('38e5645ad9922e0950f50f5cbd8caea9c710f0b04e3533c01b298f9d6bbb1a9761ad8d2c548122c9', 10, 1, 'food delivery', '[]', 0, '2020-12-26 07:10:05', '2020-12-26 07:10:05', '2021-12-26 12:40:05'),
('39bfb6f6d3a9c897451167a5a2b1731044c9db68bf1291a050c452e65fd3afed9dffe4a632614a32', 10, 1, 'food delivery', '[]', 0, '2020-12-24 16:03:08', '2020-12-24 16:03:08', '2021-12-24 11:03:08'),
('39d9033b7604af84076ca3a5023560aff10fa794c4a79d87aac7f592567296f401a26511edfbdd37', 121, 1, 'mealUp', '[]', 0, '2021-02-16 07:02:08', '2021-02-16 07:02:08', '2022-02-16 12:32:08'),
('39de9ecc12b47c66a5cca8914545b07a3bdfeb9e09c731155db8ee3371b68a763598ba22c3bc9216', 76, 1, 'mealUp', '[]', 0, '2020-12-11 22:19:12', '2020-12-11 22:19:12', '2021-12-11 17:19:12'),
('3a8cb409b63182c5df3e6a9436939b15a14b648f66f5bcce4db9f62018354f64b86d0fc9de79ff2d', 76, 1, 'mealUp', '[]', 0, '2020-12-15 16:22:00', '2020-12-15 16:22:00', '2021-12-15 11:22:00'),
('3adf8bd82edd0d887ece77c807833bb76afb225436f1c98763d1f5774a69889919a436283a8047ff', 76, 1, 'mealUp', '[]', 0, '2020-12-03 17:50:17', '2020-12-03 17:50:17', '2021-12-03 12:50:17'),
('3bb130aa8613a9a4fcd829a4c607e92ba247fc191b0ca7cd8310005f7a435ccffa4205b4819d30ce', 62, 1, 'mealUp', '[]', 0, '2020-12-15 17:39:12', '2020-12-15 17:39:12', '2021-12-15 12:39:12'),
('3d12dd4a473e41612039f63f0120f3104ce4f1d6ceab7bdc0e56950dd99ed941c11d508538c7f59a', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:26:48', '2020-12-23 23:26:48', '2021-12-23 18:26:48'),
('3d3591f34223d0373a4d13f7578e9475eb1da0576cc1be8a590a07dd06bf77d7e557072580798fea', 76, 1, 'mealUp', '[]', 0, '2020-12-04 14:33:10', '2020-12-04 14:33:10', '2021-12-04 09:33:10'),
('3e0f7c23f29e1e0c86fd32616e44cfd0b211e0c260a51ce9789b0308d957d20a95e8c586ea76442c', 76, 1, 'mealUp', '[]', 0, '2020-12-12 17:56:48', '2020-12-12 17:56:48', '2021-12-12 12:56:48'),
('3ee728a0c9bd3c597aa52fd524acdbfc3964b72622de1494eb67a3686863e26ba7bb006e7beb2d73', 10, 1, 'food delivery', '[]', 0, '2020-12-23 21:04:52', '2020-12-23 21:04:52', '2021-12-23 16:04:52'),
('3efe41dadb314cab72f20c60f5c9beb04de1211b163d64733ad089734f05bbcb0da3e186e7eab492', 76, 1, 'mealUp', '[]', 0, '2020-12-12 19:36:12', '2020-12-12 19:36:12', '2021-12-12 14:36:12'),
('3f76e5c9a307aeb049bd549b094499a249bb549014e34a67d7b6ce4f55a5e4eecda89ffcd77444ba', 62, 1, 'mealUp', '[]', 0, '2020-12-22 17:24:58', '2020-12-22 17:24:58', '2021-12-22 12:24:58'),
('3fd39d52439f69fa1eac4999823f7ac17ca5fb8537d583d218bb0b021e45d539b5f7dcd662c2d1f0', 76, 1, 'mealUp', '[]', 0, '2020-12-15 14:49:07', '2020-12-15 14:49:07', '2021-12-15 09:49:07'),
('40f9a2eff98c0624501ff93b905e8af0913c246c42905dbff289ccec2f287d3776540d2a6010e908', 76, 1, 'mealUp', '[]', 0, '2020-12-14 23:53:36', '2020-12-14 23:53:36', '2021-12-14 18:53:36'),
('4206f2e052cb85226a71593a97b828907a8a310c816c9b506539b114e1689913610c050e7e024ce8', 76, 1, 'mealUp', '[]', 0, '2020-12-12 15:51:57', '2020-12-12 15:51:57', '2021-12-12 10:51:57'),
('42182d5c734dbfc6d1512416a71f29e483e8ff0876260de78112cf23c2272bc2fff46063b9ed81e5', 76, 1, 'mealUp', '[]', 0, '2020-12-07 21:34:46', '2020-12-07 21:34:46', '2021-12-07 16:34:46'),
('43c256920e6b12199da826d945c5b997bc2f6f0da6d7e7730e7f85e70993657f67bcc94e4263270e', 10, 1, 'food delivery', '[]', 0, '2020-12-23 22:37:20', '2020-12-23 22:37:20', '2021-12-23 17:37:20'),
('44142a2a3849edabc5515bad1b7361bae9013b9d87ec9e73f9c220b759dd9f21dce2a2a0dbe89c38', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:07:54', '2020-12-23 23:07:54', '2021-12-23 18:07:54'),
('447868117f812573332477229cb6974d9a35e532e28ad5d6b4e164cb587b29db7bcf50e8cf6a7e72', 76, 1, 'mealUp', '[]', 0, '2020-12-14 23:40:55', '2020-12-14 23:40:55', '2021-12-14 18:40:55'),
('45fbe074424380e850f553b954cdc5066d0996dc5e1f0fd5f115e315cca6d6cba1bd2a4d4a3d0c28', 76, 1, 'mealUp', '[]', 0, '2020-12-14 15:59:01', '2020-12-14 15:59:01', '2021-12-14 10:59:01'),
('46192e8bc4ca751fa1a3253319dcc17bb7dbd9e441dc62998024a1390850b2a71f124c23db0d40ff', 76, 1, 'mealUp', '[]', 0, '2020-12-12 20:47:26', '2020-12-12 20:47:26', '2021-12-12 15:47:26'),
('49b0ec5b11bcb7cf0a867ba484b918f927ac4e5a207bcd57eda01ee12ed20c7bf4f3b29d7a98eb39', 76, 1, 'mealUp', '[]', 0, '2020-12-03 15:29:13', '2020-12-03 15:29:13', '2021-12-03 10:29:13'),
('4a303312b27bc69203207eb9b3269bff6bdeb8976b7ebcdd044cbaf556b3f7c38fb02017715e90b0', 3, 1, 'food delivery', '[]', 0, '2020-12-21 15:35:33', '2020-12-21 15:35:33', '2021-12-21 10:35:33'),
('4ad4d9540ee7a2102f55475cad86f3f290b3347ee92d0cc8bc536d46450d3eb92a265479a5fe7978', 10, 1, 'food delivery', '[]', 0, '2020-12-23 20:47:40', '2020-12-23 20:47:40', '2021-12-23 15:47:40'),
('4bcf57582bb9c81a848029e71e39960eb80c3f3a6882af6a1bc4d4173c7f5f5c2832fad1406e4925', 76, 1, 'mealUp', '[]', 0, '2020-12-14 17:49:03', '2020-12-14 17:49:03', '2021-12-14 12:49:03'),
('4dd2e63a7af9dd9b8a3f8b405685e05b7ee86a8f87eb86c05eb1f678b61e1b04de545fd61cc995e5', 10, 1, 'food delivery', '[]', 0, '2020-12-23 19:47:06', '2020-12-23 19:47:06', '2021-12-23 14:47:06'),
('4f101ff756a9c957ce44a1e5a92d757914b134ca482b801f2657e739d82c9ed3ba36fc86557326bf', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:13:19', '2020-12-02 22:13:19', '2021-12-02 17:13:19'),
('505a95ca41bb29ee4e1d3e5f757cff0fe038de6bc7e577cdc897f9f5675e77f507cbfd19a9774612', 10, 1, 'food delivery', '[]', 0, '2020-12-23 17:07:36', '2020-12-23 17:07:36', '2021-12-23 12:07:36'),
('50d32cf263e20357fa04ee331ac85fb6ef3adbe10c7d0cb060c13a50b17fa08436745992da6212ee', 76, 1, 'mealUp', '[]', 0, '2020-12-08 17:57:12', '2020-12-08 17:57:12', '2021-12-08 12:57:12'),
('51a3bc0ecc99db41661f7ecb91911625e95e99598d91913d76c9b8388aa9a8f6a78aa9404ea94a39', 115, 1, 'mealUp', '[]', 0, '2021-02-12 11:57:14', '2021-02-12 11:57:14', '2022-02-12 17:27:14'),
('51afb01c2b0af34baebfac43a371dc080a5d846ba170a1733916d08880f47a00028bab77d4cb07cc', 1, 1, 'food delivery', '[]', 0, '2020-12-18 23:28:08', '2020-12-18 23:28:08', '2021-12-18 18:28:08'),
('51df89f98d7122ab96c0d94b58be6f98e8c0403aa709bbe5b25644bd20e6d80ecae348acd3003813', 76, 1, 'mealUp', '[]', 0, '2020-12-14 17:04:38', '2020-12-14 17:04:38', '2021-12-14 12:04:38'),
('5236f4ddeb523048a8d39598623829b753816db33641e6ba521637906c7669213d308af6e422517a', 17, 1, 'food delivery', '[]', 0, '2021-01-04 05:37:53', '2021-01-04 05:37:53', '2022-01-04 11:07:53'),
('540dc3e6a8db795f3fd17cf4c5c7b4b39eaf5f5565329da1039c01e7cb9c5999ab20b0abc7c3e62e', 76, 1, 'mealUp', '[]', 0, '2020-12-12 15:59:05', '2020-12-12 15:59:05', '2021-12-12 10:59:05'),
('560bdaf4bbc77d3a3ee633480d633e8526f4c397984ade22f44db0e6829484315dd9ed21c58700a6', 76, 1, 'mealUp', '[]', 0, '2020-12-11 22:29:39', '2020-12-11 22:29:39', '2021-12-11 17:29:39'),
('57c1e4663bf913cac26fb1b6b53ca9b63350060d8b121abdb45c1787d336ebd55911e8309f97e771', 76, 1, 'mealUp', '[]', 0, '2020-12-12 17:51:35', '2020-12-12 17:51:35', '2021-12-12 12:51:35'),
('5a68410614663465291403b8e6777c9b9c2df67989afcea2aab671245f98108c482f9d5315178aad', 76, 1, 'mealUp', '[]', 0, '2020-12-12 23:34:31', '2020-12-12 23:34:31', '2021-12-12 18:34:31'),
('5a6e9c37b7590b0d40513b621739d2901746968a3a3dc586389554768c233716b807c4711853d51f', 76, 1, 'mealUp', '[]', 0, '2020-12-12 22:26:02', '2020-12-12 22:26:02', '2021-12-12 17:26:02'),
('5ba05498df9e2388522a1119540b727e2fce780a72634a20241cfea572a13ac416a070ee840cb45a', 76, 1, 'mealUp', '[]', 0, '2020-12-15 14:32:56', '2020-12-15 14:32:56', '2021-12-15 09:32:56'),
('5fe1c3d03cacaa0139f6eddd4dc65ec7d47371c82ddec9c1cc033bc63738ed3b9efeef88bbe30085', 3, 1, 'food delivery', '[]', 0, '2020-12-22 16:23:49', '2020-12-22 16:23:49', '2021-12-22 11:23:49'),
('60270a08946db3b2ec5d5a2ede4079c12c690960bbeb99558b4c3968bb9d7c9782fa3850581213f5', 76, 1, 'mealUp', '[]', 0, '2020-12-14 16:40:37', '2020-12-14 16:40:37', '2021-12-14 11:40:37'),
('60ac2db30e5577f0b2c4a6b38eb79c94e1f3d83567585c92d4ea866fff128ec17b278b88240206e0', 76, 1, 'mealUp', '[]', 0, '2020-12-04 20:35:34', '2020-12-04 20:35:34', '2021-12-04 15:35:34'),
('60fd36b308e153b85c71380cbb170120f8a0d3bf067a2056700171d8f1f2ebe3268ebc1801b301e0', 76, 1, 'mealUp', '[]', 0, '2020-12-04 15:23:45', '2020-12-04 15:23:45', '2021-12-04 10:23:45'),
('615c2bdbac89b9e7750e919b854dda7e7f921482d289626d0289d475495af125f2a0d8ab16b18ddc', 58, 1, 'food delivery', '[]', 0, '2020-11-28 11:48:36', '2020-11-28 11:48:36', '2021-11-28 17:18:36'),
('61a551a97184522d1e9872e3e5d7989c50225e7012b5c84e24895f8c79e32ae88473090ac52920af', 76, 1, 'mealUp', '[]', 0, '2020-12-14 17:13:30', '2020-12-14 17:13:30', '2021-12-14 12:13:30'),
('61af0973ab36dd351e31b2306eeaf27a32a8238d3a134804ff1a353a1ddf84f36325821370c06502', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:52:10', '2020-12-24 15:52:10', '2021-12-24 10:52:10'),
('61e3dc1f762b77567f1743cb3e02aa10098b939c65c970e1c4cb862508122698eda7ff75b12f84f7', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:46:28', '2020-12-22 22:46:28', '2021-12-22 17:46:28'),
('62d2c8516c4d7af4c6158c9f1780258aa6d441653da5e26406391c6fa38ad2591d30aeb97ed10c72', 76, 1, 'mealUp', '[]', 0, '2020-12-04 15:09:09', '2020-12-04 15:09:09', '2021-12-04 10:09:09'),
('63483901af83308e52bf5be686e392fa33edbec48d768927bc06437470ead0e2b9547133e99916c3', 10, 1, 'food delivery', '[]', 0, '2020-12-23 22:05:59', '2020-12-23 22:05:59', '2021-12-23 17:05:59'),
('63729b347be0640cb33b3f8dab0d89528232676732d8c9707b008d5cf93880b1db0fbce9ab648488', 76, 1, 'mealUp', '[]', 0, '2020-12-12 21:08:24', '2020-12-12 21:08:24', '2021-12-12 16:08:24'),
('63b9bc31ee1277893b9e02406aee6ce4ee0a5870a4ecac76a76624eff5c78da1de8f0713aba48218', 58, 1, 'food delivery', '[]', 0, '2020-11-30 04:29:50', '2020-11-30 04:29:50', '2021-11-30 09:59:50'),
('643e52fb6d582a9ff2f4d2300aaf825692e423f41d9ca798b8740d3e329e730a1ec2da2c011db90d', 71, 1, 'mealUp', '[]', 0, '2020-12-02 16:06:06', '2020-12-02 16:06:06', '2021-12-02 11:06:06'),
('64614f0309ecaf433230915200ef19899947a5ad463b07347c9db3c5c09426b0faa05830aaaa274d', 76, 1, 'mealUp', '[]', 0, '2020-12-08 20:44:01', '2020-12-08 20:44:01', '2021-12-08 15:44:01'),
('64753770d718a068247fdc5ab449c6eea17dc08cda3decad1de07f59f94d7779478e599e8fd93104', 76, 1, 'mealUp', '[]', 0, '2020-12-26 04:06:09', '2020-12-26 04:06:09', '2021-12-26 09:36:09'),
('64ce3a2a53ea6e3f558367cb8bdc76eaf61b8b355ba3b830dd1fc5de2008ad7b6b303c9cb16421fe', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:00:41', '2020-12-23 23:00:41', '2021-12-23 18:00:41'),
('65324cb2b26e5d329d85768a36280d659991e929e4991729d6736013e2bb4456ffac2c492018b608', 115, 1, 'mealUp', '[]', 0, '2021-02-12 13:22:27', '2021-02-12 13:22:27', '2022-02-12 18:52:27'),
('65dcdd1d72da0e12c9494379cc4970731e6a10c5d9bb55c104e2328b06b204eed2418d0afdc442d8', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:01:07', '2020-12-02 22:01:07', '2021-12-02 17:01:07'),
('6726090c2a1f6a978dd6ee07bb9163f606f7420562c79c64023292c6d8ce6ef28b52f9312141fa2d', 76, 1, 'mealUp', '[]', 0, '2020-12-10 21:43:42', '2020-12-10 21:43:42', '2021-12-10 16:43:42'),
('67c2837e70058617c646e943caaf1f6a775c4d9ff76f2fe259a4f0fa220e6407061864b9d76a43e4', 8, 1, 'food delivery', '[]', 0, '2020-12-22 22:08:08', '2020-12-22 22:08:08', '2021-12-22 17:08:08'),
('682f334dad5deb686b45cd3c68c1824cb350d80ffa1d337111ee5f0907a87159c100b061c3994e09', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:26:37', '2020-12-02 22:26:37', '2021-12-02 17:26:37'),
('68c7227dc9d676a52098bafff287b9a3ac83d7545e052f1db7c22d78c999abe551491e8b38a37c1e', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:11:57', '2020-12-23 23:11:57', '2021-12-23 18:11:57'),
('6a9bed1b237ac710cf516ba83955ec203f540979e7f02ea3701b66dc64fd5eb47ebddbd9d1e3447e', 76, 1, 'mealUp', '[]', 0, '2020-12-03 17:18:25', '2020-12-03 17:18:25', '2021-12-03 12:18:25'),
('6b4a89d175a39d5e0a239821c352abf9a31e48a6b83bf4a8224cebd54038a8be3a3dc30aae1de0da', 1, 1, 'food delivery', '[]', 0, '2020-12-18 23:35:36', '2020-12-18 23:35:36', '2021-12-18 18:35:36'),
('6be66e32c07f253cc5844554737bc1242d94955bed1d8591c4b306397fc2fe28ca421a20932ab267', 76, 1, 'mealUp', '[]', 0, '2020-12-03 15:08:40', '2020-12-03 15:08:40', '2021-12-03 10:08:40'),
('6bf11e89b6f778cc7aa778b6c106ba3969a0596d178baede39bff8ccff465c21556a5ba17727a7f5', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:41:50', '2020-12-22 22:41:50', '2021-12-22 17:41:50'),
('6c0bfacb27f6b1a413c8155842371d6e68c8d8e9bafe84f9701592b496ccd1e1319462decb61b8e2', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:41:17', '2020-12-05 17:41:17', '2021-12-05 12:41:17'),
('6c0d71b8dbc5cbf74294547e0a884b5bbd8e3e7bef0eb6864fc4144662e906b7a9ac5f57bb9f5b8a', 10, 1, 'food delivery', '[]', 0, '2020-12-23 20:47:22', '2020-12-23 20:47:22', '2021-12-23 15:47:22'),
('6c2efa595f7765595fd381a34957c059f3d22c3f5bc1a5c98154b5c1550f2e56a7a1930237211c7c', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:33:54', '2020-12-22 22:33:54', '2021-12-22 17:33:54'),
('6cb1e6be508c765f336e44fd0f2c7cd358e33d4ddc33be03532f1693ede0373c4e5f3c731f66ad47', 147, 1, 'mealUp', '[]', 0, '2021-07-05 06:18:34', '2021-07-05 06:18:34', '2022-07-05 11:48:34'),
('6cda2f4592578fd6a7ccfacc071b6c321a354fba5350c9fb625653bb8a7e23318cdd8fe35cb226e7', 119, 1, 'mealUp', '[]', 0, '2021-02-15 13:25:52', '2021-02-15 13:25:52', '2022-02-15 18:55:52'),
('6cdabfaea5f5e8e78c1ac72ec1c051ac2ea1f0d722177ebf6e63e2a2110c95464160920a86e044d9', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:44:05', '2020-12-02 22:44:05', '2021-12-02 17:44:05'),
('6dc9fa59d9760135505e6af6b6d430b11479985c5a5fafc8725b4c6654d8f5d0d8c30da1cbc0286c', 76, 1, 'mealUp', '[]', 0, '2020-12-04 16:08:55', '2020-12-04 16:08:55', '2021-12-04 11:08:55'),
('6e46b7bc3b2c70ef0dec6895eabb0f0378e573739f9a363a47a6a3c9e1e0c91178d57df37332ee21', 8, 1, 'food delivery', '[]', 0, '2020-12-22 22:15:47', '2020-12-22 22:15:47', '2021-12-22 17:15:47'),
('6e8b5de2e70f65c24914a809b16e1ff80b295f09e911b89f3a8f030f190798ec6afe1928c9c28a81', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:53:58', '2020-12-02 22:53:58', '2021-12-02 17:53:58'),
('6ef1df3c4270b245ad761ffd761bea7e05274b7360bf2c5625d018743f5c331f83383069198aef7f', 1, 1, 'food delivery', '[]', 0, '2020-12-18 23:35:49', '2020-12-18 23:35:49', '2021-12-18 18:35:49'),
('6ef4a99e5b453c414da38a78476dfa5e21c88835a320032fc72b1b3a4edfc3055ddd8dccc8fa501a', 76, 1, 'mealUp', '[]', 0, '2020-12-03 23:08:20', '2020-12-03 23:08:20', '2021-12-03 18:08:20'),
('6fba8ad6e5ea06ccc829458b0a5007c7c98c1da05bbd857554cc9b2a6179181860f8a07c99848c02', 76, 1, 'mealUp', '[]', 0, '2020-12-03 23:04:54', '2020-12-03 23:04:54', '2021-12-03 18:04:54'),
('714fbc56091098412c6beb0b098ec3f98432fca32396c520269c4578b3298353ebf978e189bd9c58', 76, 1, 'mealUp', '[]', 0, '2020-12-03 22:24:56', '2020-12-03 22:24:56', '2021-12-03 17:24:56'),
('71a7e80976b920a8eb5ad9ad6356afc4a35af3cefbf06e915b4f302a43900820a55509d1c427d3a8', 76, 1, 'mealUp', '[]', 0, '2020-12-15 15:06:51', '2020-12-15 15:06:51', '2021-12-15 10:06:51'),
('72a38459d42ad001c2d2a821cc211322dbe33657fb69fc42cc359fdd0dfb5167d17871181af31dc6', 76, 1, 'mealUp', '[]', 0, '2020-12-08 20:58:09', '2020-12-08 20:58:09', '2021-12-08 15:58:09'),
('72baff0ae5b28d1239681d5441cee844bafcb5f0b2a687ff7c45d02d8fbda6a4acbfe0b8b376e852', 19, 1, 'food delivery', '[]', 0, '2021-01-04 05:38:56', '2021-01-04 05:38:56', '2022-01-04 11:08:56'),
('73c15b370a766058443d596838b947960a630ebdbd33ebbb5b6f1e4cfee5f5a0915adf6486a114db', 76, 1, 'mealUp', '[]', 0, '2020-12-12 21:25:23', '2020-12-12 21:25:23', '2021-12-12 16:25:23'),
('741a089132175bbf27ac95e10cdb2c254f032434005f7246d9729df9bf7eb53b3e9f34de360b71ee', 24, 1, 'food delivery', '[]', 0, '2021-02-16 04:23:16', '2021-02-16 04:23:16', '2022-02-16 09:53:16'),
('74a60b81feaf1ec6caa221f3365722284cd3c9742d6d5c29a342e0c1de3362f93ca6ed27183f75b7', 3, 1, 'food delivery', '[]', 0, '2020-12-22 16:24:03', '2020-12-22 16:24:03', '2021-12-22 11:24:03'),
('76c674b51084b02f8e1f6e5753ae5e81cc5a958f542d51e83b0ec4cf1930cf1a32902f07087dd768', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:38:46', '2020-12-22 22:38:46', '2021-12-22 17:38:46'),
('78718f652114aeb8f96e3ba6adf918d010d6798db5597a6daaa407a4ee44dec6a0b3600b68eadef1', 23, 1, 'food delivery', '[]', 0, '2021-01-04 05:45:56', '2021-01-04 05:45:56', '2022-01-04 11:15:56'),
('78d4eb020c3005606a380f4ef679ee179558360f051e5c0b32fff2344aba39bdae2df1ce67f3221e', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:47:50', '2020-12-22 22:47:50', '2021-12-22 17:47:50'),
('79779f0316fd7919d855dd587ef654f27d2e44108b4086998f2c6f598376862b00bfff3775efeef8', 76, 1, 'mealUp', '[]', 0, '2020-12-04 23:21:01', '2020-12-04 23:21:01', '2021-12-04 18:21:01'),
('7c90f9204e7971de8ace8f5c71572bdac640603bcc94bb904a15cec0ab3933340f4e1c38e67747a4', 76, 1, 'mealUp', '[]', 0, '2020-12-15 15:29:07', '2020-12-15 15:29:07', '2021-12-15 10:29:07'),
('7cd87020bd3603b0b1f751bb1a21401b004fcd21abd6733c5f39b19c66303a8585e44b565210703c', 10, 1, 'food delivery', '[]', 0, '2020-12-23 17:08:25', '2020-12-23 17:08:25', '2021-12-23 12:08:25'),
('7d2c6e9a478a9a53bf382ee5b061fe18cebf6e7225d243693457512f713ced6b175a1c1b016ddf54', 10, 1, 'food delivery', '[]', 0, '2020-12-24 16:00:52', '2020-12-24 16:00:52', '2021-12-24 11:00:52'),
('7e05f9c084ea92861fefc854fca599051a097546106a4ff61830a5697a7a5e188790e0bdde9c9b0d', 71, 1, 'mealUp', '[]', 0, '2020-12-02 16:05:43', '2020-12-02 16:05:43', '2021-12-02 11:05:43'),
('7e663494783fb48ece5638a15afd7d2fa34b62dd710ecba0b7a5a4bc9aa0c4ad116ad877e58581fe', 76, 1, 'mealUp', '[]', 0, '2020-12-12 15:20:24', '2020-12-12 15:20:24', '2021-12-12 10:20:24'),
('7e9a9216f32fe39dc0c2623eff18184c147b3f6bb7da5b1edcabe5a997b5e0f42e58c588d99fb234', 3, 1, 'food delivery', '[]', 0, '2020-12-22 21:50:38', '2020-12-22 21:50:38', '2021-12-22 16:50:38'),
('801e8ee0640189c03bb9b7d97446762ad6a73e5540e51b0464edaa255db1b3b0eae881827f9e76f1', 76, 1, 'mealUp', '[]', 0, '2020-12-05 23:18:55', '2020-12-05 23:18:55', '2021-12-05 18:18:55'),
('80851c0252aa735e9c323c6f22bf39da042de5d80019e09f1bbbc86983b4f34ee4ecbc7249432ca4', 18, 1, 'food delivery', '[]', 0, '2021-01-04 05:38:05', '2021-01-04 05:38:05', '2022-01-04 11:08:05'),
('81186b00134f739ddd28d2b7121fb8f712a0359169afa5475e163f386f8aa9df72336dd6da26030d', 20, 1, 'food delivery', '[]', 0, '2021-01-04 05:39:28', '2021-01-04 05:39:28', '2022-01-04 11:09:28'),
('814b4493d40fdf6e7b7fac799189da7a949b14c482d255fc6120b41639834648dababce47a3cfc38', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:53:55', '2020-12-23 23:53:55', '2021-12-23 18:53:55'),
('82f68e11683bf3838a4a288fa8b99060bc36cd4cc6b1d877009318ed6e3f6618eaa2ee36fc026d92', 76, 1, 'mealUp', '[]', 0, '2020-12-14 17:20:41', '2020-12-14 17:20:41', '2021-12-14 12:20:41'),
('835be2abfb19938dc3f9b455279fa4fc16c4049dd4e2a5426f04edbd1474cb119cc4d80416db187f', 67, 1, 'mealUp', '[]', 0, '2020-12-02 16:00:20', '2020-12-02 16:00:20', '2021-12-02 11:00:20'),
('84af1dd7b9a5ace47c8528ef4c7f651f00f298c9dab28214c3f09aa813419c6a48a683c874b83150', 3, 1, 'food delivery', '[]', 0, '2020-12-22 14:46:53', '2020-12-22 14:46:53', '2021-12-22 09:46:53'),
('8726ededb85d598853c1f73e1f27b3ff357d4bd59c2b2be0a1a536fbde639c68ff433281b96cdfdc', 71, 1, 'mealUp', '[]', 0, '2020-12-02 16:06:27', '2020-12-02 16:06:27', '2021-12-02 11:06:27'),
('887084ee2ca1c28aa3d177908b8ef78570a59e601dbb7e56557f9abf2a6a2c77b0a5664094c3cf68', 76, 1, 'mealUp', '[]', 0, '2020-12-12 22:30:49', '2020-12-12 22:30:49', '2021-12-12 17:30:49'),
('887db22447a34a670cd379765fbc47191281eee9ef15c623fefb62a4f67e93b6746fc9254b4a362a', 23, 1, 'food delivery', '[]', 0, '2021-01-04 06:35:39', '2021-01-04 06:35:39', '2022-01-04 12:05:39'),
('8bc7531a8711c0c6e66bc44a4d77b614e42e2f7a370b1757ad1438412545a9dc87b5a1f8598c70e0', 76, 1, 'mealUp', '[]', 0, '2020-12-12 19:29:16', '2020-12-12 19:29:16', '2021-12-12 14:29:16'),
('8c7a8fadf37874000e2d7cf377628574bdc1f9ce31bc8805905fc290c6840632603543171cdeefb2', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:40:17', '2020-12-05 17:40:17', '2021-12-05 12:40:17'),
('8cac4fcab9cca41ccff1f51c0259ee69cccc8cb71a2391e16f152ff02e3735add291f28086107ca3', 76, 1, 'mealUp', '[]', 0, '2020-12-02 21:59:34', '2020-12-02 21:59:34', '2021-12-02 16:59:34'),
('8ec77fc82756ccdd78815f6892ed481a9064398af5c1f3295dfd40320be1b8bb863574b0e68e9d37', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:44:49', '2020-12-05 17:44:49', '2021-12-05 12:44:49'),
('91558272ccf08a3d5009f81d4bf5a14d8e3f5551b9646ef506b12dea57cf594599a21d3f60ef5e3f', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:41:03', '2020-12-22 22:41:03', '2021-12-22 17:41:03'),
('91565461bd48804a7048dd0d0f1859c5e65b5b2708c28838d80d371ff3700247e27ca356712339db', 76, 1, 'mealUp', '[]', 0, '2020-12-05 20:22:02', '2020-12-05 20:22:02', '2021-12-05 15:22:02'),
('93291473a414ff0862bec11cd95491cd2937e2954c72a2249192a2bab7520166f86d6b9dae0afaf3', 62, 1, 'food delivery', '[]', 0, '2020-11-30 08:47:02', '2020-11-30 08:47:02', '2021-11-30 14:17:02'),
('937629e0c142ac100f00b4982e328ccc1148dfc8fc6bc10b265deede1b5bf9c55df04a3379c2db60', 76, 1, 'mealUp', '[]', 0, '2020-12-04 15:16:25', '2020-12-04 15:16:25', '2021-12-04 10:16:25'),
('93ccab74df0742107860d7fd76f3daf70fc048720d4d4fa2976d260e1bf14eab6ba6bf2036cd1ef3', 3, 1, 'food delivery', '[]', 0, '2020-12-22 20:30:44', '2020-12-22 20:30:44', '2021-12-22 15:30:44'),
('93ccdc45ce27fdda2d22ae676f4c6674888d327d86fa3ecfc4549fb89509b303007e71cc57e9793e', 10, 1, 'food delivery', '[]', 0, '2020-12-24 14:28:33', '2020-12-24 14:28:33', '2021-12-24 09:28:33'),
('94ea8acc5803dc5f96810ea25cfde03554786383640be50f79a7f6a6249ba252a374df23f38780b2', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:39:08', '2020-12-22 22:39:08', '2021-12-22 17:39:08'),
('951965786830b35c6625ce6ba995eb1da5a0e66d4b2f2e819587a3152160b8d45b3f8c2d7c867b84', 76, 1, 'mealUp', '[]', 0, '2020-12-12 22:45:26', '2020-12-12 22:45:26', '2021-12-12 17:45:26'),
('975bc6683b131875d0550be492c00b8822ea7583d37c975564ce83d62fed76fd60edb8867f94694c', 76, 1, 'mealUp', '[]', 0, '2020-12-05 20:18:30', '2020-12-05 20:18:30', '2021-12-05 15:18:30'),
('995ed92372e4d4907d364e9e4b16e20b6a698d52d02c0516542546db200a05ef7fbb216944b7ba45', 76, 1, 'mealUp', '[]', 0, '2020-12-04 15:31:31', '2020-12-04 15:31:31', '2021-12-04 10:31:31'),
('99abb0e72aeecbc424854a875ff2ccff5126a4a03a9c4350b4a0491c13cdd93fd1a24ce1e2b3595d', 15, 1, 'food delivery', '[]', 0, '2021-01-04 05:15:39', '2021-01-04 05:15:39', '2022-01-04 10:45:39'),
('99ec16302bfb908f2db6c3a51c16dfa9966d87d175a4fab3bcc1180f3e56bb2cef9328b6a03f5fa1', 76, 1, 'mealUp', '[]', 0, '2020-12-12 21:43:54', '2020-12-12 21:43:54', '2021-12-12 16:43:54'),
('9a0839ff7a1c5ab630abce84e147db6605e120d12a138b139f3c7194418132f237f30d2f0460c623', 76, 1, 'mealUp', '[]', 0, '2020-12-07 20:49:33', '2020-12-07 20:49:33', '2021-12-07 15:49:33'),
('9acc319566e38e09eb71b5d1ce1f62994d1105e6c7994c5e3711bb9a354f0526b3d27f86d6a92079', 76, 1, 'mealUp', '[]', 0, '2020-12-16 17:55:13', '2020-12-16 17:55:13', '2021-12-16 12:55:13'),
('9be3f9f72dd4e9773ec08a619a741b7e7b979eed15d1f32e62c82945f23c5401059a5da043b6b880', 10, 1, 'food delivery', '[]', 0, '2020-12-23 21:35:49', '2020-12-23 21:35:49', '2021-12-23 16:35:49'),
('9be63b71336276b4203fd27e39b9c02a49652d68561baccb69c0b3c8bd2bc83666bb7061c6f80ff7', 76, 1, 'mealUp', '[]', 0, '2020-12-12 19:49:38', '2020-12-12 19:49:38', '2021-12-12 14:49:38'),
('9d030c9f48fef1d7b1a9149d80cfac774b9fb0913c9db4ad39fc1e9c84db02335a52b64daf293b75', 76, 1, 'mealUp', '[]', 0, '2020-12-10 19:31:46', '2020-12-10 19:31:46', '2021-12-10 14:31:46'),
('9e3964b5c505b9e57537c22551b04d31a8bf6dccbba761c9881ffcc73b005c5affcc9f5d431a3384', 10, 1, 'food delivery', '[]', 0, '2020-12-23 19:45:41', '2020-12-23 19:45:41', '2021-12-23 14:45:41'),
('9f26c27841dafd6cd72a53df8e28d966dc33094bdadda41da510f303554fee1ba92b5818ca63d6f2', 67, 1, 'mealUp', '[]', 0, '2020-12-02 15:58:42', '2020-12-02 15:58:42', '2021-12-02 10:58:42'),
('a14367e7964cd172f0f08b79feedd6259846900d2d413ee6e12a9738ca5186cf13ea1803c8bc888f', 10, 1, 'food delivery', '[]', 0, '2020-12-23 21:02:32', '2020-12-23 21:02:32', '2021-12-23 16:02:32'),
('a1bf4e1fb9cd141c3c3707ee735400321cb51095021dee57a1c3a789b8402d7fcc3ec374285897ec', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:40:58', '2020-12-02 22:40:58', '2021-12-02 17:40:58'),
('a20b2398f5c38182a98b717d5b857d8e0ac94192c1374b8f773189143c27aad5bf055afc3733ca0a', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:54:05', '2020-12-24 15:54:05', '2021-12-24 10:54:05'),
('a2d8d928412e86fd154b04167a0856c81e36af616142e5afa4c09ae779e1f123bb6fa4c37555f798', 76, 1, 'mealUp', '[]', 0, '2020-12-03 15:08:21', '2020-12-03 15:08:21', '2021-12-03 10:08:21'),
('a4942c351f5166d57ee3dfc113ab94e4929cbe027ad5d448f02b22091c625cd91de19f8595d15f63', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:26:48', '2020-12-23 23:26:48', '2021-12-23 18:26:48'),
('a52c1aaea5a750e0a63a61d6420de6bd3a31af23859bba8140afa66380b4abd163cd8f40f19b62db', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:40:55', '2020-12-05 17:40:55', '2021-12-05 12:40:55'),
('a8c0f64346fcd6b153e84aaaa08712f440eb46b8e49695939a742c12358fc3a4e83572a6555785c3', 10, 1, 'food delivery', '[]', 0, '2020-12-23 19:29:27', '2020-12-23 19:29:27', '2021-12-23 14:29:27'),
('a8c90804e9dd926415adf8fdb083bd653a5e8f2f85f059b12da398251c7a5d17f3270032dd015b0c', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:08:33', '2020-12-23 23:08:33', '2021-12-23 18:08:33'),
('a9fa611fdc320e3c5923ef12c2ca45a0ef60837e0aac5ef1dbfa015aba582ccc171e1d8eeab13206', 76, 1, 'mealUp', '[]', 0, '2020-12-12 19:57:45', '2020-12-12 19:57:45', '2021-12-12 14:57:45'),
('aa95f0a97cd45e222b8623c876575ab4fa27e981f0c7a45bfa62beb3bfdde20e755821c17152871f', 10, 1, 'food delivery', '[]', 0, '2020-12-24 16:05:31', '2020-12-24 16:05:31', '2021-12-24 11:05:31'),
('ab7ffaac563da181b82851b2988488249b04fc1f0e1df1375fba9d98ad2cb7f1b84fd2012ca7d516', 76, 1, 'mealUp', '[]', 0, '2020-12-12 16:10:33', '2020-12-12 16:10:33', '2021-12-12 11:10:33'),
('ab972ae6a246222895f254565fe41d5dc645af4b38a493dec1c0edee634636fe26f7dff5d6b66445', 76, 1, 'mealUp', '[]', 0, '2020-12-10 22:56:28', '2020-12-10 22:56:28', '2021-12-10 17:56:28'),
('abc6d3a95164ca5583e3ca05acd7798202c04815112e555a16e77a6cc007d7d9546a7eba55434cba', 76, 1, 'mealUp', '[]', 0, '2020-12-12 14:39:42', '2020-12-12 14:39:42', '2021-12-12 09:39:42'),
('ac2c497e19b54933c82ee0e79b95c909c0dedf3133b2eac77c1d8b9d1e7f3d811a4845b6ae82161e', 1, 1, 'food delivery', '[]', 0, '2020-12-18 23:35:40', '2020-12-18 23:35:40', '2021-12-18 18:35:40'),
('ad22d4eec0a2663cb1b18fce4d9c7ec38d1034d6f539fcecc89b58bc9e16d92a7a36cd4e90f61e82', 13, 1, 'food delivery', '[]', 0, '2021-01-04 05:13:14', '2021-01-04 05:13:14', '2022-01-04 10:43:14'),
('adeca3810e898e26fbc4b1e43b27fa73487f2f091b34ab99b752a88423910592aaee113f8765d55a', 10, 1, 'food delivery', '[]', 0, '2020-12-23 22:06:35', '2020-12-23 22:06:35', '2021-12-23 17:06:35'),
('aeeb8cd59a4bb14ae57f9f43506633691272a1ae38a39599e918335f46dbcb985ee4f19002b36a13', 76, 1, 'mealUp', '[]', 0, '2020-12-12 16:35:18', '2020-12-12 16:35:18', '2021-12-12 11:35:18'),
('afea08263ca3831e2550c083d968f4fe1ce840f3f056eb0a6c57609532a9c83b18efdbf9fb81639d', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:33:59', '2020-12-02 22:33:59', '2021-12-02 17:33:59'),
('b111f92a9a7c091dd16adeea412275a769bb924b0dcba6ce4f011aef485678395460f8b8ab3db882', 76, 1, 'mealUp', '[]', 0, '2020-12-15 14:59:28', '2020-12-15 14:59:28', '2021-12-15 09:59:28'),
('b3c9ccdb3e04139c30b77d4efd44a0060fbf4f7d1c559ab9457f03829a919f94e701535ff52520a9', 62, 1, 'mealUp', '[]', 0, '2020-12-02 17:55:52', '2020-12-02 17:55:52', '2021-12-02 12:55:52'),
('b4a9d0875d052d99a71d9857eb5feeb79552cae5619f6189aee60783ca9583a49fff724ab958595c', 76, 1, 'mealUp', '[]', 0, '2020-12-14 14:52:27', '2020-12-14 14:52:27', '2021-12-14 09:52:27'),
('b53c3d30ea0e1c95861c7dce2d7834a1cfae4b3aef5a077cc29fd29160af4155cccfad8af4f3b3d3', 22, 1, 'food delivery', '[]', 0, '2021-01-04 05:45:20', '2021-01-04 05:45:20', '2022-01-04 11:15:20'),
('b57fc5ea2329dfb4a2e995fa58d288deb94678dcbc43458a5da8a2792d6da84fbfbb0a1aed019bd7', 76, 1, 'mealUp', '[]', 0, '2020-12-12 15:10:10', '2020-12-12 15:10:10', '2021-12-12 10:10:10'),
('b7281ada9810b345c082df6fd84a0958db29f302b9f09e8005a3f8640bf7b7976ebf907fb22af76b', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:40:41', '2020-12-05 17:40:41', '2021-12-05 12:40:41'),
('b9fa4aa3343e86e5b656b09e09429457eacefccd26fee089051ec89ed674447344701275e69ae718', 3, 1, 'food delivery', '[]', 0, '2020-12-22 20:10:50', '2020-12-22 20:10:50', '2021-12-22 15:10:50'),
('bba6ea3143ecff587d6d9a5a5d9503e5a5c290c819c3bccbb2400e3fd7a512788e71dddc9365d3bb', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:38:53', '2020-12-22 22:38:53', '2021-12-22 17:38:53'),
('bca3e92bb39c7b6904e875989ce96741c3d165d49a40dff2a302ae8c0ca777490439eeeea2c081cc', 14, 1, 'food delivery', '[]', 0, '2021-01-04 05:15:06', '2021-01-04 05:15:06', '2022-01-04 10:45:06'),
('bd34d26ae3e9cfa3b144f1f7665dd69e2d85f22f8e1bf0cd5dce2e73399b5e25a8e816177a0c0490', 76, 1, 'mealUp', '[]', 0, '2020-12-03 15:13:40', '2020-12-03 15:13:40', '2021-12-03 10:13:40'),
('bd4f60d7e53519f7d8f7a474fd5551c2dc03dfb9bbdb9256df4cdbb5fd1ec13a1d76018bff11f666', 76, 1, 'mealUp', '[]', 0, '2020-12-03 17:06:38', '2020-12-03 17:06:38', '2021-12-03 12:06:38'),
('bda011453a614fee784210621f0f3414e0c97bde57363b3612342b1b004582752d1bdda8fee911c5', 76, 1, 'mealUp', '[]', 0, '2020-12-11 20:48:56', '2020-12-11 20:48:56', '2021-12-11 15:48:56'),
('befb3507689443f84b007d79f11589a0c61e11a24bffadc099d2ed2367578aa8a053143bf464b6f3', 76, 1, 'mealUp', '[]', 0, '2020-12-03 22:33:14', '2020-12-03 22:33:14', '2021-12-03 17:33:14'),
('befc1ae9403c837e3f2851bdba809b3f1d4c041b010a50802db28b9d7ae9608deacc70de076c59e7', 76, 1, 'mealUp', '[]', 0, '2020-12-12 23:19:14', '2020-12-12 23:19:14', '2021-12-12 18:19:14'),
('bf61680fde5decf5767a477e894aca3a662b3fdc4612d5b1f41edf938c7bc7abc0b994203a943445', 10, 1, 'food delivery', '[]', 0, '2020-12-23 23:02:08', '2020-12-23 23:02:08', '2021-12-23 18:02:08'),
('c0c515e1a62e17f91bd6fe49046e69333729e575192e0f0f0b9b5ba8e7226cb321411c9550567c7f', 120, 1, 'mealUp', '[]', 0, '2021-02-16 07:01:25', '2021-02-16 07:01:25', '2022-02-16 12:31:25'),
('c3d19be06f0f90b14d0deebc261e53e5b33eef57f06636af2f02d28e20ef7d7b61e0adaf88fe4ee3', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:43:58', '2020-12-05 17:43:58', '2021-12-05 12:43:58'),
('c529d96323f7938fecfacfca687946296fb03fc02003fef670fa10e827f565e9797efa40f65e53c9', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:40:44', '2020-12-22 22:40:44', '2021-12-22 17:40:44'),
('c5f512fddabdf1219a31a940df026f7ed0564ed94fef282259bc7eabb6996049a6ba913be7a797db', 76, 1, 'mealUp', '[]', 0, '2020-12-14 19:49:34', '2020-12-14 19:49:34', '2021-12-14 14:49:34'),
('c718005f4556e97ae7d1f17b464943f2f7b331232a104629b74ddbbe61bd8c59b16aa7c889bc8559', 76, 1, 'mealUp', '[]', 0, '2020-12-04 16:28:28', '2020-12-04 16:28:28', '2021-12-04 11:28:28'),
('c94d8e2bc9d9bbc105bc2d6c61674fa950960e5023f3d928e832238e8945e7545bcae0dc06be2b03', 58, 1, 'food delivery', '[]', 0, '2020-11-30 11:50:47', '2020-11-30 11:50:47', '2021-11-30 17:20:47'),
('ca5a00ef428fc7e5a1b5bb409ed0dda58b864e69096186d882271c5cb8e1e813a9730784c3df6b47', 76, 1, 'mealUp', '[]', 0, '2020-12-03 15:46:15', '2020-12-03 15:46:15', '2021-12-03 10:46:15'),
('ca950ed9443a608370909a56b037a46aa207aa938bd368dc177b737889fe8cd31b0f70a8d151a493', 76, 1, 'mealUp', '[]', 0, '2020-12-12 22:56:29', '2020-12-12 22:56:29', '2021-12-12 17:56:29'),
('cb7bf40df8e266d251bc508e204fc3a4049dd8dd4621f76c672d645891498329411944beb11cf614', 62, 1, 'food delivery', '[]', 0, '2020-11-28 11:30:56', '2020-11-28 11:30:56', '2021-11-28 17:00:56'),
('cb85b3e99064f194bf3d171613fa780b17fc8ca55969ec69e35327ccd92ab19fe1ce1187f20f3399', 76, 1, 'mealUp', '[]', 0, '2020-12-05 17:43:47', '2020-12-05 17:43:47', '2021-12-05 12:43:47'),
('cc02ca983166f6c44c466059e1e18512516cca934998081d11dbe87f13ff04e24f9a04f7d219f3a6', 76, 1, 'mealUp', '[]', 0, '2020-12-12 23:23:07', '2020-12-12 23:23:07', '2021-12-12 18:23:07'),
('cc3111365c10b1f3f2118b06cf5262171096d7b38f1b228ed54830386c9e5d8219868d3049fffbd8', 76, 1, 'mealUp', '[]', 0, '2020-12-12 16:14:06', '2020-12-12 16:14:06', '2021-12-12 11:14:06'),
('cc40376aa73e486b1c00eb9774d1853efde3fa7be98e37cf337daf20429f33a8610ff81af5279ef3', 76, 1, 'mealUp', '[]', 0, '2020-12-03 17:17:54', '2020-12-03 17:17:54', '2021-12-03 12:17:54'),
('cc5bb3dd3e14ad73896b1c918755b8df6f9efd1fa86eb3c6123842d18cfaeff90b8bc833498ecc09', 76, 1, 'mealUp', '[]', 0, '2020-12-26 05:37:04', '2020-12-26 05:37:04', '2021-12-26 11:07:04'),
('cd0e5e42b81f4a34fd8588e4634a37c5875ffd3db548aa9fdc2f6424c41a21278800625793070316', 10, 1, 'food delivery', '[]', 0, '2020-12-23 18:03:11', '2020-12-23 18:03:11', '2021-12-23 13:03:11'),
('d0da62d010bb522d2bef4ef01c745c392590e9fb37c366baa7773157f2c128357e481043a668e999', 71, 1, 'mealUp', '[]', 0, '2020-12-02 16:55:00', '2020-12-02 16:55:00', '2021-12-02 11:55:00'),
('d0e1f77f6ae7f69257ae1b82fe3429fb8c577d53446a8eaa9749203432fba489aed060fe9a636ae3', 3, 1, 'food delivery', '[]', 0, '2020-12-22 17:40:29', '2020-12-22 17:40:29', '2021-12-22 12:40:29'),
('d197e94a06c5df5ff7ff25b0ee4819b9d4dec5c3861fda1bf78b8566914a2f13b91d147c7a16a85c', 76, 1, 'mealUp', '[]', 0, '2020-12-05 20:14:59', '2020-12-05 20:14:59', '2021-12-05 15:14:59'),
('d1d8fd7a067f88e0892f6b36fc89a22fc3d9cb9b5e950e2f61a3f901f641569afe918cb1b606c4f2', 76, 1, 'mealUp', '[]', 0, '2020-12-03 14:37:45', '2020-12-03 14:37:45', '2021-12-03 09:37:45'),
('d20243ed84a000588c30c09506994a1749b533dd1b2d1f2897ac6041a5d1d928fc28026d91153207', 3, 1, 'food delivery', '[]', 0, '2020-12-22 21:46:19', '2020-12-22 21:46:19', '2021-12-22 16:46:19'),
('d289a0d75a6ec496fadc416e460c9f17954173cb3975e4b410a05b73d1c8e2545418c9cc72e46b04', 76, 1, 'mealUp', '[]', 0, '2020-12-14 16:20:55', '2020-12-14 16:20:55', '2021-12-14 11:20:55'),
('d29114a2ecfa72ea14517c8ced4c1856a1814d72e202b8cd462acd919290b3fd0de95b04c24925db', 76, 1, 'mealUp', '[]', 0, '2020-12-03 22:38:36', '2020-12-03 22:38:36', '2021-12-03 17:38:36'),
('d6e9ccc3b1ad1d5817129662ae68394c3db75aa8cff7b039183d3f7b6c688779fd6017e143bc72be', 62, 1, 'food delivery', '[]', 0, '2020-12-01 05:58:08', '2020-12-01 05:58:08', '2021-12-01 11:28:08'),
('d80122ae052b2a35f8855fd6c7717a8ae8c1c434fb81d4d26a134033d554619c8061c3d00b3c6ac6', 16, 1, 'food delivery', '[]', 0, '2021-01-04 05:16:03', '2021-01-04 05:16:03', '2022-01-04 10:46:03'),
('d80a56ca38a9b8f37ad98bb7830602c28ea6cc4bf41b7b27fbd47aa0e01bbda503139ded80c949a9', 76, 1, 'mealUp', '[]', 0, '2020-12-10 17:30:52', '2020-12-10 17:30:52', '2021-12-10 12:30:52'),
('d90b8afd7530066ece823ef4f82ebef6dcbf443402f8d82ee00656bc0138dc26c4478d9c9e1efeb2', 10, 1, 'food delivery', '[]', 0, '2020-12-24 16:08:15', '2020-12-24 16:08:15', '2021-12-24 11:08:15'),
('d91c04e1f9149f4b8914460bd77f4a489ae60ac49250cf83ad96a371bcf160cfdd4b53a597978822', 29, 1, 'food delivery', '[]', 0, '2021-02-16 04:11:34', '2021-02-16 04:11:34', '2022-02-16 09:41:34'),
('d96af8445839f56bba0b55d68b077ebe2842706a1d1d293f8f5ee679eef8fe299f8ac1995edde317', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:43:38', '2020-12-24 15:43:38', '2021-12-24 10:43:38'),
('d9978d5041897eef0ae6133ef0612a17e15eb14592b0ae91ef04f751eef7e1ed638debdfc13ca9b7', 76, 1, 'mealUp', '[]', 0, '2020-12-12 22:03:51', '2020-12-12 22:03:51', '2021-12-12 17:03:51'),
('da80f19312dc2e241d3476ab2481cfec67e08d42cf1c4537ae72c7f44c70d72212507ad0dbb1cf73', 10, 1, 'food delivery', '[]', 0, '2020-12-23 18:00:15', '2020-12-23 18:00:15', '2021-12-23 13:00:15'),
('db792bfc26428f7e643ecc70a16a89ec2abf10819d0968fb00147240f2e8b94e8bb05e98551b9f8b', 76, 1, 'mealUp', '[]', 0, '2020-12-11 14:39:12', '2020-12-11 14:39:12', '2021-12-11 09:39:12'),
('db8045b079bc29663169835d544a1d992c232196e959db837677b4f2596028e5c3844c5cc381d0f7', 76, 1, 'mealUp', '[]', 0, '2020-12-04 16:36:54', '2020-12-04 16:36:54', '2021-12-04 11:36:54'),
('db8965c61f92e668528c07284803e9b46efbfd9191fd3bdc679cccaedb3e36e5fae8a53af4a3fa3c', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:47:55', '2020-12-24 15:47:55', '2021-12-24 10:47:55'),
('dbce56dcf3ef239fffe991e276af154ca9c43034abb6863f5337e20aff55c38935583a1d06b64662', 76, 1, 'mealUp', '[]', 0, '2020-12-02 22:40:36', '2020-12-02 22:40:36', '2021-12-02 17:40:36'),
('dbda716644e647f9ef22e66a931813ebab50b626afbeecf4f89e34bf36a7b5b29bd12ec9df630118', 58, 1, 'food delivery', '[]', 0, '2020-11-28 10:51:11', '2020-11-28 10:51:11', '2021-11-28 16:21:11'),
('dc3d23d6880a817e0eb88c55856398c40e8edc7ff365cbfc9860874b18265f504329c0fc2df5470e', 3, 1, 'food delivery', '[]', 0, '2020-12-22 16:24:57', '2020-12-22 16:24:57', '2021-12-22 11:24:57'),
('dc5f17f4e61108fc760cba5fc184eabb3462ecfbd54c3853812e62ef5ee19ff005e2e3ede19eeac1', 76, 1, 'mealUp', '[]', 0, '2020-12-07 21:27:27', '2020-12-07 21:27:27', '2021-12-07 16:27:27'),
('df630964193ea341fe902cbc6ab1a88c72926e29ee432e70f5226d705503f54c48be10d43afe2fc6', 125, 1, 'mealUp', '[]', 0, '2021-02-16 08:47:43', '2021-02-16 08:47:43', '2022-02-16 14:17:43'),
('e05d418a021e53a4a9b857ee1078001033186776a86ac852e9c9e6dec614a98af0c9d3e41c0e40cf', 58, 1, 'food delivery', '[]', 0, '2020-11-28 12:08:28', '2020-11-28 12:08:28', '2021-11-28 17:38:28'),
('e182599e007ffa96a4c32596c81471de911dd033fc4d57094dd1629075fb9fe1c0c01a101bd66206', 76, 1, 'mealUp', '[]', 0, '2020-12-12 21:12:26', '2020-12-12 21:12:26', '2021-12-12 16:12:26'),
('e1a10db2e4de432ad503925a144b0471619b474ff01e491377b0e6bd8cefd4f6522970f24674ec3b', 119, 1, 'mealUp', '[]', 0, '2021-02-15 09:13:29', '2021-02-15 09:13:29', '2022-02-15 14:43:29'),
('e1b0ed176eefd04d2233f968e98f35e7c33fabe851b686574c33ea472d0bc239dfe573e417d09410', 21, 1, 'food delivery', '[]', 0, '2021-01-04 05:41:21', '2021-01-04 05:41:21', '2022-01-04 11:11:21'),
('e25d92547852de2456c30583ebc3249753b71ca9c19ed455216de6c815148fe6f9f92458f300afc6', 10, 1, 'food delivery', '[]', 0, '2020-12-23 18:06:43', '2020-12-23 18:06:43', '2021-12-23 13:06:43'),
('e364f92c7a0250f752cf630356ca002092d3090e1ca4f79b64d568f9355a3e5851edc69676c9e2dd', 1, 1, 'food delivery', '[]', 0, '2020-12-18 23:36:07', '2020-12-18 23:36:07', '2021-12-18 18:36:07'),
('e4e51ee330358746499cb13e10be6ee0edb0928305cc32e7547193492ac007482f0b4e786aea3da2', 28, 1, 'food delivery', '[]', 0, '2021-02-16 04:31:01', '2021-02-16 04:31:01', '2022-02-16 10:01:01'),
('e5771d5a8dc1672742da488adbb8fe37662234a4aaab655786f62b1b21890dffcb712d9b658d66b1', 76, 1, 'mealUp', '[]', 0, '2020-12-14 17:54:48', '2020-12-14 17:54:48', '2021-12-14 12:54:48'),
('e5a45df24429b63ea84e4fed88f99db26dbabacb8fe78c11e0e892905720ac455fb11323839cd056', 3, 1, 'food delivery', '[]', 0, '2020-12-22 16:25:44', '2020-12-22 16:25:44', '2021-12-22 11:25:44'),
('e5c39c55fe01ceed27ed439d4366a2cc9c0b2371042a9e8461de3e9f93e7ffe762a005c03a10716b', 76, 1, 'mealUp', '[]', 0, '2020-12-14 23:45:56', '2020-12-14 23:45:56', '2021-12-14 18:45:56'),
('e7745bcc0631c322c405ccb098a643d2d8c35997f2416769360ff9a9663779991fa29341e9c5bf40', 3, 1, 'food delivery', '[]', 0, '2020-12-22 16:25:06', '2020-12-22 16:25:06', '2021-12-22 11:25:06'),
('e7d859e1adc216f99157bee32cee0b722ba27cc272534d310e6826716bb97b630d4e42766d308744', 76, 1, 'mealUp', '[]', 0, '2020-12-14 21:03:56', '2020-12-14 21:03:56', '2021-12-14 16:03:56'),
('e915a498608f003e36a1fe20418d0bb9176a093d86a5e79d60a327230c90c2e602e824f3d8da6408', 76, 1, 'mealUp', '[]', 0, '2020-12-08 15:34:43', '2020-12-08 15:34:43', '2021-12-08 10:34:43'),
('e9dda7fb246fcd05fad29da469c8b2f8ea6984668d17cb0a8799580c7b9922a8bba6e05673a81f81', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:26:58', '2020-12-24 15:26:58', '2021-12-24 10:26:58'),
('ea69f5f2e6f50b2a83405ccbfb6702681823ffc2244f89972e9dca1ee13d9b4621e6472d209fadb2', 71, 1, 'mealUp', '[]', 0, '2020-12-02 16:55:45', '2020-12-02 16:55:45', '2021-12-02 11:55:45'),
('eac98db63125cdf7b056e2905ef9d9b5948236b7f2d40df023d637fcbce4f18364a30c212b1760bf', 76, 1, 'mealUp', '[]', 0, '2020-12-14 19:26:05', '2020-12-14 19:26:05', '2021-12-14 14:26:05'),
('eb63c4fa20eba303c81b103328d9defad52c4bb961874854cec9fbb592a82fa0263b2ddaf1ae435c', 76, 1, 'mealUp', '[]', 0, '2020-12-15 14:56:54', '2020-12-15 14:56:54', '2021-12-15 09:56:54'),
('eb7351144201abf5a94d7a22689b03ab9a8687463c3fc09f92459828f72ca9e77143d4a2124a046b', 9, 1, 'food delivery', '[]', 0, '2020-12-23 21:26:29', '2020-12-23 21:26:29', '2021-12-23 16:26:29'),
('ee3c32ab2446a9ee540c08aeab502b3ddf36c9ea14998a1e3dc4a8719aa22703f8e226b59dcbd3e0', 3, 1, 'food delivery', '[]', 0, '2020-12-21 15:13:50', '2020-12-21 15:13:50', '2021-12-21 10:13:50'),
('ee5273c8374a5703c9872df714c05b8be6248a8c3d1e31273358373722edfd74b6390e5079f5cb8a', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:42:56', '2020-12-22 22:42:56', '2021-12-22 17:42:56'),
('f11ecff295d79e5d8fe21ad86262a1e8f61d7e154856a2f5e42c1b3d5ea9d1e0bba10cef9c73ccf9', 24, 1, 'food delivery', '[]', 0, '2021-02-16 04:14:40', '2021-02-16 04:14:40', '2022-02-16 09:44:40'),
('f12affba221ff165973a3617b2417850b53821e708e72ac3f88adb70430b535bcef0d3d5548cad43', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:47:18', '2020-12-22 22:47:18', '2021-12-22 17:47:18'),
('f12d108f8789c0a3cc19e0d4fb303d540633228f6d81bf98806d7d629c8184fcb35b4b3ba0b59d81', 76, 1, 'mealUp', '[]', 0, '2020-12-04 16:31:03', '2020-12-04 16:31:03', '2021-12-04 11:31:03');
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('f1d370c1c27a908284ab9f43fce94ad4b150d564dd8531373f92bf20576b190771283217ba8f4c3d', 76, 1, 'mealUp', '[]', 0, '2020-12-12 20:07:17', '2020-12-12 20:07:17', '2021-12-12 15:07:17'),
('f44e50f0c54b73cff9a267a73823d28d4bbc7749319abdfd5962c82006b3653dab9c0efa0d557302', 76, 1, 'mealUp', '[]', 0, '2020-12-14 20:58:25', '2020-12-14 20:58:25', '2021-12-14 15:58:25'),
('f467642daa8e736272d61e4f8f4cee3d69484d1d236f6c02f562ed85b247c38e62579c3b408aa752', 76, 1, 'mealUp', '[]', 0, '2020-12-04 21:57:18', '2020-12-04 21:57:18', '2021-12-04 16:57:18'),
('f4d9a32380bf6c9b97234057a9ca4a8688275b7b7f9b6a3ab945e01344fbfba7dd51f1cd24d0e0a5', 76, 1, 'mealUp', '[]', 0, '2020-12-15 19:24:49', '2020-12-15 19:24:49', '2021-12-15 14:24:49'),
('f5d3b082e6ffeca800360dfa22353f5ea076cb4dc2fec9176723513f6582fe658d46439d6f98724b', 76, 1, 'mealUp', '[]', 0, '2020-12-15 16:37:13', '2020-12-15 16:37:13', '2021-12-15 11:37:13'),
('f6ffe562584d0015ca801012079c6f6a53d5da66a8ab25f8876d31e39b0840690444fb4237ff067d', 10, 1, 'food delivery', '[]', 0, '2020-12-24 15:54:13', '2020-12-24 15:54:13', '2021-12-24 10:54:13'),
('f7ed8b4772482d98633314fbe298e50544a55d0f7c0cc664e1cc43edbc07e884ef6d6a77d2258736', 76, 1, 'mealUp', '[]', 0, '2020-12-11 16:50:16', '2020-12-11 16:50:16', '2021-12-11 11:50:16'),
('f8444ecf9367f5922f54c6277428b5077f4d8002b82cc84e44af31cf023b553368a1d7130bc01a50', 10, 1, 'food delivery', '[]', 0, '2020-12-25 12:48:14', '2020-12-25 12:48:14', '2021-12-25 18:18:14'),
('fbc05830b928b11ce1c3376bea4c3e146ed45d2bed824e6162c4d313ef3314fa4abd46111cbcfce7', 10, 1, 'food delivery', '[]', 0, '2020-12-22 22:38:28', '2020-12-22 22:38:28', '2021-12-22 17:38:28'),
('fd0036c6dc1f034d59ddb79f23e1140169b2767c29b6d299a15ffc62f863b498c02fa105fb00f7f3', 10, 1, 'food delivery', '[]', 0, '2020-12-23 22:06:50', '2020-12-23 22:06:50', '2021-12-23 17:06:50'),
('fdb6800c8b1b672d44d4c3fb51183cb709778c2124e3a7fcf7163997feee8930689fc65a65440fea', 10, 1, 'food delivery', '[]', 0, '2020-12-23 17:10:08', '2020-12-23 17:10:08', '2021-12-23 12:10:08'),
('fec4c4a9ad4dbc5638604f9fdfa8ebc430d3d782a513e7b93faee9c656d74f32ae1ec0db056902df', 76, 1, 'mealUp', '[]', 0, '2020-12-14 19:32:47', '2020-12-14 19:32:47', '2021-12-14 14:32:47'),
('ffd4962a945f44db1fee7605c304c2e2e48f90af613b8f977e13b0d426961d0eaa06f83c920be943', 10, 1, 'food delivery', '[]', 0, '2020-12-23 20:59:18', '2020-12-23 20:59:18', '2021-12-23 15:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'IQTBkRO2wmRNP05O37ybqgVfwGbScAXniNvrdk6b', NULL, 'http://localhost', 1, 0, 0, '2020-11-28 07:10:19', '2020-11-28 07:10:19'),
(2, NULL, 'Laravel Password Grant Client', 'wGKoskBtEd46BnCBVvatwETRdZvQkZthevAKfcBv', 'users', 'http://localhost', 0, 1, 0, '2020-11-28 07:10:19', '2020-11-28 07:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-11-28 07:10:19', '2020-11-28 07:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_person_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `admin_commission` int(11) DEFAULT NULL,
  `vendor_amount` int(11) DEFAULT NULL,
  `delivery_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promocode_id` bigint(20) UNSIGNED DEFAULT NULL,
  `promocode_price` int(11) DEFAULT 0,
  `vendor_discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_discount_price` int(11) DEFAULT 0,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_charge` int(11) DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_start_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_end_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_child`
--

CREATE TABLE `order_child` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `custimization` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_setting`
--

CREATE TABLE `order_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_order_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_assign_manually` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderRefresh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_commission` int(11) DEFAULT NULL,
  `order_dashboard_default_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_order_max_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_order_max_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_charge_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_setting`
--

INSERT INTO `order_setting` (`id`, `min_order_value`, `order_assign_manually`, `orderRefresh`, `order_commission`, `order_dashboard_default_time`, `vendor_order_max_time`, `driver_order_max_time`, `delivery_charge_type`, `charges`, `created_at`, `updated_at`) VALUES
(1, '200', '0', '5', 10, '7days', '60', '60', 'order_amount', '[{\"min_value\":\"1\",\"max_value\":\"10\",\"charges\":\"50\"},{\"min_value\":\"10\",\"max_value\":\"20\",\"charges\":\"100\"}]', '2020-11-01 22:24:57', '2021-01-02 07:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_setting`
--

CREATE TABLE `payment_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod` tinyint(1) NOT NULL DEFAULT 1,
  `stripe` tinyint(1) DEFAULT NULL,
  `razorpay` tinyint(1) DEFAULT NULL,
  `paypal` tinyint(1) DEFAULT NULL,
  `flutterwave` tinyint(1) DEFAULT NULL,
  `wallet` tinyint(1) DEFAULT NULL,
  `stripe_publish_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_production` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_sendbox` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_client_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_secret_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_publish_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_setting`
--

INSERT INTO `payment_setting` (`id`, `cod`, `stripe`, `razorpay`, `paypal`, `flutterwave`, `wallet`, `stripe_publish_key`, `stripe_secret_key`, `paypal_production`, `paypal_sendbox`, `paypal_client_id`, `paypal_secret_key`, `razorpay_publish_key`, `public_key`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-29 06:09:35', '2021-07-05 06:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'role_add', NULL, NULL),
(2, 'role_edit', NULL, NULL),
(3, 'role_access', NULL, NULL),
(4, 'role_delete', NULL, NULL),
(5, 'user_access', NULL, NULL),
(6, 'user_add', NULL, NULL),
(7, 'user_edit', NULL, NULL),
(8, 'user_delete', NULL, NULL),
(9, 'delivery_zone_access', NULL, NULL),
(10, 'delivery_zone_add', NULL, NULL),
(11, 'delivery_zone_edit', NULL, NULL),
(12, 'delivery_zone_delete', NULL, NULL),
(13, 'delivery_person_access', NULL, NULL),
(14, 'delivery_person_add', NULL, NULL),
(15, 'delivery_person_edit', NULL, NULL),
(16, 'delivery_person_delete', NULL, NULL),
(17, 'promo_code_access', NULL, NULL),
(18, 'promo_code_add', NULL, NULL),
(19, 'promo_code_edit', NULL, NULL),
(20, 'promo_code_delete', NULL, NULL),
(21, 'admin_vendor_access', NULL, NULL),
(22, 'admin_vendor_add', NULL, NULL),
(23, 'admin_vendor_edit', NULL, NULL),
(24, 'admin_vendor_delete', NULL, NULL),
(25, 'cuisine_access', NULL, NULL),
(26, 'cuisine_add', NULL, NULL),
(27, 'cuisine_edit', NULL, NULL),
(28, 'cuisine_delete', NULL, NULL),
(29, 'faq_access', NULL, NULL),
(30, 'faq_add', NULL, NULL),
(31, 'faq_edit', NULL, NULL),
(32, 'faq_delete', NULL, NULL),
(33, 'banner_access', NULL, NULL),
(34, 'banner_add', NULL, NULL),
(35, 'banner_edit', NULL, NULL),
(36, 'banner_delete', NULL, NULL),
(37, 'countrymanagement_access', NULL, NULL),
(38, 'countrymanagement_add', NULL, NULL),
(39, 'countrymanagement_edit', NULL, NULL),
(40, 'countrymanagement_delete', NULL, NULL),
(41, 'admin_menu_access', NULL, NULL),
(42, 'admin_menu_add', NULL, NULL),
(43, 'admin_menu_edit', NULL, NULL),
(44, 'admin_menu_delete', NULL, NULL),
(46, 'country_access', NULL, NULL),
(47, 'country_add', NULL, NULL),
(48, 'country_edit', NULL, NULL),
(49, 'country_delete', NULL, NULL),
(50, 'state_access', NULL, NULL),
(51, 'state_add', NULL, NULL),
(52, 'state_edit', NULL, NULL),
(53, 'state_delete', NULL, NULL),
(54, 'city_access', NULL, NULL),
(55, 'city_add', NULL, NULL),
(56, 'city_edit', NULL, NULL),
(57, 'city_delete', NULL, NULL),
(58, 'admin_menu_category_access', NULL, NULL),
(59, 'menu_category_add', NULL, NULL),
(60, 'menu_category_edit', NULL, NULL),
(61, 'menu_category_delete', NULL, NULL),
(62, 'admin_setting', '2020-11-03 16:00:56', '2020-11-03 16:00:56'),
(63, 'notification_template_add', '2020-11-03 16:01:24', '2020-11-03 16:01:24'),
(64, 'notification_template_access', NULL, NULL),
(65, 'notification_template_edit', NULL, NULL),
(66, 'notification_template_delete', NULL, NULL),
(67, 'admin_profile_access', '2020-11-03 16:33:34', '2020-11-03 16:33:34'),
(68, 'admin_submenu_access', NULL, NULL),
(69, 'admin_submenu_add', NULL, NULL),
(70, 'admin_submenu_edit', NULL, NULL),
(71, 'admin_submenu_delete', NULL, NULL),
(72, 'admin_custimization_access', NULL, NULL),
(73, 'admin_custimization_add', NULL, NULL),
(74, 'admin_custimization_edit', NULL, NULL),
(75, 'admin_custimization_delete', NULL, NULL),
(76, 'admin_custimization_type_access', NULL, NULL),
(77, 'admin_custimization_type_add', NULL, NULL),
(78, 'admin_custimization_type_edit', NULL, NULL),
(79, 'admin_custimization_type_delete', NULL, NULL),
(80, 'admin_vendor_discount_access', NULL, NULL),
(81, 'vendor_discount_add', NULL, NULL),
(82, 'vendor_discount_edit', NULL, NULL),
(83, 'vendor_discount_delete', NULL, NULL),
(84, 'admin_vendor_financeDetails', NULL, NULL),
(85, 'admin_vendor_password', NULL, NULL),
(86, 'admin_vendor_bankDetails', NULL, NULL),
(87, 'admin_vendor_sellingTimeslots', NULL, NULL),
(88, 'admin_vendor_pickupTimeslots', NULL, NULL),
(89, 'admin_vendor_deliveryTimeslots', NULL, NULL),
(90, 'admin_vendor_reviews', NULL, NULL),
(91, 'vendor_discount_access', NULL, NULL),
(92, 'vendor_financeDetails', NULL, NULL),
(93, 'vendor_reviews', NULL, NULL),
(94, 'menu_category_access', NULL, NULL),
(95, 'vendor_bank_details', NULL, NULL),
(96, 'vendor_deliveryTimeslots', NULL, NULL),
(97, 'vendor_pickupTimeslots', NULL, NULL),
(98, 'vendor_sellingTimeslots', NULL, NULL),
(99, 'vendor_order_access', NULL, NULL),
(100, 'vendor_order_add', NULL, NULL),
(101, 'vendor_submenu_access', NULL, NULL),
(102, 'vendor_submenu_add', NULL, NULL),
(103, 'vendor_submenu_edit', NULL, NULL),
(104, 'vendor_menu_access', NULL, NULL),
(105, 'vendor_menu_add', NULL, NULL),
(106, 'vendor_menu_edit', NULL, NULL),
(107, 'vendor_custimization_access', NULL, NULL),
(108, 'vendor_custimization_add', NULL, NULL),
(109, 'vendor_custimization_edit', NULL, NULL),
(110, 'vendor_order_add', NULL, NULL),
(112, 'order_access', NULL, NULL),
(113, 'access_settelments', NULL, NULL),
(114, 'edit_settelments', NULL, NULL),
(115, 'vendor_bank_details', NULL, NULL),
(116, 'vendor_custimization_type_access', NULL, NULL),
(117, 'vendor_custimization_type_add', NULL, NULL),
(118, 'vendor_custimization_type_edit', NULL, NULL),
(119, 'vendor_custimization_type_delete', NULL, NULL),
(120, 'admin_dashboard', NULL, NULL),
(121, 'vendor_dashboard', NULL, NULL),
(122, 'admin_reports', NULL, NULL),
(123, 'vendor_reports', NULL, NULL),
(124, 'feedback_support', NULL, NULL),
(125, 'language_access', NULL, NULL),
(126, 'language_edit', NULL, NULL),
(127, 'language_add', NULL, NULL),
(128, 'refund_access', NULL, NULL),
(129, 'tax_access', '2021-06-01 13:05:31', '2021-06-01 13:05:31'),
(130, 'tax_add', '2021-06-01 13:05:31', '2021-06-01 13:05:31'),
(131, 'tax_edit', '2021-06-01 13:05:31', '2021-06-01 13:05:31'),
(132, 'tax_delete', '2021-06-01 13:05:31', '2021-06-01 13:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 51),
(2, 50),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 70),
(2, 69),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77),
(2, 78),
(2, 79),
(2, 80),
(2, 81),
(2, 82),
(2, 83),
(2, 84),
(2, 85),
(2, 86),
(2, 87),
(2, 88),
(2, 89),
(2, 90),
(4, 91),
(4, 95),
(4, 96),
(4, 97),
(4, 98),
(4, 92),
(4, 94),
(4, 90),
(4, 93),
(4, 99),
(4, 60),
(4, 61),
(4, 81),
(4, 82),
(4, 59),
(4, 101),
(4, 104),
(4, 102),
(4, 103),
(4, 107),
(4, 108),
(4, 109),
(2, 112),
(2, 113),
(4, 100),
(4, 116),
(4, 117),
(4, 118),
(4, 119),
(4, 121),
(2, 120),
(2, 122),
(2, 125),
(2, 126),
(2, 127),
(4, 9),
(4, 10),
(4, 11),
(4, 13),
(4, 14),
(4, 15),
(4, 123),
(2, 128),
(2, 124),
(2, 129),
(2, 130),
(2, 131),
(2, 132),
(2, 71),
(2, 20),
(4, 83);

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_customer_app` tinyint(1) NOT NULL,
  `vendor_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFlat` tinyint(1) NOT NULL,
  `max_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count_max_user` int(11) DEFAULT 0,
  `flatDiscount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discountType` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(100) DEFAULT NULL,
  `max_disc_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_order_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_count` int(11) NOT NULL,
  `count_max_count` int(11) DEFAULT 0,
  `max_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count_max_order` int(11) DEFAULT 0,
  `coupen_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_end_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refaund`
--

CREATE TABLE `refaund` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `refund_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refund_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(2, 'admin', '2020-10-24 03:58:02', '2020-10-26 04:56:08'),
(3, 'user', '2020-10-26 05:17:20', '2020-10-26 05:17:20'),
(4, 'vendor', '2020-11-03 06:44:54', '2020-11-03 06:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 2),
(2, 3),
(13, 4),
(12, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(20, 4),
(21, 4),
(23, 4),
(24, 4),
(25, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(35, 4),
(36, 4),
(37, 3),
(38, 3),
(39, 3),
(40, 4),
(43, 4),
(44, 4),
(53, 3),
(56, 4),
(58, 4),
(59, 3),
(60, 4),
(61, 4),
(63, 3),
(62, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(77, 4),
(78, 3),
(79, 3),
(80, 3),
(81, 4),
(82, 4),
(83, 4),
(84, 4),
(85, 4),
(86, 4),
(87, 4),
(88, 4),
(89, 4),
(90, 4),
(91, 3),
(92, 4),
(93, 4),
(94, 3),
(95, 4),
(96, 4),
(97, 4),
(98, 4),
(99, 4),
(100, 4),
(101, 4),
(102, 4),
(103, 4),
(104, 4),
(105, 4),
(106, 4),
(107, 4),
(108, 4),
(109, 4),
(110, 4),
(111, 4),
(112, 4),
(113, 4),
(114, 4),
(115, 3),
(116, 3),
(117, 3),
(118, 3),
(119, 3),
(120, 3),
(121, 3),
(125, 3),
(126, 4),
(127, 3),
(128, 4),
(129, 4),
(130, 4),
(131, 3),
(132, 4),
(133, 3),
(134, 4),
(135, 3),
(136, 4),
(137, 4),
(138, 4),
(139, 3),
(140, 3),
(141, 4),
(142, 4),
(143, 4),
(144, 4),
(145, 4),
(146, 4),
(147, 3);

-- --------------------------------------------------------

--
-- Table structure for table `settlements`
--

CREATE TABLE `settlements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_earning` int(11) DEFAULT NULL,
  `payment` int(11) NOT NULL,
  `admin_earning` int(11) NOT NULL,
  `vendor_earning` int(11) NOT NULL,
  `vendor_status` int(11) NOT NULL,
  `driver_status` int(11) DEFAULT NULL,
  `payment_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_payment_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_payment_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty_reset` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `item_reset_value` int(11) DEFAULT NULL,
  `is_excel` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submenu_cutsomization_type`
--

CREATE TABLE `submenu_cutsomization_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `submenu_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_item_selection` int(11) NOT NULL,
  `max_item_selection` int(11) NOT NULL,
  `custimazation_item` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `tax` text NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `CountryCode` char(2) NOT NULL,
  `Coordinates` char(15) NOT NULL,
  `TimeZone` char(32) NOT NULL,
  `Comments` varchar(85) NOT NULL,
  `UTC_offset` char(8) NOT NULL,
  `UTC_DST_offset` char(8) NOT NULL,
  `Notes` varchar(79) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`CountryCode`, `Coordinates`, `TimeZone`, `Comments`, `UTC_offset`, `UTC_DST_offset`, `Notes`) VALUES
('CI', '+0519-00402', 'Africa/Abidjan', '', '+00:00', '+00:00', ''),
('GH', '+0533-00013', 'Africa/Accra', '', '+00:00', '+00:00', ''),
('ET', '+0902+03842', 'Africa/Addis_Ababa', '', '+03:00', '+03:00', ''),
('DZ', '+3647+00303', 'Africa/Algiers', '', '+01:00', '+01:00', ''),
('ER', '+1520+03853', 'Africa/Asmara', '', '+03:00', '+03:00', ''),
('', '', 'Africa/Asmera', '', '+03:00', '+03:00', 'Link to Africa/Asmara'),
('ML', '+1239-00800', 'Africa/Bamako', '', '+00:00', '+00:00', ''),
('CF', '+0422+01835', 'Africa/Bangui', '', '+01:00', '+01:00', ''),
('GM', '+1328-01639', 'Africa/Banjul', '', '+00:00', '+00:00', ''),
('GW', '+1151-01535', 'Africa/Bissau', '', '+00:00', '+00:00', ''),
('MW', '-1547+03500', 'Africa/Blantyre', '', '+02:00', '+02:00', ''),
('CG', '-0416+01517', 'Africa/Brazzaville', '', '+01:00', '+01:00', ''),
('BI', '-0323+02922', 'Africa/Bujumbura', '', '+02:00', '+02:00', ''),
('EG', '+3003+03115', 'Africa/Cairo', '', '+02:00', '+02:00', 'DST has been canceled since 2011'),
('MA', '+3339-00735', 'Africa/Casablanca', '', '+00:00', '+01:00', ''),
('ES', '+3553-00519', 'Africa/Ceuta', 'Ceuta & Melilla', '+01:00', '+02:00', ''),
('GN', '+0931-01343', 'Africa/Conakry', '', '+00:00', '+00:00', ''),
('SN', '+1440-01726', 'Africa/Dakar', '', '+00:00', '+00:00', ''),
('TZ', '-0648+03917', 'Africa/Dar_es_Salaam', '', '+03:00', '+03:00', ''),
('DJ', '+1136+04309', 'Africa/Djibouti', '', '+03:00', '+03:00', ''),
('CM', '+0403+00942', 'Africa/Douala', '', '+01:00', '+01:00', ''),
('EH', '+2709-01312', 'Africa/El_Aaiun', '', '+00:00', '+00:00', ''),
('SL', '+0830-01315', 'Africa/Freetown', '', '+00:00', '+00:00', ''),
('BW', '-2439+02555', 'Africa/Gaborone', '', '+02:00', '+02:00', ''),
('ZW', '-1750+03103', 'Africa/Harare', '', '+02:00', '+02:00', ''),
('ZA', '-2615+02800', 'Africa/Johannesburg', '', '+02:00', '+02:00', ''),
('SS', '+0451+03136', 'Africa/Juba', '', '+03:00', '+03:00', ''),
('UG', '+0019+03225', 'Africa/Kampala', '', '+03:00', '+03:00', ''),
('SD', '+1536+03232', 'Africa/Khartoum', '', '+03:00', '+03:00', ''),
('RW', '-0157+03004', 'Africa/Kigali', '', '+02:00', '+02:00', ''),
('CD', '-0418+01518', 'Africa/Kinshasa', 'west Dem. Rep. of Congo', '+01:00', '+01:00', ''),
('NG', '+0627+00324', 'Africa/Lagos', '', '+01:00', '+01:00', ''),
('GA', '+0023+00927', 'Africa/Libreville', '', '+01:00', '+01:00', ''),
('TG', '+0608+00113', 'Africa/Lome', '', '+00:00', '+00:00', ''),
('AO', '-0848+01314', 'Africa/Luanda', '', '+01:00', '+01:00', ''),
('CD', '-1140+02728', 'Africa/Lubumbashi', 'east Dem. Rep. of Congo', '+02:00', '+02:00', ''),
('ZM', '-1525+02817', 'Africa/Lusaka', '', '+02:00', '+02:00', ''),
('GQ', '+0345+00847', 'Africa/Malabo', '', '+01:00', '+01:00', ''),
('MZ', '-2558+03235', 'Africa/Maputo', '', '+02:00', '+02:00', ''),
('LS', '-2928+02730', 'Africa/Maseru', '', '+02:00', '+02:00', ''),
('SZ', '-2618+03106', 'Africa/Mbabane', '', '+02:00', '+02:00', ''),
('SO', '+0204+04522', 'Africa/Mogadishu', '', '+03:00', '+03:00', ''),
('LR', '+0618-01047', 'Africa/Monrovia', '', '+00:00', '+00:00', ''),
('KE', '-0117+03649', 'Africa/Nairobi', '', '+03:00', '+03:00', ''),
('TD', '+1207+01503', 'Africa/Ndjamena', '', '+01:00', '+01:00', ''),
('NE', '+1331+00207', 'Africa/Niamey', '', '+01:00', '+01:00', ''),
('MR', '+1806-01557', 'Africa/Nouakchott', '', '+00:00', '+00:00', ''),
('BF', '+1222-00131', 'Africa/Ouagadougou', '', '+00:00', '+00:00', ''),
('BJ', '+0629+00237', 'Africa/Porto-Novo', '', '+01:00', '+01:00', ''),
('ST', '+0020+00644', 'Africa/Sao_Tome', '', '+00:00', '+00:00', ''),
('', '', 'Africa/Timbuktu', '', '+00:00', '+00:00', 'Link to Africa/Bamako'),
('LY', '+3254+01311', 'Africa/Tripoli', '', '+01:00', '+02:00', ''),
('TN', '+3648+01011', 'Africa/Tunis', '', '+01:00', '+01:00', ''),
('NA', '-2234+01706', 'Africa/Windhoek', '', '+01:00', '+02:00', ''),
('', '', 'AKST9AKDT', '', 'âˆ’09:00', 'âˆ’08:00', 'Link to America/Anchorage'),
('US', '+515248-1763929', 'America/Adak', 'Aleutian Islands', 'âˆ’10:00', 'âˆ’09:00', ''),
('US', '+611305-1495401', 'America/Anchorage', 'Alaska Time', 'âˆ’09:00', 'âˆ’08:00', ''),
('AI', '+1812-06304', 'America/Anguilla', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('AG', '+1703-06148', 'America/Antigua', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '-0712-04812', 'America/Araguaina', 'Tocantins', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3436-05827', 'America/Argentina/Buenos_Aires', 'Buenos Aires (BA, CF)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2828-06547', 'America/Argentina/Catamarca', 'Catamarca (CT), Chubut (CH)', 'âˆ’03:00', 'âˆ’03:00', ''),
('', '', 'America/Argentina/ComodRivadavia', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Catamarca'),
('AR', '-3124-06411', 'America/Argentina/Cordoba', 'most locations (CB, CC, CN, ER, FM, MN, SE, SF)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2411-06518', 'America/Argentina/Jujuy', 'Jujuy (JY)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2926-06651', 'America/Argentina/La_Rioja', 'La Rioja (LR)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3253-06849', 'America/Argentina/Mendoza', 'Mendoza (MZ)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-5138-06913', 'America/Argentina/Rio_Gallegos', 'Santa Cruz (SC)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2447-06525', 'America/Argentina/Salta', '(SA, LP, NQ, RN)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3132-06831', 'America/Argentina/San_Juan', 'San Juan (SJ)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-3319-06621', 'America/Argentina/San_Luis', 'San Luis (SL)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-2649-06513', 'America/Argentina/Tucuman', 'Tucuman (TM)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AR', '-5448-06818', 'America/Argentina/Ushuaia', 'Tierra del Fuego (TF)', 'âˆ’03:00', 'âˆ’03:00', ''),
('AW', '+1230-06958', 'America/Aruba', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('PY', '-2516-05740', 'America/Asuncion', '', 'âˆ’04:00', 'âˆ’03:00', ''),
('CA', '+484531-0913718', 'America/Atikokan', 'Eastern Standard Time - Atikokan, Ontario and Southampton I, Nunavut', 'âˆ’05:00', 'âˆ’05:00', ''),
('', '', 'America/Atka', '', 'âˆ’10:00', 'âˆ’09:00', 'Link to America/Adak'),
('BR', '-1259-03831', 'America/Bahia', 'Bahia', 'âˆ’03:00', 'âˆ’03:00', ''),
('MX', '+2048-10515', 'America/Bahia_Banderas', 'Mexican Central Time - Bahia de Banderas', 'âˆ’06:00', 'âˆ’05:00', ''),
('BB', '+1306-05937', 'America/Barbados', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '-0127-04829', 'America/Belem', 'Amapa, E Para', 'âˆ’03:00', 'âˆ’03:00', ''),
('BZ', '+1730-08812', 'America/Belize', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('CA', '+5125-05707', 'America/Blanc-Sablon', 'Atlantic Standard Time - Quebec - Lower North Shore', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '+0249-06040', 'America/Boa_Vista', 'Roraima', 'âˆ’04:00', 'âˆ’04:00', ''),
('CO', '+0436-07405', 'America/Bogota', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('US', '+433649-1161209', 'America/Boise', 'Mountain Time - south Idaho & east Oregon', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'America/Buenos_Aires', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Buenos_Aires'),
('CA', '+690650-1050310', 'America/Cambridge_Bay', 'Mountain Time - west Nunavut', 'âˆ’07:00', 'âˆ’06:00', ''),
('BR', '-2027-05437', 'America/Campo_Grande', 'Mato Grosso do Sul', 'âˆ’04:00', 'âˆ’03:00', ''),
('MX', '+2105-08646', 'America/Cancun', 'Central Time - Quintana Roo', 'âˆ’06:00', 'âˆ’05:00', ''),
('VE', '+1030-06656', 'America/Caracas', '', 'âˆ’04:30', 'âˆ’04:30', ''),
('', '', 'America/Catamarca', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Catamarca'),
('GF', '+0456-05220', 'America/Cayenne', '', 'âˆ’03:00', 'âˆ’03:00', ''),
('KY', '+1918-08123', 'America/Cayman', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('US', '+415100-0873900', 'America/Chicago', 'Central Time', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2838-10605', 'America/Chihuahua', 'Mexican Mountain Time - Chihuahua away from US border', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'America/Coral_Harbour', '', 'âˆ’05:00', 'âˆ’05:00', 'Link to America/Atikokan'),
('', '', 'America/Cordoba', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Cordoba'),
('CR', '+0956-08405', 'America/Costa_Rica', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('CA', '+4906-11631', 'America/Creston', 'Mountain Standard Time - Creston, British Columbia', 'âˆ’07:00', 'âˆ’07:00', ''),
('BR', '-1535-05605', 'America/Cuiaba', 'Mato Grosso', 'âˆ’04:00', 'âˆ’03:00', ''),
('CW', '+1211-06900', 'America/Curacao', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('GL', '+7646-01840', 'America/Danmarkshavn', 'east coast, north of Scoresbysund', '+00:00', '+00:00', ''),
('CA', '+6404-13925', 'America/Dawson', 'Pacific Time - north Yukon', 'âˆ’08:00', 'âˆ’07:00', ''),
('CA', '+5946-12014', 'America/Dawson_Creek', 'Mountain Standard Time - Dawson Creek & Fort Saint John, British Columbia', 'âˆ’07:00', 'âˆ’07:00', ''),
('US', '+394421-1045903', 'America/Denver', 'Mountain Time', 'âˆ’07:00', 'âˆ’06:00', ''),
('US', '+421953-0830245', 'America/Detroit', 'Eastern Time - Michigan - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('DM', '+1518-06124', 'America/Dominica', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+5333-11328', 'America/Edmonton', 'Mountain Time - Alberta, east British Columbia & west Saskatchewan', 'âˆ’07:00', 'âˆ’06:00', ''),
('BR', '-0640-06952', 'America/Eirunepe', 'W Amazonas', 'âˆ’04:00', 'âˆ’04:00', ''),
('SV', '+1342-08912', 'America/El_Salvador', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('', '', 'America/Ensenada', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Tijuana'),
('BR', '-0343-03830', 'America/Fortaleza', 'NE Brazil (MA, PI, CE, RN, PB)', 'âˆ’03:00', 'âˆ’03:00', ''),
('', '', 'America/Fort_Wayne', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Indiana/Indianapolis'),
('CA', '+4612-05957', 'America/Glace_Bay', 'Atlantic Time - Nova Scotia - places that did not observe DST 1966-1971', 'âˆ’04:00', 'âˆ’03:00', ''),
('GL', '+6411-05144', 'America/Godthab', 'most locations', 'âˆ’03:00', 'âˆ’02:00', ''),
('CA', '+5320-06025', 'America/Goose_Bay', 'Atlantic Time - Labrador - most locations', 'âˆ’04:00', 'âˆ’03:00', ''),
('TC', '+2128-07108', 'America/Grand_Turk', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('GD', '+1203-06145', 'America/Grenada', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('GP', '+1614-06132', 'America/Guadeloupe', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('GT', '+1438-09031', 'America/Guatemala', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('EC', '-0210-07950', 'America/Guayaquil', 'mainland', 'âˆ’05:00', 'âˆ’05:00', ''),
('GY', '+0648-05810', 'America/Guyana', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+4439-06336', 'America/Halifax', 'Atlantic Time - Nova Scotia (most places), PEI', 'âˆ’04:00', 'âˆ’03:00', ''),
('CU', '+2308-08222', 'America/Havana', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('MX', '+2904-11058', 'America/Hermosillo', 'Mountain Standard Time - Sonora', 'âˆ’07:00', 'âˆ’07:00', ''),
('US', '+394606-0860929', 'America/Indiana/Indianapolis', 'Eastern Time - Indiana - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+411745-0863730', 'America/Indiana/Knox', 'Central Time - Indiana - Starke County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+382232-0862041', 'America/Indiana/Marengo', 'Eastern Time - Indiana - Crawford County', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+382931-0871643', 'America/Indiana/Petersburg', 'Eastern Time - Indiana - Pike County', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+375711-0864541', 'America/Indiana/Tell_City', 'Central Time - Indiana - Perry County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+384452-0850402', 'America/Indiana/Vevay', 'Eastern Time - Indiana - Switzerland County', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+384038-0873143', 'America/Indiana/Vincennes', 'Eastern Time - Indiana - Daviess, Dubois, Knox & Martin Counties', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+410305-0863611', 'America/Indiana/Winamac', 'Eastern Time - Indiana - Pulaski County', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'America/Indianapolis', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Indiana/Indianapolis'),
('CA', '+682059-1334300', 'America/Inuvik', 'Mountain Time - west Northwest Territories', 'âˆ’07:00', 'âˆ’06:00', ''),
('CA', '+6344-06828', 'America/Iqaluit', 'Eastern Time - east Nunavut - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('JM', '+1800-07648', 'America/Jamaica', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('', '', 'America/Jujuy', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Jujuy'),
('US', '+581807-1342511', 'America/Juneau', 'Alaska Time - Alaska panhandle', 'âˆ’09:00', 'âˆ’08:00', ''),
('US', '+381515-0854534', 'America/Kentucky/Louisville', 'Eastern Time - Kentucky - Louisville area', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+364947-0845057', 'America/Kentucky/Monticello', 'Eastern Time - Kentucky - Wayne County', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'America/Knox_IN', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Indiana/Knox'),
('BQ', '+120903-0681636', 'America/Kralendijk', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Curacao'),
('BO', '-1630-06809', 'America/La_Paz', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('PE', '-1203-07703', 'America/Lima', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('US', '+340308-1181434', 'America/Los_Angeles', 'Pacific Time', 'âˆ’08:00', 'âˆ’07:00', ''),
('', '', 'America/Louisville', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Kentucky/Louisville'),
('SX', '+180305-0630250', 'America/Lower_Princes', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Curacao'),
('BR', '-0940-03543', 'America/Maceio', 'Alagoas, Sergipe', 'âˆ’03:00', 'âˆ’03:00', ''),
('NI', '+1209-08617', 'America/Managua', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('BR', '-0308-06001', 'America/Manaus', 'E Amazonas', 'âˆ’04:00', 'âˆ’04:00', ''),
('MF', '+1804-06305', 'America/Marigot', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Guadeloupe'),
('MQ', '+1436-06105', 'America/Martinique', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('MX', '+2550-09730', 'America/Matamoros', 'US Central Time - Coahuila, Durango, Nuevo LeÃ³n, Tamaulipas near US border', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2313-10625', 'America/Mazatlan', 'Mountain Time - S Baja, Nayarit, Sinaloa', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'America/Mendoza', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Mendoza'),
('US', '+450628-0873651', 'America/Menominee', 'Central Time - Michigan - Dickinson, Gogebic, Iron & Menominee Counties', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2058-08937', 'America/Merida', 'Central Time - Campeche, YucatÃ¡n', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+550737-1313435', 'America/Metlakatla', 'Metlakatla Time - Annette Island', 'âˆ’08:00', 'âˆ’08:00', ''),
('MX', '+1924-09909', 'America/Mexico_City', 'Central Time - most locations', 'âˆ’06:00', 'âˆ’05:00', ''),
('PM', '+4703-05620', 'America/Miquelon', '', 'âˆ’03:00', 'âˆ’02:00', ''),
('CA', '+4606-06447', 'America/Moncton', 'Atlantic Time - New Brunswick', 'âˆ’04:00', 'âˆ’03:00', ''),
('MX', '+2540-10019', 'America/Monterrey', 'Mexican Central Time - Coahuila, Durango, Nuevo LeÃ³n, Tamaulipas away from US border', 'âˆ’06:00', 'âˆ’05:00', ''),
('UY', '-3453-05611', 'America/Montevideo', '', 'âˆ’03:00', 'âˆ’02:00', ''),
('CA', '+4531-07334', 'America/Montreal', 'Eastern Time - Quebec - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('MS', '+1643-06213', 'America/Montserrat', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BS', '+2505-07721', 'America/Nassau', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+404251-0740023', 'America/New_York', 'Eastern Time', 'âˆ’05:00', 'âˆ’04:00', ''),
('CA', '+4901-08816', 'America/Nipigon', 'Eastern Time - Ontario & Quebec - places that did not observe DST 1967-1973', 'âˆ’05:00', 'âˆ’04:00', ''),
('US', '+643004-1652423', 'America/Nome', 'Alaska Time - west Alaska', 'âˆ’09:00', 'âˆ’08:00', ''),
('BR', '-0351-03225', 'America/Noronha', 'Atlantic islands', 'âˆ’02:00', 'âˆ’02:00', ''),
('US', '+471551-1014640', 'America/North_Dakota/Beulah', 'Central Time - North Dakota - Mercer County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+470659-1011757', 'America/North_Dakota/Center', 'Central Time - North Dakota - Oliver County', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+465042-1012439', 'America/North_Dakota/New_Salem', 'Central Time - North Dakota - Morton County (except Mandan area)', 'âˆ’06:00', 'âˆ’05:00', ''),
('MX', '+2934-10425', 'America/Ojinaga', 'US Mountain Time - Chihuahua near US border', 'âˆ’07:00', 'âˆ’06:00', ''),
('PA', '+0858-07932', 'America/Panama', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('CA', '+6608-06544', 'America/Pangnirtung', 'Eastern Time - Pangnirtung, Nunavut', 'âˆ’05:00', 'âˆ’04:00', ''),
('SR', '+0550-05510', 'America/Paramaribo', '', 'âˆ’03:00', 'âˆ’03:00', ''),
('US', '+332654-1120424', 'America/Phoenix', 'Mountain Standard Time - Arizona', 'âˆ’07:00', 'âˆ’07:00', ''),
('HT', '+1832-07220', 'America/Port-au-Prince', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'America/Porto_Acre', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Rio_Branco'),
('BR', '-0846-06354', 'America/Porto_Velho', 'Rondonia', 'âˆ’04:00', 'âˆ’04:00', ''),
('TT', '+1039-06131', 'America/Port_of_Spain', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('PR', '+182806-0660622', 'America/Puerto_Rico', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+4843-09434', 'America/Rainy_River', 'Central Time - Rainy River & Fort Frances, Ontario', 'âˆ’06:00', 'âˆ’05:00', ''),
('CA', '+624900-0920459', 'America/Rankin_Inlet', 'Central Time - central Nunavut', 'âˆ’06:00', 'âˆ’05:00', ''),
('BR', '-0803-03454', 'America/Recife', 'Pernambuco', 'âˆ’03:00', 'âˆ’03:00', ''),
('CA', '+5024-10439', 'America/Regina', 'Central Standard Time - Saskatchewan - most locations', 'âˆ’06:00', 'âˆ’06:00', ''),
('CA', '+744144-0944945', 'America/Resolute', 'Central Standard Time - Resolute, Nunavut', 'âˆ’06:00', 'âˆ’05:00', ''),
('BR', '-0958-06748', 'America/Rio_Branco', 'Acre', 'âˆ’04:00', 'âˆ’04:00', ''),
('', '', 'America/Rosario', '', 'âˆ’03:00', 'âˆ’03:00', 'Link to America/Argentina/Cordoba'),
('BR', '-0226-05452', 'America/Santarem', 'W Para', 'âˆ’03:00', 'âˆ’03:00', ''),
('MX', '+3018-11452', 'America/Santa_Isabel', 'Mexican Pacific Time - Baja California away from US border', 'âˆ’08:00', 'âˆ’07:00', ''),
('CL', '-3327-07040', 'America/Santiago', 'most locations', 'âˆ’04:00', 'âˆ’03:00', ''),
('DO', '+1828-06954', 'America/Santo_Domingo', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('BR', '-2332-04637', 'America/Sao_Paulo', 'S & SE Brazil (GO, DF, MG, ES, RJ, SP, PR, SC, RS)', 'âˆ’03:00', 'âˆ’02:00', ''),
('GL', '+7029-02158', 'America/Scoresbysund', 'Scoresbysund / Ittoqqortoormiit', 'âˆ’01:00', '+00:00', ''),
('US', '+364708-1084111', 'America/Shiprock', 'Mountain Time - Navajo', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Denver'),
('US', '+571035-1351807', 'America/Sitka', 'Alaska Time - southeast Alaska panhandle', 'âˆ’09:00', 'âˆ’08:00', ''),
('BL', '+1753-06251', 'America/St_Barthelemy', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Guadeloupe'),
('CA', '+4734-05243', 'America/St_Johns', 'Newfoundland Time, including SE Labrador', 'âˆ’03:30', 'âˆ’02:30', ''),
('KN', '+1718-06243', 'America/St_Kitts', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('LC', '+1401-06100', 'America/St_Lucia', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('VI', '+1821-06456', 'America/St_Thomas', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('VC', '+1309-06114', 'America/St_Vincent', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+5017-10750', 'America/Swift_Current', 'Central Standard Time - Saskatchewan - midwest', 'âˆ’06:00', 'âˆ’06:00', ''),
('HN', '+1406-08713', 'America/Tegucigalpa', '', 'âˆ’06:00', 'âˆ’06:00', ''),
('GL', '+7634-06847', 'America/Thule', 'Thule / Pituffik', 'âˆ’04:00', 'âˆ’03:00', ''),
('CA', '+4823-08915', 'America/Thunder_Bay', 'Eastern Time - Thunder Bay, Ontario', 'âˆ’05:00', 'âˆ’04:00', ''),
('MX', '+3232-11701', 'America/Tijuana', 'US Pacific Time - Baja California near US border', 'âˆ’08:00', 'âˆ’07:00', ''),
('CA', '+4339-07923', 'America/Toronto', 'Eastern Time - Ontario - most locations', 'âˆ’05:00', 'âˆ’04:00', ''),
('VG', '+1827-06437', 'America/Tortola', '', 'âˆ’04:00', 'âˆ’04:00', ''),
('CA', '+4916-12307', 'America/Vancouver', 'Pacific Time - west British Columbia', 'âˆ’08:00', 'âˆ’07:00', ''),
('', '', 'America/Virgin', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/St_Thomas'),
('CA', '+6043-13503', 'America/Whitehorse', 'Pacific Time - south Yukon', 'âˆ’08:00', 'âˆ’07:00', ''),
('CA', '+4953-09709', 'America/Winnipeg', 'Central Time - Manitoba & west Ontario', 'âˆ’06:00', 'âˆ’05:00', ''),
('US', '+593249-1394338', 'America/Yakutat', 'Alaska Time - Alaska panhandle neck', 'âˆ’09:00', 'âˆ’08:00', ''),
('CA', '+6227-11421', 'America/Yellowknife', 'Mountain Time - central Northwest Territories', 'âˆ’07:00', 'âˆ’06:00', ''),
('AQ', '-6617+11031', 'Antarctica/Casey', 'Casey Station, Bailey Peninsula', '+11:00', '+08:00', ''),
('AQ', '-6835+07758', 'Antarctica/Davis', 'Davis Station, Vestfold Hills', '+05:00', '+07:00', ''),
('AQ', '-6640+14001', 'Antarctica/DumontDUrville', 'Dumont-d\'Urville Station, Terre Adelie', '+10:00', '+10:00', ''),
('AQ', '-5430+15857', 'Antarctica/Macquarie', 'Macquarie Island Station, Macquarie Island', '+11:00', '+11:00', ''),
('AQ', '-6736+06253', 'Antarctica/Mawson', 'Mawson Station, Holme Bay', '+05:00', '+05:00', ''),
('AQ', '-7750+16636', 'Antarctica/McMurdo', 'McMurdo Station, Ross Island', '+12:00', '+13:00', ''),
('AQ', '-6448-06406', 'Antarctica/Palmer', 'Palmer Station, Anvers Island', 'âˆ’04:00', 'âˆ’03:00', ''),
('AQ', '-6734-06808', 'Antarctica/Rothera', 'Rothera Station, Adelaide Island', 'âˆ’03:00', 'âˆ’03:00', ''),
('AQ', '-9000+00000', 'Antarctica/South_Pole', 'Amundsen-Scott Station, South Pole', '+12:00', '+13:00', 'Link to Antarctica/McMurdo'),
('AQ', '-690022+0393524', 'Antarctica/Syowa', 'Syowa Station, E Ongul I', '+03:00', '+03:00', ''),
('AQ', '-7824+10654', 'Antarctica/Vostok', 'Vostok Station, Lake Vostok', '+06:00', '+06:00', ''),
('SJ', '+7800+01600', 'Arctic/Longyearbyen', '', '+01:00', '+02:00', 'Link to Europe/Oslo'),
('YE', '+1245+04512', 'Asia/Aden', '', '+03:00', '+03:00', ''),
('KZ', '+4315+07657', 'Asia/Almaty', 'most locations', '+06:00', '+06:00', ''),
('JO', '+3157+03556', 'Asia/Amman', '', '+03:00', '+03:00', ''),
('RU', '+6445+17729', 'Asia/Anadyr', 'Moscow+08 - Bering Sea', '+12:00', '+12:00', ''),
('KZ', '+4431+05016', 'Asia/Aqtau', 'Atyrau (Atirau, Gur\'yev), Mangghystau (Mankistau)', '+05:00', '+05:00', ''),
('KZ', '+5017+05710', 'Asia/Aqtobe', 'Aqtobe (Aktobe)', '+05:00', '+05:00', ''),
('TM', '+3757+05823', 'Asia/Ashgabat', '', '+05:00', '+05:00', ''),
('', '', 'Asia/Ashkhabad', '', '+05:00', '+05:00', 'Link to Asia/Ashgabat'),
('IQ', '+3321+04425', 'Asia/Baghdad', '', '+03:00', '+03:00', ''),
('BH', '+2623+05035', 'Asia/Bahrain', '', '+03:00', '+03:00', ''),
('AZ', '+4023+04951', 'Asia/Baku', '', '+04:00', '+05:00', ''),
('TH', '+1345+10031', 'Asia/Bangkok', '', '+07:00', '+07:00', ''),
('LB', '+3353+03530', 'Asia/Beirut', '', '+02:00', '+03:00', ''),
('KG', '+4254+07436', 'Asia/Bishkek', '', '+06:00', '+06:00', ''),
('BN', '+0456+11455', 'Asia/Brunei', '', '+08:00', '+08:00', ''),
('', '', 'Asia/Calcutta', '', '+05:30', '+05:30', 'Link to Asia/Kolkata'),
('MN', '+4804+11430', 'Asia/Choibalsan', 'Dornod, Sukhbaatar', '+08:00', '+08:00', ''),
('CN', '+2934+10635', 'Asia/Chongqing', 'central China - Sichuan, Yunnan, Guangxi, Shaanxi, Guizhou, etc.', '+08:00', '+08:00', 'Covering historic Kansu-Szechuan time zone.'),
('', '', 'Asia/Chungking', '', '+08:00', '+08:00', 'Link to Asia/Chongqing'),
('LK', '+0656+07951', 'Asia/Colombo', '', '+05:30', '+05:30', ''),
('', '', 'Asia/Dacca', '', '+06:00', '+06:00', 'Link to Asia/Dhaka'),
('SY', '+3330+03618', 'Asia/Damascus', '', '+02:00', '+03:00', ''),
('BD', '+2343+09025', 'Asia/Dhaka', '', '+06:00', '+06:00', ''),
('TL', '-0833+12535', 'Asia/Dili', '', '+09:00', '+09:00', ''),
('AE', '+2518+05518', 'Asia/Dubai', '', '+04:00', '+04:00', ''),
('TJ', '+3835+06848', 'Asia/Dushanbe', '', '+05:00', '+05:00', ''),
('PS', '+3130+03428', 'Asia/Gaza', 'Gaza Strip', '+02:00', '+03:00', ''),
('CN', '+4545+12641', 'Asia/Harbin', 'Heilongjiang (except Mohe), Jilin', '+08:00', '+08:00', 'Covering historic Changpai time zone.'),
('PS', '+313200+0350542', 'Asia/Hebron', 'West Bank', '+02:00', '+03:00', ''),
('HK', '+2217+11409', 'Asia/Hong_Kong', '', '+08:00', '+08:00', ''),
('MN', '+4801+09139', 'Asia/Hovd', 'Bayan-Olgiy, Govi-Altai, Hovd, Uvs, Zavkhan', '+07:00', '+07:00', ''),
('VN', '+1045+10640', 'Asia/Ho_Chi_Minh', '', '+07:00', '+07:00', ''),
('RU', '+5216+10420', 'Asia/Irkutsk', 'Moscow+05 - Lake Baikal', '+09:00', '+09:00', ''),
('', '', 'Asia/Istanbul', '', '+02:00', '+03:00', 'Link to Europe/Istanbul'),
('ID', '-0610+10648', 'Asia/Jakarta', 'Java & Sumatra', '+07:00', '+07:00', ''),
('ID', '-0232+14042', 'Asia/Jayapura', 'west New Guinea (Irian Jaya) & Malukus (Moluccas)', '+09:00', '+09:00', ''),
('IL', '+3146+03514', 'Asia/Jerusalem', '', '+02:00', '+03:00', ''),
('AF', '+3431+06912', 'Asia/Kabul', '', '+04:30', '+04:30', ''),
('RU', '+5301+15839', 'Asia/Kamchatka', 'Moscow+08 - Kamchatka', '+12:00', '+12:00', ''),
('PK', '+2452+06703', 'Asia/Karachi', '', '+05:00', '+05:00', ''),
('CN', '+3929+07559', 'Asia/Kashgar', 'west Tibet & Xinjiang', '+08:00', '+08:00', 'Covering historic Kunlun time zone.'),
('NP', '+2743+08519', 'Asia/Kathmandu', '', '+05:45', '+05:45', ''),
('', '', 'Asia/Katmandu', '', '+05:45', '+05:45', 'Link to Asia/Kathmandu'),
('IN', '+2232+08822', 'Asia/Kolkata', '', '+05:30', '+05:30', 'Note: Different zones in history, see Time in India.'),
('RU', '+5601+09250', 'Asia/Krasnoyarsk', 'Moscow+04 - Yenisei River', '+08:00', '+08:00', ''),
('MY', '+0310+10142', 'Asia/Kuala_Lumpur', 'peninsular Malaysia', '+08:00', '+08:00', ''),
('MY', '+0133+11020', 'Asia/Kuching', 'Sabah & Sarawak', '+08:00', '+08:00', ''),
('KW', '+2920+04759', 'Asia/Kuwait', '', '+03:00', '+03:00', ''),
('', '', 'Asia/Macao', '', '+08:00', '+08:00', 'Link to Asia/Macau'),
('MO', '+2214+11335', 'Asia/Macau', '', '+08:00', '+08:00', ''),
('RU', '+5934+15048', 'Asia/Magadan', 'Moscow+08 - Magadan', '+12:00', '+12:00', ''),
('ID', '-0507+11924', 'Asia/Makassar', 'east & south Borneo, Sulawesi (Celebes), Bali, Nusa Tenggara, west Timor', '+08:00', '+08:00', ''),
('PH', '+1435+12100', 'Asia/Manila', '', '+08:00', '+08:00', ''),
('OM', '+2336+05835', 'Asia/Muscat', '', '+04:00', '+04:00', ''),
('CY', '+3510+03322', 'Asia/Nicosia', '', '+02:00', '+03:00', ''),
('RU', '+5345+08707', 'Asia/Novokuznetsk', 'Moscow+03 - Novokuznetsk', '+07:00', '+07:00', ''),
('RU', '+5502+08255', 'Asia/Novosibirsk', 'Moscow+03 - Novosibirsk', '+07:00', '+07:00', ''),
('RU', '+5500+07324', 'Asia/Omsk', 'Moscow+03 - west Siberia', '+07:00', '+07:00', ''),
('KZ', '+5113+05121', 'Asia/Oral', 'West Kazakhstan', '+05:00', '+05:00', ''),
('KH', '+1133+10455', 'Asia/Phnom_Penh', '', '+07:00', '+07:00', ''),
('ID', '-0002+10920', 'Asia/Pontianak', 'west & central Borneo', '+07:00', '+07:00', ''),
('KP', '+3901+12545', 'Asia/Pyongyang', '', '+09:00', '+09:00', ''),
('QA', '+2517+05132', 'Asia/Qatar', '', '+03:00', '+03:00', ''),
('KZ', '+4448+06528', 'Asia/Qyzylorda', 'Qyzylorda (Kyzylorda, Kzyl-Orda)', '+06:00', '+06:00', ''),
('MM', '+1647+09610', 'Asia/Rangoon', '', '+06:30', '+06:30', ''),
('SA', '+2438+04643', 'Asia/Riyadh', '', '+03:00', '+03:00', ''),
('', '', 'Asia/Saigon', '', '+07:00', '+07:00', 'Link to Asia/Ho_Chi_Minh'),
('RU', '+4658+14242', 'Asia/Sakhalin', 'Moscow+07 - Sakhalin Island', '+11:00', '+11:00', ''),
('UZ', '+3940+06648', 'Asia/Samarkand', 'west Uzbekistan', '+05:00', '+05:00', ''),
('KR', '+3733+12658', 'Asia/Seoul', '', '+09:00', '+09:00', ''),
('CN', '+3114+12128', 'Asia/Shanghai', 'east China - Beijing, Guangdong, Shanghai, etc.', '+08:00', '+08:00', 'Covering historic Chungyuan time zone.'),
('SG', '+0117+10351', 'Asia/Singapore', '', '+08:00', '+08:00', ''),
('TW', '+2503+12130', 'Asia/Taipei', '', '+08:00', '+08:00', ''),
('UZ', '+4120+06918', 'Asia/Tashkent', 'east Uzbekistan', '+05:00', '+05:00', ''),
('GE', '+4143+04449', 'Asia/Tbilisi', '', '+04:00', '+04:00', ''),
('IR', '+3540+05126', 'Asia/Tehran', '', '+03:30', '+04:30', ''),
('', '', 'Asia/Tel_Aviv', '', '+02:00', '+03:00', 'Link to Asia/Jerusalem'),
('', '', 'Asia/Thimbu', '', '+06:00', '+06:00', 'Link to Asia/Thimphu'),
('BT', '+2728+08939', 'Asia/Thimphu', '', '+06:00', '+06:00', ''),
('JP', '+353916+1394441', 'Asia/Tokyo', '', '+09:00', '+09:00', ''),
('', '', 'Asia/Ujung_Pandang', '', '+08:00', '+08:00', 'Link to Asia/Makassar'),
('MN', '+4755+10653', 'Asia/Ulaanbaatar', 'most locations', '+08:00', '+08:00', ''),
('', '', 'Asia/Ulan_Bator', '', '+08:00', '+08:00', 'Link to Asia/Ulaanbaatar'),
('CN', '+4348+08735', 'Asia/Urumqi', 'most of Tibet & Xinjiang', '+08:00', '+08:00', 'Covering historic Sinkiang-Tibet time zone.'),
('LA', '+1758+10236', 'Asia/Vientiane', '', '+07:00', '+07:00', ''),
('RU', '+4310+13156', 'Asia/Vladivostok', 'Moscow+07 - Amur River', '+11:00', '+11:00', ''),
('RU', '+6200+12940', 'Asia/Yakutsk', 'Moscow+06 - Lena River', '+10:00', '+10:00', ''),
('RU', '+5651+06036', 'Asia/Yekaterinburg', 'Moscow+02 - Urals', '+06:00', '+06:00', ''),
('AM', '+4011+04430', 'Asia/Yerevan', '', '+04:00', '+04:00', ''),
('PT', '+3744-02540', 'Atlantic/Azores', 'Azores', 'âˆ’01:00', '+00:00', ''),
('BM', '+3217-06446', 'Atlantic/Bermuda', '', 'âˆ’04:00', 'âˆ’03:00', ''),
('ES', '+2806-01524', 'Atlantic/Canary', 'Canary Islands', '+00:00', '+01:00', ''),
('CV', '+1455-02331', 'Atlantic/Cape_Verde', '', 'âˆ’01:00', 'âˆ’01:00', ''),
('', '', 'Atlantic/Faeroe', '', '+00:00', '+01:00', 'Link to Atlantic/Faroe'),
('FO', '+6201-00646', 'Atlantic/Faroe', '', '+00:00', '+01:00', ''),
('', '', 'Atlantic/Jan_Mayen', '', '+01:00', '+02:00', 'Link to Europe/Oslo'),
('PT', '+3238-01654', 'Atlantic/Madeira', 'Madeira Islands', '+00:00', '+01:00', ''),
('IS', '+6409-02151', 'Atlantic/Reykjavik', '', '+00:00', '+00:00', ''),
('GS', '-5416-03632', 'Atlantic/South_Georgia', '', 'âˆ’02:00', 'âˆ’02:00', ''),
('FK', '-5142-05751', 'Atlantic/Stanley', '', 'âˆ’03:00', 'âˆ’03:00', ''),
('SH', '-1555-00542', 'Atlantic/St_Helena', '', '+00:00', '+00:00', ''),
('', '', 'Australia/ACT', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3455+13835', 'Australia/Adelaide', 'South Australia', '+09:30', '+10:30', ''),
('AU', '-2728+15302', 'Australia/Brisbane', 'Queensland - most locations', '+10:00', '+10:00', ''),
('AU', '-3157+14127', 'Australia/Broken_Hill', 'New South Wales - Yancowinna', '+09:30', '+10:30', ''),
('', '', 'Australia/Canberra', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3956+14352', 'Australia/Currie', 'Tasmania - King Island', '+10:00', '+11:00', ''),
('AU', '-1228+13050', 'Australia/Darwin', 'Northern Territory', '+09:30', '+09:30', ''),
('AU', '-3143+12852', 'Australia/Eucla', 'Western Australia - Eucla area', '+08:45', '+08:45', ''),
('AU', '-4253+14719', 'Australia/Hobart', 'Tasmania - most locations', '+10:00', '+11:00', ''),
('', '', 'Australia/LHI', '', '+10:30', '+11:00', 'Link to Australia/Lord_Howe'),
('AU', '-2016+14900', 'Australia/Lindeman', 'Queensland - Holiday Islands', '+10:00', '+10:00', ''),
('AU', '-3133+15905', 'Australia/Lord_Howe', 'Lord Howe Island', '+10:30', '+11:00', ''),
('AU', '-3749+14458', 'Australia/Melbourne', 'Victoria', '+10:00', '+11:00', ''),
('', '', 'Australia/North', '', '+09:30', '+09:30', 'Link to Australia/Darwin'),
('', '', 'Australia/NSW', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3157+11551', 'Australia/Perth', 'Western Australia - most locations', '+08:00', '+08:00', ''),
('', '', 'Australia/Queensland', '', '+10:00', '+10:00', 'Link to Australia/Brisbane'),
('', '', 'Australia/South', '', '+09:30', '+10:30', 'Link to Australia/Adelaide'),
('AU', '-3352+15113', 'Australia/Sydney', 'New South Wales - most locations', '+10:00', '+11:00', ''),
('', '', 'Australia/Tasmania', '', '+10:00', '+11:00', 'Link to Australia/Hobart'),
('', '', 'Australia/Victoria', '', '+10:00', '+11:00', 'Link to Australia/Melbourne'),
('', '', 'Australia/West', '', '+08:00', '+08:00', 'Link to Australia/Perth'),
('', '', 'Australia/Yancowinna', '', '+09:30', '+10:30', 'Link to Australia/Broken_Hill'),
('', '', 'Brazil/Acre', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Rio_Branco'),
('', '', 'Brazil/DeNoronha', '', 'âˆ’02:00', 'âˆ’02:00', 'Link to America/Noronha'),
('', '', 'Brazil/East', '', 'âˆ’03:00', 'âˆ’02:00', 'Link to America/Sao_Paulo'),
('', '', 'Brazil/West', '', 'âˆ’04:00', 'âˆ’04:00', 'Link to America/Manaus'),
('', '', 'Canada/Atlantic', '', 'âˆ’04:00', 'âˆ’03:00', 'Link to America/Halifax'),
('', '', 'Canada/Central', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Winnipeg'),
('', '', 'Canada/East-Saskatchewan', '', 'âˆ’06:00', 'âˆ’06:00', 'Link to America/Regina'),
('', '', 'Canada/Eastern', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Toronto'),
('', '', 'Canada/Mountain', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Edmonton'),
('', '', 'Canada/Newfoundland', '', 'âˆ’03:30', 'âˆ’02:30', 'Link to America/St_Johns'),
('', '', 'Canada/Pacific', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Vancouver'),
('', '', 'Canada/Saskatchewan', '', 'âˆ’06:00', 'âˆ’06:00', 'Link to America/Regina'),
('', '', 'Canada/Yukon', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Whitehorse'),
('', '', 'CET', '', '+01:00', '+02:00', ''),
('', '', 'Chile/Continental', '', 'âˆ’04:00', 'âˆ’03:00', 'Link to America/Santiago'),
('', '', 'Chile/EasterIsland', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to Pacific/Easter'),
('', '', 'CST6CDT', '', 'âˆ’06:00', 'âˆ’05:00', ''),
('', '', 'Cuba', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Havana'),
('', '', 'EET', '', '+02:00', '+03:00', ''),
('', '', 'Egypt', '', '+02:00', '+02:00', 'Link to Africa/Cairo'),
('', '', 'Eire', '', '+00:00', '+01:00', 'Link to Europe/Dublin'),
('', '', 'EST', '', 'âˆ’05:00', 'âˆ’05:00', ''),
('', '', 'EST5EDT', '', 'âˆ’05:00', 'âˆ’04:00', ''),
('', '', 'Etc./GMT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./GMT+0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./UCT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./Universal', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./UTC', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./Zulu', '', '+00:00', '+00:00', 'Link to UTC'),
('NL', '+5222+00454', 'Europe/Amsterdam', '', '+01:00', '+02:00', ''),
('AD', '+4230+00131', 'Europe/Andorra', '', '+01:00', '+02:00', ''),
('GR', '+3758+02343', 'Europe/Athens', '', '+02:00', '+03:00', ''),
('', '', 'Europe/Belfast', '', '+00:00', '+01:00', 'Link to Europe/London'),
('RS', '+4450+02030', 'Europe/Belgrade', '', '+01:00', '+02:00', ''),
('DE', '+5230+01322', 'Europe/Berlin', '', '+01:00', '+02:00', 'In 1945, the Trizone did not follow Berlin\'s switch to DST, see Time in Germany'),
('SK', '+4809+01707', 'Europe/Bratislava', '', '+01:00', '+02:00', 'Link to Europe/Prague'),
('BE', '+5050+00420', 'Europe/Brussels', '', '+01:00', '+02:00', ''),
('RO', '+4426+02606', 'Europe/Bucharest', '', '+02:00', '+03:00', ''),
('HU', '+4730+01905', 'Europe/Budapest', '', '+01:00', '+02:00', ''),
('MD', '+4700+02850', 'Europe/Chisinau', '', '+02:00', '+03:00', ''),
('DK', '+5540+01235', 'Europe/Copenhagen', '', '+01:00', '+02:00', ''),
('IE', '+5320-00615', 'Europe/Dublin', '', '+00:00', '+01:00', ''),
('GI', '+3608-00521', 'Europe/Gibraltar', '', '+01:00', '+02:00', ''),
('GG', '+4927-00232', 'Europe/Guernsey', '', '+00:00', '+01:00', 'Link to Europe/London'),
('FI', '+6010+02458', 'Europe/Helsinki', '', '+02:00', '+03:00', ''),
('IM', '+5409-00428', 'Europe/Isle_of_Man', '', '+00:00', '+01:00', 'Link to Europe/London'),
('TR', '+4101+02858', 'Europe/Istanbul', '', '+02:00', '+03:00', ''),
('JE', '+4912-00207', 'Europe/Jersey', '', '+00:00', '+01:00', 'Link to Europe/London'),
('RU', '+5443+02030', 'Europe/Kaliningrad', 'Moscow-01 - Kaliningrad', '+03:00', '+03:00', ''),
('UA', '+5026+03031', 'Europe/Kiev', 'most locations', '+02:00', '+03:00', ''),
('PT', '+3843-00908', 'Europe/Lisbon', 'mainland', '+00:00', '+01:00', ''),
('SI', '+4603+01431', 'Europe/Ljubljana', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('GB', '+513030-0000731', 'Europe/London', '', '+00:00', '+01:00', ''),
('LU', '+4936+00609', 'Europe/Luxembourg', '', '+01:00', '+02:00', ''),
('ES', '+4024-00341', 'Europe/Madrid', 'mainland', '+01:00', '+02:00', ''),
('MT', '+3554+01431', 'Europe/Malta', '', '+01:00', '+02:00', ''),
('AX', '+6006+01957', 'Europe/Mariehamn', '', '+02:00', '+03:00', 'Link to Europe/Helsinki'),
('BY', '+5354+02734', 'Europe/Minsk', '', '+03:00', '+03:00', ''),
('MC', '+4342+00723', 'Europe/Monaco', '', '+01:00', '+02:00', ''),
('RU', '+5545+03735', 'Europe/Moscow', 'Moscow+00 - west Russia', '+04:00', '+04:00', ''),
('', '', 'Europe/Nicosia', '', '+02:00', '+03:00', 'Link to Asia/Nicosia'),
('NO', '+5955+01045', 'Europe/Oslo', '', '+01:00', '+02:00', ''),
('FR', '+4852+00220', 'Europe/Paris', '', '+01:00', '+02:00', ''),
('ME', '+4226+01916', 'Europe/Podgorica', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('CZ', '+5005+01426', 'Europe/Prague', '', '+01:00', '+02:00', ''),
('LV', '+5657+02406', 'Europe/Riga', '', '+02:00', '+03:00', ''),
('IT', '+4154+01229', 'Europe/Rome', '', '+01:00', '+02:00', ''),
('RU', '+5312+05009', 'Europe/Samara', 'Moscow+00 - Samara, Udmurtia', '+04:00', '+04:00', ''),
('SM', '+4355+01228', 'Europe/San_Marino', '', '+01:00', '+02:00', 'Link to Europe/Rome'),
('BA', '+4352+01825', 'Europe/Sarajevo', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('UA', '+4457+03406', 'Europe/Simferopol', 'central Crimea', '+02:00', '+03:00', ''),
('MK', '+4159+02126', 'Europe/Skopje', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('BG', '+4241+02319', 'Europe/Sofia', '', '+02:00', '+03:00', ''),
('SE', '+5920+01803', 'Europe/Stockholm', '', '+01:00', '+02:00', ''),
('EE', '+5925+02445', 'Europe/Tallinn', '', '+02:00', '+03:00', ''),
('AL', '+4120+01950', 'Europe/Tirane', '', '+01:00', '+02:00', ''),
('', '', 'Europe/Tiraspol', '', '+02:00', '+03:00', 'Link to Europe/Chisinau'),
('UA', '+4837+02218', 'Europe/Uzhgorod', 'Ruthenia', '+02:00', '+03:00', ''),
('LI', '+4709+00931', 'Europe/Vaduz', '', '+01:00', '+02:00', ''),
('VA', '+415408+0122711', 'Europe/Vatican', '', '+01:00', '+02:00', 'Link to Europe/Rome'),
('AT', '+4813+01620', 'Europe/Vienna', '', '+01:00', '+02:00', ''),
('LT', '+5441+02519', 'Europe/Vilnius', '', '+02:00', '+03:00', ''),
('RU', '+4844+04425', 'Europe/Volgograd', 'Moscow+00 - Caspian Sea', '+04:00', '+04:00', ''),
('PL', '+5215+02100', 'Europe/Warsaw', '', '+01:00', '+02:00', ''),
('HR', '+4548+01558', 'Europe/Zagreb', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('UA', '+4750+03510', 'Europe/Zaporozhye', 'Zaporozh\'ye, E Lugansk / Zaporizhia, E Luhansk', '+02:00', '+03:00', ''),
('CH', '+4723+00832', 'Europe/Zurich', '', '+01:00', '+02:00', ''),
('', '', 'GB', '', '+00:00', '+01:00', 'Link to Europe/London'),
('', '', 'GB-Eire', '', '+00:00', '+01:00', 'Link to Europe/London'),
('', '', 'GMT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT+0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT-0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Greenwich', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Hong Kong', '', '+08:00', '+08:00', 'Link to Asia/Hong_Kong'),
('', '', 'HST', '', 'âˆ’10:00', 'âˆ’10:00', ''),
('', '', 'Iceland', '', '+00:00', '+00:00', 'Link to Atlantic/Reykjavik'),
('MG', '-1855+04731', 'Indian/Antananarivo', '', '+03:00', '+03:00', ''),
('IO', '-0720+07225', 'Indian/Chagos', '', '+06:00', '+06:00', ''),
('CX', '-1025+10543', 'Indian/Christmas', '', '+07:00', '+07:00', ''),
('CC', '-1210+09655', 'Indian/Cocos', '', '+06:30', '+06:30', ''),
('KM', '-1141+04316', 'Indian/Comoro', '', '+03:00', '+03:00', ''),
('TF', '-492110+0701303', 'Indian/Kerguelen', '', '+05:00', '+05:00', ''),
('SC', '-0440+05528', 'Indian/Mahe', '', '+04:00', '+04:00', ''),
('MV', '+0410+07330', 'Indian/Maldives', '', '+05:00', '+05:00', ''),
('MU', '-2010+05730', 'Indian/Mauritius', '', '+04:00', '+04:00', ''),
('YT', '-1247+04514', 'Indian/Mayotte', '', '+03:00', '+03:00', ''),
('RE', '-2052+05528', 'Indian/Reunion', '', '+04:00', '+04:00', ''),
('', '', 'Iran', '', '+03:30', '+04:30', 'Link to Asia/Tehran'),
('', '', 'Israel', '', '+02:00', '+03:00', 'Link to Asia/Jerusalem'),
('', '', 'Jamaica', '', 'âˆ’05:00', 'âˆ’05:00', 'Link to America/Jamaica'),
('', '', 'Japan', '', '+09:00', '+09:00', 'Link to Asia/Tokyo'),
('', '', 'JST-9', '', '+09:00', '+09:00', 'Link to Asia/Tokyo'),
('', '', 'Kwajalein', '', '+12:00', '+12:00', 'Link to Pacific/Kwajalein'),
('', '', 'Libya', '', '+02:00', '+02:00', 'Link to Africa/Tripoli'),
('', '', 'MET', '', '+01:00', '+02:00', ''),
('', '', 'Mexico/BajaNorte', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Tijuana'),
('', '', 'Mexico/BajaSur', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Mazatlan'),
('', '', 'Mexico/General', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Mexico_City'),
('', '', 'MST', '', 'âˆ’07:00', 'âˆ’07:00', ''),
('', '', 'MST7MDT', '', 'âˆ’07:00', 'âˆ’06:00', ''),
('', '', 'Navajo', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Denver'),
('', '', 'NZ', '', '+12:00', '+13:00', 'Link to Pacific/Auckland'),
('', '', 'NZ-CHAT', '', '+12:45', '+13:45', 'Link to Pacific/Chatham'),
('WS', '-1350-17144', 'Pacific/Apia', '', '+13:00', '+14:00', ''),
('NZ', '-3652+17446', 'Pacific/Auckland', 'most locations', '+12:00', '+13:00', ''),
('NZ', '-4357-17633', 'Pacific/Chatham', 'Chatham Islands', '+12:45', '+13:45', ''),
('FM', '+0725+15147', 'Pacific/Chuuk', 'Chuuk (Truk) and Yap', '+10:00', '+10:00', ''),
('CL', '-2709-10926', 'Pacific/Easter', 'Easter Island & Sala y Gomez', 'âˆ’06:00', 'âˆ’05:00', ''),
('VU', '-1740+16825', 'Pacific/Efate', '', '+11:00', '+11:00', ''),
('KI', '-0308-17105', 'Pacific/Enderbury', 'Phoenix Islands', '+13:00', '+13:00', ''),
('TK', '-0922-17114', 'Pacific/Fakaofo', '', '+13:00', '+13:00', ''),
('FJ', '-1808+17825', 'Pacific/Fiji', '', '+12:00', '+13:00', ''),
('TV', '-0831+17913', 'Pacific/Funafuti', '', '+12:00', '+12:00', ''),
('EC', '-0054-08936', 'Pacific/Galapagos', 'Galapagos Islands', 'âˆ’06:00', 'âˆ’06:00', ''),
('PF', '-2308-13457', 'Pacific/Gambier', 'Gambier Islands', 'âˆ’09:00', 'âˆ’09:00', ''),
('SB', '-0932+16012', 'Pacific/Guadalcanal', '', '+11:00', '+11:00', ''),
('GU', '+1328+14445', 'Pacific/Guam', '', '+10:00', '+10:00', ''),
('US', '+211825-1575130', 'Pacific/Honolulu', 'Hawaii', 'âˆ’10:00', 'âˆ’10:00', ''),
('UM', '+1645-16931', 'Pacific/Johnston', 'Johnston Atoll', 'âˆ’10:00', 'âˆ’10:00', ''),
('KI', '+0152-15720', 'Pacific/Kiritimati', 'Line Islands', '+14:00', '+14:00', ''),
('FM', '+0519+16259', 'Pacific/Kosrae', 'Kosrae', '+11:00', '+11:00', ''),
('MH', '+0905+16720', 'Pacific/Kwajalein', 'Kwajalein', '+12:00', '+12:00', ''),
('MH', '+0709+17112', 'Pacific/Majuro', 'most locations', '+12:00', '+12:00', ''),
('PF', '-0900-13930', 'Pacific/Marquesas', 'Marquesas Islands', 'âˆ’09:30', 'âˆ’09:30', ''),
('UM', '+2813-17722', 'Pacific/Midway', 'Midway Islands', 'âˆ’11:00', 'âˆ’11:00', ''),
('NR', '-0031+16655', 'Pacific/Nauru', '', '+12:00', '+12:00', ''),
('NU', '-1901-16955', 'Pacific/Niue', '', 'âˆ’11:00', 'âˆ’11:00', ''),
('NF', '-2903+16758', 'Pacific/Norfolk', '', '+11:30', '+11:30', ''),
('NC', '-2216+16627', 'Pacific/Noumea', '', '+11:00', '+11:00', ''),
('AS', '-1416-17042', 'Pacific/Pago_Pago', '', 'âˆ’11:00', 'âˆ’11:00', ''),
('PW', '+0720+13429', 'Pacific/Palau', '', '+09:00', '+09:00', ''),
('PN', '-2504-13005', 'Pacific/Pitcairn', '', 'âˆ’08:00', 'âˆ’08:00', ''),
('FM', '+0658+15813', 'Pacific/Pohnpei', 'Pohnpei (Ponape)', '+11:00', '+11:00', ''),
('', '', 'Pacific/Ponape', '', '+11:00', '+11:00', 'Link to Pacific/Pohnpei'),
('PG', '-0930+14710', 'Pacific/Port_Moresby', '', '+10:00', '+10:00', ''),
('CK', '-2114-15946', 'Pacific/Rarotonga', '', 'âˆ’10:00', 'âˆ’10:00', ''),
('MP', '+1512+14545', 'Pacific/Saipan', '', '+10:00', '+10:00', ''),
('', '', 'Pacific/Samoa', '', 'âˆ’11:00', 'âˆ’11:00', 'Link to Pacific/Pago_Pago'),
('PF', '-1732-14934', 'Pacific/Tahiti', 'Society Islands', 'âˆ’10:00', 'âˆ’10:00', ''),
('KI', '+0125+17300', 'Pacific/Tarawa', 'Gilbert Islands', '+12:00', '+12:00', ''),
('TO', '-2110-17510', 'Pacific/Tongatapu', '', '+13:00', '+13:00', ''),
('', '', 'Pacific/Truk', '', '+10:00', '+10:00', 'Link to Pacific/Chuuk'),
('UM', '+1917+16637', 'Pacific/Wake', 'Wake Island', '+12:00', '+12:00', ''),
('WF', '-1318-17610', 'Pacific/Wallis', '', '+12:00', '+12:00', ''),
('', '', 'Pacific/Yap', '', '+10:00', '+10:00', 'Link to Pacific/Chuuk'),
('', '', 'Poland', '', '+01:00', '+02:00', 'Link to Europe/Warsaw'),
('', '', 'Portugal', '', '+00:00', '+01:00', 'Link to Europe/Lisbon'),
('', '', 'PRC', '', '+08:00', '+08:00', 'Link to Asia/Shanghai'),
('', '', 'PST8PDT', '', 'âˆ’08:00', 'âˆ’07:00', ''),
('', '', 'ROC', '', '+08:00', '+08:00', 'Link to Asia/Taipei'),
('', '', 'ROK', '', '+09:00', '+09:00', 'Link to Asia/Seoul'),
('', '', 'Singapore', '', '+08:00', '+08:00', 'Link to Asia/Singapore'),
('', '', 'Turkey', '', '+02:00', '+03:00', 'Link to Europe/Istanbul'),
('', '', 'UCT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Universal', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'US/Alaska', '', 'âˆ’09:00', 'âˆ’08:00', 'Link to America/Anchorage'),
('', '', 'US/Aleutian', '', 'âˆ’10:00', 'âˆ’09:00', 'Link to America/Adak'),
('', '', 'US/Arizona', '', 'âˆ’07:00', 'âˆ’07:00', 'Link to America/Phoenix'),
('', '', 'US/Central', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Chicago'),
('', '', 'US/East-Indiana', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Indiana/Indianapolis'),
('', '', 'US/Eastern', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/New_York'),
('', '', 'US/Hawaii', '', 'âˆ’10:00', 'âˆ’10:00', 'Link to Pacific/Honolulu'),
('', '', 'US/Indiana-Starke', '', 'âˆ’06:00', 'âˆ’05:00', 'Link to America/Indiana/Knox'),
('', '', 'US/Michigan', '', 'âˆ’05:00', 'âˆ’04:00', 'Link to America/Detroit'),
('', '', 'US/Mountain', '', 'âˆ’07:00', 'âˆ’06:00', 'Link to America/Denver'),
('', '', 'US/Pacific', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Los_Angeles'),
('', '', 'US/Pacific-New', '', 'âˆ’08:00', 'âˆ’07:00', 'Link to America/Los_Angeles'),
('', '', 'US/Samoa', '', 'âˆ’11:00', 'âˆ’11:00', 'Link to Pacific/Pago_Pago'),
('', '', 'UTC', '', '+00:00', '+00:00', ''),
('', '', 'W-SU', '', '+04:00', '+04:00', 'Link to Europe/Moscow'),
('', '', 'WET', '', '+00:00', '+01:00', ''),
('', '', 'Zulu', '', '+00:00', '+00:00', 'Link to UTC');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('deposit','withdraw') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(64,0) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(64,0) NOT NULL DEFAULT 0,
  `fee` decimal(64,0) NOT NULL DEFAULT 0,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `faviroute` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `micr_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email_id`, `email_verified_at`, `device_token`, `password`, `phone`, `phone_code`, `is_verified`, `status`, `otp`, `faviroute`, `remember_token`, `vendor_id`, `language`, `ifsc_code`, `account_name`, `account_number`, `micr_code`, `provider_type`, `provider_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '60b5c79fe1226.png', 'admin-mealUp@gmail.com', NULL, NULL, '$2y$10$QY7BCiafK3hoHiFWL/2RM.JCwlBpVpDzZLmkIRLNj5cosDMyZtawC', NULL, NULL, 0, 1, 2745, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-03 05:51:37', '2021-07-05 06:31:45'),
(146, 'test', 'noimage.png', 'testtestr@gmasil.com', NULL, NULL, '$2y$10$mXqokarI8iN9kEFIx4KvjeOKw1o1W04FSBcf.AVrw2x3b9C3.XZQa', NULL, '+93', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-05 06:13:59', '2021-07-05 06:13:59'),
(147, 'test', 'noimage.png', 'tetsetsetse@gmail.com', NULL, NULL, '$2y$10$zrpbyv/A5Dm/tnfDG4aIuuMkldjcu.uEyN6Ed6USc.C9Ye4/bWFB2', '1234567890', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-05 06:17:12', '2021-07-05 06:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuisine_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_order_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `for_two_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_comission_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_comission_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_slot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_type_timeSlot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isExplorer` tinyint(1) NOT NULL,
  `isTop` tinyint(1) NOT NULL,
  `vendor_own_driver` int(11) DEFAULT NULL,
  `payment_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `vendor_language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connector_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connector_descriptor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connector_port` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bank_details`
--

CREATE TABLE `vendor_bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clabe` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_discount`
--

CREATE TABLE `vendor_discount` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `min_item_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holder_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `balance` decimal(64,0) NOT NULL DEFAULT 0,
  `decimal_places` smallint(6) NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_payment`
--

CREATE TABLE `wallet_payment` (
  `id` int(11) NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` text NOT NULL,
  `payment_token` text DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE `working_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `day_index` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period_list` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_person`
--
ALTER TABLE `delivery_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_delivery_person_vendor_id` (`vendor_id`),
  ADD KEY `fk_delivery_person_delivery_zone_id` (`delivery_zone_id`);

--
-- Indexes for table `delivery_zone`
--
ALTER TABLE `delivery_zone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_zone_area`
--
ALTER TABLE `delivery_zone_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_delivery_zone_id` (`delivery_zone_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_feedback_user_id` (`user_id`);

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_vendor_id` (`vendor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_template`
--
ALTER TABLE `notification_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_vendor_id` (`vendor_id`),
  ADD KEY `fk_promo_code_id` (`promocode_id`),
  ADD KEY `fk_order_user_id` (`user_id`),
  ADD KEY `fk_delivery_person_id` (`delivery_person_id`),
  ADD KEY `fk_vendor_discount_id` (`vendor_discount_id`),
  ADD KEY `fk_address_id` (`address_id`);

--
-- Indexes for table `order_child`
--
ALTER TABLE `order_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderChild_id` (`order_id`);

--
-- Indexes for table `order_setting`
--
ALTER TABLE `order_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_setting`
--
ALTER TABLE `payment_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refaund`
--
ALTER TABLE `refaund`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_refaund_user_id` (`user_id`),
  ADD KEY `fk_refaund_order_id` (`order_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_review_vendor_id` (`vendor_id`),
  ADD KEY `fk_review_order_id` (`order_id`),
  ADD KEY `fk_review_user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settlements`
--
ALTER TABLE `settlements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_settlement_vendor_id` (`vendor_id`),
  ADD KEY `fk_settlement_order_id` (`order_id`),
  ADD KEY `fk_settlement_delivery_boy_id` (`driver_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_submenu_menu_id` (`vendor_id`);

--
-- Indexes for table `submenu_cutsomization_type`
--
ALTER TABLE `submenu_cutsomization_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_custimization_type_vendor_id` (`vendor_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`TimeZone`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  ADD KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  ADD KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  ADD KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  ADD KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  ADD KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  ADD KEY `transfers_deposit_id_foreign` (`deposit_id`),
  ADD KEY `transfers_withdraw_id_foreign` (`withdraw_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_address_id` (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendor_email_unique` (`email_id`),
  ADD KEY `fk_vendor_user_id` (`user_id`);

--
-- Indexes for table `vendor_bank_details`
--
ALTER TABLE `vendor_bank_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bank_details_vendor_id` (`vendor_id`);

--
-- Indexes for table `vendor_discount`
--
ALTER TABLE `vendor_discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vendor_discount_vendor_id` (`vendor_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  ADD KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  ADD KEY `wallets_slug_index` (`slug`);

--
-- Indexes for table `wallet_payment`
--
ALTER TABLE `wallet_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_working_vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `delivery_person`
--
ALTER TABLE `delivery_person`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `delivery_zone`
--
ALTER TABLE `delivery_zone`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `delivery_zone_area`
--
ALTER TABLE `delivery_zone_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `notification_template`
--
ALTER TABLE `notification_template`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `order_child`
--
ALTER TABLE `order_child`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `order_setting`
--
ALTER TABLE `order_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_setting`
--
ALTER TABLE `payment_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `refaund`
--
ALTER TABLE `refaund`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settlements`
--
ALTER TABLE `settlements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submenu_cutsomization_type`
--
ALTER TABLE `submenu_cutsomization_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_bank_details`
--
ALTER TABLE `vendor_bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor_discount`
--
ALTER TABLE `vendor_discount`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_payment`
--
ALTER TABLE `wallet_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_person`
--
ALTER TABLE `delivery_person`
  ADD CONSTRAINT `fk_delivery_person_delivery_zone_id` FOREIGN KEY (`delivery_zone_id`) REFERENCES `delivery_zone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delivery_person_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_zone_area`
--
ALTER TABLE `delivery_zone_area`
  ADD CONSTRAINT `fk_delivery_zone_id` FOREIGN KEY (`delivery_zone_id`) REFERENCES `delivery_zone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_address_id` FOREIGN KEY (`address_id`) REFERENCES `user_address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delivery_person_id` FOREIGN KEY (`delivery_person_id`) REFERENCES `delivery_person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_promo_code_id` FOREIGN KEY (`promocode_id`) REFERENCES `promo_code` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vendor_discount_id` FOREIGN KEY (`vendor_discount_id`) REFERENCES `vendor_discount` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_child`
--
ALTER TABLE `order_child`
  ADD CONSTRAINT `fk_orderChild_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `refaund`
--
ALTER TABLE `refaund`
  ADD CONSTRAINT `fk_refaund_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_refaund_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `settlements`
--
ALTER TABLE `settlements`
  ADD CONSTRAINT `fk_settlement_delivery_boy_id` FOREIGN KEY (`driver_id`) REFERENCES `delivery_person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_settlement_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_settlement_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `fk_submenu_menu_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_submenu_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submenu_cutsomization_type`
--
ALTER TABLE `submenu_cutsomization_type`
  ADD CONSTRAINT `fk_custimization_type_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `fk_user_address_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `fk_vendor_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_bank_details`
--
ALTER TABLE `vendor_bank_details`
  ADD CONSTRAINT `fk_bank_details_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_discount`
--
ALTER TABLE `vendor_discount`
  ADD CONSTRAINT `fk_vendor_discount_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallet_payment`
--
ALTER TABLE `wallet_payment`
  ADD CONSTRAINT `wallet_payment_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD CONSTRAINT `fk_working_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
