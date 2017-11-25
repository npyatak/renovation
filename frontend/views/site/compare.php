<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Хрущевки VS новые дома';
?>
<div class="compare">
    <?=$this->render('_top_block');?>
    
	<div class="container_inner">
		<h1>Хрущёвка VS Новостройка: <span>10 отличий</span></h1>
	
		<?php if($compares):?>
		<div class="items_wrap">
			<?php foreach ($compares as $comp):?>
			<div class="item">
				<div class="item_title"><?=$comp->number?>. <?=$comp->title?></div>
				<div class="item_img_logo"><img src="<?=$comp->imageUrl;?>"/></div>
				<div class="two_part">
					<div class="item_part">
						<?php if($comp->image_old) {
							echo Html::img($comp->imageUrlOld, ['class' => '']);
						} ?>
						<?=$comp->old_text;?>
					</div>
					<div class="item_part">
						<?php if($comp->image_new) {
							echo Html::img($comp->imageUrlNew, ['class' => '']);
						} ?>
						<?=$comp->new_text;?>
					</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
		<?php endif;?>
	</div>
</div>

