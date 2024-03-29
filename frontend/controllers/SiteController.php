<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\models\Page;
use common\models\House;
use common\models\search\HouseSearch;
use common\models\StartPlace;
use common\models\search\StartPlaceSearch;
use common\models\District;
use common\models\Region;
use common\models\Compare;
use common\models\TimelineSlide;
use common\models\Gallery;
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
        $galleries = Gallery::find()->all();

        return $this->render('index', [
            'galleries' => $galleries,
        ]);
    }

    public function actionMap($type = null) {
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
                ->where(['not', ['lat' => null]])->andWhere(['not', ['lng' => null]])
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
                ->where(['not', ['lat' => null]])->andWhere(['not', ['lng' => null]])
                ->asArray()
                ->all();
        }

        return $this->render('map', [
            'page' => $page,
            'houses' => $houses,
            'startPlaces' => $startPlaces,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'regionArr' => $regionArr,
            'districtsArr' => $districtsArr,
            'type' => $type,
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
        $page = Page::find()->where(['url' => 'timeline'])->one();
        $slides = TimelineSlide::find()->orderBy('number')->all();

        return $this->render('timeline', [
            'page' => $page,
            'slides' => $slides,
        ]);
    }

    public function actionLaw($page=1)
    {
        $query = Page::find()->where(['like', 'url', 'law_'])->orderBy('id');

        $countQuery = clone $query;
        $pages = new \yii\data\Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 1,
            'pageSizeParam' => false,
        ]);
        $models = $query->offset($pages->offset)
            ->limit(1)
            ->all();

        return $this->render('law', [
            'models' => $models,
            'pages' => $pages,
            'page' => $page,
        ]);
    }

    public function actionAbout($page = 'social') {
        $items = [1 => 'social', 2 => 'infrastructure', 3 => 'ecology'];
        $model = Page::find()->where(['url' => $page])->one();

        if($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('about', [
            'model' => $model,
            'items' => $items,
            'page' => $page,
        ]);
    }

    public function actionLawFile() {
        $completePath = __DIR__.'/../web/files/federalniy_zakon_141_fz.pdf';
        $filename = 'federalniy_zakon_141_fz.pdf';
        return Yii::$app->response->sendFile($completePath, $filename, ['inline'=>true]);
    }

    public function actionGallery($id = 1)
    {
        $gallery = Gallery::findOne($id);
        if($gallery === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $otherGalleries = Gallery::find()->where(['not', ['id' => $id]])->all();

        return $this->render('gallery', [
            'gallery' => $gallery,
            'slides' => $gallery->gallerySlides,
            'otherGalleries' => $otherGalleries,
        ]);
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

    public function actionHistory($page = 1) {
        return $this->render('history', [
            'page' => $page,
        ]);
    }
}
