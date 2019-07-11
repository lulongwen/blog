<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-02
   * Time: 20:45
   */
  namespace frontend\widgets\banner;
  
  use Yii;
  use yii\bootstrap\Widget;
  
  class BannerWidget extends Widget {
    public $item = [];
    
    public function init() {
      // 如果不为空直接返回 item，否则给默认值
      if (!empty($this-> item)) return $this-> item;
      $this-> item = [
        [ 'label' => 'demo',
          'img' => '/images/banner/1.jpg',
          'url' => ['site/index'],
          'html' => '',
          'active' => true
        ],
        [ 'label' => 'demo',
          'img' => '/images/banner/2.jpg',
          'url' => ['site/index'],
          'html' => '',
        ],
        [ 'label' => 'demo',
          'img' => '/images/banner/3.jpg',
          'url' => ['site/index'],
          'html' => '',
        ],
        [ 'label' => 'demo',
          'img' => '/images/banner/4.jpg',
          'url' => ['site/index'],
          'html' => '',
        ]
      ];
    }
    
    public function run() {
      $data['items'] = $this-> item;
      return $this-> render('index', ['data' => $data]);
    }
  }