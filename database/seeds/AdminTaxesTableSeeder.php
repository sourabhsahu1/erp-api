<?php

use Illuminate\Database\Seeder;

class AdminTaxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('admin_taxes')->delete();

        \DB::table('admin_taxes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'VAT',
                'tax' => 1.0,
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2021-04-08 10:39:41',
                'updated_at' => '2021-04-14 13:59:57',
                'department_id' => 1,
                'company_id' => 4,
            ),
            1 =>
                array (
                    'id' => 1,
                    'name' => 'WHT',
                    'tax' => 1.0,
                    'is_active' => 1,
                    'deleted_at' => NULL,
                    'created_at' => '2021-04-08 10:39:41',
                    'updated_at' => '2021-04-14 13:59:57',
                    'department_id' => NULL,
                    'company_id' => NULL,
                ),
        ));


    }
}
