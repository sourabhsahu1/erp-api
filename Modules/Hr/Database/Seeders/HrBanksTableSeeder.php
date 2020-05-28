<?php

namespace Modules\Hr\Database\Seeders;

use Illuminate\Database\Seeder;

class HrBanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('hr_banks')->delete();
        
        \DB::table('hr_banks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'HDFC',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ICICI',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
