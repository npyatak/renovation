<?php
use yii\helpers\Url;

//$this->title = 'Реновация в датах:';
$this->title = 'Москва без пятиэтажек';

$this->registerJsFile(Url::toRoute('js/timeline.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile(Url::toRoute('js/player_setup_footer.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Url::toRoute('uw/stylesheets/timeline.css'));
?>

<div class="timeline blue_top_bg">
    <?=$this->render('_top_block', ['class' => ' white']);?>
    	
    <div class="container_inner">
        <h1><?=$this->title;?> <span>от предложения проекта до его реализации</span></h1>
    </div>
    
    <div class="container_inner sliderbox" id="sliderbox">
        <?php if ($slides) :?>
            <?php $key = 0;
            foreach ($slides as $key => $slide) :?>
                <div class="item<?=$key == 0 ? ' active' : '';?> width_<?=$slide->width_preset;?>" data-index="<?=$key;?>">
                    <div class="description">
                        <div class="dot"></div>
                        <div class="image">
                            <img src="<?=$slide->imageUrl;?>" alt="">
                        </div>
                        <div class="date">
                            <span class="date-item">
                                <?=$slide->date_1;?>
                                <br>
                                <?=$slide->date_2;?>
                            </span>
                        </div>
                        <?=$slide->text;?>
                        <div class="circle fl" data-index="<?=$key;?>">
                            <div class="prev"><i class="fa fa-angle-left"></i></div>
                        </div>
                        <div class="circle fr<?=$key == 0 ? ' active' : '';?>" data-index="<?=$key;?>">
                            <div class="next"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            <?php                                                                                                                                                                                                                                                                                                                                                                                                                                 endforeach;?>
        <?php endif;?>
    </div>
</div>