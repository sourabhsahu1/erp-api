<?php

use Illuminate\Database\Seeder;

class CompanySettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('company_settings')->delete();

        \DB::table('company_settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'company_information_id' => 1,
                'country' => 'Nigeria',
                'local_currency' => 'NGN',
                'auto_post' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-03-05 13:03:31',
                'deleted_at' => NULL,
                'international_currency' => 'NGN',
                'is_payment_approval' => 1,
                'default_status' => 'POSTED',
            ),
        ));


    }
}
