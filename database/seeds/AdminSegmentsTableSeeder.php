<?php

use Illuminate\Database\Seeder;

class AdminSegmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_segments')->delete();
        
        \DB::table('admin_segments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Administrative Segment',
                'character_count' => '4',
                'max_level' => 10,
                'individual_code' => '01',
                'combined_code' => '01',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Economic Segment',
                'character_count' => '4',
                'max_level' => 10,
                'individual_code' => '02',
                'combined_code' => '02',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Functional Segment',
                'character_count' => '4',
                'max_level' => 10,
                'individual_code' => '03',
                'combined_code' => '03',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Programme Segment',
                'character_count' => '4',
                'max_level' => 10,
                'individual_code' => '04',
                'combined_code' => '04',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Fund Segment',
                'character_count' => '4',
                'max_level' => 10,
                'individual_code' => '05',
                'combined_code' => '05',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Geo Code Segment',
                'character_count' => '4',
                'max_level' => 10,
                'individual_code' => '06',
                'combined_code' => '06',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Revenue',
                'character_count' => '4',
                'max_level' => 9,
                'individual_code' => '01',
                'combined_code' => '0201',
                'is_active' => 1,
                'parent_id' => 2,
            ),
            7 => 
            array (
                'id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Expenditure',
                'character_count' => '4',
                'max_level' => 9,
                'individual_code' => '02',
                'combined_code' => '0202',
                'is_active' => 1,
                'parent_id' => 2,
            ),
            8 => 
            array (
                'id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Asset',
                'character_count' => '4',
                'max_level' => 9,
                'individual_code' => '03',
                'combined_code' => '0203',
                'is_active' => 1,
                'parent_id' => 2,
            ),
            9 => 
            array (
                'id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Liabilities',
                'character_count' => '4',
                'max_level' => 9,
                'individual_code' => '04',
                'combined_code' => '0204',
                'is_active' => 1,
                'parent_id' => 2,
            ),
        ));
        
        
    }
}