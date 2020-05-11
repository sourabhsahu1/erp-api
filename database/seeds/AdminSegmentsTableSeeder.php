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
                'combined_code' => '01',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Administrative Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '01',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'combined_code' => '02',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Economic Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '02',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'combined_code' => '03',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Functional Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '03',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'combined_code' => '04',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Programme Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '04',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'combined_code' => '05',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Fund Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '05',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'combined_code' => '06',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Geo Code',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '06',
                'is_active' => 1,
                'parent_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'combined_code' => '0201',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Revenue',
                'character_count' => '4',
                'max_level' => 9,
                'individual_code' => '01',
                'is_active' => 1,
                'parent_id' => 2,
            ),
            7 => 
            array (
                'id' => 8,
                'combined_code' => '0202',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Expenditure',
                'character_count' => '4',
                'max_level' => 9,
                'individual_code' => '02',
                'is_active' => 1,
                'parent_id' => 2,
            ),
            8 => 
            array (
                'id' => 9,
                'combined_code' => '0203',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'Asset',
                'character_count' => '4',
                'max_level' => 9,
                'individual_code' => '03',
                'is_active' => 1,
                'parent_id' => 2,
            ),
            9 => 
            array (
                'id' => 18,
                'combined_code' => '020301',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'tesst',
                'character_count' => '2',
                'max_level' => 8,
                'individual_code' => '01',
                'is_active' => 1,
                'parent_id' => 9,
            ),
            10 => 
            array (
                'id' => 20,
                'combined_code' => '020302',
                'created_at' => NULL,
                'updated_at' => NULL,
                'name' => 'asdad',
                'character_count' => '2',
                'max_level' => 8,
                'individual_code' => '02',
                'is_active' => 1,
                'parent_id' => 9,
            ),
        ));
        
        
    }
}