<?php
use yii\helpers\Url;

$this->title = 'Даты реализации проекта по реновации. Таймлайн';

$this->registerJsFile(Url::toRoute('js/timeline.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Url::toRoute('css/timeline.css'));
$this->registerCssFile(Url::toRoute('css/timeline.scss'));
?>

<svg class="timeline-bg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
    <polygon fill="#0a203a" points="0 27, 0 13, 38 0, 100 0, 100 100, 72 100" />
</svg>
<div class="timeline">
    <div id="section0">
    	<?=$this->render('_top_block');?>
    	
        <div class="container_inner">
            <h1><?=$this->title;?></h1>
        </div>
        <div class="horizontal-scroll-wrapper squares">
			<?php if($slides):?>
				<?php $key = 0;
				foreach ($slides as $key => $slide):?>
		            <div class="item <?=$key == 0 ? 'active' : '';?> mt width_<?=$slide->width_preset;?>" data-index="<?=$key;?>">
		                <div class="date">
		                    <span class="date-item">
		                    	<?=$slide->date_1;?>
		                        <br>
		                        <?=$slide->date_2;?>
		                    </span>
		                </div>
		                <div class="description">
		                    <div class="dot"></div>
		                    <?=$slide->text;?>
		                    <div class="circle fl">
		                        <div class="prev"><</div>
		                    </div>
		                    <div class="circle fr active">
		                        <div class="next">></div>
		                    </div>
		                </div>
		            </div>
				<?php endforeach;?>
			<?php endif;?>
        </div>
    </div>

    <div id="section1">
        <div class="hover">

        </div>
    </div>
</div>