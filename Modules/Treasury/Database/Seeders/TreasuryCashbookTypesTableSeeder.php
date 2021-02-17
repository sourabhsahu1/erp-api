<?php
namespace Modules\Treasury\Database\Seeders;
use Illuminate\Database\Seeder;

class TreasuryCashbookTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('treasury_cashbook_types')->delete();

        \DB::table('treasury_cashbook_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'THIS MINISTRY/ORGAN',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2020-11-12 05:30:00',
                'updated_at' => NULL,
            ),
        ));


    }
}
