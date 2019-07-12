<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-03
   * Time: 22:21
   */
  namespace frontend\models;

  use Yii;
  use Exception;
  use yii\base\Model;
  use common\models\ChatModel;
  
  class Chat extends Model{
    public $content;
    public $_lastError;
    
    public function rules() {
      return [
        [['content'], 'required'],
        [['content'], 'string', 'max' => 255],
      ];
    }
  
    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
      return [
        'id' => 'ID',
        'user_id' => '用户 ID',
        'content' => '发布信息',
        'created_at' => '发布时间',
      ];
    }
  
    public function create() {
      try {
        $model = new ChatModel();
        $model-> user_id = Yii::$app-> user-> identity-> id;
        $model-> content = $this-> content;
        $model-> created_at = time();
      
        if (!$model-> save()) throw new Exception('发布状态失败');
        return true;
      } catch (Exception $error) {
        $this-> _lastError = $error-> getMessage();
        return false;
      }
    }
  
    public function getList() {
      $model = new ChatModel();
      $data = $model->find()-> limit(10)
                    -> with('user')-> orderBy(['id' => SORT_DESC])-> asArray()-> all();
    
      return $data ?: []; // 如果有值返回值，否则返回空数组
    }
    
  }
