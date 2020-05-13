<?php


use Modules\Hr\Models\File;

return [
    'is_local' => true,
    'temp_path' => 'images/temp_path',
    'aws_temp_link_time' => 10,
    'types' => [
        File::FILE_USER_IMAGE => ['type' => File::FILE_USER_IMAGE,
            'local_path' => 'images/user_image',
            'bucket_name' => 'takkeh',
            'validation' => 'required',
            'valid_file_types' => ['png', 'jpg', 'jpeg'],
            'acl' => 'private'
        ]
    ]
];