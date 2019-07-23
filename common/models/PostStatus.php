<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%post_status}}".
 *
 * @property int $id 自增 id
 * @property int $postid 文章 id
 * @property int $position 排序
 * @property int $pv pv 网页浏览量
 * @property int $praise 点赞
 * @property int $collect 收藏
 * @property string $name 文章状态，0草稿，1已发布，2已归档
 */
class PostStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_status}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postid', 'position'], 'required'],
            [['postid', 'position', 'pv', 'praise', 'collect'], 'integer'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'postid' => 'Postid',
            'position' => 'Position',
            'pv' => 'Pv',
            'praise' => 'Praise',
            'collect' => 'Collect',
            'name' => 'Name',
        ];
    }
}
