<?php

namespace Modules\Hr\Database\Seeders;

use Illuminate\Database\Seeder;

class HrTypeOfAppointmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('hr_type_of_appointments')->delete();

        \DB::table('hr_type_of_appointments')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'type' => 'TENURED',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'type' => 'CONTRACT',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'type' => 'ADJUNCT',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'type' => 'FULL_TIME',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'type' => 'MONTH_TO_MONTH',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'type' => 'NOT_APPLICABLE',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'type' => 'PERMANENT_STAFF',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'type' => 'SABBATICAL',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            8 =>
                array(
                    'id' => 9,
                    'type' => 'TEMPORARY',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            9 =>
                array(
                    'id' => 10,
                    'type' => 'VISITING',
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}