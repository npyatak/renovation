<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use common\models\Gallery;
use common\models\search\GallerySearch;
use common\models\GallerySlide;
use common\models\search\GallerySlideSearch;


class GalleryController extends CController
{

    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $gallery = $this->findGallery($id);
        $searchModel = new GallerySlideSearch();
        $params = Yii::$app->request->queryParams;
        $params['GallerySlideSearch']['gallery_id'] = $id;
        $dataProvider = $searchModel->search($params);

        return $this->render('view', [
            'gallery' => $gallery,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findGallery($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if($model->imageFile) {
                $path = $model->imageSrcPath;
                if(!file_exists($path)) {
                    mkdir($path, 0775, true);
                }
                if($model->image && file_exists($path.$model->image)) {
                    unlink($path.$model->image);
                }

                $model->image = md5(time()).'.'.$model->imageFile->extension;
                
                $model->imageFile->saveAs($path.$model->image);
                $model->save(false, ['image']);
            }

            return $this->redirect('index');
        } 

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCreateSlide($gId)
    {
        $gallery = $this->findGallery($gId);

        $model = new GallerySlide();
        $model->gallery_id = $gId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                       
            if($model->imageFile) {
                $path = $model->imageSrcPath;
                if(!file_exists($path)) {
                    mkdir($path, 0775, true);
                }

                $model->image = md5(time()).'.'.$model->imageFile->extension;
                
                $model->imageFile->saveAs($path.$model->image);
                $model->save(false, ['image']);
            }

            return $this->redirect(['view', 'id' => $gallery->id]);
        } 
            
        return $this->render('create-slide', [
            'gallery' => $gallery,
            'model' => $model,
        ]);
    }

    public function actionUpdateSlide($gId, $id)
    {
        $gallery = $this->findGallery($gId);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if($model->imageFile) {
                $path = $model->imageSrcPath;
                if(!file_exists($path)) {
                    mkdir($path, 0775, true);
                }
                if($model->image && file_exists($path.$model->image)) {
                    unlink($path.$model->image);
                }

                $model->image = md5(time()).'.'.$model->imageFile->extension;
                
                $model->imageFile->saveAs($path.$model->image);
                $model->save(false, ['image']);
            }

            return $this->redirect(['view', 'id' => $gallery->id]);
        } 

        return $this->render('update-slide', [
            'gallery' => $gallery,
            'model' => $model,
        ]);
    }

    public function actionDeleteSlide($gId, $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['view', 'id' => $gId]);
    }

    protected function findModel($id)
    {
        if (($model = GallerySlide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findGallery($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
