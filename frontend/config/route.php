<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-07-03
 * Time: 08:48
 */
return [
  // 开启美化效果
  'enablePrettyUrl' => true,
  // 不显示 脚本名index.php
  'showScriptName' => false,
  // 'enableStrictParsing' => false, 是否严格路由解析
  //  文件路径后缀
  'suffix' => '.html',
  'rules' => [
    'class' => 'yii\rest\UrlRule',
    '/' => 'site/index',
    'post' => 'post/index',
    'backend' => 'post/backend',
    'pmp' => 'post/pmp',
    'fullstack' => 'post/fullstack',
    'road' => 'post/road',
    // 详情页 url美化
    '<controller:\w+>/<id:\d+>' => '<controller>/detail'
  ],
];