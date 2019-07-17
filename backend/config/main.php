<?php
  $params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
  );

  return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'name' => '珑文的博客',
    'language' => 'zh-CN',
    'components' => [
      'request' => [
        'cookieValidationKey' => 'lulongwen2019',
        'csrfParam' => '_csrf-backend',
      ],
      'user' => [
        'identityClass' => 'common\models\Adminuser',
        'enableAutoLogin' => true,
        'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
      ],
      // 解决前后台 id相同公用 session 同时登录注销问题
      // 设置后台专用 session，和前台区分开
      'session' => [
        // this is the name of the session cookie used for login on the backend
        'name' => 'advanced-backend',
      ],
      'assetManager' => [
        'bundles' => [
          'dmstr\web\AdminLteAsset' => [
            // 配置颜色 -blue -yellow -black
            'skin' => 'skin-red-light'
          ]
        ]
      ],
      'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
          [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
          ],
        ],
      ],
      'errorHandler' => [
        'errorAction' => 'site/error',
      ],
      /*
      'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => [
          ],
      ],
      */
    ],
    'params' => $params,
  ];
