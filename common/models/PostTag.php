<?php

  namespace common\models;

  use Yii;

  /**
   * This is the model class for table "{{%post_tag}}".
   *
   * @property int $id     自增 id
   * @property int $postid 文章 id
   * @property int $tagid  标签 id
   */
  class PostTag extends \yii\db\ActiveRecord
  {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
      return '{{%post_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
      return [
        [['postid', 'tagid'], 'integer'],
        [['postid', 'tagid'], 'unique', 'targetAttribute' => ['postid', 'tagid']],
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
      return [
        'id' => 'ID',
        'postid' => 'Postid',
        'tagid' => 'Tagid',
      ];
    }


    // 获取 标签的关联关系
    public function getTag() {
      return $this-> hasOne(Tag::className(), ['id' => 'tagid']);
    }

  }
