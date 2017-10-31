<?php
use yii\helpers\Url;

$this->title = 'Даты реализации проекта по реновации. Таймлайн';

$this->registerJsFile(Url::toRoute('js/timeline.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Url::toRoute('uw/stylesheets/timeline.css'));
?>

<div class="timeline blue_top_bg">
    <?=$this->render('_top_block', ['class' => ' white']);?>
    	
    <div class="container_inner white_text">
        <h1 class="white_text"><?=$this->title;?></h1>
    </div>
    
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
                        <div class="circle fl" data-index="<?=$key;?>">
                            <div class="prev"><</div>
                        </div>
                        <div class="circle fr<?=$key == 0 ? ' active' : '';?>" data-index="<?=$key;?>">
                            <div class="next">></div>
                        </div>
                    </div>
                </div>
            <?php                                                                                                                                                                                                                                                                                                                                                                                                                                 endforeach;?>
        <?php endif;?>
    </div>
</div>