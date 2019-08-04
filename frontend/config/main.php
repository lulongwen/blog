<?php
$params = array_merge(
  require __DIR__ . '/../../common/config/params.php',
  require __DIR__ . '/../../common/config/params-local.php',
  require __DIR__ . '/params.php',
  require __DIR__ . '/params-local.php'
);

$route = require __DIR__ . '/route.php';
$i18n = require __DIR__ . '/i18n.php';

return [
  'id' => 'app-frontend',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'name' => '珑文的博客',
  'homeUrl' => '/',
  // 设置默认首页
  'defaultRoute' => 'site/index',
  'language' => 'zh-CN', // linux 严格区分大小写
  'controllerNamespace' => 'frontend\controllers',
  'components' => [
    'request' => [
      'csrfParam' => '_csrf-frontend',
    ],
    'user' => [
      // 配置文件的 user映射的是 前台的 User 表
      'identityClass' => 'common\models\User',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
    ],
    'session' => [
      // this is the name of the session cookie used for login on the frontend
      'name' => 'advanced-frontend',
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
    'urlManager' => $route, // URL美化
    // 'i18n' => $i18n ,  //  语言包设置
    /*
    'assetManager' => [
      'appendTimestamp' => true,//实测对性能有影响
      'linkAssets' => true, // 刷新后就可以清除缓存
      'forceCopy'=>true,

      'bundles' => [
        'yii\bootstrap\BootstrapAsset' => [
          'css' => [],  // 去除 bootstrap.css
          'sourcePath' => null, // 防止在 frontend/web/asset 下生产文件
        ],
        'yii\bootstrap\BootstrapPluginAsset' => [
          'js' => [],  // 去除 bootstrap.js
          'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
        ],
      ],
    ],
    */
  ],
  'params' => $params,
];
