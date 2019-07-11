<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property int $id 评论自增 id
 * @property string $content 评论内容
 * @property int $status 1 评论已发布，0 未发布
 * @property int $fans_id 前台用户 id
 * @property string $email 邮箱
 * @property string $url 评论链接
 * @property int $post_id 文章 id
 * @property int $remind 0 未提醒，1 已提醒
 * @property int $created_at 评论创建日期
 * @property int $updated_at 修改日期
 * @property int $is_deleted 是否删除
 * @property int $pv page view 浏览量
 * @property int $praise 点赞
 * @property int $collect 收藏
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status', 'fans_id', 'post_id', 'remind', 'created_at', 'updated_at', 'is_deleted', 'pv', 'praise', 'collect'], 'integer'],
            [['email'], 'string', 'max' => 80],
            [['url'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'status' => 'Status',
            'fans_id' => 'Fans ID',
            'email' => 'Email',
            'url' => 'Url',
            'post_id' => 'Post ID',
            'remind' => 'Remind',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'pv' => 'Pv',
            'praise' => 'Praise',
            'collect' => 'Collect',
        ];
    }
}
