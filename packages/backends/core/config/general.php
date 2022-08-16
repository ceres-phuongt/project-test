<?php

return [
    'date_format'               => [
        'date'      => env('CMS_DATE_FORMAT', 'Y-m-d'),
        'date_time' => env('CMS_DATE_TIME_FORMAT', 'Y-m-d H:i:s'),
        'js'        => [
            'date'      => env('CMS_JS_DATE_FORMAT', 'yyyy-mm-dd'),
            'date_time' => env('CMS_JS_DATE_TIME_FORMAT', 'yyyy-mm-dd H:i:s'),
        ],
    ],
];
