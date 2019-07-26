<?php
/**
   * Created by PhpStorm.
   * User: 卢珑文
   * Date: 2019-07-26
   * Time: 16:01
   * description:

  Controller 使用
  $merge = new Merge();
  $query = $merge::find()->all();  
  查询所有的数据，es默认查出来10条

  elastic https://www.yiichina.com/tutorial/1939
   */

namespace common\models;

use Yii;
use yii\elasticsearch\ActiveRecord;

class Elastic extends ActiveRecord
{
    //需要返回的字段
    public function attributes()
    {
        return ['contactphone','xxx','xxx']; //其实这里就是你要查询的字段，你要查什么写什么字段就好了
    }


    //索引
    public static function index()
    {
        return 'visit_patient_test_index';
    }


    //文档类型
    public static function type()
    {
        return 'visit_patient_type';
    }


    //这个就是第二步配置的组件的名字（key值）
    public static function getDb()
    {
        return Yii::$app->get('elasticsearch');
    }
}