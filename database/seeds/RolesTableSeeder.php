<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'role' => 'Admin',
                    'description' => 'Admin',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'role' => 'Payroll Administration',
                    'description' => 'Payroll Administration',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'role' => 'Inventory Stores Administration',
                    'description' => 'Inventory Stores Administration',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'role' => 'Fixed Assets Administration',
                    'description' => 'Fixed Assets Administration',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'role' => 'Financials',
                    'description' => 'Financials',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'role' => 'Treasury Management',
                    'description' => 'Treasury Management',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'role' => 'Human Resource Manager',
                    'description' => 'Human Resource Manager',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'role' => 'Employee Custom',
                    'description' => 'Employee Custom Detail',
                    'deleted_at' => NULL,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                ),
        ));


    }
}
