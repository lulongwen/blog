<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-07-03
 * Time: 08:52
 */
return [
  'translations' => [
    '*' => [
      'class' => 'yii\i18n\PhpMessageSource',
      'basePath' => '/i18n',
      'fileMap' => [
        'common' => 'common.php', // 公共语言包
        // 'list' => 'list.php', // 列表页语言包
      ]
    ]
  ]
];