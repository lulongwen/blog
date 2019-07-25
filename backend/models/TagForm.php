<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-06-02
 * Time: 08:20
 */

namespace backend\models;

use yii\base\Model;
use common\models\Tag;

// 表单模型，逻辑处理放在 Form里面，数据处理放在 models里面
class TagForm extends Model {
  public $id;
  public $tags;

  
  public function rules() {
    return [
      ['name', required],
      // each 遍历
      ['name', 'each', 'rule' => ['string']]
    ];
  }


  // 返回所有的 id集合
  public function saveTags() {
    $ids = [];
    $type = gettype($this-> tags);

    if ($type === 'string') $arr = explode(',', $this-> tags);
    
    // 如果不为空，遍历 tag数组
    if (!empty($arr)) {
      foreach($arr as $tag) {
        // 业务逻辑多，就单独拆分
        $ids[] = $this-> _save($tag);
      }
    }

    return $ids;
  }


  // 保存标签，参数就是参数名
  private function _save($tag) {
    $model = new Tag();
    // 标签不允许重复
    $res = $model-> find() -> where(['name' => $tag]) -> one();

    if ($res) {
      // 如标签存在 +1 ，返回保存成功的 id
      $res -> updateCounters(['frequency' => 1]);
      return $res -> id;
    }

    // 如果没有，就新建标签
    $model -> name = $tag;
    $model -> frequency = 1;

    if (!$model-> save()) throw new \Exception('文章标签保存失败');
    // 新建标签，返回标签的 id
    return $model -> id;


  }
}