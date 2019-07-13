<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use common\models\Category;
use common\models\PostForm;
use common\models\Comment;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



class PostController extends Controller
{
  // 行为过滤，比如，不能录不能发布文章
  public function behaviors()
  {
    return [
      /*'access' => [
        'class' => AccessControl::className(),
        'only' => ['index', 'create', 'upload'],
        'rules' => [
          [
            'actions' => ['index'], // 登录或不登录都可以访问
            'allow' => true,
            'roles' => ['?'], // ? 所有人都可以看到
          ],
          [
            'actions' => ['create', 'upload'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],*/

      'verbs' => [
        'class' => VerbFilter ::className(),
        'actions' => [
          'delete' => ['POST'],
          // '*', ['get', 'post'], // 所有方法 get post 都能访问
          // 'create' => ['get', 'post'],
        ],
      ],
    ];
  }
  
  // actions 等同于 actionUpload
  public function actions()
  {
    return [
      'upload' => [
        // 这里扩展地址别写错
        'class' => 'common\widgets\file_upload\UploadAction',
        'config' => [
          'imagePathFormat' => "/images/{yyyy}{mm}{dd}/{time}{rand:6}",
        ]
      ],
  
      'ueditor'=>[
        'class' => 'common\widgets\ueditor\UeditorAction',
        'config'=>[
          //上传图片配置, 图片访问路径前缀
          'imageUrlPrefix' => "",
          //  上传保存路径,可以自定义保存路径和文件名格式
          'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
        ]
      ]
    ];
  }

  
  public function actionIndex()
  {
    $searchModel = new PostSearch();
    $dataProvider = $searchModel -> search(Yii ::$app -> request -> queryParams);
    
    return $this -> render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }



  public function actionIndex2() {
    $model = Post::find()->asArray()-> all();
    return $this->render('index', ['model' => $model]);
  }
  
  /**
   * Displays a single Post model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    return $this -> render('view', [
      'model' => $this -> findModel($id),
    ]);
  }
  
  /**
   * Creates a new Post model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Post();
    
    // 获取所有分类
    $category = Category::getAllCategory();
    // return $this-> render('create', ['model' => $model, 'cate' => $category]);
  
    // 业务逻辑尽量避免放在控制器中间
    // $model-> created_at = time();
    // $model-> updated_at = time();
    
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> save()) {
      return $this -> redirect(['view', 'id' => $model -> id]);
    }
    
    return $this -> render('create', [
      'model' => $model,
    ]);
  }


  public function actionCreate2() {
    $model = new Post();
    // 定义场景
    $model-> setScenario(Post::SCENARIO_CREATE);
    if ($model-> load(Yii::$app-> request-> post()) && $model-> validate()) {
      if (!$model-> create()) {
        Yii::$app-> session-> setFlash('warning', $model-> _lastError);
      }
      else { // 创建成功跳转到预览
        return $this-> redirect(['post/detail', 'id' => $model-> id]);
      }
    }
    
    $cate = Category::getAll(); // 获取所有的分类
    return $this->render('create', ['model' => $model, 'cate' => $cate]);
  }



  // 文章详情
  public function actionDetail($id) {
    $model = new PostForm();
    $data = $model -> getDetail($id);

    // 文章 pv 浏览量统计，要把 id 字段，数量给带过去
    $model = new PostStatus();
    $model -> getCounter(['postid' => $id], 'pv', 1);
    
    // print_r($data); exit();
    return $this-> render('detail', ['data' => $data]);
  }


  
  /**
   * Updates an existing Post model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this -> findModel($id);
    // 更新时，把更新时间设置为当前时间，当执行 save时，保存的就是当前时间
    // 业务逻辑尽量避免放在控制器中间，应该放在模型文件中 Model
    // $model-> updated_at = time();
    
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> save()) {
      // echo '<pre>';
      // var_dump($model); exit();
      return $this -> redirect(['view', 'id' => $model -> id]);
    }
  
    
    return $this -> render('update', [
      'model' => $model,
    ]);
  }
  
  /**
   * Deletes an existing Post model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this -> findModel($id) -> delete();
    
    return $this -> redirect(['index']);
  }
  
  /**
   * Finds the Post model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Post the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Post ::findOne($id)) !== null) {
      return $model;
    }
    
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
