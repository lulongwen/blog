<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 * @property int $id 自增 id
 * @property string $name 分类名称
 */
class Category extends \yii\db\ActiveRecord
{

  public static function tableName()
  {
    return '{{%category}}';
  }
  
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name'], 'string', 'max' => 80],
      [['name'], 'unique'],
    ];
  }
  
  
  public function attributeLabels()
  {
    return [
      'id' => '分类 ID',
      'name' => '分类名称',
    ];
  }
  
  // 获取所有分类
  public static function getAllCategory() {
    $cate = ['0' => '暂无分类'];
    $res = self::find()-> asArray() -> all();
    if ($res) {
      foreach($res as $key => $val) {
        // 以数据库的 id为 key，name为值
        $cat[$val['id']] = $val['name'];
      }
    }
    
    return $cate;
  }
}
