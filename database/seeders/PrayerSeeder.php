<?php

namespace Database\Seeders;

use App\Models\Prayer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $prayers = [
            // Nutrisi
            [
                'title'       => 'Doa Sebelum Makan / Suap Anak',
                'category'    => 'Nutrisi',
                'arabic_text' => 'اللَّهُمَّ بَارِكْ لَنَا فِيمَا رَزَقْتَنَا وَقِنَا عَذَابَ النَّارِ',
                'latin_text'  => 'Allahumma baarik lanaa fiimaa razaqtanaa wa qinaa \'adzaaban naar.',
                'translation' => 'Ya Allah, berkahilah kami dalam rezeki yang telah Engkau berikan kepada kami dan peliharalah kami dari siksa neraka.',
                'fadhilah'    => 'Dibaca sebelum menyuapi atau memberikan makanan pada anak.',
            ],
            [
                'title'       => 'Doa Sesudah Makan',
                'category'    => 'Nutrisi',
                'arabic_text' => 'الْحَمْدُ لِلَّهِ الَّذِي أَطْعَمَنَا وَسَقَانَا وَجَعَلَنَا مُسْلِمِينَ',
                'latin_text'  => 'Alhamdu lillahilladzii ath\'amanaa wa saqaanaa wa ja\'alanaa muslimiin.',
                'translation' => 'Segala puji bagi Allah yang telah memberi kami makan dan minum serta menjadikan kami termasuk golongan orang-orang muslim.',
                'fadhilah'    => 'Ungkapan rasa syukur atas rezeki makanan sehat hari ini.',
            ],
            // Kesehatan
            [
                'title'       => 'Doa Memohon Kesehatan & Perlindungan Anak',
                'category'    => 'Kesehatan',
                'arabic_text' => 'أُعِيذُهُ بِكَلِمَاتِ اللَّهِ التَّامَّةِ مِنْ كُلِّ شَيْطَانٍ وَهَامَّةٍ وَمِنْ كُلِّ عَيْنٍ لَامَّةٍ',
                'latin_text'  => 'U\'iidzuhuu bikalimaatillaahit-taammati min kulli syaithaanin wa haammatin wa min kulli \'ainin laammatin.',
                'translation' => 'Aku memohon perlindungan untuknya dengan kalimat-kalimat Allah yang sempurna dari setiap setan, binatang berbisa, dan dari setiap mata yang dengki.',
                'fadhilah'    => 'Doa Rasulullah SAW untuk melindungi anak cucunya dari penyakit dan gangguan.',
            ],
            [
                'title'       => 'Doa Saat Anak Sakit / Demam',
                'category'    => 'Kesehatan',
                'arabic_text' => 'اللَّهُمَّ رَبَّ النَّاسِ أَذْهِبِ الْبَأْسَ اشْفِ أَنْتَ الشَّافِي لَا شِفَاءَ إِلَّا شِفَاؤُكَ',
                'latin_text'  => 'Allahumma rabban-naasi adzhibil-ba\'sa isyfi antasy-syaafii laa syifaa\'a illaa syifaa\'uka.',
                'translation' => 'Ya Allah, Tuhan manusia, hilangkanlah penyakit ini. Sembuhkanlah, Engkau-lah Yang Maha Menyembuhkan, tidak ada kesembuhan kecuali kesembuhan dari-Mu.',
                'fadhilah'    => 'Dibaca sambil mengusap kepala atau bagian tubuh anak yang sakit.',
            ],
            // Tumbuh Kembang
            [
                'title'       => 'Doa Agar Anak Tumbuh Cerdas & Sholeh',
                'category'    => 'Tumbuh Kembang',
                'arabic_text' => 'رَبَّنَا هَبْ لَنَا مِنْ أَزْوَاجِنَا وَذُرِّيَّاتِنَا قُرَّةَ أَعْيُنٍ وَاجْعَلْنَا لِلْمُتَّقِينَ إِمَامًا',
                'latin_text'  => 'Rabbanaa hab lanaa min azwaajinaa wa dzurriyyaatinaa qurrata a\'yunin waj\'alnaa lil-muttaqiina imaamaa.',
                'translation' => 'Ya Tuhan kami, anugerahkanlah kepada kami pasangan kami dan keturunan kami sebagai penyenang hati (kami), dan jadikanlah kami pemimpin bagi orang-orang yang bertakwa.',
                'fadhilah'    => 'QS. Al-Furqan : 74. Baik dibaca setelah shalat fardhu.',
            ],
        ];

        foreach ($prayers as $prayer) {
            Prayer::updateOrCreate(['title' => $prayer['title']], $prayer);
        }
    }
}
