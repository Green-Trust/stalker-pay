<?php

return [
    'activation_code' => [
        'reply_ttl_minutes' => env('USER_ACTIVATION_CODE_REPLY_TTL_MINUTES', 0),
        'activation_ttl_minutes' => env('USER_ACTIVATION_CODE_TTL_MINUTES', 0),
    ]
];
