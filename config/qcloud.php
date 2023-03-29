<?php

return [

    'default' => [
        'bucket' => getenv('DEFAULT_BUCKET', env('DEFAULT_BUCKET')),
        'region' => getenv('DEFAULT_COS_REGION', env('DEFAULT_COS_REGION')),
        'secretId' => getenv('DEFAULT_COS_SECRETID', env('DEFAULT_COS_SECRETID')),
        'secretKey' => getenv('DEFAULT_COS_SECRETKEY', env('DEFAULT_COS_SECRETKEY')),
    ]

];
