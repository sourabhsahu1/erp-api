<?php

namespace Modules\Hr\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HrDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(HrReligionsTableSeeder::class);
        $this->call(HrTypeOfAppointmentsTableSeeder::class);
        $this->call(HrMarriageTableSeeder::class);
        $this->call(HrBanksTableSeeder::class);
        $this->call(HrBankBranchesTableSeeder::class);
    }
}
