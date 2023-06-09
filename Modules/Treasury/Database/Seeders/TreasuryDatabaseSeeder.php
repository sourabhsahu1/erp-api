<?php

namespace Modules\Treasury\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TreasuryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(TreasuryCashbookTypesTableSeeder::class);
         $this->call(TreasuryStatusPaymentVoucherTableSeeder::class);
         $this->call(TreasuryStatusRetireVoucherTableSeeder::class);
         $this->call(TreasuryVoucherSourceUnitsTableSeeder::class);
    }
}
