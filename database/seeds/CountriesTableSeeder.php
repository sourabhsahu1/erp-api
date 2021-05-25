<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('countries')->delete();

        \DB::table('countries')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Nigeria',
                'is_child_enabled' => 1,
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2020-05-26 17:27:39',
                'updated_at' => '2020-06-19 17:08:41',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'United States',
                'is_child_enabled' => 1,
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2020-05-26 17:27:52',
                'updated_at' => '2020-06-01 21:46:40',
            )
        ));


    }
}
