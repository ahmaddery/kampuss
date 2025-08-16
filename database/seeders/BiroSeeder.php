<?php

namespace Database\Seeders;

use App\Models\Biro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $biros = [
            [
                'nama_biro' => 'Biro Akademik',
                'slug' => 'biro-akademik',
                'deskripsi' => 'Mengelola seluruh kegiatan akademik dan kurikulum universitas untuk menjamin kualitas pendidikan yang berkelas.',
                'deskripsi_lengkap' => "Biro Akademik merupakan unit kerja yang bertanggung jawab atas pengelolaan seluruh kegiatan akademik di universitas. Biro ini menangani berbagai aspek penting dalam penyelenggaraan pendidikan tinggi.\n\nTugas dan Fungsi:\n• Menyusun dan mengembangkan kurikulum program studi\n• Mengelola sistem informasi akademik\n• Mengkoordinasikan kegiatan perkuliahan\n• Mengelola data mahasiswa dan dosen\n• Menerbitkan transkrip nilai dan ijazah\n• Mengatur jadwal ujian dan evaluasi akademik\n\nLayanan yang Tersedia:\n• Pendaftaran mata kuliah\n• Pengurusan cuti akademik\n• Legalisir dokumen akademik\n• Konsultasi akademik\n• Pembuatan surat keterangan akademik",
                'seo_title' => 'Biro Akademik - Universitas Mercu Buana Yogyakarta',
                'seo_description' => 'Biro Akademik Universitas Mercu Buana Yogyakarta mengelola seluruh kegiatan akademik, kurikulum, dan layanan mahasiswa.',
                'status' => 'aktif'
            ],
            [
                'nama_biro' => 'Biro Kemahasiswaan',
                'slug' => 'biro-kemahasiswaan',
                'deskripsi' => 'Membina dan mengembangkan potensi mahasiswa melalui berbagai kegiatan kemahasiswaan, organisasi, dan pengembangan soft skill.',
                'deskripsi_lengkap' => "Biro Kemahasiswaan adalah unit yang menangani segala hal terkait kehidupan mahasiswa di luar akademik. Biro ini berkomitmen untuk mengembangkan potensi mahasiswa secara holistik.\n\nBidang Kerja:\n• Pembinaan organisasi kemahasiswaan\n• Pengelolaan kegiatan ekstrakurikuler\n• Program pengembangan minat dan bakat\n• Koordinasi kegiatan mahasiswa\n• Pelayanan konseling dan bimbingan\n• Pengelolaan asrama mahasiswa\n\nProgram Unggulan:\n• Pelatihan kepemimpinan mahasiswa\n• Kompetisi akademik dan non-akademik\n• Program magang dan PKL\n• Kegiatan sosial dan pengabdian masyarakat\n• Festival seni dan budaya mahasiswa\n• Program beasiswa prestasi",
                'seo_title' => 'Biro Kemahasiswaan - Universitas Mercu Buana Yogyakarta',
                'seo_description' => 'Biro Kemahasiswaan mengembangkan potensi mahasiswa melalui organisasi, ekstrakurikuler, dan program pembinaan.',
                'status' => 'aktif'
            ],
            [
                'nama_biro' => 'Biro Keuangan',
                'slug' => 'biro-keuangan',
                'deskripsi' => 'Mengelola seluruh aspek keuangan universitas, termasuk pembayaran SPP, beasiswa, dan administrasi keuangan lainnya.',
                'deskripsi_lengkap' => "Biro Keuangan bertanggung jawab atas pengelolaan seluruh aspek keuangan universitas dengan menerapkan prinsip transparansi dan akuntabilitas.\n\nLayanan Utama:\n• Pengelolaan pembayaran SPP dan biaya kuliah\n• Administrasi beasiswa dan bantuan keuangan\n• Pengelolaan gaji dan tunjangan\n• Pelaporan keuangan universitas\n• Audit internal dan eksternal\n• Pengelolaan investasi dan aset\n\nFasilitas Pembayaran:\n• Pembayaran tunai di kasir\n• Transfer bank\n• Pembayaran online\n• Cicilan pembayaran\n• Mobile banking\n• ATM universitas\n\nProgram Bantuan:\n• Beasiswa prestasi akademik\n• Beasiswa kurang mampu\n• Cicilan 0% untuk mahasiswa berprestasi\n• Program magang berbayar",
                'seo_title' => 'Biro Keuangan - Universitas Mercu Buana Yogyakarta',
                'seo_description' => 'Biro Keuangan mengelola pembayaran SPP, beasiswa, dan seluruh administrasi keuangan universitas.',
                'status' => 'aktif'
            ],
            [
                'nama_biro' => 'Biro Umum dan Perlengkapan',
                'slug' => 'biro-umum-perlengkapan',
                'deskripsi' => 'Mengelola infrastruktur, fasilitas, keamanan, dan kebutuhan operasional universitas sehari-hari.',
                'deskripsi_lengkap' => "Biro Umum dan Perlengkapan menjamin kelancaran operasional universitas melalui pengelolaan infrastruktur dan fasilitas yang memadai.\n\nBidang Pengelolaan:\n• Pemeliharaan gedung dan fasilitas\n• Keamanan dan ketertiban kampus\n• Pengelolaan parkir kendaraan\n• Kebersihan dan landscaping\n• Pengadaan barang dan jasa\n• Pengelolaan inventaris\n\nFasilitas yang Dikelola:\n• Gedung perkuliahan dan laboratorium\n• Perpustakaan dan ruang baca\n• Kantin dan tempat makan\n• Masjid dan tempat ibadah\n• Area parkir dan jalan kampus\n• Sistem keamanan CCTV\n\nLayanan Tambahan:\n• Peminjaman ruangan\n• Jasa cleaning service\n• Maintenance IT dan teknologi\n• Pengelolaan sampah dan limbah",
                'seo_title' => 'Biro Umum dan Perlengkapan - Universitas Mercu Buana Yogyakarta',
                'seo_description' => 'Biro Umum dan Perlengkapan mengelola infrastruktur, fasilitas, dan operasional kampus universitas.',
                'status' => 'aktif'
            ],
            [
                'nama_biro' => 'Biro Perencanaan dan Sistem Informasi',
                'slug' => 'biro-perencanaan-sistem-informasi',
                'deskripsi' => 'Mengembangkan perencanaan strategis universitas dan mengelola sistem informasi untuk mendukung digitalisasi kampus.',
                'deskripsi_lengkap' => "Biro Perencanaan dan Sistem Informasi berperan penting dalam pengembangan universitas melalui perencanaan strategis dan implementasi teknologi informasi.\n\nBidang Perencanaan:\n• Penyusunan rencana strategis universitas\n• Analisis dan evaluasi program\n• Monitoring dan evaluasi kinerja\n• Pengembangan standar mutu\n• Perencanaan anggaran tahunan\n• Studi kelayakan program baru\n\nSistem Informasi:\n• Pengembangan aplikasi akademik\n• Pengelolaan website universitas\n• Sistem informasi manajemen\n• Database mahasiswa dan dosen\n• E-learning platform\n• Mobile apps universitas\n\nLayanan IT:\n• Help desk teknologi\n• Maintenance hardware dan software\n• Pelatihan penggunaan sistem\n• Backup dan recovery data\n• Keamanan sistem informasi",
                'seo_title' => 'Biro Perencanaan dan Sistem Informasi - Universitas Mercu Buana Yogyakarta',
                'seo_description' => 'Biro Perencanaan dan SI mengembangkan strategi universitas dan mengelola sistem informasi kampus.',
                'status' => 'aktif'
            ]
        ];

        foreach ($biros as $biroData) {
            Biro::create($biroData);
        }
    }
}
