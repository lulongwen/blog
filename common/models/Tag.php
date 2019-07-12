<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_tag}}".
 *
 * @property string $id
 * @property string $name
 * @property int $frequency
 */
class Tag extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return '{{%tag}}';
    }


    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer', 'max' => 11],
            [['name'], 'string', 'max' => 120],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '标签名称',
            'frequency' => '关联文章数量',
        ];
    }


  // 使用正则表达式，把标签字符串转换成数组
  public static function string2array($tags) {
    return preg_split('/\s*, \s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
  }


  // 标签云，自定义的组件
  public static function findTagWeights($limit=20) {
    $tagLevel = 5;
    $model = Tag::find()-> orderBy('frequency desc')
      -> limit($limit) -> all();

    $total = self::find() -> limit($limit) ->count();

    $step = ceil($total / $tagLevel);

    $tags = array();
    $count = 1;

    if ($total > 0) {
      foreach($models as $item) {
        $weight = ceil($count / $step) + 1;
        $tags[$item -> name] = $weight;
        $count ++;
      }

      ksort($tags);
    }

    return $tags;
  }
}
