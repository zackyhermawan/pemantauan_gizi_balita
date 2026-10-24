<?php

namespace Database\Seeders;

use App\Models\DailyQuote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $quotes = [
            [
                'surah'          => 'QS. Abasa : 24',
                'arabic_text'    => 'فَلْيَنْظُرِ الْإِنْسَانُ إِلَىٰ طَعَامِهِ',
                'translation'    => 'Maka hendaklah manusia itu memperhatikan makannya.',
                'nutrition_note' => 'Memperhatikan makanan anak bukan hanya porsinya, tapi kepastian kecukupan nutrisi makro (karbohidrat, protein) dan mikro (vitamin, mineral).',
            ],
            [
                'surah'          => 'QS. Al-Baqarah : 168',
                'arabic_text'    => 'يَا أَيُّهَا النَّاسُ كُلُوا مِمَّا فِي الْأَرْضِ حَلَالًا طَيِّبًا',
                'translation'    => 'Wahai manusia! Makanlah dari apa yang ada di bumi yang halal lagi baik...',
                'nutrition_note' => 'Prinsip Thayyib pada makanan anak berarti bersih, bergizi, dan aman diproses tanpa bahan pengawet berlebih.',
            ],
            [
                'surah'          => 'QS. Al-A\'raf : 31',
                'arabic_text'    => 'وَكُلُوا وَاشْرَبُوا وَلَا تُسْرِفُوا ۚ إِنَّهُ لَا يُحِبُّ الْمُسْرِفِينَ',
                'translation'    => 'Makan dan minumlah, tetapi jangan berlebih-lebihan. Sungguh, Allah tidak menyukai orang yang berlebih-lebihan.',
                'nutrition_note' => 'Berikan porsi makanan secara seimbang. Hindari membiasakan anak mengonsumsi camilan manis atau siap saji secara berlebihan.',
            ],
            [
                'surah'          => 'QS. Al-Baqarah : 233',
                'arabic_text'    => 'وَالْوَالِدَاتُ يُرْضِعْنَ أَوْلَادَهُنَّ حَوْلَيْنِ كَامِلَيْنِ ۖ لِمَنْ أَرَادَ أَنْ يُتِمَّ الرَّضَاعَةَ',
                'translation'    => 'Dan ibu-ibu hendaklah menyusui anak-anaknya selama dua tahun penuh, bagi yang ingin menyempurnakan penyusuan.',
                'nutrition_note' => 'ASI Eksklusif hingga 6 bulan dan dilanjutkan hingga 2 tahun dengan MPASI bergizi adalah fondasi daya tahan tubuh terbaik untuk anak.',
            ],
        ];

        foreach ($quotes as $quote) {
            DailyQuote::updateOrCreate(['surah' => $quote['surah']], $quote);
        }
    }
}
