<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('states')->delete();
        
        \DB::table('states')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 1,
                'name_ar' => 'القاهرة',
                'name_en' => 'Cairo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 1,
                'name_ar' => 'الجيزة',
                'name_en' => 'Giza',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 1,
                'name_ar' => 'الأسكندرية',
                'name_en' => 'Alexandria',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 1,
                'name_ar' => 'الدقهلية',
                'name_en' => 'Dakahlia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 1,
                'name_ar' => 'البحر الأحمر',
                'name_en' => 'Red Sea',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 1,
                'name_ar' => 'البحيرة',
                'name_en' => 'Beheira',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'country_id' => 1,
                'name_ar' => 'الفيوم',
                'name_en' => 'Fayoum',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'country_id' => 1,
                'name_ar' => 'الغربية',
                'name_en' => 'Gharbiya',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'country_id' => 1,
                'name_ar' => 'الإسماعلية',
                'name_en' => 'Ismailia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'country_id' => 1,
                'name_ar' => 'المنوفية',
                'name_en' => 'Monofia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'country_id' => 1,
                'name_ar' => 'المنيا',
                'name_en' => 'Minya',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'country_id' => 1,
                'name_ar' => 'القليوبية',
                'name_en' => 'Qaliubiya',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'country_id' => 1,
                'name_ar' => 'الوادي الجديد',
                'name_en' => 'New Valley',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'country_id' => 1,
                'name_ar' => 'السويس',
                'name_en' => 'Suez',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'country_id' => 1,
                'name_ar' => 'اسوان',
                'name_en' => 'Aswan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'country_id' => 1,
                'name_ar' => 'اسيوط',
                'name_en' => 'Assiut',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'country_id' => 1,
                'name_ar' => 'بني سويف',
                'name_en' => 'Beni Suef',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'country_id' => 1,
                'name_ar' => 'بورسعيد',
                'name_en' => 'Port Said',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'country_id' => 1,
                'name_ar' => 'دمياط',
                'name_en' => 'Damietta',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'country_id' => 1,
                'name_ar' => 'الشرقية',
                'name_en' => 'Sharkia',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'country_id' => 1,
                'name_ar' => 'جنوب سيناء',
                'name_en' => 'South Sinai',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'country_id' => 1,
                'name_ar' => 'كفر الشيخ',
                'name_en' => 'Kafr Al sheikh',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'country_id' => 1,
                'name_ar' => 'مطروح',
                'name_en' => 'Matrouh',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'country_id' => 1,
                'name_ar' => 'الأقصر',
                'name_en' => 'Luxor',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'country_id' => 1,
                'name_ar' => 'قنا',
                'name_en' => 'Qena',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'country_id' => 1,
                'name_ar' => 'شمال سيناء',
                'name_en' => 'North Sinai',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'country_id' => 1,
                'name_ar' => 'سوهاج',
                'name_en' => 'Sohag',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'country_id' => 2,
                'name_ar' => ' الرياض  ',
                'name_en' => ' Riyadh  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'country_id' => 2,
                'name_ar' => ' جدة  ',
                'name_en' => ' Jeddah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'country_id' => 2,
                'name_ar' => ' الدمام  ',
                'name_en' => ' Al-Dammam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'country_id' => 2,
                'name_ar' => ' الخبر  ',
                'name_en' => ' Al-Khobar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'country_id' => 2,
                'name_ar' => ' الدوادمي  ',
                'name_en' => ' Al-Duwadimi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'country_id' => 2,
                'name_ar' => ' خميس مشيط  ',
                'name_en' => ' Khamis Mushait  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'country_id' => 2,
                'name_ar' => ' حفر الباطن  ',
                'name_en' => ' Hafar Al Batin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'country_id' => 2,
                'name_ar' => ' نجران  ',
                'name_en' => ' Najran  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'country_id' => 2,
                'name_ar' => ' مكة المكرمة  ',
                'name_en' => ' Makkah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'country_id' => 2,
                'name_ar' => ' جازان  ',
                'name_en' => ' Jazan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'country_id' => 2,
                'name_ar' => ' الظهران  ',
                'name_en' => ' Al-Dhahran  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'country_id' => 2,
                'name_ar' => ' المدينة المنورة  ',
                'name_en' => ' El-Medina  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'country_id' => 2,
                'name_ar' => ' الاحساء  ',
                'name_en' => ' Al-Ahsa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'country_id' => 2,
                'name_ar' => ' بريدة  ',
                'name_en' => ' Buraydah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'country_id' => 2,
                'name_ar' => ' عنيزه  ',
                'name_en' => ' Unayzah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'country_id' => 2,
                'name_ar' => ' حائل  ',
                'name_en' => ' Hail  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'country_id' => 2,
                'name_ar' => ' الطائف  ',
                'name_en' => ' Taif  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'country_id' => 2,
                'name_ar' => ' أبها  ',
                'name_en' => ' Abha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'country_id' => 3,
                'name_ar' => ' دبي  ',
                'name_en' => ' Dubai  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'country_id' => 3,
                'name_ar' => ' أبوظبي  ',
                'name_en' => ' Abu Dhabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'country_id' => 3,
                'name_ar' => ' الشارقة  ',
                'name_en' => ' Sharjah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'country_id' => 3,
                'name_ar' => ' عجمان  ',
                'name_en' => ' Ajman  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'country_id' => 3,
                'name_ar' => ' العين  ',
                'name_en' => ' Al Ain  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'country_id' => 3,
                'name_ar' => ' رأس الخيمة  ',
                'name_en' => ' Ras El Khaimah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'country_id' => 3,
                'name_ar' => ' أم القيوين  ',
                'name_en' => ' Umm Al Quwain  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'country_id' => 4,
                'name_ar' => 'California ',
                'name_en' => 'California ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'country_id' => 4,
                'name_ar' => 'Texas ',
                'name_en' => 'Texas ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'country_id' => 4,
                'name_ar' => 'Florida ',
                'name_en' => 'Florida ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'country_id' => 4,
                'name_ar' => 'New York ',
                'name_en' => 'New York ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'country_id' => 4,
                'name_ar' => 'Pennsylvania ',
                'name_en' => 'Pennsylvania ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'country_id' => 4,
                'name_ar' => 'Illinois ',
                'name_en' => 'Illinois ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'country_id' => 4,
                'name_ar' => 'Ohio ',
                'name_en' => 'Ohio ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'country_id' => 4,
                'name_ar' => 'Georgia ',
                'name_en' => 'Georgia ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'country_id' => 4,
                'name_ar' => 'North Carolina ',
                'name_en' => 'North Carolina ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'country_id' => 4,
                'name_ar' => 'Michigan ',
                'name_en' => 'Michigan ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'country_id' => 4,
                'name_ar' => 'New Jersey ',
                'name_en' => 'New Jersey ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'country_id' => 4,
                'name_ar' => 'Virginia ',
                'name_en' => 'Virginia ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'country_id' => 4,
                'name_ar' => 'Washington ',
                'name_en' => 'Washington ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'country_id' => 4,
                'name_ar' => 'Arizona ',
                'name_en' => 'Arizona ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'country_id' => 4,
                'name_ar' => 'Massachusetts ',
                'name_en' => 'Massachusetts ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'country_id' => 4,
                'name_ar' => 'Tennessee ',
                'name_en' => 'Tennessee ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'country_id' => 4,
                'name_ar' => 'Indiana ',
                'name_en' => 'Indiana ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'country_id' => 4,
                'name_ar' => 'Missouri ',
                'name_en' => 'Missouri ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'country_id' => 4,
                'name_ar' => 'Maryland ',
                'name_en' => 'Maryland ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'country_id' => 4,
                'name_ar' => 'Wisconsin ',
                'name_en' => 'Wisconsin ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'country_id' => 4,
                'name_ar' => 'Colorado ',
                'name_en' => 'Colorado ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'country_id' => 4,
                'name_ar' => 'Minnesota ',
                'name_en' => 'Minnesota ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'country_id' => 4,
                'name_ar' => 'South Carolina ',
                'name_en' => 'South Carolina ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'country_id' => 4,
                'name_ar' => 'Albama ',
                'name_en' => 'Albama ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'country_id' => 4,
                'name_ar' => 'Louisiana ',
                'name_en' => 'Louisiana ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'country_id' => 4,
                'name_ar' => 'Kentucky ',
                'name_en' => 'Kentucky ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'country_id' => 4,
                'name_ar' => 'Oregon ',
                'name_en' => 'Oregon ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'country_id' => 4,
                'name_ar' => 'Oklahoma ',
                'name_en' => 'Oklahoma ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'country_id' => 4,
                'name_ar' => 'Connecticut ',
                'name_en' => 'Connecticut ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'country_id' => 4,
                'name_ar' => 'Utah ',
                'name_en' => 'Utah ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'country_id' => 4,
                'name_ar' => 'Puerto Rico ',
                'name_en' => 'Puerto Rico ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'country_id' => 4,
                'name_ar' => 'Iowa ',
                'name_en' => 'Iowa ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'country_id' => 4,
                'name_ar' => 'Nevada ',
                'name_en' => 'Nevada ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'country_id' => 4,
                'name_ar' => 'Arkansas ',
                'name_en' => 'Arkansas ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'country_id' => 4,
                'name_ar' => 'Mississippi ',
                'name_en' => 'Mississippi ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'country_id' => 4,
                'name_ar' => 'Kansas ',
                'name_en' => 'Kansas ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'country_id' => 4,
                'name_ar' => 'New Mexico ',
                'name_en' => 'New Mexico ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'country_id' => 4,
                'name_ar' => 'Nebraska ',
                'name_en' => 'Nebraska ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'country_id' => 4,
                'name_ar' => 'West Virginia ',
                'name_en' => 'West Virginia ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'country_id' => 4,
                'name_ar' => 'Idaho ',
                'name_en' => 'Idaho ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'country_id' => 4,
                'name_ar' => 'Hawaii ',
                'name_en' => 'Hawaii ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'country_id' => 4,
                'name_ar' => 'New Hampshire ',
                'name_en' => 'New Hampshire ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'country_id' => 4,
                'name_ar' => 'Maine ',
                'name_en' => 'Maine ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'country_id' => 4,
                'name_ar' => 'Montana ',
                'name_en' => 'Montana ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'country_id' => 4,
                'name_ar' => 'Rhode Island ',
                'name_en' => 'Rhode Island ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'country_id' => 4,
                'name_ar' => 'Delaware ',
                'name_en' => 'Delaware ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'country_id' => 4,
                'name_ar' => 'South Dakota ',
                'name_en' => 'South Dakota ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'country_id' => 4,
                'name_ar' => 'North Dakota ',
                'name_en' => 'North Dakota ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'country_id' => 4,
                'name_ar' => 'Alaska ',
                'name_en' => 'Alaska ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'country_id' => 4,
                'name_ar' => 'Vermont ',
                'name_en' => 'Vermont ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'country_id' => 4,
                'name_ar' => 'Wyoming ',
                'name_en' => 'Wyoming ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'country_id' => 4,
                'name_ar' => 'Guam ',
                'name_en' => 'Guam ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'country_id' => 4,
                'name_ar' => 'U.S. Virign Islands ',
                'name_en' => 'U.S. Virign Islands ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'country_id' => 4,
                'name_ar' => 'Northern Mariana Islands ',
                'name_en' => 'Northern Mariana Islands ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'country_id' => 4,
                'name_ar' => 'American Samoa ',
                'name_en' => 'American Samoa ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'country_id' => 5,
                'name_ar' => 'الأحمدي ',
                'name_en' => 'Al-Ahmadi ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'country_id' => 5,
                'name_ar' => 'مبارك الكبير ',
                'name_en' => 'Mubarak Al Kabeer  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'country_id' => 5,
                'name_ar' => 'الفروانية ',
                'name_en' => 'Al Farwaniyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'country_id' => 5,
                'name_ar' => 'الجهراء ',
                'name_en' => 'Al Jahra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'country_id' => 5,
                'name_ar' => 'حولي ',
                'name_en' => 'Hawalii  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'country_id' => 5,
                'name_ar' => 'مدينة الكويت ',
                'name_en' => 'Kuwait City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'country_id' => 6,
                'name_ar' => 'Nairobi ',
                'name_en' => 'Nairobi ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'country_id' => 6,
                'name_ar' => 'Coast Region ',
                'name_en' => 'Coast Region ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'country_id' => 6,
                'name_ar' => 'Rift Valley Region ',
                'name_en' => 'Rift Valley Region ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'country_id' => 6,
                'name_ar' => 'Eastern Region ',
                'name_en' => 'Eastern Region ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'country_id' => 6,
                'name_ar' => 'Central Region ',
                'name_en' => 'Central Region ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'country_id' => 6,
                'name_ar' => 'Western Region ',
                'name_en' => 'Western Region ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'country_id' => 7,
                'name_ar' => 'العقبة ',
                'name_en' => 'Al-aqaba ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'country_id' => 7,
                'name_ar' => 'عمّان ',
                'name_en' => 'Amman ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'country_id' => 7,
                'name_ar' => 'السلط ',
                'name_en' => 'Salt ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'country_id' => 7,
                'name_ar' => 'المفرق ',
                'name_en' => 'Mafraq ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'country_id' => 7,
                'name_ar' => 'مادبا ',
                'name_en' => 'Madaba ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'country_id' => 7,
                'name_ar' => 'الزرقاء ',
                'name_en' => 'Al-Zarqa ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'country_id' => 7,
                'name_ar' => 'إربد ',
                'name_en' => 'Irbid ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'country_id' => 7,
                'name_ar' => 'معان ',
                'name_en' => 'Maan ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'country_id' => 7,
                'name_ar' => 'الطفيلة ',
                'name_en' => 'Tafilah ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'country_id' => 7,
                'name_ar' => 'الكرك ',
                'name_en' => 'Al-Karak ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'country_id' => 7,
                'name_ar' => 'عجلون ',
                'name_en' => 'Ajloun ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'country_id' => 7,
                'name_ar' => 'جرش ',
                'name_en' => 'Jerash ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}