-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2025 pada 01.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampuss`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `count_views` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `title`, `description`, `image_path`, `publish_date`, `created_at`, `updated_at`, `deleted_at`, `author`, `tags`, `slug`, `count_views`) VALUES
(1, 'Wisuda Semester Ganjil 2024: 1.247 Mahasiswa Raih Gelar Sarjana', '<p>&nbsp;</p><p><strong>Universitas menggelar wisuda semester ganjil dengan total 1.247 lulusan dari berbagai fakultas. Acara berlangsung dengan protokol kesehatan yang ketat dan dihadiri oleh para</strong><br><br><br><i>Kami sampaikan hal-hal dalam rangka Pelakasanaan Ujian Tengah Semester (UTS) Semester Genap Tahun Akademik 2023/2024 di lingkungan Universitas Mercu Buana Yogyakarta.</i></p><p><i>Melalui surat edaran berikut.</i></p><p><i>1.Terkait Keuangan dan Pembayaran, Bisa diklik dilink dibawah :</i></p><p><a href=\"https://baa.mercubuana-yogya.ac.id/wp-content/uploads/2024/04/Surat-Edaran-Syarat-UTS-Semester-Genap-TA-2023-2024.pdf\"><i>Surat Edaran Syarat UTS Semester Genap TA 2023 2024</i></a></p><p><i>2. Terkait tentang ketentuan Mengikuti UTS (Cetak Kartu Ujian), Bisa diklik dilink dibawah ini :</i></p><p><a href=\"https://baa.mercubuana-yogya.ac.id/wp-content/uploads/2024/04/Pengumuman-Cetak-Kartu-UTS-Genap-TA-2023-2024.pdf\"><i>Pengumuman Cetak Kartu UTS Genap TA 2023-2024</i></a></p>', 'images/D3DGrk2NGBD7xXS3x1sRMEKJVv47mqpJIwwPxZmD.jpg', '2025-05-26', '2025-05-26 08:23:33', '2025-06-03 20:44:42', NULL, 'admin', 'akademik', 'wisuda-2024-1', 1),
(2, 'tyifyigyugyu', '<p>iohhuihuygyufytfuui</p>', 'images/NXrF27xtevd2vyouYUM8upY4IURjawFNoUJWlbAQ.png', '2025-05-25', '2025-05-26 08:45:57', '2025-06-03 20:44:52', NULL, 'admin', '', 'tyify-2025-1', 6),
(3, 'ihohuiguygyugyugyg', '<p>uighuighug</p>', 'images/wAxnPkFT6fFuDSSVmvI8Y6lXO9qDVbhbflpSlYGB.png', '2025-05-25', '2025-05-26 08:51:27', '2025-06-03 20:44:31', NULL, NULL, '', 'ihohu-2025-1', 1),
(4, 'Syarat KRS Semester Genap TA 2023/2024', '<p>Sesuai dengan Surat Wakil Ketua Pengurus Yayasan Wangsamanggala No. 37/F.01/A.I/II/2024 tanggal 05 Februari 2024 tentang kebijakan Kartu Rencana Studi (KRS) Semester Genap 2023/2024. Kami sampaikan hal-hal dalam rangka Pelaksanaan Kartu Rencana Studi (KRS) Semester Genap Tahun Akademik 2023/2024 di lingkungan Universitas Mercu Buana Yogyakarta sebagai berikut.</p><p><a href=\"https://baa.mercubuana-yogya.ac.id/2024/02/19/syarat-krs-semester-genap-ta-2023-2024/\">Syarat KRS Semester Genap TA 2023/2024</a></p>', 'images/AsSi4eiUIFn2vGFsY5VwQK3jcL2tae4Gd6A7I9AL.png', '2025-05-29', '2025-05-29 00:59:57', '2025-06-03 20:44:47', NULL, 'admin', '', 'ahmad-1', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('ahmadderi880@gmail.com|127.0.0.1', 'i:1;', 1748968915),
('ahmadderi880@gmail.com|127.0.0.1:timer', 'i:1748968915;', 1748968915);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `homepage_banner`
--

CREATE TABLE `homepage_banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `homepage_banner`
--

INSERT INTO `homepage_banner` (`id`, `title`, `description`, `image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Kampus Modern', 'Fasilitas terdepan untuk pendidikan berkualitas', 'images/homepage_banners/fZ4UjRnrkZrih7SP7jTPtg7bLvJmdAUbwb3xnnUc.jpg', '2025-05-26 04:32:10', '2025-05-26 04:48:27', NULL),
(3, 'Mahasiswa Berprestasi', 'Menghasilkan lulusan yang kompeten dan berkarakter', 'images/homepage_banners/8JOSRHwaVOZn7cq7lGvXtKF8tguOR8JaNEItQStm.jpg', '2025-05-26 04:49:16', '2025-05-26 04:49:16', NULL),
(4, 'Perpustakaan Digital', 'Akses ke ribuan koleksi buku dan jurnal', 'images/homepage_banners/Q8rX9LZ7UDhYrEpaqjzy0kuEJBux66pUMLEDqGzY.jpg', '2025-05-26 04:50:07', '2025-05-26 04:50:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `icon`, `jurusan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(11, 'images/jurusan/Q6SrMy82P8kqVVDzJN8I22uicJq4Cyo6lZKotooU.png', 'Ekonomi Pembangunan', 'Program studi yang fokus pada pengembangan kompetensi di bidang manajemen, akuntansi, dan ekonomi pembangunan.', '2025-06-03 07:48:41', '2025-06-03 20:29:03'),
(12, 'images/jurusan/3hWmyLMeg5puvMXs2TA113bYz0QhcHqfZoiZ7ufS.png', 'informatika', 'Menghasilkan insinyur berkualitas global dengan program studi teknik informatika, industri, mesin, dan sipil.', '2025-06-03 07:53:48', '2025-06-03 20:29:10'),
(13, 'images/jurusan/UdiXwjPFpbKKnI11zjrVsegMglTov2cByxH03QQc.png', 'Psikologi', 'Memahami perilaku dan proses mental manusia melalui kurikulum modern dan praktikum intensif.', '2025-06-03 20:29:40', '2025-06-03 20:29:40'),
(14, 'images/jurusan/HvUE5WVY0rIVPB30SqyiqqJW3YZzOqXYxdxVUZqR.png', 'Agroindustri', 'Inovasi dalam bidang pertanian, pangan, dan teknologi agroindustri untuk ketahanan pangan masa depan.', '2025-06-03 20:30:00', '2025-06-03 20:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_26_104441_create_homepage_banner_table', 2),
(5, '2025_05_26_151038_create_berita_table', 3),
(6, '2025_05_28_195259_add_slug_to_berita_table', 4),
(7, '2025_05_29_115336_add_count_views_tags_to_berita_table', 5),
(8, '2025_05_29_131547_add_indexes_to_berita_table', 6),
(9, '2025_06_03_133734_create_jurusan_table', 7),
(10, '2025_06_03_154028_add_profile_picture_to_users_table', 8),
(11, '2025_06_03_155549_add_deleted_at_to_users_table', 9),
(12, '2025_06_03_162827_add_role_to_users_table', 10),
(13, '2025_06_03_170344_create_settings_table', 11),
(14, '2025_06_04_040249_create_sambutan_rektor_table', 12),
(15, '2025_06_04_072201_create_sejarah_table', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('reizandid@gmail.com', '$2y$12$S64Epoxg4ChDtbbbyAJSQOWuMe7u13K2iYE.HLB7KHKwnO64Vhcs.', '2025-06-03 09:14:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sambutan_rektor`
--

CREATE TABLE `sambutan_rektor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sambutan_rektor`
--

INSERT INTO `sambutan_rektor` (`id`, `judul`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Sambutan Rektor', '<p><strong>Assalamu’alaikum Wr. Wb. Salam sejahtera untuk kita semua.&nbsp;</strong><br>Sebagai bukti Direktorat Jenderal Pendidikan Tinggi (Ditjen Dikti) telah menetapkan UMBY sebagai best practices (praktek terbaik) dalam implementasi Sistem Penjaminan Mutu Internal Perguruan Tinggi (SPMI-PT). UMBY telah menerapkan manajemen mutu pendidikan dengan ISO 9001:2015. Sistem Informasi Akademik di UMBY juga telah menerapkan sistem manajemen keamanan informasi dengan ISO 27001:2013. Semua dosen di UMBY berpendidikan S2 dan S3 dengan jabatan akademik lebih dari 60% Lektor, Lektor Kepala, Guru Besar dan bersertifikat pendidik Kementerian Pendidikan Nasional. Saat ini UMBY mempunyai 16 Program Studi, 13 Program Studi S1 dan 3 Program Studi S2 yang berada di bawah 6 Fakultas. Fakultas Agroindustri mempunyai 4 program studi yaitu : Agroteknologi, Peternakan, Teknologi Hasil Pertanian dan Magister Ilmu Pangan (S2). Fakultas Ekonomi mempunyai 2 program studi yaitu Manajemen dan Akuntansi. Fakultas Psikologi terdiri atas 3 program studi: Psikologi, Magister Profesi (S2) dan Magister Sain (S2). Fakultas Teknologi Informasi mempunyai 2 program studi : Sistem Informasi dan Informatika. Fakultas Keguruan dan Ilmu Pendidikan mempunyai 4 program studi : Pendidikan Matematika, Pendidikan Bahasa Inggris, Bimbingan Konseling dan Ilmu Keolahragaan. Fakultas Ilmu Komunikasi dan Multimedia dengan program studi Ilmu Komunikasi. Semua program studi yang ada di UMBY terakreditasi Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) yaitu sebanyak 7 program studi dengan peringkat A dan lainnya B serta Baik. Perpustakaan di UMBY juga telah terakreditasi dengan peringkat A. Pada Semester Gasal Tahun Akademik 2021/2022 UMBY Universitas Mercu Buana Yogyakarta telah memberlakukan Kurikulum Merdeka Belajar Kampus Merdeka (MBKM) berbasis Outcome Based Education (OBE) sesuai dengan Peraturan Menteri Pendidikan dan Kebudayaan Nomor 3 tahun 2020. MBKM menekankan pentingnya perluasan kebebasan bagi mahasiswa, selama menempuh proses pembelajaran di UMBY. Perluasan kebebasan tersebut adalah : perluasan pembelajaran dengan cara menempuh sejumlah mata kuliah di luar bidang studi utama dan perluasaan interaksi dengan berbagai pihak baik di dalam maupun di luar kampus. Pada bidang Penelitian, UMBY berada pada Klaster Utama yaitu berada pada peringkat 180 terbaik dari 1.977 Perguruan tinggi di Indonesia. Sedangkan untuk bidang Pengabdian kepada Masyarakat UMBY pada Klaster Sangat Bagus berada pada peringkat 96 dari 4.000 an perguruan di Indonesia. Hal ini membuktikan bahwa UMBY mampu mengemban misi para founding father yaitu Angudi Mulyaning Bangsa. Untuk meningkatkan soft skill mahasiswa dapat menyalurkan minat dan bakat dalam bidang penalaran, olahraga maupun bidang kerohanian di UMBY tersedia lembaga kemahasiswaan antara lain : Badan Eksekutif Mahasiswa Fakultas (BEMF), Himpunan Mahasiswa Program Studi (HMPS) dan Unit Kegiatan Mahasiswa (UKM). UKM yang tersedia antara lain: Menwa, Mahapala, KSR-PMI, Bulutangkis, Bola Volley, Basket, Futsal, Sepak Bola, Beladiri, Senthir, Paduan Suara Mahasiswa Nafiri, dan LPM Buana Pers. UKM bidang keagamaan antara lain : UKM Islam Jama’ah An Nahl dan UKM Talenta. Wassalamu’alaikum Wr. Wb.&nbsp;<br><br><br><strong>Rektor,</strong><br><br><strong>&nbsp;Dr. Agus Slamet, S.TP., M.P.</strong></p>', 'sambutanrektor/4vRsLH76OdM9bil0oOj3XUG4AUNQHwAhhbNpbEZO.png', '2025-06-03 21:21:18', '2025-06-04 00:16:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sejarah`
--

CREATE TABLE `sejarah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sejarah`
--

INSERT INTO `sejarah` (`id`, `judul`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'Sejarah', '<p><strong>Universitas Mercu Buana Yogyakarta</strong> (UMB Yogya) yang dahulu berdiri dengan nama IPW (Institut Pertanian Wangsa Manggala) pada tahun 1984, yang kemudian berubah nama menjadi Universitas Wangsa Manggala (UNWAMA) di tahun 1986 dan berubah nama menjadi Universitas Mercu Buana Yogyakarta pada tahun 2008.</p><p>Nama Universitas Wangsa Manggala (UNWAMA) lahir pada tanggal 1 Oktober 1986 di bawah naungan Yayasan Wangsa Manggala. Pada saat didirikan UNWAMA memiliki 3 fakultas dengan 4 jurusan, sebagai rektor adalah Prof. Ir. Gembong Tjitrorosoepomo (alm) Guru Besar Fakultas Biologi Universitas Gadjah Mada (UGM). Sebagai seorang akademisi yang berpengalaman, beliau telah meletakkan landasan yang kuat bagi berkembangnya UNWAMA.</p><p>Memasuki usia 7 tahun (tahun 1993) di bawah kepemimpinan Rektor Prof. Dr. Soelistyo, MBA (Guru Besar Fakultas Ekonomi UGM) UNWAMA melakukan pengembangan dengan menambah fakultas dan program studi baru, yaitu membuka Fakultas Psikologi dan membuka Program Studi Manajemen dan Program Studi Akuntansi (keduanya di bawah Fakultas Ekonomi). Mulai tahun 1996 di bawah Rektor Prof. Dr. Ir. Mochamad Adnan, MSc Guru Besar Fakultas Teknologi Pertanian dan juga mantan Rektor Universitas Gadjah Mada.</p><p>Yayasan memandang perlu untuk mengganti nama UNWAMA menjadi Universitas Mercu Buana Yogyakarta (UMB Yogya) pada Mei 2008 (SK Yayayasan, dan SK DIKTI tanggal 12 Juni 2008). Melalui SK Yayasan Wangsa Manggala Nomor : 02/SKep/Ket/YWM/IV/2008 tertanggal 1 April 2008 secara resmi Universitas Wangsa Manggala (UNWAMA) beralih nama menjadi Universitas Mercu Buana Yogyakarta (UMBY). Secara Resmi pada tanggal 12 Juni 2008 disyahkan dengan Surat Keputusan Menteri Pendidikan nasional Republik Indonesia Nomer : 102 /D/O/2008 Tentang Perubahan Nama Universitas Wangsa Manggala Yogyakarta menjadi universitas Mercu Buana Yogyakarta yang diselenggarakan oleh Yayasan Wangsa Manggala Yogyakarta.</p><p>UMB Yogya yang telah mendapat kepercayaan masyarakat berbenah diri dengan menata kinerjanya menyongsong era global pada milenium ketiga. Untuk mengantisipasi pesatnya perkembangan IPTEK maka pada tahun 2008 mulai dibuka Program Studi baru seperti : Teknik Informatika, Sistem Informasi, Ilmu Komunikasi, Pendidikan Bahasa Inggris dan Matematika. Program Studi ini semakin melengkapi Program Studi yang sudah ada sebelumnya yaitu : S2 Psikologi, Psikologi, Manajemen, Akuntansi, Agroteknologi (Agronomi), Industri Peternakan dan Teknologi Hasil Pertanian.</p><p>Visi yang ingin dicapai adalah menjadi universitas yang memiliki komitmen untuk mewujudkan kemajuan dan kesejahteraan masyarakat sesuai dengan cita-cita yang tertanam dalam seboyan Angudi Mulyaning Bangsa (The Pursuit of Excellence). Memiliki keunggulan dalam bidang pendidikan dan penajaran, penelitian serta pengabdian kepada masyarakatbaik tingkat nasional maupun internasional. Sedangkan misi UMB Yogya adalah melaksanakan Tri Dharma Perguruan Tinggi untuk mencerdaskan bangsa sehingga membantu masyarakat untuk mewujudkan kesejahteraannya.</p>', 'sejarah/xc2k5xVYiHY2Yybn0vepT9yDnacATpArrsmgOmap.png', '2025-06-04 01:01:05', '2025-06-04 01:01:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('l8o71o2wkL5j0FbacYGogLxkYe3eGeSAPUfhmNuP', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibXlGTHhvUXhITGY4MnNKZTNGNGxORFUwcFJnRVk5Mk10d0RFR0g2OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWphcmFoIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ5MDIxMzQ3O319', 1749024352);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-06-03 17:11:19', '2025-06-03 10:19:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role` enum('superadmin','admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_picture`, `deleted_at`, `role`) VALUES
(5, 'dwisatya reizandid21', 'reizandid@gmail.com', NULL, '$2y$12$cFQfoMjsjEsA3ug0a1ZMH.AcgUTFQmBuOsOwLlkup8WdNgIumd44a', NULL, '2025-06-03 09:33:42', '2025-06-03 11:03:44', 'profile_pictures/P0v88o6Bm5IOIzVmB63off9tgto7UsoVufzRZrXT.png', NULL, 'superadmin'),
(6, 'ahmadery', 'ahmadderi880@gmail.com', NULL, '$2y$12$zg0r26lBrL.9XFY2xoev6uKwWmf2GnnQfV85zKjugqYW.tPVNBJm6', 'UpcZXRbQ62tIxpdNBmmCMxmcvoGzK47fmXmuTLqvctuyp6VYVta7QtkFLXS5', '2025-06-03 09:35:14', '2025-06-03 09:56:32', 'profile_pictures/QEs8X87yTHMO0LN0VFSarY9ibUowvzwgEUHVMeM3.jpg', '2025-06-03 09:56:32', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `berita_slug_unique` (`slug`),
  ADD KEY `berita_slug_index` (`slug`),
  ADD KEY `berita_tags_index` (`tags`(768)),
  ADD KEY `idx_berita_title` (`title`),
  ADD KEY `idx_berita_author` (`author`),
  ADD KEY `idx_berita_publish_date` (`publish_date`),
  ADD KEY `idx_berita_slug` (`slug`),
  ADD KEY `idx_berita_publish_deleted` (`publish_date`,`deleted_at`);
ALTER TABLE `berita` ADD FULLTEXT KEY `idx_berita_fulltext` (`title`,`description`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `homepage_banner`
--
ALTER TABLE `homepage_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sambutan_rektor`
--
ALTER TABLE `sambutan_rektor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `homepage_banner`
--
ALTER TABLE `homepage_banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `sambutan_rektor`
--
ALTER TABLE `sambutan_rektor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
