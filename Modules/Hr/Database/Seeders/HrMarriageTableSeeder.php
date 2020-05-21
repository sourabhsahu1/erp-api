<?php

namespace Modules\Hr\Database\Seeders;

use Illuminate\Database\Seeder;

class HrMarriageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('hr_marriage')->delete();

        \DB::table('hr_marriage')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'status' => 'MARRIED',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'status' => 'SINGLE',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'status' => 'DIVORCED',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'status' => 'WIDOWED',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'status' => 'OTHER',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}