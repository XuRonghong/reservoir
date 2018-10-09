<?php
return [
    'mail' =>
        [
          'ttb' =>
            [
                'address' => 'ronghong@kahap.com'
            ],
        ],
    'admin_access' => [ 1, 2 ],
    'activity' => [
        'coin' => [
            'register_time' => 86400 * 30 * 3,
            'login_time' => 86400 * 30 * 3
        ]
    ],
    'coin_fee' => 0.1,
    'agent_code' => "kahap",
    'center_connection' => env( 'DB_CENTER_CONNECTION' ),
    'fb_appid' => env( 'FB_APPID' ),
    'fb_secret' => env( 'FB_SECRET' ),
    'fb_ver' => env( 'FB_VER' ),
    'g_plus_client_id' => env( 'G_PLUS_CLIENT_ID' ),
    'g_plus_client_pw' => env( 'G_PLUS_CLIENT_PW' ),
    'mall_connection' => env( 'DB_CONNECTION' ),
    'sys_category' => [
        'news' => [
            'type' => 3,
            'pid' => 3,
        ],
        'activity' => [
            'type' => 4,
            'pid' => 4,
        ],
        'museum' => [
            'type' => 5,
            'pid' => 5,
        ],
    ],
    'verification' =>
        [
            'limit' => 12,
            'time' => 3600,
        ],
];
