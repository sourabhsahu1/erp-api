<?php

namespace Modules\Hr\Database\Seeders;

use Illuminate\Database\Seeder;

class HrReligionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('hr_religions')->delete();

        \DB::table('hr_religions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'OTHER',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'CHRISTIANITY',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'ISLAM',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}