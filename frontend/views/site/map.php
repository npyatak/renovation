<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;

use common\models\District;
use common\models\Region;

$this->title = 'Карта';
?>

<?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;onload=app.objectMap.ymapsInit');?>
<?php $this->registerJsFile(Url::toRoute('js/map.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);?>

<div class="renovation blue_top_bg">
    <div class="container_inner top_block white">
        <img class="tass_logo" src="<?=Url::to('images/tass_logo_white.png');?>"/>
        <a class="go_front" href="/"><i class="fa fa-angle-left" aria-hidden="true"></i>На главную</a>
        <div class="social white">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="container_inner white_text">
        <h1 class="white_text"><?=$type == 'house' ? 'Дома, включенные в программу' : 'Стартовые площадки';?> 1 этапа реновации. Карта</h1>
        <div class="top_text">
            <p>
                <?=$page->text;?>
            </p>
        </div>
        <div class="select_area">
            Отобразить
            <a href="<?=Url::toRoute(['site/map', 'type' => 'house'])?>" class="btn btn-primary <?=$type == 'house' ? 'active' : 'start white_text';?>">Дома, включенные в программу</a>
            <a href="<?=Url::toRoute(['site/map', 'type' => null])?>" class="btn btn-primary <?=$type == 'house' ? 'start white_text' : 'active';?>">Стартовые площадки</a>
        </div>
    </div>


    <div id="object-map" style="width: 100%; height: 500px;"></div>

    <div class="container_inner areas_table">
        <div class="title_table"><?=$type == 'house' ? 'Дома' : 'Стартовые площадки';?>, включенные в программу реновации</div>
        <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'district_id',
                        'value' => function($data) {
                            return $data->district->name;
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'district_id', ArrayHelper::map(District::find()->all(), 'id', 'name'), ['prompt' => '', 'id' => 'district_id']),
                    ],
                    [
                        'attribute' => 'region_id',
                        'value' => function($data) {
                            return $data->region->name;
                        },
                        'filter' => DepDrop::widget([
                            'name' => \yii\helpers\StringHelper::basename(get_class($searchModel)).'[region_id]',
                            'value' => $searchModel->attributes['region_id'],
                            'data' => [null => 'Выберите...'] + ($searchModel->attributes['district_id'] ? ArrayHelper::map(Region::find()->where(['district_id' => $searchModel->attributes['district_id']])->all(), 'id', 'name') : $regionArr),
                            'pluginOptions' => [
                                'depends' => ['district_id'],
                                'placeholder' => 'Выберите...',
                                'url' => Url::toRoute(['/site/regions'])
                            ],
                        ]),
                    ],
                    'address',
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>

    <?php $pm = [];
    if($houses) {
        foreach ($houses as $obj) {
            $content = '<div id="obj_'.$obj['id'].'" class="bln"><p>'.$districtsArr[$obj['district_id']].'</p><p>'.$regionArr[$obj['region_id']].'</p><p>'.$obj['address'].'</p></div>';

            $pm[] = "{
                coords: [".$obj['lat'].", ".$obj['lng']."],
                type: 'H',
                content: '".$content."'
            }";
        }
    } elseif($startPlaces) {
        foreach ($startPlaces as $obj) {
            $content = '<div id="obj_'.$obj['id'].'" class="bln"><p>'.$districtsArr[$obj['district_id']].'</p><p>'.$regionArr[$obj['region_id']].'</p><p>'.$obj['address'].'</p></div>';

            $pm[] = "{
                coords: [".$obj['lat'].", ".$obj['lng']."],
                type: 'SP',
                content: '".$content."'
            }";
        }
    } ?>

    <script>
        window.mapsImagesPath = '/images/';
        window.objectPlacemarks = [
            <?=implode(',', $pm);?>
        ];
    </script>

    <?php 
    $script = $this->render('_map-script', ['type' => $houses ? 'houses' : 'places']);
    $this->registerJs($script, yii\web\View::POS_END);
    ?>
</div>
<div class="bottom_gallery">
    <div class="title_bottom_gallery">Социальные обязательства: детские площадки, садики, школы и поликлиники</div>
    <div class="bottom_gallery_img">
        <a href="#" class="bottom_gallery_video"><img src="<?=Url::toRoute('images/footer_gallery_img.jpg');?>"/></a>
        <iframe width="100%" height="790" src="https://www.youtube.com/embed/ZStqzGWEBGw" frameborder="0" allowfullscreen></iframe>
    </div>
</div>