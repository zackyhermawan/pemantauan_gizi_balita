<?php

namespace Database\Seeders;

use App\Models\QuranVerse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuranVerseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $verses = [
            // 1. GIZI BAIK
            [
                'status_gizi'  => 'Gizi Baik',
                'surah'        => 'QS. Al-Baqarah : 172',
                'arabic_text'  => 'يَا أَيُّهَا الَّذِينَ آمَنُوا كُلُوا مِنْ طَيِّبَاتِ مَا رَزَقْنَاكُمْ وَاشْكُرُوا لِلَّهِ',
                'translation'  => 'Wahai orang-orang yang beriman, makanlah dari rezeki yang baik yang Kami berikan kepadamu dan bersyukurlah kepada Allah.',
                'meaning'      => 'Alhamdulillah, kondisi Si Kecil sehat. Allah mengingatkan pentingnya mengonsumsi makanan yang baik sebagai bentuk ikhtiar dan rasa syukur atas nikmat kesehatan.',
            ],

            // 2. GIZI KURANG
            [
                'status_gizi'  => 'Gizi Kurang',
                'surah'        => 'QS. Abasa : 24',
                'arabic_text'  => 'فَلْيَنْظُرِ الْإِنْسَانُ إِلَىٰ طَعَامِهِ',
                'translation'  => 'Maka hendaklah manusia itu memperhatikan makannya.',
                'meaning'      => 'Asupan gizi anak adalah amanah. Mari lebih memperhatikan variasi dan gizi piring Si Kecil agar berat badannya kembali naik secara bertahap.',
            ],

            // 3. GIZI LEBIH
            [
                'status_gizi'  => 'Gizi Lebih',
                'surah'        => 'QS. Al-A\'raf : 31',
                'arabic_text'  => 'وَكُلُوا وَاشْرَبُوا وَلَا تُسْرِفُوا ۚ إِنَّهُ لَا يُحِبُّ الْمُسْرِفِينَ',
                'translation'  => 'Makan dan minumlah, tetapi jangan berlebih-lebihan. Sungguh, Allah tidak menyukai orang yang berlebih-lebihan.',
                'meaning'      => 'Anjuran untuk menjaga porsi makan anak agar seimbang. Hindari camilan manis atau makanan instan berlebih agar tumbuh kembangnya tetap ideal.',
            ],

            // 4. GIZI BURUK
            [
                'status_gizi'  => 'Gizi Buruk',
                'surah'        => 'QS. Al-Inshirah : 5-6',
                'arabic_text'  => 'فَإِنَّ مَعَ الْعُسْرِ يُسْرًا ﴿٥﴾ إِنَّ مَعَ الْعُسْرِ يُسْرًا',
                'translation'  => 'Maka sesungguhnya bersama kesulitan ada kemudahan. Sesungguhnya bersama kesulitan ada kemudahan.',
                'meaning'      => 'Tetap semangat dan tidak berkecil hati, Bunda. Segera konsultasikan penanganan medis dan pemenuhan gizi intensif untuk kebaikan Si Kecil.',
            ],

            // 5. OBESITAS
            [
                'status_gizi'  => 'Obesitas',
                'surah'        => 'QS. Al-Muru\'ah (Hikmah Luqman : 17)',
                'arabic_text'  => 'وَاقْصِدْ فِي مَشْيِكَ وَاغْضُضْ مِنْ صَوْتِكَ',
                'translation'  => 'Dan sederhanakanlah engkau dalam berjalan...',
                'meaning'      => 'Pentingnya membiasakan pola hidup seimbang sejak dini. Ajak Si Kecil lebih aktif bergerak dan atur kembali jadwal serta jenis makanannya.',
            ],

            // 6. STUNTING (Jaga-jaga)
            [
                'status_gizi'  => 'Stunting',
                'surah'        => 'QS. An-Nisa : 9',
                'arabic_text'  => 'وَلْيَخْشَ الَّذِينَ لَوْ تَرَكُوا مِنْ خَلْفِهِمْ ذُرِّيَّةً ضِعَافًا خَافُوا عَلَيْهِمْ',
                'translation'  => 'Dan hendaklah takut (kepada Allah) orang-orang yang sekiranya meninggalkan keturunan yang lemah di belakang mereka...',
                'meaning'      => 'Islam mengimbau agar kita menjaga fisik dan masa depan keturunan. Tetap konsisten memberikan asupan tinggi protein hewani dan rutin berkoordinasi dengan posyandu/faskes.',
            ],
        ];

        foreach ($verses as $verse) {
            QuranVerse::updateOrCreate(
                ['status_gizi' => $verse['status_gizi']],
                $verse
            );
        }
    }
}
