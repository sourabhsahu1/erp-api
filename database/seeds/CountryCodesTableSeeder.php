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
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Albania ',
                    'country_code' => '+355',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Algeria ',
                    'country_code' => '+213',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'American Samoa',
                    'country_code' => '+-683',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Andorra, Principality of ',
                    'country_code' => '+376',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Angola',
                    'country_code' => '+244',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Anguilla ',
                    'country_code' => '+-263',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Antarctica',
                    'country_code' => '+672',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Antigua and Barbuda',
                    'country_code' => '+-267',
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Argentina ',
                    'country_code' => '+54',
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'Armenia',
                    'country_code' => '+374',
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'Aruba',
                    'country_code' => '+297',
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'Australia',
                    'country_code' => '+61',
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'Austria',
                    'country_code' => '+43',
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'Azerbaijan or Azerbaidjan (Former Azerbaijan Soviet Socialist Republic)',
                    'country_code' => '+994',
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'Bahamas, Commonwealth of The',
                    'country_code' => '+-241',
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'Bahrain, Kingdom of (Former Dilmun)',
                    'country_code' => '+973',
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'Bangladesh (Former East Pakistan)',
                    'country_code' => '+880',
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'Barbados ',
                    'country_code' => '+-245',
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'Belarus (Former Belorussian [Byelorussian] Soviet Socialist Republic)',
                    'country_code' => '+375',
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'Belgium ',
                    'country_code' => '+32',
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'Belize (Former British Honduras)',
                    'country_code' => '+501',
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'Benin (Former Dahomey)',
                    'country_code' => '+229',
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'Bermuda ',
                    'country_code' => '+-440',
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'Bhutan, Kingdom of',
                    'country_code' => '+975',
                ),
            25 =>
                array (
                    'id' => 26,
                    'name' => 'Bolivia ',
                    'country_code' => '+591',
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'Bosnia and Herzegovina ',
                    'country_code' => '+387',
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'Botswana (Former Bechuanaland)',
                    'country_code' => '+267',
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'Bouvet Island (Territory of Norway)',
                    'country_code' => '+',
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'Brazil ',
                    'country_code' => '+55',
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'British Indian Ocean Territory (BIOT)',
                    'country_code' => '+',
                ),
            31 =>
                array (
                    'id' => 32,
                    'name' => 'Brunei (Negara Brunei Darussalam) ',
                    'country_code' => '+673',
                ),
            32 =>
                array (
                    'id' => 33,
                    'name' => 'Bulgaria ',
                    'country_code' => '+359',
                ),
            33 =>
                array (
                    'id' => 34,
                    'name' => 'Burkina Faso (Former Upper Volta)',
                    'country_code' => '+226',
                ),
            34 =>
                array (
                    'id' => 35,
                    'name' => 'Burundi (Former Urundi)',
                    'country_code' => '+257',
                ),
            35 =>
                array (
                    'id' => 36,
                    'name' => 'Cambodia, Kingdom of (Former Khmer Republic, Kampuchea Republic)',
                    'country_code' => '+855',
                ),
            36 =>
                array (
                    'id' => 37,
                    'name' => 'Cameroon (Former French Cameroon)',
                    'country_code' => '+237',
                ),
            37 =>
                array (
                    'id' => 38,
                    'name' => 'Canada ',
                    'country_code' => '+1',
                ),
            38 =>
                array (
                    'id' => 39,
                    'name' => 'Cape Verde ',
                    'country_code' => '+238',
                ),
            39 =>
                array (
                    'id' => 40,
                    'name' => 'Cayman Islands ',
                    'country_code' => '+-344',
                ),
            40 =>
                array (
                    'id' => 41,
                    'name' => 'Central African Republic ',
                    'country_code' => '+236',
                ),
            41 =>
                array (
                    'id' => 42,
                    'name' => 'Chad ',
                    'country_code' => '+235',
                ),
            42 =>
                array (
                    'id' => 43,
                    'name' => 'Chile ',
                    'country_code' => '+56',
                ),
            43 =>
                array (
                    'id' => 44,
                    'name' => 'China ',
                    'country_code' => '+86',
                ),
            44 =>
                array (
                    'id' => 45,
                    'name' => 'Christmas Island ',
                    'country_code' => '+53',
                ),
            45 =>
                array (
                    'id' => 46,
                    'name' => 'Cocos (Keeling) Islands ',
                    'country_code' => '+61',
                ),
            46 =>
                array (
                    'id' => 47,
                    'name' => 'Colombia ',
                    'country_code' => '+57',
                ),
            47 =>
                array (
                    'id' => 48,
                    'name' => 'Comoros, Union of the ',
                    'country_code' => '+269',
                ),
            48 =>
                array (
                    'id' => 49,
                    'name' => 'Congo, Democratic Republic of the (Former Zaire) ',
                    'country_code' => '+243',
                ),
            49 =>
                array (
                    'id' => 50,
                    'name' => 'Congo, Republic of the',
                    'country_code' => '+242',
                ),
            50 =>
                array (
                    'id' => 51,
                    'name' => 'Cook Islands (Former Harvey Islands)',
                    'country_code' => '+682',
                ),
            51 =>
                array (
                    'id' => 52,
                    'name' => 'Costa Rica ',
                    'country_code' => '+506',
                ),
            52 =>
                array (
                    'id' => 53,
                    'name' => 'Cote D\'Ivoire (Former Ivory Coast) ',
                    'country_code' => '+225',
                ),
            53 =>
                array (
                    'id' => 54,
                    'name' => 'Croatia (Hrvatska) ',
                    'country_code' => '+385',
                ),
            54 =>
                array (
                    'id' => 55,
                    'name' => 'Cuba ',
                    'country_code' => '+53',
                ),
            55 =>
                array (
                    'id' => 56,
                    'name' => 'Cyprus ',
                    'country_code' => '+357',
                ),
            56 =>
                array (
                    'id' => 57,
                    'name' => 'Czech Republic',
                    'country_code' => '+420',
                ),
            57 =>
                array (
                    'id' => 58,
                    'name' => 'Czechoslavakia (Former) See CZ Czech Republic or Slovakia',
                    'country_code' => '+',
                ),
            58 =>
                array (
                    'id' => 59,
                    'name' => 'Denmark ',
                    'country_code' => '+45',
                ),
            59 =>
                array (
                    'id' => 60,
                    'name' => 'Djibouti (Former French Territory of the Afars and Issas, French Somaliland)',
                    'country_code' => '+253',
                ),
            60 =>
                array (
                    'id' => 61,
                    'name' => 'Dominica ',
                    'country_code' => '+-766',
                ),
            61 =>
                array (
                    'id' => 62,
                    'name' => 'Dominican Republic ',
                    'country_code' => '++1-809 and +1-829? ',
                ),
            62 =>
                array (
                    'id' => 63,
                    'name' => 'East Timor (Former Portuguese Timor)',
                    'country_code' => '+670',
                ),
            63 =>
                array (
                    'id' => 64,
                    'name' => 'Ecuador ',
                    'country_code' => '+593',
                ),
            64 =>
                array (
                    'id' => 65,
                    'name' => 'Egypt (Former United Arab Republic - with Syria)',
                    'country_code' => '+20',
                ),
            65 =>
                array (
                    'id' => 66,
                    'name' => 'El Salvador ',
                    'country_code' => '+503',
                ),
            66 =>
                array (
                    'id' => 67,
                    'name' => 'Equatorial Guinea (Former Spanish Guinea)',
                    'country_code' => '+240',
                ),
            67 =>
                array (
                    'id' => 68,
                    'name' => 'Eritrea (Former Eritrea Autonomous Region in Ethiopia)',
                    'country_code' => '+291',
                ),
            68 =>
                array (
                    'id' => 69,
                    'name' => 'Estonia (Former Estonian Soviet Socialist Republic)',
                    'country_code' => '+372',
                ),
            69 =>
                array (
                    'id' => 70,
                    'name' => 'Ethiopia (Former Abyssinia, Italian East Africa)',
                    'country_code' => '+251',
                ),
            70 =>
                array (
                    'id' => 71,
                    'name' => 'Falkland Islands (Islas Malvinas) ',
                    'country_code' => '+500',
                ),
            71 =>
                array (
                    'id' => 72,
                    'name' => 'Faroe Islands ',
                    'country_code' => '+298',
                ),
            72 =>
                array (
                    'id' => 73,
                    'name' => 'Fiji ',
                    'country_code' => '+679',
                ),
            73 =>
                array (
                    'id' => 74,
                    'name' => 'Finland ',
                    'country_code' => '+358',
                ),
            74 =>
                array (
                    'id' => 75,
                    'name' => 'France ',
                    'country_code' => '+33',
                ),
            75 =>
                array (
                    'id' => 76,
                    'name' => 'French Guiana or French Guyana ',
                    'country_code' => '+594',
                ),
            76 =>
                array (
                    'id' => 77,
                    'name' => 'French Polynesia (Former French Colony of Oceania)',
                    'country_code' => '+689',
                ),
            77 =>
                array (
                    'id' => 78,
                    'name' => 'French Southern Territories and Antarctic Lands ',
                    'country_code' => '+',
                ),
            78 =>
                array (
                    'id' => 79,
                    'name' => 'Gabon (Gabonese Republic)',
                    'country_code' => '+241',
                ),
            79 =>
                array (
                    'id' => 80,
                    'name' => 'Gambia, The ',
                    'country_code' => '+220',
                ),
            80 =>
                array (
                    'id' => 81,
                    'name' => 'Georgia (Former Georgian Soviet Socialist Republic)',
                    'country_code' => '+995',
                ),
            81 =>
                array (
                    'id' => 82,
                    'name' => 'Germany ',
                    'country_code' => '+49',
                ),
            82 =>
                array (
                    'id' => 83,
                    'name' => 'Ghana (Former Gold Coast)',
                    'country_code' => '+233',
                ),
            83 =>
                array (
                    'id' => 84,
                    'name' => 'Gibraltar ',
                    'country_code' => '+350',
                ),
            84 =>
                array (
                    'id' => 85,
                    'name' => 'Great Britain (United Kingdom) ',
                    'country_code' => '+',
                ),
            85 =>
                array (
                    'id' => 86,
                    'name' => 'Greece ',
                    'country_code' => '+30',
                ),
            86 =>
                array (
                    'id' => 87,
                    'name' => 'Greenland ',
                    'country_code' => '+299',
                ),
            87 =>
                array (
                    'id' => 88,
                    'name' => 'Grenada ',
                    'country_code' => '+-472',
                ),
            88 =>
                array (
                    'id' => 89,
                    'name' => 'Guadeloupe',
                    'country_code' => '+590',
                ),
            89 =>
                array (
                    'id' => 90,
                    'name' => 'Guam',
                    'country_code' => '+-670',
                ),
            90 =>
                array (
                    'id' => 91,
                    'name' => 'Guatemala ',
                    'country_code' => '+502',
                ),
            91 =>
                array (
                    'id' => 92,
                    'name' => 'Guinea (Former French Guinea)',
                    'country_code' => '+224',
                ),
            92 =>
                array (
                    'id' => 93,
                    'name' => 'Guinea-Bissau (Former Portuguese Guinea)',
                    'country_code' => '+245',
                ),
            93 =>
                array (
                    'id' => 94,
                    'name' => 'Guyana (Former British Guiana)',
                    'country_code' => '+592',
                ),
            94 =>
                array (
                    'id' => 95,
                    'name' => 'Haiti ',
                    'country_code' => '+509',
                ),
            95 =>
                array (
                    'id' => 96,
                    'name' => 'Heard Island and McDonald Islands (Territory of Australia)',
                    'country_code' => '+',
                ),
            96 =>
                array (
                    'id' => 97,
                    'name' => 'Holy See (Vatican City State)',
                    'country_code' => '+',
                ),
            97 =>
                array (
                    'id' => 98,
                    'name' => 'Honduras ',
                    'country_code' => '+504',
                ),
            98 =>
                array (
                    'id' => 99,
                    'name' => 'Hong Kong ',
                    'country_code' => '+852',
                ),
            99 =>
                array (
                    'id' => 100,
                    'name' => 'Hungary ',
                    'country_code' => '+36',
                ),
            100 =>
                array (
                    'id' => 101,
                    'name' => 'Iceland ',
                    'country_code' => '+354',
                ),
            101 =>
                array (
                    'id' => 102,
                    'name' => 'India ',
                    'country_code' => '+91',
                ),
            102 =>
                array (
                    'id' => 103,
                    'name' => 'Indonesia (Former Netherlands East Indies; Dutch East Indies)',
                    'country_code' => '+62',
                ),
            103 =>
                array (
                    'id' => 104,
                    'name' => 'Iran, Islamic Republic of',
                    'country_code' => '+98',
                ),
            104 =>
                array (
                    'id' => 105,
                    'name' => 'Iraq ',
                    'country_code' => '+964',
                ),
            105 =>
                array (
                    'id' => 106,
                    'name' => 'Ireland ',
                    'country_code' => '+353',
                ),
            106 =>
                array (
                    'id' => 107,
                    'name' => 'Israel ',
                    'country_code' => '+972',
                ),
            107 =>
                array (
                    'id' => 108,
                    'name' => 'Italy ',
                    'country_code' => '+39',
                ),
            108 =>
                array (
                    'id' => 109,
                    'name' => 'Jamaica ',
                    'country_code' => '+-875',
                ),
            109 =>
                array (
                    'id' => 110,
                    'name' => 'Japan ',
                    'country_code' => '+81',
                ),
            110 =>
                array (
                    'id' => 111,
                    'name' => 'Jordan (Former Transjordan)',
                    'country_code' => '+962',
                ),
            111 =>
                array (
                    'id' => 112,
                    'name' => 'Kazakstan or Kazakhstan (Former Kazakh Soviet Socialist Republic)',
                    'country_code' => '+7',
                ),
            112 =>
                array (
                    'id' => 113,
                    'name' => 'Kenya (Former British East Africa)',
                    'country_code' => '+254',
                ),
            113 =>
                array (
                    'id' => 114,
                    'name' => 'Kiribati (Pronounced keer-ree-bahss) (Former Gilbert Islands)',
                    'country_code' => '+686',
                ),
            114 =>
                array (
                    'id' => 115,
                    'name' => 'Korea, Democratic People\'s Republic of (North Korea)',
                    'country_code' => '+850',
                ),
            115 =>
                array (
                    'id' => 116,
                    'name' => 'Korea, Republic of (South Korea) ',
                    'country_code' => '+82',
                ),
            116 =>
                array (
                    'id' => 117,
                    'name' => 'Kuwait ',
                    'country_code' => '+965',
                ),
            117 =>
                array (
                    'id' => 118,
                    'name' => 'Kyrgyzstan (Kyrgyz Republic) (Former Kirghiz Soviet Socialist Republic)',
                    'country_code' => '+996',
                ),
            118 =>
                array (
                    'id' => 119,
                    'name' => 'Lao People\'s Democratic Republic (Laos)',
                    'country_code' => '+856',
                ),
            119 =>
                array (
                    'id' => 120,
                    'name' => 'Latvia (Former Latvian Soviet Socialist Republic)',
                    'country_code' => '+371',
                ),
            120 =>
                array (
                    'id' => 121,
                    'name' => 'Lebanon ',
                    'country_code' => '+961',
                ),
            121 =>
                array (
                    'id' => 122,
                    'name' => 'Lesotho (Former Basutoland)',
                    'country_code' => '+266',
                ),
            122 =>
                array (
                    'id' => 123,
                    'name' => 'Liberia ',
                    'country_code' => '+231',
                ),
            123 =>
                array (
                    'id' => 124,
                    'name' => 'Libya (Libyan Arab Jamahiriya)',
                    'country_code' => '+218',
                ),
            124 =>
                array (
                    'id' => 125,
                    'name' => 'Liechtenstein ',
                    'country_code' => '+423',
                ),
            125 =>
                array (
                    'id' => 126,
                    'name' => 'Lithuania (Former Lithuanian Soviet Socialist Republic)',
                    'country_code' => '+370',
                ),
            126 =>
                array (
                    'id' => 127,
                    'name' => 'Luxembourg ',
                    'country_code' => '+352',
                ),
            127 =>
                array (
                    'id' => 128,
                    'name' => 'Macau ',
                    'country_code' => '+853',
                ),
            128 =>
                array (
                    'id' => 129,
                    'name' => 'Macedonia, The Former Yugoslav Republic of',
                    'country_code' => '+389',
                ),
            129 =>
                array (
                    'id' => 130,
                    'name' => 'Madagascar (Former Malagasy Republic)',
                    'country_code' => '+261',
                ),
            130 =>
                array (
                    'id' => 131,
                    'name' => 'Malawi (Former British Central African Protectorate, Nyasaland)',
                    'country_code' => '+265',
                ),
            131 =>
                array (
                    'id' => 132,
                    'name' => 'Malaysia ',
                    'country_code' => '+60',
                ),
            132 =>
                array (
                    'id' => 133,
                    'name' => 'Maldives ',
                    'country_code' => '+960',
                ),
            133 =>
                array (
                    'id' => 134,
                    'name' => 'Mali (Former French Sudan and Sudanese Republic) ',
                    'country_code' => '+223',
                ),
            134 =>
                array (
                    'id' => 135,
                    'name' => 'Malta ',
                    'country_code' => '+356',
                ),
            135 =>
                array (
                    'id' => 136,
                    'name' => 'Marshall Islands (Former Marshall Islands District - Trust Territory of the Pacific Islands)',
                    'country_code' => '+692',
                ),
            136 =>
                array (
                    'id' => 137,
                    'name' => 'Martinique (French) ',
                    'country_code' => '+596',
                ),
            137 =>
                array (
                    'id' => 138,
                    'name' => 'Mauritania ',
                    'country_code' => '+222',
                ),
            138 =>
                array (
                    'id' => 139,
                    'name' => 'Mauritius ',
                    'country_code' => '+230',
                ),
            139 =>
                array (
                    'id' => 140,
                    'name' => 'Mayotte (Territorial Collectivity of Mayotte)',
                    'country_code' => '+269',
                ),
            140 =>
                array (
                    'id' => 141,
                    'name' => 'Mexico ',
                    'country_code' => '+52',
                ),
            141 =>
                array (
                    'id' => 142,
                    'name' => 'Micronesia, Federated States of (Former Ponape, Truk, and Yap Districts - Trust Territory of the Pacific Islands)',
                    'country_code' => '+691',
                ),
            142 =>
                array (
                    'id' => 143,
                    'name' => 'Moldova, Republic of',
                    'country_code' => '+373',
                ),
            143 =>
                array (
                    'id' => 144,
                    'name' => 'Monaco, Principality of',
                    'country_code' => '+377',
                ),
            144 =>
                array (
                    'id' => 145,
                    'name' => 'Mongolia (Former Outer Mongolia)',
                    'country_code' => '+976',
                ),
            145 =>
                array (
                    'id' => 146,
                    'name' => 'Montserrat ',
                    'country_code' => '+-663',
                ),
            146 =>
                array (
                    'id' => 147,
                    'name' => 'Morocco ',
                    'country_code' => '+212',
                ),
            147 =>
                array (
                    'id' => 148,
                    'name' => 'Mozambique (Former Portuguese East Africa)',
                    'country_code' => '+258',
                ),
            148 =>
                array (
                    'id' => 149,
                    'name' => 'Myanmar, Union of (Former Burma)',
                    'country_code' => '+95',
                ),
            149 =>
                array (
                    'id' => 150,
                    'name' => 'Namibia (Former German Southwest Africa, South-West Africa)',
                    'country_code' => '+264',
                ),
            150 =>
                array (
                    'id' => 151,
                    'name' => 'Nauru (Former Pleasant Island)',
                    'country_code' => '+674',
                ),
            151 =>
                array (
                    'id' => 152,
                    'name' => 'Nepal ',
                    'country_code' => '+977',
                ),
            152 =>
                array (
                    'id' => 153,
                    'name' => 'Netherlands ',
                    'country_code' => '+31',
                ),
            153 =>
                array (
                    'id' => 154,
                    'name' => 'Netherlands Antilles (Former Curacao and Dependencies)',
                    'country_code' => '+599',
                ),
            154 =>
                array (
                    'id' => 155,
                    'name' => 'New Caledonia ',
                    'country_code' => '+687',
                ),
            155 =>
                array (
                    'id' => 156,
                    'name' => 'New Zealand (Aotearoa) ',
                    'country_code' => '+64',
                ),
            156 =>
                array (
                    'id' => 157,
                    'name' => 'Nicaragua ',
                    'country_code' => '+505',
                ),
            157 =>
                array (
                    'id' => 158,
                    'name' => 'Niger ',
                    'country_code' => '+227',
                ),
            158 =>
                array (
                    'id' => 159,
                    'name' => 'Nigeria ',
                    'country_code' => '+234',
                ),
            159 =>
                array (
                    'id' => 160,
                    'name' => 'Niue (Former Savage Island)',
                    'country_code' => '+683',
                ),
            160 =>
                array (
                    'id' => 161,
                    'name' => 'Norfolk Island ',
                    'country_code' => '+672',
                ),
            161 =>
                array (
                    'id' => 162,
                    'name' => 'Northern Mariana Islands (Former Mariana Islands District - Trust Territory of the Pacific Islands)',
                    'country_code' => '+-669',
                ),
            162 =>
                array (
                    'id' => 163,
                    'name' => 'Norway ',
                    'country_code' => '+47',
                ),
            163 =>
                array (
                    'id' => 164,
                    'name' => 'Oman, Sultanate of (Former Muscat and Oman)',
                    'country_code' => '+968',
                ),
            164 =>
                array (
                    'id' => 165,
                    'name' => 'Pakistan (Former West Pakistan)',
                    'country_code' => '+92',
                ),
            165 =>
                array (
                    'id' => 166,
                    'name' => 'Palau (Former Palau District - Trust Terriroty of the Pacific Islands)',
                    'country_code' => '+680',
                ),
            166 =>
                array (
                    'id' => 167,
                    'name' => 'Palestinian State (Proposed)',
                    'country_code' => '+970',
                ),
            167 =>
                array (
                    'id' => 168,
                    'name' => 'Panama ',
                    'country_code' => '+507',
                ),
            168 =>
                array (
                    'id' => 169,
                    'name' => 'Papua New Guinea (Former Territory of Papua and New Guinea)',
                    'country_code' => '+675',
                ),
            169 =>
                array (
                    'id' => 170,
                    'name' => 'Paraguay ',
                    'country_code' => '+595',
                ),
            170 =>
                array (
                    'id' => 171,
                    'name' => 'Peru ',
                    'country_code' => '+51',
                ),
            171 =>
                array (
                    'id' => 172,
                    'name' => 'Philippines ',
                    'country_code' => '+63',
                ),
            172 =>
                array (
                    'id' => 173,
                    'name' => 'Pitcairn Island',
                    'country_code' => '+',
                ),
            173 =>
                array (
                    'id' => 174,
                    'name' => 'Poland ',
                    'country_code' => '+48',
                ),
            174 =>
                array (
                    'id' => 175,
                    'name' => 'Portugal ',
                    'country_code' => '+351',
                ),
            175 =>
                array (
                    'id' => 176,
                    'name' => 'Puerto Rico ',
                    'country_code' => '++1-787 or +1-939',
                ),
            176 =>
                array (
                    'id' => 177,
                    'name' => 'Qatar, State of ',
                    'country_code' => '+974',
                ),
            177 =>
                array (
                    'id' => 178,
                    'name' => 'Reunion (French) (Former Bourbon Island)',
                    'country_code' => '+262',
                ),
            178 =>
                array (
                    'id' => 179,
                    'name' => 'Romania ',
                    'country_code' => '+40',
                ),
            179 =>
                array (
                    'id' => 180,
                    'name' => 'Russia - USSR (Former Russian Empire, Union of Soviet Socialist Republics, Russian Soviet Federative Socialist Republic) Now RU - Russian Federation',
                    'country_code' => '+',
                ),
            180 =>
                array (
                    'id' => 181,
                    'name' => 'Russian Federation ',
                    'country_code' => '+7',
                ),
            181 =>
                array (
                    'id' => 182,
                    'name' => 'Rwanda (Rwandese Republic) (Former Ruanda)',
                    'country_code' => '+250',
                ),
            182 =>
                array (
                    'id' => 183,
                    'name' => 'Saint Helena ',
                    'country_code' => '+290',
                ),
            183 =>
                array (
                    'id' => 184,
                    'name' => 'Saint Kitts and Nevis (Former Federation of Saint Christopher and Nevis)',
                    'country_code' => '+-868',
                ),
            184 =>
                array (
                    'id' => 185,
                    'name' => 'Saint Lucia ',
                    'country_code' => '+-757',
                ),
            185 =>
                array (
                    'id' => 186,
                    'name' => 'Saint Pierre and Miquelon ',
                    'country_code' => '+508',
                ),
            186 =>
                array (
                    'id' => 187,
                    'name' => 'Saint Vincent and the Grenadines ',
                    'country_code' => '+-783',
                ),
            187 =>
                array (
                    'id' => 188,
                    'name' => 'Samoa (Former Western Samoa)',
                    'country_code' => '+685',
                ),
            188 =>
                array (
                    'id' => 189,
                    'name' => 'San Marino ',
                    'country_code' => '+378',
                ),
            189 =>
                array (
                    'id' => 190,
                    'name' => 'Sao Tome and Principe ',
                    'country_code' => '+239',
                ),
            190 =>
                array (
                    'id' => 191,
                    'name' => 'Saudi Arabia ',
                    'country_code' => '+966',
                ),
            191 =>
                array (
                    'id' => 192,
                    'name' => 'Serbia, Republic of',
                    'country_code' => '+',
                ),
            192 =>
                array (
                    'id' => 193,
                    'name' => 'Senegal ',
                    'country_code' => '+221',
                ),
            193 =>
                array (
                    'id' => 194,
                    'name' => 'Seychelles ',
                    'country_code' => '+248',
                ),
            194 =>
                array (
                    'id' => 195,
                    'name' => 'Sierra Leone ',
                    'country_code' => '+232',
                ),
            195 =>
                array (
                    'id' => 196,
                    'name' => 'Singapore ',
                    'country_code' => '+65',
                ),
            196 =>
                array (
                    'id' => 197,
                    'name' => 'Slovakia',
                    'country_code' => '+421',
                ),
            197 =>
                array (
                    'id' => 198,
                    'name' => 'Slovenia ',
                    'country_code' => '+386',
                ),
            198 =>
                array (
                    'id' => 199,
                    'name' => 'Solomon Islands (Former British Solomon Islands)',
                    'country_code' => '+677',
                ),
            199 =>
                array (
                    'id' => 200,
                    'name' => 'Somalia (Former Somali Republic, Somali Democratic Republic) ',
                    'country_code' => '+252',
                ),
            200 =>
                array (
                    'id' => 201,
                    'name' => 'South Africa (Former Union of South Africa)',
                    'country_code' => '+27',
                ),
            201 =>
                array (
                    'id' => 202,
                    'name' => 'South Georgia and the South Sandwich Islands',
                    'country_code' => '+',
                ),
            202 =>
                array (
                    'id' => 203,
                    'name' => 'Spain ',
                    'country_code' => '+34',
                ),
            203 =>
                array (
                    'id' => 204,
                    'name' => 'Sri Lanka (Former Serendib, Ceylon) ',
                    'country_code' => '+94',
                ),
            204 =>
                array (
                    'id' => 205,
                    'name' => 'Sudan (Former Anglo-Egyptian Sudan) ',
                    'country_code' => '+249',
                ),
            205 =>
                array (
                    'id' => 206,
                    'name' => 'Suriname (Former Netherlands Guiana, Dutch Guiana)',
                    'country_code' => '+597',
                ),
            206 =>
                array (
                    'id' => 207,
                    'name' => 'Svalbard (Spitzbergen) and Jan Mayen Islands ',
                    'country_code' => '+',
                ),
            207 =>
                array (
                    'id' => 208,
                    'name' => 'Swaziland, Kingdom of ',
                    'country_code' => '+268',
                ),
            208 =>
                array (
                    'id' => 209,
                    'name' => 'Sweden ',
                    'country_code' => '+46',
                ),
            209 =>
                array (
                    'id' => 210,
                    'name' => 'Switzerland ',
                    'country_code' => '+41',
                ),
            210 =>
                array (
                    'id' => 211,
                    'name' => 'Syria (Syrian Arab Republic) (Former United Arab Republic - with Egypt)',
                    'country_code' => '+963',
                ),
            211 =>
                array (
                    'id' => 212,
                    'name' => 'Taiwan (Former Formosa)',
                    'country_code' => '+886',
                ),
            212 =>
                array (
                    'id' => 213,
                    'name' => 'Tajikistan (Former Tajik Soviet Socialist Republic)',
                    'country_code' => '+992',
                ),
            213 =>
                array (
                    'id' => 214,
                    'name' => 'Tanzania, United Republic of (Former United Republic of Tanganyika and Zanzibar)',
                    'country_code' => '+255',
                ),
            214 =>
                array (
                    'id' => 215,
                    'name' => 'Thailand (Former Siam)',
                    'country_code' => '+66',
                ),
            215 =>
                array (
                    'id' => 216,
                    'name' => 'Togo (Former French Togoland)',
                    'country_code' => '+',
                ),
            216 =>
                array (
                    'id' => 217,
                    'name' => 'Tokelau ',
                    'country_code' => '+690',
                ),
            217 =>
                array (
                    'id' => 218,
                    'name' => 'Tonga, Kingdom of (Former Friendly Islands)',
                    'country_code' => '+676',
                ),
            218 =>
                array (
                    'id' => 219,
                    'name' => 'Trinidad and Tobago ',
                    'country_code' => '+-867',
                ),
            219 =>
                array (
                    'id' => 220,
                    'name' => 'Tromelin Island ',
                    'country_code' => '+',
                ),
            220 =>
                array (
                    'id' => 221,
                    'name' => 'Tunisia ',
                    'country_code' => '+216',
                ),
            221 =>
                array (
                    'id' => 222,
                    'name' => 'Turkey ',
                    'country_code' => '+90',
                ),
            222 =>
                array (
                    'id' => 223,
                    'name' => 'Turkmenistan (Former Turkmen Soviet Socialist Republic)',
                    'country_code' => '+993',
                ),
            223 =>
                array (
                    'id' => 224,
                    'name' => 'Turks and Caicos Islands ',
                    'country_code' => '+-648',
                ),
            224 =>
                array (
                    'id' => 225,
                    'name' => 'Tuvalu (Former Ellice Islands)',
                    'country_code' => '+688',
                ),
            225 =>
                array (
                    'id' => 226,
                    'name' => 'Uganda, Republic of',
                    'country_code' => '+256',
                ),
            226 =>
                array (
                    'id' => 227,
                    'name' => 'Ukraine (Former Ukrainian National Republic, Ukrainian State, Ukrainian Soviet Socialist Republic)',
                    'country_code' => '+380',
                ),
            227 =>
                array (
                    'id' => 228,
                    'name' => 'United Arab Emirates (UAE) (Former Trucial Oman, Trucial States)',
                    'country_code' => '+971',
                ),
            228 =>
                array (
                    'id' => 229,
                    'name' => 'United Kingdom (Great Britain / UK)',
                    'country_code' => '+44',
                ),
            229 =>
                array (
                    'id' => 230,
                    'name' => 'United States ',
                    'country_code' => '+1',
                ),
            230 =>
                array (
                    'id' => 231,
                    'name' => 'United States Minor Outlying Islands ',
                    'country_code' => '+',
                ),
            231 =>
                array (
                    'id' => 232,
                    'name' => 'Uruguay, Oriental Republic of (Former Banda Oriental, Cisplatine Province)',
                    'country_code' => '+598',
                ),
            232 =>
                array (
                    'id' => 233,
                    'name' => 'Uzbekistan (Former UZbek Soviet Socialist Republic)',
                    'country_code' => '+998',
                ),
            233 =>
                array (
                    'id' => 234,
                    'name' => 'Vanuatu (Former New Hebrides)',
                    'country_code' => '+678',
                ),
            234 =>
                array (
                    'id' => 235,
                    'name' => 'Vatican City State (Holy See)',
                    'country_code' => '+418',
                ),
            235 =>
                array (
                    'id' => 236,
                    'name' => 'Venezuela ',
                    'country_code' => '+58',
                ),
            236 =>
                array (
                    'id' => 237,
                    'name' => 'Vietnam ',
                    'country_code' => '+84',
                ),
            237 =>
                array (
                    'id' => 238,
                    'name' => 'Virgin Islands, British ',
                    'country_code' => '+-283',
                ),
            238 =>
                array (
                    'id' => 239,
                    'name' => 'Virgin Islands, United States (Former Danish West Indies) ',
                    'country_code' => '+-339',
                ),
            239 =>
                array (
                    'id' => 240,
                    'name' => 'Wallis and Futuna Islands ',
                    'country_code' => '+681',
                ),
            240 =>
                array (
                    'id' => 241,
                    'name' => 'Western Sahara (Former Spanish Sahara)',
                    'country_code' => '+',
                ),
            241 =>
                array (
                    'id' => 242,
                    'name' => 'Yemen ',
                    'country_code' => '+967',
                ),
            242 =>
                array (
                    'id' => 243,
                    'name' => 'Yugoslavia ',
                    'country_code' => '+',
                ),
            243 =>
                array (
                    'id' => 244,
                    'name' => 'Zaire (Former Congo Free State, Belgian Congo, Congo/Leopoldville, Congo/Kinshasa, Zaire) Now CD - Congo, Democratic Republic of the ',
                    'country_code' => '+',
                ),
            244 =>
                array (
                    'id' => 245,
                    'name' => 'Zambia, Republic of (Former Northern Rhodesia) ',
                    'country_code' => '+260',
                ),
            245 =>
                array (
                    'id' => 246,
                    'name' => 'Zimbabwe, Republic of Former Rhodesia) ',
                    'country_code' => '+263',
                ),
        ));


    }
}
