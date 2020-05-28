<?php

namespace Modules\Hr\Database\Seeders;

use Illuminate\Database\Seeder;

class HrBankBranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('hr_bank_branches')->delete();

        \DB::table('hr_bank_branches')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Delhi cant.',
                    'bank_id' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'IP Ext',
                    'bank_id' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'South Delhi',
                    'bank_id' => 2,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'IP Ext',
                    'bank_id' => 2,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}
