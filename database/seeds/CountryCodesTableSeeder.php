<?php

use Illuminate\Database\Seeder;

class CountryCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('country_codes')->delete();
        
        \DB::table('country_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Afghanistan ',
                'country_code' => '+93',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Albania ',
                'country_code' => '+355',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Algeria ',
                'country_code' => '+213',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'American Samoa',
                'country_code' => '+683',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Angola',
                'country_code' => '+244',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Anguilla ',
                'country_code' => '+263',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'Antarctica',
                'country_code' => '+672',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'Antigua and Barbuda',
                'country_code' => '+267',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'Argentina ',
                'country_code' => '+54',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'Armenia',
                'country_code' => '+374',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'name' => 'Aruba',
                'country_code' => '+297',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'name' => 'Australia',
                'country_code' => '+61',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 14,
                'name' => 'Austria',
                'country_code' => '+43',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 15,
                'name' => 'Azerbaijan',
                'country_code' => '+994',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 16,
                'name' => 'Bahamas',
                'country_code' => '+241',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 17,
                'name' => 'Bahrain',
                'country_code' => '+973',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 18,
                'name' => 'Bangladesh',
                'country_code' => '+880',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 19,
                'name' => 'Barbados ',
                'country_code' => '+245',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 20,
                'name' => 'Belarus ',
                'country_code' => '+375',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 21,
                'name' => 'Belgium ',
                'country_code' => '+32',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 22,
                'name' => 'Belize ',
                'country_code' => '+501',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 23,
                'name' => 'Benin ',
                'country_code' => '+229',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 24,
                'name' => 'Bermuda ',
                'country_code' => '+440',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 25,
                'name' => 'Bhutan',
                'country_code' => '+975',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 26,
                'name' => 'Bolivia ',
                'country_code' => '+591',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 28,
                'name' => 'Botswana',
                'country_code' => '+267',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 30,
                'name' => 'Brazil ',
                'country_code' => '+55',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 32,
                'name' => 'Brunei ',
                'country_code' => '+673',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 33,
                'name' => 'Bulgaria ',
                'country_code' => '+359',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 34,
                'name' => 'Burkina Faso ',
                'country_code' => '+226',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 35,
                'name' => 'Burundi ',
                'country_code' => '+257',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 36,
                'name' => 'Cambodia',
                'country_code' => '+855',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 37,
                'name' => 'Cameroon ',
                'country_code' => '+237',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 38,
                'name' => 'Canada ',
                'country_code' => '+1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 39,
                'name' => 'Cape Verde ',
                'country_code' => '+238',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 40,
                'name' => 'Cayman Islands ',
                'country_code' => '+344',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 41,
                'name' => 'Central African Republic ',
                'country_code' => '+236',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 42,
                'name' => 'Chad ',
                'country_code' => '+235',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 43,
                'name' => 'Chile ',
                'country_code' => '+56',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 44,
                'name' => 'China ',
                'country_code' => '+86',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 45,
                'name' => 'Christmas Island ',
                'country_code' => '+53',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 46,
                'name' => 'Cocos ',
                'country_code' => '+61',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 47,
                'name' => 'Colombia ',
                'country_code' => '+57',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 48,
                'name' => 'Comoros',
                'country_code' => '+269',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 50,
                'name' => 'Congo',
                'country_code' => '+242',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 51,
                'name' => 'Cook Islands',
                'country_code' => '+682',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 52,
                'name' => 'Costa Rica ',
                'country_code' => '+506',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 53,
                'name' => 'Cote D\'Ivoire ',
                'country_code' => '+225',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 54,
                'name' => 'Croatia ',
                'country_code' => '+385',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 55,
                'name' => 'Cuba ',
                'country_code' => '+53',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 56,
                'name' => 'Cyprus ',
                'country_code' => '+357',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 57,
                'name' => 'Czech Republic',
                'country_code' => '+420',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 59,
                'name' => 'Denmark ',
                'country_code' => '+45',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 60,
                'name' => 'Djibouti ',
                'country_code' => '+253',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 61,
                'name' => 'Dominica ',
                'country_code' => '+766',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 63,
                'name' => 'East Timor ',
                'country_code' => '+670',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 64,
                'name' => 'Ecuador ',
                'country_code' => '+593',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 65,
                'name' => 'Egypt ',
                'country_code' => '+20',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 66,
                'name' => 'El Salvador ',
                'country_code' => '+503',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 67,
                'name' => 'Equatorial Guinea ',
                'country_code' => '+240',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 68,
                'name' => 'Eritrea ',
                'country_code' => '+291',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 69,
                'name' => 'Estonia ',
                'country_code' => '+372',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 70,
                'name' => 'Ethiopia ',
                'country_code' => '+251',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 71,
                'name' => 'Falkland Islands ',
                'country_code' => '+500',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 72,
                'name' => 'Faroe Islands ',
                'country_code' => '+298',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 73,
                'name' => 'Fiji ',
                'country_code' => '+679',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 74,
                'name' => 'Finland ',
                'country_code' => '+358',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 75,
                'name' => 'France ',
                'country_code' => '+33',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 76,
                'name' => 'French Guiana ',
                'country_code' => '+594',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 77,
                'name' => 'French Polynesia ',
                'country_code' => '+689',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 79,
                'name' => 'Gabon ',
                'country_code' => '+241',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 80,
                'name' => 'Gambia',
                'country_code' => '+220',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 81,
                'name' => 'Georgia ',
                'country_code' => '+995',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 82,
                'name' => 'Germany ',
                'country_code' => '+49',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 83,
                'name' => 'Ghana ',
                'country_code' => '+233',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 84,
                'name' => 'Gibraltar ',
                'country_code' => '+350',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 86,
                'name' => 'Greece ',
                'country_code' => '+30',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 87,
                'name' => 'Greenland ',
                'country_code' => '+299',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 88,
                'name' => 'Grenada ',
                'country_code' => '+472',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 89,
                'name' => 'Guadeloupe',
                'country_code' => '+590',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 90,
                'name' => 'Guam',
                'country_code' => '+670',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 91,
                'name' => 'Guatemala ',
                'country_code' => '+502',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 92,
                'name' => 'Guinea ',
                'country_code' => '+224',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 94,
                'name' => 'Guyana ',
                'country_code' => '+592',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 95,
                'name' => 'Haiti ',
                'country_code' => '+509',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 98,
                'name' => 'Honduras ',
                'country_code' => '+504',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 99,
                'name' => 'Hong Kong ',
                'country_code' => '+852',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 100,
                'name' => 'Hungary ',
                'country_code' => '+36',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 101,
                'name' => 'Iceland ',
                'country_code' => '+354',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 102,
                'name' => 'India ',
                'country_code' => '+91',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 103,
                'name' => 'Indonesia ',
                'country_code' => '+62',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 104,
                'name' => 'Iran',
                'country_code' => '+98',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 105,
                'name' => 'Iraq ',
                'country_code' => '+964',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 106,
                'name' => 'Ireland ',
                'country_code' => '+353',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 107,
                'name' => 'Israel ',
                'country_code' => '+972',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 108,
                'name' => 'Italy ',
                'country_code' => '+39',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 109,
                'name' => 'Jamaica ',
                'country_code' => '+875',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 110,
                'name' => 'Japan ',
                'country_code' => '+81',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 111,
                'name' => 'Jordan ',
                'country_code' => '+962',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 112,
                'name' => 'Kazakstan ',
                'country_code' => '+7',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 113,
                'name' => 'Kenya ',
                'country_code' => '+254',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 114,
                'name' => 'Kiribati ',
                'country_code' => '+686',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 115,
                'name' => 'Korea',
                'country_code' => '+850',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 116,
                'name' => 'Korea',
                'country_code' => '+82',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 117,
                'name' => 'Kuwait ',
                'country_code' => '+965',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 118,
                'name' => 'Kyrgyzstan ',
                'country_code' => '+996',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 119,
                'name' => 'Lao People\'s Democratic Republic ',
                'country_code' => '+856',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 120,
                'name' => 'Latvia ',
                'country_code' => '+371',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 121,
                'name' => 'Lebanon ',
                'country_code' => '+961',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 122,
                'name' => 'Lesotho ',
                'country_code' => '+266',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 123,
                'name' => 'Liberia ',
                'country_code' => '+231',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 124,
                'name' => 'Libya ',
                'country_code' => '+218',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 125,
                'name' => 'Liechtenstein ',
                'country_code' => '+423',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 126,
                'name' => 'Lithuania ',
                'country_code' => '+370',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 127,
                'name' => 'Luxembourg ',
                'country_code' => '+352',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 128,
                'name' => 'Macau ',
                'country_code' => '+853',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 129,
                'name' => 'Macedonia',
                'country_code' => '+389',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 130,
                'name' => 'Madagascar ',
                'country_code' => '+261',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 131,
                'name' => 'Malawi ',
                'country_code' => '+265',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'id' => 132,
                'name' => 'Malaysia ',
                'country_code' => '+60',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'id' => 133,
                'name' => 'Maldives ',
                'country_code' => '+960',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 134,
                'name' => 'Mali ',
                'country_code' => '+223',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 135,
                'name' => 'Malta ',
                'country_code' => '+356',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'id' => 136,
                'name' => 'Marshall Islands ',
                'country_code' => '+692',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'id' => 137,
                'name' => 'Martinique ',
                'country_code' => '+596',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'id' => 138,
                'name' => 'Mauritania ',
                'country_code' => '+222',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'id' => 139,
                'name' => 'Mauritius ',
                'country_code' => '+230',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 140,
                'name' => 'Mayotte ',
                'country_code' => '+269',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'id' => 141,
                'name' => 'Mexico ',
                'country_code' => '+52',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 142,
                'name' => 'Micronesia',
                'country_code' => '+691',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'id' => 143,
                'name' => 'Moldova',
                'country_code' => '+373',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'id' => 144,
                'name' => 'Monaco',
                'country_code' => '+377',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'id' => 145,
                'name' => 'Mongolia ',
                'country_code' => '+976',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'id' => 146,
                'name' => 'Montserrat ',
                'country_code' => '+663',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'id' => 147,
                'name' => 'Morocco ',
                'country_code' => '+212',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'id' => 148,
                'name' => 'Mozambique ',
                'country_code' => '+258',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'id' => 149,
                'name' => 'Myanmar',
                'country_code' => '+95',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'id' => 150,
                'name' => 'Namibia ',
                'country_code' => '+264',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'id' => 151,
                'name' => 'Nauru ',
                'country_code' => '+674',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'id' => 152,
                'name' => 'Nepal ',
                'country_code' => '+977',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'id' => 153,
                'name' => 'Netherlands ',
                'country_code' => '+31',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'id' => 154,
                'name' => 'Netherlands Antilles ',
                'country_code' => '+599',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'id' => 155,
                'name' => 'New Caledonia ',
                'country_code' => '+687',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'id' => 156,
                'name' => 'New Zealand ',
                'country_code' => '+64',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'id' => 157,
                'name' => 'Nicaragua ',
                'country_code' => '+505',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'id' => 158,
                'name' => 'Niger ',
                'country_code' => '+227',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'id' => 159,
                'name' => 'Nigeria ',
                'country_code' => '+234',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'id' => 160,
                'name' => 'Niue ',
                'country_code' => '+683',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            148 => 
            array (
                'id' => 161,
                'name' => 'Norfolk Island ',
                'country_code' => '+672',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'id' => 162,
                'name' => 'Northern Mariana Islands ',
                'country_code' => '+669',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'id' => 163,
                'name' => 'Norway ',
                'country_code' => '+47',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            151 => 
            array (
                'id' => 164,
                'name' => 'Oman',
                'country_code' => '+968',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            152 => 
            array (
                'id' => 165,
                'name' => 'Pakistan ',
                'country_code' => '+92',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            153 => 
            array (
                'id' => 166,
                'name' => 'Palau ',
                'country_code' => '+680',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            154 => 
            array (
                'id' => 167,
                'name' => 'Palestinian State ',
                'country_code' => '+970',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            155 => 
            array (
                'id' => 168,
                'name' => 'Panama ',
                'country_code' => '+507',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            156 => 
            array (
                'id' => 169,
                'name' => 'Papua New Guinea ',
                'country_code' => '+675',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            157 => 
            array (
                'id' => 170,
                'name' => 'Paraguay ',
                'country_code' => '+595',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            158 => 
            array (
                'id' => 171,
                'name' => 'Peru ',
                'country_code' => '+51',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            159 => 
            array (
                'id' => 172,
                'name' => 'Philippines ',
                'country_code' => '+63',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            160 => 
            array (
                'id' => 174,
                'name' => 'Poland ',
                'country_code' => '+48',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            161 => 
            array (
                'id' => 175,
                'name' => 'Portugal ',
                'country_code' => '+351',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            162 => 
            array (
                'id' => 177,
                'name' => 'Qatar',
                'country_code' => '+974',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            163 => 
            array (
                'id' => 178,
                'name' => 'Reunion ',
                'country_code' => '+262',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            164 => 
            array (
                'id' => 179,
                'name' => 'Romania ',
                'country_code' => '+40',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            165 => 
            array (
                'id' => 181,
                'name' => 'Russian Federation ',
                'country_code' => '+7',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            166 => 
            array (
                'id' => 182,
                'name' => 'Rwanda ',
                'country_code' => '+250',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            167 => 
            array (
                'id' => 183,
                'name' => 'Saint Helena ',
                'country_code' => '+290',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            168 => 
            array (
                'id' => 184,
                'name' => 'Saint Kitts and Nevis ',
                'country_code' => '+868',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            169 => 
            array (
                'id' => 185,
                'name' => 'Saint Lucia ',
                'country_code' => '+757',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            170 => 
            array (
                'id' => 186,
                'name' => 'Saint Pierre and Miquelon ',
                'country_code' => '+508',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            171 => 
            array (
                'id' => 187,
                'name' => 'Saint Vincent and the Grenadines ',
                'country_code' => '+783',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            172 => 
            array (
                'id' => 188,
                'name' => 'Samoa ',
                'country_code' => '+685',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            173 => 
            array (
                'id' => 189,
                'name' => 'San Marino ',
                'country_code' => '+378',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            174 => 
            array (
                'id' => 190,
                'name' => 'Sao Tome and Principe ',
                'country_code' => '+239',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            175 => 
            array (
                'id' => 191,
                'name' => 'Saudi Arabia ',
                'country_code' => '+966',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            176 => 
            array (
                'id' => 193,
                'name' => 'Senegal ',
                'country_code' => '+221',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            177 => 
            array (
                'id' => 194,
                'name' => 'Seychelles ',
                'country_code' => '+248',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            178 => 
            array (
                'id' => 195,
                'name' => 'Sierra Leone ',
                'country_code' => '+232',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            179 => 
            array (
                'id' => 196,
                'name' => 'Singapore ',
                'country_code' => '+65',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            180 => 
            array (
                'id' => 197,
                'name' => 'Slovakia',
                'country_code' => '+421',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            181 => 
            array (
                'id' => 198,
                'name' => 'Slovenia ',
                'country_code' => '+386',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            182 => 
            array (
                'id' => 199,
                'name' => 'Solomon Islands ',
                'country_code' => '+677',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            183 => 
            array (
                'id' => 200,
                'name' => 'Somalia ',
                'country_code' => '+252',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            184 => 
            array (
                'id' => 201,
                'name' => 'South Africa ',
                'country_code' => '+27',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            185 => 
            array (
                'id' => 203,
                'name' => 'Spain ',
                'country_code' => '+34',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            186 => 
            array (
                'id' => 204,
                'name' => 'Sri Lanka ',
                'country_code' => '+94',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            187 => 
            array (
                'id' => 205,
                'name' => 'Sudan ',
                'country_code' => '+249',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            188 => 
            array (
                'id' => 206,
                'name' => 'Suriname ',
                'country_code' => '+597',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            189 => 
            array (
                'id' => 208,
                'name' => 'Swaziland',
                'country_code' => '+268',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            190 => 
            array (
                'id' => 209,
                'name' => 'Sweden ',
                'country_code' => '+46',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            191 => 
            array (
                'id' => 210,
                'name' => 'Switzerland ',
                'country_code' => '+41',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            192 => 
            array (
                'id' => 211,
                'name' => 'Syria ',
                'country_code' => '+963',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            193 => 
            array (
                'id' => 212,
                'name' => 'Taiwan ',
                'country_code' => '+886',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            194 => 
            array (
                'id' => 213,
                'name' => 'Tajikistan ',
                'country_code' => '+992',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            195 => 
            array (
                'id' => 214,
                'name' => 'Tanzania',
                'country_code' => '+255',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            196 => 
            array (
                'id' => 215,
                'name' => 'Thailand ',
                'country_code' => '+66',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            197 => 
            array (
                'id' => 217,
                'name' => 'Tokelau ',
                'country_code' => '+690',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            198 => 
            array (
                'id' => 218,
                'name' => 'Tonga',
                'country_code' => '+676',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            199 => 
            array (
                'id' => 219,
                'name' => 'Trinidad and Tobago ',
                'country_code' => '+867',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            200 => 
            array (
                'id' => 221,
                'name' => 'Tunisia ',
                'country_code' => '+216',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            201 => 
            array (
                'id' => 222,
                'name' => 'Turkey ',
                'country_code' => '+90',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            202 => 
            array (
                'id' => 223,
                'name' => 'Turkmenistan ',
                'country_code' => '+993',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            203 => 
            array (
                'id' => 224,
                'name' => 'Turks and Caicos Islands ',
                'country_code' => '+648',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            204 => 
            array (
                'id' => 225,
                'name' => 'Tuvalu ',
                'country_code' => '+688',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            205 => 
            array (
                'id' => 226,
                'name' => 'Uganda',
                'country_code' => '+256',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            206 => 
            array (
                'id' => 227,
                'name' => 'Ukraine ',
                'country_code' => '+380',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            207 => 
            array (
                'id' => 228,
                'name' => 'United Arab Emirates ',
                'country_code' => '+971',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            208 => 
            array (
                'id' => 229,
                'name' => 'United Kingdom ',
                'country_code' => '+44',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            209 => 
            array (
                'id' => 230,
                'name' => 'United States ',
                'country_code' => '+1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            210 => 
            array (
                'id' => 232,
                'name' => 'Uruguay',
                'country_code' => '+598',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            211 => 
            array (
                'id' => 233,
                'name' => 'Uzbekistan ',
                'country_code' => '+998',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            212 => 
            array (
                'id' => 234,
                'name' => 'Vanuatu ',
                'country_code' => '+678',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            213 => 
            array (
                'id' => 235,
                'name' => 'Vatican City State ',
                'country_code' => '+418',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            214 => 
            array (
                'id' => 236,
                'name' => 'Venezuela ',
                'country_code' => '+58',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            215 => 
            array (
                'id' => 237,
                'name' => 'Vietnam ',
                'country_code' => '+84',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            216 => 
            array (
                'id' => 238,
                'name' => 'Virgin Islands, British ',
                'country_code' => '+283',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            217 => 
            array (
                'id' => 239,
                'name' => 'Virgin Islands, United States ',
                'country_code' => '+339',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            218 => 
            array (
                'id' => 240,
                'name' => 'Wallis and Futuna Islands ',
                'country_code' => '+681',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            219 => 
            array (
                'id' => 242,
                'name' => 'Yemen ',
                'country_code' => '+967',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            220 => 
            array (
                'id' => 245,
                'name' => 'Zambia',
                'country_code' => '+260',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            221 => 
            array (
                'id' => 246,
                'name' => 'Zimbabwe',
                'country_code' => '+263',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}