<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vitalik74\geocode\Geocode;

use common\models\StartPlace;
use common\models\search\StartPlaceSearch;
use common\models\District;
use common\models\Region;

/**
 * StartPlaceController implements the CRUD actions for StartPlace model.
 */
class StartPlaceController extends CController
{

    /**
     * Lists all StartPlace models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StartPlaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StartPlace model.
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
     * Creates a new StartPlace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StartPlace();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StartPlace model.
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
     * Deletes an existing StartPlace model.
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
     * Finds the StartPlace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StartPlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StartPlace::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest() {
        
    //     ВАО 45263000
    //     ЗАО 45268000
    //     ЗелАО   45272000
    //     САО 45277000
    //     СВАО    45280000
    //     СЗАО    45283000
    //     ЦАО 45286000
    //     ЮВАО    45290000
    //     ЮЗАО    45293000
    //     ЮАО 45296000

    // 45297000
    // 45298000

        // $fileName = __DIR__ . '/../web/uploads/ao.geojson';

        // $handle = fopen($fileName, "r");
        // $contents = fread($handle, filesize($fileName));
        // fclose($handle);

        // $contents = json_decode($contents);

        // $data = [];
        // foreach ($contents->features as $c) {
        //     //print_r(json_encode($c->geometry->coordinates[0][0]));exit;
        //     //print_r(implode(', ', $c->geometry->coordinates[0][0]));
        //     $data[] = "['".$c->properties->ABBREV."', '".json_encode($c->geometry->coordinates[0][0])."']";
        //     //echo '<br><br>';
        // }
        // print_r($data);
        // //print_r($contents->features);
        // exit;

        $addr1 = 'ЦАО'; 
        $addr2 = 'Замоскворечье';
        $addr3 = 'Кожевническая улица, дом 17/14, строение 2';

        $model = new StartPlace;
        $model->district_id = 1;
        $model->region_id = 2;
        $model->address = $addr3;

        $model->save();
    }

    public function actionXls() {
        $data = StartPlace::find()->asArray()->all();
        foreach ($data as $d) {
            echo '['.$d['district_id'].', '.$d['region_id'].', "'.$d['address'].'", "'.$d['new_address'].'", '.$d['lat'].', '.$d['lng'].']';
            echo '<br>';
        }
        exit;

        print_r(StartPlace::parseCoords('', 'поселение Кокошкино, дачный посёлок Кокошкино, улица Ленина, дом 2'));
        exit;
        $fileName = __DIR__ . '/../web/uploads/Стартовые площадки.xlsx';

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
        
        foreach ($data as $d) {
            if($d[1] && $d[2] && $d[3]) {

                $model = new StartPlace;

                $model->district_id = $districtArr[mb_strtolower(trim($d[3]), 'UTF-8')];
                $model->region_id = $regionArr[mb_strtolower(trim($d[1]), 'UTF-8')];
                
                if(substr_count($d[2], 'Присвоенный адрес:') > 0) {
                    $exp = explode('Присвоенный адрес:', $d[2]);
                    $model->address = trim($exp[0]);
                    $model->new_address = trim($exp[1]);
                } else {
                    $model->address = trim($d[2]);
                }

                $exists = StartPlace::find()->where(['region_id' => $model->region_id, 'address' => $model->address])->count();
                if($exists == 0) {
                    $model->save();
                }
            }
        }
    }
}
