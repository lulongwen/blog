<?php

namespace common\models;

use Yii;


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
  
  // 把标签字符串,转换成数组
  public static function string2array($tags)
  {
    $arr = preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);


    return $arr;
  }
  
  // 把标签数组转字符串
  public static function array2string($tags)
  {
    return implode(',', $tags);
  }
  
  // 添加标签
  public static function addTags($tags)
  {
    // 如果空值就返回
    if (empty($tags)) {
      return;
    }
    
    foreach ($tags as $name) {
      // 获取数据库中的标签和数量
      $tag = Tag ::find() -> where(['name' => $name]) -> one();
      $tagCount = Tag ::find() -> where(['name' => $name]) -> count();
      // 判断数据库中有没有这个标签
      if (!$tagCount) {
        $myTag = new Tag();
        $myTag -> name = $name;
        $myTag -> frequency = 1;
        $myTag -> save();
      } else {
        // 如果存在 +1，不存在就创建
        $tag -> frequency += 1;
        $tag -> save();
      }
    }
  }
  
  // 删除标签
  public static function removeTags($tags) {
    if (empty($tags)) return;
    
    foreach($tags as $name) {
      $tag = Tag::find()-> where(['name'=> $name])-> one();
      $tagCount = Tag::find()-> where(['name' => $name])->count();
      
      if ($tagCount) {
        // 如果标签数量为1，减了1 之后数量为0，就删除
        if ($tagCount && $tag-> frequency <= 1) {
          $tag -> delete();
        }
        else {
          $tag-> frequency -= 1;
          $tag-> save();
        }
      }
    }
  }
  
  
  // 更新标签
  public static function updateFrequency($oldTags, $newTags) {
    // 先确认2个标签字符串都不为空，然后转换为数组
    if (!empty($oldTags) || !empty($newTags)) {
      $oldTagsArray = self::string2array($oldTags);
      $newTagsArray = self::string2array($newTags);

      // arrary_diff 求差集数组
      self::addTags(array_values(array_diff($newTagsArray, $oldTagsArray)));
      self::removeTags(array_values(array_diff($oldTagsArray, $newTagsArray)));
    }
  }
  
  
  
  // 标签云，自定义的组件
  public static function findTagWeights($limit = 20)
  {
    $tagLevel = 5;
    $model = Tag ::find() -> orderBy('frequency desc') -> limit($limit) -> all();
    
    $total = self ::find() -> limit($limit) -> count();
    
    $step = ceil($total / $tagLevel);
    
    $tags = array();
    $count = 1;
    
    if ($total > 0) {
      foreach ($model as $item) {
        $weight = ceil($count / $step) + 1;
        $tags[$item -> name] = $weight;
        $count++;
      }
      
      ksort($tags);
    }
    
    return $tags;
  }
}
