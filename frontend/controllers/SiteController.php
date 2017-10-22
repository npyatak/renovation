<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use common\models\Page;
use common\models\House;
use common\models\search\HouseSearch;
use common\models\StartPlace;
use common\models\search\StartPlaceSearch;
use common\models\District;
use common\models\Region;
use common\models\Compare;
/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRenovation($type = null) {
        $houses = null;
        $startPlaces = null;
        $page = Page::find()->where(['url' => 'renovation'])->one();

        $regionArr = Region::find()->select(['name', 'id'])->indexBy('id')->asArray()->column();
        $districtsArr = District::find()->select(['name', 'id'])->indexBy('id')->asArray()->column();

        if($type == 'house') {
            $searchModel = new HouseSearch();
            $params = Yii::$app->request->queryParams;
            if(isset($params['HouseSearch']['region_id']) && $params['HouseSearch']['region_id']) {
                $params['HouseSearch']['district_id'] = Region::find()->select(['district_id'])->where(['id' => $params['HouseSearch']['region_id']])->column()[0];
            }
            $dataProvider = $searchModel->search($params);

            $houses = House::find()
                ->select(['id', 'address', 'lat', 'lng', 'district_id', 'region_id'])
                ->asArray()
                ->all();
        } else {
            $searchModel = new StartPlaceSearch();
            $params = Yii::$app->request->queryParams;
            if(isset($params['StartPlaceSearch']['region_id']) && $params['StartPlaceSearch']['region_id']) {
                $params['StartPlaceSearch']['district_id'] = Region::find()->select(['district_id'])->where(['id' => $params['StartPlaceSearch']['region_id']])->column()[0];
            }
            $dataProvider = $searchModel->search($params);

            $houses = StartPlaceSearch::find()
                ->select(['id', 'address', 'new_address', 'lat', 'lng', 'district_id', 'region_id'])
                ->asArray()
                ->all();
        }

        return $this->render('renovation', [
            'page' => $page,
            'houses' => $houses,
            'startPlaces' => $startPlaces,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'regionArr' => $regionArr,
            'districtsArr' => $districtsArr,
        ]);
    }

    public function actionCompare() {
        $compares = Compare::find()->where(['status' => Compare::STATUS_ACTIVE])->all();

        return $this->render('compare', [
            'compares' => $compares,
        ]);
    }

    public function actionLonggrid()
    {
        return $this->render('longgrid');
    }

    public function actionTimeline()
    {
        return $this->render('timeline');
    }

    public function actionLaw()
    {
        return $this->render('law');
    }

    public function actionGallery()
    {
        return $this->render('gallery');
    }

    public function actionRegions() {
        $result = [null => 'Выберите...'];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $district_id = $parents[0];
                foreach (Region::find()->select(['id', 'name'])->where(['district_id' => $district_id])->asArray()->all() as $region) {
                    $result[] = ['id' => $region['id'], 'name' => $region['name']];
                }

                return json_encode(['output'=>$result, 'selected'=>'']);
            }
        }

        return json_encode(['output'=>'', 'selected'=>'']);
    }
}
