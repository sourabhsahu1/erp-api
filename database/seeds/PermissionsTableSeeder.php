<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'COMAPNIES',
                'entity_name' => 'COMPANIES',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'COMAPNIES > CREATE',
                'entity_name' => 'COMPANIES.CREATE',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'COMAPNIES > LIST',
                'entity_name' => 'COMPANIES.LIST',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'COMPANIES > UPDATE',
                'entity_name' => 'COMPANIES.UPDATE',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'COMAPNIES > DELETE',
                'entity_name' => 'COMPANIES.DELETE',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'COMAPNIES > BANK > CREATE',
                'entity_name' => 'COMAPNIES.BANK.CREATE',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'TAXES',
                'entity_name' => 'TAXES',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'TAXES > LIST',
                'entity_name' => 'TAXES.LIST',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'TAXES > CREATE',
                'entity_name' => 'TAXES.CREATE',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'TAXES > UPDATE',
                'entity_name' => 'TAXES.UPDATE',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'TAXES > DELETE',
                'entity_name' => 'TAXES.DELETE',
                'module' => 'ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}