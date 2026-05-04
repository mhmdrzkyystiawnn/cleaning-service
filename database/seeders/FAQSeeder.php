<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\FAQ::create([
            'question' => 'Apa saja layanan yang ditawarkan?',
            'answer' => 'Kami menawarkan berbagai layanan pembersihan termasuk pembersihan rumah tangga, kantor, karpet dan perabot, serta pembersihan mendalam.',
            'order' => 1,
        ]);

        \App\Models\FAQ::create([
            'question' => 'Bagaimana cara memesan layanan?',
            'answer' => 'Anda dapat memesan melalui website kami. Pilih paket yang Anda inginkan, isi data pribadi dan lokasi, kemudian konfirmasi booking.',
            'order' => 2,
        ]);

        \App\Models\FAQ::create([
            'question' => 'Berapa biaya tambahan jika lokasi jauh?',
            'answer' => 'Untuk lokasi yang jauh dari pusat kota, ada biaya tambahan rute sebesar Rp 50.000 - Rp 150.000 tergantung jarak.',
            'order' => 3,
        ]);

        \App\Models\FAQ::create([
            'question' => 'Apakah ada garansi kepuasan pelanggan?',
            'answer' => 'Ya, kami memberikan garansi 100% kepuasan pelanggan. Jika tidak puas, kami akan merevisi pembersihan tanpa biaya tambahan.',
            'order' => 4,
        ]);

        \App\Models\FAQ::create([
            'question' => 'Apakah staf Anda tersertifikasi?',
            'answer' => 'Ya, semua staf kami telah melalui pelatihan profesional dan memiliki sertifikat kebersihan dari lembaga terkait.',
            'order' => 5,
        ]);

        \App\Models\FAQ::create([
            'question' => 'Apa kebijakan pembatalan?',
            'answer' => 'Pembatalan dapat dilakukan hingga 24 jam sebelum jadwal pembersihan. Pembatalan kurang dari 24 jam akan dikenakan biaya 50% dari total booking.',
            'order' => 6,
        ]);
    }
}
