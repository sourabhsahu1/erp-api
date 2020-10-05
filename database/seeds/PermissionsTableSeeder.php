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
                'name' => 'Banks',
                'entity_name' => 'BANKS',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Countries',
                'entity_name' => 'COUNTIRES',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Currencies',
                'entity_name' => 'CURRENCIES',
                'module' => 'Finance',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Customers',
                'entity_name' => 'PAYERS.PAYEES',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Auto-Update Functions List',
                'entity_name' => 'AUTO.UPDATE.FUNCS',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Access Delete button in maintenance forms',
                'entity_name' => 'MAINTCE.DEL',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Access Edit button in maintenance forms',
                'entity_name' => 'MAINTENANCE.EDIT',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Access Delete button in transaction forms',
                'entity_name' => 'TRANSACTION.DEL',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Access Edit button in transaction forms',
                'entity_name' => 'TRANSSACTION.EDIT',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'User Accounts',
                'entity_name' => 'USERS',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Group Accounts',
                'entity_name' => 'USERS.GROUPS',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Admin: Create Designation',
                'entity_name' => 'DESIGNATIONS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Admin: List designation',
                'entity_name' => 'DESIGNATIONS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Delete designation',
                'entity_name' => 'DESIGNATIONS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Admin: Update Designations',
                'entity_name' => 'DESIGNATIONS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Add salary scale',
                'entity_name' => 'SALARYSCALES.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Admin: Update Salary Scales',
                'entity_name' => 'SALARYSCALES.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Delete salary scale',
                'entity_name' => 'SALARYSCALES.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'List salary scale',
                'entity_name' => 'SALARYSCALES.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Add qualification',
                'entity_name' => 'QUALIFICATIONS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Admin: Update Types of Qualification',
                'entity_name' => 'QUALIFICATIONS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'List qualification',
                'entity_name' => 'QUALIFICATIONS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'delete qualification',
                'entity_name' => 'QUALIFICATIONS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Add Job skill',
                'entity_name' => 'JOB.SKILLS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Admin: Update Job Skills',
                'entity_name' => 'JOB.SKILLS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'List job skills',
                'entity_name' => 'JOB.SKILLS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Delete job skills',
                'entity_name' => 'JOB.SKILLS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Add Language',
                'entity_name' => 'LANGUAGES.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Admin: Update Languages',
                'entity_name' => 'LANGUAGES.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'List language',
                'entity_name' => 'LANGUAGES.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'language delele',
                'entity_name' => 'LANGUAGES.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Add School categories ',
                'entity_name' => 'SCHOOL.CATEGORIES.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Admin: Update School Categories',
                'entity_name' => 'SCHOOL.CATEGORIES.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'School categories list',
                'entity_name' => 'SCHOOL.CATEGORIES.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'School categories delete',
                'entity_name' => 'SCHOOL.CATEGORIES.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'academic majors add',
                'entity_name' => 'ACADEMIC.MAJORS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Admin: Update Academic Majors',
                'entity_name' => 'ACADEMIC.MAJORS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'academic majors list',
                'entity_name' => 'ACADEMIC.MAJORS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'academic majors delete',
                'entity_name' => 'ACADEMIC.MAJORS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Relations add',
                'entity_name' => 'RELATIONS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Admin: Update Relationships',
                'entity_name' => 'RELATIONS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Relations list',
                'entity_name' => 'RELATIONS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Relations delete',
                'entity_name' => 'RELATIONS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'staff add',
                'entity_name' => 'STAFF.CATEGORIES.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Admin: Update Staff Categories',
                'entity_name' => 'STAFF.CATEGORIES.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'staff list',
                'entity_name' => 'STAFF.CATEGORIES.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'staff delete',
                'entity_name' => 'STAFF.CATEGORIES.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'staff status add',
                'entity_name' => 'STAFF.STATUS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Admin: Update Staff Status',
                'entity_name' => 'STAFF.STATUS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'staff status list',
                'entity_name' => 'STAFF.STATUS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'staff status delete',
                'entity_name' => 'STAFF.STATUS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'exit option add',
                'entity_name' => 'EXIT.OPTIONS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
            'name' => 'Admin: Update Disengagement (i.e Exit) Options',
                'entity_name' => 'EXIT.OPTIONS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'exit option list',
                'entity_name' => 'EXIT.OPTIONS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'exit option delete',
                'entity_name' => 'EXIT.OPTIONS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Censures Add',
                'entity_name' => 'CENSURES.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Admin: Update Types of Staff Censure',
                'entity_name' => 'CENSURES.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Censures list',
                'entity_name' => 'CENSURES.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Censures delete',
                'entity_name' => 'CENSURES.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Arms of service add',
                'entity_name' => 'ARMS.OF.SERVICE.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Admin: Update Arms Of Service',
                'entity_name' => 'ARMS.OF.SERVICE.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Arms of service list',
                'entity_name' => 'ARMS.OF.SERVICE.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Arms of service delete',
                'entity_name' => 'ARMS.OF.SERVICE.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Membership add',
                'entity_name' => 'MEMBERSHIPS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Admin: Update Memberships',
                'entity_name' => 'MEMBERSHIPS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Membership list',
                'entity_name' => 'MEMBERSHIPS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Membership delete',
                'entity_name' => 'MEMBERSHIPS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Types of Leave Add',
                'entity_name' => 'TYPES.OF.LEAVE.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Admin: Update Types Of Leave',
                'entity_name' => 'TYPES.OF.LEAVE.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Types of Leave list',
                'entity_name' => 'TYPES.OF.LEAVE.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Types of Leave delete',
                'entity_name' => 'TYPES.OF.LEAVE.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Leave group Add',
                'entity_name' => 'LEAVE.GROUP.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Admin: Update Leave Groups',
                'entity_name' => 'LEAVE.GROUP.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Leave group list',
                'entity_name' => 'LEAVE.GROUP.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Leave group delete',
                'entity_name' => 'LEAVE.GROUP.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Public holiday Add',
                'entity_name' => 'PUBLIC.HOLIDAYS.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Admin: Update Public Holidays',
                'entity_name' => 'PUBLIC.HOLIDAYS.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Public holiday list',
                'entity_name' => 'PUBLIC.HOLIDAYS.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Public holiday delete',
                'entity_name' => 'PUBLIC.HOLIDAYS.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Address add',
                'entity_name' => 'ADDRESSES.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Admin: Update Types of Address',
                'entity_name' => 'ADDRESSES.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Address list',
                'entity_name' => 'ADDRESSES.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Address delete',
                'entity_name' => 'ADDRESSES.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Types of phone number add',
                'entity_name' => 'TYPES.OF.PHONE.NUM.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Admin: Update Types of Phone Number',
                'entity_name' => 'TYPES.OF.PHONE.NUM.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Types of phone number list',
                'entity_name' => 'TYPES.OF.PHONE.NUM.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Types of phone number delete',
                'entity_name' => 'TYPES.OF.PHONE.NUM.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Geo location add',
                'entity_name' => 'GEO.LOC.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Admin: Update Geo. Locations',
                'entity_name' => 'GEO.LOC.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Geo location list',
                'entity_name' => 'GEO.LOC.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Geo location delete',
                'entity_name' => 'GEO.LOC.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Company Information Add',
                'entity_name' => 'COMPANY.INFO.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
            'name' => 'Admin: Update General (Comp. Info)',
                'entity_name' => 'COMPANY.INFO.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Company Information list',
                'entity_name' => 'COMPANY.INFO.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'Company Information delete',
                'entity_name' => 'COMPANY.INFO.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Office location add',
                'entity_name' => 'OFFICE.LOCACTION.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Admin: Update Office Locations',
                'entity_name' => 'OFFICE.LOCACTION.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Office location list',
                'entity_name' => 'OFFICE.LOCACTION.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Office location delete',
                'entity_name' => 'OFFICE.LOCACTION.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Job position Add',
                'entity_name' => 'JOB.POSITION.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Admin: Update Job Positions',
                'entity_name' => 'JOB.POSITION.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Job position list',
                'entity_name' => 'JOB.POSITION.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Job position delete',
                'entity_name' => 'JOB.POSITION.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Deparment add',
                'entity_name' => 'DEPARTMENT.ADD',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Admin: Update Departments',
                'entity_name' => 'DEPARTMENT.EDIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Deparment list',
                'entity_name' => 'DEPARTMENT.LIST',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Deparment delete',
                'entity_name' => 'DEPARTMENT.DELETE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Employees: - Add',
                'entity_name' => 'ADD.EMPLOYEE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Employees: - Activate',
                'entity_name' => 'ACTIVATE.EMPLOYEE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'Employees: - Delete',
                'entity_name' => 'DELETE.EMPLOYEE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'Employees: - Update Photo File',
                'entity_name' => 'UPDATE.EMPLOYEE.PHOTO.FILE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'Employees: - Edit',
                'entity_name' => 'EDIT.EMPLOYEE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Employees: - Edit Extended Profile',
                'entity_name' => 'EDIT.EMPLOYEE.DETAILS',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Employees: - Edit Addresses',
                'entity_name' => 'EDIT.EMPLOYEE.ADDRESS',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Employees: - Edit Censures',
                'entity_name' => 'EDIT.EMPLOYEE.CENSURE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'Employees: - Edit Employment History',
                'entity_name' => 'EDIT.EMPLOYEE.HISTORY',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Employees: - Edit Languages',
                'entity_name' => 'EDIT.EMPLOYEE.LANGS',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Employees: - Edit Prof. Membership',
                'entity_name' => 'EDIT.EMPLOYEE.PROF.MEMBER',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Employees: - Edit Other Membership',
                'entity_name' => 'EDIT.EMPLOYEE.OTHER.MEMBER',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'Employees: - Edit Military Service',
                'entity_name' => 'EDIT.EMPLOYEE.MILITARY.SERVICE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'Employees: - Edit Phones Numbers',
                'entity_name' => 'EDIT.EMPLOYEE.PHONES',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'Employees: - Edit Progression',
                'entity_name' => 'EDIT.EMPLOYEE.PROGRESS',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'Employees: - Edit Qualifications',
                'entity_name' => 'EDIT.EMPLOYEE.QUALIFICATION',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'Employees: - Edit Relations',
                'entity_name' => 'EDIT.EMPLOYEE.RELATIONS',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'Employees: - Edit Schools Attended',
                'entity_name' => 'EDIT.EMPLOYEE.SCHOOLS',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'Employees: - Edit Job Skills',
                'entity_name' => 'EDIT.EMPLOYEE.SKILLS',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'Employees: - Capture Photo',
                'entity_name' => 'EDIT.EMPLOYEE.PHOTO',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'Employees: - Exit Employee',
                'entity_name' => 'EDIT.EMPLOYEE.EXIT',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'Employees: - Confirm Employee',
                'entity_name' => 'EDIT.EMPLOYEE.CONFIRM',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'name' => 'Employees: - Print List/Profile',
                'entity_name' => 'PRINT.EMPLOYEES',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'Users: - Add',
                'entity_name' => 'ADD.LOGIN',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'Users: - Edit',
                'entity_name' => 'EDIT.LOGIN',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'Users: - Delete',
                'entity_name' => 'DELETE.LOGIN',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'User Roles: - Add',
                'entity_name' => 'ADD.ROLE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'User Roles: - Edit',
                'entity_name' => 'EDIT.ROLE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'id' => 136,
                'name' => 'User Roles: - Delete',
                'entity_name' => 'DELETE.ROLE',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'id' => 137,
                'name' => 'COA Segments: Administrative',
                'entity_name' => 'EDIT.COA.ADMIN',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'id' => 138,
                'name' => 'COA Segments: Functional',
                'entity_name' => 'EDIT.COA.FUNC',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'id' => 139,
                'name' => 'COA Segments: Programme',
                'entity_name' => 'EDIT.COA.PROG',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'id' => 140,
                'name' => 'COA Segments: Geo Code',
                'entity_name' => 'EDIT.COA.GEO',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'id' => 141,
                'name' => 'COA Segments: Fund',
                'entity_name' => 'EDIT.COA.FUND',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'id' => 142,
                'name' => 'COA Segments: Economic',
                'entity_name' => 'EDIT.COA.ECONO',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'id' => 143,
                'name' => 'Logins: Add New',
                'entity_name' => 'ADD.LOGIN',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'id' => 144,
                'name' => 'Logins: Edit',
                'entity_name' => 'EDIT.LOGIN',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'id' => 145,
                'name' => 'Logins: Delete',
                'entity_name' => 'DELETE.LOGIN',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'id' => 146,
                'name' => 'Login Roles: List roles',
                'entity_name' => 'LIST.ROLE',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'id' => 147,
                'name' => 'Login Roles: Add New',
                'entity_name' => 'ADD.ROLE',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'id' => 148,
                'name' => 'Login Roles: Edit',
                'entity_name' => 'EDIT.ROLE',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            148 => 
            array (
                'id' => 149,
                'name' => 'Login Roles: Delete',
                'entity_name' => 'DELETE.ROLE',
                'module' => 'Admin',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'id' => 150,
                'name' => 'Item Categories: Update',
                'entity_name' => 'EDIT.INVENTORY.CATEGORIES',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'id' => 151,
                'name' => 'Logins: Add',
                'entity_name' => 'ADD.LOGIN',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            151 => 
            array (
                'id' => 152,
                'name' => 'Logins: Edit',
                'entity_name' => 'EDIT.LOGIN',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            152 => 
            array (
                'id' => 153,
                'name' => 'Logins: Delete',
                'entity_name' => 'DELETE.LOGIN',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            153 => 
            array (
                'id' => 154,
                'name' => 'Roles: Add',
                'entity_name' => 'ADD.ROLE',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            154 => 
            array (
                'id' => 155,
                'name' => 'Roles: Edit',
                'entity_name' => 'EDIT.ROLE',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            155 => 
            array (
                'id' => 156,
                'name' => 'Roles: Delete',
                'entity_name' => 'DEL.ROLE',
                'module' => 'Inventory',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            156 => 
            array (
                'id' => 157,
                'name' => 'Departments/Admin Units: Update',
                'entity_name' => 'EDIT.COA.ADMIN',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            157 => 
            array (
                'id' => 158,
                'name' => 'GL JVouchers: Add JV',
                'entity_name' => 'ADD.GL.JV',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            158 => 
            array (
                'id' => 159,
                'name' => 'GL JVouchers: Edit JV',
                'entity_name' => 'EDIT.GL.JV',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            159 => 
            array (
                'id' => 160,
                'name' => 'GL JVouchers: Delete JV',
                'entity_name' => 'DELETE.GL.JV',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            160 => 
            array (
                'id' => 161,
                'name' => 'GL JVouchers: Check JV',
                'entity_name' => 'CHECK.GL.JV',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            161 => 
            array (
                'id' => 162,
                'name' => 'GL JVouchers: Post JV',
                'entity_name' => 'POST.GL.JV',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            162 => 
            array (
                'id' => 163,
                'name' => 'Employees - Edit Employee Bank Details',
                'entity_name' => 'EDIT.EMPLOYEE.BANK',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            163 => 
            array (
                'id' => 164,
                'name' => 'Employees - Edit Bank Details',
                'entity_name' => 'EDIT.EMPLOYEE.BANK',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            164 => 
            array (
                'id' => 165,
                'name' => 'Budget Control - Add Economic Budget',
                'entity_name' => 'ADD.ECONOMIC.BUDGET',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            165 => 
            array (
                'id' => 166,
                'name' => 'Budget Control - Edit Economic Budget',
                'entity_name' => 'EDIT.ECONOMIC.BUDGET',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'Employees - Deactivate from payroll',
                'entity_name' => 'DELETE.EMPLOYEE.4RM.PAYROLL',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'Payment-Approval: Commit to budget',
                'entity_name' => 'COMMIT.PAYMENT.APPROVAL',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'General Ledger: Post to GL',
                'entity_name' => 'POST.TP.GL',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'Budget Control - Delete Economic Budget',
                'entity_name' => 'DELETE.ECONOMIC.BUDGET',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'Budget Control - Add Programme Budget',
                'entity_name' => 'ADD.PROGRAMME.BUDGET',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'Budget Control - Edit Programme Budget',
                'entity_name' => 'EDIT.PROGRAMME.BUDGET',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            172 => 
            array (
                'id' => 173,
                'name' => 'Budget Control - Delete Programme Budget',
                'entity_name' => 'DELETE.PROGRAMME.BUDGET',
                'module' => 'Finanace',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            173 => 
            array (
                'id' => 174,
                'name' => 'Employees - Add to payroll',
                'entity_name' => 'ADD.EMPLOYEE.TO.PAYROLL',
                'module' => 'HR',
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}