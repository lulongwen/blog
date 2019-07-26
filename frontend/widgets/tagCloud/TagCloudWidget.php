<?php
  namespace frontend\widgets\tagCloud;
  
  use yii\bootstrap\Widget;
  use common\models\Tag;
  // use yii\base\Object;
  // use yii\db\Query;
  
  class TagCloudWidget extends Widget {
    public $title = '标签云';
    public $limit = 30;
    public $style = [
      '0' => 'danger',
      '1' => 'info',
      '2' => 'warning',
      '3' => 'primary',
      '4' => 'success'
    ];
    
    public function run() {
      $res = Tag::find()
        -> orderBy(['frequency' => SORT_DESC])
        ->limit($this-> limit)-> all();
      
      $data['title'] = $this-> title;
      $data['list'] = $res ?: [];
      $data['style'] = $this-> style;
      
      return $this->render('index', ['data' => $data]);
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  