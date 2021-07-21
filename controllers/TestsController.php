<?php

namespace app\controllers;

use Yii;
use app\models\Tests;
use app\models\TestItems;
use app\models\Model;
use app\models\TestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * TestsController implements the CRUD actions for Tests model.
 */
class TestsController extends Controller
{
    /**
     * @inheritdoc
     */
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['create','index','update','view','delete','bulk-delete'],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->user->identity->permission == \app\models\Users::ADMIN){
                                return true;
                            }elseif(Yii::$app->user->identity->permission == \app\models\Users::MODERATOR){
                                $allow = in_array($action->id,['create','view','index']);
                                if($id = Yii::$app->request->get('id')){
                                    $allow = $allow || (Tests::findOne($id)->user_id == Yii::$app->user->identity->id && in_array($action->id,['update','delete']));
                                }
                                return $allow;
                            }
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tests models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TestsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Tests model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> Yii::t('app',"Tests #").$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Tests model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $request = Yii::$app->request;
        $modelTest = new Tests();
        $modelTest->user_id = Yii::$app->user->identity->id;

        $modelsTestItem = [new TestItems];

        if ($modelTest->load($request->post())) {

            $modelsTestItem = Model::createMultiple(TestItems::classname());
            Model::loadMultiple($modelsTestItem, $request->post());

            // ajax validation
            if ($request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsTestItem),
                    ActiveForm::validate($modelTest)
                );
            }

            // validate all models
            $valid = $modelTest->validate();
            $valid = Model::validateMultiple($modelsTestItem) && $valid;
            
            if ($valid) {
                $modelTest->main_file_file = UploadedFile::getInstance($modelTest, 'main_file_file');
                $modelTest->analyse_file = UploadedFile::getInstance($modelTest, 'analyse_file');
                $modelTest->images_file = UploadedFile::getInstances($modelTest, 'images_file');
                
                $modelTest->uploadFiles();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelTest->save(false)) {
                        foreach ($modelsTestItem as $modelTestItem) {
                            $modelTestItem->test_id = $modelTest->id;
                            if (! ($flag = $modelTestItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelTest->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelTest' => $modelTest,
            'modelsTestItem' => (empty($modelsTestItem)) ? [new TestItems] : $modelsTestItem
        ]);

    }

        /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelTest = $this->findModel($id);
        $modelsTestItem = $modelTest->testItems;

        if ($modelTest->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsTestItem, 'id', 'id');
            $modelsTestItem = Model::createMultiple(TestItems::classname(), $modelsTestItem);
            Model::loadMultiple($modelsTestItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsTestItem, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsTestItem),
                    ActiveForm::validate($modelTest)
                );
            }

            // validate all models
            $valid = $modelTest->validate();
            $valid = Model::validateMultiple($modelsTestItem) && $valid;

            if ($valid) {
                $modelTest->main_file_file = UploadedFile::getInstance($modelTest, 'main_file_file');
                $modelTest->analyse_file = UploadedFile::getInstance($modelTest, 'analyse_file');
                $modelTest->images_file = UploadedFile::getInstances($modelTest, 'images_file');
                
                $modelTest->uploadFiles();

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelTest->save(false)) {
                        if (! empty($deletedIDs)) {
                            TestItems::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsTestItem as $modelTestItem) {
                            $modelTestItem->test_id = $modelTest->id;
                            if (! ($flag = $modelTestItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelTest->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelTest' => $modelTest,
            'modelsTestItem' => (empty($modelsTestItem)) ? [new TestItems] : $modelsTestItem
        ]);
    }
   

    /**
     * Delete an existing Tests model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Tests model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Tests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tests::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
