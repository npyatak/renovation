<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;

use common\models\District;
use common\models\Region;

$this->title = 'Реновация';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;onload=app.objectMap.ymapsInit');?>
<?php $this->registerJsFile(Url::toRoute('js/map.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);?>
<?php //$this->registerJsFile(Url::toRoute('js/player_setup_footer.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);?>

<div class="header">
    <img class="logo" src="/frontend/web/images/logo.png" />
    <div class="container_inner">
        <a class="map_link" href="#">Карта</a>
        <ul class="menu">
            <li>
                <a href="#">Закон о реновациях</a>
            </li>
            <li>
                <a class="active" href="#">Карта</a>
            </li>
            <li>
                <a href="#">Даты реализации</a>
            </li>
            <li>
                <a href="#">Герои</a>
            </li> 
            <li>
                <a href="#">История реноваций</a>
            </li>
            <li>
                <a href="#">Хрущевки VS новые дома</a>
            </li>
        </ul>
        <div class="menu-btn">
            <div class="open-menu-btn show"><span></span><span></span><span></span></div>
            <div class="close-menu__btn"><span></span><span></span></div>
        </div>
    </div>
</div>
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
        <h1 class="white_text">Стартовые площадки 1 этапа реновации. Карта</h1>
        <div class="top_text">
            <p>
                1 августа Сергей Собянин утвердил программу реновации. Вместо квартир в ветхих пятиэтажках москвичи получат жилье в новых монолитных и панельных домах.<br>
                26 сентября опубликован список стартовых площадок программы реновации. При выборе учитывалось мнение москвичей и дальнейшее осуществление квартальной застройки.
            </p>
            <!--
            <?=$page->text;?>
            -->
        </div>
        <div class="select_area">
            Отобразить
            <?=Html::a('Дома, включенные в программу', Url::toRoute(['site/renovation', 'type' => 'house']), ['class' => 'btn btn-primary active include']);?>
            <?=Html::a('Стартовые площадки', Url::toRoute(['site/renovation']), ['class' => 'btn btn-primary start white_text']);?>
        </div>
    </div>


    <div class="" id="object-map" style="width: 100%; height: 500px;"></div>

    <div class="container_inner areas_table">
        <div class="title_table">Дома, включенные в программу реновации</div>
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
            /* Содержимое балунов. Тут надо использовать по минимуму html потому что этих объектов больше 5 тысяч*/
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
    $script = $this->render('_map-script');
    $this->registerJs($script, yii\web\View::POS_END);
    ?>
</div>
<div class="bottom_select_gallery">
    <a href="#" class="select_gallery">
        <img src="/frontend/web/images/gallery/footer_1.jpg"/>
    </a>
    <a href="#" class="select_gallery">
        <img src="/frontend/web/images/gallery/footer_2.jpg"/>
    </a>
    <a href="#" class="select_gallery">
        <img src="/frontend/web/images/gallery/footer_3.jpg"/>
    </a>
    <a href="#" class="select_gallery">
        <img src="/frontend/web/images/gallery/footer_4.jpg"/>
    </a>
</div>
<div class="bottom_gallery">
    <div class="bottom_gallery_img">
        <a href="#" class="bottom_gallery_video"><img src="/frontend/web/images/footer_gallery_img.jpg"/></a>
        <iframe width="100%" height="790" src="https://www.youtube.com/embed/ZStqzGWEBGw" frameborder="0" allowfullscreen></iframe>
    </div>
</div>
<div class="footer">
    <div class="text_wrap">
        <p>
            ТАСС информационное агентство(св-во о регистрации СМИ №03247 выдано 02 апреля 1999 г. Государственным комитетом Российской Федерации по печати)<br/>
            Отдельные публикации могут содержать информацию, не предназначенную для пользователей до 16 лет.
        </p>

        <p>
            Подробнее на ТАСС:<br/>
            http://tass.ru/
        </p>
    </div>
</div>