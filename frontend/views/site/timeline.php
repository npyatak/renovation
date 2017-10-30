<?php
use yii\helpers\Url;

$this->title = 'Таймлайн';

$this->registerJsFile(Url::toRoute('js/timeline.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="timeline blue_top_bg">
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
        <h1 class="white_text">Даты реализации проекта по реновации. Таймлайн</h1>
    </div>
    
    <!-- <div id="object-slider" style="width: 100%; height: 650px;"></div> -->
    <div id="sliderbox" class="sliderbox">
        <?php if ($slides) :?>
            <?php $key = 0;
            foreach ($slides as $key => $slide) :?>
                <div class="item<?=$key == 0 ? ' active' : '';?> width_<?=$slide->width_preset;?>" data-index="<?=$key;?>">
                    <div class="date">
                        <span class="date-item">
                            <?=$slide->date_1;?>
                            <br>
                            <?=$slide->date_2;?>
                        </span>
                    </div>
                    <div class="hr"></div>
                    <div class="description">
                        <div class="dot"></div>
                        <?=$slide->text;?>
                        <div class="circle fl">
                            <div class="prev"><</div>
                        </div>
                        <div class="circle fr <?=$key == 0 ? ' active' : '';?>">
                            <div class="next">></div>
                        </div>
                    </div>
                </div>
            <?php                                                                                                                                                                                                                                                                                                                                                                                                                                 endforeach;?>
        <?php endif;?>
    </div>
</div>
