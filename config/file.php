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
    'types' => [
        'USER_IMAGE' => ['type' => 'USER_IMAGE',
            'local_path' => 'images/user_image',
            'bucket_name' => '',
            'validation' => 'required',
            'valid_file_types' => ['png', 'jpeg', 'jpg'],
            'acl' => 'private'
        ]
    ]
];
