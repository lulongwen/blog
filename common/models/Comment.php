<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_comment}}".
 *
 * @property string $id
 * @property string $content
 * @property int $status
 * @property int $create_time
 * @property int $user_id
 * @property string $email
 * @property string $url
 * @property string $post_id
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
            [['content', 'status', 'user_id', 'email', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'user_id', 'post_id'], 'integer'],
            [['email', 'url'], 'string', 'max' => 128],
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
            'create_time' => 'Create Time',
            'user_id' => 'User ID',
            'email' => 'Email',
            'url' => 'Url',
            'post_id' => 'Post ID',
        ];
    }
}
