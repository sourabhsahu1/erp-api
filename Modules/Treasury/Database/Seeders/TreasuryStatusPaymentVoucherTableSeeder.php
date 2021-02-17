<?php
namespace Modules\Treasury\Database\Seeders;
use Illuminate\Database\Seeder;

class TreasuryStatusPaymentVoucherTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('treasury_status_payment_voucher')->delete();

        \DB::table('treasury_status_payment_voucher')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'New',
                'value' => 'NEW',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Draft',
                'value' => 'DRAFT',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Checked',
                'value' => 'CHECKED',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Approved',
                'value' => 'APPROVED',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Budget Codes Verified',
                'value' => 'BUDGET_CODES_VERIFIED',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Audited',
                'value' => 'AUDITED',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'On Mandate',
                'value' => 'ON_MANDATE',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Closed',
                'value' => 'CLOSED',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Posted to GL',
                'value' => 'POSTED_TO_GL',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
