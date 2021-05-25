<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('currencies')->delete();

        \DB::table('currencies')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code_currency' => 'NGN',
                'country_id' => 1,
                'singular_currency_name' => 'Naira',
                'plural_currency_name' => 'Naira',
                'currency_sign' => 'NGN',
                'singular_change_name' => 'Kobo',
                'plural_change_name' => 'Kobo',
                'change_sign' => 'K',
                'month_1' => '1.00',
                'month_2' => '1.00',
                'month_3' => '1.00',
                'month_4' => '1.00',
                'month_5' => '1.00',
                'month_6' => '1.00',
                'month_7' => '1.00',
                'month_8' => '1.00',
                'month_9' => '1.00',
                'month_10' => '1.00',
                'month_11' => '1.00',
                'month_12' => '1.00',
                'previous_year_closing_rate_local' => '1.00',
                'previous_year_closing_rate_international' => '1.00',
                'is_active' => 1,
                'created_at' => '2020-09-30 18:50:15',
                'updated_at' => '2020-09-30 19:10:09',
                'deleted_at' => '2020-09-30 19:10:09',
            ),
            1 =>
            array (
                'id' => 2,
                'code_currency' => 'USD',
                'country_id' => 2,
                'singular_currency_name' => 'Dollar',
                'plural_currency_name' => 'Dollars',
                'currency_sign' => '$',
                'singular_change_name' => 'Cent',
                'plural_change_name' => 'Cents',
                'change_sign' => 'c',
                'month_1' => '0.00',
                'month_2' => '0.00',
                'month_3' => '0.00',
                'month_4' => '0.00',
                'month_5' => '0.00',
                'month_6' => '0.00',
                'month_7' => '0.00',
                'month_8' => '0.00',
                'month_9' => '0.00',
                'month_10' => '0.00',
                'month_11' => '0.00',
                'month_12' => '0.00',
                'previous_year_closing_rate_local' => '1.00',
                'previous_year_closing_rate_international' => '1.00',
                'is_active' => 1,
                'created_at' => '2020-09-30 19:21:27',
                'updated_at' => '2020-10-10 16:07:47',
                'deleted_at' => NULL,
            )
        ));


    }
}
