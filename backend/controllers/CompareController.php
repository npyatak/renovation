<?php

namespace backend\controllers;

use Yii;
use common\models\Compare;
use common\models\search\CompareSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompareController implements the CRUD actions for Compare model.
 */
class CompareController extends CController
{

    /**
     * Lists all Compare models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompareSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compare model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Compare model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Compare();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {                     
            $images = ['imageFile' => 'image', 'imageFileOld' => 'image_old', 'imageFileNew' => 'image_new'];

            foreach ($images as $file => $attr) {
                $model->$file = UploadedFile::getInstance($model, $file);
                if($model->$file) {
                    $path = $model->imageSrcPath;
                    if(!file_exists($path)) {
                        mkdir($path, 0775, true);
                    }

                    $model->$attr = md5(time()).'.'.$model->$file->extension;
                    
                    $model->$file->saveAs($path.$model->$attr);
                    $model->save(false, [$attr]);
                }
            }

            return $this->redirect(['index']);
        } 
            
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Compare model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $images = ['imageFile' => 'image', 'imageFileOld' => 'image_old', 'imageFileNew' => 'image_new'];
            
            foreach ($images as $file => $attr) {
                $model->$file = UploadedFile::getInstance($model, $file);
                if($model->$file) {
                    $path = $model->imageSrcPath;
                    if(!file_exists($path)) {
                        mkdir($path, 0775, true);
                    }
                    if($model->$attr && file_exists($path.$model->$attr)) {
                        unlink($path.$model->$attr);
                    }

                    $model->$attr = md5(time()).'.'.$model->$file->extension;
                    
                    $model->$file->saveAs($path.$model->$attr);
                    $model->save(false, [$attr]);
                }
            }

            return $this->redirect(['index']);
        } 

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Compare model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Compare model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compare the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compare::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
