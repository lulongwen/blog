<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%chat}}".
 *
 * @property int $id 自增 ID
 * @property int $user_id 用户 ID
 * @property string $content 留言内容
 * @property int $created_at 创建时间
 * @property int $deleted_at 删除时间
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'content', 'created_at'], 'required'],
            [['userid', 'created_at', 'deleted_at'], 'integer'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增 ID',
            'userid' => '用户 ID',
            'content' => '留言内容',
            'created_at' => '创建时间',
            'deleted_at' => '删除时间',
        ];
    }


    public function getUser() {
      return $this-> hasOne(User::className(), ['id' => 'userid']);
    }
}
























