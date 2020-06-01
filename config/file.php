<?php
/**
 * Created by PhpStorm.
 * User: keshav
 * Date: 11/10/18
 * Time: 6:04 PM
 */



return [
    'is_local' => true,
    'temp_path' => 'images/temp_path',
    'aws_temp_link_time' => 10,
    'pdf_directory' => public_path('pdf/'),
    'wkhtml_path' => resource_path('wkhtml/library/wkhtmltopdf-amd64_1'),
    'types' => [
        'USER_IMAGE' => ['type' => 'USER_IMAGE',
            'local_path' => 'images/user_image',
            'bucket_name' => '',
            'validation' => 'required',
            'valid_file_types' => ['png', 'jpeg', 'jpg'],
            'acl' => 'private'
        ],
        'EMPLOYEE_FILES' => ['type' => 'EMPLOYEE_FILES',
            'local_path' => 'images/pdf',
            'bucket_name' => '',
            'validation' => 'required',
            'valid_file_types' => ['csv', 'xls', 'xlsx', 'pdf'],
            'acl' => 'private'
        ]
    ]
];
