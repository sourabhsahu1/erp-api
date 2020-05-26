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
                'character_count' => '2',
                'combined_code' => '01',
                'created_at' => NULL,
                'id' => 1,
                'individual_code' => '01',
                'is_active' => 1,
                'max_level' => 5,
                'name' => 'Administrative Segment',
                'parent_id' => NULL,
                'top_level_child_count' => 0,
                'top_level_id' => 1,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'character_count' => '2',
                'combined_code' => '02',
                'created_at' => NULL,
                'id' => 2,
                'individual_code' => '02',
                'is_active' => 1,
                'max_level' => 5,
                'name' => 'Economic Segment',
                'parent_id' => NULL,
                'top_level_child_count' => 1,
                'top_level_id' => 2,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'character_count' => '2',
                'combined_code' => '03',
                'created_at' => NULL,
                'id' => 3,
                'individual_code' => '03',
                'is_active' => 1,
                'max_level' => 5,
                'name' => 'Functional Segment',
                'parent_id' => NULL,
                'top_level_child_count' => 0,
                'top_level_id' => 3,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'character_count' => '2',
                'combined_code' => '04',
                'created_at' => NULL,
                'id' => 4,
                'individual_code' => '04',
                'is_active' => 1,
                'max_level' => 5,
                'name' => 'Programme Segment',
                'parent_id' => NULL,
                'top_level_child_count' => 0,
                'top_level_id' => 4,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'character_count' => '2',
                'combined_code' => '05',
                'created_at' => NULL,
                'id' => 5,
                'individual_code' => '05',
                'is_active' => 1,
                'max_level' => 5,
                'name' => 'Fund Segment',
                'parent_id' => NULL,
                'top_level_child_count' => 0,
                'top_level_id' => 5,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'character_count' => '2',
                'combined_code' => '06',
                'created_at' => NULL,
                'id' => 6,
                'individual_code' => '06',
                'is_active' => 1,
                'max_level' => 5,
                'name' => 'Geo Code',
                'parent_id' => NULL,
                'top_level_child_count' => 0,
                'top_level_id' => 6,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'character_count' => '1',
                'combined_code' => '02-1',
                'created_at' => NULL,
                'id' => 7,
                'individual_code' => '1',
                'is_active' => 1,
                'max_level' => 4,
                'name' => 'Revenue',
                'parent_id' => 2,
                'top_level_child_count' => 1,
                'top_level_id' => 2,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'character_count' => '1',
                'combined_code' => '02-2',
                'created_at' => NULL,
                'id' => 8,
                'individual_code' => '2',
                'is_active' => 1,
                'max_level' => 4,
                'name' => 'Expenditure',
                'parent_id' => 2,
                'top_level_child_count' => 1,
                'top_level_id' => 2,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'character_count' => '1',
                'combined_code' => '02-3',
                'created_at' => NULL,
                'id' => 9,
                'individual_code' => '3',
                'is_active' => 1,
                'max_level' => 4,
                'name' => 'Asset',
                'parent_id' => 2,
                'top_level_child_count' => 1,
                'top_level_id' => 2,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'character_count' => '1',
                'combined_code' => '02-4',
                'created_at' => NULL,
                'id' => 10,
                'individual_code' => '4',
                'is_active' => 1,
                'max_level' => 4,
                'name' => 'Liabilities',
                'parent_id' => 2,
                'top_level_child_count' => 1,
                'top_level_id' => 2,
                'updated_at' => NULL,
            ),
        ));


    }
}
