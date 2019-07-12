<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter ::className(),
        'actions' => [
          'delete' => ['POST'],
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
          // 'imagePathFormat' => "/images/{yyyy}{mm}{dd}/{time}{rand:6}",
          'imagePathFormat' => "/images/{yyyy}{mm}{dd}/{time}{rand:6}",
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
