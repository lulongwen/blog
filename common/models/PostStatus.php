<?php

  namespace common\models;

  use Yii;

  /**
   * This is the model class for table "{{%post_status}}".
   *
   * @property int $id       自增 id
   * @property int $postid   文章 id
   * @property int $pv       pv 网页浏览量
   * @property int $praise   点赞
   * @property int $collect  收藏
   */
  class PostStatus extends \yii\db\ActiveRecord
  {

    public static function tableName() {
      return '{{%post_status}}';
    }


    public function rules() {
      return [
        [['postid'], 'required'],
        [['postid', 'pv', 'praise', 'collect'], 'integer'],
      ];
    }


    public function attributeLabels() {
      return [
        'id' => 'ID',
        'postid' => '文章ID',
        'pv' => '浏览量',
        'praise' => '点赞',
        'collect' => '收藏',
      ];
    }


    // 网页访问量
    public function upCounter($id, $attr, $num) {
      $counter = $this-> findOne($id);

      if ($counter) {
        // 统计那个字段，数值是多少 [$attr => $num]
        $countData[$attr] = $num;
        // yii 自带的，+1
        return $counter-> updateCounters($countData);
      }

      // 如果不存在
      $this-> setAttributes($id);
      $this-> $attr = $num;
      $this-> isNewRecord = true;

      $this-> save();
      return $this-> id;

    }
















  }
