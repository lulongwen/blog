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
  use common\models\Chat;

  class ChatForm extends Model{
    public $content;
    public $_lastError;

    public function rules() {
      return [
        [['content'], 'required'],
        [['content'], 'string', 'max' => 255],
      ];
    }

    public function attributeLabels() {
      return [
        'id' => '自增 ID',
        'userid' => '用户 ID',
        'content' => '发布信息',
        'created_at' => '发布时间',
        'deleted_at' => '删除时间',
      ];
    }

    // 发表信息
    public function create() {
      try {
        $model = new Chat();
        $model -> userid = Yii::$app -> user -> identity -> id;
        $model -> content = $this-> content;
        $model -> created_at = time();

        if (!$model-> save()) throw new Exception('发布消息失败');
        return true;
      }
      catch(Exception $err) {
        $this-> _lastError = $err-> getMessage();
        return null;
      }
    }


    // 获取信息
    public function getList() {
      $model = new Chat();
      $data = $model -> find() -> limit(10)
        -> with('user')-> orderBy(['id' => SORT_DESC])
        -> asArray() -> all();

      return $data ?: [];
    }
  }




























