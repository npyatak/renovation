<?php
use yii\helpers\Url;

$this->title = 'Главная';
?>
<div class="front">
    <?=$this->render('_top_block');?>
    
    <div class="container_inner front_text">
    	<img class="logo_big" src="<?=Url::toRoute('images/logo_big.png');?>"/>
        <h1>Реновации москвы.<br/> История, Герои, география</h1>
    </div>
    <div class="grid_wrap">
        <div class="grid_front">
            <div class="grid_item map">
                <img src="<?=Url::toRoute('images/map_img_front.jpg');?>"/>
                <div class="text_info">
                    <div class="small">Карта</div>
                    <a href="<?=Url::toRoute('site/map');?>">Стартовые площадки 1 этапа реновации</a>
                </div>
            </div>
            <div class="grid_item text1">
                <div class="block_text">
                    <div class="small">Читать</div>
                    <div class="text">
                        <a href="<?=Url::toRoute('site/history');?>">История реноваций: даты и факты</a>
                    </div>
                </div>
            </div>
            <div class="grid_item article">
                <img src="<?=Url::toRoute('images/article_img_front.jpg');?>"/>
                <div class="text_info">
                    <div class="small">Читать</div>
                    <a href="<?=Url::toRoute('site/heroes');?>">Герои: личные истории</a>
                </div>
            </div>
            <div class="grid_item text2">
                <div class="part part1">
                    <div class="block_text">
                        <div class="small">Закон</div>
                        <div class="text">
                            <a href="<?=Url::toRoute('site/law');?>">Расшифровка внутри</a>
                        </div>
                    </div>
                </div>
                <div class="part part2">
                    <div class="block_text">
                        <div class="small">Таймлайн</div>
                        <div class="text">
                            <a href="<?=Url::toRoute('site/timeline');?>">Даты реализации проекта по реновации</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid_item video">
                <a href="#" class="bottom_video"><img src="<?=Url::toRoute('images/video_front_img.jpg');?>"/></a>
                <iframe width="100%" height="790" src="https://www.youtube.com/embed/ZStqzGWEBGw" frameborder="0" allowfullscreen></iframe>
            </div>
            <?php if($galleries):?>
            <div class="grid_item slider_front_item">
                <div class="slider_front_wrap">
                    <div class="slider_front owl-carousel">
                    <?php foreach ($galleries as $gal):?>
                        <div class="slider_front_item">
                            <a href="<?=Url::toRoute(['site/gallery', 'id' => $gal->id]);?>">
                                <img src="<?=Url::toRoute('images/slider_front_img.jpg');?>"/>
                            </a>
                        </div>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>