<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        // 文件缓存 
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        // 权限管理模块
        'authManager' => [
    		'class' =>'yii\rbac\DbManager',
    	],

        // Elastic
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '127.0.0.1:9200'],
            ],
        ],
    ],
];
