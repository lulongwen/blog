<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-06-02
 * Time: 08:20
 */

namespace frontend\models;

use yii\base\Model;
use common\models\Tag;

class TagForm extends Model {
  public $id;
  public $tag;

  public function rules() {
    return [
      ['name', required],
      ['name', 'each', 'rule' => ['string']]
    ]
  }


  // 返回所有的 id集合
  public function saveTag() {
    $ids = [];
    $type = gettype($this-> tag);

    if ($type === 'string') $arr = explode(',', $this-> tag);
    // 如果不为空，遍历 tag数组
    if (!empty($arr)) {
      foreach($arr as $tag) {
        $ids[] = $this-> _saveTag($tag);
      }
    }

    return $ids;
  }


  // 保存标签，参数就是参数名
  private function _saveTag($tag) {
    $model = new Tag();
    // 标签不允许重复， find() -> one()
    $res = $model-> find() -> where(['name' => $tag]) -> one();

    // 如果没有，就新建标签
    if (!res) {
      $model -> name = $tag;
      $model -> frequency = 1;

      if (!$model-> save()) throw new \Exception('文章标签保存失败');
      // 没有 $res 就返回 $model的  id
      return $model -> id;
    }

    // 如标签存在 +1 ，返回保存成功的 id
    $res -> updateCounters(['frequency' => 1]);
    return $res -> id;
  }
}