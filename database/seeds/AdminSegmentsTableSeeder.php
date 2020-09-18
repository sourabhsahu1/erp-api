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
                'name' => 'Administrative Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '01',
                'combined_code' => '',
                'is_active' => 1,
                'top_level_id' => 1,
                'top_level_child_count' => 4,
                'parent_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Economic Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '02',
                'combined_code' => '',
                'is_active' => 1,
                'top_level_id' => 2,
                'top_level_child_count' => 1,
                'parent_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Functional Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '03',
                'combined_code' => '',
                'is_active' => 1,
                'top_level_id' => 3,
                'top_level_child_count' => 0,
                'parent_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Programme Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '04',
                'combined_code' => '',
                'is_active' => 1,
                'top_level_id' => 4,
                'top_level_child_count' => 0,
                'parent_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Fund Segment',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '05',
                'combined_code' => '',
                'is_active' => 1,
                'top_level_id' => 5,
                'top_level_child_count' => 0,
                'parent_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Geo Code',
                'character_count' => '2',
                'max_level' => 5,
                'individual_code' => '06',
                'combined_code' => '',
                'is_active' => 1,
                'top_level_id' => 6,
                'top_level_child_count' => 0,
                'parent_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Revenue',
                'character_count' => '1',
                'max_level' => 4,
                'individual_code' => '1',
                'combined_code' => '1',
                'is_active' => 1,
                'top_level_id' => 2,
                'top_level_child_count' => 1,
                'parent_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Expenditure',
                'character_count' => '1',
                'max_level' => 4,
                'individual_code' => '2',
                'combined_code' => '2',
                'is_active' => 1,
                'top_level_id' => 2,
                'top_level_child_count' => 1,
                'parent_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Asset',
                'character_count' => '1',
                'max_level' => 4,
                'individual_code' => '3',
                'combined_code' => '3',
                'is_active' => 1,
                'top_level_id' => 2,
                'top_level_child_count' => 1,
                'parent_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Liabilities',
                'character_count' => '1',
                'max_level' => 4,
                'individual_code' => '4',
                'combined_code' => '4',
                'is_active' => 1,
                'top_level_id' => 2,
                'top_level_child_count' => 1,
                'parent_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
