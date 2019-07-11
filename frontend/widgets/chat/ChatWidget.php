<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-02
   * Time: 22:58
   * 聊天留言板组件
   */
  namespace frontend\widgets\chat;
  
  use Yii;
  use yii\base\BaseObject;
  use yii\bootstrap\Widget;
  use common\models\ChatModel;
  use frontend\models\Chat;

  class ChatWidget extends Widget {
    public $title = '时刻动态';
    
    public function run() {
      $chat = new Chat();
      $data['chat'] = $chat-> getList();
      $data['title'] = $this-> title;
      
      return $this-> render('index', ['data' => $data]);
    }
  }