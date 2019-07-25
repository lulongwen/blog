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


    // 获取 标签的关联关系，一对一的关系
    // 一条数据对应一篇文章和一个标签
    public function getTag() {
      // 和标签表 Tag关联，Tag表的 id 指向 PostTag的 tagid
      return $this-> hasOne(Tag::className(), ['id' => 'tagid']);
    }

  }
