<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(AdminSegmentsTableSeeder::class);
        $this->call(AdminSegmentLevelConfigTableSeeder::class);
        $this->call(CountryCodesTableSeeder::class);
        $this->call(CompanyConfigTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CompanyInformationTableSeeder::class);
        $this->call(CompanySettingsTableSeeder::class);
        $this->call(TreasuryDefaultSettingsTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
        $this->call(AdminCompaniesTableSeeder::class);
        $this->call(AdminTaxesTableSeeder::class);
    }
}
