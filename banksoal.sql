-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 26. Januari 2016 jam 14:26
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `banksoal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id_guru` int(3) NOT NULL AUTO_INCREMENT,
  `nip` varchar(22) NOT NULL,
  `nama` varchar(85) NOT NULL,
  `jenis_kelamin` enum('l','p') NOT NULL,
  `tempat_lahir` varchar(75) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `id_sekolah` int(4) NOT NULL,
  `sebagai` enum('guru','admin') NOT NULL,
  `pendidikan_akhir` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(12) NOT NULL,
  `tgl_input` date NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `id_sekolah`, `sebagai`, `pendidikan_akhir`, `username`, `password`, `tgl_input`) VALUES
(1, '', 'Muhammad Khairullah, A.Md', 'l', 'Banjarmasin', '1993-09-12', 'Jl. Kenari 1 Perumnas Bumi Lingkar Basirih', 0, 'admin', 'D3 Teknik ', 'admin', 'admin', '0000-00-00'),
(5, '', 'Padmiyati, S.Pd', 'p', 'Banjarmasin', '1980-08-20', 'Jl. H. Soebardjo Rt. 34 Basirih Selatan', 1, 'guru', 'S1', 'tunter', 'tunter ', '2016-01-26'),
(6, '', 'Dra. Dahlianoor', 'p', 'Banjarmasin', '1977-12-13', 'Jl. Tembus Mantuil Gang Asparagus Rt. 24 Kelayan Selatan', 1, 'guru', 'S.1', '', '', '2016-01-26'),
(7, '', 'Sri Tilawah, S.Pd', 'p', 'Banjarmasin', '1980-09-15', 'Jl. HKSN Alalak Utara Rt. 17', 1, 'guru', 'S.1', '', '', '2016-01-26'),
(8, '', 'Imansyah, SE', 'l', 'Banjarmasin', '1978-03-07', 'Jl. HKSN Alalak Utara Rt. 13', 1, 'guru', 'S.1', 'rtunter', 'R03NZ91RV', '2016-01-26'),
(9, '', 'Eddy Mawahyuni, S.Hut', 'l', 'Banjarmasin', '1977-02-05', 'Jl. Sei Andai Komplek PWI Blok F', 1, 'guru', 'S.1', '', '', '2016-01-26'),
(10, '', 'Muliana', 'p', 'Banjarmasin', '1969-07-13', 'Jl. Teluk Tiram Darat Rt. 27 No. 14', 1, 'guru', 'S.1', '', '', '2016-01-26'),
(11, '', 'Drs. Saberan', 'l', 'Banjarmasin', '1970-06-04', 'Jl. Teluk Turam Darat Gg. Murni Rt. 27 No. 14', 1, 'guru', 'S.2', '', '', '2016-01-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_aktivasi`
--

CREATE TABLE IF NOT EXISTS `guru_aktivasi` (
  `id_guru_aktivasi` int(3) NOT NULL AUTO_INCREMENT,
  `id_guru` int(3) NOT NULL,
  `kode_aktivasi` varchar(9) NOT NULL,
  `konfirmasi` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_guru_aktivasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `guru_aktivasi`
--

INSERT INTO `guru_aktivasi` (`id_guru_aktivasi`, `id_guru`, `kode_aktivasi`, `konfirmasi`) VALUES
(4, 5, 'OJBLESCQ1', '1'),
(5, 6, '1L73BBUIA', '0'),
(6, 7, 'YWLWUPZL4', '0'),
(7, 8, 'R03NZ91RV', '1'),
(8, 9, '70S0GJV2U', '0'),
(9, 10, 'S8KJLT4AA', '0'),
(10, 11, 'RB8WI4QAJ', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_login`
--

CREATE TABLE IF NOT EXISTS `guru_login` (
  `id_guru_login` int(6) NOT NULL AUTO_INCREMENT,
  `id_guru` int(3) NOT NULL,
  `tgl_login` datetime NOT NULL,
  PRIMARY KEY (`id_guru_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data untuk tabel `guru_login`
--

INSERT INTO `guru_login` (`id_guru_login`, `id_guru`, `tgl_login`) VALUES
(97, 5, '2016-01-26 06:59:48'),
(98, 1, '2016-01-26 10:48:45'),
(99, 1, '2016-01-26 14:49:03'),
(100, 8, '2016-01-26 15:48:07'),
(101, 1, '2016-01-26 18:42:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `id_pelajaran` int(4) NOT NULL AUTO_INCREMENT,
  `mata_pelajaran` varchar(75) NOT NULL,
  PRIMARY KEY (`id_pelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_pelajaran`, `mata_pelajaran`) VALUES
(1, 'Pendidikan Kewarganegaraan'),
(2, 'Bahasa Indonesia'),
(3, 'Matematika'),
(4, 'Ilmu Pengetahuan Sosial'),
(5, 'Ilmu Pengetahuan Alam'),
(6, 'Bahasa Inggris'),
(7, 'Fisika'),
(8, 'Kimia'),
(9, 'Biologi'),
(10, 'Sejarah'),
(11, 'Geografi'),
(12, 'Ekonomi'),
(13, 'Sosiologi'),
(14, 'Antropologi'),
(15, 'Sastra Indonesia'),
(16, 'Bahasa Asing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(2) NOT NULL AUTO_INCREMENT,
  `login` enum('guru','admin','semua') NOT NULL,
  `menu` varchar(250) NOT NULL,
  `link` varchar(450) NOT NULL,
  `tempat` enum('atas','bawah') NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `login`, `menu`, `link`, `tempat`, `level`) VALUES
(1, 'semua', 'Beranda-Profil-Keluar', './-?p=profil-logout.php', 'atas', 1),
(2, 'admin', 'Tutor-Data Tutor-Data PKBM', '?p=guru-?p=data_guru-?p=data_sekolah', 'bawah', 1),
(3, 'semua', 'Warga Belajar-Data Warga Belajar', '?p=siswa-?p=data_siswa', 'bawah', 2),
(4, 'semua', 'Soal-Data Soal-Nilai', '?p=soal-?p=data_soal-?p=nilai', 'bawah', 3),
(6, 'semua', 'Paket Pelajaran-Data Paket Pelajaran', '?p=paket_pelajaran-?p=data_paket_pelajaran', 'bawah', 2),
(7, 'admin', 'Ujian', '?p=ujian', 'bawah', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(5) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(4) NOT NULL,
  `id_ujian` int(3) NOT NULL,
  `nilai` int(3) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
  `id_paket` int(1) NOT NULL AUTO_INCREMENT,
  `paket` varchar(15) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `paket`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C (IPA)'),
(4, 'C (IPS)'),
(5, 'C (Bahasa)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_pelajaran`
--

CREATE TABLE IF NOT EXISTS `paket_pelajaran` (
  `id_paket_pelajaran` int(4) NOT NULL AUTO_INCREMENT,
  `id_paket` int(1) NOT NULL,
  `id_pelajaran` int(4) NOT NULL,
  `id_guru` int(3) NOT NULL,
  `kkm` double NOT NULL,
  `tgl_input` date NOT NULL,
  `penginput` int(3) NOT NULL,
  `lihat` date NOT NULL,
  PRIMARY KEY (`id_paket_pelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data untuk tabel `paket_pelajaran`
--

INSERT INTO `paket_pelajaran` (`id_paket_pelajaran`, `id_paket`, `id_pelajaran`, `id_guru`, `kkm`, `tgl_input`, `penginput`, `lihat`) VALUES
(34, 4, 6, 5, 75, '2016-01-26', 1, '2016-01-25'),
(35, 4, 2, 6, 75, '2016-01-26', 1, '2016-01-25'),
(36, 4, 3, 7, 75, '2016-01-26', 1, '2016-01-25'),
(37, 4, 12, 8, 75, '2016-01-26', 1, '2016-01-25'),
(38, 4, 11, 9, 75, '2016-01-26', 1, '2016-01-25'),
(39, 4, 1, 10, 75, '2016-01-26', 1, '2016-01-25'),
(40, 4, 13, 10, 75, '2016-01-26', 1, '2016-01-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE IF NOT EXISTS `sekolah` (
  `id_sekolah` int(4) NOT NULL AUTO_INCREMENT,
  `tgl_input` date NOT NULL,
  `nama_sekolah` varchar(75) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` text NOT NULL,
  `id_guru` int(3) NOT NULL,
  PRIMARY KEY (`id_sekolah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `tgl_input`, `nama_sekolah`, `alamat`, `telpon`, `id_guru`) VALUES
(1, '2016-01-18', 'Sullamul Ulum', 'jl. tembus mantuil', '085751089515', 11),
(2, '2016-01-18', 'Bina Lusani', 'jl. terserah', '085751089515', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(75) NOT NULL,
  `jenis_kelamin` enum('l','p') NOT NULL,
  `username` varchar(6) NOT NULL,
  `password` varchar(4) NOT NULL,
  `id_paket` int(1) NOT NULL,
  `tempat_lahir` varchar(75) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_siswa` text NOT NULL,
  `id_sekolah` int(4) NOT NULL,
  `pendidikan_akhir` varchar(15) NOT NULL,
  `id_input` int(3) NOT NULL,
  `tgl_input` date NOT NULL,
  `lihat` date NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=787 ;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `jenis_kelamin`, `username`, `password`, `id_paket`, `tempat_lahir`, `tanggal_lahir`, `alamat_siswa`, `id_sekolah`, `pendidikan_akhir`, `id_input`, `tgl_input`, `lihat`) VALUES
(767, 'AHMAD DASUKI', 'l', '5ahvf1', '6788', 4, 'Banjarmasin', '1985-04-06', 'Jalan Kelayan A Gang Laila', 1, 'SLTP', 1, '2015-11-03', '2015-11-09'),
(768, 'JUMIATI', 'p', 'neji8g', '4y1n', 4, 'Banjarmasin', '1977-11-09', 'Jalan HKSN Komp. Herlina Rt. 27', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(769, 'NORHASANAH', 'p', 'oqt1cz', 'g05e', 4, 'Banjarmasin', '1999-07-07', 'Jalan HKSN Komp. Herlina Rt. 27', 1, 'MTs', 1, '2015-11-03', '2015-11-09'),
(770, 'ARDI', 'l', 'xptxt3', 's38k', 4, 'Banjarmasin', '1995-04-16', 'Jalan R.K.Ilir', 1, 'SMP', 1, '2015-11-03', '2015-11-09'),
(771, 'ANNISA', 'p', 'a266eb', 'lprl', 4, 'Banjarmasin', '1995-08-26', 'Jalan R.K.Ilir', 1, 'SMP', 1, '2015-11-03', '2015-11-09'),
(772, 'ZAIMAH', 'p', '46t2ub', 'k7ll', 4, 'Banjarmasin', '1998-11-17', 'Jalan HKSN Komp Herlina Rt. 27', 1, 'MTs', 1, '2015-11-03', '2015-11-09'),
(773, 'MAISYARAH', 'p', '08uaz8', '69uv', 4, 'Banjarmasin', '1997-10-20', 'Jalan. Kelayan B Gang Batur', 1, 'MTs', 1, '2015-11-03', '2015-11-09'),
(774, 'AHMAD BAIHAKI', 'l', 'h6jsjj', 'e06f', 4, 'Banjarmasin', '1998-04-04', 'Jalan R.K.Ilir', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(775, 'AHMAD SHALEH', 'l', 'vroxeg', 'dd07', 4, 'Banjarmasin', '1984-09-04', 'Jalan R.K.Ilir', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(776, 'PEBBRIAN ERLANGGA', 'l', 'k8m3mo', '10cb', 4, 'BANJARMASIN', '1993-02-13', 'Jalan Tembus Mantuil Basirih Ulu', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(777, 'MARIANA', 'p', 'x0sb94', 'mg88', 4, 'Banjarmasin', '1999-04-28', 'Jalan Kelayan B Gang Batur', 1, 'SMP', 1, '2015-11-03', '2015-11-09'),
(778, 'RAHMI NARITA', 'p', 'vwrk7e', '8ml7', 4, 'Banjarmasin', '1999-04-05', 'Jalan HKSN Komp Herlina Rt. 27', 1, 'SMP', 1, '2015-11-03', '2015-11-09'),
(779, 'MUHAMMAD YUSUF', 'l', 'eeqwnb', 'pvuc', 4, 'Banjarmasin', '1994-02-14', 'Jalan R.K.Ilir', 2, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(780, 'MUHAMMAD ZAINI', 'l', 'ulqd7u', 'pz1u', 4, 'Banjarmasin', '1994-09-14', 'Jalan Mantuil Permai Rt. 01', 2, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(781, 'LIA AMELIANI', 'p', '4qbyzq', 'w6yl', 3, 'Banjarmasin', '1992-04-03', 'Jalan Basirih Muara', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(782, 'JAKARIA', 'l', 'jier1w', 'ydjm', 3, 'Banjarmasin', '1987-05-19', 'Jalan HKSN Komp Herlina Rt. 27', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(783, 'ABDULLAH', 'l', 'pl2es2', '7hf1', 3, 'Banjarmasin', '1986-07-15', 'Jalan Agresi Rt. 41', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(784, 'MUHAMMAD ERVAN M', 'l', 'prpqh0', '8yud', 3, 'Banjarmasin', '1993-10-17', 'Jalan Kelayan A Gang Antasari', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(785, 'JAINUDDIN', 'l', '1um5q8', '8zh7', 3, 'Banjarmasin', '1993-07-29', 'Jalan Tembus Mantuil Rt. 05', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09'),
(786, 'AHMAD ZAINI', 'l', 'ruxofy', 'ii1v', 3, 'Banjarmasin', '1992-03-13', 'Jalan 9 Oktober Pekauman', 1, 'PAKET B', 1, '2015-11-03', '2015-11-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
  `id_soal` int(4) NOT NULL AUTO_INCREMENT,
  `id_soal_pelajaran` int(3) NOT NULL,
  `id_soal_cerita` int(11) NOT NULL,
  `tipe_soal` enum('ganda','checkbox') NOT NULL,
  `soal` varchar(250) NOT NULL,
  `tipe_jawab` varchar(7) NOT NULL,
  `pilihan` varchar(450) NOT NULL,
  `jawab` varchar(45) NOT NULL,
  `persen_benar` int(3) NOT NULL,
  `id_soal_gambar` int(3) NOT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `id_soal_pelajaran`, `id_soal_cerita`, `tipe_soal`, `soal`, `tipe_jawab`, `pilihan`, `jawab`, `persen_benar`, `id_soal_gambar`) VALUES
(20, 11, 6, 'ganda', 'What are Kiwame and Aditya planning to do?', 'text', 'a>Meet in Japan|b>Write an e-mail|c>Do a teleconference|d>Look after their students|e>Have summer vacation together', 'c', 100, 0),
(29, 11, 6, 'ganda', 'What is the email about.?', 'text', 'a>Mr. Zaenal&#039;s letter|b>Summer vacation|c>School visitation|d>New Semester|e>Partnership', 'c', 100, 0),
(33, 11, 8, 'ganda', 'The System disabled the credit card number 5132 because', 'text', 'a>Paypal company requested 4 digit code|b>the account linked to credit card inoorrectly|c>the computer tried to re-add the PayPal code|d>the costumer entered the code incorrectly|e>PayPal completed the account verification', 'd', 100, 0),
(34, 11, 8, 'ganda', 'The way to activate the PayPal account with credit car number 5132 is by', 'text', 'a>entering the code correctly|b>changing the account number|c>confirming the payment to bank|d>explain the situation to the company|e>informing the credit card number to bank', 'b', 100, 0),
(35, 11, 9, 'ganda', 'What does the advertisement offer', 'text', 'a>Children classes|b>Class of Asian Language|c>Advance level class|d>Courses of foreign language|e>Registration for Japanese language course', 'd', 100, 0),
(36, 11, 9, 'ganda', 'Accroding to the text, the Institutte of International communication', 'text', 'a>Open only for evening class|b>gives the lesson for adlut|c>offers the begining level onl|d>opens onl for advance level class|e>offers European language course only', 'b', 100, 0),
(37, 11, 9, 'ganda', '&quot;Register for Summer classes now". The "now" word means', 'text', 'a>at the beginning|b>in the past time|c>at the moment|d>at that time|e>just now', 'd', 100, 0),
(38, 11, 10, 'ganda', 'What does Kinderfield school offer', 'text', 'a>National teaching system|b>English language program|c>great childhood experiese|d>Innovation in computer technology|e>qualified computer&#039;s teacher', 'b', 100, 0),
(39, 11, 10, 'ganda', 'From the text, we understand that Kinderfield', 'text', 'a>hired only female teacher|b>is english speaking school|c>will hire teachers 35 years of age|d>seeks teacher with diploma degree|e>seeks teacher who speak any forein language', 'b', 100, 0),
(40, 11, 10, 'ganda', 'In Kinderfield, the learning experience are based on', 'text', 'a>students language ablity|b>teachers latest innovation|c>students greatest potensial|d>englisth as medium of instruction|e>childerns interest and environment', 'c', 100, 0),
(41, 11, 11, 'ganda', 'Which is the most damaging in the sea', 'text', 'a>A 1992 ban on drift nets|b>fishing gears that snap during stroms|c>150.000 crab traps that lost every year|d>fishing fleets bring broken nets to port|e>discarded fishing net added to the oceans', 'c', 100, 0),
(42, 11, 11, 'ganda', 'What has created the vertical wall in the ocean', 'text', 'a>Gill nets anchored to seabad|b>land based marine pollution|c>entangled fishing gear|d>a new net design|e>marine ecosystem', 'd', 100, 0),
(43, 11, 11, 'ganda', 'We understand from the text that ghost fishing', 'text', 'a>happened during heavy stroms|b>was caused mainly by the fishing fleet|c>affected the growing of fishing crabs|d>caused pollution in international sea|e>crated effective marine ecosystem', 'd', 100, 0),
(44, 11, 11, 'ganda', 'The text tell us about', 'text', 'a>the solution for the international problem|b>the report on the effect of the lost nets in the seas|c>the activities of the UN staf for the world&#039;s oceans|d>the descriptions of the problem of the worlds ocean|e>the attempts of the environment activits in the world', 'd', 100, 0),
(45, 11, 12, 'ganda', 'People treat cold with chicken soup because', 'text', 'a>it cures colds|b>it is nourishing|c>it makes them feel better|d>it has been proven in studies|e>it is easy to make and inexpensive', 'c', 100, 0),
(46, 11, 12, 'ganda', 'What is a benefit of eating chicken soup', 'text', 'a>it is very fatty food|b>it is very cheap|c>it easily found|d>it is nutritious|e>it cures cold', 'd', 100, 0),
(47, 11, 12, 'ganda', 'Why chicken soup is ggod for treating colds', 'text', 'a>it can make the one colds feel better and warm|b>id doesnt require special spice in it|c>it&#039;s very cheap and easy to cook|d>the ingredients are easy to fo fint|e>the scientific research proof so', 'a', 100, 0),
(48, 11, 12, 'ganda', 'What is the main idea of paragraph 2', 'text', 'a>Dr. Wilson has a lot of patients|b>chicken soup is usefull to cure cold|c>chicken soup is the only cure for colds|d>Dr. Wilson proves that chicken soup is a good treat|e>chicken soup is not only googd for people with colds', 'd', 100, 0),
(49, 11, 12, 'ganda', 'The purpose of the text is', 'text', 'a>to present scientific research about chicken soup|b>to persuade readers to consume chicken soup|c>to discuss chicken soup as a treatment for cold|d>to compare differant treatment for colds|e>to explain that chicken soup is useful', 'e', 100, 0),
(50, 11, 13, 'ganda', 'How was Affandi&#039;s participation as a painting artist before year 1977', 'text', 'a>as honorary professor in Ohio State university, United States|b>He was appointed an honorary doctorate from University of Singapore|c>He received a peace Award form the Dag Hammarskjoeld Foundation|d>He displayed his painting in Biennale, in Brazil|e>He participated in exhibitions in Sao Paulo', 'a', 100, 0),
(51, 11, 13, 'ganda', 'The main idea of paragraph 2 is', 'text', 'a>Affandi was an art professor in University of Singapore|b>Affandi found his new stle in painting by himself|c>Affandi taugh his painting knowledge in oversea|d>Affandi participated in various exibitions|e>Affandi painted with his own hand', 'e', 100, 0),
(52, 11, 13, 'ganda', 'From the text, we understand that Affandi', 'text', 'a>Influenced mainly by Vincent van Gogh|b>has used many styles in his paintings|c>was a famous dan smart painter|d>buit a beautiful museum overseas|e>found his unique painting style overseas', 'a', 100, 0),
(53, 11, 13, 'ganda', '&quot;..., which also employs as a museum.." (Paragraph 4). The word "employs" word is closest in meaning with', 'text', 'a>makes|b>uses|c>moves|d>changes|e>gives', 'b', 100, 0),
(54, 11, 14, 'ganda', 'The text mainly tells about', 'text', 'a>the giraffe|b>the zoo|c>the camel|d>the tree|e>the water', 'a', 100, 0),
(55, 11, 14, 'ganda', 'Giraffe defends its life with', 'text', 'a>running with their strong legs|b>eating leaves from the top of tree|c>protectiong its eyes with thick lashes|d>growing brown spot on the skin|e>stop drinking for long time', 'b', 100, 0),
(56, 11, 14, 'ganda', 'How does the giraffe get water', 'text', 'a>By running away|b>By eating the leaves|c>By protecting itself|d>by staying at the zoo|e>by fighting with its legs', 'b', 100, 0),
(57, 11, 15, 'ganda', '(1)', 'text', 'a>hoped|b>affected|c>declared|d>changed|e>spread', 'c', 100, 0),
(58, 11, 15, 'ganda', '(2)', 'text', 'a>Nation|b>nature|c>motion|d>motifs|e>pictures', 'd', 100, 0),
(59, 11, 15, 'ganda', '(3)', 'text', 'a>on|b>in|c>at|d>inside|e>outside', 'c', 100, 0),
(60, 11, 16, 'ganda', 'Arrange these word into a good sentence', 'text', 'a>6-5-4-1-3-7-2|b>6-4-5-7-3-1-2|c>6-4-7-5-1-3-2|d>7-5-4-3-2-1-6|e>7-3--4-6-1-2-5', 'c', 100, 0),
(61, 12, 17, 'ganda', 'Kalimat utama paragraf tersebut adalah', 'text', 'a>1|b>2|c>3|d>4|e>5', 'a', 100, 0),
(62, 12, 17, 'ganda', 'Kalimat yang tidak pada pada paragraf tersebut adalah kalimat', 'text', 'a>1|b>2|c>3|d>4|e>5', 'd', 100, 0),
(64, 12, 18, 'ganda', 'Ide pokok paragraf teks tersebut adalah', 'text', 'a>cara mengekspresikan kemarahan|b>kesulitan dalam menghindari kemarahan|c>sulit dalam melamiaskan kemarahan|d>menekan atau menyembunyikan kemarahan|e>bentuk emosi dan kemarahan', 'a', 100, 0),
(65, 12, 18, 'ganda', 'Rangkuman yang tepat teks tersebut adlaah', 'text', 'a>Keluaga berpengaruh sekali pada munculnya rasa marah pada seseorang di lingkungan tesebut|b>kemarahan dapat diekspresikan tanpa terkendali, tetapi dapat ditekan, atau disembunyikan|c>kemarahan bisa muncul pada seiap orang tanpa diketahui sebabnya|d>sebagian besar orang tidak bisa menahan rasa marah karena tidak tahu sebabnya|e>kemarahan adalah suatu bentuk emsi yang tidak bisa dikendalikan', 'a', 100, 0),
(66, 12, 18, 'ganda', 'Arti agresif pada wacana tersebut adalah', 'text', 'a>keinginan kuat|b>suka marah-marah|c>bernafsu menyerang|d>tidak dapat dikendalikan|e>kemarahan tanpa sebab', 'c', 100, 0),
(67, 12, 0, 'ganda', 'Simpulan yang tepat berdasarkan tabel tersebut adalah', 'text', 'a>harga beras delanggu pada tahun 2012 selalu naik|b>harga beras Delanggu tahun 2012 mengalami kenaikan dan penurunan|c>Pada tahun 2012 harga beras Delanggu relatif stabil|d>Setiap bulan harga beras Delanggu mengamali perubahan harga yang tinggi|e>pertengahan tahun 2012 harga beras delanggu relatif stabil', 'b', 100, 4),
(68, 12, 19, 'ganda', 'Karakteristik satra Melayu Klasik tersebut adlaah', 'text', 'a>Putri raja yang cantik|b>kemustahilan|c>raja yang bijaksana|d>mengisahkan anak-anak raja|e>mengisahkan orang-orang sakti', 'b', 100, 0),
(69, 12, 19, 'ganda', 'Hal yang mustahil dalam kutipan hikayat terseut adalah', 'text', 'a>Mara Karmah berjalan-jalan di hutan|b>Mara Karmah bertemu dengan binatang buas|c>Mara Karmah bertemu dengan anak-anak raja|d>Hutan tempat tinggal jin dan peri mambang|e>Mara Karmah diberi kesaktian oleh binatang-binatang buas', 'e', 100, 0),
(70, 12, 19, 'ganda', 'Nilai sosoial yang terdapat dalam kutipan hikayat tersebut adalah', 'text', 'a>para penghuni alam di hutan rumah terdapat pendatang|b>orang yang tinggal dalam hutan kaan bersahabat dengan penghui atau alam ldari hutan itu|c>pendatang di hutan tidak boleh merusak hutan tersebut|d>pendantang di hutan harus menjaga kelestarian hutan|e>para penghuni hutan umumnya sakti', 'b', 100, 0),
(71, 12, 20, 'ganda', 'Karakter tokoh Badul dalam kutipan cerpen tersebut adalah', 'text', 'a>pekerja keras|b>sederhana|c>tanggung jawab|d>rajin|e>jujur', 'a', 100, 0),
(72, 12, 20, 'ganda', 'pendekstripsian karakter tokoh Badul dalam kutpan cerpen tesebut dilakukan melalui', 'text', 'a>ciri fisik tokoh|b>lingkungan di sekitar tokoh|c>perbuatan tokoh|d>ucapan tokoh|e>penjelasan dari pengarang', 'e', 100, 0),
(73, 12, 20, 'ganda', 'latar suasana dalam kutpan cerpen tersebut adalah', 'text', 'a>kehudpan para pekerja di sana|b>kehidupan warga desa yang sederhana|c>kehidupan desa yang sepi|d>kemiskinan sebuah desa|e>kehidupan kuli bangunan', 'b', 100, 0),
(74, 12, 20, 'ganda', 'Nilai budaya yang terdapat dalam kutipan cerpen tersebut adalah', 'text', 'a>laki-laki menjadi kuli bangunan|b>dijodoh-jodohkan para gadis remaja|c>laki-laki tidak menamatkan sekolah dasar|d>menyatakan sehidup semati|e>laki-laki bertandang ke rumah perempuan', 'b', 100, 0),
(75, 12, 20, 'ganda', 'Isi kutipan cerpen tersebut yang berkaitan dengan kehidupan saat ini adalah', 'text', 'a>masih banyak pengangguran di sekitar kita|b>masih nyak masyarakat yang belum menikmati hasil pembangunan|c>pendidikan belum menjadi fokus utama masyarakat|d>pendidikan hanya untuk masyarakat yang memiliki uang|e>menjadi kuli bangunan merupakan sesuatu yang hina', 'c', 100, 0),
(76, 12, 21, 'ganda', 'Frasa-frasas yang tepat untuk melengkapi paragraf deskriptif yang rumpang di atas adalah', 'text', 'a>belum tinggi benar - sangat indah|b>sudah tinggi benar - kurang indah|c>agak tinggi benar - cukup indah|d>sangat tinggi benar - betapa indah|e>akan tinggi benar - agak indah', 'a', 100, 0),
(77, 13, 22, 'ganda', 'yang merupakan kebutuhan tersier adalah', 'text', 'a>1,2,dan 3|b>1,3,dan 4|c>2,3, dan 4 |d>2,4,dan 5|e>3,4, dan 5', 'c', 100, 0),
(78, 13, 0, 'ganda', 'kelangkaan bahan bakar minyak akhir-akhir ini mnjadi kendala bagi masyarakat menengah ke bawah dalam memenuhi kebutuhan hidup. Cara yang tepat untuk mengatasi kelangkaan tersebut adalah', 'text', 'a>membuat skala prioritas untuk memenuhi kebutuhan|b>membatasi pembelian minyak tanah|c>mengkonversikan dari minyak tanak ke gas|d>import minyak tanah dari timur tengah dengan harga mahal|e>mengirit pemakaian bahan bakar minyak tanah', 'c', 100, 0),
(79, 13, 0, 'ganda', 'Arus balas jasa yang diterima tenaga kerja adlaah', 'text', 'a>1|b>2|c>3|d>4|e>5', 'c', 100, 5),
(80, 13, 0, 'ganda', 'Besar pendapatan nasiional menurut pendekatan pendapatan adalah', 'text', 'a>Rp. 23.500,00|b>Rp. 30.000,00|c>Rp. 38.500,00|d>Rp. 40.500,00|e>Rp. 44.000,00', 'd', 100, 6),
(81, 13, 0, 'ganda', 'Besar laju inflasi yang terdapat tahun 2011 adalah', 'text', 'a>3,64%|b>3,77%|c>4,35%|d>4,55%|e>8,50%', 'a', 100, 7),
(82, 13, 0, 'ganda', 'Fungsi tabungan suatu negara dinyatakan dengan persamaan C=100.000+0,75Y, jika pendapatan negara Rp. 8.000.000,00 maka besar tabungan negara adalah', 'text', 'a>Rp. 6.100.000,00|b>Rp. 5.900.000,00|c>Rp. 2.100.000,00|d>Rp. 1.900.000,00|e>Rp. 1.500.000,00', 'e', 100, 0),
(83, 13, 0, 'ganda', 'Apabila jumlah uang yang beredar di masyarakat terlalu banyak dan tidak diimbangi ketersediaan barang hasil produksi akan menimbulkan kenaikan harga barang-barang hingga menimbulkan inflasi, kebijakan moneter yang diambiil bank sentral untuk mengatas', 'text', 'a>meningkatkan pemberian kredit|b>membeli surat-surat berharga|c>menurunkan persedian kurs|d>menginkatkan usku bunga|e>memberi kemudahan kredit lunak', 'c', 100, 0),
(84, 13, 0, 'ganda', 'Pak Nurdin terpaksa menganggur, karena dia seorang petani yang sedang mengunggu masa panen. Pak Nurdin merasa jemu dan bosan. untuk itu dia ingin mengatasinya dengan cara', 'text', 'a>memberikan informasi tentang lowongan pekerjaan lain yang sesuai|b>mengikuti pendidikan dan latihan sesuai dengan pendidikan|c>memanfaatkan waktu dengan keterampilan membuat kerajinan lain|d>membuka proyek padat karya di daerah pertanian|e>pemerintah banyak membuuka proyek proek baru', 'c', 100, 0),
(85, 13, 0, 'ganda', 'Bapak Agus Santoso berserta istrinya melakukan umrah ke Arab Saudi dengan membawa uang saku Rp. 25.000.000,00 dan waktu kembai ke Indonesia sisa uang 2.000 real. jika kurs yang terjadi pada saat penukaran (berangkat dan pulang sebagai berikut : Kurs ', 'text', 'a>Rp. 4.600,000,00|b>Rp. 5.000.000,00|c>Rp. 10.869.565,00|d>Rp. 18.400.000,00|e>Rp. 25.000.000,00', 'd', 100, 0),
(86, 13, 0, 'ganda', 'Untuk melindungi produk dalam negeri pemerintah memberlakukan bea masuk atas barang tertentu dengan tujuan agar tidak membanjirnya barang import, tindakan pemerintah tersebut termasuk dalam kebijakan', 'text', 'a>tarif|b>kuota|c>premi|d>larangan impor|e>larangan ekspor', 'a', 100, 0),
(88, 13, 0, 'ganda', 'Transaksi peruhaana salon &quot;Mut-Mut" pada bulan Februari 2012 sebagai berikut: Tangal 8 Februari 2012 di beli perlengkapan salon seharga Rp. 7.500.000,00 dibayar Rp. 5.000.000,00 sisanya akan dibayar kemudian. Tanggal 14 Februari 2012 diterima pe', 'gambar', 'a>8|b>9|c>10|d>11|e>12', 'b', 100, 0),
(89, 13, 0, 'ganda', 'Berdasarkan kertas kerja di atas, peneyelesaian kertas kerja yang benar adalah', 'text', 'a>1,2,dan3|b>1,2,dan4|c>2,3,dan4|d>2,4,dan5|e>3,4,dan5', 'c', 100, 13),
(90, 13, 0, 'ganda', 'Apabila modal awal Rp. 300.000.000,00 maka besar modal akhir adalah', 'text', 'a>Rp. 340.000.000,00|b>Rp. 343.000.000,00|c>Rp. 365.000.000,00|d>Rp. 347.000.000,00|e>Rp. 348.000.000,00', 'c', 100, 14),
(91, 13, 0, 'ganda', 'Posting jurnal pembelian ke buku besar pembelian yang benar adalah', 'gambar', 'a>16|b>17|c>18|d>19|e>20', 'c', 100, 15),
(92, 13, 0, 'ganda', 'Besarnya pengeluaran pemerintaha akibat permintaan anggaran dari departemen/lembaga ataupun non departemen mengharuskan pemerintah meningkatkan penerimaan APBN pada tahun yang bersangkutan. Untuk mengatasi masalah tersebut kebijakan fisikal yang dila', 'text', 'a>menaikkan belanja subsidi|b>menurunkan persentasi pajak|c>menurunkan jumlah objek pajak|d>menurunkan utang pemerintah|e>melakukan pinjaman dari dalam/luar neger', 'e', 100, 0),
(93, 14, 0, 'ganda', 'Indonesia diapit oleh dua benua dan dua samudera yaitu Benua Asia dan Australia, Samudra Hindia dan samudera Pasifik. Konsep geografi yang beriakitan dengan hal tersebut adalah', 'text', 'a>Konsep lokasi|b>konsep deferensiasi areal|c>konsep keterjangkauan|d>konsep morfologi|e>konsep aglomrasi', 'a', 100, 0),
(94, 14, 0, 'ganda', 'Dalam melaksanakaan program pemerintah Green and CLean (Hijau dan Bersih), Pemerintah Kota Surabaya, melakukan penataan sepangjang jalur hijau dan membongkar bangunan liar yang tidak berizin. Pendekatan geografi yang berkaitan dengan kasus tersebut a', 'text', 'a>pendekatan spasial|b>pendekatan wilayah|c>pendekatan lingkungan|d>pendekatan region|e>pendekatan aktivitas', 'e', 100, 0),
(95, 14, 0, 'ganda', 'Penduduk yang tinggal di sekitar pantai, bermata perncarian utama sebagai nelayan sedangkan didaerah pegungungan mata pencaharian penduduknya sebagai petani. Prinsip geografi yang berkaitan dengan fenomena tersebut adalah', 'text', 'a>prisip distribusi|b>prinsip dekripsi|c>prinsip korologi|d>prinsip interralasi|e>prinsip lokasi', 'e', 100, 0),
(96, 14, 0, 'ganda', 'berdasarkan penelitian para pakar geologi, lempeng Eurasia didesak oleh lempeng Indo-Australia dengan kcepatan 7 cm per tahun. Bukti dari pergerakan itu adalah', 'text', 'a>pulau-pulau kecil tenggelam|b>lumpur lapindo sidoarjo|c>gempa vulkanik merapi di Yogyakarta|d>gemap tektonik di bantul|e>tanah longsor di ambon', 'a', 100, 0),
(97, 14, 0, 'ganda', 'Dampak pola pergeerakan lempeng seperti gambar mengakibatkan salah satu lempeng subduksi engan lempeng lain sehingga terbentuk', 'text', 'a>palung dan pematang samudera|b>palung dan pengunungan lipatan|c>patahan dan lemba di sepanjang tumbukan|d>lembah dalam dan dasar samudera dangkal|e>tebing curam dan patahan yang memanjang', 'd', 100, 21),
(98, 14, 0, 'ganda', 'Pembentukan Tata Surya menurut teori &quot;Planetesimal" adalah', 'text', 'a>meterial planet bagian dari Matahari|b>Terdapat inti padat di dalam kabut|c>kabut tipis yang berpilin|d>grafvitasi yang besar dari Matahari|e>ukuran planet-planet tidak sama', 'b', 100, 0),
(99, 14, 0, 'ganda', 'Salah satu cara mitigasi bencana alam gempa yaitu', 'text', 'a>berlari keruangan yang dindingnyan kokoh|b>tidak panik dan mengikuti jalur evakuasi|c>berlindung di bawah meja yang ringan|d>berlindung di bawah pohon yang tinggi|e>menghubungi aparat untuk minta pertolongan', 'b', 100, 0),
(100, 14, 0, 'ganda', 'Pola pergerakan angin seperti gambar mendatangkan musim hujan di wilayah', 'text', 'a>Sulawesi Selatan, Sulawesi Tenggara, dan Maluku|b>Sumatera Barat, Jawa Tengah, dan Jawa Bara|c>Sumatera Selatan, Jawa Timur, dan Bali|d>Kalimantan, Maluku dan Papua|e>Kalimantan, Sulawesi. dan Nusa Tenggara', 'd', 100, 22),
(101, 14, 0, 'ganda', 'Angka 4 pada gambar daur hidrologi merupakan proses', 'text', 'a>kondensasi|b>sublimasi|c>evaporasi|d>transpirasi|e>presipitasi', 'c', 100, 23),
(102, 14, 0, 'ganda', 'Faktor klimatik yang memengaruhi persebaran flora di permukaan Bumi adalah', 'text', 'a>suhu dan curah hujan|b>geologi dan morfologi|c>morologi dan tanah|d>tanah dan mikro organisma|e>struktur tanah dan curah hujan', 'c', 100, 0),
(103, 14, 0, 'ganda', 'Daerah Nusa Tenggara ditumbuhi oleh padang rumput sehingga aktivitas utama penduduk di daerah itu adalah', 'text', 'a>peternekan|b>pertanian|c>kehutanan|d>nelayan|e>perdagangan', 'a', 100, 0),
(104, 14, 0, 'ganda', 'Daerah persebaran hewan kanguru berada di zona', 'text', 'a>Neartik|b>Afrika|c>Australia|d>Neotropik|e>Paleartik', 'c', 100, 0),
(105, 14, 0, 'ganda', 'Kecenderungan penduduk dunia membuka usaha di bidang industri dan jasa, sementara sektor pertanian dan perikanan kurang mendapat perhatian. Hal itu menimbulkan dampak yang serius terhadap', 'text', 'a>kelestraian lingkungan|b>daya dukung perkantoran|c>ketahanan pangan|d>fungsi lahan|e>perencanaan bangunan', 'c', 100, 0),
(106, 14, 0, 'ganda', 'Faktor penyebab pertumbuhan penduduk relatif rendah di daerah tandus spertiGunung Kidul dan Wonogiri adalah.', 'text', 'a>sebagian besar penduduknya berpendidikan rendah|b>tanahnya sangat sulit diusahakan untuk lahan pertanian|c>kesadaran untuk mengikuti program keluarga berncana tinggi|d>penduduk usia muda bnyak menunda perkawinannya|e>sebagian besar penduduk usia mudal melakukan urbanisasi', 'e', 100, 0),
(107, 14, 0, 'ganda', 'perpindahan penduduk dengan tujuan bekerja di kota dan setelah selesai bekerja kembali lagi ke tempat asal disebut', 'text', 'a>migrasi|b>remigrasi|c>komuter|d>urbanisasai|e>imigrasi', 'b', 100, 0),
(108, 14, 0, 'ganda', 'Skala peta B sesuai ilustrasi gambar adalah', 'text', 'a>1:100.000|b>1:400.000|c>1.500.000|d>1:600.000|e>1:800.000', 'b', 100, 24),
(109, 14, 23, 'ganda', 'Peta yang digunakan untuk mengannalisis tingkat erosi terdapat pada angka', 'text', 'a>1,2,dan4|b>1,2,dan5|c>1,3,dan5|d>2,3,dan5|e>3,4,dan5', 'a', 100, 0),
(110, 14, 0, 'ganda', 'Industri yang cocok didirikan di daerah x sperti di gambar adalah', 'text', 'a>industri tekstil|b>industri pariwisata|c>industri pengolahan buah|d>industri pengolahan makanan|e>industri penglahan hasil laut', 'b', 100, 25),
(111, 14, 0, 'ganda', 'Angka 3 pada gambar menurut teori sektor menunjukkan lokasi', 'text', 'a>Pemukiman kaum buruh|b>kawasan industri ringan|c>daerah pusat kegiatan|d>pusat-pusat perdagangan|e>pemukiman kelas atas', 'b', 100, 26),
(112, 14, 0, 'ganda', ' Karakteristik suatu negara disebut sebagai negara maju adalah', 'text', 'a>pertambahan pendudduknya tinggi|b>nakga ketergantungannya tinggi|c>angka harapan hidupnya tinggi|d>tingkat kematian tinggi|e>angka kriminalitas tinggi', 'c', 100, 0),
(113, 15, 0, 'ganda', 'Aguste Comte membahas sosiologi dengan membagi tiga tahap perkembangan masyarakat, yaitu: Teologi, metafisik, dan positivis. Poko kajian yang sesuai pada tahapan positivis menurut Aguste Comte adalah', 'text', 'a>konfilik partai yang terjadi karena perbedaan kepentingan|b>nelayan menamgkap ikan di laut untuk dijual ke pedagang|c>ikan lumba-lumba bermain dengan Ira di arena hiburan|d>Hari bernyanyi di panggung untuk menghibur penonton|e>menghormati leluhur dengan upacara membakar sesajen', 'a', 100, 0),
(114, 15, 0, 'ganda', 'Program Bantuan Langsung Tunai (BLT) yang dimaksudkan untuk meringankan beban masyarakat kecil dari tekanan kemiskinan, perlu dikaji lebih lanjut berkaitan dengan keberhasilan mengatasi permasalahan. Peran sosiologi dalam menjelaskan kemajuan program', 'text', 'a>mencitrakan sebuah tata kelola pemerintahan yang baik|b>menciptakan masyarakat yang aktif dan komunikatif|c>memberikan data berupa baik buruknya kegiatan|d>membebaskan masyarakat dari beban kemiskinan|e>meningkatkan pola pikir masyarakat menjadi matu', 'd', 100, 0),
(115, 15, 0, 'ganda', 'Perceraian sering terjadi dalam kehidupan rumah tangga yang sudah dibangun sejak bertahun-tahun. Komitmen awal unuk membentuk rumah tangga yang langgeng selamanya tidak berhasil diperhankan karena perbedaan hak dan pearan antara laki-laki dan perempu', 'text', 'a>mensosialisasikan kesetaraan gender bagi anggota masyarakat|b>berusaha untuk menghilangkan perbedaa-perbedaan kelas|c>membedakan atara masalah sosial dengan problem sosial|d>melakukan dan mengkaji masalah sosial yang berbeda-beda|e>menghubungkan antara nilai dan norma dalam lembaga sosial', 'e', 100, 0),
(116, 15, 0, 'ganda', 'Manager perusahaan mengadakan pertemuan dengan wakil buruh perusahaan ang dihadiri oleh perwakitlan dari KEmeskertrans untuk saling mengyampaikan keinginnya guna mecapai kesepatakan dalam hal pengupahan. bentuk interaksi pda pertemuan tersebut adlaah', 'text', 'a>sugesti|b>arbitrasi|c>torenasi|d>konsiliasi|e>kontravensi', 'a', 100, 0),
(117, 15, 0, 'ganda', 'Baskoro mengagumi prestasiayahnya dalam bidang olah raga dan dari ibunya dalam berkesenian. Ia berharap kelak mendjadi seperti kedua orang tuanya yang dinilai sukses dalam hidup. Prses interaksi sosial Baskoro dipengaruhi oleh faktor', 'text', 'a>motivasi|b>empai|c>sugesti|d>simpati|e>imitasi', 'a', 100, 0),
(118, 15, 0, 'ganda', 'Anna terlahir dari keluarga kaya. sejak kecil ia sdiasuh oleh orang lain di luar keluarganya. Ketika sudah besar Anna bersikap tidak patuh terhadap orang tuanya. untuk mengatasi perilaku Anna tersebut keluarganya menghukum dengan cara keras. Pola sos', 'text', 'a>primier|b>represif|c>persuasif|d>sekunder|e>preventif', 'e', 100, 0),
(119, 15, 0, 'ganda', 'beberapa pemilik kendaraan bermotor mengaku tekejut dengan naiknya pajak kendaraan bermotor dan diberlakukannya pajak progesif, sehingga mereka harus membayar pajak lebih tinggi dari biasanya. Hal ini tidak akan terjadi jika diakdakan sosialisasi den', 'text', 'a>memberikan keterampilan dan pengetahuan yang dibutuhkan untuk melangsungkan kehidupan|b>mengembangkan kemampuan seseorang untuk berkomuniasi secara efektif melalui menulis dan bercerita|c>membantu seseorang mengedalikan fungsi-fungsi orangik melalui latihan dan mawas diri yang tepat|d>menanamkan kepada seseorang nilai-nilai dan kepercayaan pkok pada masyarakat|e>mengkomunikasikan kepada masyrakat untuk menerima dan menyesuaikancdngan unser kebu', 'e', 100, 0),
(120, 15, 0, 'ganda', 'Seoaranghakum pengadilan negeri terbukti korupsi dengan menerima gratifikasi atau suap dari terseangka untuk vdiringakna hukumannya. maka cara yang teapat mengendalikan penyimpangan tersebut yaitu, menggunakan', 'text', 'a>desas-desus|b>intimidasi|c>tekanan sosial|d>sosialisasi nilai dan norma|e>pengendalian formal/hukum', 'e', 100, 0),
(121, 15, 0, 'ganda', 'Dasar atau kriteria pelapisan sosial pada gambar di atas adlaah', 'text', 'a>pemilik tanah dan keturunan|b>pendidikan dan keahlian|c>kekuasaan dan wewenang|d>kekayaan dan pendidikan|e>kekayaan dan keturunan', 'd', 100, 27),
(122, 15, 0, 'ganda', 'Dalam pemerintahan daerah setingkat kecematan terdapat lapisan dan jajaran yang emnuukkan status dan peran masing-masing individu. hal ini menunjukkan salah satu iri dari adanaya struktur sosial yaitu', 'text', 'a>menjalin hubungansosial antarstatus|b>realitas sosial yang erbsifat berjenjang|c>membentuk terori kebudayaan masryarakat|d>peranan pimpinan menajdi penentu struktur|e>membentuk kerjasama kelompok sosial tertentu', 'e', 100, 0),
(123, 15, 0, 'ganda', 'Daerah yang diarsir di atas menunjukkan ahsil suatu proses sosial dalam bentuk', 'text', 'a>konsolidasi|b>akomodasi|c>interseksi|d>asimilasi|e>interaksi', 'b', 100, 28),
(124, 15, 0, 'ganda', 'Konfilik antara bank swasta dengan nasabah sehubungan dengan jumlah tagihan pada kartu kredit menurut nasabah tidak sesuai dengan penggunaannya dieselesaikan dengan mendatangkan petugas Bank Indonesia yangmempertemukan kepentingan bank dan nasabah se', 'text', 'a>ajudikasi|b>kompromi|c>toleransi|d>mediasi|e>arbitrasi', 'd', 100, 0),
(125, 15, 0, 'ganda', 'Perusahaan menginginkan pekerja yang terampil, rajin, tetapi upah rendah. Pekerja menginginkan pekerjaan yang ringan, mudah, jam kerja yang pendek, tetapi upahnya tinggi. Keadaan demikian dapat memicu timbulnya konfilik jenis konfilik demikian diseba', 'text', 'a>perubahan sosial|b>benturan kepentingan|c>perbedaaan kebudayaan|d>perbedaan kepribadian|e>perbedaan faktor politik', 'b', 100, 0),
(126, 15, 0, 'ganda', 'Prof. Dr. Aloimudin adalah seorang doktoer yangmemiliki banyak pasien, karena terkenal ramah dan suka menolong pasien kurang mampu. selain terkenal sebagai dokter spesialis, beliau terpilih juga menajdi ketua ikatan Dokter indonesia untuk lima tahun ', 'text', 'a>lembaga pendidikan|b>organisasi ekonomi|c>organisasi keahlian|d>organsisasi politik|e>lembaga potensi', 'c', 100, 0),
(127, 15, 0, 'ganda', 'Rukun Tetangga (RT) merupakan bentuk kelompok sosial yang anggotanya saling kenal dan dapat bekerja sama. Ikatan kelompok tersebut dapat diaktakan sebagai paguyuban (gemeinschaft) yang terbentuk karena adanya', 'text', 'a>besar dan kecillnya jumlah anggota|b>pola kesadaran dan tujuan yang sama|c>hubungan sosial dan tujuan yang sama|d>wilayah geografi dan tujuan yang sama|e>kepentingan secara kelompok dan wilayah', 'e', 100, 0),
(128, 15, 0, 'ganda', 'Adanya masyarakat multikultural dapat diketahui dari keragaman penerapan teknologi budaya, seni, dan bahasa. Seperti perbedaan budaya pada kelompok masyarakat yanghidup di pesisir pantai dengan kelompok masyarakat yang tinggal di dataran tinggi. Fakt', 'text', 'a>latar belakang sejarah yang sama|b>berada di jalur transportasi dunia|c>mempunyai jenis vegetasi beragam|d>wilayah yang terdiri dari kepulauan|e>adanya pembagian tiga zona yang berbeda', 'c', 100, 0),
(129, 15, 0, 'ganda', 'Gambar tersebut menunjukkan adanya proses', 'text', 'a>interseksi melahirkan intregrasi sosial|b>konsolidasi melahirkan intergrasi sosial|c>interseksi melahirkan konsolidasi|d>konsolidasi melahirkan konfilik|e>integrasi melahirkan konflik', 'd', 100, 29),
(130, 15, 24, 'ganda', 'Di antara perilaku tersebut yang merupakan pernyataan sesuai dengan unsur primodial adalah', 'text', 'a>1,2,3|b>1,2,4|c>1,3,5|d>2,4,5|e>3,4,5', 'd', 100, 0),
(131, 15, 0, 'ganda', 'Lahan tidur yang tadinya kumuh dan diperugnakan oleh masyarakt untuk membangun sampah, sekarang dibangun menjadi taman kota yang indah dan asri. Bnayak masyarakat yang memanfaatkan taman tersebut sebagai sarana rekreasi keluarga. berdasarkan ilustras', 'text', 'a>intern|b>ekstern|c>regres|d>progress|e>evolusi', 'c', 100, 0),
(132, 15, 0, 'ganda', 'Dari tabel di tersebut dapat disimpulkan bahwa hukuman yang dikehendaki masyarakat bagi siswa yang terlibat tawuran adalah', 'text', 'a>diadili di pengadilan|b>dikeluarkan dari sekolah|c>didenda ganti rugi|d>dihakimi masyarakat|e>dimasukkan penjara', 'a', 100, 30),
(133, 16, 0, 'ganda', 'Pengkajian terhadpaa terjadinya suatu negara dapat ditinjau dari terbentuknya negara dari masyarakat yang sederhana meningkat menjadi negara modern. Negara tersebut terbentuk secara', 'text', 'a>gabungan|b>revolusi|c>okupasi|d>primer|e>sekunder', 'c', 100, 0),
(134, 16, 0, 'ganda', 'Faktor-faktor penting bagi pembentukan bangsa Indonesia antara lain', 'text', 'a>pemimpin dan karakter yang sama|b>persamaan perasaan senasib dan cita-cita|c>orientasi politik dan adat istiadat yang sama|d>kesamaan ideologi dan bahasa yang digunakan|e>leluhur yang serumpun dan keyakinan yang sama', 'b', 100, 0),
(135, 16, 0, 'ganda', 'Kasus dugaan korupsi di berbagai badan atau lembaga perlu diatasi dan upaya yangperlu dilakukan pemerintah adalah', 'text', 'a>menangani dugaan korupsi|b>merubah UU secara rutin|c>bekerjasama dengan setiap institusi|d>transparansi keuangan negara|e>melakukan monitoring internal', 'e', 100, 0),
(136, 16, 0, 'ganda', 'Perbuatan memperkaya diri sendiri ataupun orang lain srecara melawan hukum merupakan perbuatan yang merugikan negara, salah satu contoh kerugian negara tersebut adalah', 'text', 'a>banyak pejabat negara yang tersangkut dengan masalah hukum|b>menghambat program pemerintah dalam melaukan pembangunan|c>kepercayaan lembaga internasional terhadap Indonesia berkurang|d>melemahkan sistem hukum yang berada di bawah lembaga yudikatif|e>membuat kestabilan kehidupan politk dalam negeri menjadi terganggu', 'b', 100, 0),
(137, 16, 0, 'ganda', 'Salah satu upaya pemerintah dalam upaya pemajuan, penghormatan dan penegakan Hak Asasi Manusia di Indonesia antara lain', 'text', 'a>pemisahan kedudukan tugas dan fungsi lembaga TNI-POLRI|b>menyelesaikan kasus HAM yang disorot oleh internasional|c>mengangkat dan memberhentikan anggota Komnas HAM|d>Pembentukan komisi anti kekerasan terhadap perempaun|e>mengangkat seorang menteri di bidang peranan wanita', 'd', 100, 0),
(138, 16, 0, 'ganda', 'Salah  satu manfaat mempelajari budaya politik adalah', 'text', 'a>memudahkan menentukanfigur pemimpin yang tepat untuk daerah tertentu|b>mengetahui tanggapan, orientasi warga negara terhadap kondisi sistem politik|c>menghilangkan perbedaan cara pandang masyrakat terhadap sistem politk|d>mengkondisikan orientasi politik masyarakatnya kepada pilihan yang ditentukan |e>menjaring kader ntuk menjadi pemimpin yang loyal terhadap partai politk', 'b', 100, 0),
(139, 16, 0, 'ganda', 'Berikut ini yang membedakan antara budaya politik parokial dengan budaya politik partisipan yaitu pada budaya politik parokial', 'text', 'a>perhatian masyarakat pada sistem politik melalui tinggi|b>terdapat pada masyarakat tradisional dan sederhana|c>minat masyarakat dalam dunia politik sangat tinggi|d>masyarakatnya sudah sadar terhadap proses poitik|e>masyarakatnya memiliki minat terhadap keputusan politik', 'b', 100, 0),
(140, 16, 0, 'ganda', 'Bentuk partisipasi poitik ada yang bersifat mordern dan konvensional, bentuk partisipasi politik konvernsional antara lain', 'text', 'a>kudeta|b>revolusi|c>demonstrasi|d>pengjuan petisi|e>pemberian suara', 'c', 100, 0),
(141, 16, 0, 'ganda', 'salah satu contoh perilaku yangmencerminkan wujud budaya demokrasi aldaah', 'text', 'a>melibatkan smua orang dalam memecahkan persoalan di rumah|b>menyelsaikan semua msalah dalam keluarga dengan cepat dan tepat|c>menyelesikan setiap permasalahan dengan cara musyawarah untuk mufakat|d>mencoba memahami semua kesulitan yang dialami oleh berbagai lingkungan|e>bersikap terbuka terhadap seluruh bdudaya dan pengaruh dari luar negeri', 'c', 100, 0),
(142, 16, 0, 'ganda', 'pers merupakan unsur yang sangat penting dalam kehidupan bermasyarakt, berbangsa dan bernegara yang demokratis karena pers mempunyai sifat antara lain', 'text', 'a>agen propaganda pemerintah|b>sarana sosialisasi politik|c>media kontrol sosial|d>alat doktrinasi negara|e>media hak jawab', 'c', 100, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_cerita`
--

CREATE TABLE IF NOT EXISTS `soal_cerita` (
  `id_soal_cerita` int(3) NOT NULL AUTO_INCREMENT,
  `soal_cerita` text NOT NULL,
  `awal_cerita` varchar(120) NOT NULL,
  PRIMARY KEY (`id_soal_cerita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `soal_cerita`
--

INSERT INTO `soal_cerita` (`id_soal_cerita`, `soal_cerita`, `awal_cerita`) VALUES
(6, '<p>Dear Mr. Aditya</p><p>Thank you for your email.</p><p>Yes it&#39;s pity that your students can&#39;t come to our school.<br />Yet, I&#39;m Looking forward to seeing some of them next yeear!</p><p>Our students are enjoying Skyping with your students and exchanged some information about school and school live. I really hope we can start teleconference next semester. (We are currently on Summer Vacation and new semester start on 27th this month.)</p><p>By the way, did you get a letter from Mr. Zaenal? Do you exchange any information with his school or have you tlaked with him about our conversation? I wonder how he knew about it. I&#39;ll forward his email in another e-mail.</p><p>Kiwame</p><p>Ehime High School</p><p>Japan, November 5, 2012</p>', '<p>Dear Mr. Aditya</p><p>Thank you for your email.</p><p>Yes it&#39;s pity that your students can&#39;t come to our scho'),
(8, '<p>Dear, Pandu Agustian</p><p>Thank you for contacting PayPal with your concern</p><p>I Understand that you want to make the payment through your credit card but failed.</p><p>By checking your account information, I have noticed that you linked your credit card ending with 5132 to your PayPal account and requested the 4 digit PayPal code on June, 9. After that you entered the 4 digit Paypal code 3 times incorrectl. So system disabled the credit card ending with 5132. Please don&#39;t worry since I have re-enabled it for you. You can try to re-add it into your PayPal account to complete your account verification now.</p><p>Please follow the instructions to locate your 4 digit PayPal code;</p><p>If you have online access to your card statement, it takes a few business days for the change to appear, depending on your issuing bank Your unique 4 digit PayPal code is displayed on your card statment next to or near the PayPal fee. In the item description section, this code is printed next to the word &quot;PAYPAL&quot; (No spcase between the numbres and the word &quot;PAYPAL)</p><p>when you know your PayPal Cod, you can confirm your card.</p><p>Please let me know if you need further assistance.</p><p>Sincerely,</p><p>Cathy<br />PayPal, an Ebay Company</p>', '<p>Dear, Pandu Agustian</p><p>Thank you for contacting PayPal with your concern</p><p>I Understand that you want to make'),
(9, '<p><strong>INSTITUTE OF INTERNATIONAL COMMUNICATION</strong></p><p>Have you always wanted to-speak a foreign language? or two, three?<br />Now you can! We open classes for adult in:<br />English-Franch-Spanish-Japanese-Chinese-Korean<br />All levels from beginner through advanced.<br />Register for Summer classes now.<br />We have both day and evening schedules.</p><p>Call 564-0284 Monday to Friday 7 A.M - 09.30 P.M<br />Or visit us at 6793 Independence Boulevard, Suite[00]</p>', '<p><strong>INSTITUTE OF INTERNATIONAL COMMUNICATION</strong></p><p>Have you always wanted to-speak a foreign language? o'),
(10, '<p>Kinderfield is a school where children begin their greatest experience in life. Kinderfield provides some innovations in fulfilling ever child&#39;s potential by various learning experiences that design to child&#39;s interest and environment. Kinderfield applies National Method and uses English as a medium of instruction. We Urgently seek qualified teachers for the position of: TEACHER</p><p>Requirements:</p><ul><li>Male/Female</li><li>Age maximum 35 year old</li><li>Min a Degree (S1) holder</li><li>Fluent in English both oral &amp; written</li><li>Computer literate</li><li>Love &amp; care for children</li><li>Live in Tangerang area</li></ul><p>Please send your detailed SV with recent photo to:<br />treestc@gmail.com</p>', '<p>Kinderfield is a school where children begin their greatest experience in life. Kinderfield provides some innovations'),
(11, '<p><strong>&quot;Ghost Fishing&quot; by lost nets damages seas</strong></p><p>Lost or abandones nets in the oceans can keep on &quot;ghost fishing&quot; for years in a growing threat to marine stocks, a UN report said last week.</p><p>About 640.000 tones of discarded fishing gear nets added to the oceans annually, or 10 percents of the world total of marine debris, according to the study by the UN FOOd and Agriculture Organiztions (FAO) and UN Environment PRogram (UNEP).</p><p>Fishing gear &quot;will continue to accumulate and the impacts on marine ecosystems will continue to worsen if the international community doesn&#39;t take effective steps to deal with the problem of marine debriis as a whole, &quot;Ichiro Nomura, a FAO assistant directior-general, said in a statement.</p><p>The study recommended cash incentives for fishing fleets which bring ntest to port better mapping of sub sea hazard to avoid losses or new net designs that dissolve if left in the water too long.</p><p>Ntes sometimes get snap in stroms, snagged on coral reefs or entangle in other fishing gear, They can then start what the report learned &quot;Gosht fishing&quot; - pointlessly ensnaring fish or cratures such as turtules, seabirds or whales for years or even decades.</p><p>The report did not estimate over all damage to the oceans or economic losses to fishing fleets from gear littering sea beds from the South China Sea to the Mediterranean.</p><p>&quot;It&#39;s very difficlut to estimate the impact&quot; said David osborn, coordinator of UNEP&#39;s Global Progrramme of Action on land-based sources of marine pollution.</p><p>&quot;But we know that it&#39;s affecting fish take and it also represents a problem in term of navigational hazard, like by fouling propellers&quot; he told Reuters.</p><p>A 1992 ban on drift ets helpoed curb some problems, the study said, but gill bets, anchored to the seabed, can form a verical wall between 600 meters and 10.000 meters long and can start ghost fishing if they break loose.</p><p>In Cheapskate Bay, United States, an estimated 150.000 crab trap are lost every years of an estimated 500.000 deployed.</p>', '<p><strong>&quot;Ghost Fishing&quot; by lost nets damages seas</strong></p><p>Lost or abandones nets in the oceans can k'),
(12, '<p>Does chicken soup cure a cold? scientific studies have not been able to show that this is true. nevertheless, many people use it to treat their colds. Why is this? &quot;Because it works,&quot; says Dr. Patty Wilson of New York. &quot;My patients always say they feel better agter treating their cold with a bowl of hot chicken soup. Scientific reseaarch may not shwo it, but my patients have their own experience. They found taht chicken soup makes them feel better.&quot;</p><p>Whether of not chicken soup really cures cold, it does have health benfits, especially when prepared with lots of vegetables, it is nourishing and isn&#39;t fattening. it&#39;s also easy and inexpensive to make. sick or healthy, chicken soup a delicious and healthy for everyone.</p>', '<p>Does chicken soup cure a cold? scientific studies have not been able to show that this is true. nevertheless, many pe'),
(13, '<p>Affandi(1907 - May 23, 1990) was born in Cirebon, West Java, as the son of R.Koesoema, ho was a surveor at local sugar factory. Afandi finished his upper secondary school in Jakarta, but he forsought his study for his desire to be an artist, Affandi taugh himselft how to paint sice 1934. He married Maryanti, a fellow artist, and one of his childre, Kartika also became an artist.</p><p>In the 1950s, Affandi created expressionistic painting. The First Grandchild (1953) was the piece that marked his newfound style: &quot;squeezing the tube.&quot; Affandi paints by directly squeezing the paint out its tube, instead of paintbrush, he expresses his feelings using his own hands, in certain respect, he has acknowledged similarities with Vincent van Gogh.</p><p>As s renowned artist, Affandi participated in various exhibitions abroad. beside in India, he also displayed his works in te Biennale in Brazil (1952), Venice (1954), and Sao Paulo (1956). In 1957, he received a scholarship from United States goerment to by Ohio State University in Columbus, Unites State, In 1974, he received an honorary doctorate from University of Singapore, the Peace Award from the Dag Hammarskjoeld Foundation in 1977, and the title of Grand Maestro in Florence, Italy</p><p>One the bank of Gajah Wong River at Solo street in Yogyakarta, Affandi designed and constructed a house, which also employes as museum to dsplay his painting,</p><p>After suffering from some complications of illnesses, on Wednesday, May 23, 1990, Affandi died, buried in the museum complex</p>', '<p>Affandi(1907 - May 23, 1990) was born in Cirebon, West Java, as the son of R.Koesoema, ho was a surveor at local suga'),
(14, '<p>One of the most interesting animals we saw in the zoo is a giraffe. It is a male and about six meterstall. its bigbrown eyes are protected by ver thick lashes. It has brown spots on the skin. It also has two short horn on its head.</p><p>Like a camel, it can go for a long time without drinking water. its source of water is the leaves in which it eats from trees. Since it is tall, giraffe can reach the tender leaves at the top of the tree.</p><p>The giraffe has two methods for self protection. The colour helps it hide in wildlife. If something frightens an adult giraffe, it can gallop away at about fifty kilometers perhour or stay and figh with its strong legs.</p>', '<p>One of the most interesting animals we saw in the zoo is a giraffe. It is a male and about six meterstall. its bigbro'),
(15, '<p><strong>Exhibition</strong></p><p>One of the most enchanting aspects of Indonesia&#39;s culture, batik, gained a momentum after UNESCO (1) ... it as part of world&#39;s intangible cultural heritage in 2009. Enthusiats will have a chance to enjoy an exhibition titled &quot;Indonesia Batik: A living Heritage&quot;.</p><p>Expect to see the Journey of Batik within Indonesia by getting information about the production process as well as guidance on how to interpret its rich symbols and (2)...</p><p>The exhibition will be held at the National Gallery (3).... Jl. Medan Merdeka Timur No. 14, Centeral Jakarta From January 25th to February 26th.</p>', '<p><strong>Exhibition</strong></p><p>One of the most enchanting aspects of Indonesia&#39;s culture, batik, gained a mome'),
(16, '<ol><li>Coffee</li><li>tea</li><li>and</li><li>offers</li><li>of</li><li>the coffee shop</li><li>a variety</li></ol>', '<ol><li>Coffee</li><li>tea</li><li>and</li><li>offers</li><li>of</li><li>the coffee shop</li><li>a variety</li></ol>'),
(17, '<p>(1)Kebiasaan mengemil pada malam hari berdampak negatif bagi kesehatan. (2) Sebuah hasil penelitian yang teracantum dalam jurnal internasional Obeisity menegaskan bahwa mengemil pada malam hari cenderung memicu seseorang makan dan mengosumsi kalori berlebihan.(3) Dampak Negatif selanjutnya aadalah ia akan mengalami kelebihan berat badan. (4) Banyak orang yang menyukai makan malam pada pukul 20.00 (5) Oleh karena itu, sebaiknya ia dadpat mengontrol waktu mengemil, mengurangi gorengan, dan mengosumsi buah-buahan</p>', '<p>(1)Kebiasaan mengemil pada malam hari berdampak negatif bagi kesehatan. (2) Sebuah hasil penelitian yang teracantum d'),
(18, '<p>Kemarahan adalah suatu bentuk emosi yang sulit dihidnari karena beberapa alasan. Anda mungkin tumbuh dalam suatu keluarga yang mengekpresikan kemarahan dengan cara yang menyakitkan, agresif, atau kasar. ANda mungkin berada di lingkunngan yang biasa menekan atau menyembunikan kemarahan.</p><p>Banyak di antara kita merasa marah, teapi tidak tahu apa yang harus dilakukan untuk menghadapi kemarah ntersebut. ANda mungkin malah merasa penuh dengan amarah. atau anda mengekspresikan kemarahan dengan meluapkannya, menjerit,atau mnyakiti mereka&nbsp;yang dekat dengan anda.</p>', '<p>Kemarahan adalah suatu bentuk emosi yang sulit dihidnari karena beberapa alasan. Anda mungkin tumbuh dalam suatu kelu'),
(19, '<p>Syahdan beberapa lamanya, ia berjalan, maka bertemu dengan gunung yang tinggi-tinggi dan padang yang luas-luas, dan tasik yang berombak seperti lain, tempat segala dewa-dewaw, peri mambang Indera Candara Jin, Maka raja-raja jin disanalah tempat bermain lancang, berlomba-lomba. disanalah ia banyak beroleh kesaktian, dberi oleh segala anak raja-raja itu, diangkat saudara oleh merka itu sekali akan dia darn beebrapa ia bertemu dengan binatang yang buas-buas, seperti ular naga buat araksasa. Sekalianyaa mereka itummberikan kesaktian kepada Mara karmah</p>', '<p>Syahdan beberapa lamanya, ia berjalan, maka bertemu dengan gunung yang tinggi-tinggi dan padang yang luas-luas, dan t'),
(20, '<p>Sampai suatu hari Ditam bertemu Badul dalam sebuah jamuan pernikahan. Keduanya dijodoh-jodohkan oleh para gadis remaja. Demikianlah, akhirnya Badul berani bertandang ke rumah Ditam. dan merasakan geta-getar yang telah mengganggu tidurnya. semula agak canggung bagi Badul, tapi seterusnya ia berani menyatakan untuk hidup semati degan Ditam.</p><p>Ditam perempuan di atas dua puluh lima tahun. sudah dianggap tua di dusun itu. pun begitu dengan Badul, perjaka yang dikenal alim dan pekerja keras. keduanya beda pengalaman. Badul tak menamtkan sekolah tingkat atas, tak ada biaya. biasanya laki-laki dikampungnya menamatkan sekolah hingga tingkat menengah. itupun tidak banyak. selebihya tamat sekolah dasar, langsung mencari pekerjaan apa saja, yang penting bisa mendapatkan uang, BegitulahBadul, akhirnya ia menjadi kuli bangunan</p>', '<p>Sampai suatu hari Ditam bertemu Badul dalam sebuah jamuan pernikahan. Keduanya dijodoh-jodohkan oleh para gadis remaj'),
(21, '<p>Matahari ...., baru sepenggalan. Sinarnya yang keemasana membuat suasana sangat cerah. Angin segar bertiup sepoi-sepoi menggerak-gerakkan daun pepohonan. Burung-burung pun berkicau riang. Tampaknya.... .</p>', '<p>Matahari ...., baru sepenggalan. Sinarnya yang keemasana membuat suasana sangat cerah. Angin segar bertiup sepoi-sepo'),
(22, '<ol><li>Rendi membeli jam Rolex di mall terkenal di Jakarta</li><li>Mega memilih mobil keluaran terbaru</li><li>keluarga Bapak Andi keliling Asia dengan menggunakan kapal pesiar</li><li>Rini bermain piano mengirngi ayahnya bernyanyi di pentas musik</li><li>Bapak Joko membeli rumah dengan desain minimalis</li></ol>', '<ol><li>Rendi membeli jam Rolex di mall terkenal di Jakarta</li><li>Mega memilih mobil keluaran terbaru</li><li>keluarga'),
(23, '<p>Jenis Peta:</p><ol><li>Peta Curah Hujan</li><li>Peta Geologi</li><li>Peta Topologi</li><li>Peta Jenis Tanah</li><li>Peta Jenis Tanaman</li></ol>', '<p>Jenis Peta:</p><ol><li>Peta Curah Hujan</li><li>Peta Geologi</li><li>Peta Topologi</li><li>Peta Jenis Tanah</li><li>P'),
(24, '<p>Perhatikan pernyataan berikut!</p><ol><li>Bersifat terbuka mau menerima pendapat dari kelompok lain tanpa memandang suku bangsa, agama, ras atau aliran</li><li>membentuk kelompok usaha dangan dengan keanggotaan lintas-etnis, lintas-agama, lintas-ras dan aliran</li><li>Memberikan perlakuan istimewa kepada orang-orang yang berlatar belakang agama atau suku bangsa yang sama dengan dirinya</li><li>Memilih calon pemimpin kepala daerah berdasarkan latar belakang kedaerahan yang sama</li><li>Membentuk partai politik berbasis agama atau aliran tertentu</li></ol>', '<p>Perhatikan pernyataan berikut!</p><ol><li>Bersifat terbuka mau menerima pendapat dari kelompok lain tanpa memandang s');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_gambar`
--

CREATE TABLE IF NOT EXISTS `soal_gambar` (
  `id_soal_gambar` int(3) NOT NULL AUTO_INCREMENT,
  `soal_gambar` varchar(120) NOT NULL,
  PRIMARY KEY (`id_soal_gambar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `soal_gambar`
--

INSERT INTO `soal_gambar` (`id_soal_gambar`, `soal_gambar`) VALUES
(3, 'gambar/1453764918.png'),
(4, 'gambar/1453792045.PNG'),
(5, 'gambar/1453794841.PNG'),
(6, 'gambar/1453794953.PNG'),
(7, 'gambar/1453795057.PNG'),
(8, 'gambar/1453796099.PNG'),
(9, 'gambar/1453796104.PNG'),
(10, 'gambar/1453796111.PNG'),
(11, 'gambar/1453796117.PNG'),
(12, 'gambar/1453796123.PNG'),
(13, 'gambar/1453799817.PNG'),
(14, 'gambar/1453799937.PNG'),
(15, 'gambar/1453800200.PNG'),
(16, 'gambar/1453800204.PNG'),
(17, 'gambar/1453800208.PNG'),
(18, 'gambar/1453800212.PNG'),
(19, 'gambar/1453800216.PNG'),
(20, 'gambar/1453800221.PNG'),
(21, 'gambar/1453805441.PNG'),
(22, 'gambar/1453805777.PNG'),
(23, 'gambar/1453805904.PNG'),
(24, 'gambar/1453806408.PNG'),
(25, 'gambar/1453807250.PNG'),
(26, 'gambar/1453807358.PNG'),
(27, 'gambar/1453810289.PNG'),
(28, 'gambar/1453810573.PNG'),
(29, 'gambar/1453812027.PNG'),
(30, 'gambar/1453812512.PNG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_pelajaran`
--

CREATE TABLE IF NOT EXISTS `soal_pelajaran` (
  `id_soal_pelajaran` int(3) NOT NULL AUTO_INCREMENT,
  `id_paket_pelajaran` int(4) NOT NULL,
  `penulis` int(3) NOT NULL,
  `tgl_input` date NOT NULL,
  `untuk` enum('latihan','ujian') NOT NULL,
  `lihat` date NOT NULL,
  PRIMARY KEY (`id_soal_pelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `soal_pelajaran`
--

INSERT INTO `soal_pelajaran` (`id_soal_pelajaran`, `id_paket_pelajaran`, `penulis`, `tgl_input`, `untuk`, `lihat`) VALUES
(11, 34, 5, '2016-01-26', 'ujian', '0000-00-00'),
(12, 35, 1, '2016-01-26', 'ujian', '0000-00-00'),
(13, 37, 8, '2016-01-26', 'ujian', '0000-00-00'),
(14, 38, 1, '2016-01-26', 'ujian', '0000-00-00'),
(15, 40, 1, '2016-01-26', 'ujian', '0000-00-00'),
(16, 39, 1, '2016-01-26', 'ujian', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE IF NOT EXISTS `ujian` (
  `id_ujian` int(3) NOT NULL AUTO_INCREMENT,
  `id_jadwal_ujian` int(3) NOT NULL,
  `id_soal_pelajaran` int(3) NOT NULL,
  `banyak_soal` int(3) NOT NULL,
  `waktu` varchar(3) NOT NULL,
  `jadwal_ujian` datetime NOT NULL,
  `diujikan` enum('0','1') NOT NULL,
  `lihat` date NOT NULL,
  PRIMARY KEY (`id_ujian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `id_jadwal_ujian`, `id_soal_pelajaran`, `banyak_soal`, `waktu`, `jadwal_ujian`, `diujikan`, `lihat`) VALUES
(12, 6, 12, 15, '90', '2016-01-28 12:00:00', '0', '2016-01-26'),
(13, 6, 16, 10, '90', '2016-01-29 14:00:00', '0', '2016-01-26'),
(14, 6, 13, 15, '90', '2016-01-30 12:00:00', '0', '2016-01-26'),
(15, 6, 14, 20, '90', '2016-01-30 14:21:00', '0', '2016-01-26'),
(16, 6, 11, 30, '90', '2016-01-31 14:23:00', '0', '2016-01-26'),
(17, 6, 15, 20, '90', '2016-01-31 12:00:00', '0', '2016-01-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian_jadwal`
--

CREATE TABLE IF NOT EXISTS `ujian_jadwal` (
  `id_jadwal_ujian` int(3) NOT NULL AUTO_INCREMENT,
  `jadwal_ujian` varchar(25) NOT NULL,
  `tgl_awal` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  PRIMARY KEY (`id_jadwal_ujian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `ujian_jadwal`
--

INSERT INTO `ujian_jadwal` (`id_jadwal_ujian`, `jadwal_ujian`, `tgl_awal`, `tgl_akhir`) VALUES
(6, 'UTS', '2016-01-28 00:00:00', '2016-01-31 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
