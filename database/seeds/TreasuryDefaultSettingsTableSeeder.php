<?php

use Illuminate\Database\Seeder;

class TreasuryDefaultSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('treasury_default_settings')->delete();

        \DB::table('treasury_default_settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'account_head_id' => 1,
                'sub_organisation_id' => 1,
                'admin_segment_id' => 1,
                'fund_segment_id' => 5,
                'economic_segment_id' => 2,
                'program_segment_id' => 4,
                'functional_segment_id' => 3,
                'geo_code_segment_id' => 6,
                'checking_officer_id' => 1,
                'paying_officer_id' => 1,
                'financial_controller_id' => 1,
                'deleted_at' => NULL,
                'created_at' => '2020-11-18 11:25:51',
                'updated_at' => '2020-12-05 12:57:55',
            ),
        ));


    }
}
