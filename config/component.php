<?php

return [
    //控制器模块位置
    'directory' => app_path(),
    //路由
    'route' => [

        'prefix' => env('ADMIN_ROUTE_PREFIX', ''),

        'namespace' => 'App\\Http\\Controllers',

        'middleware' => ['web', 'admin'],
    ],
];