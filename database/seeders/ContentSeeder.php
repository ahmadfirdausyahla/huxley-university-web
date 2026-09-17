<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicProgram;
use App\Models\Facility;
use App\Models\Scholarship;
use App\Models\Civitas;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Program Studi
        if (AcademicProgram::count() === 0) {
            AcademicProgram::create([
                'name' => 'Teknik Informatika',
                'slug' => 's1-teknik-informatika',
                'degree' => 'S1',
                'faculty' => 'Fakultas Ilmu Komputer',
                'accreditation' => 'Unggul',
                'description' => 'Mempersiapkan sarjana informatika yang menguasai rekayasa perangkat lunak skala enterprise, artificial intelligence, cloud computing, dan keamanan siber berstandar internasional.',
                'career_prospects' => 'Software Engineer, AI Specialist, Cloud Solutions Architect, Cybersecurity Analyst, Fullstack Developer',
                'duration_years' => '4 Tahun (8 Semester)',
                'tuition_fee' => 'Rp 7.500.000 / semester',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            AcademicProgram::create([
                'name' => 'Sistem Informasi',
                'slug' => 's1-sistem-informasi',
                'degree' => 'S1',
                'faculty' => 'Fakultas Ilmu Komputer',
                'accreditation' => 'Unggul',
                'description' => 'Menjembatani domain teknologi informasi dengan strategi bisnis digital global, enterprise architecture, business analytics, dan IT governance.',
                'career_prospects' => 'IT Business Analyst, Product Manager, Data Analyst, ERP Consultant, Digital Transformation Lead',
                'duration_years' => '4 Tahun (8 Semester)',
                'tuition_fee' => 'Rp 7.000.000 / semester',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            AcademicProgram::create([
                'name' => 'Manajemen Bisnis Digital',
                'slug' => 's1-manajemen-bisnis-digital',
                'degree' => 'S1',
                'faculty' => 'Fakultas Ekonomi & Bisnis',
                'accreditation' => 'A',
                'description' => 'Fokus pada strategi kewirausahaan teknologi, digital marketing, supply chain management terintegrasi, dan analitika finansial modern.',
                'career_prospects' => 'Startup Founder, Growth Marketer, Investment Analyst, Operation Manager, Corporate Strategist',
                'duration_years' => '4 Tahun (8 Semester)',
                'tuition_fee' => 'Rp 6.500.000 / semester',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            AcademicProgram::create([
                'name' => 'Desain Komunikasi Visual',
                'slug' => 's1-desain-komunikasi-visual',
                'degree' => 'S1',
                'faculty' => 'Fakultas Seni & Desain Komunikasi',
                'accreditation' => 'A',
                'description' => 'Eksplorasi estetika visual, brand identity, motion graphics, UI/UX experience design, serta animasi digital interaktif.',
                'career_prospects' => 'UI/UX Designer, Art Director, Creative Lead, Motion Graphic Artist, Branding Specialist',
                'duration_years' => '4 Tahun (8 Semester)',
                'tuition_fee' => 'Rp 7.200.000 / semester',
                'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            AcademicProgram::create([
                'name' => 'Rekayasa Perangkat Lunak Aplikasi',
                'slug' => 'd3-rekayasa-perangkat-lunak-aplikasi',
                'degree' => 'D3',
                'faculty' => 'Sekolah Vokasi Terapan',
                'accreditation' => 'Baik Sekali',
                'description' => 'Pendidikan vokasi praktis 70% hands-on lab untuk mencetak software practitioner yang siap langsung diterjunkan ke industri teknologi informasi.',
                'career_prospects' => 'Junior Software Developer, Mobile App Developer, QA Tester, Frontend Specialist',
                'duration_years' => '3 Tahun (6 Semester)',
                'tuition_fee' => 'Rp 5.500.000 / semester',
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            AcademicProgram::create([
                'name' => 'Magister Ilmu Komputer (M.Kom)',
                'slug' => 's2-magister-ilmu-komputer',
                'degree' => 'S2',
                'faculty' => 'Sekolah Pascasarjana',
                'accreditation' => 'Unggul',
                'description' => 'Program pascasarjana tingkat lanjut berorientasi riset mutakhir dalam bidang Deep Learning, Natural Language Processing, dan Autonomous Systems.',
                'career_prospects' => 'Research Scientist, Lead AI Architect, University Lecturer, R&D Director',
                'duration_years' => '2 Tahun (4 Semester)',
                'tuition_fee' => 'Rp 12.000.000 / semester',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);
        }

        // 2. Fasilitas Kampus
        if (Facility::count() === 0) {
            Facility::create([
                'name' => 'Digital Innovation & AI Lab',
                'slug' => 'digital-innovation-and-ai-lab',
                'category' => 'laboratorium',
                'location' => 'Gedung Rektorat Baru Lt. 3',
                'description' => 'Laboratorium komputasi performa tinggi dilengkapi 60 unit workstation Apple Silicon, workstation NVIDIA RTX GPU Server untuk model training, dan VR/AR Developer Kits.',
                'capacity' => 80,
                'features' => '60 iMac M3 Workstations, GPU Server Farm, 4K Smart Display, Studio Podcast, Wi-Fi 6 Dedicated',
                'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            Facility::create([
                'name' => 'Sir Huxley Memorial Central Library',
                'slug' => 'sir-huxley-memorial-central-library',
                'category' => 'perpustakaan',
                'location' => 'Gedung Perpustakaan Pusat Kampus',
                'description' => 'Perpustakaan terintegrasi 5 lantai dengan lebih dari 500.000 koleksi fisik, ribuan repository e-journal IEEE/Scopus, ruang baca hening, dan pod diskusi interaktif.',
                'capacity' => 600,
                'features' => 'Silent Study Pods, Group Discussion Rooms, RFID Book Checkout, Café Corner, Akses Jurnal 24 Jam',
                'image' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            Facility::create([
                'name' => 'Huxley Olympic Arena & Sports Complex',
                'slug' => 'huxley-olympic-arena-and-sports-complex',
                'category' => 'olahraga',
                'location' => 'Zona Barat Kampus',
                'description' => 'Fasilitas olahraga komprehensif berstandar internasional meliputi lapangan basket indoor kayu maple, kolam renang ukuran Olimpiade, fitness center, dan jogging track rindang.',
                'capacity' => 1500,
                'features' => 'Indoor Basketball Court, Olympic Swimming Pool, Modern Gymnasium, Badminton Courts, Locker Rooms',
                'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            Facility::create([
                'name' => 'Grand Chancellor Auditorium',
                'slug' => 'grand-chancellor-auditorium',
                'category' => 'aula',
                'location' => 'Gedung Rektorat & Konvensi',
                'description' => 'Gedung auditorium utama dengan kapasitas ribuan audiens, didukung sistem tata suara akustik profesional Meyer Sound, videotron panggung 4K, dan ruang VIP representatif.',
                'capacity' => 2000,
                'features' => 'Videotron 4K Curved, Sound System Akustik Profesional, Kursi Teater Ergonomis, Ruang Transit VIP',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            Facility::create([
                'name' => 'Integrated Student Career & Counseling Hub',
                'slug' => 'integrated-student-career-and-counseling-hub',
                'category' => 'layanan',
                'location' => 'Gedung Student Center Lt. 2',
                'description' => 'Pusat layanan mahasiswa terpadu untuk bimbingan karir, magang industri multinasional, konseling psikologis pribadi, serta fasilitasi beasiswa.',
                'capacity' => 100,
                'features' => 'Private Counseling Rooms, Interview Simulation Suite, Resume Helpdesk, Company Meetup Lounge',
                'image' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);
        }

        // 3. Program Beasiswa
        if (Scholarship::count() === 0) {
            Scholarship::create([
                'title' => 'Huxley Global Excellence Scholarship 2026',
                'slug' => 'huxley-global-excellence-scholarship-2026',
                'provider' => 'Huxley University Foundation',
                'coverage_type' => 'full',
                'amount' => '100% SPP Bebas Biaya + Living Allowance Rp 3.000.000 / bulan',
                'deadline' => now()->addMonths(3),
                'description' => 'Program beasiswa paling bergengsi untuk calon mahasiswa baru dan mahasiswa aktif dengan rekam jejak akademik cemerlang dan kepemimpinan tinggi.',
                'requirements' => "1. Rata-rata nilai rapor min. 88.0 atau IPK min. 3.75\n2. Sertifikat prestasi akademik/non-akademik tingkat nasional\n3. Skor TOEFL min. 550 / IELTS 6.5\n4. Esai motivasi 1000 kata mengenai kontribusi masa depan",
                'link' => 'https://huxley.ac.id/scholarships/global-excellence',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            Scholarship::create([
                'title' => 'Future Tech Innovator Grant',
                'slug' => 'future-tech-innovator-grant',
                'provider' => 'Tech Industry Consortium',
                'coverage_type' => 'partial',
                'amount' => 'Potongan Biaya Kuliah 70% + Mentorship Industri',
                'deadline' => now()->addMonths(2),
                'description' => 'Sponsorship kolaboratif antara Huxley University dan raksasa industri teknologi untuk talenta muda di bidang pemrograman dan AI.',
                'requirements' => "1. Terdaftar di Fakultas Ilmu Komputer / Teknik Informatika\n2. Portofolio proyek software atau AI yang fungsional\n3. Lolos sesi coding test teknis daring",
                'link' => 'https://huxley.ac.id/scholarships/tech-innovator',
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);

            Scholarship::create([
                'title' => 'Undergraduate Research Fellowship',
                'slug' => 'undergraduate-research-fellowship',
                'provider' => 'Kemendikbudristek & Huxley R&D',
                'coverage_type' => 'living_allowance',
                'amount' => 'Dana Hibah Riset Rp 15.000.000 + Uang Saku Bulanan',
                'deadline' => now()->addMonths(4),
                'description' => 'Bantuan dana penelitian dan tunjangan hidup bagi mahasiswa semester 5 ke atas yang sedang menyusun publikasi ilmiah bereputasi.',
                'requirements' => "1. Mahasiswa aktif minimal semester 5\n2. Proposal riset yang disetujui dosen pembimbing\n3. Target luaran publikasi terindeks SINTA/Scopus",
                'link' => 'https://huxley.ac.id/scholarships/research-fellowship',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=800&q=80',
                'is_active' => true,
            ]);
        }

        // 4. Civitas (Mahasiswa & Staff)
        if (Civitas::count() === 0) {
            Civitas::create([
                'name' => 'Muhammad Rayhan',
                'nip' => '202610370311001',
                'role' => 'Mahasiswa Aktif',
                'type' => 'mahasiswa',
                'department' => 'Teknik Informatika',
                'faculty' => 'Fakultas Ilmu Komputer',
                'email' => 'rayhan@student.huxley.ac.id',
                'phone' => '081234567801',
                'bio' => 'Mahasiswa angkatan 2024 peminat Machine Learning dan Cloud Engineering.',
                'is_active' => true,
            ]);

            Civitas::create([
                'name' => 'Amanda Putri Maharani',
                'nip' => '202610370311002',
                'role' => 'Mahasiswa Aktif',
                'type' => 'mahasiswa',
                'department' => 'Sistem Informasi',
                'faculty' => 'Fakultas Ilmu Komputer',
                'email' => 'amanda@student.huxley.ac.id',
                'phone' => '081234567802',
                'bio' => 'Ketua Himpunan Mahasiswa Sistem Informasi Huxley University.',
                'is_active' => true,
            ]);

            Civitas::create([
                'name' => 'Dimas Arya Pratama',
                'nip' => '202610370311003',
                'role' => 'Mahasiswa Aktif',
                'type' => 'mahasiswa',
                'department' => 'Manajemen Bisnis Digital',
                'faculty' => 'Fakultas Ekonomi & Bisnis',
                'email' => 'dimas@student.huxley.ac.id',
                'phone' => '081234567803',
                'bio' => 'Aktivis kewirausahaan mahasiswa dan peserta program inkubator bisnis kampus.',
                'is_active' => true,
            ]);

            Civitas::create([
                'name' => 'Dr. Ir. Hendra Wijaya, M.Kom.',
                'nip' => '198205122008121001',
                'role' => 'Ketua Program Studi Teknik Informatika',
                'type' => 'dosen',
                'department' => 'Teknik Informatika',
                'faculty' => 'Fakultas Ilmu Komputer',
                'email' => 'hendra.wijaya@huxley.ac.id',
                'phone' => '081398765432',
                'bio' => 'Peneliti terapan bidang Distributed Systems dan Artificial Intelligence.',
                'is_active' => true,
            ]);

            Civitas::create([
                'name' => 'Prof. Dr. Aris Subagyo, Ph.D.',
                'nip' => '197403151999031002',
                'role' => 'Rektor Huxley University',
                'type' => 'pimpinan',
                'department' => 'Rektorat',
                'faculty' => 'Pimpinan Universitas',
                'email' => 'rector@huxley.ac.id',
                'phone' => '02188880001',
                'bio' => 'Guru besar dalam bidang teknologi informasi dan kebijakan pendidikan tinggi internasional.',
                'is_active' => true,
            ]);
        }
    }
}
