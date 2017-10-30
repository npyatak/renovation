<?php
use yii\helpers\Url;

$this->title = 'Хрущевки VS новые дома';
?>
<div class="compare">
    <?=$this->render('_top_block');?>
    
	<div class="container_inner">
		<h1>Хрущевка VS Новостройка: 10 отличий</h1>
	
		<?php if($compares):?>
		<div class="items_wrap">
			<?php foreach ($compares as $comp):?>
			<div class="item">
				<div class="item_title"><?=$comp->number?>. <?=$comp->title?></div>
				<div class="item_img_logo"><img src="<?=$comp->imageUrl;?>"/></div>
				<div class="two_part">
					<div class="item_part">
						<?=$comp->old_text;?>
					</div>
					<div class="item_part">
						<?=$comp->new_text;?>
					</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
		<?php endif;?>
	</div>
</div>

