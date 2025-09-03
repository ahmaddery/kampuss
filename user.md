# User Manual - Website Kampus Universitas

## Daftar Isi

1. [Pengenalan Website](#pengenalan-website)
2. [Cara Mengakses Website](#cara-mengakses-website)
3. [Fitur Untuk Pengunjung (Public)](#fitur-untuk-pengunjung-public)
4. [Fitur Admin (Administrative)](#fitur-admin-administrative)
5. [Cara Menggunakan Fitur-Fitur Utama](#cara-menggunakan-fitur-fitur-utama)
6. [Tips dan Best Practices](#tips-dan-best-practices)
7. [Troubleshooting](#troubleshooting)
8. [FAQ (Frequently Asked Questions)](#faq-frequently-asked-questions)

---

## Pengenalan Website

Website Kampus Universitas adalah sistem manajemen konten (CMS) yang dirancang khusus untuk institusi pendidikan tinggi. Website ini menyediakan platform terintegrasi untuk mengelola informasi akademik, berita, pengumuman, fasilitas, dan berbagai layanan kampus.

### Teknologi Yang Digunakan
- **Framework**: Laravel 10+ (PHP)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript, Tailwind CSS, Bootstrap
- **Storage**: Laravel File Storage System
- **Security**: CSRF Protection, Rate Limiting, Spam Protection

### Target Pengguna
1. **Pengunjung Umum**: Calon mahasiswa, mahasiswa, dosen, alumni, dan masyarakat umum
2. **Administrator**: Staff IT, admin konten, dan pengelola website

---

## Cara Mengakses Website

### Akses Halaman Publik
- **URL Utama**: `http://your-domain.com`
- **Kompatibilitas**: Semua browser modern (Chrome, Firefox, Safari, Edge)
- **Responsive**: Dapat diakses melalui desktop, tablet, dan smartphone

### Akses Admin Panel
- **URL Admin**: `http://your-domain.com/admin`
- **Login Required**: Ya
- **Credentials**: Hubungi administrator untuk mendapatkan akses

---

## Fitur Untuk Pengunjung (Public)

### 1. Halaman Beranda
**Lokasi**: `/` (halaman utama)

**Fitur yang Tersedia**:
- **Header Banner Carousel**: Slider gambar utama dengan informasi terkini
- **Berita Terbaru**: 4 berita terdini dengan preview
- **Pengumuman Terbaru**: 4 pengumuman terdini dengan preview
- **Fasilitas Unggulan**: Showcase fasilitas kampus utama
- **Quick Links**: Akses cepat ke halaman penting
- **Newsletter Subscription**: Berlangganan update via email

**Cara Menggunakan**:
1. Kunjungi halaman utama website
2. Scroll untuk melihat konten terbaru
3. Klik pada item yang diminati untuk detail lengkap
4. Gunakan menu navigasi untuk mengakses halaman lain

### 2. Halaman Berita
**Lokasi**: `/berita`

**Fitur yang Tersedia**:
- **Daftar Berita**: Grid layout dengan gambar preview
- **Search Function**: Pencarian berdasarkan judul, konten, atau tag
- **Filter**: Filter berdasarkan kategori atau tanggal
- **Pagination**: Navigasi halaman untuk berita lebih lama
- **Detail Berita**: Halaman lengkap dengan konten, gambar, dan social sharing

**Cara Menggunakan**:
1. Akses menu "Berita" dari navigasi utama
2. Browse berita yang tersedia atau gunakan search box
3. Klik judul berita untuk membaca detail lengkap
4. Gunakan tombol share untuk berbagi di media sosial
5. Subscribe newsletter untuk update berita terbaru

### 3. Halaman Pengumuman
**Lokasi**: `/pengumuman`

**Fitur yang Tersedia**:
- **Grid Pengumuman**: Layout card dengan preview
- **Search & Filter**: Pencarian dan filter kategori
- **Tag System**: Navigasi berdasarkan tag
- **Detail Pengumuman**: Konten lengkap dengan format rich text
- **Share Social Media**: Bagikan ke Facebook, Twitter, WhatsApp, LinkedIn

**Cara Menggunakan**:
1. Akses menu "Pengumuman" dari navbar
2. Lihat pengumuman terbaru di grid layout
3. Gunakan search box untuk mencari pengumuman spesifik
4. Klik pada pengumuman untuk membaca detail
5. Gunakan tombol social share untuk berbagi informasi

### 4. Halaman Program Studi/Jurusan
**Lokasi**: `/jurusan`

**Fitur yang Tersedia**:
- **Daftar Program Studi**: Katalog semua jurusan yang tersedia
- **Search Program**: Pencarian berdasarkan nama jurusan
- **Detail Program**: Informasi lengkap termasuk:
  - Deskripsi program
  - Kurikulum overview
  - Prospek karir
  - Informasi akademik (SKS, durasi, akreditasi, gelar)
  - Fasilitas terkait

**Cara Menggunakan**:
1. Klik menu "Jurusan" atau "Program Studi"
2. Browse semua program yang tersedia
3. Gunakan search untuk menemukan program spesifik
4. Klik pada jurusan untuk melihat detail lengkap
5. Lihat informasi akademik di sidebar detail program

### 5. Halaman Fasilitas
**Lokasi**: `/fasilitas`

**Fitur yang Tersedia**:
- **Katalog Fasilitas**: Grid semua fasilitas kampus
- **Filter Jurusan**: Filter fasilitas berdasarkan jurusan
- **Search Function**: Pencarian fasilitas
- **Detail Fasilitas**: Informasi lengkap meliputi:
  - Galeri foto
  - Deskripsi lengkap
  - Lokasi dan jam operasional
  - Kontak person
  - Fasilitas terkait

**Cara Menggunakan**:
1. Akses menu "Fasilitas"
2. Browse fasilitas dengan grid layout
3. Gunakan filter jurusan untuk fasilitas spesifik
4. Klik pada fasilitas untuk detail lengkap
5. Lihat galeri foto dan informasi kontak

### 6. Halaman Biro
**Lokasi**: `/biro`

**Fitur yang Tersedia**:
- **Daftar Biro**: Semua unit administratif kampus
- **Detail Biro**: Informasi lengkap setiap biro
- **Kontak Information**: Informasi kontak dan layanan
- **Galeri Dokumentasi**: Foto-foto kegiatan biro

**Cara Menggunakan**:
1. Klik menu "Biro" dari navigasi
2. Lihat daftar semua biro yang tersedia
3. Klik pada biro tertentu untuk detail
4. Lihat layanan dan kontak yang tersedia

### 7. Halaman Tentang Kampus

#### Sambutan Rektor
**Lokasi**: `/sambutan-rektor`
- Pesan sambutan dari pimpinan universitas
- Visi dan misi kepemimpinan

#### Sejarah
**Lokasi**: `/sejarah`
- Timeline sejarah universitas
- Milestone penting institusi

#### Visi & Misi
**Lokasi**: `/visi-misi`
- Visi universitas
- Misi dan tujuan institusi
- Values dan komitmen

#### Struktur Organisasi
**Lokasi**: `/struktur-organisasi`
- Bagan organisasi universitas
- Informasi kepemimpinan dan unit

### 8. Halaman Kontak
**Lokasi**: `/contact`

**Fitur yang Tersedia**:
- **Form Kontak**: Kirim pesan langsung ke admin
- **Informasi Kontak**: Alamat, telepon, email
- **Peta Lokasi**: Embedded Google Maps
- **FAQ Section**: Pertanyaan yang sering diajukan
- **Social Media Links**: Link ke media sosial resmi

**Fitur Keamanan Form**:
- **Rate Limiting**: Maksimal 3 submission per 10 menit per IP
- **Spam Protection**: Filter kata-kata spam dan bot detection
- **Honeypot**: Proteksi dari automated submission
- **Time-based Protection**: Minimum 5 detik untuk mengisi form

**Cara Menggunakan**:
1. Akses menu "Kontak"
2. Isi form kontak dengan data yang valid
3. Tunggu minimal 5 detik sebelum submit
4. Klik "Kirim Pesan"
5. Tunggu konfirmasi pengiriman

### 9. Newsletter Subscription
**Lokasi**: Tersedia di berbagai halaman

**Cara Berlangganan**:
1. Temukan form newsletter di footer atau halaman konten
2. Masukkan email address yang valid
3. Pilih jenis konten (umum, berita, pengumuman)
4. Klik "Subscribe" atau "Berlangganan"
5. Check email untuk konfirmasi

---

## Fitur Admin (Administrative)

### Login Admin
**Lokasi**: `/admin`

**Credentials Required**:
- Username/Email
- Password
- Session akan expired setelah periode inactive

### Dashboard Admin
**Lokasi**: `/admin/dashboard`

**Informasi yang Ditampilkan**:
- **Statistik Website**: Total users, berita, pengumuman, pesan kontak
- **Aktivitas Terbaru**: Log aktivitas user dan konten
- **Quick Actions**: Shortcut ke fitur-fitur utama
- **Chart Analytics**: Grafik statistik penggunaan
- **Popular Content**: Konten dengan views tertinggi

### 1. Manajemen Banner Homepage
**Lokasi**: `/admin/homepage_banners`

**Fitur Available**:
- **Create Banner**: Tambah banner baru dengan gambar dan teks
- **Edit Banner**: Modifikasi banner yang sudah ada
- **Delete Banner**: Hapus banner yang tidak diperlukan
- **Order Management**: Atur urutan tampil banner
- **Preview**: Lihat preview banner sebelum publish

**Cara Menggunakan**:
1. Login ke admin panel
2. Klik menu "Header" untuk banner management
3. Klik "Tambah Banner" untuk membuat baru
4. Upload gambar (max 2MB, format: JPG, PNG, GIF)
5. Isi judul dan deskripsi banner
6. Save untuk mempublikasikan

### 2. Manajemen Berita
**Lokasi**: `/admin/berita`

**Fitur Available**:
- **CRUD Operations**: Create, Read, Update, Delete
- **Rich Text Editor**: CKEditor untuk formatting konten
- **Image Upload**: Upload gambar featured dan dalam konten
- **SEO Fields**: Meta title, description untuk SEO
- **Status Management**: Draft, Published, Archived
- **Tag System**: Kategorisasi dengan tags
- **View Counter**: Tracking jumlah pembaca

**Cara Menggunakan**:
1. Akses menu "Berita" di admin panel
2. Klik "Tambah Berita" untuk konten baru
3. Isi semua field yang diperlukan:
   - Judul berita
   - Slug (auto-generated)
   - Gambar featured (wajib)
   - Konten lengkap dengan rich text editor
   - Author name
   - Tags (opsional)
   - SEO title & description
4. Preview sebelum publish
5. Save untuk mempublikasikan

### 3. Manajemen Pengumuman
**Lokasi**: `/admin/pengumuman`

**Fitur yang Sama dengan Berita**:
- CRUD operations
- Rich text editor
- Image management
- SEO optimization
- Tag system
- Status management

**Cara Penggunaan**: Sama seperti manajemen berita

### 4. Manajemen Jurusan/Program Studi
**Lokasi**: `/admin/jurusan`

**Fitur Available**:
- **Program Management**: Tambah, edit, hapus program studi
- **Icon Upload**: Upload icon/logo jurusan
- **Rich Description**: Deskripsi lengkap dengan formatting
- **SEO Optimization**: Meta tags untuk setiap program
- **Information Program**: Link ke detail akademik

**Data yang Dikelola**:
- Nama jurusan
- Icon/logo jurusan
- Slug untuk URL
- Deskripsi singkat dan lengkap
- SEO meta data

**Cara Menggunakan**:
1. Akses menu "Jurusan" di admin
2. Klik "Tambah Jurusan" untuk program baru
3. Upload icon jurusan (format: JPG, PNG, SVG, max 2MB)
4. Isi nama jurusan (slug auto-generated)
5. Tulis deskripsi singkat dan lengkap
6. Isi SEO fields untuk optimasi search engine
7. Save untuk mempublikasikan

### 5. Manajemen Informasi Program
**Lokasi**: `/admin/informasi-program`

**Data yang Dikelola**:
- **Jenjang**: D3, S1, S2, S3
- **Durasi**: Lama studi dalam semester
- **SKS**: Total SKS program
- **Akreditasi**: Status akreditasi program
- **Gelar**: Gelar yang diperoleh lulusan

**Cara Menggunakan**:
1. Pastikan jurusan sudah dibuat terlebih dahulu
2. Akses menu "Program" di admin
3. Pilih jurusan untuk ditambahkan info program
4. Isi detail informasi akademik
5. Save untuk menyimpan data

### 6. Manajemen Fasilitas
**Lokasi**: `/admin/fasilitas`

**Fitur Available**:
- **Multi-image Upload**: Upload multiple gambar per fasilitas
- **Jurusan Association**: Link fasilitas dengan jurusan tertentu
- **Location Info**: Informasi lokasi dan jam operasional
- **Contact Person**: Kontak yang bisa dihubungi
- **Status Management**: Aktif/nonaktif fasilitas
- **Rich Description**: Deskripsi lengkap dengan formatting

**Data yang Dikelola**:
- Nama fasilitas
- Multiple gambar dokumentasi
- Deskripsi singkat dan lengkap
- Lokasi fisik
- Jam operasional
- Kontak person (email/phone/WhatsApp)
- Status aktif/nonaktif
- Asosiasi dengan jurusan

**Cara Menggunakan**:
1. Akses menu "Fasilitas" di admin
2. Klik "Tambah Fasilitas"
3. Upload gambar fasilitas (bisa multiple images)
4. Isi nama dan deskripsi fasilitas
5. Pilih jurusan terkait (opsional untuk fasilitas umum)
6. Isi lokasi dan jam operasional
7. Masukkan kontak person
8. Set status aktif
9. Save untuk publish

### 7. Manajemen Biro
**Lokasi**: `/admin/biro`

**Fitur Available**:
- **Logo Upload**: Upload logo resmi biro
- **Multiple Images**: Dokumentasi kegiatan biro
- **Rich Content**: Deskripsi lengkap dengan formatting
- **SEO Optimization**: Meta tags untuk halaman biro
- **Status Control**: Aktif/nonaktif tampilan biro

**Data yang Dikelola**:
- Nama biro
- Logo biro
- Galeri dokumentasi
- Deskripsi singkat dan lengkap
- SEO meta data
- Status aktif/nonaktif

**Cara Menggunakan**:
1. Akses menu "Biro" di admin panel
2. Klik "Tambah Biro" untuk unit baru
3. Upload logo biro (PNG, JPG, max 2MB)
4. Upload gambar dokumentasi (multiple files)
5. Isi nama biro (slug auto-generated)
6. Tulis deskripsi singkat dan lengkap
7. Isi SEO meta title dan description
8. Set status aktif
9. Save untuk publish

### 8. Manajemen Konten Institusional

#### Sambutan Rektor
**Lokasi**: `/admin/sambutan_rektor`
- Rich text editor untuk pesan sambutan
- Upload foto rektor
- Multiple sambutan/periode kepemimpinan

#### Sejarah
**Lokasi**: `/admin/sejarah`
- Timeline sejarah universitas
- Rich text dengan formatting
- Upload gambar dokumentasi historis

#### Visi & Misi
**Lokasi**: `/admin/visi-misi`
- Editor untuk visi universitas
- Poin-poin misi yang terstruktur
- Rich text formatting

#### Struktur Organisasi
**Lokasi**: `/admin/organization-structure`
- Manajemen unit organisasi
- Hirarki struktur
- Info pejabat/kepala unit

### 9. Manajemen Kontak & Pesan

#### Pesan Kontak Masuk
**Lokasi**: `/admin/contact-messages`

**Fitur Available**:
- **Inbox Management**: Daftar semua pesan masuk
- **Read/Unread Status**: Marking pesan yang sudah dibaca
- **Reply Function**: Balas pesan via email
- **Delete Function**: Hapus pesan spam/tidak relevan
- **Filter & Search**: Cari pesan berdasarkan kriteria
- **Spam Protection Logs**: Log attempt spam yang diblokir

**Cara Menggunakan**:
1. Akses menu "Pesan Kontak" di admin
2. Lihat daftar pesan masuk (unread akan highlighted)
3. Klik pesan untuk membaca detail
4. Gunakan tombol "Reply" untuk membalas via email
5. Mark sebagai read/unread sesuai kebutuhan
6. Delete pesan yang tidak relevan

#### Newsletter Management
**Lokasi**: `/admin/newsletter`

**Fitur Available**:
- **Subscriber List**: Daftar semua subscriber
- **Email Blast**: Kirim email broadcast
- **Subscription Management**: Kelola status subscription
- **Analytics**: Statistik open rate dan click rate
- **Unsubscribe Handling**: Proses unsubscribe otomatis

### 10. Manajemen User & Admin

#### User Management
**Lokasi**: `/admin/users`

**Fitur Available**:
- **Create Admin**: Tambah user admin baru
- **Edit Profile**: Modifikasi data admin
- **Role Management**: Atur peran dan permission
- **Status Control**: Aktif/deaktif akun admin
- **Activity Tracking**: Log aktivitas setiap admin

**Cara Menggunakan**:
1. Akses menu "Manajemen Pengguna"
2. Klik "Tambah Pengguna" untuk admin baru
3. Isi data: nama, email, password
4. Set role dan permission
5. Set status aktif
6. Save untuk create account

#### Profile Management
**Lokasi**: `/admin/profile`

**Fitur Available**:
- **Edit Profile**: Update nama, email, photo
- **Change Password**: Ganti password login
- **Activity History**: Riwayat login dan aktivitas
- **Security Settings**: Pengaturan keamanan akun

### 11. Pengaturan Sistem

#### Pengaturan Umum
**Lokasi**: `/admin/settings/general`

**Konfigurasi Available**:
- **Contact Information**: Email, phone, address kontak kampus
- **Social Media**: Link ke akun media sosial resmi
- **Operational Hours**: Jam operasional kampus
- **System Settings**: Konfigurasi sistem dasar

#### Pengaturan Halaman
**Lokasi**: `/admin/settings/pages`

**Fitur Available**:
- **Page Status Control**: Aktif/nonaktif halaman tertentu
- **Maintenance Mode**: Set halaman dalam maintenance
- **Bulk Actions**: Aktivasi/deaktivasi multiple halaman
- **Real-time Effect**: Perubahan berlaku langsung

**Halaman yang Bisa Diatur**:
- Sambutan Rektor
- Sejarah
- Visi & Misi
- Struktur Organisasi
- Berita
- Pengumuman
- Program Studi/Jurusan
- Fasilitas
- Biro

#### Activity Logs
**Lokasi**: `/admin/activity-logs`

**Informasi yang Dicatat**:
- **User Activity**: Login, logout, create, update, delete
- **Content Changes**: Perubahan pada konten website
- **System Events**: Error, security events
- **Timestamp**: Waktu setiap aktivitas
- **IP Address**: Alamat IP user yang melakukan aktivitas

---

## Cara Menggunakan Fitur-Fitur Utama

### 1. Upload dan Manajemen Gambar

#### Persyaratan File
- **Format**: JPG, JPEG, PNG, GIF, WebP
- **Ukuran Maximum**: 2MB per file
- **Dimensi**: Recommend 1200x800px untuk banner, 800x600px untuk konten
- **Multiple Upload**: Support untuk fasilitas dan biro

#### Best Practices
1. Gunakan gambar berkualitas tinggi
2. Compress gambar sebelum upload untuk performance
3. Gunakan nama file yang deskriptif
4. Preview image sebelum save
5. Backup gambar original sebelum edit

### 2. Rich Text Editor (CKEditor)

#### Fitur Available
- **Text Formatting**: Bold, italic, underline, colors
- **Lists**: Bullet points, numbered lists
- **Links**: Internal dan external links
- **Images**: Insert image dalam konten
- **Tables**: Create dan format tables
- **Headings**: H1, H2, H3, H4, H5, H6

#### Tips Penggunaan
1. Gunakan heading untuk struktur konten
2. Optimize images dalam konten
3. Test links sebelum publish
4. Use preview untuk check formatting
5. Save draft secara berkala

### 3. SEO Optimization

#### Field yang Tersedia
- **SEO Title**: Judul untuk search engine (max 60 karakter)
- **SEO Description**: Deskripsi untuk SERP (max 160 karakter)
- **Slug**: URL-friendly version dari judul
- **Meta Tags**: Auto-generated dari konten

#### Best Practices SEO
1. Gunakan keyword relevat di title dan description
2. Buat slug yang readable dan SEO-friendly
3. Isi semua meta fields
4. Gunakan heading structure yang baik
5. Optimize images dengan alt text

### 4. Backup dan Recovery

#### Auto Backup
- **Database**: Daily backup via Laravel schedule
- **Files**: Weekly backup ke cloud storage
- **Recovery Point**: 30 hari backup retention

#### Manual Backup
1. Login sebagai admin
2. Akses System Settings
3. Click "Create Backup"
4. Download backup file
5. Store securely offsite

---

## Tips dan Best Practices

### Untuk Admin/Pengelola Konten

#### Content Management
1. **Konsistensi**: Gunakan style guide yang konsisten
2. **Quality Control**: Review semua konten sebelum publish
3. **Update Regular**: Update konten secara berkala
4. **SEO**: Selalu isi meta fields untuk SEO
5. **Images**: Gunakan gambar berkualitas dan relevant

#### Security Best Practices
1. **Strong Password**: Gunakan password yang kuat dan unique
2. **Regular Updates**: Update password secara berkala
3. **Logout**: Selalu logout setelah selesai
4. **Two-Factor**: Enable 2FA jika tersedia
5. **Activity Monitoring**: Monitor activity logs secara rutin

#### Performance Optimization
1. **Image Optimization**: Compress gambar sebelum upload
2. **Content Length**: Buat konten yang comprehensive tapi tidak terlalu panjang
3. **Link Maintenance**: Check broken links secara berkala
4. **Cache**: Clear cache setelah update major
5. **Mobile Testing**: Test tampilan di mobile device

### Untuk Pengunjung Website

#### Browsing Tips
1. **Search Function**: Gunakan search untuk find content cepat
2. **Navigation**: Explore semua menu yang tersedia
3. **Newsletter**: Subscribe untuk update terbaru
4. **Contact**: Gunakan form contact untuk pertanyaan
5. **Social Media**: Follow akun resmi untuk update real-time

#### Form Submission
1. **Complete Information**: Isi semua field yang required
2. **Valid Email**: Gunakan email yang aktif
3. **Spam Prevention**: Tunggu minimal 5 detik sebelum submit
4. **Double Check**: Review informasi sebelum kirim
5. **Confirmation**: Tunggu confirmation message

---

## Troubleshooting

### Masalah Umum dan Solusi

#### 1. Tidak Bisa Login ke Admin
**Symptoms**: Login form tidak accept credentials
**Possible Causes**:
- Password salah
- Account deactivated
- Session expired
- Browser cache issue

**Solutions**:
1. Double-check username dan password
2. Clear browser cache dan cookies
3. Try private/incognito browsing
4. Contact administrator untuk reset password
5. Check caps lock dan keyboard language

#### 2. Upload Gambar Gagal
**Symptoms**: Error message saat upload file
**Possible Causes**:
- File size terlalu besar (>2MB)
- Format file tidak support
- Server storage penuh
- Permission issue

**Solutions**:
1. Compress gambar untuk reduce file size
2. Convert ke format yang support (JPG, PNG)
3. Check available storage space
4. Contact administrator jika error persist
5. Try upload file yang berbeda untuk test

#### 3. Konten Tidak Muncul di Public
**Symptoms**: Konten sudah dibuat tapi tidak tampil
**Possible Causes**:
- Status masih draft
- Page setting dinonaktifkan
- Cache issue
- Slug conflict

**Solutions**:
1. Check status konten (set ke "Published")
2. Verify page settings di admin panel
3. Clear cache browser dan website
4. Check URL slug untuk conflicts
5. Wait beberapa menit untuk cache refresh

#### 4. Form Kontak Tidak Bisa Submit
**Symptoms**: Form submit error atau tidak terkirim
**Possible Causes**:
- Rate limiting (terlalu sering submit)
- Spam protection triggered
- Required fields kosong
- Server email issue

**Solutions**:
1. Wait 10 menit sebelum try again (rate limit)
2. Fill form completely dan tunggu 5+ detik
3. Check semua required fields
4. Avoid spam keywords dalam message
5. Contact admin via phone/email alternatif

#### 5. Website Loading Lambat
**Symptoms**: Halaman load lama atau timeout
**Possible Causes**:
- Server overload
- Large image files
- Network connection issue
- Cache problem

**Solutions**:
1. Check internet connection
2. Try refresh browser (Ctrl+F5)
3. Clear browser cache
4. Try different browser
5. Contact administrator jika consistent

#### 6. Mobile Display Issue
**Symptoms**: Website tidak display properly di mobile
**Possible Causes**:
- CSS responsive issue
- Browser compatibility
- Cache problem
- Screen size specific bug

**Solutions**:
1. Rotate device (portrait/landscape)
2. Zoom out untuk full view
3. Try different mobile browser
4. Clear mobile browser cache
5. Report issue ke administrator

---

## FAQ (Frequently Asked Questions)

### Umum

**Q: Bagaimana cara mengetahui update terbaru dari website?**
A: Subscribe ke newsletter di footer website atau follow media sosial resmi kampus. Update juga tersedia di halaman berita dan pengumuman.

**Q: Apakah website bisa diakses 24/7?**
A: Ya, website tersedia 24 jam sehari. Namun maintenance terjadwal biasanya dilakukan dini hari dengan pemberitahuan sebelumnya.

**Q: Bagaimana cara melaporkan masalah atau bug di website?**
A: Gunakan form kontak di halaman Contact atau email langsung ke tim IT. Sertakan detail masalah dan screenshot jika memungkinkan.

### Untuk Pengunjung

**Q: Apakah perlu registrasi untuk mengakses informasi di website?**
A: Tidak, semua informasi publik dapat diakses tanpa registrasi. Hanya admin panel yang memerlukan login.

**Q: Bagaimana cara mencari informasi spesifik di website?**
A: Gunakan search box yang tersedia di setiap halaman atau gunakan menu navigasi untuk browse kategori tertentu.

**Q: Apakah bisa mendownload dokumen dari website?**
A: Ya, dokumen yang dipublikasikan dapat didownload. Check halaman pengumuman untuk dokumen resmi.

**Q: Bagaimana cara berlangganan newsletter?**
A: Isi email address di form newsletter yang tersedia di footer atau halaman konten, pilih jenis content, dan klik subscribe.

**Q: Kenapa form kontak saya tidak bisa dikirim?**
A: Pastikan semua field terisi, tunggu minimal 5 detik sebelum submit, dan avoid spam keywords. Rate limit adalah 3 submission per 10 menit.

### Untuk Admin

**Q: Bagaimana cara backup data website?**
A: System melakukan auto backup harian. Untuk manual backup, akses System Settings > Backup atau contact administrator.

**Q: Bisa mengatur siapa saja yang bisa akses admin panel?**
A: Ya, melalui User Management di admin panel. Set role dan permission sesuai kebutuhan.

**Q: Bagaimana cara mengatur halaman dalam maintenance mode?**
A: Gunakan Page Settings di admin panel untuk set status aktif/nonaktif halaman tertentu.

**Q: Apakah ada limit ukuran file yang bisa diupload?**
A: Ya, limit 2MB per file untuk gambar. Untuk file dokumen, check dengan administrator untuk limit spesifik.

**Q: Bagaimana cara mengoptimalkan SEO konten?**
A: Isi semua SEO fields (title, description), gunakan heading structure, optimize images, dan gunakan keyword yang relevant.

### Teknis

**Q: Browser apa saja yang support website ini?**
A: Chrome, Firefox, Safari, Edge versi terbaru. Mobile browser juga fully supported.

**Q: Apakah website responsive untuk mobile?**
A: Ya, website menggunakan responsive design yang optimize untuk semua device size.

**Q: Bagaimana sistem keamanan website?**
A: Website menggunakan HTTPS, CSRF protection, rate limiting, spam filtering, dan regular security updates.

**Q: Apakah data pengunjung di-track?**
A: Website menggunakan analytics untuk improve user experience. Personal data tidak disimpan tanpa consent.

**Q: Bagaimana cara melaporkan konten yang tidak pantas?**
A: Gunakan form kontak untuk report konten problematic. Tim moderator akan review dan take action.

---

## Kontak Support

### Tim Technical Support
- **Email**: support@kampus.ac.id
- **Phone**: +62 274 123456
- **WhatsApp**: +62 812 3456 7890
- **Working Hours**: Senin-Jumat 08:00-17:00 WIB

### Content Management
- **Email**: content@kampus.ac.id
- **Untuk**: Issue terkait konten, update informasi

### System Administrator
- **Email**: admin@kampus.ac.id
- **Untuk**: Issue teknis, access control, backup

### Emergency Contact
- **Phone**: +62 274 123456 (24/7)
- **Untuk**: Critical system issues, security incidents

---

**Last Updated**: August 2025  
**Version**: 1.0  
**Document Prepared By**: System Administrator Team
