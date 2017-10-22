<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vitalik74\geocode\Geocode;

use common\models\House;
use common\models\search\HouseSearch;
use common\models\District;
use common\models\Region;

/**
 * HouseController implements the CRUD actions for House model.
 */
class HouseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all House models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single House model.
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
     * Creates a new House model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new House();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing House model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing House model.
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
     * Finds the House model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return House the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = House::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    

    public function actionXls() {
        print_r(House::parseCoords('', 'район Даниловский, на пересечении 5-го Рощинского проезда и 2-ой Рощинской ул'));
        exit;

        ini_set('memory_limit', '-1');
        $data = House::find()->asArray()->all();
        foreach ($data as $d) {
            echo '['.$d['district_id'].', '.$d['region_id'].', "'.$d['address'].'", '.$d['lat'].', '.$d['lng'].']';
            echo '<br>';
        }
        exit;

        $fileName = __DIR__ . '/../web/uploads/перечень домов.xlsx';

        $districts = District::find()->select(['id', 'name'])->asArray()->all();
        $districtArr = [];
        foreach ($districts as $d) {
            $districtArr[mb_strtolower($d['name'], 'UTF-8')] = $d['id'];
        }

        $regions = Region::find()->select(['id', 'name'])->asArray()->all();
        $regionArr = [];
        foreach ($regions as $d) {
            $name = mb_strtolower(mb_ereg_replace('ё', 'е', $d['name']), 'UTF-8');
            $regionArr[$name] = $d['id'];
        }

        $data = \moonland\phpexcel\Excel::import($fileName);

        // $res = [];
        // foreach ($data as $d) {
        //     $res[] = $d[3];
        // }
        // array_unique($res);
        // print_r(count($res));
        // echo '<br>';
        //print_r(count($data));exit;
        // $count = 0;
        // foreach ($data as $d) {
        //     if($d[1] && $d[2] && $d[3]) {
        //         $count++;
        //     }
        // }
        // echo $count;
        // exit;
        $count = 0;

        foreach ($data as $d) {
            if($d[1] && $d[2] && $d[3]) {

                $model = new House;

                $model->district_id = $districtArr[mb_strtolower(trim($d[1]), 'UTF-8')];
                $model->region_id = $regionArr[mb_strtolower(trim($d[2]), 'UTF-8')];
                
                $model->address = trim($d[3]);

                $exists = House::find()->where(['region_id' => $model->region_id, 'address' => $model->address])->count();
                if($exists == 0) {
                    $model->save();
                    $count++;
                }
            }
        }
        echo $count;
    }
}
