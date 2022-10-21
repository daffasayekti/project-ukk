-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2022 pada 01.53
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_ukk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'Side Administration'),
(2, 'User', 'Regular User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Daffa Pratama', NULL, '2022-09-04 10:06:11', 0),
(2, '::1', 'daffasayekti0206@gmail.com', 3, '2022-09-04 10:19:05', 1),
(3, '::1', 'daffasayekti0206@gmail.com', 3, '2022-09-04 10:21:55', 1),
(4, '::1', 'daffasayekti0206@gmail.com', 3, '2022-09-04 10:28:04', 1),
(5, '::1', 'daffasayekti0206@gmail.com', 3, '2022-09-04 10:35:00', 1),
(6, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 10:45:40', 1),
(7, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 18:25:34', 1),
(8, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 18:36:42', 1),
(9, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 18:37:11', 1),
(10, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:18:14', 1),
(11, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:30:16', 1),
(12, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:30:41', 1),
(13, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:31:05', 1),
(14, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:31:10', 1),
(15, '::1', 'daffasayekti0206@gma', NULL, '2022-09-04 19:32:33', 0),
(16, '::1', 'daffasayekti0206@gmail.com', NULL, '2022-09-04 19:33:33', 0),
(17, '::1', 'daffasayekti0206@gmail.com', NULL, '2022-09-04 19:33:38', 0),
(18, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:37:07', 1),
(19, '::1', 'daffasayekti0206@gm', NULL, '2022-09-04 19:37:16', 0),
(20, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:38:08', 1),
(21, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:42:15', 1),
(22, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:44:23', 1),
(23, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:44:34', 1),
(24, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:44:45', 1),
(25, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 19:45:49', 1),
(26, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:06:14', 1),
(27, '::1', 'phpngab@gmail.com', NULL, '2022-09-04 20:12:16', 0),
(28, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:12:19', 1),
(29, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:37:00', 1),
(30, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:37:55', 1),
(31, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:40:36', 1),
(32, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:40:58', 1),
(33, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:41:01', 1),
(34, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:41:02', 1),
(35, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:41:04', 1),
(36, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:41:05', 1),
(37, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:47:22', 1),
(38, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:48:51', 1),
(39, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:51:21', 1),
(40, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:56:16', 1),
(41, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 20:56:53', 1),
(42, '::1', 'daffasayekti0206@gail.com', NULL, '2022-09-04 20:57:21', 0),
(43, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 21:22:29', 1),
(44, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 21:22:52', 1),
(45, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 21:32:59', 1),
(46, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-04 21:39:06', 1),
(47, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-06 19:02:08', 1),
(48, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-06 19:02:35', 1),
(49, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-06 19:02:36', 1),
(50, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-13 19:49:17', 1),
(51, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-13 19:49:37', 1),
(52, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-13 23:53:40', 1),
(53, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-14 01:41:18', 1),
(54, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-14 01:42:05', 1),
(55, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-14 01:58:02', 1),
(56, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-14 02:00:52', 1),
(57, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-14 02:02:00', 1),
(58, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-14 02:03:10', 1),
(59, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-16 04:31:44', 1),
(60, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-16 05:12:38', 1),
(61, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-16 05:31:50', 1),
(62, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-17 08:10:23', 1),
(63, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-17 17:48:46', 1),
(64, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-20 06:31:48', 1),
(65, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-20 18:51:00', 1),
(66, '::1', 'daffasayekti0206@gmail.com', 4, '2022-09-23 17:51:36', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-user', 'manage-all-users'),
(2, 'manage-post-users', 'manage-all-post-users');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`) VALUES
(43, '0b33e04024ce41305ae3adb5', '87f373e7e803dd2f51ffc5e59a13d577650797702a881f296303134e4557d0bf', 4, '2022-10-20 18:51:00'),
(44, '428fc07dd6114fabc4861166', '8c597f3ff26e5a75b9c77e387e410ff7fb13c416fff3feaec5ab9cca6d558b17', 4, '2022-10-23 17:51:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_akun`
--

CREATE TABLE `jenis_akun` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis_akun`
--

INSERT INTO `jenis_akun` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Free'),
(2, 'Premium');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_langganan`
--

CREATE TABLE `jenis_langganan` (
  `id_langganan` int(11) NOT NULL,
  `jenis_langganan` varchar(50) NOT NULL,
  `harga_langganan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis_langganan`
--

INSERT INTO `jenis_langganan` (`id_langganan`, `jenis_langganan`, `harga_langganan`) VALUES
(1, '1 Bulan', 12000),
(2, '2 Bulan', 24000),
(3, '4 Bulan', 45000),
(4, '12 Bulan ', 130000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori_berita`
--

INSERT INTO `kategori_berita` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Kecelakaan'),
(2, 'Ekonomi'),
(3, 'Politik'),
(4, 'Olahraga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1662080125, 1),
(2, '2022-08-26-012921', 'App\\Database\\Migrations\\tb_berita', 'default', 'App', 1662080125, 1),
(3, '2022-08-26-013819', 'App\\Database\\Migrations\\kategori_berita', 'default', 'App', 1662080125, 1),
(4, '2022-08-26-020947', 'App\\Database\\Migrations\\tb_komentar', 'default', 'App', 1662080126, 1),
(5, '2022-08-26-021721', 'App\\Database\\Migrations\\tb_bank', 'default', 'App', 1662080126, 1),
(6, '2022-09-01-040254', 'App\\Database\\Migrations\\tb_pembayaran', 'default', 'App', 1662080126, 1),
(7, '2022-09-01-041428', 'App\\Database\\Migrations\\tb_invoice', 'default', 'App', 1662080126, 1),
(8, '2022-09-01-043040', 'App\\Database\\Migrations\\jenis_langganan', 'default', 'App', 1662080126, 1),
(9, '2022-09-01-043516', 'App\\Database\\Migrations\\jenis_akun', 'default', 'App', 1662080126, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(10) NOT NULL,
  `no_rekening` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(70) NOT NULL,
  `slug` varchar(70) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `isi_berita` text NOT NULL,
  `gambar_berita` varchar(40) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_update` datetime NOT NULL,
  `banyak_dilihat` int(11) NOT NULL DEFAULT 0,
  `status_berita` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul_berita`, `slug`, `created_by`, `kategori_id`, `isi_berita`, `gambar_berita`, `tanggal_buat`, `tanggal_update`, `banyak_dilihat`, `status_berita`) VALUES
(1, 'Kabar Terkini Tabrakan Beruntun 17 Mobil di Tol Cipularang KM 92', 'kabar-terkini-tabrakan-beruntun-17-mobil-di-tol-cipularang-km-92', 'Daffa Sayekti', 1, '<div>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa sed deserunt, esse exercitationem corrupti odit qui, dolores temporibus quae dolorum ducimus voluptatem, quis praesentium impedit. Consequuntur libero soluta cupiditate ea dolorem atque velit, tempore earum explicabo tempora perferendis sequi delectus fugiat? Eligendi laboriosam quo, nemo maiores inventore ex nostrum fugiat hic maxime, laborum, laudantium voluptates. Molestiae numquam quos corporis ut maxime voluptates, deserunt, culpa perferendis velit amet aliquam aperiam adipisci recusandae, nam eum suscipit atque.&nbsp;</div><div><br></div><div>Praesentium animi provident iure vel, sapiente dolorum ducimus quis incidunt amet saepe aut aperiam molestiae! Necessitatibus magnam vitae a dolor id nobis praesentium consectetur tenetur fugit quae nesciunt quia, earum eos quasi veritatis recusandae enim consequuntur, quos aliquid natus dolorem excepturi libero beatae aperiam! Natus error, omnis iste et, eius eveniet eum tempore saepe hic debitis porro esse. Maxime inventore rem a nobis repudiandae est harum saepe placeat eligendi molestiae, quibusdam accusamus reprehenderit vel quod, tenetur eum nihil ipsa laborum dignissimos qui reiciendis esse fuga eius! Eius porro dolores perferendis tempora possimus soluta quos labore delectus quas fugit? Error ipsum nihil id, aut dignissimos incidunt molestias dolore illum nesciunt placeat repellendus delectus sapiente explicabo voluptate? Assumenda repellendus quaerat, veritatis voluptatibus explicabo doloremque praesentium ipsum dolorum est debitis voluptatem commodi veniam neque quisquam molestias deserunt atque eius expedita labore molestiae quam. Repellendus ipsum unde voluptate quia recusandae reiciendis vel animi sunt nihil beatae vero at voluptatum asperiores amet, velit harum fugit autem, incidunt quibusdam dolor soluta corporis magni eum.&nbsp;</div><div><br></div><div>Sed, animi. Rerum, odio. Illum enim quia ab? Assumenda quasi perferendis voluptatum nostrum nisi magnam ipsam similique! Adipisci id, ipsa, quam reprehenderit sapiente totam officia expedita cupiditate nemo velit repudiandae doloremque illum eligendi aperiam aut, vero natus fuga sequi error optio. Sequi magni facere recusandae aliquid delectus ducimus vel, modi quibusdam atque ipsum sint? Eveniet, ratione mollitia.</div>', 'home_4.jpg', '2022-09-02 13:17:33', '2022-09-02 13:17:33', 0, 0),
(2, 'Kecelakaan Beruntun di Tol Porong, Satu Orang Meninggal Dunia', 'kecelakaan-beruntun-di-tol-porong-satu-orang-meninggal-dunia', 'Daffa Sayekti', 1, '<div>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa sed deserunt, esse exercitationem corrupti odit qui, dolores temporibus quae dolorum ducimus voluptatem, quis praesentium impedit. Consequuntur libero soluta cupiditate ea dolorem atque velit, tempore earum explicabo tempora perferendis sequi delectus fugiat? Eligendi laboriosam quo, nemo maiores inventore ex nostrum fugiat hic maxime, laborum, laudantium voluptates. Molestiae numquam quos corporis ut maxime voluptates, deserunt, culpa perferendis velit amet aliquam aperiam adipisci recusandae, nam eum suscipit atque.&nbsp;<br><br>Praesentium animi provident iure vel, sapiente dolorum ducimus quis incidunt amet saepe aut aperiam molestiae! Necessitatibus magnam vitae a dolor id nobis praesentium consectetur tenetur fugit quae nesciunt quia, earum eos quasi veritatis recusandae enim consequuntur, quos aliquid natus dolorem excepturi libero beatae aperiam! Natus error, omnis iste et, eius eveniet eum tempore saepe hic debitis porro esse. Maxime inventore rem a nobis repudiandae est harum saepe placeat eligendi molestiae, quibusdam accusamus reprehenderit vel quod, tenetur eum nihil ipsa laborum dignissimos qui reiciendis esse fuga eius! Eius porro dolores perferendis tempora possimus soluta quos labore delectus quas fugit? Error ipsum nihil id, aut dignissimos incidunt molestias dolore illum nesciunt placeat repellendus delectus sapiente explicabo voluptate? Assumenda repellendus quaerat, veritatis voluptatibus explicabo doloremque praesentium ipsum dolorum est debitis voluptatem commodi veniam neque quisquam molestias deserunt atque eius expedita labore molestiae quam. Repellendus ipsum unde voluptate quia recusandae reiciendis vel animi sunt nihil beatae vero at voluptatum asperiores amet, velit harum fugit autem, incidunt quibusdam dolor soluta corporis magni eum.&nbsp;<br><br>Sed, animi. Rerum, odio. Illum enim quia ab? Assumenda quasi perferendis voluptatum nostrum nisi magnam ipsam similique! Adipisci id, ipsa, quam reprehenderit sapiente totam officia expedita cupiditate nemo velit repudiandae doloremque illum eligendi aperiam aut, vero natus fuga sequi error optio. Sequi magni facere recusandae aliquid delectus ducimus vel, modi quibusdam atque ipsum sint? Eveniet, ratione mollitia.</div>', 'home_5.jpg', '2022-09-02 13:22:20', '2022-09-02 13:22:20', 0, 0),
(3, 'Satu Keluarga Tewas di Tempat Usai Motornya Dihantam Mobil', 'satu-keluarga-tewas-di-tempat-usai-motornya-dihantam-mobil', 'Daffa Sayekti', 1, '<div>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa sed deserunt, esse exercitationem corrupti odit qui, dolores temporibus quae dolorum ducimus voluptatem, quis praesentium impedit. Consequuntur libero soluta cupiditate ea dolorem atque velit, tempore earum explicabo tempora perferendis sequi delectus fugiat? Eligendi laboriosam quo, nemo maiores inventore ex nostrum fugiat hic maxime, laborum, laudantium voluptates. Molestiae numquam quos corporis ut maxime voluptates, deserunt, culpa perferendis velit amet aliquam aperiam adipisci recusandae, nam eum suscipit atque.&nbsp;<br><br>Praesentium animi provident iure vel, sapiente dolorum ducimus quis incidunt amet saepe aut aperiam molestiae! Necessitatibus magnam vitae a dolor id nobis praesentium consectetur tenetur fugit quae nesciunt quia, earum eos quasi veritatis recusandae enim consequuntur, quos aliquid natus dolorem excepturi libero beatae aperiam! Natus error, omnis iste et, eius eveniet eum tempore saepe hic debitis porro esse. Maxime inventore rem a nobis repudiandae est harum saepe placeat eligendi molestiae, quibusdam accusamus reprehenderit vel quod, tenetur eum nihil ipsa laborum dignissimos qui reiciendis esse fuga eius! Eius porro dolores perferendis tempora possimus soluta quos labore delectus quas fugit? Error ipsum nihil id, aut dignissimos incidunt molestias dolore illum nesciunt placeat repellendus delectus sapiente explicabo voluptate? Assumenda repellendus quaerat, veritatis voluptatibus explicabo doloremque praesentium ipsum dolorum est debitis voluptatem commodi veniam neque quisquam molestias deserunt atque eius expedita labore molestiae quam. Repellendus ipsum unde voluptate quia recusandae reiciendis vel animi sunt nihil beatae vero at voluptatum asperiores amet, velit harum fugit autem, incidunt quibusdam dolor soluta corporis magni eum.&nbsp;<br><br>Sed, animi. Rerum, odio. Illum enim quia ab? Assumenda quasi perferendis voluptatum nostrum nisi magnam ipsam similique! Adipisci id, ipsa, quam reprehenderit sapiente totam officia expedita cupiditate nemo velit repudiandae doloremque illum eligendi aperiam aut, vero natus fuga sequi error optio. Sequi magni facere recusandae aliquid delectus ducimus vel, modi quibusdam atque ipsum sint? Eveniet, ratione mollitia.</div>', 'home_6.jpg', '2022-09-02 13:23:00', '2022-09-02 13:23:00', 0, 0),
(4, 'Asa Nenek Nur Si Pemungut Ceceran Beras', 'asa-nenek-nur-si-pemungut-ceceran-beras', 'Daffa Sayekti', 2, '<div>Daffa Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro iste fugit quia animi corporis explicabo accusantium illo, saepe voluptatibus delectus harum? Nesciunt dolorum necessitatibus praesentium doloremque. Eaque id vero, accusantium quis molestias aspernatur voluptates, consequatur officiis tenetur architecto voluptate! Distinctio perferendis at ratione labore reprehenderit, vel minima sapiente ut voluptas, officiis suscipit, maiores ex quod totam voluptatibus laboriosam. Adipisci illum labore, quidem sapiente quae quas atque molestiae doloremque, debitis error itaque delectus libero dolorem voluptatum deserunt corporis ad aliquid fugiat explicabo natus consectetur, ea laborum commodi quam! Sunt nobis dolor, iusto ducimus est similique tenetur.&nbsp;<br><br>Omnis veritatis adipisci fugiat! Hic culpa officia nostrum voluptate magni necessitatibus inventore aperiam. Quia officia porro quasi sit nobis, quas numquam ad placeat cum labore vero accusamus odio pariatur, dolor similique perspiciatis voluptates dignissimos. Qui unde ratione neque eligendi nostrum eius eos consectetur quibusdam, quaerat voluptatum! Laborum, voluptatem nisi amet nihil dolores assumenda maxime quos at obcaecati sapiente! Enim amet saepe esse a exercitationem earum repudiandae vitae omnis. Natus quaerat quia, mollitia suscipit provident quidem officiis animi enim eius, magnam sunt voluptatibus vitae voluptate numquam eaque assumenda facere, veniam optio. Ullam deleniti laborum iure fugit sed ipsam eaque nihil pariatur facere. Recusandae voluptates incidunt repellat ipsum tenetur quos ea iusto, vero ducimus harum, tempora explicabo quas alias maxime, repellendus ullam unde velit! Ullam sequi quod, ex aperiam amet soluta! Hic similique quaerat ipsam voluptates animi culpa.<br><br>Aliquid illo minima! Nostrum libero vitae ab ad deserunt rerum sequi facilis, ratione ipsum cumque saepe hic magni esse ullam fugit laboriosam fugiat eum exercitationem provident repudiandae itaque. Vitae a recusandae hic quae dolores reprehenderit inventore libero. Consequatur enim alias soluta ea deserunt animi commodi id error doloribus, accusamus, quisquam natus! Nisi libero, eligendi animi architecto tempore, nobis sit voluptatibus alias eius quia ut, exercitationem facere ex impedit.</div>', 'home_1.jpg', '2022-09-02 13:26:39', '2022-09-02 13:26:39', 0, 0),
(5, 'Rupiah Terus Melemah, Keluarga Miskin Rentan Terpukul Inflasi', 'rupiah-terus-melemah-keluarga-miskin-rentan-terpukul-inflasi', 'Daffa Sayekti', 2, '<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro iste fugit quia animi corporis explicabo accusantium illo, saepe voluptatibus delectus harum? Nesciunt dolorum necessitatibus praesentium doloremque. Eaque id vero, accusantium quis molestias aspernatur voluptates, consequatur officiis tenetur architecto voluptate! Distinctio perferendis at ratione labore reprehenderit, vel minima sapiente ut voluptas, officiis suscipit, maiores ex quod totam voluptatibus laboriosam. Adipisci illum labore, quidem sapiente quae quas atque molestiae doloremque, debitis error itaque delectus libero dolorem voluptatum deserunt corporis ad aliquid fugiat explicabo natus consectetur, ea laborum commodi quam! Sunt nobis dolor, iusto ducimus est similique tenetur.&nbsp;<br><br>Omnis veritatis adipisci fugiat! Hic culpa officia nostrum voluptate magni necessitatibus inventore aperiam. Quia officia porro quasi sit nobis, quas numquam ad placeat cum labore vero accusamus odio pariatur, dolor similique perspiciatis voluptates dignissimos. Qui unde ratione neque eligendi nostrum eius eos consectetur quibusdam, quaerat voluptatum! Laborum, voluptatem nisi amet nihil dolores assumenda maxime quos at obcaecati sapiente! Enim amet saepe esse a exercitationem earum repudiandae vitae omnis. Natus quaerat quia, mollitia suscipit provident quidem officiis animi enim eius, magnam sunt voluptatibus vitae voluptate numquam eaque assumenda facere, veniam optio. Ullam deleniti laborum iure fugit sed ipsam eaque nihil pariatur facere. Recusandae voluptates incidunt repellat ipsum tenetur quos ea iusto, vero ducimus harum, tempora explicabo quas alias maxime, repellendus ullam unde velit! Ullam sequi quod, ex aperiam amet soluta! Hic similique quaerat ipsam voluptates animi culpa.<br><br>Aliquid illo minima! Nostrum libero vitae ab ad deserunt rerum sequi facilis, ratione ipsum cumque saepe hic magni esse ullam fugit laboriosam fugiat eum exercitationem provident repudiandae itaque. Vitae a recusandae hic quae dolores reprehenderit inventore libero. Consequatur enim alias soluta ea deserunt animi commodi id error doloribus, accusamus, quisquam natus! Nisi libero, eligendi animi architecto tempore, nobis sit voluptatibus alias eius quia ut, exercitationem facere ex impedit.</div>', 'home_2.jpg', '2022-09-02 13:27:44', '2022-09-02 13:27:44', 0, 0),
(6, 'BBM Subsidi Dinikmati si Kaya, Jatah Orang Miskin Berkurang', 'bbm-subsidi-dinikmati-si-kaya-jatah-orang-miskin-berkurang', 'Daffa Sayekti', 2, '<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro iste fugit quia animi corporis explicabo accusantium illo, saepe voluptatibus delectus harum? Nesciunt dolorum necessitatibus praesentium doloremque. Eaque id vero, accusantium quis molestias aspernatur voluptates, consequatur officiis tenetur architecto voluptate! Distinctio perferendis at ratione labore reprehenderit, vel minima sapiente ut voluptas, officiis suscipit, maiores ex quod totam voluptatibus laboriosam. Adipisci illum labore, quidem sapiente quae quas atque molestiae doloremque, debitis error itaque delectus libero dolorem voluptatum deserunt corporis ad aliquid fugiat explicabo natus consectetur, ea laborum commodi quam! Sunt nobis dolor, iusto ducimus est similique tenetur.&nbsp;<br><br>Omnis veritatis adipisci fugiat! Hic culpa officia nostrum voluptate magni necessitatibus inventore aperiam. Quia officia porro quasi sit nobis, quas numquam ad placeat cum labore vero accusamus odio pariatur, dolor similique perspiciatis voluptates dignissimos. Qui unde ratione neque eligendi nostrum eius eos consectetur quibusdam, quaerat voluptatum! Laborum, voluptatem nisi amet nihil dolores assumenda maxime quos at obcaecati sapiente! Enim amet saepe esse a exercitationem earum repudiandae vitae omnis. Natus quaerat quia, mollitia suscipit provident quidem officiis animi enim eius, magnam sunt voluptatibus vitae voluptate numquam eaque assumenda facere, veniam optio. Ullam deleniti laborum iure fugit sed ipsam eaque nihil pariatur facere. Recusandae voluptates incidunt repellat ipsum tenetur quos ea iusto, vero ducimus harum, tempora explicabo quas alias maxime, repellendus ullam unde velit! Ullam sequi quod, ex aperiam amet soluta! Hic similique quaerat ipsam voluptates animi culpa.<br><br>Aliquid illo minima! Nostrum libero vitae ab ad deserunt rerum sequi facilis, ratione ipsum cumque saepe hic magni esse ullam fugit laboriosam fugiat eum exercitationem provident repudiandae itaque. Vitae a recusandae hic quae dolores reprehenderit inventore libero. Consequatur enim alias soluta ea deserunt animi commodi id error doloribus, accusamus, quisquam natus! Nisi libero, eligendi animi architecto tempore, nobis sit voluptatibus alias eius quia ut, exercitationem facere ex impedit.</div>', 'home_3.jpg', '2022-09-02 13:29:27', '2022-09-02 13:29:27', 0, 0),
(7, 'Partai Politik Menggelar Kampanye Di Jalan Raya', 'partai-politik-menggelar-kampanye-di-jalan-raya', 'Daffa Sayekti', 3, '<div>Daffa Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro iste fugit quia animi corporis explicabo accusantium illo, saepe voluptatibus delectus harum? Nesciunt dolorum necessitatibus praesentium doloremque. Eaque id vero, accusantium quis molestias aspernatur voluptates, consequatur officiis tenetur architecto voluptate! Distinctio perferendis at ratione labore reprehenderit, vel minima sapiente ut voluptas, officiis suscipit, maiores ex quod totam voluptatibus laboriosam. Adipisci illum labore, quidem sapiente quae quas atque molestiae doloremque, debitis error itaque delectus libero dolorem voluptatum deserunt corporis ad aliquid fugiat explicabo natus consectetur, ea laborum commodi quam! Sunt nobis dolor, iusto ducimus est similique tenetur.&nbsp;<br><br>Omnis veritatis adipisci fugiat! Hic culpa officia nostrum voluptate magni necessitatibus inventore aperiam. Quia officia porro quasi sit nobis, quas numquam ad placeat cum labore vero accusamus odio pariatur, dolor similique perspiciatis voluptates dignissimos. Qui unde ratione neque eligendi nostrum eius eos consectetur quibusdam, quaerat voluptatum! Laborum, voluptatem nisi amet nihil dolores assumenda maxime quos at obcaecati sapiente! Enim amet saepe esse a exercitationem earum repudiandae vitae omnis. Natus quaerat quia, mollitia suscipit provident quidem officiis animi enim eius, magnam sunt voluptatibus vitae voluptate numquam eaque assumenda facere, veniam optio. Ullam deleniti laborum iure fugit sed ipsam eaque nihil pariatur facere. Recusandae voluptates incidunt repellat ipsum tenetur quos ea iusto, vero ducimus harum, tempora explicabo quas alias maxime, repellendus ullam unde velit! Ullam sequi quod, ex aperiam amet soluta! Hic similique quaerat ipsam voluptates animi culpa.<br><br>Aliquid illo minima! Nostrum libero vitae ab ad deserunt rerum sequi facilis, ratione ipsum cumque saepe hic magni esse ullam fugit laboriosam fugiat eum exercitationem provident repudiandae itaque. Vitae a recusandae hic quae dolores reprehenderit inventore libero. Consequatur enim alias soluta ea deserunt animi commodi id error doloribus, accusamus, quisquam natus! Nisi libero, eligendi animi architecto tempore, nobis sit voluptatibus alias eius quia ut, exercitationem facere ex impedit.</div>', 'home_7.jpg', '2022-09-02 13:34:09', '2022-09-02 13:34:09', 0, 0),
(8, 'Demokrat Disarankan Genjot Elektabilitas Negara Indonesia', 'demokrat-disarankan-genjot-elektabilitas-negara-indonesia', 'Daffa Sayekti', 3, '<div>Bintang Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro iste fugit quia animi corporis explicabo accusantium illo, saepe voluptatibus delectus harum? Nesciunt dolorum necessitatibus praesentium doloremque. Eaque id vero, accusantium quis molestias aspernatur voluptates, consequatur officiis tenetur architecto voluptate! Distinctio perferendis at ratione labore reprehenderit, vel minima sapiente ut voluptas, officiis suscipit, maiores ex quod totam voluptatibus laboriosam. Adipisci illum labore, quidem sapiente quae quas atque molestiae doloremque, debitis error itaque delectus libero dolorem voluptatum deserunt corporis ad aliquid fugiat explicabo natus consectetur, ea laborum commodi quam! Sunt nobis dolor, iusto ducimus est similique tenetur.&nbsp;<br><br>Omnis veritatis adipisci fugiat! Hic culpa officia nostrum voluptate magni necessitatibus inventore aperiam. Quia officia porro quasi sit nobis, quas numquam ad placeat cum labore vero accusamus odio pariatur, dolor similique perspiciatis voluptates dignissimos. Qui unde ratione neque eligendi nostrum eius eos consectetur quibusdam, quaerat voluptatum! Laborum, voluptatem nisi amet nihil dolores assumenda maxime quos at obcaecati sapiente! Enim amet saepe esse a exercitationem earum repudiandae vitae omnis. Natus quaerat quia, mollitia suscipit provident quidem officiis animi enim eius, magnam sunt voluptatibus vitae voluptate numquam eaque assumenda facere, veniam optio. Ullam deleniti laborum iure fugit sed ipsam eaque nihil pariatur facere. Recusandae voluptates incidunt repellat ipsum tenetur quos ea iusto, vero ducimus harum, tempora explicabo quas alias maxime, repellendus ullam unde velit! Ullam sequi quod, ex aperiam amet soluta! Hic similique quaerat ipsam voluptates animi culpa.<br><br>Aliquid illo minima! Nostrum libero vitae ab ad deserunt rerum sequi facilis, ratione ipsum cumque saepe hic magni esse ullam fugit laboriosam fugiat eum exercitationem provident repudiandae itaque. Vitae a recusandae hic quae dolores reprehenderit inventore libero. Consequatur enim alias soluta ea deserunt animi commodi id error doloribus, accusamus, quisquam natus! Nisi libero, eligendi animi architecto tempore, nobis sit voluptatibus alias eius quia ut, exercitationem facere ex impedit.</div>', 'home_8.jpg', '2022-09-02 13:34:50', '2022-09-02 13:34:50', 0, 0),
(9, 'Partai Mendiang Shinzo Abe Menang di Pemilu Jepang', 'partai-mendiang-shinzo-abe-menang-di-pemilu-jepang', 'Daffa Sayekti', 3, '<div>Dimas Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit porro iste fugit quia animi corporis explicabo accusantium illo, saepe voluptatibus delectus harum? Nesciunt dolorum necessitatibus praesentium doloremque. Eaque id vero, accusantium quis molestias aspernatur voluptates, consequatur officiis tenetur architecto voluptate! Distinctio perferendis at ratione labore reprehenderit, vel minima sapiente ut voluptas, officiis suscipit, maiores ex quod totam voluptatibus laboriosam. Adipisci illum labore, quidem sapiente quae quas atque molestiae doloremque, debitis error itaque delectus libero dolorem voluptatum deserunt corporis ad aliquid fugiat explicabo natus consectetur, ea laborum commodi quam! Sunt nobis dolor, iusto ducimus est similique tenetur.&nbsp;<br><br>Omnis veritatis adipisci fugiat! Hic culpa officia nostrum voluptate magni necessitatibus inventore aperiam. Quia officia porro quasi sit nobis, quas numquam ad placeat cum labore vero accusamus odio pariatur, dolor similique perspiciatis voluptates dignissimos. Qui unde ratione neque eligendi nostrum eius eos consectetur quibusdam, quaerat voluptatum! Laborum, voluptatem nisi amet nihil dolores assumenda maxime quos at obcaecati sapiente! Enim amet saepe esse a exercitationem earum repudiandae vitae omnis. Natus quaerat quia, mollitia suscipit provident quidem officiis animi enim eius, magnam sunt voluptatibus vitae voluptate numquam eaque assumenda facere, veniam optio. Ullam deleniti laborum iure fugit sed ipsam eaque nihil pariatur facere. Recusandae voluptates incidunt repellat ipsum tenetur quos ea iusto, vero ducimus harum, tempora explicabo quas alias maxime, repellendus ullam unde velit! Ullam sequi quod, ex aperiam amet soluta! Hic similique quaerat ipsam voluptates animi culpa.<br><br>Aliquid illo minima! Nostrum libero vitae ab ad deserunt rerum sequi facilis, ratione ipsum cumque saepe hic magni esse ullam fugit laboriosam fugiat eum exercitationem provident repudiandae itaque. Vitae a recusandae hic quae dolores reprehenderit inventore libero. Consequatur enim alias soluta ea deserunt animi commodi id error doloribus, accusamus, quisquam natus! Nisi libero, eligendi animi architecto tempore, nobis sit voluptatibus alias eius quia ut, exercitationem facere ex impedit.</div>', 'home_9.jpg', '2022-09-02 13:35:48', '2022-09-02 13:35:48', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id_invoice` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id_komentar` int(11) NOT NULL,
  `berita_id` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_komentar`
--

INSERT INTO `tb_komentar` (`id_komentar`, `berita_id`, `created_by`, `isi_komentar`, `tanggal_komentar`) VALUES
(1, 3, 'Daffa Sayekti', 'Semoga Keluarga yang dtinggal dapat menerima takdir dengan ikhlas, dan semoga khusnul khotimah', '2022-09-02 13:37:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `langganan_id` int(11) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `status_pembayaran` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bank_user` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(90) DEFAULT NULL,
  `profile_img` varchar(40) NOT NULL DEFAULT 'default.png',
  `password_hash` varchar(255) NOT NULL,
  `jenis_akun_id` int(11) NOT NULL DEFAULT 1,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `profile_img`, `password_hash`, `jenis_akun_id`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'daffasayekti02106@gmail.com', 'Daffa Sayekti', 'Daffa Pratama Agung Sayekti', 'default.jpg', '27140e644cd59fb68484f8cc7de5a333', 1, NULL, '2022-09-02 13:16:02', '2022-09-02 13:16:02', NULL, NULL, NULL, 0, 0, '2022-09-02 13:16:02', '2022-09-02 13:16:02', '2022-09-02 13:16:02'),
(4, 'daffasayekti0206@gmail.com', 'Daffa Pratama ', NULL, '1657185725_9a74b45177b5b6244680.jpg', '$2y$10$ZFzNemcsBHFhRMhWPvDGRuT2pbCY3kxrePgdXwvDxv8Ah8glF/zrq', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-09-04 10:43:50', '2022-09-04 10:43:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `jenis_akun`
--
ALTER TABLE `jenis_akun`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `jenis_langganan`
--
ALTER TABLE `jenis_langganan`
  ADD PRIMARY KEY (`id_langganan`);

--
-- Indeks untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `pembayaran_id` (`pembayaran_id`);

--
-- Indeks untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `berita_id` (`berita_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `langganan_id` (`langganan_id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_ibfk_1` (`jenis_akun_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `jenis_akun`
--
ALTER TABLE `jenis_akun`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_langganan`
--
ALTER TABLE `jenis_langganan`
  MODIFY `id_langganan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD CONSTRAINT `tb_berita_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_berita` (`id_kategori`),
  ADD CONSTRAINT `tb_berita_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD CONSTRAINT `tb_invoice_ibfk_1` FOREIGN KEY (`pembayaran_id`) REFERENCES `tb_pembayaran` (`id_pembayaran`);

--
-- Ketidakleluasaan untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD CONSTRAINT `tb_komentar_ibfk_1` FOREIGN KEY (`berita_id`) REFERENCES `tb_berita` (`id_berita`),
  ADD CONSTRAINT `tb_komentar_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`langganan_id`) REFERENCES `jenis_langganan` (`id_langganan`),
  ADD CONSTRAINT `tb_pembayaran_ibfk_2` FOREIGN KEY (`bank_id`) REFERENCES `tb_bank` (`id_bank`),
  ADD CONSTRAINT `tb_pembayaran_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`jenis_akun_id`) REFERENCES `jenis_akun` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
