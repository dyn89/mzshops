<?php

return [

    'default' => [
        'bucket' => env('DEFAULT_BUCKET', ''),
        'region' => env('DEFAULT_COS_REGION', ''),
        'secretId' => env('DEFAULT_COS_SECRETID', ''),
        'secretKey' => env('DEFAULT_COS_SECRETKEY', ''),
    ]

];
