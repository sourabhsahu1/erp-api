<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Companies',
                'entity_name' => 'COMPANIES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Companies create',
                'entity_name' => 'COMPANIES.CREATE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Companies list',
                'entity_name' => 'COMPANIES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'companies update',
                'entity_name' => 'COMPANIES.UPDATE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'companies delete',
                'entity_name' => 'COMPANIES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'companies bank create',
                'entity_name' => 'COMAPNIES.BANK.CREATE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'taxes edit',
                'entity_name' => 'TAXES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'taxes list',
                'entity_name' => 'TAXES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'taxes create',
                'entity_name' => 'TAXES.CREATE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'taxes delete',
                'entity_name' => 'TAXES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Banks',
                'entity_name' => 'BANKS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Countries',
                'entity_name' => 'COUNTIRES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Currencies',
                'entity_name' => 'CURRENCIES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Customers',
                'entity_name' => 'PAYERS.PAYEES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Auto-Update Functions List',
                'entity_name' => 'AUTO.UPDATE.FUNCS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Access Delete button in maintenance forms',
                'entity_name' => 'MAINTCE.DEL',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Access Edit button in maintenance forms',
                'entity_name' => 'MAINTENANCE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Access Delete button in transaction forms',
                'entity_name' => 'TRANSACTION.DEL',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Access Edit button in transaction forms',
                'entity_name' => 'TRANSSACTION.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'User Accounts',
                'entity_name' => 'USERS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Group Accounts',
                'entity_name' => 'USERS.GROUPS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Store Setup: Items Add',
                'entity_name' => 'ITEMS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Store Setup: Items edit',
                'entity_name' => 'ITEMS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Store Setup: Items list',
                'entity_name' => 'ITEMS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Store Setup: Items delete',
                'entity_name' => 'ITEMS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Store Setup: Categories Add',
                'entity_name' => 'CATEGORIES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Store Setup: Categories Edit',
                'entity_name' => 'CATEGORIES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Store Setup: Categories List',
                'entity_name' => 'CATEGORIES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Store Setup: Categories Delete',
                'entity_name' => 'CATEGORIES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Store Setup: Stores Add',
                'entity_name' => 'STORES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Store Setup Stores Edit',
                'entity_name' => 'STORES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Store Setup: Stores List',
                'entity_name' => 'STORES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Store Setup: Stores Delete',
                'entity_name' => 'STORES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Store Setup: Unit of Measures Add',
                'entity_name' => 'UNIT.OF.MEASURES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Store Setup: Unit of Measures Edit',
                'entity_name' => 'UNIT.OF.MEASURES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Store Setup: Unit of Measures List',
                'entity_name' => 'UNIT.OF.MEASURES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Store Setup: Unit of Measures Delete',
                'entity_name' => 'UNIT.OF.MEASURES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Transaction: SRV Purchase invoice list',
                'entity_name' => 'SRV.PURCHASE.INVOICE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Transaction: SRV return invoice list',
                'entity_name' => 'SRV.PURCHASE.RETURN.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Transaction: Sales Invoice List',
                'entity_name' => 'SALES.INVOICE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Transaction: sales return by customer list',
                'entity_name' => 'SALES.RETURN.BY.CUSTOMER.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Transaction: STV store transfer list',
                'entity_name' => 'STV.STORE.TRANSFER.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Transaction: store adjustment list',
                'entity_name' => 'STORE.ADJUSTMENT.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Transaction: donation list',
                'entity_name' => 'TRANSACTION.DONATION.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Report: bin card list',
                'entity_name' => 'BIN.CARD.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Report: inventory ledger list',
                'entity_name' => 'INVENTORY.LEDGER.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Report: quality balance list',
                'entity_name' => 'QUALITY.BALANCE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Report: off level list',
                'entity_name' => 'OFF.LEVEL.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Admin: Create Designation',
                'entity_name' => 'DESIGNATIONS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Admin: List designation',
                'entity_name' => 'DESIGNATIONS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Delete designation',
                'entity_name' => 'DESIGNATIONS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Admin: Update Designations',
                'entity_name' => 'DESIGNATIONS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Add salary scale',
                'entity_name' => 'SALARY.SCALES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Admin: Update Salary Scales',
                'entity_name' => 'SALARY.SCALES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Delete salary scale',
                'entity_name' => 'SALARY.SCALES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'List salary scale',
                'entity_name' => 'SALARY.SCALES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Add qualification',
                'entity_name' => 'QUALIFICATIONS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Admin: Update Types of Qualification',
                'entity_name' => 'QUALIFICATIONS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'List qualification',
                'entity_name' => 'QUALIFICATIONS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'delete qualification',
                'entity_name' => 'QUALIFICATIONS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Add Job skill',
                'entity_name' => 'JOB.SKILLS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Admin: Update Job Skills',
                'entity_name' => 'JOB.SKILLS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'List job skills',
                'entity_name' => 'JOB.SKILLS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Delete job skills',
                'entity_name' => 'JOB.SKILLS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Add Language',
                'entity_name' => 'LANGUAGES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Admin: Update Languages',
                'entity_name' => 'LANGUAGES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'List language',
                'entity_name' => 'LANGUAGES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'language delele',
                'entity_name' => 'LANGUAGES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Add School categories ',
                'entity_name' => 'SCHOOL.CATEGORIES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Admin: Update School Categories',
                'entity_name' => 'SCHOOL.CATEGORIES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'School categories list',
                'entity_name' => 'SCHOOL.CATEGORIES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'School categories delete',
                'entity_name' => 'SCHOOL.CATEGORIES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'academic majors add',
                'entity_name' => 'ACADEMIC.MAJORS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Admin: Update Academic Majors',
                'entity_name' => 'ACADEMIC.MAJORS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'academic majors list',
                'entity_name' => 'ACADEMIC.MAJORS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'academic majors delete',
                'entity_name' => 'ACADEMIC.MAJORS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Relations add',
                'entity_name' => 'RELATIONS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Admin: Update Relationships',
                'entity_name' => 'RELATIONS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Relations list',
                'entity_name' => 'RELATIONS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Relations delete',
                'entity_name' => 'RELATIONS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'staff add',
                'entity_name' => 'STAFF.CATEGORIES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Admin: Update Staff Categories',
                'entity_name' => 'STAFF.CATEGORIES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'staff list',
                'entity_name' => 'STAFF.CATEGORIES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'staff delete',
                'entity_name' => 'STAFF.CATEGORIES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'staff status add',
                'entity_name' => 'STAFF.STATUS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Admin: Update Staff Status',
                'entity_name' => 'STAFF.STATUS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'staff status list',
                'entity_name' => 'STAFF.STATUS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'staff status delete',
                'entity_name' => 'STAFF.STATUS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'exit option add',
                'entity_name' => 'EXIT.OPTIONS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            89 => 
            array (
                'id' => 90,
            'name' => 'Admin: Update Disengagement (i.e Exit) Options',
                'entity_name' => 'EXIT.OPTIONS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'exit option list',
                'entity_name' => 'EXIT.OPTIONS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'exit option delete',
                'entity_name' => 'EXIT.OPTIONS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Censures Add',
                'entity_name' => 'CENSURES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Admin: Update Types of Staff Censure',
                'entity_name' => 'CENSURES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'Censures list',
                'entity_name' => 'CENSURES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Censures delete',
                'entity_name' => 'CENSURES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Arms of service add',
                'entity_name' => 'ARMS.OF.SERVICE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Admin: Update Arms Of Service',
                'entity_name' => 'ARMS.OF.SERVICE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Arms of service list',
                'entity_name' => 'ARMS.OF.SERVICE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Arms of service delete',
                'entity_name' => 'ARMS.OF.SERVICE.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Membership add',
                'entity_name' => 'MEMBERSHIPS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Admin: Update Memberships',
                'entity_name' => 'MEMBERSHIPS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Membership list',
                'entity_name' => 'MEMBERSHIPS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Membership delete',
                'entity_name' => 'MEMBERSHIPS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Types of Leave Add',
                'entity_name' => 'TYPES.OF.LEAVE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Admin: Update Types Of Leave',
                'entity_name' => 'TYPES.OF.LEAVE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Types of Leave list',
                'entity_name' => 'TYPES.OF.LEAVE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Types of Leave delete',
                'entity_name' => 'TYPES.OF.LEAVE.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Leave group Add',
                'entity_name' => 'LEAVE.GROUP.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'Admin: Update Leave Groups',
                'entity_name' => 'LEAVE.GROUP.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'Leave group list',
                'entity_name' => 'LEAVE.GROUP.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'Leave group delete',
                'entity_name' => 'LEAVE.GROUP.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Public holiday Add',
                'entity_name' => 'PUBLIC.HOLIDAYS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Admin: Update Public Holidays',
                'entity_name' => 'PUBLIC.HOLIDAYS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Public holiday list',
                'entity_name' => 'PUBLIC.HOLIDAYS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'Public holiday delete',
                'entity_name' => 'PUBLIC.HOLIDAYS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Address add',
                'entity_name' => 'ADDRESSES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Admin: Update Types of Address',
                'entity_name' => 'ADDRESSES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Address list',
                'entity_name' => 'ADDRESSES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'Address delete',
                'entity_name' => 'ADDRESSES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'Types of phone number add',
                'entity_name' => 'TYPES.OF.PHONE.NUM.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'Admin: Update Types of Phone Number',
                'entity_name' => 'TYPES.OF.PHONE.NUM.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'Types of phone number list',
                'entity_name' => 'TYPES.OF.PHONE.NUM.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'Types of phone number delete',
                'entity_name' => 'TYPES.OF.PHONE.NUM.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'Geo location add',
                'entity_name' => 'GEO.LOC.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'Admin: Update Geo. Locations',
                'entity_name' => 'GEO.LOC.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'Geo location list',
                'entity_name' => 'GEO.LOC.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'Geo location delete',
                'entity_name' => 'GEO.LOC.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'Company Information Add',
                'entity_name' => 'COMPANY.INFO.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            129 => 
            array (
                'id' => 130,
            'name' => 'Admin: Update General (Comp. Info)',
                'entity_name' => 'COMPANY.INFO.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'Company Information list',
                'entity_name' => 'COMPANY.INFO.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'Company Information delete',
                'entity_name' => 'COMPANY.INFO.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'Office location add',
                'entity_name' => 'OFFICE.LOCACTION.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'Admin: Update Office Locations',
                'entity_name' => 'OFFICE.LOCACTION.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'Office location list',
                'entity_name' => 'OFFICE.LOCACTION.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            135 => 
            array (
                'id' => 136,
                'name' => 'Office location delete',
                'entity_name' => 'OFFICE.LOCACTION.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            136 => 
            array (
                'id' => 137,
                'name' => 'Job position Add',
                'entity_name' => 'JOB.POSITION.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            137 => 
            array (
                'id' => 138,
                'name' => 'Admin: Update Job Positions',
                'entity_name' => 'JOB.POSITION.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            138 => 
            array (
                'id' => 139,
                'name' => 'Job position list',
                'entity_name' => 'JOB.POSITION.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            139 => 
            array (
                'id' => 140,
                'name' => 'Job position delete',
                'entity_name' => 'JOB.POSITION.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            140 => 
            array (
                'id' => 141,
                'name' => 'Deparment add',
                'entity_name' => 'DEPARTMENT.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            141 => 
            array (
                'id' => 142,
                'name' => 'Admin: Update Departments',
                'entity_name' => 'DEPARTMENT.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            142 => 
            array (
                'id' => 143,
                'name' => 'Deparment list',
                'entity_name' => 'DEPARTMENT.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            143 => 
            array (
                'id' => 144,
                'name' => 'Deparment delete',
                'entity_name' => 'DEPARTMENT.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            144 => 
            array (
                'id' => 145,
                'name' => 'Work locations add',
                'entity_name' => 'WORK.LOCATIONS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            145 => 
            array (
                'id' => 146,
                'name' => 'Work locations edit ',
                'entity_name' => 'WORK.LOCATIONS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            146 => 
            array (
                'id' => 147,
                'name' => 'Work locations list',
                'entity_name' => 'WORK.LOCATIONS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            147 => 
            array (
                'id' => 148,
                'name' => 'Work locations delete',
                'entity_name' => 'WORK.LOCATIONS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            148 => 
            array (
                'id' => 149,
                'name' => 'structure add',
                'entity_name' => 'STRUCTURE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            149 => 
            array (
                'id' => 150,
                'name' => 'structure edit',
                'entity_name' => 'STRUCTURE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            150 => 
            array (
                'id' => 151,
                'name' => 'structure list',
                'entity_name' => 'STRUCTURE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            151 => 
            array (
                'id' => 152,
                'name' => 'structure delete',
                'entity_name' => 'STRUCTURE.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            152 => 
            array (
                'id' => 153,
                'name' => 'Countries add',
                'entity_name' => 'COUNTIRES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            153 => 
            array (
                'id' => 154,
                'name' => 'Countries edit',
                'entity_name' => 'COUNTIRES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            154 => 
            array (
                'id' => 155,
                'name' => 'Countries list',
                'entity_name' => 'COUNTIRES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            155 => 
            array (
                'id' => 156,
                'name' => 'Countries delete',
                'entity_name' => 'COUNTIRES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            156 => 
            array (
                'id' => 157,
                'name' => 'Region add',
                'entity_name' => 'REGION.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            157 => 
            array (
                'id' => 158,
                'name' => 'Region edit',
                'entity_name' => 'REGION.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            158 => 
            array (
                'id' => 159,
                'name' => 'Region list',
                'entity_name' => 'REGION.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            159 => 
            array (
                'id' => 160,
                'name' => 'Region delete',
                'entity_name' => 'REGION.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            160 => 
            array (
                'id' => 161,
                'name' => 'States add',
                'entity_name' => 'STATES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            161 => 
            array (
                'id' => 162,
                'name' => 'States edit',
                'entity_name' => 'STATES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            162 => 
            array (
                'id' => 163,
                'name' => 'States list',
                'entity_name' => 'STATES.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            163 => 
            array (
                'id' => 164,
                'name' => 'States delete',
                'entity_name' => 'STATES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            164 => 
            array (
                'id' => 165,
                'name' => 'Lga add',
                'entity_name' => 'LGA.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            165 => 
            array (
                'id' => 166,
                'name' => 'lga list',
                'entity_name' => 'LGA.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'lga list',
                'entity_name' => 'LGA.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'lga delete',
                'entity_name' => 'LGA.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'Schedule Add',
                'entity_name' => 'SCHEDULE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'Schedule edit',
                'entity_name' => 'SCHEDULE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'Schedule list',
                'entity_name' => 'SCHEDULE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'Schedule delete',
                'entity_name' => 'SCHEDULE.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            172 => 
            array (
                'id' => 173,
                'name' => 'Disengagements ADD',
                'entity_name' => 'DISENGAGEMENT.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            173 => 
            array (
                'id' => 174,
                'name' => 'Disengagements EDIT',
                'entity_name' => 'DISENGAGEMENT.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            174 => 
            array (
                'id' => 175,
                'name' => 'Disengagements LIST',
                'entity_name' => 'DISENGAGEMENT.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            175 => 
            array (
                'id' => 176,
                'name' => 'Disengagements DELETE',
                'entity_name' => 'DISENGAGEMENT.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            176 => 
            array (
                'id' => 177,
                'name' => 'Grade level list',
                'entity_name' => 'GRADE.LEVEL.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            177 => 
            array (
                'id' => 178,
                'name' => 'GL step list',
                'entity_name' => 'GL.STEP.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            178 => 
            array (
                'id' => 179,
                'name' => 'Employees: - Add',
                'entity_name' => 'ADD.EMPLOYEE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            179 => 
            array (
                'id' => 180,
                'name' => 'EMPLOYEE LIST',
                'entity_name' => 'EMPLOYEE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            180 => 
            array (
                'id' => 181,
                'name' => 'Employee add enrollment list',
                'entity_name' => 'EMPLOYEE.ADD.ENROLLMENT.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            181 => 
            array (
                'id' => 182,
                'name' => 'Employees: - Activate',
                'entity_name' => 'ACTIVATE.EMPLOYEE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            182 => 
            array (
                'id' => 183,
                'name' => 'Employees: - Delete',
                'entity_name' => 'DELETE.EMPLOYEE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            183 => 
            array (
                'id' => 184,
                'name' => 'Employees: - Update Photo File',
                'entity_name' => 'UPDATE.EMPLOYEE.PHOTO.FILE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            184 => 
            array (
                'id' => 185,
                'name' => 'Employees: - Edit',
                'entity_name' => 'EDIT.EMPLOYEE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            185 => 
            array (
                'id' => 186,
                'name' => 'Employees: - Edit Extended Profile',
                'entity_name' => 'EDIT.EMPLOYEE.DETAILS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            186 => 
            array (
                'id' => 187,
                'name' => 'Employees: - Edit Addresses',
                'entity_name' => 'EDIT.EMPLOYEE.ADDRESS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            187 => 
            array (
                'id' => 188,
                'name' => 'Employees: - Edit Censures',
                'entity_name' => 'EDIT.EMPLOYEE.CENSURE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            188 => 
            array (
                'id' => 189,
                'name' => 'Employees: - Edit Employment History',
                'entity_name' => 'EDIT.EMPLOYEE.HISTORY',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            189 => 
            array (
                'id' => 190,
                'name' => 'Employees: - Edit Languages',
                'entity_name' => 'EDIT.EMPLOYEE.LANGS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            190 => 
            array (
                'id' => 191,
                'name' => 'Employees: - Edit Prof. Membership',
                'entity_name' => 'EDIT.EMPLOYEE.PROF.MEMBER',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            191 => 
            array (
                'id' => 192,
                'name' => 'Employees: - Edit Other Membership',
                'entity_name' => 'EDIT.EMPLOYEE.OTHER.MEMBER',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            192 => 
            array (
                'id' => 193,
                'name' => 'Employees: - Edit Military Service',
                'entity_name' => 'EDIT.EMPLOYEE.MILITARY.SERVICE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            193 => 
            array (
                'id' => 194,
                'name' => 'Employees: - Edit Phones Numbers',
                'entity_name' => 'EDIT.EMPLOYEE.PHONES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            194 => 
            array (
                'id' => 195,
                'name' => 'Employees: - Edit Progression',
                'entity_name' => 'EDIT.EMPLOYEE.PROGRESS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            195 => 
            array (
                'id' => 196,
                'name' => 'Employees: - Edit Qualifications',
                'entity_name' => 'EDIT.EMPLOYEE.QUALIFICATION',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            196 => 
            array (
                'id' => 197,
                'name' => 'Employees: - Edit Relations',
                'entity_name' => 'EDIT.EMPLOYEE.RELATIONS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            197 => 
            array (
                'id' => 198,
                'name' => 'Employees: - Edit Schools Attended',
                'entity_name' => 'EDIT.EMPLOYEE.SCHOOLS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            198 => 
            array (
                'id' => 199,
                'name' => 'Employees: - Edit Job Skills',
                'entity_name' => 'EDIT.EMPLOYEE.SKILLS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            199 => 
            array (
                'id' => 200,
                'name' => 'Employees: - Capture Photo',
                'entity_name' => 'EDIT.EMPLOYEE.PHOTO',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            200 => 
            array (
                'id' => 201,
                'name' => 'Employees: - Exit Employee',
                'entity_name' => 'EDIT.EMPLOYEE.EXIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            201 => 
            array (
                'id' => 202,
                'name' => 'Employees: - Confirm Employee',
                'entity_name' => 'EDIT.EMPLOYEE.CONFIRM',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            202 => 
            array (
                'id' => 203,
                'name' => 'Employees: - Print List/Profile',
                'entity_name' => 'PRINT.EMPLOYEES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            203 => 
            array (
                'id' => 204,
                'name' => 'Users: - Add',
                'entity_name' => 'ADD.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            204 => 
            array (
                'id' => 205,
                'name' => 'Users: - Edit',
                'entity_name' => 'EDIT.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            205 => 
            array (
                'id' => 206,
                'name' => 'Users: - Delete',
                'entity_name' => 'DELETE.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            206 => 
            array (
                'id' => 207,
                'name' => 'User Roles: - Add',
                'entity_name' => 'ADD.ROLE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            207 => 
            array (
                'id' => 208,
                'name' => 'User Roles: - Edit',
                'entity_name' => 'EDIT.ROLE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            208 => 
            array (
                'id' => 209,
                'name' => 'User Roles: - Delete',
                'entity_name' => 'DELETE.ROLE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            209 => 
            array (
                'id' => 210,
                'name' => 'COA list',
                'entity_name' => 'COA.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            210 => 
            array (
                'id' => 211,
                'name' => 'coa add char count config',
                'entity_name' => 'COA.ADD.CHAR.COUNT.CONFIG',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            211 => 
            array (
                'id' => 212,
                'name' => 'coa admin segment details list',
                'entity_name' => 'COA.ADMIN.SEGMENT.DETAILS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            212 => 
            array (
                'id' => 213,
                'name' => 'COA edit',
                'entity_name' => 'COA.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            213 => 
            array (
                'id' => 214,
                'name' => 'COA Segments: Administrative',
                'entity_name' => 'EDIT.COA.ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            214 => 
            array (
                'id' => 215,
                'name' => 'COA Segments: Functional',
                'entity_name' => 'EDIT.COA.FUNC',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            215 => 
            array (
                'id' => 216,
                'name' => 'COA Segments: Programme',
                'entity_name' => 'EDIT.COA.PROG',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            216 => 
            array (
                'id' => 217,
                'name' => 'COA Segments: Geo Code',
                'entity_name' => 'EDIT.COA.GEO',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            217 => 
            array (
                'id' => 218,
                'name' => 'COA Segments: Fund',
                'entity_name' => 'EDIT.COA.FUND',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            218 => 
            array (
                'id' => 219,
                'name' => 'COA Segments: Economic',
                'entity_name' => 'EDIT.COA.ECONO',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            219 => 
            array (
                'id' => 220,
                'name' => 'Logins: Add New',
                'entity_name' => 'ADD.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            220 => 
            array (
                'id' => 221,
                'name' => 'Logins: Edit',
                'entity_name' => 'EDIT.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            221 => 
            array (
                'id' => 222,
                'name' => 'Logins: Delete',
                'entity_name' => 'DELETE.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            222 => 
            array (
                'id' => 223,
                'name' => 'Login Roles: List roles',
                'entity_name' => 'ROLE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            223 => 
            array (
                'id' => 224,
                'name' => 'Login Roles: Add New',
                'entity_name' => 'ROLE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            224 => 
            array (
                'id' => 225,
                'name' => 'Login Roles: Edit',
                'entity_name' => 'ROLE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            225 => 
            array (
                'id' => 226,
                'name' => 'Login Roles: Delete',
                'entity_name' => 'ROLE.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            226 => 
            array (
                'id' => 227,
                'name' => 'Roles permission add',
                'entity_name' => 'ROLE.PERMISSIONS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            227 => 
            array (
                'id' => 228,
                'name' => 'Item Categories: Update',
                'entity_name' => 'EDIT.INVENTORY.CATEGORIES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            228 => 
            array (
                'id' => 229,
                'name' => 'Logins: Add',
                'entity_name' => 'ADD.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            229 => 
            array (
                'id' => 230,
                'name' => 'Logins: Edit',
                'entity_name' => 'EDIT.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            230 => 
            array (
                'id' => 231,
                'name' => 'Logins: Delete',
                'entity_name' => 'DELETE.LOGIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            231 => 
            array (
                'id' => 232,
                'name' => 'Roles: Add',
                'entity_name' => 'ADD.ROLE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            232 => 
            array (
                'id' => 233,
                'name' => 'Roles: Edit',
                'entity_name' => 'EDIT.ROLE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            233 => 
            array (
                'id' => 234,
                'name' => 'Roles: Delete',
                'entity_name' => 'DEL.ROLE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Inventory',
            ),
            234 => 
            array (
                'id' => 235,
                'name' => 'Departments/Admin Units: Update',
                'entity_name' => 'EDIT.COA.ADMIN',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            235 => 
            array (
                'id' => 236,
                'name' => 'GL JVouchers: Add JV',
                'entity_name' => 'GL.JV.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            236 => 
            array (
                'id' => 237,
                'name' => 'GL JVouchers: Edit JV',
                'entity_name' => 'GL.JV.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            237 => 
            array (
                'id' => 238,
                'name' => 'GL JVouchers: List JV',
                'entity_name' => 'GL.JV.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            238 => 
            array (
                'id' => 239,
                'name' => 'GL JVouchers: Delete JV',
                'entity_name' => 'GL.JV.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            239 => 
            array (
                'id' => 240,
                'name' => 'GL JVouchers: Check JV',
                'entity_name' => 'GL.JV.CHECK',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            240 => 
            array (
                'id' => 241,
                'name' => 'GL JVouchers: Post JV',
                'entity_name' => 'GL.JV.POST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            241 => 
            array (
                'id' => 242,
                'name' => 'Employees - Edit Employee Bank Details',
                'entity_name' => 'EDIT.EMPLOYEE.BANK',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            242 => 
            array (
                'id' => 243,
                'name' => 'Employees - Edit Bank Details',
                'entity_name' => 'EDIT.EMPLOYEE.BANK',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            243 => 
            array (
                'id' => 244,
                'name' => 'Budget Control - Add Economic Budget',
                'entity_name' => 'ADD.ECONOMIC.BUDGET',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            244 => 
            array (
                'id' => 245,
                'name' => 'Budget Control - Edit Economic Budget',
                'entity_name' => 'EDIT.ECONOMIC.BUDGET',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            245 => 
            array (
                'id' => 246,
                'name' => 'Economic Budget control list',
                'entity_name' => 'ECONOMIC.BUDGET.CONTROL.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            246 => 
            array (
                'id' => 247,
                'name' => 'Programme Budget control list',
                'entity_name' => 'PROGRAMME.BUDGET.CONTROL.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            247 => 
            array (
                'id' => 248,
                'name' => 'Employees - Deactivate from payroll',
                'entity_name' => 'DELETE.EMPLOYEE.4RM.PAYROLL',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            248 => 
            array (
                'id' => 249,
                'name' => 'Payment-Approval: Commit to budget',
                'entity_name' => 'COMMIT.PAYMENT.APPROVAL',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            249 => 
            array (
                'id' => 250,
                'name' => 'General Ledger: Post to GL',
                'entity_name' => 'POST.TP.GL',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            250 => 
            array (
                'id' => 251,
                'name' => 'Budget Control - Delete Economic Budget',
                'entity_name' => 'DELETE.ECONOMIC.BUDGET',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            251 => 
            array (
                'id' => 252,
                'name' => 'Budget Control - Add Programme Budget',
                'entity_name' => 'ADD.PROGRAMME.BUDGET',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            252 => 
            array (
                'id' => 253,
                'name' => 'Budget Control - Edit Programme Budget',
                'entity_name' => 'EDIT.PROGRAMME.BUDGET',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            253 => 
            array (
                'id' => 254,
                'name' => 'Budget Control - Delete Programme Budget',
                'entity_name' => 'DELETE.PROGRAMME.BUDGET',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            254 => 
            array (
                'id' => 255,
                'name' => 'Employees - Add to payroll',
                'entity_name' => 'ADD.EMPLOYEE.TO.PAYROLL',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'HR',
            ),
            255 => 
            array (
                'id' => 256,
                'name' => 'GL JVouchers: Add JV Details',
                'entity_name' => 'GL.JV.ADD.DETAILS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            256 => 
            array (
                'id' => 257,
                'name' => 'GL JVouchers: Edit JV Details',
                'entity_name' => 'GL.JV.EDIT.DETAILS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            257 => 
            array (
                'id' => 258,
                'name' => 'GL JVouchers: Delete JV Details',
                'entity_name' => 'GL.JV.DELETE.DETAILS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            258 => 
            array (
                'id' => 259,
                'name' => 'Report: Trail Balance List',
                'entity_name' => 'TRAIL.BALANCE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            259 => 
            array (
                'id' => 260,
                'name' => 'Report: Trail Balance Notes Add',
                'entity_name' => 'TRAIL.BALANCE.NOTE.CREATE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            260 => 
            array (
                'id' => 261,
                'name' => 'Report: Notes master list',
                'entity_name' => 'NOTES.MASTER.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            261 => 
            array (
                'id' => 262,
                'name' => 'Report: Notes Master Note Add',
                'entity_name' => 'NOTES.MASTER.NOTE.CREATE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            262 => 
            array (
                'id' => 263,
                'name' => 'Report: JV ledger list',
                'entity_name' => 'JV.LEDGER.REPORT.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            263 => 
            array (
                'id' => 264,
                'name' => 'Companies setting',
                'entity_name' => 'COMPANIES.SETTING',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Admin',
            ),
            264 => 
            array (
                'id' => 265,
                'name' => 'programme budget control aie',
                'entity_name' => 'PROGRAMME.BUDGET.CONTROL.AIE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            265 => 
            array (
                'id' => 266,
                'name' => 'jv ledger report sibling',
                'entity_name' => 'JV.LEDGER.REPORT.SIBLING',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            266 => 
            array (
                'id' => 267,
                'name' => 'jv ledger report statement of position',
                'entity_name' => 'JV.LEDGER.REPORT.STATEMENT_OF_POSTION',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            267 => 
            array (
                'id' => 268,
                'name' => 'jv ledger report financial performance',
                'entity_name' => 'JV.LEDGER.REPORT.FINANCIAL_PERFORMANCE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            268 => 
            array (
                'id' => 269,
                'name' => 'jv ledger report mothly activity',
                'entity_name' => 'JV.LEDGER.REPORT.MONTHLY_ACTIVITY',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            269 => 
            array (
                'id' => 270,
                'name' => 'jv ledger report application fund report',
                'entity_name' => 'JV.LEDGER.REPORT.APPLICATION_FUND_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            270 => 
            array (
                'id' => 271,
                'name' => 'jv ledger report sources uses fund',
                'entity_name' => 'JV.LEDGER.REPORT.SOURCES_USES_FUND',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            271 => 
            array (
                'id' => 272,
                'name' => 'jv ledger report special account activity',
                'entity_name' => 'JV.LEDGER.REPORT.SPECIAL_ACCOUNT_ACTIVITY',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            272 => 
            array (
                'id' => 273,
                'name' => 'voucher source unit',
                'entity_name' => 'VOUCHER_SOURCE_UNIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            273 => 
            array (
                'id' => 274,
                'name' => 'cashbook account',
                'entity_name' => 'CASHBOOK_ACCOUNT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            274 => 
            array (
                'id' => 275,
                'name' => 'payment voucher',
                'entity_name' => 'PAYMENT_VOUCHER',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            275 => 
            array (
                'id' => 276,
                'name' => 'receipt voucher',
                'entity_name' => 'RECEIPT_VOUCHER',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            276 => 
            array (
                'id' => 277,
                'name' => 'default setting',
                'entity_name' => 'DEFAULT_SETTING',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            277 => 
            array (
                'id' => 278,
                'name' => 'pv ledger report list',
                'entity_name' => 'PV.LEDGER.REPORT.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            278 => 
            array (
                'id' => 279,
                'name' => 'rv ledger report list',
                'entity_name' => 'RV.LEDGER.REPORT.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            279 => 
            array (
                'id' => 280,
                'name' => 'report treasury summary personal advances',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_PERSONAL_ADVANCES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            280 => 
            array (
                'id' => 281,
                'name' => 'report treasury summary non personal advances',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_NON_PERSONAL_ADVANCES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            281 => 
            array (
                'id' => 282,
                'name' => 'report treasury summary standing imprest',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_STANDING_IMPREST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            282 => 
            array (
                'id' => 283,
                'name' => 'report treasury summary special imprest',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_SPECIAL_IMPREST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            283 => 
            array (
                'id' => 284,
                'name' => 'PV Voucher: Add PV Details',
                'entity_name' => 'PV.VOUCHER.DETAILS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            284 => 
            array (
                'id' => 285,
                'name' => 'PV Voucher: Add Schedule Payee employees',
                'entity_name' => 'PV.VOUCHER.SCHEDULE_PAYEE_EMPLOYEES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            285 => 
            array (
                'id' => 286,
                'name' => 'PV Voucher: Add Schedule economic codes',
                'entity_name' => 'PV.VOUCHER.SCHEDULE_ECONOMIC_CODE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            286 => 
            array (
                'id' => 287,
                'name' => 'PV Voucher: Edit PV Voucher',
                'entity_name' => 'PV.VOUCHER.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            287 => 
            array (
                'id' => 288,
                'name' => 'PV Voucher: Edit Scheduled payees and economic codes',
                'entity_name' => 'PV.VOUCHER.SCHEDULE_PAYEE.ECONOMIC_CODES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            288 => 
            array (
                'id' => 289,
                'name' => 'PV Voucher: Change status of PV Voucher',
                'entity_name' => 'PV.VOUCHER.CHANGE_STATUS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            289 => 
            array (
                'id' => 290,
                'name' => 'PV Voucher: Export PDF PV Voucher',
                'entity_name' => 'PV.VOUCHER.EXPORT.PDF',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            290 => 
            array (
                'id' => 291,
                'name' => 'PV Voucher: Delete PV Voucher',
                'entity_name' => 'PV.VOUCHER.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            291 => 
            array (
                'id' => 292,
                'name' => 'Mandate: Add Mandate',
                'entity_name' => 'MANDATE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            292 => 
            array (
                'id' => 293,
                'name' => 'Mandate: Edit Mandate',
                'entity_name' => 'MANDATE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            293 => 
            array (
                'id' => 294,
                'name' => 'Mandate: Change status of Mandate',
                'entity_name' => 'MANDATE.CHANGE_STATUS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            294 => 
            array (
                'id' => 295,
                'name' => 'Mandate: Post Mandate',
                'entity_name' => 'MANDATE.POST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            295 => 
            array (
                'id' => 296,
                'name' => 'Retire Voucher: Edit Liability of Retire voucher',
                'entity_name' => 'RETIRE.VOUCHER.EDIT.LIABILITY',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            296 => 
            array (
                'id' => 297,
                'name' => 'Retire voucher: change status of Retire voucher',
                'entity_name' => 'RETIRE.VOUCHER.CHANGE_STATUS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            297 => 
            array (
                'id' => 298,
                'name' => 'Retire voucher: Post Retire voucher',
                'entity_name' => 'RETIRE.VOUCHER.POST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            298 => 
            array (
                'id' => 299,
                'name' => 'RV: Add RV Details',
                'entity_name' => 'RV.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            299 => 
            array (
                'id' => 300,
                'name' => 'RV: Edit RV Details',
                'entity_name' => 'RV.DETAILS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            300 => 
            array (
                'id' => 301,
                'name' => 'RV: CloseRV',
                'entity_name' => 'RV.CLOSE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            301 => 
            array (
                'id' => 302,
                'name' => 'RV: Post RV',
                'entity_name' => 'RV.POST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            302 => 
            array (
                'id' => 303,
                'name' => 'RV: Delete RV ',
                'entity_name' => 'RV.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            303 => 
            array (
                'id' => 304,
                'name' => 'RV: Download RV PDF',
                'entity_name' => 'RV.PDF.DOWNLOAD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            304 => 
            array (
                'id' => 305,
                'name' => 'RV: Schedule Payer employees',
                'entity_name' => 'RV.SCHEDULE.PAYER_EMPLOYEE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            305 => 
            array (
                'id' => 306,
                'name' => 'RV: Schedule economic code',
                'entity_name' => 'RV.SCHEDULE.ECONOMIC_CODE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            306 => 
            array (
                'id' => 307,
                'name' => 'RV: Edit Scheduled payer employees and economic codes',
                'entity_name' => 'RV.SCHEDULE.PAYER_EMPLOYEE.ECONOMIC_CODE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            307 => 
            array (
                'id' => 308,
                'name' => 'Payment Approval: Add Payment Approval',
                'entity_name' => 'PAYMENT.APPROVAL.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            308 => 
            array (
                'id' => 309,
                'name' => 'Payment Approval: Edit Payment Approval',
                'entity_name' => 'PAYMENT.APPROVAL.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            309 => 
            array (
                'id' => 310,
                'name' => 'Payment Approval: Check Payment Approval',
                'entity_name' => 'PAYMENT.APPROVAL.CHECK',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            310 => 
            array (
                'id' => 311,
                'name' => 'Payment Approval: Approve Payment Approval',
                'entity_name' => 'PAYMENT.APPROVAL.APPROVE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            311 => 
            array (
                'id' => 312,
                'name' => 'Payment Approval: Schedule payee employees',
                'entity_name' => 'PAYMENT.APPROVAL.SCHEDULE.PAYEE_EMPLOYEE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            312 => 
            array (
                'id' => 313,
                'name' => 'Payment Approval: Edit Scheduled payee employee',
                'entity_name' => 'PAYMENT.APPROVAL.SCHEDULE.PAYEE_EMPLOYEE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            313 => 
            array (
                'id' => 314,
                'name' => 'Payment Approval: Delete Scheduled payee employee',
                'entity_name' => 'PAYMENT.APPROVAL.SCHEDULE.PAYEE_EMPLOYEE.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            314 => 
            array (
                'id' => 315,
                'name' => 'PYA: Add PYA',
                'entity_name' => 'PYA.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            315 => 
            array (
                'id' => 316,
                'name' => 'PYA: Edit PYA',
                'entity_name' => 'PYA.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            316 => 
            array (
                'id' => 317,
                'name' => 'PYA: Delete PYA',
                'entity_name' => 'PYA.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            317 => 
            array (
                'id' => 318,
                'name' => 'PYA: Close PYA',
                'entity_name' => 'PYA.CLOSE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            318 => 
            array (
                'id' => 319,
                'name' => 'PYA: Post PYA',
                'entity_name' => 'PYA.POST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            319 => 
            array (
                'id' => 320,
                'name' => 'VSU: Add VSU',
                'entity_name' => 'VSU.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            320 => 
            array (
                'id' => 321,
                'name' => 'VSU: Edit VSU',
                'entity_name' => 'VSU.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            321 => 
            array (
                'id' => 322,
                'name' => 'VSU: Mark VSU as personal advanced unit?',
                'entity_name' => 'VSU.MARKED.PERSONAL_ADVANCED_UNIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            322 => 
            array (
                'id' => 323,
                'name' => 'Cashbook: Add cashbook',
                'entity_name' => 'CASHBOOK.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            323 => 
            array (
                'id' => 324,
                'name' => 'Cashbook: Edit Cashbook',
                'entity_name' => 'CASHBOOK.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            324 => 
            array (
                'id' => 325,
                'name' => 'Cashbook: delete Cashbook',
                'entity_name' => 'CASHBOOK.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            325 => 
            array (
                'id' => 326,
            'name' => 'Default Setting (Voucher): Edit default settings',
                'entity_name' => 'DEFAULT.SETTINGS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            326 => 
            array (
                'id' => 327,
                'name' => 'Reports Treasury PV: View reports',
                'entity_name' => 'REPORTS.TREASURY.PV.VIEW.REPORTS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            327 => 
            array (
                'id' => 328,
                'name' => 'Reports Treasury PV: Add columns',
                'entity_name' => 'REPORTS.TREASURY.PV.ADD_COLUMNS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            328 => 
            array (
                'id' => 329,
                'name' => 'Reports Treasury PV: Download report',
                'entity_name' => 'REPORTS.TREASURY.PV.DOWNLOAD_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            329 => 
            array (
                'id' => 330,
                'name' => 'Reports Treasury PV: Close all open reports',
                'entity_name' => 'REPORTS.TREASURY.PV.CLOSE_OPEN_REPORTS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            330 => 
            array (
                'id' => 331,
                'name' => 'Reports Treasury PV: Open all reports',
                'entity_name' => 'REPORTS.TREASURY.PV.OPEN_ALL_REPORTS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            331 => 
            array (
                'id' => 332,
                'name' => 'Reports Treasury RV: View reports',
                'entity_name' => 'REPORTS.TREASURY.RV.VIEW.REPORTS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            332 => 
            array (
                'id' => 333,
                'name' => 'Reports Treasury RV: Add columns',
                'entity_name' => 'REPORTS.TREASURY.RV.ADD_COLUMNS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            333 => 
            array (
                'id' => 334,
                'name' => 'Reports Treasury RV: Download report',
                'entity_name' => 'REPORTS.TREASURY.RV.DOWNLOAD_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            334 => 
            array (
                'id' => 335,
                'name' => 'Reports Treasury RV: Close all open reports',
                'entity_name' => 'REPORTS.TREASURY.RV.CLOSE_OPEN_REPORTS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            335 => 
            array (
                'id' => 336,
                'name' => 'Reports Treasury RV: Open all reports',
                'entity_name' => 'REPORTS.TREASURY.RV.OPEN_ALL_REPORTS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            336 => 
            array (
                'id' => 337,
                'name' => 'Reports Treasury- Summary Non personal Advances: View department wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_NON_PERSONAL_ADVANCES.VIEW_DEPARTMENT_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            337 => 
            array (
                'id' => 338,
                'name' => 'Reports Treasury - Summary Non personal Advances: View employee wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_NON_PERSONAL_ADVANCES.VIEW_EMPLOYEE_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            338 => 
            array (
                'id' => 339,
                'name' => 'Reports Treasury - Summary Personal Advances: View department wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_PERSONAL_ADVANCES.VIEW_DEPARTMENT_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            339 => 
            array (
                'id' => 340,
                'name' => 'Reports Treasury - Summary Personal Advances: View employee wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_PERSONAL_ADVANCES.VIEW_EMPLOYEE_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            340 => 
            array (
                'id' => 341,
                'name' => 'Reports Treasury - Summary Standing Imprest: View department wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_STANDING_IMPREST.VIEW_DEPARTMENT_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            341 => 
            array (
                'id' => 342,
                'name' => 'Reports Treasury -  Summary Standing Imprest: View employee wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_STANDING_IMPREST.VIEW_EMPLOYEE_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            342 => 
            array (
                'id' => 343,
                'name' => 'Reports Treasury - Summary Special Imprest: View department wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_SPECIAL_IMPREST.VIEW_DEPARTMENT_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            343 => 
            array (
                'id' => 344,
                'name' => 'Reports Treasury - Summary Special Imprest: View employee wise report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_SPECIAL_IMPREST.VIEW_EMPLOYEE_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            344 => 
            array (
                'id' => 345,
                'name' => 'Reports Treasury - Summary Advance Ledger: View report',
                'entity_name' => 'REPORTS.TREASURY.SUMMARY_ADVANCE_LEDGER.VIEW_REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            345 => 
            array (
                'id' => 346,
                'name' => 'Budget Control AIE: Add new AIE',
                'entity_name' => 'BUDGET.CONTROL.AIE.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            346 => 
            array (
                'id' => 347,
                'name' => 'Budget Control AIE: Search AIE',
                'entity_name' => 'BUDGET.CONTROL.AIE.SEARCH',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            347 => 
            array (
                'id' => 348,
                'name' => 'Budget Control AIE: Edit AIE',
                'entity_name' => 'BUDGET.CONTROL.AIE.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            348 => 
            array (
                'id' => 349,
                'name' => 'Budget Control AIE: Delete AIE',
                'entity_name' => 'BUDGET.CONTROL.AIE.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            349 => 
            array (
                'id' => 350,
                'name' => 'GL JV: Create JV',
                'entity_name' => 'GL.JV.CREATE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            350 => 
            array (
                'id' => 351,
                'name' => 'GL JV: Add JV main details',
                'entity_name' => 'GL.JV.ADD.DETAILS',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            351 => 
            array (
                'id' => 352,
                'name' => 'GL JV: Edit JV',
                'entity_name' => 'GL.JV.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            352 => 
            array (
                'id' => 353,
                'name' => 'GL JV: Delete JV',
                'entity_name' => 'GL.JV.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            353 => 
            array (
                'id' => 354,
                'name' => 'Budget control economic: Add economic budget',
                'entity_name' => 'BUDGET.CONTROL.ECONOMIC.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            354 => 
            array (
                'id' => 355,
                'name' => 'Budget control economic: Edit economic budget',
                'entity_name' => 'BUDGET.CONTROL.ECONOMIC.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            355 => 
            array (
                'id' => 356,
                'name' => 'Budget control economic: View economic budget list',
                'entity_name' => 'BUDGET.CONTROL.ECONOMIC.VIEW_LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            356 => 
            array (
                'id' => 357,
                'name' => 'Budget control economic: Delete economic budget list',
                'entity_name' => 'BUDGET.CONTROL.ECONOMIC.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            357 => 
            array (
                'id' => 358,
                'name' => 'Budget control programme: Add programme budget',
                'entity_name' => 'BUDGET.CONTROL.PROGRAMME.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            358 => 
            array (
                'id' => 359,
                'name' => 'Budget control programme: Edit programme budget',
                'entity_name' => 'BUDGET.CONTROL.PROGRAMME.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            359 => 
            array (
                'id' => 360,
                'name' => 'Budget control programme: View programme budget list',
                'entity_name' => 'BUDGET.CONTROL.PROGRAMME.VIEW',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            360 => 
            array (
                'id' => 361,
                'name' => 'Budget control programme:: Delete programme budget list',
                'entity_name' => 'BUDGET.CONTROL.PROGRAMME.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            361 => 
            array (
                'id' => 362,
                'name' => 'Setup currencies: Add new currency',
                'entity_name' => 'SETUP.CURRENCIES.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            362 => 
            array (
                'id' => 363,
                'name' => 'Setup currencies: edit currency',
                'entity_name' => 'SETUP.CURRENCIES.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            363 => 
            array (
                'id' => 364,
                'name' => 'Setup currencies: Delete currency',
                'entity_name' => 'SETUP.CURRENCIES.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            364 => 
            array (
                'id' => 365,
                'name' => 'Setup banks: Add bank',
                'entity_name' => 'SETUP.BANKS.ADD',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            365 => 
            array (
                'id' => 366,
                'name' => 'Setup banks: Edit bank details',
                'entity_name' => 'SETUP.BANKS.EDIT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            366 => 
            array (
                'id' => 367,
                'name' => 'Setup banks: Delete bank',
                'entity_name' => 'SETUP.BANKS.DELETE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            367 => 
            array (
                'id' => 368,
                'name' => 'Setup banks: Mark Active/Inactive',
                'entity_name' => 'SETUP.BANKS.MARK_ACTIVE_INACTIVE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            368 => 
            array (
                'id' => 369,
                'name' => 'Setup banks: Add Bank branch',
                'entity_name' => 'SETUP.BANKS.ADD_BRANCH',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            369 => 
            array (
                'id' => 370,
                'name' => 'Setup banks: Edit Bank branch',
                'entity_name' => 'SETUP.BANKS.EDIT_BRANCH',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            370 => 
            array (
                'id' => 371,
                'name' => 'Setup banks: Delete Bank branch',
                'entity_name' => 'SETUP.BANKS.DELETE_BRANCH',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            371 => 
            array (
                'id' => 372,
                'name' => 'Settings Company Info: View Company Info',
                'entity_name' => 'SETTINGS.COMPANY.INFO.VIEW',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            372 => 
            array (
                'id' => 373,
                'name' => 'Settings Company Info: Change status - Auto Post JV',
                'entity_name' => 'SETTINGS.COMPANY.INFO.CHANGE_STATUS_AUTO_POSTED_JV',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            373 => 
            array (
                'id' => 374,
                'name' => 'Settings Company Info: Change status - Payment Approval Required',
                'entity_name' => 'SETTINGS.COMPANY.INFO.CHANGE_STATUS_PAYMENT_APPROVAL_REQUIRED',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            374 => 
            array (
                'id' => 375,
                'name' => 'Settings Company Info: Change status - Default status of auto posted JV',
                'entity_name' => 'SETTINGS.COMPANY.INFO.CHANGE_STATUS.DEFAULT_STATUS_AUTO_POSTED_JV',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            375 => 
            array (
                'id' => 376,
                'name' => 'Reports Finance - Trial Balance: View report',
                'entity_name' => 'REPORTS.FINANCE.TRIAL_BALANCE.VIEW.REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            376 => 
            array (
                'id' => 377,
                'name' => 'Reports Finance - Trial Balance: Create Note',
                'entity_name' => 'REPORTS.FINANCE.TRIAL_BALANCE.CREATE.NOTE',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            377 => 
            array (
                'id' => 378,
                'name' => 'Reports Finance - Notes Master: View report',
                'entity_name' => 'REPORTS.FINANCE.NOTES_MASTER.VIEW.REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            378 => 
            array (
                'id' => 379,
                'name' => 'Reports Finance - Notes Master: Download report',
                'entity_name' => 'REPORTS.FINANCE.NOTES_MASTER.DOWNLOAD.REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            379 => 
            array (
                'id' => 380,
                'name' => 'Reports Finance - Notes Master: Add notes',
                'entity_name' => 'REPORTS.FINANCE.NOTES_MASTER.ADD.NOTES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            380 => 
            array (
                'id' => 381,
                'name' => 'Reports Finance - Notes Master: Reset All notes',
                'entity_name' => 'REPORTS.FINANCE.NOTES_MASTER.RESET_NOTES',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            381 => 
            array (
                'id' => 382,
                'name' => 'Report Finance - JV Ledger: View Report',
                'entity_name' => 'REPORTS.FINANCE.JV_LEDGER.VIEW.REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            382 => 
            array (
                'id' => 383,
                'name' => 'Report Finance - JV Ledger Sibling: View Report',
                'entity_name' => 'REPORTS.FINANCE.JV_LEDGER_SIBLING.VIEW.REPORT',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            383 => 
            array (
                'id' => 384,
                'name' => 'Report Finance - JV Ledger Monthly Activity',
                'entity_name' => 'REPORTS.FINANCE.JV_LEDGER_MONTHLY_ACTIVITY',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            384 => 
            array (
                'id' => 385,
                'name' => 'Reports Finance Ifr Notes Master',
                'entity_name' => 'REPORTS.FINANCE.IFR_NOTES_MASTER',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Finance',
            ),
            385 => 
            array (
                'id' => 386,
                'name' => 'Pv Voucher Details List',
                'entity_name' => 'PV.VOUCHER.DETAILS.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            386 => 
            array (
                'id' => 387,
                'name' => 'Rv List',
                'entity_name' => 'RV.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            387 => 
            array (
                'id' => 388,
                'name' => 'Payment Appproval List',
                'entity_name' => 'PAYMENT.APPROVAL.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            388 => 
            array (
                'id' => 389,
                'name' => 'PYA LIST',
                'entity_name' => 'PYA.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            389 => 
            array (
                'id' => 390,
                'name' => 'VSU LIST',
                'entity_name' => 'VSU.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            390 => 
            array (
                'id' => 391,
                'name' => 'CASHBOOK_LIST',
                'entity_name' => 'CASHBOOK_LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
            391 => 
            array (
                'id' => 392,
                'name' => 'MANDATE LIST',
                'entity_name' => 'MANDATE.LIST',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'module' => 'Treasury',
            ),
        ));
        
        
    }
}