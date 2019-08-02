<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-08-02
 * Time: 06:30
 */

return [
  // 开启美化效果
  'enablePrettyUrl' => true,
  // 不显示 脚本名index.php
  'showScriptName' => false,
  // 'enableStrictParsing' => false, 是否严格路由解析
  // 'pluralize' => false, // 去掉复数形式
  //  文件路径后缀
  'suffix' => '.html',
  'rules' => [
    'class' => 'yii\rest\UrlRule',
    '/' => 'site/index',
    // 'post' => 'post/index',
    
    // 右边所有 控制器的 index动作都可以用 左边控制器id +s 来代替
    // '<controller:(post|comment)>s' => '<controller>/index',
    '<controller:\w+>s' => '<controller>/index',

    // 详情页 url美化, 控制器名 + id
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    // action的样式 /post/create
    '<controller:\w+>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
  ],
];