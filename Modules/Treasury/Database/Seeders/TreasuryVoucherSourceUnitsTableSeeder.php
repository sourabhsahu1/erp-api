<?php
namespace Modules\Treasury\Database\Seeders;
use Illuminate\Database\Seeder;

class TreasuryVoucherSourceUnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('treasury_voucher_source_units')->delete();

        \DB::table('treasury_voucher_source_units')->insert(array (
            0 =>
            array (
                'id' => 10,
                'long_name' => 'Reversed Vouchers',
                'short_name' => 'REV',
                'next_pv_index_number' => 1,
                'next_rv_index_number' => 1,
                'honour_certificate' => '',
                'checking_officer_id' => NULL,
                'paying_officer_id' => NULL,
                'financial_controller_id' => NULL,
                'retirement_id' => 0,
                'reverse_voucher_id' => 0,
                'revalidation_id' => 0,
                'tax_voucher_id' => 0,
                'is_personal_advance_unit' => 0,
                'is_editable' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 11,
                'long_name' => 'Retirement Vouchers',
                'short_name' => 'RETR',
                'next_pv_index_number' => 1,
                'next_rv_index_number' => 1,
                'honour_certificate' => '',
                'checking_officer_id' => NULL,
                'paying_officer_id' => NULL,
                'financial_controller_id' => NULL,
                'retirement_id' => 0,
                'reverse_voucher_id' => 0,
                'revalidation_id' => 0,
                'tax_voucher_id' => 0,
                'is_personal_advance_unit' => 0,
                'is_editable' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 19,
                'long_name' => 'Revalidated Vouchers',
                'short_name' => 'RVLD',
                'next_pv_index_number' => 1,
                'next_rv_index_number' => 1,
                'honour_certificate' => '',
                'checking_officer_id' => NULL,
                'paying_officer_id' => NULL,
                'financial_controller_id' => NULL,
                'retirement_id' => 0,
                'reverse_voucher_id' => 0,
                'revalidation_id' => 0,
                'tax_voucher_id' => 0,
                'is_personal_advance_unit' => 0,
                'is_editable' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 20,
            'long_name' => 'Central Pay Office (CPO)',
                'short_name' => 'CPO',
                'next_pv_index_number' => 1,
                'next_rv_index_number' => 1,
                'honour_certificate' => '',
                'checking_officer_id' => NULL,
                'paying_officer_id' => NULL,
                'financial_controller_id' => NULL,
                'retirement_id' => 0,
                'reverse_voucher_id' => 0,
                'revalidation_id' => 0,
                'tax_voucher_id' => 0,
                'is_personal_advance_unit' => 0,
                'is_editable' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 21,
                'long_name' => 'Other Charges',
                'short_name' => '45',
                'next_pv_index_number' => 1,
                'next_rv_index_number' => 1,
                'honour_certificate' => '',
                'checking_officer_id' => NULL,
                'paying_officer_id' => NULL,
                'financial_controller_id' => NULL,
                'retirement_id' => 0,
                'reverse_voucher_id' => 0,
                'revalidation_id' => 0,
                'tax_voucher_id' => 0,
                'is_personal_advance_unit' => 0,
                'is_editable' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 22,
                'long_name' => 'Advances',
                'short_name' => 'ADV',
                'next_pv_index_number' => 1,
                'next_rv_index_number' => 1,
                'honour_certificate' => '',
                'checking_officer_id' => NULL,
                'paying_officer_id' => NULL,
                'financial_controller_id' => NULL,
                'retirement_id' => 0,
                'reverse_voucher_id' => 0,
                'revalidation_id' => 0,
                'tax_voucher_id' => 0,
                'is_personal_advance_unit' => 1,
                'is_editable' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 23,
                'long_name' => 'Personnel',
                'short_name' => 'PER',
                'next_pv_index_number' => 1,
                'next_rv_index_number' => 1,
                'honour_certificate' => '',
                'checking_officer_id' => NULL,
                'paying_officer_id' => NULL,
                'financial_controller_id' => NULL,
                'retirement_id' => 0,
                'reverse_voucher_id' => 0,
                'revalidation_id' => 0,
                'tax_voucher_id' => 0,
                'is_personal_advance_unit' => 0,
                'is_editable' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
