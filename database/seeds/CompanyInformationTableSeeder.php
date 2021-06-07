<?php

use Illuminate\Database\Seeder;

class CompanyInformationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('company_information')->delete();
        
        \DB::table('company_information')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Abuja Corp',
                'short_code' => 'ITL',
                'address' => '1-301, Sector 18',
                'email' => 'info@gmail.com',
                'phone' => '9999999999',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}