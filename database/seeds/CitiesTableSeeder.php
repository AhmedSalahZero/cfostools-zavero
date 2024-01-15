<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cities')->delete();
        
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'state_id' => 28,
                'name_ar' => ' السليمانية  ',
                'name_en' => ' Al Sulaimaniyah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'state_id' => 28,
                'name_ar' => ' الملك فهد  ',
                'name_en' => ' King Fahad ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'state_id' => 28,
                'name_ar' => ' الورود  ',
                'name_en' => ' Al Worood ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'state_id' => 28,
                'name_ar' => ' المصيف  ',
                'name_en' => ' Al Maseef ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'state_id' => 28,
                'name_ar' => ' المروج  ',
                'name_en' => ' Al Muruj ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'state_id' => 28,
                'name_ar' => ' المرسلات  ',
                'name_en' => ' Al Morsalat ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'state_id' => 28,
                'name_ar' => ' الغدير  ',
                'name_en' => ' Al Ghadeer ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'state_id' => 28,
                'name_ar' => ' الواحة  ',
                'name_en' => ' Al Wahah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'state_id' => 28,
                'name_ar' => ' الرحمانية  ',
                'name_en' => ' Ar Rahmaniyyah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'state_id' => 28,
                'name_ar' => ' أشبيلية  ',
                'name_en' => ' Ishbiliyah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'state_id' => 28,
                'name_ar' => ' الأزدهار  ',
                'name_en' => ' Al Izdihar ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'state_id' => 28,
                'name_ar' => ' البديعة  ',
                'name_en' => ' Al Badiah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'state_id' => 28,
                'name_ar' => ' البطحاء  ',
                'name_en' => ' Al Batha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'state_id' => 28,
                'name_ar' => ' التخصصي  ',
                'name_en' => ' Takhassusi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'state_id' => 28,
                'name_ar' => ' التعاون  ',
                'name_en' => ' Al Taawun ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'state_id' => 28,
                'name_ar' => ' الجنادرية  ',
                'name_en' => ' Al Janadriyah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'state_id' => 28,
                'name_ar' => ' الحمرا  ',
                'name_en' => ' Al Hamra ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'state_id' => 28,
                'name_ar' => ' الخليج  ',
                'name_en' => ' Al khaleej ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'state_id' => 28,
                'name_ar' => ' الدرعية  ',
                'name_en' => ' Ad Diriyah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'state_id' => 28,
                'name_ar' => ' الرائد  ',
                'name_en' => ' Al Raed ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'state_id' => 28,
                'name_ar' => ' الربوة  ',
                'name_en' => ' Al Rabwah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'state_id' => 28,
                'name_ar' => ' الربيع  ',
                'name_en' => ' Al Rabie ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'state_id' => 28,
                'name_ar' => ' الروابي  ',
                'name_en' => ' Al Rawabi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'state_id' => 28,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Rawdah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'state_id' => 28,
                'name_ar' => ' الريان  ',
                'name_en' => ' Al Rayyan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'state_id' => 28,
                'name_ar' => ' الزهرة  ',
                'name_en' => ' Al Zahrah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'state_id' => 28,
                'name_ar' => ' السعادة  ',
                'name_en' => ' Al Saadah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'state_id' => 28,
                'name_ar' => ' السفارات  ',
                'name_en' => ' Al Safarat ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'state_id' => 28,
                'name_ar' => ' السلام  ',
                'name_en' => ' Al Salam ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'state_id' => 28,
                'name_ar' => ' السلي  ',
                'name_en' => ' As Sulay ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'state_id' => 28,
                'name_ar' => ' السويدي  ',
                'name_en' => ' Al Suwaidi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'state_id' => 28,
                'name_ar' => ' الشفى  ',
                'name_en' => ' Al Shifa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'state_id' => 28,
                'name_ar' => ' الشميسي  ',
                'name_en' => ' Al Shimaisi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'state_id' => 28,
                'name_ar' => ' الشهداء  ',
                'name_en' => ' Al Shuhada ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'state_id' => 28,
                'name_ar' => ' الصحافة  ',
                'name_en' => ' Al Sahafa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'state_id' => 28,
                'name_ar' => ' العريجاء  ',
                'name_en' => ' Al Uraija  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'state_id' => 28,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyah   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'state_id' => 28,
                'name_ar' => ' العقيق  ',
                'name_en' => ' Al Aqiq  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'state_id' => 28,
                'name_ar' => ' العليا  ',
                'name_en' => ' Al Olaya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'state_id' => 28,
                'name_ar' => ' الفلاح  ',
                'name_en' => ' Al Falah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'state_id' => 28,
                'name_ar' => ' الفيحاء  ',
                'name_en' => ' Al Fayha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'state_id' => 28,
                'name_ar' => ' القدس  ',
                'name_en' => ' Al Quds  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'state_id' => 28,
                'name_ar' => ' المحمدية  ',
                'name_en' => ' Al Mohammadiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'state_id' => 28,
                'name_ar' => ' المربع  ',
                'name_en' => ' Al Murabba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'state_id' => 28,
                'name_ar' => ' المروة  ',
                'name_en' => ' Al Marwah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'state_id' => 28,
                'name_ar' => ' المشاعل  ',
                'name_en' => ' Al Mashael  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'state_id' => 28,
                'name_ar' => ' المعذر  ',
                'name_en' => ' Al Maazer  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'state_id' => 28,
                'name_ar' => ' المعذر الشمالي  ',
                'name_en' => ' Al Mathar Ash Shamali  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'state_id' => 28,
                'name_ar' => ' المغرزات  ',
                'name_en' => ' Al Mughrizat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'state_id' => 28,
                'name_ar' => ' الملز  ',
                'name_en' => ' Al Malaz  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'state_id' => 28,
                'name_ar' => ' الملقا  ',
                'name_en' => ' Al Malqa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'state_id' => 28,
                'name_ar' => ' المؤتمرات  ',
                'name_en' => ' Al Mutamarat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'state_id' => 28,
                'name_ar' => ' المونسية  ',
                'name_en' => ' Al Munsiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'state_id' => 28,
                'name_ar' => ' الندوة  ',
                'name_en' => ' Al Nadwa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'state_id' => 28,
                'name_ar' => ' النرجس  ',
                'name_en' => ' Al Narjis  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'state_id' => 28,
                'name_ar' => ' النزهة  ',
                'name_en' => ' Al Nozha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'state_id' => 28,
                'name_ar' => ' النسيم الشرقي  ',
                'name_en' => ' Al Naseem Al Sharqi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'state_id' => 28,
                'name_ar' => ' النسيم الغربي  ',
                'name_en' => ' Al Naseem Al Gharbi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'state_id' => 28,
                'name_ar' => ' النظيم  ',
                'name_en' => ' Al Nazim  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'state_id' => 28,
                'name_ar' => ' النفل  ',
                'name_en' => ' Al Nafal  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'state_id' => 28,
                'name_ar' => ' النهضة  ',
                'name_en' => ' Al Nahdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'state_id' => 28,
                'name_ar' => ' الوادي  ',
                'name_en' => ' Al Wadi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'state_id' => 28,
                'name_ar' => ' الوزارات  ',
                'name_en' => ' Al Wizarat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'state_id' => 28,
                'name_ar' => ' الياسمين  ',
                'name_en' => ' Al Yasmin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'state_id' => 28,
                'name_ar' => ' اليرموك  ',
                'name_en' => ' Al Yarmuk  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'state_id' => 28,
                'name_ar' => ' أم حمام  ',
                'name_en' => ' UM Alhammam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'state_id' => 28,
                'name_ar' => ' حطين  ',
                'name_en' => ' Hittin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'state_id' => 28,
                'name_ar' => ' حي بدر  ',
                'name_en' => ' Badr  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'state_id' => 28,
                'name_ar' => ' شبرا  ',
                'name_en' => ' Shubra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'state_id' => 28,
                'name_ar' => ' صلاح الدين  ',
                'name_en' => ' Salah Al Din  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'state_id' => 28,
                'name_ar' => ' طويق  ',
                'name_en' => ' Tuwaiq  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'state_id' => 28,
                'name_ar' => ' ظهرة لبن  ',
                'name_en' => ' Dhahrat Laban  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'state_id' => 28,
                'name_ar' => ' عرقة  ',
                'name_en' => ' Irqah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'state_id' => 28,
                'name_ar' => ' عكاظ  ',
                'name_en' => ' Okaz  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'state_id' => 28,
                'name_ar' => ' غبيرة  ',
                'name_en' => ' Ghubairah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'state_id' => 28,
                'name_ar' => ' غرناطة  ',
                'name_en' => ' Ghirnatah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'state_id' => 28,
                'name_ar' => ' قرطبة  ',
                'name_en' => ' Qurtubah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'state_id' => 28,
                'name_ar' => ' لبن  ',
                'name_en' => ' Laban  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'state_id' => 28,
                'name_ar' => ' منفوحة  ',
                'name_en' => ' Manfuhah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'state_id' => 28,
                'name_ar' => ' نمار  ',
                'name_en' => ' Namar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'state_id' => 28,
                'name_ar' => ' وادي لبن  ',
                'name_en' => ' Wadi Laban  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'state_id' => 29,
                'name_ar' => ' الشاطئ  ',
                'name_en' => ' Al Shati  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'state_id' => 29,
                'name_ar' => ' الفصيلية  ',
                'name_en' => ' Al Faisaliyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'state_id' => 29,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Rawdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'state_id' => 29,
                'name_ar' => ' السلامة  ',
                'name_en' => ' Al Salamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'state_id' => 29,
                'name_ar' => ' الصفا  ',
                'name_en' => ' El Safa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'state_id' => 29,
                'name_ar' => ' الأندلس  ',
                'name_en' => ' Al Andalus  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'state_id' => 29,
                'name_ar' => ' المروة  ',
                'name_en' => ' Al Marwah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'state_id' => 29,
                'name_ar' => ' الزهراء  ',
                'name_en' => ' Al Zahraa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'state_id' => 29,
                'name_ar' => ' البوادي  ',
                'name_en' => ' Al Bawadi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'state_id' => 29,
                'name_ar' => ' أبحر الجنوبية  ',
                'name_en' => ' Obhur Al Janoobiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'state_id' => 29,
                'name_ar' => ' أبحر الشمالية  ',
                'name_en' => ' Obhur Al Shamaliyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'state_id' => 29,
                'name_ar' => ' أبرق الرغامة  ',
                'name_en' => ' Abruq Ar Rughamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'state_id' => 29,
                'name_ar' => ' الأجاويد  ',
                'name_en' => ' Al Ajaweed  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'state_id' => 29,
                'name_ar' => ' البساتين  ',
                'name_en' => ' Al Bsateen  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'state_id' => 29,
                'name_ar' => ' البلد  ',
                'name_en' => ' Al Balad  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'state_id' => 29,
                'name_ar' => ' الثغر  ',
                'name_en' => ' Althagher  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'state_id' => 29,
                'name_ar' => ' الجامعة  ',
                'name_en' => ' Al Jam’iah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'state_id' => 29,
                'name_ar' => ' الحمدانية  ',
                'name_en' => ' Al Hamadaniyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'state_id' => 29,
                'name_ar' => ' الحمرا  ',
                'name_en' => ' Al Hamra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'state_id' => 29,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Al Khaldiya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'state_id' => 29,
                'name_ar' => ' الرحاب  ',
                'name_en' => ' Al Rehab  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'state_id' => 29,
                'name_ar' => ' الروابي  ',
                'name_en' => ' Al Rawabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'state_id' => 29,
                'name_ar' => ' الرويس  ',
                'name_en' => ' Al Ruwais  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'state_id' => 29,
                'name_ar' => ' السامر  ',
                'name_en' => ' Alsamer  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'state_id' => 29,
                'name_ar' => ' السليمانية  ',
                'name_en' => ' Al Sulymaniya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'state_id' => 29,
                'name_ar' => ' السنابل  ',
                'name_en' => ' Al Sanabel  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'state_id' => 29,
                'name_ar' => ' الفيحاء  ',
                'name_en' => ' Al Fayhaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'state_id' => 29,
                'name_ar' => ' المحاميد  ',
                'name_en' => ' Al Mahameed  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'state_id' => 29,
                'name_ar' => ' المحجر  ',
                'name_en' => ' Al Mahjar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'state_id' => 29,
                'name_ar' => ' المحمدية  ',
                'name_en' => ' Al Muhamdeya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'state_id' => 29,
                'name_ar' => ' المنار  ',
                'name_en' => ' Al Manar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'state_id' => 29,
                'name_ar' => ' النزهة  ',
                'name_en' => ' Al Nuzhah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'state_id' => 29,
                'name_ar' => ' النسيم  ',
                'name_en' => ' Al Naseem  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'state_id' => 29,
                'name_ar' => ' النعيم  ',
                'name_en' => ' Al Naeem  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'state_id' => 29,
                'name_ar' => ' النهضة  ',
                'name_en' => ' Al Nahda  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'state_id' => 29,
                'name_ar' => ' الوزيرية  ',
                'name_en' => ' Al-Wazeeriyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'state_id' => 29,
                'name_ar' => ' بريمان  ',
                'name_en' => ' Buriman  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'state_id' => 29,
                'name_ar' => ' بني مالك  ',
                'name_en' => ' Bani Malik  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'state_id' => 29,
                'name_ar' => ' طيبة  ',
                'name_en' => ' Tiba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'state_id' => 29,
                'name_ar' => ' قويزة  ',
                'name_en' => ' Quwaizah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'state_id' => 29,
                'name_ar' => ' مريخ  ',
                'name_en' => ' Mraykh  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'state_id' => 29,
                'name_ar' => ' مشرفة  ',
                'name_en' => ' Mishrifah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'state_id' => 30,
                'name_ar' => ' البادية  ',
                'name_en' => ' Al Badiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'state_id' => 30,
                'name_ar' => ' الراكة الشمالية  ',
                'name_en' => ' Al Rakah Ash Shamaliyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'state_id' => 30,
                'name_ar' => ' الطبيشي  ',
                'name_en' => ' Al Tubayshi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'state_id' => 30,
                'name_ar' => ' المحمدية  ',
                'name_en' => ' Al Muhammadiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'state_id' => 30,
                'name_ar' => ' الجوهرة  ',
                'name_en' => ' Al Jawharah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'state_id' => 30,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'state_id' => 30,
                'name_ar' => ' الزهور  ',
                'name_en' => ' Al Zuhur  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'state_id' => 30,
                'name_ar' => ' الجلوية  ',
                'name_en' => ' Al Jalawiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 132,
                'state_id' => 30,
                'name_ar' => ' النخيل  ',
                'name_en' => ' Al Nakhil  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 133,
                'state_id' => 30,
                'name_ar' => ' أحد  ',
                'name_en' => ' Uhud  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 134,
                'state_id' => 30,
                'name_ar' => ' البديع  ',
                'name_en' => ' Al Badi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 135,
                'state_id' => 30,
                'name_ar' => ' الحمرا  ',
                'name_en' => ' Al Hamra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 136,
                'state_id' => 30,
                'name_ar' => ' الدانة  ',
                'name_en' => ' Al Dana  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 137,
                'state_id' => 30,
                'name_ar' => ' الشاطئ  ',
                'name_en' => ' Al Shati  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 138,
                'state_id' => 30,
                'name_ar' => ' العدامة  ',
                'name_en' => ' Al Adamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 139,
                'state_id' => 30,
                'name_ar' => ' الفيصلية  ',
                'name_en' => ' Al Faisaliyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 140,
                'state_id' => 30,
                'name_ar' => ' المريكبات  ',
                'name_en' => ' Al Muraikabat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 141,
                'state_id' => 30,
                'name_ar' => ' المزروعية  ',
                'name_en' => ' Al Mazruiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 142,
                'state_id' => 30,
                'name_ar' => ' النور  ',
                'name_en' => ' An Nur  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 143,
                'state_id' => 31,
                'name_ar' => ' الراكة الجنوبية  ',
                'name_en' => ' Al Rakah Al Janubiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 144,
                'state_id' => 31,
                'name_ar' => ' الخزامي  ',
                'name_en' => ' Al Khuzama  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 145,
                'state_id' => 31,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 146,
                'state_id' => 31,
                'name_ar' => ' أشبيلية  ',
                'name_en' => ' Ishbilia  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 147,
                'state_id' => 31,
                'name_ar' => ' الجسر  ',
                'name_en' => ' Al Jisr  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 148,
                'state_id' => 31,
                'name_ar' => ' الحمرا  ',
                'name_en' => ' Al Hamra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 149,
                'state_id' => 31,
                'name_ar' => ' الخبر الجنوبية  ',
                'name_en' => ' Al Khobar Al Janubiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 150,
                'state_id' => 31,
                'name_ar' => ' مدينة العمال  ',
                'name_en' => ' Madinat Al Umal  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 151,
                'state_id' => 31,
                'name_ar' => ' الهداء  ',
                'name_en' => ' Al Hada  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 152,
                'state_id' => 31,
                'name_ar' => ' الأندلس  ',
                'name_en' => ' Al Andalus  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 153,
                'state_id' => 31,
                'name_ar' => ' البحيرة  ',
                'name_en' => ' Al Buhaira  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 154,
                'state_id' => 31,
                'name_ar' => ' البندرية  ',
                'name_en' => ' Al Bandariyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 155,
                'state_id' => 31,
                'name_ar' => ' الثقبة  ',
                'name_en' => ' Al-Thuqbah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 156,
                'state_id' => 31,
                'name_ar' => ' الحزام الأخضر  ',
                'name_en' => ' Al Hizam Al Akhdar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 157,
                'state_id' => 31,
                'name_ar' => ' الحزام الذهبي  ',
                'name_en' => ' Al Hizam Al Thahabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 158,
                'state_id' => 31,
                'name_ar' => ' الخبر الشمالية  ',
                'name_en' => ' Al Khobar Al Shamalia  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 159,
                'state_id' => 31,
                'name_ar' => ' الروابي  ',
                'name_en' => ' Ar Rawabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 160,
                'state_id' => 31,
                'name_ar' => ' العقربية  ',
                'name_en' => ' Al Aqrabiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 161,
                'state_id' => 31,
                'name_ar' => ' العليا  ',
                'name_en' => ' Al Ulaya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 162,
                'state_id' => 31,
                'name_ar' => ' اليرموك  ',
                'name_en' => ' Al Yarmouk  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 163,
                'state_id' => 31,
                'name_ar' => ' قرطبة  ',
                'name_en' => ' Qurtoba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 164,
                'state_id' => 32,
                'name_ar' => ' النهضة  ',
                'name_en' => ' Al Nahdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 165,
                'state_id' => 32,
                'name_ar' => ' القدس  ',
                'name_en' => ' Al Qudus  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 166,
                'state_id' => 32,
                'name_ar' => ' الحرمين  ',
                'name_en' => ' Al Harmin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 167,
                'state_id' => 32,
                'name_ar' => ' السلام  ',
                'name_en' => ' Al Salam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 168,
                'state_id' => 32,
                'name_ar' => ' الفيصلية  ',
                'name_en' => ' Al Faisaliah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 169,
                'state_id' => 33,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Al Khalidiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 170,
                'state_id' => 33,
                'name_ar' => ' حي النسيم  ',
                'name_en' => ' Al Nasim  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 171,
                'state_id' => 33,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 172,
                'state_id' => 33,
                'name_ar' => ' الصقور  ',
                'name_en' => ' Al Suqur  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 173,
                'state_id' => 33,
                'name_ar' => ' النخيل  ',
                'name_en' => ' Al Nakhil  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 174,
                'state_id' => 33,
                'name_ar' => ' الفتح  ',
                'name_en' => ' Al Fath  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 175,
                'state_id' => 33,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Rawdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 176,
                'state_id' => 33,
                'name_ar' => ' السد  ',
                'name_en' => ' Al Sadd  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 177,
                'state_id' => 33,
                'name_ar' => ' الشرفية  ',
                'name_en' => ' Al Sharafiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 178,
                'state_id' => 33,
                'name_ar' => ' شكر  ',
                'name_en' => ' Shakar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 179,
                'state_id' => 34,
                'name_ar' => ' البلدية  ',
                'name_en' => ' Al Baladiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 180,
                'state_id' => 34,
                'name_ar' => ' أبو موسى الأشعري  ',
                'name_en' => ' Abu Musa Al Ashari  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 181,
                'state_id' => 34,
                'name_ar' => ' الصناعية  ',
                'name_en' => ' As Sinaiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 182,
                'state_id' => 34,
                'name_ar' => ' الربيع  ',
                'name_en' => ' Al Rabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 183,
                'state_id' => 34,
                'name_ar' => ' الفيحاء  ',
                'name_en' => ' Al Faiha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 184,
                'state_id' => 34,
                'name_ar' => ' الباطن  ',
                'name_en' => ' Al Batin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 185,
                'state_id' => 34,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Rawdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 186,
                'state_id' => 34,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 187,
                'state_id' => 34,
                'name_ar' => ' المصيف  ',
                'name_en' => ' Al Masif  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 188,
                'state_id' => 34,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Al Khalidiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 189,
                'state_id' => 34,
                'name_ar' => ' الصفاء  ',
                'name_en' => ' Al Safaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 190,
                'state_id' => 34,
                'name_ar' => ' المحمدية  ',
                'name_en' => ' Al Muhammadiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 191,
                'state_id' => 34,
                'name_ar' => ' المروج  ',
                'name_en' => ' Al Muruj  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 192,
                'state_id' => 34,
                'name_ar' => ' الواحة  ',
                'name_en' => ' Al Wahah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 193,
                'state_id' => 34,
                'name_ar' => ' فليج  ',
                'name_en' => ' Fulaij  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 194,
                'state_id' => 35,
                'name_ar' => ' حي الأمير مشعل  ',
                'name_en' => ' Prince Mishal District  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 195,
                'state_id' => 35,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Alkhalidiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 196,
                'state_id' => 35,
                'name_ar' => ' المخيم  ',
                'name_en' => ' Al Mukhayyam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 197,
                'state_id' => 35,
                'name_ar' => ' الفيصلية  ',
                'name_en' => ' Al Faisaliah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 198,
                'state_id' => 35,
                'name_ar' => ' الأسكان  ',
                'name_en' => ' Housing of Interior Security Forces  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 199,
                'state_id' => 35,
                'name_ar' => ' الأثايبة  ',
                'name_en' => ' Al Athaybah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 200,
                'state_id' => 35,
                'name_ar' => ' دحضة  ',
                'name_en' => ' Dahdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 201,
                'state_id' => 35,
                'name_ar' => ' شمال الفهد  ',
                'name_en' => ' Northern Al Fahd  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 202,
                'state_id' => 35,
                'name_ar' => ' الفهد  ',
                'name_en' => ' Alfahd  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 203,
                'state_id' => 35,
                'name_ar' => ' أبا لسعود  ',
                'name_en' => ' Aba Lasaud  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 204,
                'state_id' => 35,
                'name_ar' => ' الأملاح  ',
                'name_en' => ' Alamlah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 205,
                'state_id' => 35,
                'name_ar' => ' الجربة  ',
                'name_en' => ' Al Jurbah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 206,
                'state_id' => 35,
                'name_ar' => ' الضباط  ',
                'name_en' => ' Ad Dubat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 207,
                'state_id' => 35,
                'name_ar' => ' القابل  ',
                'name_en' => ' Alqabil  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 208,
                'state_id' => 35,
                'name_ar' => ' شرق الضباط  ',
                'name_en' => ' Sharq Ad Dubat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 209,
                'state_id' => 35,
                'name_ar' => ' شمال الضباط  ',
                'name_en' => ' Shamal Ad Dubat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 210,
                'state_id' => 36,
                'name_ar' => ' الشرائع  ',
                'name_en' => ' Ash Shara',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 211,
                'state_id' => 36,
                'name_ar' => ' الراشدية  ',
                'name_en' => ' Ar Rashidiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 212,
                'state_id' => 36,
                'name_ar' => ' الجعرانة  ',
                'name_en' => ' Al Ju ranah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 213,
                'state_id' => 36,
                'name_ar' => ' العسيلة  ',
                'name_en' => ' Al usaylah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 214,
                'state_id' => 36,
                'name_ar' => ' وادي جليل  ',
                'name_en' => ' Wadi Jalil  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 215,
                'state_id' => 36,
                'name_ar' => ' جبل النور  ',
                'name_en' => ' Jabal Al Nour  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 216,
                'state_id' => 36,
                'name_ar' => ' الخنساء  ',
                'name_en' => ' Al Khansa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 217,
                'state_id' => 36,
                'name_ar' => ' العدل  ',
                'name_en' => ' Al Adel  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 218,
                'state_id' => 36,
                'name_ar' => ' الخضراء  ',
                'name_en' => ' AL Khadra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 219,
                'state_id' => 36,
                'name_ar' => ' البحيرات  ',
                'name_en' => ' AL Buhayrat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 220,
                'state_id' => 36,
                'name_ar' => ' الحمراء و أم الجود  ',
                'name_en' => ' Al Hamra Umm Al Jud  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 221,
                'state_id' => 36,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Al Khalidiya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 222,
                'state_id' => 36,
                'name_ar' => ' الرصيفة  ',
                'name_en' => ' Al Rusayfah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 223,
                'state_id' => 36,
                'name_ar' => ' الزهراء  ',
                'name_en' => ' Al Zahra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 224,
                'state_id' => 36,
                'name_ar' => ' السلامة  ',
                'name_en' => ' Al Salamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 225,
                'state_id' => 36,
                'name_ar' => ' الشوقية  ',
                'name_en' => ' Al Shoqiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 226,
                'state_id' => 36,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Aziziyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 227,
                'state_id' => 36,
                'name_ar' => ' العمرة الجديدة  ',
                'name_en' => ' Al Umrah Al Jadidah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 228,
                'state_id' => 36,
                'name_ar' => ' العوالي  ',
                'name_en' => ' Alawali  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 229,
                'state_id' => 36,
                'name_ar' => ' الكعكية  ',
                'name_en' => ' Al Kakiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 230,
                'state_id' => 36,
                'name_ar' => ' المنصور  ',
                'name_en' => ' Al Mansur  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 231,
                'state_id' => 36,
                'name_ar' => ' النزهة  ',
                'name_en' => ' Al Nuzhah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 232,
                'state_id' => 36,
                'name_ar' => ' النوارية  ',
                'name_en' => ' An Nawwariyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 233,
                'state_id' => 36,
                'name_ar' => ' الهنداوية  ',
                'name_en' => ' Al Hindawiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 234,
                'state_id' => 36,
                'name_ar' => ' بطحاء قريش  ',
                'name_en' => ' Batha Quraish  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 235,
                'state_id' => 36,
                'name_ar' => ' طريق الليث  ',
                'name_en' => ' Al Lith Road  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 236,
                'state_id' => 36,
                'name_ar' => ' ولي العهد  ',
                'name_en' => ' Waly Al Ahd   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 237,
                'state_id' => 37,
                'name_ar' => ' الصفا  ',
                'name_en' => ' Al Safa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 238,
                'state_id' => 37,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Rawdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 239,
                'state_id' => 37,
                'name_ar' => ' السويس  ',
                'name_en' => ' Al Suways  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 240,
                'state_id' => 37,
                'name_ar' => ' صبيا  ',
                'name_en' => ' Sabya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            240 => 
            array (
                'id' => 241,
                'state_id' => 37,
                'name_ar' => ' أبو عريش  ',
                'name_en' => ' Abu Arish  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            241 => 
            array (
                'id' => 242,
                'state_id' => 38,
                'name_ar' => ' الدانة الشمالية  ',
                'name_en' => ' Dana Al Shamaliah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            242 => 
            array (
                'id' => 243,
                'state_id' => 38,
                'name_ar' => ' الدانة الجنوبية  ',
                'name_en' => ' Dana Al Janubiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            243 => 
            array (
                'id' => 244,
                'state_id' => 38,
                'name_ar' => ' الدوحة الشمالية  ',
                'name_en' => ' Doha Al Shamaliah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            244 => 
            array (
                'id' => 245,
                'state_id' => 38,
                'name_ar' => ' الدوحة الجنوبية  ',
                'name_en' => ' Doha Al Janubiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            245 => 
            array (
                'id' => 246,
                'state_id' => 38,
                'name_ar' => ' الجامعة  ',
                'name_en' => ' Aljamiah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            246 => 
            array (
                'id' => 247,
                'state_id' => 38,
                'name_ar' => ' القصور  ',
                'name_en' => ' Al Qusur  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            247 => 
            array (
                'id' => 248,
                'state_id' => 38,
                'name_ar' => ' تهامة  ',
                'name_en' => ' Tihamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            248 => 
            array (
                'id' => 249,
                'state_id' => 39,
                'name_ar' => ' أم خالد  ',
                'name_en' => ' Umm Khalid  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            249 => 
            array (
                'id' => 250,
                'state_id' => 39,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            250 => 
            array (
                'id' => 251,
                'state_id' => 39,
                'name_ar' => ' ذو الحليفة  ',
                'name_en' => ' Dhul Hulaifah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            251 => 
            array (
                'id' => 252,
                'state_id' => 39,
                'name_ar' => ' أبو كبير  ',
                'name_en' => ' ABU kabir  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            252 => 
            array (
                'id' => 253,
                'state_id' => 39,
                'name_ar' => ' الفيصيلة  ',
                'name_en' => ' Al Faisaliyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            253 => 
            array (
                'id' => 254,
                'state_id' => 39,
                'name_ar' => ' حي الجامعة  ',
                'name_en' => ' Al jame ah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            254 => 
            array (
                'id' => 255,
                'state_id' => 39,
                'name_ar' => ' السلام  ',
                'name_en' => ' Al Salam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            255 => 
            array (
                'id' => 256,
                'state_id' => 39,
                'name_ar' => ' العقيق  ',
                'name_en' => ' Al Aqeeq  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            256 => 
            array (
                'id' => 257,
                'state_id' => 39,
                'name_ar' => ' الشفا  ',
                'name_en' => ' Al Shefa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            257 => 
            array (
                'id' => 258,
                'state_id' => 39,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Al Khalidiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            258 => 
            array (
                'id' => 259,
                'state_id' => 39,
                'name_ar' => ' الدفاع  ',
                'name_en' => ' Ad Difa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            259 => 
            array (
                'id' => 260,
                'state_id' => 39,
                'name_ar' => ' الراية  ',
                'name_en' => ' Al Rayah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            260 => 
            array (
                'id' => 261,
                'state_id' => 39,
                'name_ar' => ' العريض  ',
                'name_en' => ' Al Aridh  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            261 => 
            array (
                'id' => 262,
                'state_id' => 39,
                'name_ar' => ' العصبة  ',
                'name_en' => ' Al Usbah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            262 => 
            array (
                'id' => 263,
                'state_id' => 39,
                'name_ar' => ' العنابس  ',
                'name_en' => ' Al Anabis  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            263 => 
            array (
                'id' => 264,
                'state_id' => 39,
                'name_ar' => ' الفتح  ',
                'name_en' => ' Al Fath  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            264 => 
            array (
                'id' => 265,
                'state_id' => 39,
                'name_ar' => ' المغيسلة  ',
                'name_en' => ' Al Mughaisilah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            265 => 
            array (
                'id' => 266,
                'state_id' => 39,
                'name_ar' => ' الوبرة  ',
                'name_en' => ' Al Wabra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            266 => 
            array (
                'id' => 267,
                'state_id' => 39,
                'name_ar' => ' بني معاوية  ',
                'name_en' => ' Bani Muawiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            267 => 
            array (
                'id' => 268,
                'state_id' => 39,
                'name_ar' => ' بئر عثمان  ',
                'name_en' => ' Bir Uthman  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            268 => 
            array (
                'id' => 269,
                'state_id' => 39,
                'name_ar' => ' قربان  ',
                'name_en' => ' Qurban  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            269 => 
            array (
                'id' => 270,
                'state_id' => 40,
                'name_ar' => ' الحليلة  ',
                'name_en' => ' Al Hulaylah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            270 => 
            array (
                'id' => 271,
                'state_id' => 40,
                'name_ar' => ' المبرز  ',
                'name_en' => ' Al Mubarraz  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            271 => 
            array (
                'id' => 272,
                'state_id' => 40,
                'name_ar' => ' الهفوف  ',
                'name_en' => ' Al Hofuf  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            272 => 
            array (
                'id' => 273,
                'state_id' => 40,
                'name_ar' => ' مدينة الجفر  ',
                'name_en' => ' Madinat Al Jafr  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            273 => 
            array (
                'id' => 274,
                'state_id' => 41,
                'name_ar' => ' المنتزة  ',
                'name_en' => ' Al Muntazah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            274 => 
            array (
                'id' => 275,
                'state_id' => 41,
                'name_ar' => ' النهضة  ',
                'name_en' => ' Alnahdah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            275 => 
            array (
                'id' => 276,
                'state_id' => 41,
                'name_ar' => ' القويع  ',
                'name_en' => ' Al Quway  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            276 => 
            array (
                'id' => 277,
                'state_id' => 41,
                'name_ar' => ' حي الصفراء  ',
                'name_en' => ' As Safra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            277 => 
            array (
                'id' => 278,
                'state_id' => 41,
                'name_ar' => ' القادسية  ',
                'name_en' => ' Al Qadissya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            278 => 
            array (
                'id' => 279,
                'state_id' => 41,
                'name_ar' => ' الشماس  ',
                'name_en' => ' Al shamas  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            279 => 
            array (
                'id' => 280,
                'state_id' => 41,
                'name_ar' => ' الأمن  ',
                'name_en' => ' Al Amn  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            280 => 
            array (
                'id' => 281,
                'state_id' => 41,
                'name_ar' => ' النور  ',
                'name_en' => ' Al Nour  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            281 => 
            array (
                'id' => 282,
                'state_id' => 41,
                'name_ar' => ' التعليم  ',
                'name_en' => ' Al Taleem  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            282 => 
            array (
                'id' => 283,
                'state_id' => 41,
                'name_ar' => ' الأسكان  ',
                'name_en' => ' Al Iskan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            283 => 
            array (
                'id' => 284,
                'state_id' => 41,
                'name_ar' => ' الأفق  ',
                'name_en' => ' Al Ofg  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            284 => 
            array (
                'id' => 285,
                'state_id' => 41,
                'name_ar' => ' الجنوب  ',
                'name_en' => ' Algnoub  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            285 => 
            array (
                'id' => 286,
                'state_id' => 41,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Rawda  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            286 => 
            array (
                'id' => 287,
                'state_id' => 41,
                'name_ar' => ' الريان  ',
                'name_en' => ' Al Rayan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            287 => 
            array (
                'id' => 288,
                'state_id' => 41,
                'name_ar' => ' السادة  ',
                'name_en' => ' Al Sadah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            288 => 
            array (
                'id' => 289,
                'state_id' => 41,
                'name_ar' => ' الصالحية  ',
                'name_en' => ' Al Salhiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            289 => 
            array (
                'id' => 290,
                'state_id' => 41,
                'name_ar' => ' الفايزية  ',
                'name_en' => ' Al fayziyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            290 => 
            array (
                'id' => 291,
                'state_id' => 41,
                'name_ar' => ' المنار  ',
                'name_en' => ' Al Manar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            291 => 
            array (
                'id' => 292,
                'state_id' => 42,
                'name_ar' => ' السليمانية  ',
                'name_en' => ' Al Sulimaniyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            292 => 
            array (
                'id' => 293,
                'state_id' => 42,
                'name_ar' => ' المزادة  ',
                'name_en' => ' Al Mazadah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            293 => 
            array (
                'id' => 294,
                'state_id' => 42,
                'name_ar' => ' الصالحية  ',
                'name_en' => ' Al Salhiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            294 => 
            array (
                'id' => 295,
                'state_id' => 42,
                'name_ar' => ' الشريمية  ',
                'name_en' => ' Ash Shuraymiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            295 => 
            array (
                'id' => 296,
                'state_id' => 42,
                'name_ar' => ' الفاخرية  ',
                'name_en' => ' Alfakhrya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            296 => 
            array (
                'id' => 297,
                'state_id' => 42,
                'name_ar' => ' المنار  ',
                'name_en' => ' Almanar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            297 => 
            array (
                'id' => 298,
                'state_id' => 42,
                'name_ar' => ' الأشرفية  ',
                'name_en' => ' Al Ashrafyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            298 => 
            array (
                'id' => 299,
                'state_id' => 42,
                'name_ar' => ' الخزامي  ',
                'name_en' => ' Alkhuzama  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            299 => 
            array (
                'id' => 300,
                'state_id' => 42,
                'name_ar' => ' العليا  ',
                'name_en' => ' Al Olaya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            300 => 
            array (
                'id' => 301,
                'state_id' => 42,
                'name_ar' => ' البديعة  ',
                'name_en' => ' Al Badya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            301 => 
            array (
                'id' => 302,
                'state_id' => 42,
                'name_ar' => ' الريان  ',
                'name_en' => ' Al Matar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            302 => 
            array (
                'id' => 303,
                'state_id' => 42,
                'name_ar' => ' الفيضة  ',
                'name_en' => ' Al Faidha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            303 => 
            array (
                'id' => 304,
                'state_id' => 42,
                'name_ar' => ' القادسية  ',
                'name_en' => ' Al Qadisiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            304 => 
            array (
                'id' => 305,
                'state_id' => 42,
                'name_ar' => ' المطار  ',
                'name_en' => ' Al Matar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            305 => 
            array (
                'id' => 306,
                'state_id' => 42,
                'name_ar' => ' النزهة  ',
                'name_en' => ' Al Nuzha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            306 => 
            array (
                'id' => 307,
                'state_id' => 42,
                'name_ar' => ' الهداء  ',
                'name_en' => ' Alhada  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            307 => 
            array (
                'id' => 308,
                'state_id' => 42,
                'name_ar' => ' سلطانة  ',
                'name_en' => ' Sultanah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            308 => 
            array (
                'id' => 309,
                'state_id' => 42,
                'name_ar' => ' شيخة  ',
                'name_en' => ' Shikhah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            309 => 
            array (
                'id' => 310,
                'state_id' => 43,
                'name_ar' => ' الخزامي  ',
                'name_en' => ' Al Khuzama  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            310 => 
            array (
                'id' => 311,
                'state_id' => 43,
                'name_ar' => ' الوسيطاء  ',
                'name_en' => ' Al Wusayta  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            311 => 
            array (
                'id' => 312,
                'state_id' => 43,
                'name_ar' => ' المحطة  ',
                'name_en' => ' Al Mahattah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            312 => 
            array (
                'id' => 313,
                'state_id' => 43,
                'name_ar' => ' الزهراء  ',
                'name_en' => ' Al Zahra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            313 => 
            array (
                'id' => 314,
                'state_id' => 43,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            314 => 
            array (
                'id' => 315,
                'state_id' => 43,
                'name_ar' => ' المصيف  ',
                'name_en' => ' Al Masyaf  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            315 => 
            array (
                'id' => 316,
                'state_id' => 43,
                'name_ar' => ' الزبارة  ',
                'name_en' => ' Az Zibarah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            316 => 
            array (
                'id' => 317,
                'state_id' => 43,
                'name_ar' => ' أجا  ',
                'name_en' => ' Aja  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            317 => 
            array (
                'id' => 318,
                'state_id' => 44,
                'name_ar' => ' المعشي  ',
                'name_en' => ' Maashi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            318 => 
            array (
                'id' => 319,
                'state_id' => 44,
                'name_ar' => ' الحويه  ',
                'name_en' => ' Al Huwaya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            319 => 
            array (
                'id' => 320,
                'state_id' => 44,
                'name_ar' => ' قروي  ',
                'name_en' => ' Qurwa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            320 => 
            array (
                'id' => 321,
                'state_id' => 44,
                'name_ar' => ' الشرقية  ',
                'name_en' => ' Asharqyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            321 => 
            array (
                'id' => 322,
                'state_id' => 44,
                'name_ar' => ' وادي وج  ',
                'name_en' => ' Wadi waj  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            322 => 
            array (
                'id' => 323,
                'state_id' => 44,
                'name_ar' => ' شهار  ',
                'name_en' => ' Shihar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            323 => 
            array (
                'id' => 324,
                'state_id' => 44,
                'name_ar' => ' الجال  ',
                'name_en' => ' Al jal  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            324 => 
            array (
                'id' => 325,
                'state_id' => 44,
                'name_ar' => ' جبره  ',
                'name_en' => ' Jubrah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            325 => 
            array (
                'id' => 326,
                'state_id' => 44,
                'name_ar' => ' العقيق  ',
                'name_en' => ' Al Aqeeq  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            326 => 
            array (
                'id' => 327,
                'state_id' => 44,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Al khalidiyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            327 => 
            array (
                'id' => 328,
                'state_id' => 44,
                'name_ar' => ' السداد  ',
                'name_en' => ' Al Sadad  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            328 => 
            array (
                'id' => 329,
                'state_id' => 44,
                'name_ar' => ' السلامة  ',
                'name_en' => ' Al Salamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            329 => 
            array (
                'id' => 330,
                'state_id' => 44,
                'name_ar' => ' الشهداء  ',
                'name_en' => ' Ashuhada  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            330 => 
            array (
                'id' => 331,
                'state_id' => 44,
                'name_ar' => ' العزيزية  ',
                'name_en' => ' Al Aziziyyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            331 => 
            array (
                'id' => 332,
                'state_id' => 44,
                'name_ar' => ' المثناه  ',
                'name_en' => ' Al Mathnah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            332 => 
            array (
                'id' => 333,
                'state_id' => 44,
                'name_ar' => ' حوايا  ',
                'name_en' => ' Hawaya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            333 => 
            array (
                'id' => 334,
                'state_id' => 44,
                'name_ar' => ' نخب  ',
                'name_en' => ' Nakhab  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            334 => 
            array (
                'id' => 335,
                'state_id' => 45,
                'name_ar' => ' المنسك  ',
                'name_en' => ' Mansak  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            335 => 
            array (
                'id' => 336,
                'state_id' => 45,
                'name_ar' => ' المفتاحة  ',
                'name_en' => ' Al Muftaha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            336 => 
            array (
                'id' => 337,
                'state_id' => 45,
                'name_ar' => ' القابل  ',
                'name_en' => ' Al Qabil  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            337 => 
            array (
                'id' => 338,
                'state_id' => 45,
                'name_ar' => ' الأندلس  ',
                'name_en' => ' Alandalus  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            338 => 
            array (
                'id' => 339,
                'state_id' => 45,
                'name_ar' => ' العرين  ',
                'name_en' => ' Alarin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            339 => 
            array (
                'id' => 340,
                'state_id' => 45,
                'name_ar' => ' المروج  ',
                'name_en' => ' Almarooj  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            340 => 
            array (
                'id' => 341,
                'state_id' => 45,
                'name_ar' => ' النسيم  ',
                'name_en' => ' Annasim  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            341 => 
            array (
                'id' => 342,
                'state_id' => 45,
                'name_ar' => ' الموظفين  ',
                'name_en' => ' Al Mozvin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            342 => 
            array (
                'id' => 343,
                'state_id' => 45,
                'name_ar' => ' الضباب  ',
                'name_en' => ' Addabab  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            343 => 
            array (
                'id' => 344,
                'state_id' => 2,
                'name_ar' => 'السادس من أكتوبر',
                'name_en' => 'Sixth of October',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            344 => 
            array (
                'id' => 345,
                'state_id' => 2,
                'name_ar' => 'الشيخ زايد',
                'name_en' => 'Cheikh Zayed',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            345 => 
            array (
                'id' => 346,
                'state_id' => 2,
                'name_ar' => 'الحوامدية',
                'name_en' => 'Hawamdiyah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            346 => 
            array (
                'id' => 347,
                'state_id' => 2,
                'name_ar' => 'البدرشين',
                'name_en' => 'Al Badrasheen',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            347 => 
            array (
                'id' => 348,
                'state_id' => 2,
                'name_ar' => 'الصف',
                'name_en' => 'Saf',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            348 => 
            array (
                'id' => 349,
                'state_id' => 2,
                'name_ar' => 'أطفيح',
                'name_en' => 'Atfih',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            349 => 
            array (
                'id' => 350,
                'state_id' => 2,
                'name_ar' => 'العياط',
                'name_en' => 'Al Ayat',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            350 => 
            array (
                'id' => 351,
                'state_id' => 2,
                'name_ar' => 'الباويطي',
                'name_en' => 'Al-Bawaiti',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            351 => 
            array (
                'id' => 352,
                'state_id' => 2,
                'name_ar' => 'منشأة القناطر',
                'name_en' => 'ManshiyetAl Qanater',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            352 => 
            array (
                'id' => 353,
                'state_id' => 2,
                'name_ar' => 'أوسيم',
                'name_en' => 'Oaseem',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            353 => 
            array (
                'id' => 354,
                'state_id' => 2,
                'name_ar' => 'كرداسة',
                'name_en' => 'Kerdasa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            354 => 
            array (
                'id' => 355,
                'state_id' => 2,
                'name_ar' => 'أبو النمرس',
                'name_en' => 'Abu Nomros',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            355 => 
            array (
                'id' => 356,
                'state_id' => 2,
                'name_ar' => 'كفر غطاطي',
                'name_en' => 'Kafr Ghati',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            356 => 
            array (
                'id' => 357,
                'state_id' => 2,
                'name_ar' => 'منشأة البكاري',
                'name_en' => 'Manshiyet Al Bakari',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            357 => 
            array (
                'id' => 358,
                'state_id' => 3,
                'name_ar' => 'الأسكندرية',
                'name_en' => 'Alexandria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            358 => 
            array (
                'id' => 359,
                'state_id' => 3,
                'name_ar' => 'برج العرب',
                'name_en' => 'Burj Al Arab',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            359 => 
            array (
                'id' => 360,
                'state_id' => 3,
                'name_ar' => 'برج العرب الجديدة',
                'name_en' => 'New Burj Al Arab',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            360 => 
            array (
                'id' => 361,
                'state_id' => 12,
                'name_ar' => 'بنها',
                'name_en' => 'Banha',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            361 => 
            array (
                'id' => 362,
                'state_id' => 12,
                'name_ar' => 'قليوب',
                'name_en' => 'Qalyub',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            362 => 
            array (
                'id' => 363,
                'state_id' => 12,
                'name_ar' => 'شبرا الخيمة',
                'name_en' => 'Shubra Al Khaimah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            363 => 
            array (
                'id' => 364,
                'state_id' => 12,
                'name_ar' => 'القناطر الخيرية',
                'name_en' => 'Al Qanater Charity',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            364 => 
            array (
                'id' => 365,
                'state_id' => 12,
                'name_ar' => 'الخانكة',
                'name_en' => 'Khanka',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            365 => 
            array (
                'id' => 366,
                'state_id' => 12,
                'name_ar' => 'كفر شكر',
                'name_en' => 'Kafr Shukr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            366 => 
            array (
                'id' => 367,
                'state_id' => 12,
                'name_ar' => 'طوخ',
                'name_en' => 'Tukh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            367 => 
            array (
                'id' => 368,
                'state_id' => 12,
                'name_ar' => 'قها',
                'name_en' => 'Qaha',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            368 => 
            array (
                'id' => 369,
                'state_id' => 12,
                'name_ar' => 'العبور',
                'name_en' => 'Obour',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            369 => 
            array (
                'id' => 370,
                'state_id' => 12,
                'name_ar' => 'الخصوص',
                'name_en' => 'Khosous',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            370 => 
            array (
                'id' => 371,
                'state_id' => 12,
                'name_ar' => 'شبين القناطر',
                'name_en' => 'Shibin Al Qanater',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            371 => 
            array (
                'id' => 372,
                'state_id' => 6,
                'name_ar' => 'دمنهور',
                'name_en' => 'Damanhour',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            372 => 
            array (
                'id' => 373,
                'state_id' => 6,
                'name_ar' => 'كفر الدوار',
                'name_en' => 'Kafr El Dawar',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            373 => 
            array (
                'id' => 374,
                'state_id' => 6,
                'name_ar' => 'رشيد',
                'name_en' => 'Rashid',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            374 => 
            array (
                'id' => 375,
                'state_id' => 6,
                'name_ar' => 'إدكو',
                'name_en' => 'Edco',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            375 => 
            array (
                'id' => 376,
                'state_id' => 6,
                'name_ar' => 'أبو المطامير',
                'name_en' => 'Abu al-Matamir',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            376 => 
            array (
                'id' => 377,
                'state_id' => 6,
                'name_ar' => 'أبو حمص',
                'name_en' => 'Abu Homs',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            377 => 
            array (
                'id' => 378,
                'state_id' => 6,
                'name_ar' => 'الدلنجات',
                'name_en' => 'Delengat',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            378 => 
            array (
                'id' => 379,
                'state_id' => 6,
                'name_ar' => 'المحمودية',
                'name_en' => 'Mahmoudiyah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            379 => 
            array (
                'id' => 380,
                'state_id' => 6,
                'name_ar' => 'الرحمانية',
                'name_en' => 'Rahmaniyah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            380 => 
            array (
                'id' => 381,
                'state_id' => 6,
                'name_ar' => 'إيتاي البارود',
                'name_en' => 'Itai Baroud',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            381 => 
            array (
                'id' => 382,
                'state_id' => 6,
                'name_ar' => 'حوش عيسى',
                'name_en' => 'Housh Eissa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            382 => 
            array (
                'id' => 383,
                'state_id' => 6,
                'name_ar' => 'شبراخيت',
                'name_en' => 'Shubrakhit',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            383 => 
            array (
                'id' => 384,
                'state_id' => 6,
                'name_ar' => 'كوم حمادة',
                'name_en' => 'Kom Hamada',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            384 => 
            array (
                'id' => 385,
                'state_id' => 6,
                'name_ar' => 'بدر',
                'name_en' => 'Badr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            385 => 
            array (
                'id' => 386,
                'state_id' => 6,
                'name_ar' => 'وادي النطرون',
                'name_en' => 'Wadi Natrun',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            386 => 
            array (
                'id' => 387,
                'state_id' => 6,
                'name_ar' => 'النوبارية الجديدة',
                'name_en' => 'New Nubaria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            387 => 
            array (
                'id' => 388,
                'state_id' => 23,
                'name_ar' => 'مرسى مطروح',
                'name_en' => 'Marsa Matrouh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            388 => 
            array (
                'id' => 389,
                'state_id' => 23,
                'name_ar' => 'الحمام',
                'name_en' => 'El Hamam',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            389 => 
            array (
                'id' => 390,
                'state_id' => 23,
                'name_ar' => 'العلمين',
                'name_en' => 'Alamein',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            390 => 
            array (
                'id' => 391,
                'state_id' => 23,
                'name_ar' => 'الضبعة',
                'name_en' => 'Dabaa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            391 => 
            array (
                'id' => 392,
                'state_id' => 23,
                'name_ar' => 'النجيلة',
                'name_en' => 'Al-Nagila',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            392 => 
            array (
                'id' => 393,
                'state_id' => 23,
                'name_ar' => 'سيدي براني',
                'name_en' => 'Sidi Brani',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            393 => 
            array (
                'id' => 394,
                'state_id' => 23,
                'name_ar' => 'السلوم',
                'name_en' => 'Salloum',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            394 => 
            array (
                'id' => 395,
                'state_id' => 23,
                'name_ar' => 'سيوة',
                'name_en' => 'Siwa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            395 => 
            array (
                'id' => 396,
                'state_id' => 19,
                'name_ar' => 'دمياط',
                'name_en' => 'Damietta',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            396 => 
            array (
                'id' => 397,
                'state_id' => 19,
                'name_ar' => 'دمياط الجديدة',
                'name_en' => 'New Damietta',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            397 => 
            array (
                'id' => 398,
                'state_id' => 19,
                'name_ar' => 'رأس البر',
                'name_en' => 'Ras El Bar',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            398 => 
            array (
                'id' => 399,
                'state_id' => 19,
                'name_ar' => 'فارسكور',
                'name_en' => 'Faraskour',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            399 => 
            array (
                'id' => 400,
                'state_id' => 19,
                'name_ar' => 'الزرقا',
                'name_en' => 'Zarqa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            400 => 
            array (
                'id' => 401,
                'state_id' => 19,
                'name_ar' => 'السرو',
                'name_en' => 'alsaru',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            401 => 
            array (
                'id' => 402,
                'state_id' => 19,
                'name_ar' => 'الروضة',
                'name_en' => 'alruwda',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            402 => 
            array (
                'id' => 403,
                'state_id' => 19,
                'name_ar' => 'كفر البطيخ',
                'name_en' => 'Kafr El-Batikh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            403 => 
            array (
                'id' => 404,
                'state_id' => 19,
                'name_ar' => 'عزبة البرج',
                'name_en' => 'Azbet Al Burg',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            404 => 
            array (
                'id' => 405,
                'state_id' => 19,
                'name_ar' => 'ميت أبو غالب',
                'name_en' => 'Meet Abou Ghalib',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            405 => 
            array (
                'id' => 406,
                'state_id' => 19,
                'name_ar' => 'كفر سعد',
                'name_en' => 'Kafr Saad',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            406 => 
            array (
                'id' => 407,
                'state_id' => 4,
                'name_ar' => 'المنصورة',
                'name_en' => 'Mansoura',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            407 => 
            array (
                'id' => 408,
                'state_id' => 4,
                'name_ar' => 'طلخا',
                'name_en' => 'Talkha',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            408 => 
            array (
                'id' => 409,
                'state_id' => 4,
                'name_ar' => 'ميت غمر',
                'name_en' => 'Mitt Ghamr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            409 => 
            array (
                'id' => 410,
                'state_id' => 4,
                'name_ar' => 'دكرنس',
                'name_en' => 'Dekernes',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            410 => 
            array (
                'id' => 411,
                'state_id' => 4,
                'name_ar' => 'أجا',
                'name_en' => 'Aga',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            411 => 
            array (
                'id' => 412,
                'state_id' => 4,
                'name_ar' => 'منية النصر',
                'name_en' => 'Menia El Nasr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            412 => 
            array (
                'id' => 413,
                'state_id' => 4,
                'name_ar' => 'السنبلاوين',
                'name_en' => 'Sinbillawin',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            413 => 
            array (
                'id' => 414,
                'state_id' => 4,
                'name_ar' => 'الكردي',
                'name_en' => 'El Kurdi',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            414 => 
            array (
                'id' => 415,
                'state_id' => 4,
                'name_ar' => 'بني عبيد',
                'name_en' => 'Bani Ubaid',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            415 => 
            array (
                'id' => 416,
                'state_id' => 4,
                'name_ar' => 'المنزلة',
                'name_en' => 'Al Manzala',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            416 => 
            array (
                'id' => 417,
                'state_id' => 4,
                'name_ar' => 'تمي الأمديد',
                'name_en' => 'tami alamdid',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            417 => 
            array (
                'id' => 418,
                'state_id' => 4,
                'name_ar' => 'الجمالية',
                'name_en' => 'aljamalia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            418 => 
            array (
                'id' => 419,
                'state_id' => 4,
                'name_ar' => 'شربين',
                'name_en' => 'Sherbin',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            419 => 
            array (
                'id' => 420,
                'state_id' => 4,
                'name_ar' => 'المطرية',
                'name_en' => 'Mataria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            420 => 
            array (
                'id' => 421,
                'state_id' => 4,
                'name_ar' => 'بلقاس',
                'name_en' => 'Belqas',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            421 => 
            array (
                'id' => 422,
                'state_id' => 4,
                'name_ar' => 'ميت سلسيل',
                'name_en' => 'Meet Salsil',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            422 => 
            array (
                'id' => 423,
                'state_id' => 4,
                'name_ar' => 'جمصة',
                'name_en' => 'Gamasa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            423 => 
            array (
                'id' => 424,
                'state_id' => 4,
                'name_ar' => 'محلة دمنة',
                'name_en' => 'Mahalat Damana',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            424 => 
            array (
                'id' => 425,
                'state_id' => 4,
                'name_ar' => 'نبروه',
                'name_en' => 'Nabroh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            425 => 
            array (
                'id' => 426,
                'state_id' => 22,
                'name_ar' => 'كفر الشيخ',
                'name_en' => 'Kafr El Sheikh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            426 => 
            array (
                'id' => 427,
                'state_id' => 22,
                'name_ar' => 'دسوق',
                'name_en' => 'Desouq',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            427 => 
            array (
                'id' => 428,
                'state_id' => 22,
                'name_ar' => 'فوه',
                'name_en' => 'Fooh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            428 => 
            array (
                'id' => 429,
                'state_id' => 22,
                'name_ar' => 'مطوبس',
                'name_en' => 'Metobas',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            429 => 
            array (
                'id' => 430,
                'state_id' => 22,
                'name_ar' => 'برج البرلس',
                'name_en' => 'Burg Al Burullus',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            430 => 
            array (
                'id' => 431,
                'state_id' => 22,
                'name_ar' => 'بلطيم',
                'name_en' => 'Baltim',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            431 => 
            array (
                'id' => 432,
                'state_id' => 22,
                'name_ar' => 'مصيف بلطيم',
                'name_en' => 'Masief Baltim',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            432 => 
            array (
                'id' => 433,
                'state_id' => 22,
                'name_ar' => 'الحامول',
                'name_en' => 'Hamol',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            433 => 
            array (
                'id' => 434,
                'state_id' => 22,
                'name_ar' => 'بيلا',
                'name_en' => 'Bella',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            434 => 
            array (
                'id' => 435,
                'state_id' => 22,
                'name_ar' => 'الرياض',
                'name_en' => 'Riyadh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            435 => 
            array (
                'id' => 436,
                'state_id' => 22,
                'name_ar' => 'سيدي سالم',
                'name_en' => 'Sidi Salm',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            436 => 
            array (
                'id' => 437,
                'state_id' => 22,
                'name_ar' => 'قلين',
                'name_en' => 'Qellen',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            437 => 
            array (
                'id' => 438,
                'state_id' => 22,
                'name_ar' => 'سيدي غازي',
                'name_en' => 'Sidi Ghazi',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            438 => 
            array (
                'id' => 439,
                'state_id' => 8,
                'name_ar' => 'طنطا',
                'name_en' => 'Tanta',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            439 => 
            array (
                'id' => 440,
                'state_id' => 8,
                'name_ar' => 'المحلة الكبرى',
                'name_en' => 'Al Mahalla Al Kobra',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            440 => 
            array (
                'id' => 441,
                'state_id' => 8,
                'name_ar' => 'كفر الزيات',
                'name_en' => 'Kafr El Zayat',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            441 => 
            array (
                'id' => 442,
                'state_id' => 8,
                'name_ar' => 'زفتى',
                'name_en' => 'Zefta',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            442 => 
            array (
                'id' => 443,
                'state_id' => 8,
                'name_ar' => 'السنطة',
                'name_en' => 'El Santa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            443 => 
            array (
                'id' => 444,
                'state_id' => 8,
                'name_ar' => 'قطور',
                'name_en' => 'Qutour',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            444 => 
            array (
                'id' => 445,
                'state_id' => 8,
                'name_ar' => 'بسيون',
                'name_en' => 'Basion',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            445 => 
            array (
                'id' => 446,
                'state_id' => 8,
                'name_ar' => 'سمنود',
                'name_en' => 'Samannoud',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            446 => 
            array (
                'id' => 447,
                'state_id' => 10,
                'name_ar' => 'شبين الكوم',
                'name_en' => 'Shbeen El Koom',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            447 => 
            array (
                'id' => 448,
                'state_id' => 10,
                'name_ar' => 'مدينة السادات',
                'name_en' => 'Sadat City',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            448 => 
            array (
                'id' => 449,
                'state_id' => 10,
                'name_ar' => 'منوف',
                'name_en' => 'Menouf',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            449 => 
            array (
                'id' => 450,
                'state_id' => 10,
                'name_ar' => 'سرس الليان',
                'name_en' => 'Sars El-Layan',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            450 => 
            array (
                'id' => 451,
                'state_id' => 10,
                'name_ar' => 'أشمون',
                'name_en' => 'Ashmon',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            451 => 
            array (
                'id' => 452,
                'state_id' => 10,
                'name_ar' => 'الباجور',
                'name_en' => 'Al Bagor',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            452 => 
            array (
                'id' => 453,
                'state_id' => 10,
                'name_ar' => 'قويسنا',
                'name_en' => 'Quesna',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            453 => 
            array (
                'id' => 454,
                'state_id' => 10,
                'name_ar' => 'بركة السبع',
                'name_en' => 'Berkat El Saba',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            454 => 
            array (
                'id' => 455,
                'state_id' => 10,
                'name_ar' => 'تلا',
                'name_en' => 'Tala',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            455 => 
            array (
                'id' => 456,
                'state_id' => 10,
                'name_ar' => 'الشهداء',
                'name_en' => 'Al Shohada',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            456 => 
            array (
                'id' => 457,
                'state_id' => 20,
                'name_ar' => 'الزقازيق',
                'name_en' => 'Zagazig',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            457 => 
            array (
                'id' => 458,
                'state_id' => 20,
                'name_ar' => 'العاشر من رمضان',
                'name_en' => 'Al Ashr Men Ramadan',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            458 => 
            array (
                'id' => 459,
                'state_id' => 20,
                'name_ar' => 'منيا القمح',
                'name_en' => 'Minya Al Qamh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            459 => 
            array (
                'id' => 460,
                'state_id' => 20,
                'name_ar' => 'بلبيس',
                'name_en' => 'Belbeis',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            460 => 
            array (
                'id' => 461,
                'state_id' => 20,
                'name_ar' => 'مشتول السوق',
                'name_en' => 'Mashtoul El Souq',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            461 => 
            array (
                'id' => 462,
                'state_id' => 20,
                'name_ar' => 'القنايات',
                'name_en' => 'Qenaiat',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            462 => 
            array (
                'id' => 463,
                'state_id' => 20,
                'name_ar' => 'أبو حماد',
                'name_en' => 'Abu Hammad',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            463 => 
            array (
                'id' => 464,
                'state_id' => 20,
                'name_ar' => 'القرين',
                'name_en' => 'El Qurain',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            464 => 
            array (
                'id' => 465,
                'state_id' => 20,
                'name_ar' => 'ههيا',
                'name_en' => 'Hehia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            465 => 
            array (
                'id' => 466,
                'state_id' => 20,
                'name_ar' => 'أبو كبير',
                'name_en' => 'Abu Kabir',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            466 => 
            array (
                'id' => 467,
                'state_id' => 20,
                'name_ar' => 'فاقوس',
                'name_en' => 'Faccus',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            467 => 
            array (
                'id' => 468,
                'state_id' => 20,
                'name_ar' => 'الصالحية الجديدة',
                'name_en' => 'El Salihia El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            468 => 
            array (
                'id' => 469,
                'state_id' => 20,
                'name_ar' => 'الإبراهيمية',
                'name_en' => 'Al Ibrahimiyah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            469 => 
            array (
                'id' => 470,
                'state_id' => 20,
                'name_ar' => 'ديرب نجم',
                'name_en' => 'Deirb Negm',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            470 => 
            array (
                'id' => 471,
                'state_id' => 20,
                'name_ar' => 'كفر صقر',
                'name_en' => 'Kafr Saqr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            471 => 
            array (
                'id' => 472,
                'state_id' => 20,
                'name_ar' => 'أولاد صقر',
                'name_en' => 'Awlad Saqr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            472 => 
            array (
                'id' => 473,
                'state_id' => 20,
                'name_ar' => 'الحسينية',
                'name_en' => 'Husseiniya',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            473 => 
            array (
                'id' => 474,
                'state_id' => 20,
                'name_ar' => 'صان الحجر القبلية',
                'name_en' => 'san alhajar alqablia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            474 => 
            array (
                'id' => 475,
                'state_id' => 20,
                'name_ar' => 'منشأة أبو عمر',
                'name_en' => 'Manshayat Abu Omar',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            475 => 
            array (
                'id' => 476,
                'state_id' => 18,
                'name_ar' => 'بورسعيد',
                'name_en' => 'PorSaid',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            476 => 
            array (
                'id' => 477,
                'state_id' => 18,
                'name_ar' => 'بورفؤاد',
                'name_en' => 'PorFouad',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            477 => 
            array (
                'id' => 478,
                'state_id' => 9,
                'name_ar' => 'الإسماعيلية',
                'name_en' => 'Ismailia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            478 => 
            array (
                'id' => 479,
                'state_id' => 9,
                'name_ar' => 'فايد',
                'name_en' => 'Fayed',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            479 => 
            array (
                'id' => 480,
                'state_id' => 9,
                'name_ar' => 'القنطرة شرق',
                'name_en' => 'Qantara Sharq',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            480 => 
            array (
                'id' => 481,
                'state_id' => 9,
                'name_ar' => 'القنطرة غرب',
                'name_en' => 'Qantara Gharb',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            481 => 
            array (
                'id' => 482,
                'state_id' => 9,
                'name_ar' => 'التل الكبير',
                'name_en' => 'El Tal El Kabier',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            482 => 
            array (
                'id' => 483,
                'state_id' => 9,
                'name_ar' => 'أبو صوير',
                'name_en' => 'Abu Sawir',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            483 => 
            array (
                'id' => 484,
                'state_id' => 9,
                'name_ar' => 'القصاصين الجديدة',
                'name_en' => 'Kasasien El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            484 => 
            array (
                'id' => 485,
                'state_id' => 14,
                'name_ar' => 'السويس',
                'name_en' => 'Suez',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            485 => 
            array (
                'id' => 486,
                'state_id' => 26,
                'name_ar' => 'العريش',
                'name_en' => 'Arish',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            486 => 
            array (
                'id' => 487,
                'state_id' => 26,
                'name_ar' => 'الشيخ زويد',
                'name_en' => 'Sheikh Zowaid',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            487 => 
            array (
                'id' => 488,
                'state_id' => 26,
                'name_ar' => 'نخل',
                'name_en' => 'Nakhl',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            488 => 
            array (
                'id' => 489,
                'state_id' => 26,
                'name_ar' => 'رفح',
                'name_en' => 'Rafah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            489 => 
            array (
                'id' => 490,
                'state_id' => 26,
                'name_ar' => 'بئر العبد',
                'name_en' => 'Bir al-Abed',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            490 => 
            array (
                'id' => 491,
                'state_id' => 26,
                'name_ar' => 'الحسنة',
                'name_en' => 'Al Hasana',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            491 => 
            array (
                'id' => 492,
                'state_id' => 21,
                'name_ar' => 'الطور',
                'name_en' => 'Al Toor',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            492 => 
            array (
                'id' => 493,
                'state_id' => 21,
                'name_ar' => 'شرم الشيخ',
                'name_en' => 'Sharm El-Shaikh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            493 => 
            array (
                'id' => 494,
                'state_id' => 21,
                'name_ar' => 'دهب',
                'name_en' => 'Dahab',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            494 => 
            array (
                'id' => 495,
                'state_id' => 21,
                'name_ar' => 'نويبع',
                'name_en' => 'Nuweiba',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            495 => 
            array (
                'id' => 496,
                'state_id' => 21,
                'name_ar' => 'طابا',
                'name_en' => 'Taba',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            496 => 
            array (
                'id' => 497,
                'state_id' => 21,
                'name_ar' => 'سانت كاترين',
                'name_en' => 'Saint Catherine',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            497 => 
            array (
                'id' => 498,
                'state_id' => 21,
                'name_ar' => 'أبو رديس',
                'name_en' => 'Abu Redis',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            498 => 
            array (
                'id' => 499,
                'state_id' => 21,
                'name_ar' => 'أبو زنيمة',
                'name_en' => 'Abu Zenaima',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            499 => 
            array (
                'id' => 500,
                'state_id' => 21,
                'name_ar' => 'رأس سدر',
                'name_en' => 'Ras Sidr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 501,
                'state_id' => 17,
                'name_ar' => 'بني سويف',
                'name_en' => 'Bani Sweif',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 502,
                'state_id' => 17,
                'name_ar' => 'بني سويف الجديدة',
                'name_en' => 'Beni Suef El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 503,
                'state_id' => 17,
                'name_ar' => 'الواسطى',
                'name_en' => 'Al Wasta',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 504,
                'state_id' => 17,
                'name_ar' => 'ناصر',
                'name_en' => 'Naser',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 505,
                'state_id' => 17,
                'name_ar' => 'إهناسيا',
                'name_en' => 'Ehnasia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 506,
                'state_id' => 17,
                'name_ar' => 'ببا',
                'name_en' => 'beba',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 507,
                'state_id' => 17,
                'name_ar' => 'الفشن',
                'name_en' => 'Fashn',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 508,
                'state_id' => 17,
                'name_ar' => 'سمسطا',
                'name_en' => 'Somasta',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 509,
                'state_id' => 7,
                'name_ar' => 'الفيوم',
                'name_en' => 'Fayoum',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 510,
                'state_id' => 7,
                'name_ar' => 'الفيوم الجديدة',
                'name_en' => 'Fayoum El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 511,
                'state_id' => 7,
                'name_ar' => 'طامية',
                'name_en' => 'Tamiya',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 512,
                'state_id' => 7,
                'name_ar' => 'سنورس',
                'name_en' => 'Snores',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 513,
                'state_id' => 7,
                'name_ar' => 'إطسا',
                'name_en' => 'Etsa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 514,
                'state_id' => 7,
                'name_ar' => 'إبشواي',
                'name_en' => 'Epschway',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 515,
                'state_id' => 7,
                'name_ar' => 'يوسف الصديق',
                'name_en' => 'Yusuf El Sediaq',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 516,
                'state_id' => 11,
                'name_ar' => 'المنيا',
                'name_en' => 'Minya',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 517,
                'state_id' => 11,
                'name_ar' => 'المنيا الجديدة',
                'name_en' => 'Minya El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 518,
                'state_id' => 11,
                'name_ar' => 'العدوة',
                'name_en' => 'El Adwa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 519,
                'state_id' => 11,
                'name_ar' => 'مغاغة',
                'name_en' => 'Magagha',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 520,
                'state_id' => 11,
                'name_ar' => 'بني مزار',
                'name_en' => 'Bani Mazar',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 521,
                'state_id' => 11,
                'name_ar' => 'مطاي',
                'name_en' => 'Mattay',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 522,
                'state_id' => 11,
                'name_ar' => 'سمالوط',
                'name_en' => 'Samalut',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 523,
                'state_id' => 11,
                'name_ar' => 'المدينة الفكرية',
                'name_en' => 'Madinat El Fekria',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 524,
                'state_id' => 11,
                'name_ar' => 'ملوي',
                'name_en' => 'Meloy',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 525,
                'state_id' => 11,
                'name_ar' => 'دير مواس',
                'name_en' => 'Deir Mawas',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 526,
                'state_id' => 16,
                'name_ar' => 'أسيوط',
                'name_en' => 'Assiut',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 527,
                'state_id' => 16,
                'name_ar' => 'أسيوط الجديدة',
                'name_en' => 'Assiut El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 528,
                'state_id' => 16,
                'name_ar' => 'ديروط',
                'name_en' => 'Dayrout',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 529,
                'state_id' => 16,
                'name_ar' => 'منفلوط',
                'name_en' => 'Manfalut',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 530,
                'state_id' => 16,
                'name_ar' => 'القوصية',
                'name_en' => 'Qusiya',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 531,
                'state_id' => 16,
                'name_ar' => 'أبنوب',
                'name_en' => 'Abnoub',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 532,
                'state_id' => 16,
                'name_ar' => 'أبو تيج',
                'name_en' => 'Abu Tig',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 533,
                'state_id' => 16,
                'name_ar' => 'الغنايم',
                'name_en' => 'El Ghanaim',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 534,
                'state_id' => 16,
                'name_ar' => 'ساحل سليم',
                'name_en' => 'Sahel Selim',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 535,
                'state_id' => 16,
                'name_ar' => 'البداري',
                'name_en' => 'El Badari',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 536,
                'state_id' => 16,
                'name_ar' => 'صدفا',
                'name_en' => 'Sidfa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 537,
                'state_id' => 13,
                'name_ar' => 'الخارجة',
                'name_en' => 'El Kharga',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 538,
                'state_id' => 13,
                'name_ar' => 'باريس',
                'name_en' => 'Paris',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 539,
                'state_id' => 13,
                'name_ar' => 'موط',
                'name_en' => 'Mout',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 540,
                'state_id' => 13,
                'name_ar' => 'الفرافرة',
                'name_en' => 'Farafra',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 541,
                'state_id' => 13,
                'name_ar' => 'بلاط',
                'name_en' => 'Balat',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 542,
                'state_id' => 5,
                'name_ar' => 'الغردقة',
                'name_en' => 'Hurghada',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 543,
                'state_id' => 5,
                'name_ar' => 'رأس غارب',
                'name_en' => 'Ras Ghareb',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 544,
                'state_id' => 5,
                'name_ar' => 'سفاجا',
                'name_en' => 'Safaga',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 545,
                'state_id' => 5,
                'name_ar' => 'القصير',
                'name_en' => 'El Qusiar',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 546,
                'state_id' => 5,
                'name_ar' => 'مرسى علم',
                'name_en' => 'Marsa Alam',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 547,
                'state_id' => 5,
                'name_ar' => 'الشلاتين',
                'name_en' => 'Shalatin',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 548,
                'state_id' => 5,
                'name_ar' => 'حلايب',
                'name_en' => 'Halaib',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 549,
                'state_id' => 27,
                'name_ar' => 'سوهاج',
                'name_en' => 'Sohag',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 550,
                'state_id' => 27,
                'name_ar' => 'سوهاج الجديدة',
                'name_en' => 'Sohag El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 551,
                'state_id' => 27,
                'name_ar' => 'أخميم',
                'name_en' => 'Akhmeem',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 552,
                'state_id' => 27,
                'name_ar' => 'أخميم الجديدة',
                'name_en' => 'Akhmim El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 553,
                'state_id' => 27,
                'name_ar' => 'البلينا',
                'name_en' => 'Albalina',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 554,
                'state_id' => 27,
                'name_ar' => 'المراغة',
                'name_en' => 'El Maragha',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 555,
                'state_id' => 27,
                'name_ar' => 'المنشأة',
                'name_en' => 'almunsha',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 556,
                'state_id' => 27,
                'name_ar' => 'دار السلام',
                'name_en' => 'Dar AISalaam',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 557,
                'state_id' => 27,
                'name_ar' => 'جرجا',
                'name_en' => 'Gerga',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 558,
                'state_id' => 27,
                'name_ar' => 'جهينة الغربية',
                'name_en' => 'Jahina Al Gharbia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 559,
                'state_id' => 27,
                'name_ar' => 'ساقلته',
                'name_en' => 'Saqilatuh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 560,
                'state_id' => 27,
                'name_ar' => 'طما',
                'name_en' => 'Tama',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 561,
                'state_id' => 27,
                'name_ar' => 'طهطا',
                'name_en' => 'Tahta',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 562,
                'state_id' => 25,
                'name_ar' => 'قنا',
                'name_en' => 'Qena',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 563,
                'state_id' => 25,
                'name_ar' => 'قنا الجديدة',
                'name_en' => 'New Qena',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 564,
                'state_id' => 25,
                'name_ar' => 'أبو تشت',
                'name_en' => 'Abu Tesht',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 565,
                'state_id' => 25,
                'name_ar' => 'نجع حمادي',
                'name_en' => 'Nag Hammadi',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 566,
                'state_id' => 25,
                'name_ar' => 'دشنا',
                'name_en' => 'Deshna',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 567,
                'state_id' => 25,
                'name_ar' => 'الوقف',
                'name_en' => 'Alwaqf',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 568,
                'state_id' => 25,
                'name_ar' => 'قفط',
                'name_en' => 'Qaft',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 569,
                'state_id' => 25,
                'name_ar' => 'نقادة',
                'name_en' => 'Naqada',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 570,
                'state_id' => 25,
                'name_ar' => 'فرشوط',
                'name_en' => 'Farshout',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 571,
                'state_id' => 25,
                'name_ar' => 'قوص',
                'name_en' => 'Quos',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 572,
                'state_id' => 24,
                'name_ar' => 'الأقصر',
                'name_en' => 'Luxor',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 573,
                'state_id' => 24,
                'name_ar' => 'الأقصر الجديدة',
                'name_en' => 'New Luxor',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 574,
                'state_id' => 24,
                'name_ar' => 'إسنا',
                'name_en' => 'Esna',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 575,
                'state_id' => 24,
                'name_ar' => 'طيبة الجديدة',
                'name_en' => 'New Tiba',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 576,
                'state_id' => 24,
                'name_ar' => 'الزينية',
                'name_en' => 'Al ziynia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 577,
                'state_id' => 24,
                'name_ar' => 'البياضية',
                'name_en' => 'Al Bayadieh',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 578,
                'state_id' => 24,
                'name_ar' => 'القرنة',
                'name_en' => 'Al Qarna',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 579,
                'state_id' => 24,
                'name_ar' => 'أرمنت',
                'name_en' => 'Armant',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 580,
                'state_id' => 24,
                'name_ar' => 'الطود',
                'name_en' => 'Al Tud',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 581,
                'state_id' => 15,
                'name_ar' => 'أسوان',
                'name_en' => 'Aswan',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 582,
                'state_id' => 15,
                'name_ar' => 'أسوان الجديدة',
                'name_en' => 'Aswan El Gedida',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 583,
                'state_id' => 15,
                'name_ar' => 'دراو',
                'name_en' => 'Drau',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 584,
                'state_id' => 15,
                'name_ar' => 'كوم أمبو',
                'name_en' => 'Kom Ombo',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 585,
                'state_id' => 15,
                'name_ar' => 'نصر النوبة',
                'name_en' => 'Nasr Al Nuba',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 586,
                'state_id' => 15,
                'name_ar' => 'كلابشة',
                'name_en' => 'Kalabsha',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 587,
                'state_id' => 15,
                'name_ar' => 'إدفو',
                'name_en' => 'Edfu',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 588,
                'state_id' => 15,
                'name_ar' => 'الرديسية',
                'name_en' => 'Al-Radisiyah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 589,
                'state_id' => 15,
                'name_ar' => 'البصيلية',
                'name_en' => 'Al Basilia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 590,
                'state_id' => 15,
                'name_ar' => 'السباعية',
                'name_en' => 'Al Sibaeia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 591,
                'state_id' => 15,
                'name_ar' => 'ابوسمبل السياحية',
                'name_en' => 'Abo Simbl Al Siyahia',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 592,
                'state_id' => 1,
                'name_ar' => 'مصر الجديدة ',
                'name_en' => ' Heliopolis ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 593,
                'state_id' => 1,
                'name_ar' => ' مدينة نصر  ',
                'name_en' => ' Nasr City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 594,
                'state_id' => 1,
                'name_ar' => ' المعادي  ',
                'name_en' => ' El-Maadi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 595,
                'state_id' => 1,
                'name_ar' => ' التجمع الخامس  ',
                'name_en' => ' New Cairo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 596,
                'state_id' => 1,
                'name_ar' => ' حدائق القبة  ',
                'name_en' => ' Hadayek El-Kobba ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 597,
                'state_id' => 1,
                'name_ar' => ' مدينة العبور  ',
                'name_en' => ' El-Obour City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 598,
                'state_id' => 1,
                'name_ar' => ' المنيل  ',
                'name_en' => ' El-Manyal ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 599,
                'state_id' => 1,
                'name_ar' => ' شبرا  ',
                'name_en' => ' Shoubra',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 600,
                'state_id' => 1,
                'name_ar' => ' وسط البلد  ',
                'name_en' => ' West El-Balad ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 601,
                'state_id' => 1,
                'name_ar' => ' مدينة السلام  ',
                'name_en' => ' El Salam City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 602,
                'state_id' => 1,
                'name_ar' => ' الرحاب  ',
                'name_en' => ' El-Rehab ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 603,
                'state_id' => 1,
                'name_ar' => ' الزمالك  ',
                'name_en' => ' El-Zamalek ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 604,
                'state_id' => 1,
                'name_ar' => ' الزيتون  ',
                'name_en' => ' El-Zaitoun ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 605,
                'state_id' => 1,
                'name_ar' => ' السيدة زينب  ',
                'name_en' => ' El-Sayeda Zainab ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 606,
                'state_id' => 1,
                'name_ar' => ' الشروق  ',
                'name_en' => ' El-Shorouk ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 607,
                'state_id' => 1,
                'name_ar' => ' العاشر من رمضان  ',
                'name_en' => ' 10th of Ramadan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 608,
                'state_id' => 1,
                'name_ar' => ' العباسية  ',
                'name_en' => ' El-Abbasia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 609,
                'state_id' => 1,
                'name_ar' => ' القطامية  ',
                'name_en' => ' El-Kattameya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 610,
                'state_id' => 1,
                'name_ar' => ' المرج  ',
                'name_en' => ' El-Marg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 611,
                'state_id' => 1,
                'name_ar' => ' المطرية  ',
                'name_en' => ' El-Matareya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 612,
                'state_id' => 1,
                'name_ar' => ' المقطم  ',
                'name_en' => ' El-Mokattam ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 613,
                'state_id' => 1,
                'name_ar' => ' بولاق  ',
                'name_en' => ' Boulaq ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 614,
                'state_id' => 1,
                'name_ar' => ' حدائق المعادي  ',
                'name_en' => ' Hadayek El Maadi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 615,
                'state_id' => 1,
                'name_ar' => ' حدائق حلوان  ',
                'name_en' => ' Hadayek Helwan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 616,
                'state_id' => 1,
                'name_ar' => ' حلوان  ',
                'name_en' => ' Helwan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 617,
                'state_id' => 1,
                'name_ar' => ' دار السلام  ',
                'name_en' => ' Dar El-Salam ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 618,
                'state_id' => 1,
                'name_ar' => ' شبرا الخيمة  ',
                'name_en' => ' Shoubra El-Kheima ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 619,
                'state_id' => 1,
                'name_ar' => ' عين شمس  ',
                'name_en' => ' Ain Shams ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 620,
                'state_id' => 1,
                'name_ar' => ' مدينة بدر  ',
                'name_en' => ' Badr City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 621,
                'state_id' => 1,
                'name_ar' => ' مدينتي  ',
                'name_en' => ' Madinaty ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 622,
                'state_id' => 1,
                'name_ar' => ' مصر القديمة  ',
                'name_en' => ' Masr El-Kadima ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 623,
                'state_id' => 46,
                'name_ar' => ' أبو هيل  ',
                'name_en' => ' Abu Hail  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 624,
                'state_id' => 46,
                'name_ar' => ' جميرا ١  ',
                'name_en' => ' Jumeirah 1  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 625,
                'state_id' => 46,
                'name_ar' => ' البراحة  ',
                'name_en' => ' Al Baraha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 626,
                'state_id' => 46,
                'name_ar' => ' الكفاف  ',
                'name_en' => ' Al Kifaf  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 627,
                'state_id' => 46,
                'name_ar' => ' مدينة دبي الأكاديمية  ',
                'name_en' => ' Academic City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 628,
                'state_id' => 46,
                'name_ar' => ' العوير  ',
                'name_en' => ' Al Awir  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 629,
                'state_id' => 46,
                'name_ar' => ' البدع  ',
                'name_en' => ' Al Badaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 630,
                'state_id' => 46,
                'name_ar' => ' البراري  ',
                'name_en' => ' Al Barari  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 631,
                'state_id' => 46,
                'name_ar' => ' المنارة  ',
                'name_en' => ' Al Manara  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 632,
                'state_id' => 46,
                'name_ar' => ' البرشاء  ',
                'name_en' => ' Al Barsha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 633,
                'state_id' => 46,
                'name_ar' => ' البطين  ',
                'name_en' => ' Al Buteen  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 634,
                'state_id' => 46,
                'name_ar' => ' الضغاية  ',
                'name_en' => ' Al Daghaya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 635,
                'state_id' => 46,
                'name_ar' => ' الفرجان  ',
                'name_en' => ' Al Furjan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 636,
                'state_id' => 46,
                'name_ar' => ' القرهود  ',
                'name_en' => ' Al Garhoud  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 637,
                'state_id' => 46,
                'name_ar' => ' الحمرية  ',
                'name_en' => ' Al Hamriya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 638,
                'state_id' => 46,
                'name_ar' => ' الحضيبة  ',
                'name_en' => ' Al Hudaiba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 639,
                'state_id' => 46,
                'name_ar' => ' الجداف  ',
                'name_en' => ' Al Jaddaf  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 640,
                'state_id' => 46,
                'name_ar' => ' الجافلية  ',
                'name_en' => ' Al Jafiliya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 641,
                'state_id' => 46,
                'name_ar' => ' الممزر  ',
                'name_en' => ' Al Mamzar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 642,
                'state_id' => 46,
                'name_ar' => ' المطينة  ',
                'name_en' => ' Al Muteena  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 643,
                'state_id' => 46,
                'name_ar' => ' النهدة  ',
                'name_en' => ' Al Nahda  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 644,
                'state_id' => 46,
                'name_ar' => ' النصر  ',
                'name_en' => ' Al Nasr  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 645,
                'state_id' => 46,
                'name_ar' => ' القوز  ',
                'name_en' => ' Al Quoz  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 646,
                'state_id' => 46,
                'name_ar' => ' القصيص  ',
                'name_en' => ' Al Qusais  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 647,
                'state_id' => 46,
                'name_ar' => ' الرفاعة  ',
                'name_en' => ' Al Raffa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 648,
                'state_id' => 46,
                'name_ar' => ' الراشدية  ',
                'name_en' => ' Al Rashidiya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 649,
                'state_id' => 46,
                'name_ar' => ' الرقة  ',
                'name_en' => ' Al Rigga  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 650,
                'state_id' => 46,
                'name_ar' => ' الصفا  ',
                'name_en' => ' Al Safa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 651,
                'state_id' => 46,
                'name_ar' => ' السطوة  ',
                'name_en' => ' Al Satwa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 652,
                'state_id' => 46,
                'name_ar' => ' السوق  ',
                'name_en' => ' Al Souk  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 653,
                'state_id' => 46,
                'name_ar' => ' الصفوح  ',
                'name_en' => ' Al Sufouh  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 654,
                'state_id' => 46,
                'name_ar' => ' الطوار  ',
                'name_en' => ' Al Twar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 655,
                'state_id' => 46,
                'name_ar' => ' الورقاء  ',
                'name_en' => ' Al Warqaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 656,
                'state_id' => 46,
                'name_ar' => ' الوصل  ',
                'name_en' => ' Al Wasl  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 657,
                'state_id' => 46,
                'name_ar' => ' الوحيدة  ',
                'name_en' => ' Al Wuheida  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 658,
                'state_id' => 46,
                'name_ar' => ' المرابع العربية  ',
                'name_en' => ' Arabian Ranches  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 659,
                'state_id' => 46,
                'name_ar' => ' ميدان بني ياس  ',
                'name_en' => ' Baniyas Square  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 660,
                'state_id' => 46,
                'name_ar' => ' بوكدرة  ',
                'name_en' => ' Bukadra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 661,
                'state_id' => 46,
                'name_ar' => ' بر دبي  ',
                'name_en' => ' Bur Dubai  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 662,
                'state_id' => 46,
                'name_ar' => ' الخليج التجاري  ',
                'name_en' => ' Business Bay  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 663,
                'state_id' => 46,
                'name_ar' => ' سيتي أوف ارابيا  ',
                'name_en' => ' City of Arabia  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 664,
                'state_id' => 46,
                'name_ar' => ' كورنيش ديرة  ',
                'name_en' => ' Corniche Deira  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 665,
                'state_id' => 46,
                'name_ar' => ' قرية الثقافة  ',
                'name_en' => ' Culture Village  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 666,
                'state_id' => 46,
                'name_ar' => ' ديرة  ',
                'name_en' => ' Deira  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 667,
                'state_id' => 46,
                'name_ar' => ' ديسكفري جاردنز  ',
                'name_en' => ' Discovery Gardens  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 668,
                'state_id' => 46,
                'name_ar' => ' مركز دبي المالي العالمي  ',
                'name_en' => ' DIFC  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 669,
                'state_id' => 46,
                'name_ar' => ' مدينة دبي للانترنت  ',
                'name_en' => ' Dubai Internet City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 670,
                'state_id' => 46,
                'name_ar' => ' مدينة دبي للإعلام  ',
                'name_en' => ' Dubai Media City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 671,
                'state_id' => 46,
                'name_ar' => ' دبي وسط المدينة  ',
                'name_en' => ' Downtown Dubai  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 672,
                'state_id' => 46,
                'name_ar' => ' جبل علي داون تاون  ',
                'name_en' => ' Downtown Jabel Ali  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 673,
                'state_id' => 46,
                'name_ar' => ' مطار دبي الدولي  ',
                'name_en' => ' Dubai International Airport  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 674,
                'state_id' => 46,
                'name_ar' => ' دبي فيستيفال سيتي  ',
                'name_en' => ' Dubai Festival City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 675,
                'state_id' => 46,
                'name_ar' => ' مدينة دبي الطبية  ',
                'name_en' => ' Dubai Healthcare City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 676,
                'state_id' => 46,
                'name_ar' => ' مدينة دبي الصناعية  ',
                'name_en' => ' Dubai Industrial City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 677,
                'state_id' => 46,
                'name_ar' => ' مدينة دبي الأكاديمية العالمية  ',
                'name_en' => ' Dubai International Academic City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 678,
                'state_id' => 46,
                'name_ar' => ' مجمع دبي للاستثمار  ',
                'name_en' => ' Dubai Investment Park  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 679,
                'state_id' => 46,
                'name_ar' => ' دبي لاجون  ',
                'name_en' => ' Dubai Lagoon  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 680,
                'state_id' => 46,
                'name_ar' => ' دبي لاند  ',
                'name_en' => ' Dubailand  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 681,
                'state_id' => 46,
                'name_ar' => ' مرسى دبي  ',
                'name_en' => ' Dubai Marina  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 682,
                'state_id' => 46,
                'name_ar' => ' المدينة البحرية  ',
                'name_en' => ' Dubai Maritime City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 683,
                'state_id' => 46,
                'name_ar' => ' لؤلؤة دبي  ',
                'name_en' => ' Dubai Pearl  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 684,
                'state_id' => 46,
                'name_ar' => ' واحة دبي للسيليكون  ',
                'name_en' => ' Dubai Silicon Oasis  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 685,
                'state_id' => 46,
                'name_ar' => ' مديبة دبي الرياضية  ',
                'name_en' => ' Dubai Sports City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 686,
                'state_id' => 46,
                'name_ar' => ' الواجهة المائية  ',
                'name_en' => ' Dubai Waterfront  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 687,
                'state_id' => 46,
                'name_ar' => ' ديب وورلد سنترال  ',
                'name_en' => ' Dubai World Central  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 688,
                'state_id' => 46,
                'name_ar' => ' تلال الإمارات  ',
                'name_en' => ' Emirates Hills  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 689,
                'state_id' => 46,
                'name_ar' => ' إعمار بيزنس بارك  ',
                'name_en' => ' Emaar Business Park  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 690,
                'state_id' => 46,
                'name_ar' => ' فالكون سيتي  ',
                'name_en' => ' Falcon City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 691,
                'state_id' => 46,
                'name_ar' => ' شارع الشيخ زايد  ',
                'name_en' => ' Sheikh Zayed Road  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 692,
                'state_id' => 46,
                'name_ar' => ' ميناء الحمرية  ',
                'name_en' => ' Hamriya Port  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 693,
                'state_id' => 46,
                'name_ar' => ' هور العنز  ',
                'name_en' => ' Hor Al Anz  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 694,
                'state_id' => 46,
                'name_ar' => ' المدينة العالمية  ',
                'name_en' => ' International City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 695,
                'state_id' => 46,
                'name_ar' => ' مدينة الانتاج الإعلامي  ',
                'name_en' => ' International Media Production Zone  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 696,
                'state_id' => 46,
                'name_ar' => ' جبل علي  ',
                'name_en' => ' Jebel Ali  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 697,
                'state_id' => 46,
                'name_ar' => ' المنطقة الحرة جبل علي  ',
                'name_en' => ' Jebel Ali Free Zone Area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 698,
                'state_id' => 46,
                'name_ar' => ' المنطقة الصناعية جبل علي  ',
                'name_en' => ' Jebel Ali Industrial Area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 699,
                'state_id' => 46,
                'name_ar' => ' قرية جبل علي  ',
                'name_en' => ' Jebel Ali Village  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 700,
                'state_id' => 46,
                'name_ar' => ' جميرا بيتش ريزيدنس  ',
                'name_en' => ' Jumeirah Beach Residence  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 701,
                'state_id' => 46,
                'name_ar' => ' عقارات جميرا للجولف  ',
                'name_en' => ' Jumeirah Golf Estates  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 702,
                'state_id' => 46,
                'name_ar' => ' مرتفعات جميرا  ',
                'name_en' => ' Jumeirah Heights  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 703,
                'state_id' => 46,
                'name_ar' => ' جزر جميرا  ',
                'name_en' => ' Jumeirah Islands  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 704,
                'state_id' => 46,
                'name_ar' => ' أبراج بحيرات الجميرا  ',
                'name_en' => ' Jumeirah Lake Towers  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 705,
                'state_id' => 46,
                'name_ar' => ' جميرا بارك  ',
                'name_en' => ' Jumeirah Park  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 706,
                'state_id' => 46,
                'name_ar' => ' جميرا فيلج ساوث  ',
                'name_en' => ' Jumeirah Village South  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 707,
                'state_id' => 46,
                'name_ar' => ' مثلث قرية الجميرا  ',
                'name_en' => ' Jumeirah Village Triangle  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 708,
                'state_id' => 46,
                'name_ar' => ' قرية المعرفة  ',
                'name_en' => ' Knowledge Village  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 709,
                'state_id' => 46,
                'name_ar' => ' أساطير دبي  ',
                'name_en' => ' Legends Dubai  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 710,
                'state_id' => 46,
                'name_ar' => ' مجان  ',
                'name_en' => ' Majan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 711,
                'state_id' => 46,
                'name_ar' => ' منخول  ',
                'name_en' => ' Mankhool  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 712,
                'state_id' => 46,
                'name_ar' => ' موتور سيتي  ',
                'name_en' => ' Motor City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 713,
                'state_id' => 46,
                'name_ar' => ' مردف  ',
                'name_en' => ' Mirdif  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 714,
                'state_id' => 46,
                'name_ar' => ' محيصنة  ',
                'name_en' => ' Muhaisanah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 715,
                'state_id' => 46,
                'name_ar' => ' مصلى العيد  ',
                'name_en' => ' Musallah Al Eid  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 716,
                'state_id' => 46,
                'name_ar' => ' ند الحمر  ',
                'name_en' => ' Nad Al Hamar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 717,
                'state_id' => 46,
                'name_ar' => ' الكرامة  ',
                'name_en' => ' Al Karama  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 718,
                'state_id' => 46,
                'name_ar' => ' نايف  ',
                'name_en' => ' Naif  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 719,
                'state_id' => 47,
                'name_ar' => ' شارع راشد بن سعيد المكتوم  ',
                'name_en' => ' Rashid Bin Saeed Al Maktoum Street  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 720,
                'state_id' => 47,
                'name_ar' => ' شارع دلما  ',
                'name_en' => ' Delma Street  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 721,
                'state_id' => 47,
                'name_ar' => ' طريق المطار  ',
                'name_en' => ' Airport Road  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 722,
                'state_id' => 47,
                'name_ar' => ' طريق المطار القديم  ',
                'name_en' => ' Old Airport Road  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 723,
                'state_id' => 47,
                'name_ar' => ' مصفح  ',
                'name_en' => ' Musaffah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 724,
                'state_id' => 47,
                'name_ar' => ' الميناء  ',
                'name_en' => ' Al Mina  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 725,
                'state_id' => 47,
                'name_ar' => ' مدينة محمد بن زايد  ',
                'name_en' => ' Mohamed Bin Zayed City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 726,
                'state_id' => 47,
                'name_ar' => ' مارينا  ',
                'name_en' => ' Marina Village  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 727,
                'state_id' => 47,
                'name_ar' => ' المرور  ',
                'name_en' => ' Al Muroor  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 728,
                'state_id' => 47,
                'name_ar' => ' شارع السلام  ',
                'name_en' => ' Al Salam Street  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 729,
                'state_id' => 47,
                'name_ar' => ' المركزية  ',
                'name_en' => ' Al Markaziyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 730,
                'state_id' => 47,
                'name_ar' => ' الخالدية  ',
                'name_en' => ' Al Khalidiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 731,
                'state_id' => 47,
                'name_ar' => ' منطقة النادي السياحي  ',
                'name_en' => ' Tourist club area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 732,
                'state_id' => 47,
                'name_ar' => ' البطين  ',
                'name_en' => ' Al Bateen  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 733,
                'state_id' => 47,
                'name_ar' => ' المشرف  ',
                'name_en' => ' Al Mushrif  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 734,
                'state_id' => 47,
                'name_ar' => ' النهيان  ',
                'name_en' => ' Al Nahyan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 735,
                'state_id' => 47,
                'name_ar' => ' هدبة الزعفرانة  ',
                'name_en' => ' Hadbat Al Zafrana  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 736,
                'state_id' => 47,
                'name_ar' => ' القويبسات  ',
                'name_en' => ' Al Qubesat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 737,
                'state_id' => 47,
                'name_ar' => ' الكرامة  ',
                'name_en' => ' Al Karamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 738,
                'state_id' => 47,
                'name_ar' => ' شارع حمدان بن محمد  ',
                'name_en' => ' cHamdan Bin Mohammed Street  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 739,
                'state_id' => 47,
                'name_ar' => ' النجدة  ',
                'name_en' => ' Al Najda  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 740,
                'state_id' => 47,
                'name_ar' => ' شارع الخليج العربي  ',
                'name_en' => ' Al Khaleej Al Arabi Street  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            240 => 
            array (
                'id' => 741,
                'state_id' => 47,
                'name_ar' => ' توسيع مطار أبو ظبي  ',
                'name_en' => ' Abu Dhabi Airport Expansion  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            241 => 
            array (
                'id' => 742,
                'state_id' => 47,
                'name_ar' => ' القوع  ',
                'name_en' => ' Al Quaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            242 => 
            array (
                'id' => 743,
                'state_id' => 47,
                'name_ar' => ' فلج هزاع  ',
                'name_en' => ' Al Falaj Hazzaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            243 => 
            array (
                'id' => 744,
                'state_id' => 47,
                'name_ar' => ' مطار أبو ظبي المنطقة الحرة  ',
                'name_en' => ' Abu Dhabi Airport Freezone  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            244 => 
            array (
                'id' => 745,
                'state_id' => 47,
                'name_ar' => ' مستشفى فالكون  ',
                'name_en' => ' Abu Dhabi Falcon Hospital  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            245 => 
            array (
                'id' => 746,
                'state_id' => 47,
                'name_ar' => ' البندر  ',
                'name_en' => ' Al Bandar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            246 => 
            array (
                'id' => 747,
                'state_id' => 47,
                'name_ar' => ' الحصن  ',
                'name_en' => ' Al Hosn  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            247 => 
            array (
                'id' => 748,
                'state_id' => 47,
                'name_ar' => ' بجانب فورملا أبوظبي  ',
                'name_en' => ' Near Abu Dhabi Formula  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            248 => 
            array (
                'id' => 749,
                'state_id' => 47,
                'name_ar' => ' مدينة بوابة أبوظبي  ',
                'name_en' => ' Abu Dhabi Gate City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            249 => 
            array (
                'id' => 750,
                'state_id' => 47,
                'name_ar' => ' بالقرب من أبو ظبي للغولف و نادي الفروسية  ',
                'name_en' => ' near Abu Dhabi Golf and Equestrian Club  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            250 => 
            array (
                'id' => 751,
                'state_id' => 47,
                'name_ar' => ' بالقرب من نادي أبوظبي للجولف و السبا  ',
                'name_en' => ' near Abu Dhabi Golf Club and Spa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            251 => 
            array (
                'id' => 752,
                'state_id' => 47,
                'name_ar' => ' مدينة أبو ظبي الصناعية  ',
                'name_en' => ' Abu Dhabi Industrial City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            252 => 
            array (
                'id' => 753,
                'state_id' => 47,
                'name_ar' => ' مطار أبو ظبي الدولي  ',
                'name_en' => ' Abu Dhabi International Airport  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            253 => 
            array (
                'id' => 754,
                'state_id' => 47,
                'name_ar' => ' جزيرة أبو ظبي  ',
                'name_en' => ' Abu Dhabi Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            254 => 
            array (
                'id' => 755,
                'state_id' => 47,
                'name_ar' => ' بالقرب من أبو ظبي مول  ',
                'name_en' => ' near Abu Dhabi Mall  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            255 => 
            array (
                'id' => 756,
                'state_id' => 47,
                'name_ar' => ' خليج زايد  ',
                'name_en' => ' Zayed Bay  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            256 => 
            array (
                'id' => 757,
                'state_id' => 47,
                'name_ar' => ' منتجع ياس ووترفرونت  ',
                'name_en' => ' Yas Waterfront Resorts and Links  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            257 => 
            array (
                'id' => 758,
                'state_id' => 47,
                'name_ar' => ' بالقرب من مستشفى لايفلاين  ',
                'name_en' => ' near Lifeline Hospital  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            258 => 
            array (
                'id' => 759,
                'state_id' => 47,
                'name_ar' => ' بالقرب من دوار قرقاش  ',
                'name_en' => ' near Gargash Round About  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            259 => 
            array (
                'id' => 760,
                'state_id' => 47,
                'name_ar' => ' جزيرة الفطيسي  ',
                'name_en' => ' Futaysi Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            260 => 
            array (
                'id' => 761,
                'state_id' => 47,
                'name_ar' => ' بالقرب من قصر الإمارات  ',
                'name_en' => ' near Emirates Palace  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            261 => 
            array (
                'id' => 762,
                'state_id' => 47,
                'name_ar' => ' الشهامة  ',
                'name_en' => ' Shahama  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            262 => 
            array (
                'id' => 763,
                'state_id' => 47,
                'name_ar' => ' شمس أبوظبي  ',
                'name_en' => ' Shams Abu Dhabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            263 => 
            array (
                'id' => 764,
                'state_id' => 47,
                'name_ar' => ' بالقرب من خليفة بارك  ',
                'name_en' => ' near Sheikh Khalifa Park  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            264 => 
            array (
                'id' => 765,
                'state_id' => 47,
                'name_ar' => ' بالقرب من مسجد الشيخ زايد الكبير  ',
                'name_en' => ' near Sheikh Zayed Grand Mosque  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            265 => 
            array (
                'id' => 766,
                'state_id' => 47,
                'name_ar' => ' أم النار  ',
                'name_en' => ' Umm Al Nar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            266 => 
            array (
                'id' => 767,
                'state_id' => 47,
                'name_ar' => ' جزيرة أم يفينة  ',
                'name_en' => ' Umm Yifenah Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            267 => 
            array (
                'id' => 768,
                'state_id' => 47,
                'name_ar' => ' بالقرب من مارينا مول  ',
                'name_en' => ' near Marina Mall  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            268 => 
            array (
                'id' => 769,
                'state_id' => 47,
                'name_ar' => ' مدينة زايد  ',
                'name_en' => ' Madinat Zayed  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            269 => 
            array (
                'id' => 770,
                'state_id' => 47,
                'name_ar' => ' بالقرب من مركز مدينة زايد للتسوق  ',
                'name_en' => ' near Madinat Zayed Shopping Centre  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            270 => 
            array (
                'id' => 771,
                'state_id' => 47,
                'name_ar' => ' منطقة المانغروف الشمالية  ',
                'name_en' => ' Mangrove Area North  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            271 => 
            array (
                'id' => 772,
                'state_id' => 47,
                'name_ar' => ' مدينة الأنوار  ',
                'name_en' => ' City of Lights  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            272 => 
            array (
                'id' => 773,
                'state_id' => 47,
                'name_ar' => ' جزيرة جوز الهند  ',
                'name_en' => ' Coconut Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            273 => 
            array (
                'id' => 774,
                'state_id' => 47,
                'name_ar' => ' دانة أبو ظبي  ',
                'name_en' => ' Danet Abu Dhabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            274 => 
            array (
                'id' => 775,
                'state_id' => 47,
                'name_ar' => ' كورنيش  ',
                'name_en' => ' Corniche  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            275 => 
            array (
                'id' => 776,
                'state_id' => 47,
                'name_ar' => ' جزيرة اللولو  ',
                'name_en' => ' Lulu Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            276 => 
            array (
                'id' => 777,
                'state_id' => 47,
                'name_ar' => ' وسط المدينة  ',
                'name_en' => ' City Center  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            277 => 
            array (
                'id' => 778,
                'state_id' => 47,
                'name_ar' => ' بالقرب من مركز أبو ظبي الوطني للمعارض  ',
                'name_en' => ' near Abu Dhabi National Exhibition Centre  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            278 => 
            array (
                'id' => 779,
                'state_id' => 47,
                'name_ar' => ' بالقرب من جامعة أبو ظبي  ',
                'name_en' => ' near Abu Dhabi University  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            279 => 
            array (
                'id' => 780,
                'state_id' => 47,
                'name_ar' => ' جزيرة الغدير  ',
                'name_en' => ' Al Ghadeer Village  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            280 => 
            array (
                'id' => 781,
                'state_id' => 47,
                'name_ar' => ' الأمان  ',
                'name_en' => ' Al Aman  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            281 => 
            array (
                'id' => 782,
                'state_id' => 47,
                'name_ar' => ' الباهية  ',
                'name_en' => ' Al Bahia  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            282 => 
            array (
                'id' => 783,
                'state_id' => 47,
                'name_ar' => ' مطار البطين  ',
                'name_en' => ' Al Bateen Airport  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            283 => 
            array (
                'id' => 784,
                'state_id' => 47,
                'name_ar' => ' الدانة  ',
                'name_en' => ' Al Dana  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            284 => 
            array (
                'id' => 785,
                'state_id' => 47,
                'name_ar' => ' جزيرة ياس  ',
                'name_en' => ' Yas Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            285 => 
            array (
                'id' => 786,
                'state_id' => 47,
                'name_ar' => ' جزيرة نوري  ',
                'name_en' => ' Nurai Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            286 => 
            array (
                'id' => 787,
                'state_id' => 47,
                'name_ar' => ' مدينة خليفة  ',
                'name_en' => ' Khalifa City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            287 => 
            array (
                'id' => 788,
                'state_id' => 47,
                'name_ar' => ' شاطئ السعديات  ',
                'name_en' => ' Saadiyat Beach  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            288 => 
            array (
                'id' => 789,
                'state_id' => 47,
                'name_ar' => ' المنطقة الثقافية في السعديات  ',
                'name_en' => ' Saadiyat Cultural District  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            289 => 
            array (
                'id' => 790,
                'state_id' => 47,
                'name_ar' => ' جزيرة السعديات  ',
                'name_en' => ' Saadiyat Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            290 => 
            array (
                'id' => 791,
                'state_id' => 47,
                'name_ar' => ' مدينة الفلاح  ',
                'name_en' => ' Al Falah City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            291 => 
            array (
                'id' => 792,
                'state_id' => 47,
                'name_ar' => ' حدائق بلووم  ',
                'name_en' => ' Bloom Gardens  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            292 => 
            array (
                'id' => 793,
                'state_id' => 47,
                'name_ar' => ' خور الراحة  ',
                'name_en' => ' Khor Al Raha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            293 => 
            array (
                'id' => 794,
                'state_id' => 47,
                'name_ar' => ' الاتحاد  ',
                'name_en' => ' Al Ittihad  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            294 => 
            array (
                'id' => 795,
                'state_id' => 47,
                'name_ar' => ' نادي الغزال للجولف  ',
                'name_en' => ' Al Ghazal Golf Club  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            295 => 
            array (
                'id' => 796,
                'state_id' => 47,
                'name_ar' => ' جزيرة الريم  ',
                'name_en' => ' Al Reem Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            296 => 
            array (
                'id' => 797,
                'state_id' => 47,
                'name_ar' => ' الشليلة  ',
                'name_en' => ' Al Shaleela  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            297 => 
            array (
                'id' => 798,
                'state_id' => 47,
                'name_ar' => ' السيف  ',
                'name_en' => ' Al Seef  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            298 => 
            array (
                'id' => 799,
                'state_id' => 47,
                'name_ar' => ' أرزنة  ',
                'name_en' => ' Arzanah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            299 => 
            array (
                'id' => 800,
                'state_id' => 47,
                'name_ar' => ' طموح مارينا سكوير  ',
                'name_en' => ' Tamouh Marina Square  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            300 => 
            array (
                'id' => 801,
                'state_id' => 47,
                'name_ar' => ' نجمة أبو ظبي  ',
                'name_en' => ' Najmat Abu Dhabi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            301 => 
            array (
                'id' => 802,
                'state_id' => 47,
                'name_ar' => ' العاصمة بلازا  ',
                'name_en' => ' Capital Plaza  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            302 => 
            array (
                'id' => 803,
                'state_id' => 47,
                'name_ar' => ' الشوامخ  ',
                'name_en' => ' Al Shawamekh  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            303 => 
            array (
                'id' => 804,
                'state_id' => 47,
                'name_ar' => ' الخبيرة  ',
                'name_en' => ' Al Khubeirah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            304 => 
            array (
                'id' => 805,
                'state_id' => 47,
                'name_ar' => ' المدينة الرياضية  ',
                'name_en' => ' Al Madina Al Riyadiya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            305 => 
            array (
                'id' => 806,
                'state_id' => 47,
                'name_ar' => ' المنيرة  ',
                'name_en' => ' Al Muneera  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            306 => 
            array (
                'id' => 807,
                'state_id' => 47,
                'name_ar' => ' مدينة مصدر  ',
                'name_en' => ' Masdar City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            307 => 
            array (
                'id' => 808,
                'state_id' => 47,
                'name_ar' => ' الزينة  ',
                'name_en' => ' Al Zeina  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            308 => 
            array (
                'id' => 809,
                'state_id' => 47,
                'name_ar' => ' الضفرة  ',
                'name_en' => ' Al Dhafrah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            309 => 
            array (
                'id' => 810,
                'state_id' => 47,
                'name_ar' => ' المنهل  ',
                'name_en' => ' Al Manhal  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            310 => 
            array (
                'id' => 811,
                'state_id' => 47,
                'name_ar' => ' المصلى  ',
                'name_en' => ' Al Musalla  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            311 => 
            array (
                'id' => 812,
                'state_id' => 47,
                'name_ar' => ' الريف  ',
                'name_en' => ' Al Reef  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            312 => 
            array (
                'id' => 813,
                'state_id' => 47,
                'name_ar' => ' الزاهية  ',
                'name_en' => ' Al Zahiya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            313 => 
            array (
                'id' => 814,
                'state_id' => 47,
                'name_ar' => ' الثريا  ',
                'name_en' => ' Al Thurayya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            314 => 
            array (
                'id' => 815,
                'state_id' => 47,
                'name_ar' => ' منطقة السفارات  ',
                'name_en' => ' Embassies District  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            315 => 
            array (
                'id' => 816,
                'state_id' => 47,
                'name_ar' => ' المقطع  ',
                'name_en' => ' Al Maqtaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            316 => 
            array (
                'id' => 817,
                'state_id' => 47,
                'name_ar' => ' المزون  ',
                'name_en' => ' Al Muzoon  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            317 => 
            array (
                'id' => 818,
                'state_id' => 47,
                'name_ar' => ' شاطئ الراحة  ',
                'name_en' => ' Al Raha Beach  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            318 => 
            array (
                'id' => 819,
                'state_id' => 47,
                'name_ar' => ' حدائق الراحة  ',
                'name_en' => ' Al Raha Gardens  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            319 => 
            array (
                'id' => 820,
                'state_id' => 47,
                'name_ar' => ' الرأس الأخضر  ',
                'name_en' => ' Al Ras Al Akhdar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            320 => 
            array (
                'id' => 821,
                'state_id' => 47,
                'name_ar' => ' قرية هيدرا  ',
                'name_en' => ' Hydra Village  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            321 => 
            array (
                'id' => 822,
                'state_id' => 47,
                'name_ar' => ' مصفح  ',
                'name_en' => ' Mussafah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            322 => 
            array (
                'id' => 823,
                'state_id' => 47,
                'name_ar' => ' الشامخة  ',
                'name_en' => ' Al Shamkha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            323 => 
            array (
                'id' => 824,
                'state_id' => 47,
                'name_ar' => ' المطار/شارع الشيخ راشد  ',
                'name_en' => ' Al Matar/ Sheikh Rashid Street  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            324 => 
            array (
                'id' => 825,
                'state_id' => 47,
                'name_ar' => ' الرحبة  ',
                'name_en' => ' Al Rahba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            325 => 
            array (
                'id' => 826,
                'state_id' => 48,
                'name_ar' => ' طريق الواسط  ',
                'name_en' => ' Al Wasit Road  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            326 => 
            array (
                'id' => 827,
                'state_id' => 48,
                'name_ar' => ' المنتزه  ',
                'name_en' => ' Al Muntazah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            327 => 
            array (
                'id' => 828,
                'state_id' => 48,
                'name_ar' => ' الذيد  ',
                'name_en' => ' Al Dhaid  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            328 => 
            array (
                'id' => 829,
                'state_id' => 48,
                'name_ar' => ' النهدة  ',
                'name_en' => ' Al Nahda  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            329 => 
            array (
                'id' => 830,
                'state_id' => 48,
                'name_ar' => ' القاسمية  ',
                'name_en' => ' Al Qasimia  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            330 => 
            array (
                'id' => 831,
                'state_id' => 48,
                'name_ar' => ' كورنيش البحيرة  ',
                'name_en' => ' Buhaira Corniche  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            331 => 
            array (
                'id' => 832,
                'state_id' => 48,
                'name_ar' => ' المدينة الجامعية  ',
                'name_en' => ' University City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            332 => 
            array (
                'id' => 833,
                'state_id' => 48,
                'name_ar' => ' النباعة  ',
                'name_en' => ' Al Nabba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            333 => 
            array (
                'id' => 834,
                'state_id' => 48,
                'name_ar' => ' سمنان  ',
                'name_en' => ' Samnan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            334 => 
            array (
                'id' => 835,
                'state_id' => 48,
                'name_ar' => ' الخان  ',
                'name_en' => ' Al Khan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            335 => 
            array (
                'id' => 836,
                'state_id' => 48,
                'name_ar' => ' أبو شغارة  ',
                'name_en' => ' Abu Shagara  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            336 => 
            array (
                'id' => 837,
                'state_id' => 48,
                'name_ar' => ' ميسلون  ',
                'name_en' => ' Maysaloon  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            337 => 
            array (
                'id' => 838,
                'state_id' => 48,
                'name_ar' => ' المجاز  ',
                'name_en' => ' Al Majaz  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            338 => 
            array (
                'id' => 839,
                'state_id' => 48,
                'name_ar' => ' اللية  ',
                'name_en' => ' Al Layyeh  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            339 => 
            array (
                'id' => 840,
                'state_id' => 48,
                'name_ar' => ' التعاون  ',
                'name_en' => ' Al Taawun  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            340 => 
            array (
                'id' => 841,
                'state_id' => 48,
                'name_ar' => ' اليرموك  ',
                'name_en' => ' Al Yarmook  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            341 => 
            array (
                'id' => 842,
                'state_id' => 48,
                'name_ar' => ' القصباء  ',
                'name_en' => ' Al Qasba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            342 => 
            array (
                'id' => 843,
                'state_id' => 48,
                'name_ar' => ' مويلح  ',
                'name_en' => ' Muwailih  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            343 => 
            array (
                'id' => 844,
                'state_id' => 48,
                'name_ar' => ' القرائن  ',
                'name_en' => ' Al Qarayin  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            344 => 
            array (
                'id' => 845,
                'state_id' => 48,
                'name_ar' => ' الناصرية  ',
                'name_en' => ' Al Nasseriya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            345 => 
            array (
                'id' => 846,
                'state_id' => 49,
                'name_ar' => ' التلة 2  ',
                'name_en' => ' Al Tallah 2  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            346 => 
            array (
                'id' => 847,
                'state_id' => 49,
                'name_ar' => ' المنطقة الصناعية  ',
                'name_en' => ' Industrial Area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            347 => 
            array (
                'id' => 848,
                'state_id' => 49,
                'name_ar' => ' البستان  ',
                'name_en' => ' Al Bustan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            348 => 
            array (
                'id' => 849,
                'state_id' => 49,
                'name_ar' => ' البطين  ',
                'name_en' => ' Al Butain  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            349 => 
            array (
                'id' => 850,
                'state_id' => 49,
                'name_ar' => ' المويهات  ',
                'name_en' => ' Al Mowaihat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            350 => 
            array (
                'id' => 851,
                'state_id' => 49,
                'name_ar' => ' النخيل  ',
                'name_en' => ' Al Nakhil  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            351 => 
            array (
                'id' => 852,
                'state_id' => 49,
                'name_ar' => ' الراشدية  ',
                'name_en' => ' Al Rashidya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            352 => 
            array (
                'id' => 853,
                'state_id' => 49,
                'name_ar' => ' الرميلة  ',
                'name_en' => ' Al Rumailah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            353 => 
            array (
                'id' => 854,
                'state_id' => 49,
                'name_ar' => ' جزيرة صافية  ',
                'name_en' => ' Safia Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            354 => 
            array (
                'id' => 855,
                'state_id' => 49,
                'name_ar' => ' الشيخ خليفة بن زايد  ',
                'name_en' => ' Sheikh Khalifa Bin Zayed  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            355 => 
            array (
                'id' => 856,
                'state_id' => 49,
                'name_ar' => ' الجرف  ',
                'name_en' => ' Al Jurf  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            356 => 
            array (
                'id' => 857,
                'state_id' => 49,
                'name_ar' => ' الأوان  ',
                'name_en' => ' Al Owan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            357 => 
            array (
                'id' => 858,
                'state_id' => 49,
                'name_ar' => ' الحليو  ',
                'name_en' => ' Al Heliow  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            358 => 
            array (
                'id' => 859,
                'state_id' => 49,
                'name_ar' => ' الزهراء  ',
                'name_en' => ' Al Zahra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            359 => 
            array (
                'id' => 860,
                'state_id' => 49,
                'name_ar' => ' الصوان  ',
                'name_en' => ' Al Sawan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            360 => 
            array (
                'id' => 861,
                'state_id' => 49,
                'name_ar' => ' مشيرف  ',
                'name_en' => ' Mushairef  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            361 => 
            array (
                'id' => 862,
                'state_id' => 49,
                'name_ar' => ' الحميدية  ',
                'name_en' => ' Al Hamidiya  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            362 => 
            array (
                'id' => 863,
                'state_id' => 50,
                'name_ar' => ' المعترض  ',
                'name_en' => ' Al Mu tarid  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            363 => 
            array (
                'id' => 864,
                'state_id' => 50,
                'name_ar' => ' منطقة كويتات  ',
                'name_en' => ' Al Kwitat Area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            364 => 
            array (
                'id' => 865,
                'state_id' => 50,
                'name_ar' => ' دوار توام  ',
                'name_en' => ' Dowar Tawaam   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            365 => 
            array (
                'id' => 866,
                'state_id' => 50,
                'name_ar' => ' الخبيصي  ',
                'name_en' => ' Al Khibeesi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            366 => 
            array (
                'id' => 867,
                'state_id' => 50,
                'name_ar' => ' العين  ',
                'name_en' => ' Al Ain  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            367 => 
            array (
                'id' => 868,
                'state_id' => 50,
                'name_ar' => ' بو كرية  ',
                'name_en' => ' Bu Kirayyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            368 => 
            array (
                'id' => 869,
                'state_id' => 50,
                'name_ar' => ' العقابية  ',
                'name_en' => ' Al Akabeyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            369 => 
            array (
                'id' => 870,
                'state_id' => 50,
                'name_ar' => ' البطين  ',
                'name_en' => ' Al Bateen  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            370 => 
            array (
                'id' => 871,
                'state_id' => 50,
                'name_ar' => ' زاخر  ',
                'name_en' => ' Zakhir  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            371 => 
            array (
                'id' => 872,
                'state_id' => 50,
                'name_ar' => ' جبل الحفيت  ',
                'name_en' => ' Jebel Hafeet  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            372 => 
            array (
                'id' => 873,
                'state_id' => 50,
                'name_ar' => ' السلامات  ',
                'name_en' => ' Al Salamat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            373 => 
            array (
                'id' => 874,
                'state_id' => 50,
                'name_ar' => ' الطوية  ',
                'name_en' => ' Al Tawila  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            374 => 
            array (
                'id' => 875,
                'state_id' => 50,
                'name_ar' => ' الصناعية  ',
                'name_en' => ' Industrial Area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            375 => 
            array (
                'id' => 876,
                'state_id' => 50,
                'name_ar' => ' هيلي  ',
                'name_en' => ' Al Hili  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            376 => 
            array (
                'id' => 877,
                'state_id' => 50,
                'name_ar' => ' الجيمي  ',
                'name_en' => ' Al Jimi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            377 => 
            array (
                'id' => 878,
                'state_id' => 50,
                'name_ar' => ' ابو سمرة  ',
                'name_en' => ' Abou Samra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            378 => 
            array (
                'id' => 879,
                'state_id' => 50,
                'name_ar' => ' ابو حريبة  ',
                'name_en' => ' Abou Hariba  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            379 => 
            array (
                'id' => 880,
                'state_id' => 50,
                'name_ar' => ' المطاوعة  ',
                'name_en' => ' Al Mutawaea  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            380 => 
            array (
                'id' => 881,
                'state_id' => 50,
                'name_ar' => ' المويجي  ',
                'name_en' => ' Al Muiji  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            381 => 
            array (
                'id' => 882,
                'state_id' => 50,
                'name_ar' => ' الخزنة  ',
                'name_en' => ' Al khazina  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            382 => 
            array (
                'id' => 883,
                'state_id' => 50,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Ruwda  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            383 => 
            array (
                'id' => 884,
                'state_id' => 50,
                'name_ar' => ' غافات النيار  ',
                'name_en' => ' Ghafat Alniyar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            384 => 
            array (
                'id' => 885,
                'state_id' => 50,
                'name_ar' => ' القرية  ',
                'name_en' => ' Alqaryah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            385 => 
            array (
                'id' => 886,
                'state_id' => 50,
                'name_ar' => ' الفوعة  ',
                'name_en' => ' Al Fou ah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            386 => 
            array (
                'id' => 887,
                'state_id' => 50,
                'name_ar' => ' الوقن  ',
                'name_en' => ' Al Wiqan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            387 => 
            array (
                'id' => 888,
                'state_id' => 50,
                'name_ar' => ' رماح  ',
                'name_en' => ' Rimah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            388 => 
            array (
                'id' => 889,
                'state_id' => 50,
                'name_ar' => ' المقام  ',
                'name_en' => ' Al Makaam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            389 => 
            array (
                'id' => 890,
                'state_id' => 50,
                'name_ar' => ' المسعودي  ',
                'name_en' => ' Al Mas oud  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            390 => 
            array (
                'id' => 891,
                'state_id' => 50,
                'name_ar' => ' القطارة  ',
                'name_en' => ' Al Qattarah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            391 => 
            array (
                'id' => 892,
                'state_id' => 50,
                'name_ar' => ' ام الزمول  ',
                'name_en' => ' Um Al Zamool  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            392 => 
            array (
                'id' => 893,
                'state_id' => 50,
                'name_ar' => ' الظاهرة  ',
                'name_en' => ' Al Thahera  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            393 => 
            array (
                'id' => 894,
                'state_id' => 50,
                'name_ar' => ' فلج هزاع  ',
                'name_en' => ' Falaj Hazzaa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            394 => 
            array (
                'id' => 895,
                'state_id' => 50,
                'name_ar' => ' الهير  ',
                'name_en' => ' Al Hiyar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            395 => 
            array (
                'id' => 896,
                'state_id' => 50,
                'name_ar' => ' القوع  ',
                'name_en' => ' Al Qou a  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            396 => 
            array (
                'id' => 897,
                'state_id' => 50,
                'name_ar' => ' ناهل  ',
                'name_en' => ' Nahil  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            397 => 
            array (
                'id' => 898,
                'state_id' => 50,
                'name_ar' => ' الشويب  ',
                'name_en' => ' Al Showayeb  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            398 => 
            array (
                'id' => 899,
                'state_id' => 50,
                'name_ar' => ' أم غافة  ',
                'name_en' => ' Um Ghafah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            399 => 
            array (
                'id' => 900,
                'state_id' => 51,
                'name_ar' => ' كورنيش القواسم  ',
                'name_en' => ' Corniche Al Qawasim  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            400 => 
            array (
                'id' => 901,
                'state_id' => 51,
                'name_ar' => ' سدروه  ',
                'name_en' => ' Sidroh  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            401 => 
            array (
                'id' => 902,
                'state_id' => 51,
                'name_ar' => ' شمس  ',
                'name_en' => ' Shams  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            402 => 
            array (
                'id' => 903,
                'state_id' => 51,
                'name_ar' => ' مدينة رأس الخيمة  ',
                'name_en' => ' RAK City  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            403 => 
            array (
                'id' => 904,
                'state_id' => 51,
                'name_ar' => ' ميناء العرب  ',
                'name_en' => ' Mina Al Arab  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            404 => 
            array (
                'id' => 905,
                'state_id' => 51,
                'name_ar' => ' خزام  ',
                'name_en' => ' Khuzam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            405 => 
            array (
                'id' => 906,
                'state_id' => 51,
                'name_ar' => ' غليلة  ',
                'name_en' => ' Ghalilah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            406 => 
            array (
                'id' => 907,
                'state_id' => 51,
                'name_ar' => ' باب البحر  ',
                'name_en' => ' Bab Al Bahr  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            407 => 
            array (
                'id' => 908,
                'state_id' => 51,
                'name_ar' => ' الرمس  ',
                'name_en' => ' Al Rams  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            408 => 
            array (
                'id' => 909,
                'state_id' => 51,
                'name_ar' => ' العريبي  ',
                'name_en' => ' Al Uraibi  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            409 => 
            array (
                'id' => 910,
                'state_id' => 51,
                'name_ar' => ' المطاف  ',
                'name_en' => ' Al Mataf  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            410 => 
            array (
                'id' => 911,
                'state_id' => 51,
                'name_ar' => ' جزيرة المرجان  ',
                'name_en' => ' Al Marjan Island  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            411 => 
            array (
                'id' => 912,
                'state_id' => 51,
                'name_ar' => ' الظيت  ',
                'name_en' => ' Al Dhaith North  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            412 => 
            array (
                'id' => 913,
                'state_id' => 51,
                'name_ar' => ' الظيت الجنوبي  ',
                'name_en' => ' Al Dhaith South  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            413 => 
            array (
                'id' => 914,
                'state_id' => 51,
                'name_ar' => ' الغب  ',
                'name_en' => ' Al Ghubb  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            414 => 
            array (
                'id' => 915,
                'state_id' => 51,
                'name_ar' => ' الحمرة  ',
                'name_en' => ' Al Hamra  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            415 => 
            array (
                'id' => 916,
                'state_id' => 51,
                'name_ar' => ' المعمورة  ',
                'name_en' => ' Al Mamourah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            416 => 
            array (
                'id' => 917,
                'state_id' => 51,
                'name_ar' => ' الندية  ',
                'name_en' => ' Al Nadiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            417 => 
            array (
                'id' => 918,
                'state_id' => 51,
                'name_ar' => ' النخيل  ',
                'name_en' => ' Al Nakheel  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            418 => 
            array (
                'id' => 919,
                'state_id' => 51,
                'name_ar' => ' الجويس  ',
                'name_en' => ' Al Juwais  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            419 => 
            array (
                'id' => 920,
                'state_id' => 51,
                'name_ar' => ' الخران  ',
                'name_en' => ' Al Kharran  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            420 => 
            array (
                'id' => 921,
                'state_id' => 51,
                'name_ar' => ' القير  ',
                'name_en' => ' Al Qir  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            421 => 
            array (
                'id' => 922,
                'state_id' => 51,
                'name_ar' => ' القرم  ',
                'name_en' => ' Al Qurm  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            422 => 
            array (
                'id' => 923,
                'state_id' => 51,
                'name_ar' => ' القسيدات  ',
                'name_en' => ' Al Qusaidat  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            423 => 
            array (
                'id' => 924,
                'state_id' => 51,
                'name_ar' => ' السير  ',
                'name_en' => ' Al Seer  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            424 => 
            array (
                'id' => 925,
                'state_id' => 51,
                'name_ar' => ' الترفة  ',
                'name_en' => ' Al Turfa  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            425 => 
            array (
                'id' => 926,
                'state_id' => 51,
                'name_ar' => ' دفن الخور  ',
                'name_en' => ' Dafan Al Khor  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            426 => 
            array (
                'id' => 927,
                'state_id' => 51,
                'name_ar' => ' دهن  ',
                'name_en' => ' Dahan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            427 => 
            array (
                'id' => 928,
                'state_id' => 51,
                'name_ar' => ' الشرشاره  ',
                'name_en' => ' Al Sharisharah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            428 => 
            array (
                'id' => 929,
                'state_id' => 51,
                'name_ar' => ' المعارض  ',
                'name_en' => ' Al Maarid  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            429 => 
            array (
                'id' => 930,
                'state_id' => 51,
                'name_ar' => ' الدعيش  ',
                'name_en' => ' Al Duhaish  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            430 => 
            array (
                'id' => 931,
                'state_id' => 51,
                'name_ar' => ' سيح الحضيبة  ',
                'name_en' => ' Seih Al Hudaibah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            431 => 
            array (
                'id' => 932,
                'state_id' => 51,
                'name_ar' => ' شماال جلفار  ',
                'name_en' => ' Shamal Julphar  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            432 => 
            array (
                'id' => 933,
                'state_id' => 51,
                'name_ar' => ' الفصلين  ',
                'name_en' => ' Al Faslayn  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            433 => 
            array (
                'id' => 934,
                'state_id' => 51,
                'name_ar' => ' الدربيجانية  ',
                'name_en' => ' Al Darbijaniyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            434 => 
            array (
                'id' => 935,
                'state_id' => 51,
                'name_ar' => ' الندود  ',
                'name_en' => ' Al Nudood  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            435 => 
            array (
                'id' => 936,
                'state_id' => 51,
                'name_ar' => ' خزام  ',
                'name_en' => ' Khozam  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            436 => 
            array (
                'id' => 937,
                'state_id' => 52,
                'name_ar' => ' الأحد  ',
                'name_en' => ' Al Aahad  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            437 => 
            array (
                'id' => 938,
                'state_id' => 52,
                'name_ar' => ' الدار البيضاء  ',
                'name_en' => ' Al Dar Al Baida  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            438 => 
            array (
                'id' => 939,
                'state_id' => 52,
                'name_ar' => ' الحديثة  ',
                'name_en' => ' Al Haditha  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            439 => 
            array (
                'id' => 940,
                'state_id' => 52,
                'name_ar' => ' الحمرة  ',
                'name_en' => ' Al Humrah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            440 => 
            array (
                'id' => 941,
                'state_id' => 52,
                'name_ar' => ' الخور  ',
                'name_en' => ' Al Khor  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            441 => 
            array (
                'id' => 942,
                'state_id' => 52,
                'name_ar' => ' الميدان  ',
                'name_en' => ' Al Maidan  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            442 => 
            array (
                'id' => 943,
                'state_id' => 52,
                'name_ar' => ' الراس  ',
                'name_en' => ' Al Raas  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            443 => 
            array (
                'id' => 944,
                'state_id' => 52,
                'name_ar' => ' الرملة  ',
                'name_en' => ' Al Ramlah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            444 => 
            array (
                'id' => 945,
                'state_id' => 52,
                'name_ar' => ' الروضة  ',
                'name_en' => ' Al Raudah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            445 => 
            array (
                'id' => 946,
                'state_id' => 52,
                'name_ar' => ' الرقة  ',
                'name_en' => ' Al Riqqah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            446 => 
            array (
                'id' => 947,
                'state_id' => 52,
                'name_ar' => ' السلامة  ',
                'name_en' => ' Al Salamah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            447 => 
            array (
                'id' => 948,
                'state_id' => 52,
                'name_ar' => ' مخيم الدفاع  ',
                'name_en' => ' Defence Camp  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            448 => 
            array (
                'id' => 949,
                'state_id' => 52,
                'name_ar' => ' مسجد المزروئي  ',
                'name_en' => ' Masjid Al Mazroui  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            449 => 
            array (
                'id' => 950,
                'state_id' => 52,
                'name_ar' => ' المدينة القديمة  ',
                'name_en' => ' Old Town Area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            450 => 
            array (
                'id' => 951,
                'state_id' => 52,
                'name_ar' => ' الهوية  ',
                'name_en' => ' Al Hawiyah  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            451 => 
            array (
                'id' => 952,
                'state_id' => 52,
                'name_ar' => ' المنطقة الصناعية  ',
                'name_en' => ' Industrial Area  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            452 => 
            array (
                'id' => 953,
                'state_id' => 3,
                'name_ar' => ' محطة الرمل   ',
                'name_en' => ' Mahatet El-Raml   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            453 => 
            array (
                'id' => 954,
                'state_id' => 3,
                'name_ar' => ' رشدي   ',
                'name_en' => ' Roshdy   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            454 => 
            array (
                'id' => 955,
                'state_id' => 3,
                'name_ar' => ' سموحة   ',
                'name_en' => ' Smouha   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            455 => 
            array (
                'id' => 956,
                'state_id' => 3,
                'name_ar' => ' سبورتينج   ',
                'name_en' => ' Sporting   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            456 => 
            array (
                'id' => 957,
                'state_id' => 3,
                'name_ar' => ' سيدي جابر   ',
                'name_en' => ' Sidy Gaber   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            457 => 
            array (
                'id' => 958,
                'state_id' => 3,
                'name_ar' => ' لوران   ',
                'name_en' => ' Loran   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            458 => 
            array (
                'id' => 959,
                'state_id' => 3,
                'name_ar' => ' كامب شيزار   ',
                'name_en' => ' Camp Caesar   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            459 => 
            array (
                'id' => 960,
                'state_id' => 3,
                'name_ar' => ' الإبراهيمية   ',
                'name_en' => ' El-Ibrahimia   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            460 => 
            array (
                'id' => 961,
                'state_id' => 3,
                'name_ar' => ' جانكليس   ',
                'name_en' => ' Janaklees   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            461 => 
            array (
                'id' => 962,
                'state_id' => 3,
                'name_ar' => ' ابو قير   ',
                'name_en' => ' Abou Keir   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            462 => 
            array (
                'id' => 963,
                'state_id' => 3,
                'name_ar' => ' الأزاريطه   ',
                'name_en' => ' El-Azarita   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            463 => 
            array (
                'id' => 964,
                'state_id' => 3,
                'name_ar' => ' السيوف   ',
                'name_en' => ' El-Seyouf   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            464 => 
            array (
                'id' => 965,
                'state_id' => 3,
                'name_ar' => ' الشاطبي   ',
                'name_en' => ' El-Shatby   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            465 => 
            array (
                'id' => 966,
                'state_id' => 3,
                'name_ar' => ' العامرية   ',
                'name_en' => ' El-Amreya   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            466 => 
            array (
                'id' => 967,
                'state_id' => 3,
                'name_ar' => ' العجمي   ',
                'name_en' => ' El-Agamy   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            467 => 
            array (
                'id' => 968,
                'state_id' => 3,
                'name_ar' => ' العصافرة   ',
                'name_en' => ' El-Asafra   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            468 => 
            array (
                'id' => 969,
                'state_id' => 3,
                'name_ar' => ' المنتزه   ',
                'name_en' => ' El-Montazah   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            469 => 
            array (
                'id' => 970,
                'state_id' => 3,
                'name_ar' => ' المندرة   ',
                'name_en' => ' El-Mandara   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            470 => 
            array (
                'id' => 971,
                'state_id' => 3,
                'name_ar' => ' المنشية   ',
                'name_en' => ' El-Mansheyah   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            471 => 
            array (
                'id' => 972,
                'state_id' => 3,
                'name_ar' => ' الورديان   ',
                'name_en' => ' El-Werdeyan   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            472 => 
            array (
                'id' => 973,
                'state_id' => 3,
                'name_ar' => ' باكوس   ',
                'name_en' => ' Bakos   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            473 => 
            array (
                'id' => 974,
                'state_id' => 3,
                'name_ar' => ' بحري   ',
                'name_en' => ' Bahary   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            474 => 
            array (
                'id' => 975,
                'state_id' => 3,
                'name_ar' => ' بولكلي   ',
                'name_en' => ' Bulkly   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            475 => 
            array (
                'id' => 976,
                'state_id' => 3,
                'name_ar' => ' جليم   ',
                'name_en' => ' Glym   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            476 => 
            array (
                'id' => 977,
                'state_id' => 3,
                'name_ar' => ' زيزينيا   ',
                'name_en' => ' Zizenia   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            477 => 
            array (
                'id' => 978,
                'state_id' => 3,
                'name_ar' => ' سابا باشا   ',
                'name_en' => ' Saba Basha   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            478 => 
            array (
                'id' => 979,
                'state_id' => 3,
                'name_ar' => ' سان ستيفانو   ',
                'name_en' => ' San Stefano   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            479 => 
            array (
                'id' => 980,
                'state_id' => 3,
                'name_ar' => ' ستانلي   ',
                'name_en' => ' Stanley   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            480 => 
            array (
                'id' => 981,
                'state_id' => 3,
                'name_ar' => ' سيدي بشر   ',
                'name_en' => ' Sidy Bishr   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            481 => 
            array (
                'id' => 982,
                'state_id' => 3,
                'name_ar' => ' شارع فؤاد   ',
                'name_en' => ' Fouad Street   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            482 => 
            array (
                'id' => 983,
                'state_id' => 3,
                'name_ar' => ' فلمنج   ',
                'name_en' => ' Fleming   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            483 => 
            array (
                'id' => 984,
                'state_id' => 3,
                'name_ar' => ' فيكتوريا   ',
                'name_en' => ' Victoria   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            484 => 
            array (
                'id' => 985,
                'state_id' => 3,
                'name_ar' => ' كفر عبده   ',
                'name_en' => ' Kafr Abdouh   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            485 => 
            array (
                'id' => 986,
                'state_id' => 3,
                'name_ar' => ' كليوباترا   ',
                'name_en' => ' Cleopatra   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            486 => 
            array (
                'id' => 987,
                'state_id' => 3,
                'name_ar' => ' كينج ماريوط   ',
                'name_en' => ' King Mariout   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            487 => 
            array (
                'id' => 988,
                'state_id' => 3,
                'name_ar' => ' محرم بيك   ',
                'name_en' => ' Moharam Bek   ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            488 => 
            array (
                'id' => 989,
                'state_id' => 3,
                'name_ar' => ' مصطفى كامل   ',
                'name_en' => ' Moustafa Kamel    ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            489 => 
            array (
                'id' => 990,
                'state_id' => 3,
                'name_ar' => ' ميامي   ',
                'name_en' => ' Miamy  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            490 => 
            array (
                'id' => 991,
                'state_id' => 3,
                'name_ar' => ' برج العرب  ',
                'name_en' => ' Burg Al Arab  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            491 => 
            array (
                'id' => 992,
                'state_id' => 53,
                'name_ar' => 'Los Angeles ',
                'name_en' => 'Los Angeles ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            492 => 
            array (
                'id' => 993,
                'state_id' => 53,
                'name_ar' => 'San Diego ',
                'name_en' => 'San Diego ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            493 => 
            array (
                'id' => 994,
                'state_id' => 53,
                'name_ar' => 'San Jose ',
                'name_en' => 'San Jose ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            494 => 
            array (
                'id' => 995,
                'state_id' => 53,
                'name_ar' => 'San Francisco ',
                'name_en' => 'San Francisco ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            495 => 
            array (
                'id' => 996,
                'state_id' => 53,
                'name_ar' => 'Fresno ',
                'name_en' => 'Fresno ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            496 => 
            array (
                'id' => 997,
                'state_id' => 53,
                'name_ar' => 'Sacramento ',
                'name_en' => 'Sacramento ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            497 => 
            array (
                'id' => 998,
                'state_id' => 53,
                'name_ar' => 'Long Beach ',
                'name_en' => 'Long Beach ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            498 => 
            array (
                'id' => 999,
                'state_id' => 53,
                'name_ar' => 'Oakland ',
                'name_en' => 'Oakland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            499 => 
            array (
                'id' => 1000,
                'state_id' => 53,
                'name_ar' => 'Bakersfield ',
                'name_en' => 'Bakersfield ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1001,
                'state_id' => 53,
                'name_ar' => 'Anaheim ',
                'name_en' => 'Anaheim ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 1002,
                'state_id' => 53,
                'name_ar' => 'California-Others ',
                'name_en' => 'California-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 1003,
                'state_id' => 54,
                'name_ar' => 'Houston ',
                'name_en' => 'Houston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 1004,
                'state_id' => 54,
                'name_ar' => 'San Antonio ',
                'name_en' => 'San Antonio ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 1005,
                'state_id' => 54,
                'name_ar' => 'Dallas ',
                'name_en' => 'Dallas ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 1006,
                'state_id' => 54,
                'name_ar' => 'Austin ',
                'name_en' => 'Austin ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 1007,
                'state_id' => 54,
                'name_ar' => 'Fort Worth ',
                'name_en' => 'Fort Worth ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 1008,
                'state_id' => 54,
                'name_ar' => 'El Paso ',
                'name_en' => 'El Paso ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 1009,
                'state_id' => 54,
                'name_ar' => 'Arlington ',
                'name_en' => 'Arlington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 1010,
                'state_id' => 54,
                'name_ar' => 'Corpus Christi ',
                'name_en' => 'Corpus Christi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 1011,
                'state_id' => 54,
                'name_ar' => 'Plano ',
                'name_en' => 'Plano ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 1012,
                'state_id' => 54,
                'name_ar' => 'Laredo ',
                'name_en' => 'Laredo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 1013,
                'state_id' => 54,
                'name_ar' => 'Texas-Others ',
                'name_en' => 'Texas-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 1014,
                'state_id' => 55,
                'name_ar' => 'Jacksonville ',
                'name_en' => 'Jacksonville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 1015,
                'state_id' => 55,
                'name_ar' => 'Miami ',
                'name_en' => 'Miami ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 1016,
                'state_id' => 55,
                'name_ar' => 'Tampa ',
                'name_en' => 'Tampa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 1017,
                'state_id' => 55,
                'name_ar' => 'Orlando ',
                'name_en' => 'Orlando ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 1018,
                'state_id' => 55,
                'name_ar' => 'St. Petersburg ',
                'name_en' => 'St. Petersburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 1019,
                'state_id' => 55,
                'name_ar' => 'Hialeah ',
                'name_en' => 'Hialeah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 1020,
                'state_id' => 55,
                'name_ar' => 'Port St. Lucie ',
                'name_en' => 'Port St. Lucie ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 1021,
                'state_id' => 55,
                'name_ar' => 'Tallahassee ',
                'name_en' => 'Tallahassee ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 1022,
                'state_id' => 55,
                'name_ar' => 'Cape Coral ',
                'name_en' => 'Cape Coral ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 1023,
                'state_id' => 55,
                'name_ar' => 'Ft. Lauderdale ',
                'name_en' => 'Ft. Lauderdale ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 1024,
                'state_id' => 55,
                'name_ar' => 'Florida-Others ',
                'name_en' => 'Florida-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 1025,
                'state_id' => 56,
                'name_ar' => 'New York City ',
                'name_en' => 'New Yrk City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 1026,
                'state_id' => 56,
                'name_ar' => 'Buffalo ',
                'name_en' => 'Buffalo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 1027,
                'state_id' => 56,
                'name_ar' => 'Rochester ',
                'name_en' => 'Rochester ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 1028,
                'state_id' => 56,
                'name_ar' => 'Yonkers ',
                'name_en' => 'Yonkers ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 1029,
                'state_id' => 56,
                'name_ar' => 'Syracuse ',
                'name_en' => 'Syracuse ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 1030,
                'state_id' => 56,
                'name_ar' => 'Albany ',
                'name_en' => 'Albany ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 1031,
                'state_id' => 56,
                'name_ar' => 'New Rochelle ',
                'name_en' => 'New Rochelle ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 1032,
                'state_id' => 56,
                'name_ar' => 'Mount Vernon ',
                'name_en' => 'Mount Vernon ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 1033,
                'state_id' => 56,
                'name_ar' => 'Schenectady ',
                'name_en' => 'Schenectady ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 1034,
                'state_id' => 56,
                'name_ar' => 'Utica ',
                'name_en' => 'Utica ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 1035,
                'state_id' => 56,
                'name_ar' => 'New York-Others ',
                'name_en' => 'New York-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 1036,
                'state_id' => 57,
                'name_ar' => 'Philadelphia ',
                'name_en' => 'Philadelphia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 1037,
                'state_id' => 57,
                'name_ar' => 'Pittsburgh ',
                'name_en' => 'Pittsburgh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 1038,
                'state_id' => 57,
                'name_ar' => 'Allentown ',
                'name_en' => 'Allentown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 1039,
                'state_id' => 57,
                'name_ar' => 'Erie ',
                'name_en' => 'Erie ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 1040,
                'state_id' => 57,
                'name_ar' => 'Reading ',
                'name_en' => 'Reading ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 1041,
                'state_id' => 57,
                'name_ar' => 'Scranton ',
                'name_en' => 'Scranton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 1042,
                'state_id' => 57,
                'name_ar' => 'Bethlehem ',
                'name_en' => 'Bethlehem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 1043,
                'state_id' => 57,
                'name_ar' => 'Lancaster ',
                'name_en' => 'Lancaster ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 1044,
                'state_id' => 57,
                'name_ar' => 'Harrisburg ',
                'name_en' => 'Harrisburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 1045,
                'state_id' => 57,
                'name_ar' => 'York ',
                'name_en' => 'York ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 1046,
                'state_id' => 57,
                'name_ar' => ' Pennsylvania-Others ',
                'name_en' => ' Pennsylvania-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 1047,
                'state_id' => 58,
                'name_ar' => 'Chicago ',
                'name_en' => 'Chicago ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 1048,
                'state_id' => 58,
                'name_ar' => 'Aurora ',
                'name_en' => 'Aurora ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 1049,
                'state_id' => 58,
                'name_ar' => 'Naperville ',
                'name_en' => 'Naperville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 1050,
                'state_id' => 58,
                'name_ar' => 'Joliet ',
                'name_en' => 'Joliet ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 1051,
                'state_id' => 58,
                'name_ar' => 'Rockford ',
                'name_en' => 'Rockford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 1052,
                'state_id' => 58,
                'name_ar' => 'Springfield ',
                'name_en' => 'Springfield ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 1053,
                'state_id' => 58,
                'name_ar' => 'Elgin ',
                'name_en' => 'Elgin ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 1054,
                'state_id' => 58,
                'name_ar' => 'Peoria ',
                'name_en' => 'Peoria ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 1055,
                'state_id' => 58,
                'name_ar' => 'Champaign ',
                'name_en' => 'Champaign ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 1056,
                'state_id' => 58,
                'name_ar' => 'Waukegan ',
                'name_en' => 'Waukegan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 1057,
                'state_id' => 58,
                'name_ar' => 'Illinois-Others ',
                'name_en' => 'Illinois-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 1058,
                'state_id' => 59,
                'name_ar' => 'Columbus ',
                'name_en' => 'Columbus ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 1059,
                'state_id' => 59,
                'name_ar' => 'Cleveland ',
                'name_en' => 'Cleveland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 1060,
                'state_id' => 59,
                'name_ar' => 'Cincinnati ',
                'name_en' => 'Cincinnati ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 1061,
                'state_id' => 59,
                'name_ar' => 'Toledo ',
                'name_en' => 'Toledo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 1062,
                'state_id' => 59,
                'name_ar' => 'Akron ',
                'name_en' => 'Akron ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 1063,
                'state_id' => 59,
                'name_ar' => 'Dayton ',
                'name_en' => 'Dayton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 1064,
                'state_id' => 59,
                'name_ar' => 'Parma ',
                'name_en' => 'Parma ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 1065,
                'state_id' => 59,
                'name_ar' => 'Canton ',
                'name_en' => 'Canton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 1066,
                'state_id' => 59,
                'name_ar' => 'Youngstown ',
                'name_en' => 'Youngstown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 1067,
                'state_id' => 59,
                'name_ar' => 'Lorain ',
                'name_en' => 'Lorain ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 1068,
                'state_id' => 59,
                'name_ar' => 'Ohio-Others ',
                'name_en' => 'Ohio-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 1069,
                'state_id' => 60,
                'name_ar' => 'Atlanta ',
                'name_en' => 'Atlanta ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 1070,
                'state_id' => 60,
                'name_ar' => 'Augusta ',
                'name_en' => 'Augusta ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 1071,
                'state_id' => 60,
                'name_ar' => 'Columbus ',
                'name_en' => 'Columbus ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 1072,
                'state_id' => 60,
                'name_ar' => 'Macon ',
                'name_en' => 'Macon ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 1073,
                'state_id' => 60,
                'name_ar' => 'Savannah ',
                'name_en' => 'Savannah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 1074,
                'state_id' => 60,
                'name_ar' => 'Athens ',
                'name_en' => 'Athens ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 1075,
                'state_id' => 60,
                'name_ar' => 'Sandy Springs ',
                'name_en' => 'Sandy Springs ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 1076,
                'state_id' => 60,
                'name_ar' => 'Roswell ',
                'name_en' => 'Roswell ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 1077,
                'state_id' => 60,
                'name_ar' => 'Johns Creek ',
                'name_en' => 'Johns Creek ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 1078,
                'state_id' => 60,
                'name_ar' => 'Warner Robins ',
                'name_en' => 'Warner Robins ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 1079,
                'state_id' => 60,
                'name_ar' => 'Georgia-Others ',
                'name_en' => 'Georgia-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 1080,
                'state_id' => 61,
                'name_ar' => 'Charlotte ',
                'name_en' => 'Charlotte ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 1081,
                'state_id' => 61,
                'name_ar' => 'Raleigh ',
                'name_en' => 'Raleigh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 1082,
                'state_id' => 61,
                'name_ar' => 'Greensboro ',
                'name_en' => 'Greensboro ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 1083,
                'state_id' => 61,
                'name_ar' => 'Durham ',
                'name_en' => 'Durham ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 1084,
                'state_id' => 61,
                'name_ar' => 'Winston-Salem ',
                'name_en' => 'Winston-Salem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 1085,
                'state_id' => 61,
                'name_ar' => 'Fayetteville ',
                'name_en' => 'Fayetteville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 1086,
                'state_id' => 61,
                'name_ar' => 'Cary ',
                'name_en' => 'Cary ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 1087,
                'state_id' => 61,
                'name_ar' => 'Wilmington ',
                'name_en' => 'Wilmington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 1088,
                'state_id' => 61,
                'name_ar' => 'High Point ',
                'name_en' => 'High Point ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 1089,
                'state_id' => 61,
                'name_ar' => 'Concord ',
                'name_en' => 'Concord ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 1090,
                'state_id' => 61,
                'name_ar' => 'North Carolina-Others ',
                'name_en' => 'North Carolina-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 1091,
                'state_id' => 62,
                'name_ar' => 'Detroit ',
                'name_en' => 'Detroit ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 1092,
                'state_id' => 62,
                'name_ar' => 'Grand Rapids ',
                'name_en' => 'Grand Rapids ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 1093,
                'state_id' => 62,
                'name_ar' => 'Warren ',
                'name_en' => 'Warren ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 1094,
                'state_id' => 62,
                'name_ar' => 'Sterling Heights ',
                'name_en' => 'Sterling Heights ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 1095,
                'state_id' => 62,
                'name_ar' => 'Ann Arbor ',
                'name_en' => 'Ann Arbor ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 1096,
                'state_id' => 62,
                'name_ar' => 'Lansing ',
                'name_en' => 'Lansing ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 1097,
                'state_id' => 62,
                'name_ar' => 'Clinton Twonship ',
                'name_en' => 'Clinton Twonship ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 1098,
                'state_id' => 62,
                'name_ar' => 'Flint ',
                'name_en' => 'Flint ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 1099,
                'state_id' => 62,
                'name_ar' => 'Dearborn ',
                'name_en' => 'Dearborn ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 1100,
                'state_id' => 62,
                'name_ar' => 'Livonia ',
                'name_en' => 'Livonia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 1101,
                'state_id' => 62,
                'name_ar' => 'Canton Twonship ',
                'name_en' => 'Canton Twonship ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 1102,
                'state_id' => 62,
                'name_ar' => 'Macomb Twonship ',
                'name_en' => 'Macomb Twonship ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 1103,
                'state_id' => 62,
                'name_ar' => 'Troy ',
                'name_en' => 'Troy ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 1104,
                'state_id' => 62,
                'name_ar' => 'Westland ',
                'name_en' => 'Westland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 1105,
                'state_id' => 62,
                'name_ar' => 'Farmington Hills ',
                'name_en' => 'Farmington Hills ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 1106,
                'state_id' => 62,
                'name_ar' => 'Michigan-Others ',
                'name_en' => 'Michigan-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 1107,
                'state_id' => 63,
                'name_ar' => 'Galloway Township ',
                'name_en' => 'Galloway Township ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 1108,
                'state_id' => 63,
                'name_ar' => 'Hamilton Twonship ',
                'name_en' => 'Hamilton Twonship ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 1109,
                'state_id' => 63,
                'name_ar' => 'Washington Twonship ',
                'name_en' => 'Washington Twonship ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 1110,
                'state_id' => 63,
                'name_ar' => 'Jackson Township ',
                'name_en' => 'Jackson Township ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 1111,
                'state_id' => 63,
                'name_ar' => 'Lacey Township ',
                'name_en' => 'Lacey Township ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 1112,
                'state_id' => 63,
                'name_ar' => 'Woodland Township ',
                'name_en' => 'Woodland Township ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 1113,
                'state_id' => 63,
                'name_ar' => 'Maurice River Township ',
                'name_en' => 'Maurice River Township ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 1114,
                'state_id' => 63,
                'name_ar' => 'Middle Township ',
                'name_en' => 'Middle Township ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 1115,
                'state_id' => 63,
                'name_ar' => 'Manchester Twonship ',
                'name_en' => 'Manchester Twonship ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 1116,
                'state_id' => 63,
                'name_ar' => 'West Mildford ',
                'name_en' => 'West Mildford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 1117,
                'state_id' => 63,
                'name_ar' => 'Bass River Township ',
                'name_en' => 'Bass River Township ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 1118,
                'state_id' => 63,
                'name_ar' => 'New Jersy-Others ',
                'name_en' => 'New Jersy-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 1119,
                'state_id' => 64,
                'name_ar' => 'NorthenVirginia ',
                'name_en' => 'NorthenVirginia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 1120,
                'state_id' => 64,
                'name_ar' => 'Hampton Roads ',
                'name_en' => 'Hampton Roads ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 1121,
                'state_id' => 64,
                'name_ar' => 'Richmond ',
                'name_en' => 'Richmond ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 1122,
                'state_id' => 64,
                'name_ar' => 'Roanoke ',
                'name_en' => 'Roanoke ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 1123,
                'state_id' => 64,
                'name_ar' => 'Lynchburg ',
                'name_en' => 'Lynchburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 1124,
                'state_id' => 64,
                'name_ar' => 'Charlottesville ',
                'name_en' => 'Charlottesville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 1125,
                'state_id' => 64,
                'name_ar' => 'Blackburg Christianburg ',
                'name_en' => 'Blackburg Christianburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 1126,
                'state_id' => 64,
                'name_ar' => 'Harrisonburg ',
                'name_en' => 'Harrisonburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 1127,
                'state_id' => 64,
                'name_ar' => 'Staunton Waynesboro ',
                'name_en' => 'Staunton Waynesboro ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 1128,
                'state_id' => 64,
                'name_ar' => 'Winchester ',
                'name_en' => 'Winchester ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 1129,
                'state_id' => 64,
                'name_ar' => 'Virginia-Others ',
                'name_en' => 'Virginia-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 1130,
                'state_id' => 65,
                'name_ar' => 'Seattle ',
                'name_en' => 'Seattle ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 1131,
                'state_id' => 65,
                'name_ar' => 'Spokane ',
                'name_en' => 'Spokane ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 1132,
                'state_id' => 65,
                'name_ar' => 'Tacoma ',
                'name_en' => 'Tacoma ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 1133,
                'state_id' => 65,
                'name_ar' => 'Vancouver ',
                'name_en' => 'Vancouver ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 1134,
                'state_id' => 65,
                'name_ar' => 'Bellevue ',
                'name_en' => 'Bellevue ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 1135,
                'state_id' => 65,
                'name_ar' => 'Kent ',
                'name_en' => 'Kent ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 1136,
                'state_id' => 65,
                'name_ar' => 'Everett ',
                'name_en' => 'Everett ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 1137,
                'state_id' => 65,
                'name_ar' => 'Renton ',
                'name_en' => 'Renton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 1138,
                'state_id' => 65,
                'name_ar' => 'Spokane Valley ',
                'name_en' => 'Spokane Valley ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 1139,
                'state_id' => 65,
                'name_ar' => 'Federal Way  ',
                'name_en' => 'Federal Way  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 1140,
                'state_id' => 65,
                'name_ar' => 'Washington-Others ',
                'name_en' => 'Washington-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 1141,
                'state_id' => 66,
                'name_ar' => 'Phoenix ',
                'name_en' => 'Phoenix ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 1142,
                'state_id' => 66,
                'name_ar' => 'Tucson ',
                'name_en' => 'Tucson ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 1143,
                'state_id' => 66,
                'name_ar' => 'Mesa ',
                'name_en' => 'Mesa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 1144,
                'state_id' => 66,
                'name_ar' => 'Chandler ',
                'name_en' => 'Chandler ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 1145,
                'state_id' => 66,
                'name_ar' => 'Scottsdale ',
                'name_en' => 'Scottsdale ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 1146,
                'state_id' => 66,
                'name_ar' => 'Glendale ',
                'name_en' => 'Glendale ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 1147,
                'state_id' => 66,
                'name_ar' => 'Gilbert ',
                'name_en' => 'Gilbert ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 1148,
                'state_id' => 66,
                'name_ar' => 'Tempe ',
                'name_en' => 'Tempe ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 1149,
                'state_id' => 66,
                'name_ar' => 'Peoria ',
                'name_en' => 'Peoria ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 1150,
                'state_id' => 66,
                'name_ar' => 'Surprise ',
                'name_en' => 'Surprise ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 1151,
                'state_id' => 66,
                'name_ar' => 'Arizona-Others ',
                'name_en' => 'Arizona-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 1152,
                'state_id' => 67,
                'name_ar' => 'Boston ',
                'name_en' => 'Boston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 1153,
                'state_id' => 67,
                'name_ar' => 'Worcester ',
                'name_en' => 'Worcester ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 1154,
                'state_id' => 67,
                'name_ar' => 'Springfield ',
                'name_en' => 'Springfield ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 1155,
                'state_id' => 67,
                'name_ar' => 'Cambridge ',
                'name_en' => 'Cambridge ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 1156,
                'state_id' => 67,
                'name_ar' => 'Lowell ',
                'name_en' => 'Lowell ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 1157,
                'state_id' => 67,
                'name_ar' => 'Brockton ',
                'name_en' => 'Brockton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 1158,
                'state_id' => 67,
                'name_ar' => 'New Bedford ',
                'name_en' => 'New Bedford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 1159,
                'state_id' => 67,
                'name_ar' => 'Quincy ',
                'name_en' => 'Quincy ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 1160,
                'state_id' => 67,
                'name_ar' => 'Lynn ',
                'name_en' => 'Lynn ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 1161,
                'state_id' => 67,
                'name_ar' => 'Fall River ',
                'name_en' => 'Fall River ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 1162,
                'state_id' => 67,
                'name_ar' => 'Massachusetts-Others ',
                'name_en' => 'Massachusetts-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 1163,
                'state_id' => 68,
                'name_ar' => 'Nashville ',
                'name_en' => 'Nashville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 1164,
                'state_id' => 68,
                'name_ar' => 'Memphis ',
                'name_en' => 'Memphis ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 1165,
                'state_id' => 68,
                'name_ar' => 'Knoxville ',
                'name_en' => 'Knoxville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 1166,
                'state_id' => 68,
                'name_ar' => 'Chatanooga ',
                'name_en' => 'Chatanooga ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 1167,
                'state_id' => 68,
                'name_ar' => 'Clarksville ',
                'name_en' => 'Clarksville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 1168,
                'state_id' => 68,
                'name_ar' => 'Murfreesboro ',
                'name_en' => 'Murfreesboro ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 1169,
                'state_id' => 68,
                'name_ar' => 'Franklin ',
                'name_en' => 'Franklin ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 1170,
                'state_id' => 68,
                'name_ar' => 'Jackson ',
                'name_en' => 'Jackson ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 1171,
                'state_id' => 68,
                'name_ar' => 'Johnson City ',
                'name_en' => 'Johnson City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 1172,
                'state_id' => 68,
                'name_ar' => 'Bratlett ',
                'name_en' => 'Bratlett ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 1173,
                'state_id' => 68,
                'name_ar' => 'Tennessee-Others ',
                'name_en' => 'Tennessee-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 1174,
                'state_id' => 69,
                'name_ar' => 'Indianapolis ',
                'name_en' => 'Indianapolis ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 1175,
                'state_id' => 69,
                'name_ar' => 'Fort Wayne ',
                'name_en' => 'Fort Wayne ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 1176,
                'state_id' => 69,
                'name_ar' => 'Evansville ',
                'name_en' => 'Evansville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 1177,
                'state_id' => 69,
                'name_ar' => 'South Bend ',
                'name_en' => 'South Bend ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 1178,
                'state_id' => 69,
                'name_ar' => 'Carmel ',
                'name_en' => 'Carmel ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 1179,
                'state_id' => 69,
                'name_ar' => 'Fishers ',
                'name_en' => 'Fishers ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 1180,
                'state_id' => 69,
                'name_ar' => 'Bloomington ',
                'name_en' => 'Bloomington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 1181,
                'state_id' => 69,
                'name_ar' => 'Hammond ',
                'name_en' => 'Hammond ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 1182,
                'state_id' => 69,
                'name_ar' => 'Gary ',
                'name_en' => 'Gary ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 1183,
                'state_id' => 69,
                'name_ar' => 'Lafayette ',
                'name_en' => 'Lafayette ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 1184,
                'state_id' => 69,
                'name_ar' => 'Indiana-Others ',
                'name_en' => 'Indiana-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 1185,
                'state_id' => 70,
                'name_ar' => 'Kansas City ',
                'name_en' => 'Kansas City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 1186,
                'state_id' => 70,
                'name_ar' => 'St. Louis ',
                'name_en' => 'St. Louis ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 1187,
                'state_id' => 70,
                'name_ar' => 'Springfield ',
                'name_en' => 'Springfield ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 1188,
                'state_id' => 70,
                'name_ar' => 'Colunbia ',
                'name_en' => 'Colunbia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 1189,
                'state_id' => 70,
                'name_ar' => 'Independence ',
                'name_en' => 'Independence ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 1190,
                'state_id' => 70,
                'name_ar' => 'Lees Summit ',
                'name_en' => 'Lees Summit ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 1191,
                'state_id' => 70,
                'name_ar' => 'O Fallon ',
                'name_en' => 'O Fallon ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 1192,
                'state_id' => 70,
                'name_ar' => 'St. Joseph ',
                'name_en' => 'St. Joseph ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 1193,
                'state_id' => 70,
                'name_ar' => 'St. Charies ',
                'name_en' => 'St. Charies ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 1194,
                'state_id' => 70,
                'name_ar' => 'St. Peters ',
                'name_en' => 'St. Peters ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 1195,
                'state_id' => 70,
                'name_ar' => 'Missouri-Others ',
                'name_en' => 'Missouri-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 1196,
                'state_id' => 71,
                'name_ar' => 'Baltimore ',
                'name_en' => 'Baltimore ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 1197,
                'state_id' => 71,
                'name_ar' => 'Cloumbia ',
                'name_en' => 'Cloumbia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 1198,
                'state_id' => 71,
                'name_ar' => 'Germantown ',
                'name_en' => 'Germantown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 1199,
                'state_id' => 71,
                'name_ar' => 'Silver Spring ',
                'name_en' => 'Silver Spring ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 1200,
                'state_id' => 71,
                'name_ar' => 'Waldorf ',
                'name_en' => 'Waldorf ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 1201,
                'state_id' => 71,
                'name_ar' => 'Glen Burnie ',
                'name_en' => 'Glen Burnie ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 1202,
                'state_id' => 71,
                'name_ar' => 'Ellicott City ',
                'name_en' => 'Ellicott City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 1203,
                'state_id' => 71,
                'name_ar' => 'Fredreick ',
                'name_en' => 'Fredreick ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 1204,
                'state_id' => 71,
                'name_ar' => 'Dundalk ',
                'name_en' => 'Dundalk ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 1205,
                'state_id' => 71,
                'name_ar' => 'Rockville ',
                'name_en' => 'Rockville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 1206,
                'state_id' => 71,
                'name_ar' => 'Maryland-Others ',
                'name_en' => 'Maryland-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 1207,
                'state_id' => 72,
                'name_ar' => 'Milwaukee ',
                'name_en' => 'Milwaukee ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 1208,
                'state_id' => 72,
                'name_ar' => 'Madison ',
                'name_en' => 'Madison ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 1209,
                'state_id' => 72,
                'name_ar' => 'Green Bay ',
                'name_en' => 'Green Bay ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 1210,
                'state_id' => 72,
                'name_ar' => 'Kenosha ',
                'name_en' => 'Kenosha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 1211,
                'state_id' => 72,
                'name_ar' => 'Racine ',
                'name_en' => 'Racine ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 1212,
                'state_id' => 72,
                'name_ar' => 'Appleton ',
                'name_en' => 'Appleton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 1213,
                'state_id' => 72,
                'name_ar' => 'Waukesha ',
                'name_en' => 'Waukesha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 1214,
                'state_id' => 72,
                'name_ar' => 'Eau Claire ',
                'name_en' => 'Eau Claire ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 1215,
                'state_id' => 72,
                'name_ar' => 'Oshkosh ',
                'name_en' => 'Oshkosh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 1216,
                'state_id' => 72,
                'name_ar' => 'Janesville ',
                'name_en' => 'Janesville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 1217,
                'state_id' => 72,
                'name_ar' => 'Wisconsin-Others ',
                'name_en' => 'Wisconsin-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 1218,
                'state_id' => 73,
                'name_ar' => 'Denver City ',
                'name_en' => 'Denver City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 1219,
                'state_id' => 73,
                'name_ar' => 'Colorado City ',
                'name_en' => 'Colorado City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 1220,
                'state_id' => 73,
                'name_ar' => 'Aurora City ',
                'name_en' => 'Aurora City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 1221,
                'state_id' => 73,
                'name_ar' => 'Fort Collins City ',
                'name_en' => 'Fort Collins City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 1222,
                'state_id' => 73,
                'name_ar' => 'Lakewood City ',
                'name_en' => 'Lakewood City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 1223,
                'state_id' => 73,
                'name_ar' => 'Thornton City ',
                'name_en' => 'Thornton City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 1224,
                'state_id' => 73,
                'name_ar' => 'Arvada City ',
                'name_en' => 'Arvada City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 1225,
                'state_id' => 73,
                'name_ar' => 'Westminster City ',
                'name_en' => 'Westminster City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 1226,
                'state_id' => 73,
                'name_ar' => 'Pueblo City ',
                'name_en' => 'Pueblo City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 1227,
                'state_id' => 73,
                'name_ar' => 'Centennial City ',
                'name_en' => 'Centennial City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 1228,
                'state_id' => 73,
                'name_ar' => 'Boulder City ',
                'name_en' => 'Boulder City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 1229,
                'state_id' => 73,
                'name_ar' => 'Colorado-Others ',
                'name_en' => 'Colorado-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 1230,
                'state_id' => 74,
                'name_ar' => 'Minneapolis ',
                'name_en' => 'Minneapolis ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 1231,
                'state_id' => 74,
                'name_ar' => 'Saint Paul ',
                'name_en' => 'Saint Paul ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 1232,
                'state_id' => 74,
                'name_ar' => 'Rochester ',
                'name_en' => 'Rochester ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 1233,
                'state_id' => 74,
                'name_ar' => 'Duluth ',
                'name_en' => 'Duluth ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 1234,
                'state_id' => 74,
                'name_ar' => 'Bloomington ',
                'name_en' => 'Bloomington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 1235,
                'state_id' => 74,
                'name_ar' => 'Brooklyn Park ',
                'name_en' => 'Brooklyn Park ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 1236,
                'state_id' => 74,
                'name_ar' => 'Plymouth ',
                'name_en' => 'Plymouth ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 1237,
                'state_id' => 74,
                'name_ar' => 'Saint Cloud ',
                'name_en' => 'Saint Cloud ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 1238,
                'state_id' => 74,
                'name_ar' => 'Woodbury ',
                'name_en' => 'Woodbury ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 1239,
                'state_id' => 74,
                'name_ar' => 'Eagan ',
                'name_en' => 'Eagan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 1240,
                'state_id' => 74,
                'name_ar' => 'Maple Grove ',
                'name_en' => 'Maple Grove ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            240 => 
            array (
                'id' => 1241,
                'state_id' => 74,
                'name_ar' => 'Coon Rapids ',
                'name_en' => 'Coon Rapids ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            241 => 
            array (
                'id' => 1242,
                'state_id' => 74,
                'name_ar' => 'Eden Prairie ',
                'name_en' => 'Eden Prairie ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            242 => 
            array (
                'id' => 1243,
                'state_id' => 74,
                'name_ar' => 'Apple Valley ',
                'name_en' => 'Apple Valley ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            243 => 
            array (
                'id' => 1244,
                'state_id' => 74,
                'name_ar' => 'Minnesota-Others ',
                'name_en' => 'Minnesota-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            244 => 
            array (
                'id' => 1245,
                'state_id' => 75,
                'name_ar' => 'Charleston ',
                'name_en' => 'Charleston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            245 => 
            array (
                'id' => 1246,
                'state_id' => 75,
                'name_ar' => 'Columbia ',
                'name_en' => 'Columbia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            246 => 
            array (
                'id' => 1247,
                'state_id' => 75,
                'name_ar' => 'North Charleston ',
                'name_en' => 'North Charleston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            247 => 
            array (
                'id' => 1248,
                'state_id' => 75,
                'name_ar' => 'Mount Pleasant ',
                'name_en' => 'Mount Pleasant ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            248 => 
            array (
                'id' => 1249,
                'state_id' => 75,
                'name_ar' => 'Rock Hill ',
                'name_en' => 'Rock Hill ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            249 => 
            array (
                'id' => 1250,
                'state_id' => 75,
                'name_ar' => 'Greenville ',
                'name_en' => 'Greenville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            250 => 
            array (
                'id' => 1251,
                'state_id' => 75,
                'name_ar' => 'Summerville ',
                'name_en' => 'Summerville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            251 => 
            array (
                'id' => 1252,
                'state_id' => 75,
                'name_ar' => 'Goose Creek ',
                'name_en' => 'Goose Creek ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            252 => 
            array (
                'id' => 1253,
                'state_id' => 75,
                'name_ar' => 'Sumter ',
                'name_en' => 'Sumter ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            253 => 
            array (
                'id' => 1254,
                'state_id' => 75,
                'name_ar' => 'Hilton Head Island ',
                'name_en' => 'Hilton Head Island ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            254 => 
            array (
                'id' => 1255,
                'state_id' => 75,
                'name_ar' => 'South Carolina-Others ',
                'name_en' => 'South Carolina-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            255 => 
            array (
                'id' => 1256,
                'state_id' => 76,
                'name_ar' => 'Birmingham ',
                'name_en' => 'Birmingham ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            256 => 
            array (
                'id' => 1257,
                'state_id' => 76,
                'name_ar' => 'Huntsville ',
                'name_en' => 'Huntsville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            257 => 
            array (
                'id' => 1258,
                'state_id' => 76,
                'name_ar' => 'Montgomery ',
                'name_en' => 'Montgomery ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            258 => 
            array (
                'id' => 1259,
                'state_id' => 76,
                'name_ar' => 'Mobile ',
                'name_en' => 'Mobile ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            259 => 
            array (
                'id' => 1260,
                'state_id' => 76,
                'name_ar' => 'Tuscaloosa ',
                'name_en' => 'Tuscaloosa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            260 => 
            array (
                'id' => 1261,
                'state_id' => 76,
                'name_ar' => 'Hoover ',
                'name_en' => 'Hoover ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            261 => 
            array (
                'id' => 1262,
                'state_id' => 76,
                'name_ar' => 'Dothan ',
                'name_en' => 'Dothan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            262 => 
            array (
                'id' => 1263,
                'state_id' => 76,
                'name_ar' => 'Aubum ',
                'name_en' => 'Aubum ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            263 => 
            array (
                'id' => 1264,
                'state_id' => 76,
                'name_ar' => 'Decatur ',
                'name_en' => 'Decatur ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            264 => 
            array (
                'id' => 1265,
                'state_id' => 76,
                'name_ar' => 'Madison ',
                'name_en' => 'Madison ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            265 => 
            array (
                'id' => 1266,
                'state_id' => 76,
                'name_ar' => 'Florence ',
                'name_en' => 'Florence ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            266 => 
            array (
                'id' => 1267,
                'state_id' => 76,
                'name_ar' => 'Phenix City ',
                'name_en' => 'Phenix City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            267 => 
            array (
                'id' => 1268,
                'state_id' => 76,
                'name_ar' => 'Prattville ',
                'name_en' => 'Prattville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            268 => 
            array (
                'id' => 1269,
                'state_id' => 76,
                'name_ar' => 'Gadsden ',
                'name_en' => 'Gadsden ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            269 => 
            array (
                'id' => 1270,
                'state_id' => 76,
                'name_ar' => 'Vestavia Hills ',
                'name_en' => 'Vestavia Hills ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            270 => 
            array (
                'id' => 1271,
                'state_id' => 76,
                'name_ar' => 'Albama-Others ',
                'name_en' => 'Albama-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            271 => 
            array (
                'id' => 1272,
                'state_id' => 77,
                'name_ar' => 'New Orleans ',
                'name_en' => 'New Orleans ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            272 => 
            array (
                'id' => 1273,
                'state_id' => 77,
                'name_ar' => 'Baton Rouge ',
                'name_en' => 'Baton Rouge ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            273 => 
            array (
                'id' => 1274,
                'state_id' => 77,
                'name_ar' => 'Shreveport ',
                'name_en' => 'Shreveport ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            274 => 
            array (
                'id' => 1275,
                'state_id' => 77,
                'name_ar' => 'Lafayette ',
                'name_en' => 'Lafayette ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            275 => 
            array (
                'id' => 1276,
                'state_id' => 77,
                'name_ar' => 'Lake Charles ',
                'name_en' => 'Lake Charles ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            276 => 
            array (
                'id' => 1277,
                'state_id' => 77,
                'name_ar' => 'Bossier City ',
                'name_en' => 'Bossier City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            277 => 
            array (
                'id' => 1278,
                'state_id' => 77,
                'name_ar' => 'Kenner ',
                'name_en' => 'Kenner ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            278 => 
            array (
                'id' => 1279,
                'state_id' => 77,
                'name_ar' => 'Monroe ',
                'name_en' => 'Monroe ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            279 => 
            array (
                'id' => 1280,
                'state_id' => 77,
                'name_ar' => 'Alexandria ',
                'name_en' => 'Alexandria ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            280 => 
            array (
                'id' => 1281,
                'state_id' => 77,
                'name_ar' => 'Houma ',
                'name_en' => 'Houma ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            281 => 
            array (
                'id' => 1282,
                'state_id' => 77,
                'name_ar' => 'Louisiana-Others ',
                'name_en' => 'Louisiana-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            282 => 
            array (
                'id' => 1283,
                'state_id' => 78,
                'name_ar' => 'Louisville ',
                'name_en' => 'Louisville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            283 => 
            array (
                'id' => 1284,
                'state_id' => 78,
                'name_ar' => 'Lexington ',
                'name_en' => 'Lexington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            284 => 
            array (
                'id' => 1285,
                'state_id' => 78,
                'name_ar' => 'Bowling Green ',
                'name_en' => 'Bowling Green ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            285 => 
            array (
                'id' => 1286,
                'state_id' => 78,
                'name_ar' => 'Owensboro ',
                'name_en' => 'Owensboro ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            286 => 
            array (
                'id' => 1287,
                'state_id' => 78,
                'name_ar' => 'Covington ',
                'name_en' => 'Covington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            287 => 
            array (
                'id' => 1288,
                'state_id' => 78,
                'name_ar' => 'Richmond ',
                'name_en' => 'Richmond ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            288 => 
            array (
                'id' => 1289,
                'state_id' => 78,
                'name_ar' => 'Georgetown ',
                'name_en' => 'Georgetown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            289 => 
            array (
                'id' => 1290,
                'state_id' => 78,
                'name_ar' => 'Florence ',
                'name_en' => 'Florence ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            290 => 
            array (
                'id' => 1291,
                'state_id' => 78,
                'name_ar' => 'Nicholasville ',
                'name_en' => 'Nicholasville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            291 => 
            array (
                'id' => 1292,
                'state_id' => 78,
                'name_ar' => 'Hopkinsville ',
                'name_en' => 'Hopkinsville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            292 => 
            array (
                'id' => 1293,
                'state_id' => 78,
                'name_ar' => 'Kentucky-Others ',
                'name_en' => 'Kentucky-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            293 => 
            array (
                'id' => 1294,
                'state_id' => 79,
                'name_ar' => 'Portland ',
                'name_en' => 'Portland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            294 => 
            array (
                'id' => 1295,
                'state_id' => 79,
                'name_ar' => 'Salem ',
                'name_en' => 'Salem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            295 => 
            array (
                'id' => 1296,
                'state_id' => 79,
                'name_ar' => 'Eugene ',
                'name_en' => 'Eugene ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            296 => 
            array (
                'id' => 1297,
                'state_id' => 79,
                'name_ar' => 'Gresham ',
                'name_en' => 'Gresham ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            297 => 
            array (
                'id' => 1298,
                'state_id' => 79,
                'name_ar' => 'Hillsboro ',
                'name_en' => 'Hillsboro ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            298 => 
            array (
                'id' => 1299,
                'state_id' => 79,
                'name_ar' => 'Beaverton ',
                'name_en' => 'Beaverton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            299 => 
            array (
                'id' => 1300,
                'state_id' => 79,
                'name_ar' => 'Bend ',
                'name_en' => 'Bend ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            300 => 
            array (
                'id' => 1301,
                'state_id' => 79,
                'name_ar' => 'Medford ',
                'name_en' => 'Medford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            301 => 
            array (
                'id' => 1302,
                'state_id' => 79,
                'name_ar' => 'Springfield ',
                'name_en' => 'Springfield ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            302 => 
            array (
                'id' => 1303,
                'state_id' => 79,
                'name_ar' => 'Corvallis ',
                'name_en' => 'Corvallis ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            303 => 
            array (
                'id' => 1304,
                'state_id' => 79,
                'name_ar' => 'Oregon-Others ',
                'name_en' => 'Oregon-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            304 => 
            array (
                'id' => 1305,
                'state_id' => 80,
                'name_ar' => 'Oklahoma City ',
                'name_en' => 'Oklahoma City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            305 => 
            array (
                'id' => 1306,
                'state_id' => 80,
                'name_ar' => 'Tulsa ',
                'name_en' => 'Tulsa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            306 => 
            array (
                'id' => 1307,
                'state_id' => 80,
                'name_ar' => 'Norman ',
                'name_en' => 'Norman ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            307 => 
            array (
                'id' => 1308,
                'state_id' => 80,
                'name_ar' => 'Broken Arrow ',
                'name_en' => 'Broken Arrow ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            308 => 
            array (
                'id' => 1309,
                'state_id' => 80,
                'name_ar' => 'Edmond ',
                'name_en' => 'Edmond ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            309 => 
            array (
                'id' => 1310,
                'state_id' => 80,
                'name_ar' => 'Lawton ',
                'name_en' => 'Lawton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            310 => 
            array (
                'id' => 1311,
                'state_id' => 80,
                'name_ar' => 'Moore ',
                'name_en' => 'Moore ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            311 => 
            array (
                'id' => 1312,
                'state_id' => 80,
                'name_ar' => 'Midwest City ',
                'name_en' => 'Midwest City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            312 => 
            array (
                'id' => 1313,
                'state_id' => 80,
                'name_ar' => 'Stillwater ',
                'name_en' => 'Stillwater ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            313 => 
            array (
                'id' => 1314,
                'state_id' => 80,
                'name_ar' => 'Enid ',
                'name_en' => 'Enid ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            314 => 
            array (
                'id' => 1315,
                'state_id' => 80,
                'name_ar' => 'Oklahoma-Others ',
                'name_en' => 'Oklahoma-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            315 => 
            array (
                'id' => 1316,
                'state_id' => 81,
                'name_ar' => 'Bridgeport ',
                'name_en' => 'Bridgeport ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            316 => 
            array (
                'id' => 1317,
                'state_id' => 81,
                'name_ar' => 'New Haven ',
                'name_en' => 'New Haven ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            317 => 
            array (
                'id' => 1318,
                'state_id' => 81,
                'name_ar' => 'Stamford ',
                'name_en' => 'Stamford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            318 => 
            array (
                'id' => 1319,
                'state_id' => 81,
                'name_ar' => 'Hartford ',
                'name_en' => 'Hartford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            319 => 
            array (
                'id' => 1320,
                'state_id' => 81,
                'name_ar' => 'Waterbury ',
                'name_en' => 'Waterbury ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            320 => 
            array (
                'id' => 1321,
                'state_id' => 81,
                'name_ar' => 'Norwalk ',
                'name_en' => 'Norwalk ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            321 => 
            array (
                'id' => 1322,
                'state_id' => 81,
                'name_ar' => 'Danbury ',
                'name_en' => 'Danbury ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            322 => 
            array (
                'id' => 1323,
                'state_id' => 81,
                'name_ar' => 'New Britain ',
                'name_en' => 'New Britain ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            323 => 
            array (
                'id' => 1324,
                'state_id' => 81,
                'name_ar' => 'Bristol ',
                'name_en' => 'Bristol ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            324 => 
            array (
                'id' => 1325,
                'state_id' => 81,
                'name_ar' => 'Meriden ',
                'name_en' => 'Meriden ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            325 => 
            array (
                'id' => 1326,
                'state_id' => 81,
                'name_ar' => 'West Haven ',
                'name_en' => 'West Haven ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            326 => 
            array (
                'id' => 1327,
                'state_id' => 81,
                'name_ar' => 'Milford ',
                'name_en' => 'Milford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            327 => 
            array (
                'id' => 1328,
                'state_id' => 81,
                'name_ar' => 'Connecticut-Others ',
                'name_en' => 'Connecticut-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            328 => 
            array (
                'id' => 1329,
                'state_id' => 82,
                'name_ar' => 'Salt Lake City ',
                'name_en' => 'Salt Lake City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            329 => 
            array (
                'id' => 1330,
                'state_id' => 82,
                'name_ar' => 'West Valley City ',
                'name_en' => 'West Valley City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            330 => 
            array (
                'id' => 1331,
                'state_id' => 82,
                'name_ar' => 'Provo ',
                'name_en' => 'Provo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            331 => 
            array (
                'id' => 1332,
                'state_id' => 82,
                'name_ar' => 'West Jordan ',
                'name_en' => 'West Jordan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            332 => 
            array (
                'id' => 1333,
                'state_id' => 82,
                'name_ar' => 'Orem ',
                'name_en' => 'Orem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            333 => 
            array (
                'id' => 1334,
                'state_id' => 82,
                'name_ar' => 'Sandy ',
                'name_en' => 'Sandy ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            334 => 
            array (
                'id' => 1335,
                'state_id' => 82,
                'name_ar' => 'Ogden ',
                'name_en' => 'Ogden ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            335 => 
            array (
                'id' => 1336,
                'state_id' => 82,
                'name_ar' => 'St. George ',
                'name_en' => 'St. George ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            336 => 
            array (
                'id' => 1337,
                'state_id' => 82,
                'name_ar' => 'Layton ',
                'name_en' => 'Layton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            337 => 
            array (
                'id' => 1338,
                'state_id' => 82,
                'name_ar' => 'South Jordan ',
                'name_en' => 'South Jordan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            338 => 
            array (
                'id' => 1339,
                'state_id' => 82,
                'name_ar' => 'Lehi ',
                'name_en' => 'Lehi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            339 => 
            array (
                'id' => 1340,
                'state_id' => 82,
                'name_ar' => 'Millcreek ',
                'name_en' => 'Millcreek ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            340 => 
            array (
                'id' => 1341,
                'state_id' => 82,
                'name_ar' => 'Taylorsville ',
                'name_en' => 'Taylorsville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            341 => 
            array (
                'id' => 1342,
                'state_id' => 82,
                'name_ar' => 'Utah-Others ',
                'name_en' => 'Utah-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            342 => 
            array (
                'id' => 1343,
                'state_id' => 83,
                'name_ar' => 'San Juan ',
                'name_en' => 'San Juan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            343 => 
            array (
                'id' => 1344,
                'state_id' => 83,
                'name_ar' => 'Bayamon ',
                'name_en' => 'Bayamon ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            344 => 
            array (
                'id' => 1345,
                'state_id' => 83,
                'name_ar' => 'Carolina ',
                'name_en' => 'Carolina ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            345 => 
            array (
                'id' => 1346,
                'state_id' => 83,
                'name_ar' => 'Ponce ',
                'name_en' => 'Ponce ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            346 => 
            array (
                'id' => 1347,
                'state_id' => 83,
                'name_ar' => 'Caguas ',
                'name_en' => 'Caguas ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            347 => 
            array (
                'id' => 1348,
                'state_id' => 83,
                'name_ar' => 'Guaynabo ',
                'name_en' => 'Guaynabo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            348 => 
            array (
                'id' => 1349,
                'state_id' => 83,
                'name_ar' => 'Arecibo ',
                'name_en' => 'Arecibo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            349 => 
            array (
                'id' => 1350,
                'state_id' => 83,
                'name_ar' => 'Toa Baja ',
                'name_en' => 'Toa Baja ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            350 => 
            array (
                'id' => 1351,
                'state_id' => 83,
                'name_ar' => 'Mayaguez ',
                'name_en' => 'Mayaguez ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            351 => 
            array (
                'id' => 1352,
                'state_id' => 83,
                'name_ar' => 'Juana Diaz ',
                'name_en' => 'Juana Diaz ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            352 => 
            array (
                'id' => 1353,
                'state_id' => 83,
                'name_ar' => 'Trujillo Alto ',
                'name_en' => 'Trujillo Alto ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            353 => 
            array (
                'id' => 1354,
                'state_id' => 83,
                'name_ar' => 'Toa Alta ',
                'name_en' => 'Toa Alta ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            354 => 
            array (
                'id' => 1355,
                'state_id' => 83,
                'name_ar' => 'Puerto Rico-Others ',
                'name_en' => 'Puerto Rico-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            355 => 
            array (
                'id' => 1356,
                'state_id' => 84,
                'name_ar' => 'Des Moines ',
                'name_en' => 'Des Moines ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            356 => 
            array (
                'id' => 1357,
                'state_id' => 84,
                'name_ar' => 'Cedar Rpids ',
                'name_en' => 'Cedar Rpids ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            357 => 
            array (
                'id' => 1358,
                'state_id' => 84,
                'name_ar' => 'Davenport ',
                'name_en' => 'Davenport ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            358 => 
            array (
                'id' => 1359,
                'state_id' => 84,
                'name_ar' => 'Sioux City ',
                'name_en' => 'Sioux City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            359 => 
            array (
                'id' => 1360,
                'state_id' => 84,
                'name_ar' => 'Iowa City ',
                'name_en' => 'Iowa City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            360 => 
            array (
                'id' => 1361,
                'state_id' => 84,
                'name_ar' => 'West Des Moines ',
                'name_en' => 'West Des Moines ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            361 => 
            array (
                'id' => 1362,
                'state_id' => 84,
                'name_ar' => 'Ankeny ',
                'name_en' => 'Ankeny ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            362 => 
            array (
                'id' => 1363,
                'state_id' => 84,
                'name_ar' => 'Waterloo ',
                'name_en' => 'Waterloo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            363 => 
            array (
                'id' => 1364,
                'state_id' => 84,
                'name_ar' => 'Ames ',
                'name_en' => 'Ames ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            364 => 
            array (
                'id' => 1365,
                'state_id' => 84,
                'name_ar' => 'Council Bluffs ',
                'name_en' => 'Council Bluffs ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            365 => 
            array (
                'id' => 1366,
                'state_id' => 84,
                'name_ar' => 'Dubuque ',
                'name_en' => 'Dubuque ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            366 => 
            array (
                'id' => 1367,
                'state_id' => 84,
                'name_ar' => 'Urbandale ',
                'name_en' => 'Urbandale ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            367 => 
            array (
                'id' => 1368,
                'state_id' => 84,
                'name_ar' => 'Cedar Falls ',
                'name_en' => 'Cedar Falls ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            368 => 
            array (
                'id' => 1369,
                'state_id' => 84,
                'name_ar' => 'Marion ',
                'name_en' => 'Marion ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            369 => 
            array (
                'id' => 1370,
                'state_id' => 84,
                'name_ar' => 'Bettendorf ',
                'name_en' => 'Bettendorf ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            370 => 
            array (
                'id' => 1371,
                'state_id' => 84,
                'name_ar' => 'Iowa-Others ',
                'name_en' => 'Iowa-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            371 => 
            array (
                'id' => 1372,
                'state_id' => 85,
                'name_ar' => 'Las Vegas ',
                'name_en' => 'Las Vegas ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            372 => 
            array (
                'id' => 1373,
                'state_id' => 85,
                'name_ar' => 'Henderson ',
                'name_en' => 'Henderson ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            373 => 
            array (
                'id' => 1374,
                'state_id' => 85,
                'name_ar' => 'Reno ',
                'name_en' => 'Reno ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            374 => 
            array (
                'id' => 1375,
                'state_id' => 85,
                'name_ar' => 'North Las Vegas ',
                'name_en' => 'North Las Vegas ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            375 => 
            array (
                'id' => 1376,
                'state_id' => 85,
                'name_ar' => 'Paradise ',
                'name_en' => 'Paradise ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            376 => 
            array (
                'id' => 1377,
                'state_id' => 85,
                'name_ar' => 'Spring Valley ',
                'name_en' => 'Spring Valley ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            377 => 
            array (
                'id' => 1378,
                'state_id' => 85,
                'name_ar' => 'Sunrise Manor ',
                'name_en' => 'Sunrise Manor ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            378 => 
            array (
                'id' => 1379,
                'state_id' => 85,
                'name_ar' => 'Enterprise ',
                'name_en' => 'Enterprise ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            379 => 
            array (
                'id' => 1380,
                'state_id' => 85,
                'name_ar' => 'Sparks ',
                'name_en' => 'Sparks ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            380 => 
            array (
                'id' => 1381,
                'state_id' => 85,
                'name_ar' => 'Carson City ',
                'name_en' => 'Carson City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            381 => 
            array (
                'id' => 1382,
                'state_id' => 85,
                'name_ar' => 'Nevada-Others ',
                'name_en' => 'Nevada-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            382 => 
            array (
                'id' => 1383,
                'state_id' => 86,
                'name_ar' => 'Little Rock ',
                'name_en' => 'Little Rock ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            383 => 
            array (
                'id' => 1384,
                'state_id' => 86,
                'name_ar' => 'Forth Smith ',
                'name_en' => 'Forth Smith ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            384 => 
            array (
                'id' => 1385,
                'state_id' => 86,
                'name_ar' => 'Fayetteville ',
                'name_en' => 'Fayetteville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            385 => 
            array (
                'id' => 1386,
                'state_id' => 86,
                'name_ar' => 'Springdale ',
                'name_en' => 'Springdale ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            386 => 
            array (
                'id' => 1387,
                'state_id' => 86,
                'name_ar' => 'Jonesboro ',
                'name_en' => 'Jonesboro ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            387 => 
            array (
                'id' => 1388,
                'state_id' => 86,
                'name_ar' => 'Rogers ',
                'name_en' => 'Rogers ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            388 => 
            array (
                'id' => 1389,
                'state_id' => 86,
                'name_ar' => 'North Little Rock ',
                'name_en' => 'North Little Rock ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            389 => 
            array (
                'id' => 1390,
                'state_id' => 86,
                'name_ar' => 'Conway ',
                'name_en' => 'Conway ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            390 => 
            array (
                'id' => 1391,
                'state_id' => 86,
                'name_ar' => 'Bentonville ',
                'name_en' => 'Bentonville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            391 => 
            array (
                'id' => 1392,
                'state_id' => 86,
                'name_ar' => 'Pine Bluff ',
                'name_en' => 'Pine Bluff ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            392 => 
            array (
                'id' => 1393,
                'state_id' => 86,
                'name_ar' => 'Arkansas-Others ',
                'name_en' => 'Arkansas-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            393 => 
            array (
                'id' => 1394,
                'state_id' => 87,
                'name_ar' => 'Hattiesburg ',
                'name_en' => 'Hattiesburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            394 => 
            array (
                'id' => 1395,
                'state_id' => 87,
                'name_ar' => 'Biloxi ',
                'name_en' => 'Biloxi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            395 => 
            array (
                'id' => 1396,
                'state_id' => 87,
                'name_ar' => 'Tupelo ',
                'name_en' => 'Tupelo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            396 => 
            array (
                'id' => 1397,
                'state_id' => 87,
                'name_ar' => 'Meridian ',
                'name_en' => 'Meridian ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            397 => 
            array (
                'id' => 1398,
                'state_id' => 87,
                'name_ar' => 'Olive Branch ',
                'name_en' => 'Olive Branch ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            398 => 
            array (
                'id' => 1399,
                'state_id' => 87,
                'name_ar' => 'Greenville ',
                'name_en' => 'Greenville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            399 => 
            array (
                'id' => 1400,
                'state_id' => 87,
                'name_ar' => 'Horn Lake ',
                'name_en' => 'Horn Lake ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            400 => 
            array (
                'id' => 1401,
                'state_id' => 87,
                'name_ar' => 'Pearl ',
                'name_en' => 'Pearl ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            401 => 
            array (
                'id' => 1402,
                'state_id' => 87,
                'name_ar' => 'Madison ',
                'name_en' => 'Madison ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            402 => 
            array (
                'id' => 1403,
                'state_id' => 87,
                'name_ar' => 'Jackson ',
                'name_en' => 'Jackson ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            403 => 
            array (
                'id' => 1404,
                'state_id' => 87,
                'name_ar' => 'Gulfport ',
                'name_en' => 'Gulfport ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            404 => 
            array (
                'id' => 1405,
                'state_id' => 87,
                'name_ar' => 'Southaven ',
                'name_en' => 'Southaven ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            405 => 
            array (
                'id' => 1406,
                'state_id' => 87,
                'name_ar' => 'Mississippi-Others ',
                'name_en' => 'Mississippi-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            406 => 
            array (
                'id' => 1407,
                'state_id' => 87,
                'name_ar' => 'Oxford ',
                'name_en' => 'Oxford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            407 => 
            array (
                'id' => 1408,
                'state_id' => 87,
                'name_ar' => 'Clinton ',
                'name_en' => 'Clinton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            408 => 
            array (
                'id' => 1409,
                'state_id' => 87,
                'name_ar' => 'Starkville ',
                'name_en' => 'Starkville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            409 => 
            array (
                'id' => 1410,
                'state_id' => 88,
                'name_ar' => 'Wichita ',
                'name_en' => 'Wichita ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            410 => 
            array (
                'id' => 1411,
                'state_id' => 88,
                'name_ar' => 'Overland Park ',
                'name_en' => 'Overland Park ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            411 => 
            array (
                'id' => 1412,
                'state_id' => 88,
                'name_ar' => 'Kansas City ',
                'name_en' => 'Kansas City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            412 => 
            array (
                'id' => 1413,
                'state_id' => 88,
                'name_ar' => 'Olathe ',
                'name_en' => 'Olathe ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            413 => 
            array (
                'id' => 1414,
                'state_id' => 88,
                'name_ar' => 'Topeka ',
                'name_en' => 'Topeka ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            414 => 
            array (
                'id' => 1415,
                'state_id' => 88,
                'name_ar' => 'Lawrence ',
                'name_en' => 'Lawrence ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            415 => 
            array (
                'id' => 1416,
                'state_id' => 88,
                'name_ar' => 'Shawnee ',
                'name_en' => 'Shawnee ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            416 => 
            array (
                'id' => 1417,
                'state_id' => 88,
                'name_ar' => 'Manhattan ',
                'name_en' => 'Manhattan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            417 => 
            array (
                'id' => 1418,
                'state_id' => 88,
                'name_ar' => 'Lenexa ',
                'name_en' => 'Lenexa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            418 => 
            array (
                'id' => 1419,
                'state_id' => 88,
                'name_ar' => 'Salina ',
                'name_en' => 'Salina ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            419 => 
            array (
                'id' => 1420,
                'state_id' => 88,
                'name_ar' => 'Hutchinson ',
                'name_en' => 'Hutchinson ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            420 => 
            array (
                'id' => 1421,
                'state_id' => 88,
                'name_ar' => 'Leavenworth ',
                'name_en' => 'Leavenworth ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            421 => 
            array (
                'id' => 1422,
                'state_id' => 88,
                'name_ar' => 'Leawood ',
                'name_en' => 'Leawood ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            422 => 
            array (
                'id' => 1423,
                'state_id' => 88,
                'name_ar' => 'Dodfe City ',
                'name_en' => 'Dodfe City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            423 => 
            array (
                'id' => 1424,
                'state_id' => 88,
                'name_ar' => 'Garden City ',
                'name_en' => 'Garden City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            424 => 
            array (
                'id' => 1425,
                'state_id' => 88,
                'name_ar' => 'Kansas-Others ',
                'name_en' => 'Kansas-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            425 => 
            array (
                'id' => 1426,
                'state_id' => 89,
                'name_ar' => 'Santa Fe ',
                'name_en' => 'Santa Fe ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            426 => 
            array (
                'id' => 1427,
                'state_id' => 89,
                'name_ar' => 'Albuquerque ',
                'name_en' => 'Albuquerque ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            427 => 
            array (
                'id' => 1428,
                'state_id' => 89,
                'name_ar' => 'Las Cruces ',
                'name_en' => 'Las Cruces ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            428 => 
            array (
                'id' => 1429,
                'state_id' => 89,
                'name_ar' => 'Rio Rancho ',
                'name_en' => 'Rio Rancho ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            429 => 
            array (
                'id' => 1430,
                'state_id' => 89,
                'name_ar' => 'Rosewell ',
                'name_en' => 'Rosewell ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            430 => 
            array (
                'id' => 1431,
                'state_id' => 89,
                'name_ar' => 'Farmington ',
                'name_en' => 'Farmington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            431 => 
            array (
                'id' => 1432,
                'state_id' => 89,
                'name_ar' => 'Clovis ',
                'name_en' => 'Clovis ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            432 => 
            array (
                'id' => 1433,
                'state_id' => 89,
                'name_ar' => 'Hobbs ',
                'name_en' => 'Hobbs ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            433 => 
            array (
                'id' => 1434,
                'state_id' => 89,
                'name_ar' => 'Alamogordo ',
                'name_en' => 'Alamogordo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            434 => 
            array (
                'id' => 1435,
                'state_id' => 89,
                'name_ar' => 'Carlsbad ',
                'name_en' => 'Carlsbad ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            435 => 
            array (
                'id' => 1436,
                'state_id' => 89,
                'name_ar' => 'New Mexico-Others ',
                'name_en' => 'New Mexico-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            436 => 
            array (
                'id' => 1437,
                'state_id' => 90,
                'name_ar' => 'Lincoln ',
                'name_en' => 'Lincoln ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            437 => 
            array (
                'id' => 1438,
                'state_id' => 90,
                'name_ar' => 'Omaha ',
                'name_en' => 'Omaha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            438 => 
            array (
                'id' => 1439,
                'state_id' => 90,
                'name_ar' => 'Bellevue ',
                'name_en' => 'Bellevue ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            439 => 
            array (
                'id' => 1440,
                'state_id' => 90,
                'name_ar' => 'Grand Island ',
                'name_en' => 'Grand Island ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            440 => 
            array (
                'id' => 1441,
                'state_id' => 90,
                'name_ar' => 'Kearney ',
                'name_en' => 'Kearney ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            441 => 
            array (
                'id' => 1442,
                'state_id' => 90,
                'name_ar' => 'Fremont ',
                'name_en' => 'Fremont ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            442 => 
            array (
                'id' => 1443,
                'state_id' => 90,
                'name_ar' => 'Hastings ',
                'name_en' => 'Hastings ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            443 => 
            array (
                'id' => 1444,
                'state_id' => 90,
                'name_ar' => 'Norfolk ',
                'name_en' => 'Norfolk ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            444 => 
            array (
                'id' => 1445,
                'state_id' => 90,
                'name_ar' => 'North Platte ',
                'name_en' => 'North Platte ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            445 => 
            array (
                'id' => 1446,
                'state_id' => 90,
                'name_ar' => 'Columbus ',
                'name_en' => 'Columbus ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            446 => 
            array (
                'id' => 1447,
                'state_id' => 90,
                'name_ar' => 'Papillion ',
                'name_en' => 'Papillion ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            447 => 
            array (
                'id' => 1448,
                'state_id' => 90,
                'name_ar' => 'La Vista ',
                'name_en' => 'La Vista ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            448 => 
            array (
                'id' => 1449,
                'state_id' => 90,
                'name_ar' => 'Scottsbluff ',
                'name_en' => 'Scottsbluff ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            449 => 
            array (
                'id' => 1450,
                'state_id' => 90,
                'name_ar' => 'South Sioux City ',
                'name_en' => 'South Sioux City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            450 => 
            array (
                'id' => 1451,
                'state_id' => 90,
                'name_ar' => 'Nebraska-Others ',
                'name_en' => 'Nebraska-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            451 => 
            array (
                'id' => 1452,
                'state_id' => 91,
                'name_ar' => 'Charleston ',
                'name_en' => 'Charleston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            452 => 
            array (
                'id' => 1453,
                'state_id' => 91,
                'name_ar' => 'Huntington ',
                'name_en' => 'Huntington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            453 => 
            array (
                'id' => 1454,
                'state_id' => 91,
                'name_ar' => 'Morgantown ',
                'name_en' => 'Morgantown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            454 => 
            array (
                'id' => 1455,
                'state_id' => 91,
                'name_ar' => 'Parkersburg ',
                'name_en' => 'Parkersburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            455 => 
            array (
                'id' => 1456,
                'state_id' => 91,
                'name_ar' => 'Wheeling ',
                'name_en' => 'Wheeling ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            456 => 
            array (
                'id' => 1457,
                'state_id' => 91,
                'name_ar' => 'Weirton ',
                'name_en' => 'Weirton ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            457 => 
            array (
                'id' => 1458,
                'state_id' => 91,
                'name_ar' => 'Fairmont ',
                'name_en' => 'Fairmont ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            458 => 
            array (
                'id' => 1459,
                'state_id' => 91,
                'name_ar' => 'Martinsburg ',
                'name_en' => 'Martinsburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            459 => 
            array (
                'id' => 1460,
                'state_id' => 91,
                'name_ar' => 'Beckley ',
                'name_en' => 'Beckley ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            460 => 
            array (
                'id' => 1461,
                'state_id' => 91,
                'name_ar' => 'Clarksburg ',
                'name_en' => 'Clarksburg ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            461 => 
            array (
                'id' => 1462,
                'state_id' => 91,
                'name_ar' => 'South Charleston ',
                'name_en' => 'South Charleston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            462 => 
            array (
                'id' => 1463,
                'state_id' => 91,
                'name_ar' => 'Vienna ',
                'name_en' => 'Vienna ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            463 => 
            array (
                'id' => 1464,
                'state_id' => 91,
                'name_ar' => 'St. Albans ',
                'name_en' => 'St. Albans ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            464 => 
            array (
                'id' => 1465,
                'state_id' => 91,
                'name_ar' => 'Bluefield ',
                'name_en' => 'Bluefield ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            465 => 
            array (
                'id' => 1466,
                'state_id' => 91,
                'name_ar' => 'West Virginia-Others ',
                'name_en' => 'West Virginia-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            466 => 
            array (
                'id' => 1467,
                'state_id' => 92,
                'name_ar' => 'Boise ',
                'name_en' => 'Boise ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            467 => 
            array (
                'id' => 1468,
                'state_id' => 92,
                'name_ar' => 'Meridian ',
                'name_en' => 'Meridian ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            468 => 
            array (
                'id' => 1469,
                'state_id' => 92,
                'name_ar' => 'Nampa ',
                'name_en' => 'Nampa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            469 => 
            array (
                'id' => 1470,
                'state_id' => 92,
                'name_ar' => 'Idaho Falls ',
                'name_en' => 'Idaho Falls ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            470 => 
            array (
                'id' => 1471,
                'state_id' => 92,
                'name_ar' => 'Pocatello ',
                'name_en' => 'Pocatello ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            471 => 
            array (
                'id' => 1472,
                'state_id' => 92,
                'name_ar' => 'Caldwell ',
                'name_en' => 'Caldwell ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            472 => 
            array (
                'id' => 1473,
                'state_id' => 92,
                'name_ar' => 'Coeur d Alene ',
                'name_en' => 'Coeur d Alene ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            473 => 
            array (
                'id' => 1474,
                'state_id' => 92,
                'name_ar' => 'Twin Falls ',
                'name_en' => 'Twin Falls ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            474 => 
            array (
                'id' => 1475,
                'state_id' => 92,
                'name_ar' => 'Post Falls ',
                'name_en' => 'Post Falls ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            475 => 
            array (
                'id' => 1476,
                'state_id' => 92,
                'name_ar' => 'Lewiston ',
                'name_en' => 'Lewiston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            476 => 
            array (
                'id' => 1477,
                'state_id' => 92,
                'name_ar' => 'Idaho-Others ',
                'name_en' => 'Idaho-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            477 => 
            array (
                'id' => 1478,
                'state_id' => 93,
                'name_ar' => 'Honolulu ',
                'name_en' => 'Honolulu ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            478 => 
            array (
                'id' => 1479,
                'state_id' => 93,
                'name_ar' => 'Hawaii-Others ',
                'name_en' => 'Hawaii-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            479 => 
            array (
                'id' => 1480,
                'state_id' => 94,
                'name_ar' => 'Concord ',
                'name_en' => 'Concord ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            480 => 
            array (
                'id' => 1481,
                'state_id' => 94,
                'name_ar' => 'Manchester ',
                'name_en' => 'Manchester ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            481 => 
            array (
                'id' => 1482,
                'state_id' => 94,
                'name_ar' => 'Nashua ',
                'name_en' => 'Nashua ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            482 => 
            array (
                'id' => 1483,
                'state_id' => 94,
                'name_ar' => 'Portsmouth ',
                'name_en' => 'Portsmouth ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            483 => 
            array (
                'id' => 1484,
                'state_id' => 94,
                'name_ar' => 'Keene ',
                'name_en' => 'Keene ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            484 => 
            array (
                'id' => 1485,
                'state_id' => 94,
                'name_ar' => 'Laconia ',
                'name_en' => 'Laconia ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            485 => 
            array (
                'id' => 1486,
                'state_id' => 94,
                'name_ar' => 'Lebanon ',
                'name_en' => 'Lebanon ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            486 => 
            array (
                'id' => 1487,
                'state_id' => 94,
                'name_ar' => 'New Hampshire-Others ',
                'name_en' => 'New Hampshire-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            487 => 
            array (
                'id' => 1488,
                'state_id' => 95,
                'name_ar' => 'Augusta ',
                'name_en' => 'Augusta ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            488 => 
            array (
                'id' => 1489,
                'state_id' => 95,
                'name_ar' => 'Portland ',
                'name_en' => 'Portland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            489 => 
            array (
                'id' => 1490,
                'state_id' => 95,
                'name_ar' => 'Lewiston ',
                'name_en' => 'Lewiston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            490 => 
            array (
                'id' => 1491,
                'state_id' => 95,
                'name_ar' => 'Bangor ',
                'name_en' => 'Bangor ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            491 => 
            array (
                'id' => 1492,
                'state_id' => 95,
                'name_ar' => 'South Portland ',
                'name_en' => 'South Portland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            492 => 
            array (
                'id' => 1493,
                'state_id' => 95,
                'name_ar' => 'Auburn ',
                'name_en' => 'Auburn ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            493 => 
            array (
                'id' => 1494,
                'state_id' => 95,
                'name_ar' => 'Biddeford ',
                'name_en' => 'Biddeford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            494 => 
            array (
                'id' => 1495,
                'state_id' => 95,
                'name_ar' => 'Brunswick ',
                'name_en' => 'Brunswick ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            495 => 
            array (
                'id' => 1496,
                'state_id' => 95,
                'name_ar' => 'Saco ',
                'name_en' => 'Saco ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            496 => 
            array (
                'id' => 1497,
                'state_id' => 95,
                'name_ar' => 'Scarborough ',
                'name_en' => 'Scarborough ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            497 => 
            array (
                'id' => 1498,
                'state_id' => 95,
                'name_ar' => 'Westbrook ',
                'name_en' => 'Westbrook ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            498 => 
            array (
                'id' => 1499,
                'state_id' => 95,
                'name_ar' => 'Windham ',
                'name_en' => 'Windham ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            499 => 
            array (
                'id' => 1500,
                'state_id' => 95,
                'name_ar' => 'Waterville ',
                'name_en' => 'Waterville ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        \DB::table('cities')->insert(array (
            0 => 
            array (
                'id' => 1501,
                'state_id' => 95,
                'name_ar' => 'Maine-Others ',
                'name_en' => 'Maine-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 1502,
                'state_id' => 96,
                'name_ar' => 'Helena ',
                'name_en' => 'Helena ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 1503,
                'state_id' => 96,
                'name_ar' => 'Billings ',
                'name_en' => 'Billings ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 1504,
                'state_id' => 96,
                'name_ar' => 'Missoula ',
                'name_en' => 'Missoula ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 1505,
                'state_id' => 96,
                'name_ar' => 'Great Falls ',
                'name_en' => 'Great Falls ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 1506,
                'state_id' => 96,
                'name_ar' => 'Bozeman ',
                'name_en' => 'Bozeman ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 1507,
                'state_id' => 96,
                'name_ar' => 'Butte ',
                'name_en' => 'Butte ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 1508,
                'state_id' => 96,
                'name_ar' => 'Kalispell ',
                'name_en' => 'Kalispell ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 1509,
                'state_id' => 96,
                'name_ar' => 'Havre ',
                'name_en' => 'Havre ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 1510,
                'state_id' => 96,
                'name_ar' => 'Montana-Others ',
                'name_en' => 'Montana-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 1511,
                'state_id' => 97,
                'name_ar' => 'Providence ',
                'name_en' => 'Providence ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 1512,
                'state_id' => 97,
                'name_ar' => 'Warwick ',
                'name_en' => 'Warwick ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 1513,
                'state_id' => 97,
                'name_ar' => 'Cranston ',
                'name_en' => 'Cranston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 1514,
                'state_id' => 97,
                'name_ar' => 'Pawtucket ',
                'name_en' => 'Pawtucket ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 1515,
                'state_id' => 97,
                'name_ar' => 'East Providence ',
                'name_en' => 'East Providence ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 1516,
                'state_id' => 97,
                'name_ar' => 'Woonsocket ',
                'name_en' => 'Woonsocket ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 1517,
                'state_id' => 97,
                'name_ar' => 'Coventy ',
                'name_en' => 'Coventy ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 1518,
                'state_id' => 97,
                'name_ar' => 'Cumberland ',
                'name_en' => 'Cumberland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 1519,
                'state_id' => 97,
                'name_ar' => 'North Providence ',
                'name_en' => 'North Providence ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 1520,
                'state_id' => 97,
                'name_ar' => 'South Kingstown ',
                'name_en' => 'South Kingstown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 1521,
                'state_id' => 97,
                'name_ar' => 'Johnston ',
                'name_en' => 'Johnston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 1522,
                'state_id' => 97,
                'name_ar' => 'Rhode Island-Others ',
                'name_en' => 'Rhode Island-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 1523,
                'state_id' => 98,
                'name_ar' => 'Dover ',
                'name_en' => 'Dover ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 1524,
                'state_id' => 98,
                'name_ar' => 'Wilmington ',
                'name_en' => 'Wilmington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 1525,
                'state_id' => 98,
                'name_ar' => 'Delaware City ',
                'name_en' => 'Delaware City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 1526,
                'state_id' => 98,
                'name_ar' => 'harrington ',
                'name_en' => 'harrington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 1527,
                'state_id' => 98,
                'name_ar' => 'Middletown ',
                'name_en' => 'Middletown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 1528,
                'state_id' => 98,
                'name_ar' => 'Milford ',
                'name_en' => 'Milford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 1529,
                'state_id' => 98,
                'name_ar' => 'New Castle ',
                'name_en' => 'New Castle ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 1530,
                'state_id' => 98,
                'name_ar' => 'Newark ',
                'name_en' => 'Newark ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 1531,
                'state_id' => 98,
                'name_ar' => 'Frankford ',
                'name_en' => 'Frankford ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 1532,
                'state_id' => 98,
                'name_ar' => 'Claymont ',
                'name_en' => 'Claymont ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 1533,
                'state_id' => 98,
                'name_ar' => 'Delaware-Others ',
                'name_en' => 'Delaware-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 1534,
                'state_id' => 99,
                'name_ar' => 'Pierre ',
                'name_en' => 'Pierre ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 1535,
                'state_id' => 99,
                'name_ar' => 'Sioux Falls ',
                'name_en' => 'Sioux Falls ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 1536,
                'state_id' => 99,
                'name_ar' => 'Rapid City ',
                'name_en' => 'Rapid City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 1537,
                'state_id' => 99,
                'name_ar' => 'Aberdeen ',
                'name_en' => 'Aberdeen ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 1538,
                'state_id' => 99,
                'name_ar' => 'Brookings ',
                'name_en' => 'Brookings ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 1539,
                'state_id' => 99,
                'name_ar' => 'South Dakota-Others ',
                'name_en' => 'South Dakota-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 1540,
                'state_id' => 100,
                'name_ar' => 'Bismarck ',
                'name_en' => 'Bismarck ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 1541,
                'state_id' => 100,
                'name_ar' => 'Fargo ',
                'name_en' => 'Fargo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 1542,
                'state_id' => 100,
                'name_ar' => 'Grand Forks ',
                'name_en' => 'Grand Forks ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 1543,
                'state_id' => 100,
                'name_ar' => 'Minot ',
                'name_en' => 'Minot ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 1544,
                'state_id' => 100,
                'name_ar' => 'West Fargo ',
                'name_en' => 'West Fargo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 1545,
                'state_id' => 100,
                'name_ar' => 'Williston ',
                'name_en' => 'Williston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 1546,
                'state_id' => 100,
                'name_ar' => 'Dickinson ',
                'name_en' => 'Dickinson ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 1547,
                'state_id' => 100,
                'name_ar' => 'Mandan ',
                'name_en' => 'Mandan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 1548,
                'state_id' => 100,
                'name_ar' => 'Jamestown ',
                'name_en' => 'Jamestown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 1549,
                'state_id' => 100,
                'name_ar' => 'North Dakota-Others ',
                'name_en' => 'North Dakota-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 1550,
                'state_id' => 101,
                'name_ar' => 'Juneau ',
                'name_en' => 'Juneau ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 1551,
                'state_id' => 101,
                'name_ar' => 'Anchorage ',
                'name_en' => 'Anchorage ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 1552,
                'state_id' => 101,
                'name_ar' => 'Fairbanks ',
                'name_en' => 'Fairbanks ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 1553,
                'state_id' => 101,
                'name_ar' => 'Sitka ',
                'name_en' => 'Sitka ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 1554,
                'state_id' => 101,
                'name_ar' => 'Ketchikan ',
                'name_en' => 'Ketchikan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 1555,
                'state_id' => 101,
                'name_ar' => 'Alaska-Others ',
                'name_en' => 'Alaska-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 1556,
                'state_id' => 102,
                'name_ar' => 'Montpelier ',
                'name_en' => 'Montpelier ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 1557,
                'state_id' => 102,
                'name_ar' => 'Burlington ',
                'name_en' => 'Burlington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 1558,
                'state_id' => 102,
                'name_ar' => 'South Burlington ',
                'name_en' => 'South Burlington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 1559,
                'state_id' => 102,
                'name_ar' => 'Rutland ',
                'name_en' => 'Rutland ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 1560,
                'state_id' => 102,
                'name_ar' => 'Barre ',
                'name_en' => 'Barre ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 1561,
                'state_id' => 102,
                'name_ar' => 'Vermont-Others ',
                'name_en' => 'Vermont-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 1562,
                'state_id' => 103,
                'name_ar' => 'Cheyenne ',
                'name_en' => 'Cheyenne ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 1563,
                'state_id' => 103,
                'name_ar' => 'Casper ',
                'name_en' => 'Casper ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 1564,
                'state_id' => 103,
                'name_ar' => 'Evanston ',
                'name_en' => 'Evanston ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 1565,
                'state_id' => 103,
                'name_ar' => 'Laramie ',
                'name_en' => 'Laramie ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 1566,
                'state_id' => 103,
                'name_ar' => 'Gillette ',
                'name_en' => 'Gillette ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 1567,
                'state_id' => 103,
                'name_ar' => 'Rock Spring ',
                'name_en' => 'Rock Spring ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 1568,
                'state_id' => 103,
                'name_ar' => 'Sheridan ',
                'name_en' => 'Sheridan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 1569,
                'state_id' => 103,
                'name_ar' => 'Wyoming-Others ',
                'name_en' => 'Wyoming-Others ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 1570,
                'state_id' => 108,
                'name_ar' => 'الفحيحيل ',
                'name_en' => 'Al-Fahaheel  ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 1571,
                'state_id' => 108,
                'name_ar' => 'العقيلة ',
                'name_en' => 'Al-Egaila ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 1572,
                'state_id' => 108,
                'name_ar' => 'المهبولة ',
                'name_en' => 'Mahboula ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 1573,
                'state_id' => 108,
                'name_ar' => 'فهد الأحمد ',
                'name_en' => 'Fahad Al Ahmad ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 1574,
                'state_id' => 108,
                'name_ar' => 'المنقف ',
                'name_en' => 'Mangaf ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 1575,
                'state_id' => 108,
                'name_ar' => 'الرقة ',
                'name_en' => 'Riqqa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 1576,
                'state_id' => 108,
                'name_ar' => 'صباح السالم ',
                'name_en' => 'Sabah Al Salem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 1577,
                'state_id' => 108,
                'name_ar' => 'ميناء العبد الله ',
                'name_en' => 'Mina Abdullah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 1578,
                'state_id' => 108,
                'name_ar' => 'ميناء الأحمدي ',
                'name_en' => 'Mina Al Ahmadi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 1579,
                'state_id' => 108,
                'name_ar' => 'ميناء الشعيبة ',
                'name_en' => 'Mina Shuaiba ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 1580,
                'state_id' => 108,
                'name_ar' => 'علي صباح السالم ',
                'name_en' => 'Ali Sabah Al Salem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 1581,
                'state_id' => 108,
                'name_ar' => 'جابر العلي ',
                'name_en' => 'Jaber Al Ali ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 1582,
                'state_id' => 108,
                'name_ar' => 'الفنطاس ',
                'name_en' => 'Al Fintas ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 1583,
                'state_id' => 108,
                'name_ar' => 'هدية ',
                'name_en' => 'Hadiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 1584,
                'state_id' => 108,
                'name_ar' => 'الصباحية ',
                'name_en' => 'Al-Sabahiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 1585,
                'state_id' => 108,
                'name_ar' => 'الأحمدي ',
                'name_en' => 'Al Ahmadi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 1586,
                'state_id' => 108,
                'name_ar' => 'أبو حليفة ',
                'name_en' => 'Abu Hulifa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 1587,
                'state_id' => 109,
                'name_ar' => 'صباح السالم ',
                'name_en' => 'Sabah Al-Salim ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 1588,
                'state_id' => 109,
                'name_ar' => 'أبو الحصانية ',
                'name_en' => 'Abu Hasaniya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 1589,
                'state_id' => 109,
                'name_ar' => 'أبو فطيرة ',
                'name_en' => 'Abu Ftaira ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 1590,
                'state_id' => 109,
                'name_ar' => 'العدان ',
                'name_en' => 'Adan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 1591,
                'state_id' => 109,
                'name_ar' => 'الفنيطيس ',
                'name_en' => 'Fnaitees ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 1592,
                'state_id' => 109,
                'name_ar' => 'الوسطى ',
                'name_en' => 'Al Wista ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 1593,
                'state_id' => 109,
                'name_ar' => 'القصور ',
                'name_en' => 'Al Qusour ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 1594,
                'state_id' => 109,
                'name_ar' => 'صبحان ',
                'name_en' => 'Sabhan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 1595,
                'state_id' => 109,
                'name_ar' => 'المسيلة ',
                'name_en' => 'Messila ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 1596,
                'state_id' => 109,
                'name_ar' => 'القرين ',
                'name_en' => 'Al Qurain ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 1597,
                'state_id' => 110,
                'name_ar' => 'الفروانية ',
                'name_en' => 'Farwaniya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 1598,
                'state_id' => 110,
                'name_ar' => 'العباسية ',
                'name_en' => 'Abbasiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 1599,
                'state_id' => 110,
                'name_ar' => 'عبد الله المبارك ',
                'name_en' => 'Abdullah Al Mubarak ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 1600,
                'state_id' => 110,
                'name_ar' => 'أبرق خيطان ',
                'name_en' => 'Abraq Khaitan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 1601,
                'state_id' => 110,
                'name_ar' => 'الضجيج ',
                'name_en' => 'Al Dhajeej ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 1602,
                'state_id' => 110,
                'name_ar' => 'الفردوس ',
                'name_en' => 'Al Firdous ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 1603,
                'state_id' => 110,
                'name_ar' => 'النهضة ',
                'name_en' => 'Al Nahdha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 1604,
                'state_id' => 110,
                'name_ar' => 'العمرية ',
                'name_en' => 'Al Omariya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 1605,
                'state_id' => 110,
                'name_ar' => 'الرابية ',
                'name_en' => 'Al Rabiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 1606,
                'state_id' => 110,
                'name_ar' => 'الري ',
                'name_en' => 'Al Rai ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 1607,
                'state_id' => 110,
                'name_ar' => 'الرقعي ',
                'name_en' => 'Al Reggai ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 1608,
                'state_id' => 110,
                'name_ar' => 'الرحاب ',
                'name_en' => 'Al Rehab ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 1609,
                'state_id' => 110,
                'name_ar' => 'الأندلس ',
                'name_en' => 'Andalous ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 1610,
                'state_id' => 110,
                'name_ar' => 'العارضية ',
                'name_en' => 'Ardhiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 1611,
                'state_id' => 110,
                'name_ar' => 'إشبيلية ',
                'name_en' => 'Ishbiliya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 1612,
                'state_id' => 110,
                'name_ar' => 'جليب الشيوخ ',
                'name_en' => 'Jleeb Al Shuyoukh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 1613,
                'state_id' => 110,
                'name_ar' => 'خيطان ',
                'name_en' => 'Khaitan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 1614,
                'state_id' => 110,
                'name_ar' => 'صباح الناصر ',
                'name_en' => 'Sabah Al Nasser ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 1615,
                'state_id' => 110,
                'name_ar' => ' ',
                'name_en' => ' ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 1616,
                'state_id' => 111,
                'name_ar' => 'القيروان ',
                'name_en' => 'Al Qairawan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 1617,
                'state_id' => 111,
                'name_ar' => 'النسيم ',
                'name_en' => 'Al Nasseem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 1618,
                'state_id' => 111,
                'name_ar' => 'العيون ',
                'name_en' => 'Al Oyoun ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 1619,
                'state_id' => 111,
                'name_ar' => 'الواحة ',
                'name_en' => 'Al Waha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 1620,
                'state_id' => 111,
                'name_ar' => 'الصليبية ',
                'name_en' => 'Al Sulaibiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 1621,
                'state_id' => 111,
                'name_ar' => 'الجهراء ',
                'name_en' => 'Al Jahra ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 1622,
                'state_id' => 112,
                'name_ar' => 'حطين ',
                'name_en' => 'Hitteen ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 1623,
                'state_id' => 112,
                'name_ar' => 'الشعب ',
                'name_en' => 'Al Shaab ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 1624,
                'state_id' => 112,
                'name_ar' => 'السلام ',
                'name_en' => 'Al Salam ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 1625,
                'state_id' => 112,
                'name_ar' => 'الصديق ',
                'name_en' => 'Al Siddeeq ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 1626,
                'state_id' => 112,
                'name_ar' => 'الرميثية ',
                'name_en' => 'Rumaithiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 1627,
                'state_id' => 112,
                'name_ar' => 'بيان ',
                'name_en' => 'Bayan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 1628,
                'state_id' => 112,
                'name_ar' => 'البدع ',
                'name_en' => 'Al Bedae ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 1629,
                'state_id' => 112,
                'name_ar' => 'الجابرية ',
                'name_en' => 'Jabriya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 1630,
                'state_id' => 112,
                'name_ar' => 'مشرف ',
                'name_en' => 'Mishref ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 1631,
                'state_id' => 112,
                'name_ar' => 'مبارك العبد الله ',
                'name_en' => 'Mubarak Al Abdullah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 1632,
                'state_id' => 112,
                'name_ar' => 'الزهراء ',
                'name_en' => 'Al Zahra ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 1633,
                'state_id' => 112,
                'name_ar' => 'السالمية ',
                'name_en' => 'Al Salmiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 1634,
                'state_id' => 112,
                'name_ar' => 'سلوى ',
                'name_en' => 'Salwa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 1635,
                'state_id' => 112,
                'name_ar' => 'ميدان حولي ',
                'name_en' => 'Maidan Hawalii ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 1636,
                'state_id' => 112,
                'name_ar' => 'صفاة ',
                'name_en' => 'Safat ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 1637,
                'state_id' => 112,
                'name_ar' => 'حولي ',
                'name_en' => 'Hawali ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 1638,
                'state_id' => 113,
                'name_ar' => 'السالمية ',
                'name_en' => 'Salmiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 1639,
                'state_id' => 113,
                'name_ar' => 'العديلية ',
                'name_en' => 'Al Adailiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 1640,
                'state_id' => 113,
                'name_ar' => 'الدعية ',
                'name_en' => 'Al Daiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 1641,
                'state_id' => 113,
                'name_ar' => 'القبلة ',
                'name_en' => 'Al Qibla ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 1642,
                'state_id' => 113,
                'name_ar' => 'الروضة ',
                'name_en' => 'Al Rawda ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 1643,
                'state_id' => 113,
                'name_ar' => 'الشامية ',
                'name_en' => 'Al Shamiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 1644,
                'state_id' => 113,
                'name_ar' => 'الشرق ',
                'name_en' => 'Al Sharq ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 1645,
                'state_id' => 113,
                'name_ar' => 'الشهداء ',
                'name_en' => 'Al Shuhada ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 1646,
                'state_id' => 113,
                'name_ar' => 'الشويخ ',
                'name_en' => 'Al Shuwaikh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 1647,
                'state_id' => 113,
                'name_ar' => 'الصليبيخات ',
                'name_en' => 'Al Sulaibikhat ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 1648,
                'state_id' => 113,
                'name_ar' => 'السرة ',
                'name_en' => 'Al Surra ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 1649,
                'state_id' => 113,
                'name_ar' => 'اليرموك ',
                'name_en' => 'Al Yarmouk ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 1650,
                'state_id' => 113,
                'name_ar' => 'بنيد القار ',
                'name_en' => 'Bneid Al Gar ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 1651,
                'state_id' => 113,
                'name_ar' => 'دسمان ',
                'name_en' => 'Dasman ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 1652,
                'state_id' => 113,
                'name_ar' => 'غرناطة ',
                'name_en' => 'Granada ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 1653,
                'state_id' => 113,
                'name_ar' => 'كيفان ',
                'name_en' => 'Kaifan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 1654,
                'state_id' => 113,
                'name_ar' => 'الخالدية ',
                'name_en' => 'Khaldiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 1655,
                'state_id' => 113,
                'name_ar' => 'المباركية ',
                'name_en' => 'Mubarakiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 1656,
                'state_id' => 113,
                'name_ar' => 'قرطبة ',
                'name_en' => 'Qortuba ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 1657,
                'state_id' => 113,
                'name_ar' => 'الصالحية ',
                'name_en' => 'Al Salhiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 1658,
                'state_id' => 113,
                'name_ar' => 'عبد الله السالم ',
                'name_en' => 'Abdullah Al Salem ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 1659,
                'state_id' => 113,
                'name_ar' => 'الفيحاء ',
                'name_en' => 'Al Faiha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 1660,
                'state_id' => 113,
                'name_ar' => 'الدوحة ',
                'name_en' => 'Al Doha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 1661,
                'state_id' => 113,
                'name_ar' => 'الدسمة ',
                'name_en' => 'Al Dasma ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 1662,
                'state_id' => 113,
                'name_ar' => 'المرقاب ',
                'name_en' => 'Al Mirqab ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 1663,
                'state_id' => 113,
                'name_ar' => 'المنصورية ',
                'name_en' => 'Al Mansouriya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 1664,
                'state_id' => 113,
                'name_ar' => 'القادسية ',
                'name_en' => 'Al Qadisiya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 1665,
                'state_id' => 113,
                'name_ar' => 'النزهة ',
                'name_en' => 'Al Nuzha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 1666,
                'state_id' => 114,
                'name_ar' => 'Karen ',
                'name_en' => 'Karen ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 1667,
                'state_id' => 114,
                'name_ar' => 'Kileleshwa ',
                'name_en' => 'Kileleshwa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 1668,
                'state_id' => 114,
                'name_ar' => 'Kilimani ',
                'name_en' => 'Kilimani ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 1669,
                'state_id' => 114,
                'name_ar' => 'Kitisuru ',
                'name_en' => 'Kitisuru ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 1670,
                'state_id' => 114,
                'name_ar' => 'Muthaiga ',
                'name_en' => 'Muthaiga ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 1671,
                'state_id' => 114,
                'name_ar' => 'Nairobi CBD ',
                'name_en' => 'Nairobi CBD ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 1672,
                'state_id' => 114,
                'name_ar' => 'Runda-Gigiri ',
                'name_en' => 'Runda-Gigiri ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 1673,
                'state_id' => 114,
                'name_ar' => 'Parklands-Highridge ',
                'name_en' => 'Parklands-Highridge ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 1674,
                'state_id' => 114,
                'name_ar' => 'Athi River ',
                'name_en' => 'Athi River ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 1675,
                'state_id' => 114,
                'name_ar' => 'Dagoreti ',
                'name_en' => 'Dagoreti ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 1676,
                'state_id' => 114,
                'name_ar' => 'Dandora ',
                'name_en' => 'Dandora ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 1677,
                'state_id' => 114,
                'name_ar' => 'Eastleigh ',
                'name_en' => 'Eastleigh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 1678,
                'state_id' => 114,
                'name_ar' => 'Embakasi ',
                'name_en' => 'Embakasi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 1679,
                'state_id' => 114,
                'name_ar' => 'Garden Estate-Thome ',
                'name_en' => 'Garden Estate-Thome ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 1680,
                'state_id' => 114,
                'name_ar' => 'Githurai ',
                'name_en' => 'Githurai ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 1681,
                'state_id' => 114,
                'name_ar' => 'Golf Course ',
                'name_en' => 'Golf Course ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 1682,
                'state_id' => 114,
                'name_ar' => 'Hamza ',
                'name_en' => 'Hamza ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 1683,
                'state_id' => 114,
                'name_ar' => 'Hurlingham ',
                'name_en' => 'Hurlingham ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 1684,
                'state_id' => 114,
                'name_ar' => 'Imara Daima ',
                'name_en' => 'Imara Daima ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 1685,
                'state_id' => 114,
                'name_ar' => 'Juja ',
                'name_en' => 'Juja ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 1686,
                'state_id' => 114,
                'name_ar' => 'Kahawa ',
                'name_en' => 'Kahawa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 1687,
                'state_id' => 114,
                'name_ar' => 'Kangemi ',
                'name_en' => 'Kangemi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 1688,
                'state_id' => 114,
                'name_ar' => 'Kariobangi ',
                'name_en' => 'Kariobangi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 1689,
                'state_id' => 114,
                'name_ar' => 'Kasarani-Mwiki ',
                'name_en' => 'Kasarani-Mwiki ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 1690,
                'state_id' => 114,
                'name_ar' => 'Kawangware ',
                'name_en' => 'Kawangware ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 1691,
                'state_id' => 114,
                'name_ar' => 'Kayole ',
                'name_en' => 'Kayole ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 1692,
                'state_id' => 114,
                'name_ar' => 'Kenol ',
                'name_en' => 'Kenol ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 1693,
                'state_id' => 114,
                'name_ar' => 'Kenyatta National Hospital ',
                'name_en' => 'Kenyatta National Hospital ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 1694,
                'state_id' => 114,
                'name_ar' => 'Kiambu ',
                'name_en' => 'Kiambu ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 1695,
                'state_id' => 114,
                'name_ar' => 'Kikuyu ',
                'name_en' => 'Kikuyu ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 1696,
                'state_id' => 114,
                'name_ar' => 'Kitengela ',
                'name_en' => 'Kitengela ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 1697,
                'state_id' => 114,
                'name_ar' => 'Komarock ',
                'name_en' => 'Komarock ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 1698,
                'state_id' => 114,
                'name_ar' => 'Langata ',
                'name_en' => 'Langata ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 1699,
                'state_id' => 114,
                'name_ar' => 'Lavington ',
                'name_en' => 'Lavington ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 1700,
                'state_id' => 114,
                'name_ar' => 'Limuru ',
                'name_en' => 'Limuru ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 1701,
                'state_id' => 114,
                'name_ar' => 'Loresho ',
                'name_en' => 'Loresho ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 1702,
                'state_id' => 114,
                'name_ar' => 'Machakos ',
                'name_en' => 'Machakos ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 1703,
                'state_id' => 114,
                'name_ar' => 'Mlolongo ',
                'name_en' => 'Mlolongo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 1704,
                'state_id' => 114,
                'name_ar' => 'Mombasa Road ',
                'name_en' => 'Mombasa Road ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 1705,
                'state_id' => 114,
                'name_ar' => 'Mountain View ',
                'name_en' => 'Mountain View ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 1706,
                'state_id' => 114,
                'name_ar' => 'Muranga ',
                'name_en' => 'Muranga ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 1707,
                'state_id' => 114,
                'name_ar' => 'Nairobi West ',
                'name_en' => 'Nairobi West ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 1708,
                'state_id' => 114,
                'name_ar' => 'Ngara ',
                'name_en' => 'Ngara ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 1709,
                'state_id' => 114,
                'name_ar' => 'Ngong ',
                'name_en' => 'Ngong ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 1710,
                'state_id' => 114,
                'name_ar' => 'Ngong Road ',
                'name_en' => 'Ngong Road ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 1711,
                'state_id' => 114,
                'name_ar' => 'Ngumba ',
                'name_en' => 'Ngumba ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 1712,
                'state_id' => 114,
                'name_ar' => 'Njiru-Ruai ',
                'name_en' => 'Njiru-Ruai ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 1713,
                'state_id' => 114,
                'name_ar' => 'Nyayo Highrise ',
                'name_en' => 'Nyayo Highrise ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 1714,
                'state_id' => 114,
                'name_ar' => 'Pangani ',
                'name_en' => 'Pangani ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 1715,
                'state_id' => 114,
                'name_ar' => 'Pipeline ',
                'name_en' => 'Pipeline ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 1716,
                'state_id' => 114,
                'name_ar' => 'Rongai ',
                'name_en' => 'Rongai ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 1717,
                'state_id' => 114,
                'name_ar' => 'Roysambu ',
                'name_en' => 'Roysambu ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 1718,
                'state_id' => 114,
                'name_ar' => 'Ruiru ',
                'name_en' => 'Ruiru ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 1719,
                'state_id' => 114,
                'name_ar' => 'Savanna ',
                'name_en' => 'Savanna ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 1720,
                'state_id' => 114,
                'name_ar' => 'South B ',
                'name_en' => 'South B ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 1721,
                'state_id' => 114,
                'name_ar' => 'South C ',
                'name_en' => 'South C ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 1722,
                'state_id' => 114,
                'name_ar' => 'Syokimau ',
                'name_en' => 'Syokimau ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 1723,
                'state_id' => 114,
                'name_ar' => 'Thika ',
                'name_en' => 'Thika ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 1724,
                'state_id' => 114,
                'name_ar' => 'Umoja ',
                'name_en' => 'Umoja ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 1725,
                'state_id' => 114,
                'name_ar' => 'Upper Hill ',
                'name_en' => 'Upper Hill ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 1726,
                'state_id' => 114,
                'name_ar' => 'Utawala ',
                'name_en' => 'Utawala ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 1727,
                'state_id' => 114,
                'name_ar' => 'Uthiru ',
                'name_en' => 'Uthiru ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 1728,
                'state_id' => 114,
                'name_ar' => 'Westlands ',
                'name_en' => 'Westlands ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 1729,
                'state_id' => 114,
                'name_ar' => 'Zimmerman ',
                'name_en' => 'Zimmerman ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 1730,
                'state_id' => 115,
                'name_ar' => 'Kwale ',
                'name_en' => 'Kwale ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 1731,
                'state_id' => 115,
                'name_ar' => 'Kilifi ',
                'name_en' => 'Kilifi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 1732,
                'state_id' => 115,
                'name_ar' => 'Malindi ',
                'name_en' => 'Malindi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 1733,
                'state_id' => 115,
                'name_ar' => 'Likoni ',
                'name_en' => 'Likoni ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 1734,
                'state_id' => 115,
                'name_ar' => 'Kisauni ',
                'name_en' => 'Kisauni ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 1735,
                'state_id' => 115,
                'name_ar' => 'Kongowea ',
                'name_en' => 'Kongowea ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 1736,
                'state_id' => 115,
                'name_ar' => 'Mtwapa ',
                'name_en' => 'Mtwapa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 1737,
                'state_id' => 115,
                'name_ar' => 'Mtongwe ',
                'name_en' => 'Mtongwe ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 1738,
                'state_id' => 115,
                'name_ar' => 'Nyali ',
                'name_en' => 'Nyali ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 1739,
                'state_id' => 115,
                'name_ar' => 'Mombasa CBD ',
                'name_en' => 'Mombasa CBD ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 1740,
                'state_id' => 116,
                'name_ar' => 'Nyahururu ',
                'name_en' => 'Nyahururu ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            240 => 
            array (
                'id' => 1741,
                'state_id' => 116,
                'name_ar' => 'Eldoret ',
                'name_en' => 'Eldoret ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            241 => 
            array (
                'id' => 1742,
                'state_id' => 116,
                'name_ar' => 'Baringo ',
                'name_en' => 'Baringo ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            242 => 
            array (
                'id' => 1743,
                'state_id' => 116,
                'name_ar' => 'Nakuru ',
                'name_en' => 'Nakuru ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            243 => 
            array (
                'id' => 1744,
                'state_id' => 116,
                'name_ar' => 'Naivasha ',
                'name_en' => 'Naivasha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            244 => 
            array (
                'id' => 1745,
                'state_id' => 116,
                'name_ar' => 'Narok ',
                'name_en' => 'Narok ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            245 => 
            array (
                'id' => 1746,
                'state_id' => 116,
                'name_ar' => 'Kericho ',
                'name_en' => 'Kericho ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            246 => 
            array (
                'id' => 1747,
                'state_id' => 117,
                'name_ar' => 'Meru ',
                'name_en' => 'Meru ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            247 => 
            array (
                'id' => 1748,
                'state_id' => 117,
                'name_ar' => 'Embu ',
                'name_en' => 'Embu ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            248 => 
            array (
                'id' => 1749,
                'state_id' => 117,
                'name_ar' => 'Kitui ',
                'name_en' => 'Kitui ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            249 => 
            array (
                'id' => 1750,
                'state_id' => 118,
                'name_ar' => 'Nyeri ',
                'name_en' => 'Nyeri ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            250 => 
            array (
                'id' => 1751,
                'state_id' => 118,
                'name_ar' => 'Kerugoya ',
                'name_en' => 'Kerugoya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            251 => 
            array (
                'id' => 1752,
                'state_id' => 118,
                'name_ar' => 'Kirinyaga ',
                'name_en' => 'Kirinyaga ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            252 => 
            array (
                'id' => 1753,
                'state_id' => 119,
                'name_ar' => 'Kakamega ',
                'name_en' => 'Kakamega ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            253 => 
            array (
                'id' => 1754,
                'state_id' => 119,
                'name_ar' => 'Kisumu ',
                'name_en' => 'Kisumu ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            254 => 
            array (
                'id' => 1755,
                'state_id' => 119,
                'name_ar' => 'Homabay ',
                'name_en' => 'Homabay ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            255 => 
            array (
                'id' => 1756,
                'state_id' => 119,
                'name_ar' => 'Migori ',
                'name_en' => 'Migori ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            256 => 
            array (
                'id' => 1757,
                'state_id' => 119,
                'name_ar' => 'Kisii ',
                'name_en' => 'Kisii ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            257 => 
            array (
                'id' => 1758,
                'state_id' => 119,
                'name_ar' => 'Nyamira ',
                'name_en' => 'Nyamira ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            258 => 
            array (
                'id' => 1759,
                'state_id' => 119,
                'name_ar' => 'Bungoma ',
                'name_en' => 'Bungoma ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            259 => 
            array (
                'id' => 1760,
                'state_id' => 119,
                'name_ar' => 'Siaya ',
                'name_en' => 'Siaya ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            260 => 
            array (
                'id' => 1761,
                'state_id' => 119,
                'name_ar' => 'Webuye ',
                'name_en' => 'Webuye ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            261 => 
            array (
                'id' => 1762,
                'state_id' => 120,
                'name_ar' => 'ميناء-العقبة ',
                'name_en' => 'Port-of-aqaba ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            262 => 
            array (
                'id' => 1763,
                'state_id' => 120,
                'name_ar' => 'وسط-المدينة ',
                'name_en' => 'City-centre ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            263 => 
            array (
                'id' => 1764,
                'state_id' => 121,
                'name_ar' => 'الدوار-الخامس ',
                'name_en' => 'FIfth-Circle ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            264 => 
            array (
                'id' => 1765,
                'state_id' => 121,
                'name_ar' => 'الهاشمي-الشمالي ',
                'name_en' => 'Northern-Hashmi ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            265 => 
            array (
                'id' => 1766,
                'state_id' => 121,
                'name_ar' => 'المدينة-الطبية ',
                'name_en' => 'Medical-City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            266 => 
            array (
                'id' => 1767,
                'state_id' => 121,
                'name_ar' => 'ابن-خلدون ',
                'name_en' => 'Iben-Khaldoun ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            267 => 
            array (
                'id' => 1768,
                'state_id' => 121,
                'name_ar' => 'بيادر-وادي-السير ',
                'name_en' => 'Biyadr Wadi Al-Sayr ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            268 => 
            array (
                'id' => 1769,
                'state_id' => 121,
                'name_ar' => 'العبدلي ',
                'name_en' => 'Al-Abdali ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            269 => 
            array (
                'id' => 1770,
                'state_id' => 121,
                'name_ar' => 'خلدا ',
                'name_en' => 'Khalda ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            270 => 
            array (
                'id' => 1771,
                'state_id' => 121,
                'name_ar' => 'الرابية ',
                'name_en' => 'Al-Rabyah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            271 => 
            array (
                'id' => 1772,
                'state_id' => 121,
                'name_ar' => 'صويفية ',
                'name_en' => 'Suwayfiyah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            272 => 
            array (
                'id' => 1773,
                'state_id' => 121,
                'name_ar' => 'جبل-عمان ',
                'name_en' => 'Jabal-amman ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            273 => 
            array (
                'id' => 1774,
                'state_id' => 121,
                'name_ar' => 'وادي-صقرة ',
                'name_en' => 'Wadi Saqrah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            274 => 
            array (
                'id' => 1775,
                'state_id' => 121,
                'name_ar' => 'الشميساني ',
                'name_en' => 'Al-Shmaisani ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            275 => 
            array (
                'id' => 1776,
                'state_id' => 121,
                'name_ar' => 'المدينة-المنورة ',
                'name_en' => 'Al-Madenah Al-monwarah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            276 => 
            array (
                'id' => 1777,
                'state_id' => 121,
                'name_ar' => 'عرجان ',
                'name_en' => 'Arjan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            277 => 
            array (
                'id' => 1778,
                'state_id' => 121,
                'name_ar' => 'الجبيهة ',
                'name_en' => 'Jbayha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            278 => 
            array (
                'id' => 1779,
                'state_id' => 121,
                'name_ar' => 'وادي-عبدون ',
                'name_en' => 'Wadi-Abdoun ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            279 => 
            array (
                'id' => 1780,
                'state_id' => 121,
                'name_ar' => 'ابو-نصير ',
                'name_en' => 'Abu-nNsair ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            280 => 
            array (
                'id' => 1781,
                'state_id' => 121,
                'name_ar' => 'الاشرفيه ',
                'name_en' => 'Al-Ashrafieh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            281 => 
            array (
                'id' => 1782,
                'state_id' => 121,
                'name_ar' => 'المنارة ',
                'name_en' => 'Al-Manara ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            282 => 
            array (
                'id' => 1783,
                'state_id' => 121,
                'name_ar' => 'الجيزا ',
                'name_en' => 'Al-Jiza ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            283 => 
            array (
                'id' => 1784,
                'state_id' => 121,
                'name_ar' => 'حي-الامير-حسن ',
                'name_en' => 'Prince El-Hasan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            284 => 
            array (
                'id' => 1785,
                'state_id' => 121,
                'name_ar' => 'تلاع-العلي ',
                'name_en' => 'Tlaa Al-Ali ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            285 => 
            array (
                'id' => 1786,
                'state_id' => 121,
                'name_ar' => 'الربوه ',
                'name_en' => 'Al-Rabwah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            286 => 
            array (
                'id' => 1787,
                'state_id' => 121,
                'name_ar' => 'الرابيه ',
                'name_en' => 'Al-Rabieh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            287 => 
            array (
                'id' => 1788,
                'state_id' => 121,
                'name_ar' => 'القويسمه ',
                'name_en' => 'Al-Quaismeh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            288 => 
            array (
                'id' => 1789,
                'state_id' => 121,
                'name_ar' => 'النزهه ',
                'name_en' => 'Al-Nuzha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            289 => 
            array (
                'id' => 1790,
                'state_id' => 121,
                'name_ar' => 'ياجوز ',
                'name_en' => 'Yajouz ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            290 => 
            array (
                'id' => 1791,
                'state_id' => 121,
                'name_ar' => 'راس-العين ',
                'name_en' => 'Nas Al-Ain ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            291 => 
            array (
                'id' => 1792,
                'state_id' => 121,
                'name_ar' => 'شفا-بدران ',
                'name_en' => 'Shafa Badran ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            292 => 
            array (
                'id' => 1793,
                'state_id' => 121,
                'name_ar' => 'صويلح ',
                'name_en' => 'Swieleh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            293 => 
            array (
                'id' => 1794,
                'state_id' => 121,
                'name_ar' => 'وسط-البلد ',
                'name_en' => 'Downtown ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            294 => 
            array (
                'id' => 1795,
                'state_id' => 121,
                'name_ar' => 'دير-غبار ',
                'name_en' => 'Deir Ghbar ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            295 => 
            array (
                'id' => 1796,
                'state_id' => 121,
                'name_ar' => 'عبدون ',
                'name_en' => 'Abdoun ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            296 => 
            array (
                'id' => 1797,
                'state_id' => 122,
                'name_ar' => 'مدينة-السلط‬‎ ',
                'name_en' => 'Salt City ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            297 => 
            array (
                'id' => 1798,
                'state_id' => 122,
                'name_ar' => 'النصر ',
                'name_en' => 'Al-Nasr ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            298 => 
            array (
                'id' => 1799,
                'state_id' => 124,
                'name_ar' => 'الدائري-الخامس ',
                'name_en' => 'Fifth-Ring ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            299 => 
            array (
                'id' => 1800,
                'state_id' => 125,
                'name_ar' => 'المدينة-الرياضية ',
                'name_en' => 'Sports Complex ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            300 => 
            array (
                'id' => 1801,
                'state_id' => 125,
                'name_ar' => 'وسط-البلد ',
                'name_en' => 'City Center ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            301 => 
            array (
                'id' => 1802,
                'state_id' => 125,
                'name_ar' => 'الزرقاء-الجديدة ',
                'name_en' => 'New Zarqa ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            302 => 
            array (
                'id' => 1803,
                'state_id' => 126,
                'name_ar' => 'الحصن ',
                'name_en' => 'Al-Husn ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            303 => 
            array (
                'id' => 1804,
                'state_id' => 126,
                'name_ar' => 'الصريح ',
                'name_en' => 'Al-Sareeh ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            304 => 
            array (
                'id' => 1805,
                'state_id' => 126,
                'name_ar' => 'النعيمة ',
                'name_en' => 'Neaime ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            305 => 
            array (
                'id' => 1806,
                'state_id' => 126,
                'name_ar' => 'بشرى ',
                'name_en' => 'Bushra ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            306 => 
            array (
                'id' => 1807,
                'state_id' => 126,
                'name_ar' => 'البارحة ',
                'name_en' => 'Barha ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            307 => 
            array (
                'id' => 1808,
                'state_id' => 127,
                'name_ar' => 'معان ',
                'name_en' => 'Maan ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            308 => 
            array (
                'id' => 1809,
                'state_id' => 128,
                'name_ar' => 'الطفيلة ',
                'name_en' => 'Tafilah ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            309 => 
            array (
                'id' => 1810,
                'state_id' => 129,
                'name_ar' => 'الكرك ',
                'name_en' => 'Al-Karak ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            310 => 
            array (
                'id' => 1811,
                'state_id' => 130,
                'name_ar' => 'عجلون ',
                'name_en' => 'Ajloun ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            311 => 
            array (
                'id' => 1812,
                'state_id' => 131,
                'name_ar' => 'جرش ',
                'name_en' => 'Jerash ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}