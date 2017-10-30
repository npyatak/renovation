<?php
use yii\helpers\Url;

$this->title = $gallery->title;
?>
<div class="gallery">
    <?=$this->render('_top_block');?>
    
	<div class="container_inner">
		<div class="small_title">Галерея</div>
		<h1><?=$this->title;?></h1>
	</div>
	<div class="grid_wrap">
		<div class="grid">
			<?php if(!empty($slides)):?>
			<div class="grid_item">
				<a href="#popup" class="gallery_inline">
					<img src="<?=$slides[0]->imageUrl;?>"/>
				</a>
				<p class="hidden"><?=$slides[0]->title;?></p>
			</div>
			<?php endif;?>

			<?php if($otherGalleries):?>
			<div class="grid_item">
				<div class="slider_gallery_wrap">
					<div class="small">Галерея</div>
					<div class="slider_gallery owl-carousel">
						<?php foreach ($otherGalleries as $otherGal):?>
						<div class="slider_gallery_item owl-item ">
							<div class="text">
								<a href="<?=Url::toRoute(['site/gallery', 'id' => $otherGal->id]);?>"><?=$otherGal->title;?></a>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<?php endif;?>

			<?php if(!empty($slides) && count($slides) > 1):?>
				<?php $count = count($slides) >= 8 ? 8 : count($slides) - 1;
				for ($i=1; $i <= $count; $i++):?>
					<div class="grid_item">
						<a href="#popup" class="gallery_inline">
							<img src="<?=$slides[$i]->imageUrl;?>"/>
						</a>
						<p class="hidden"><?=$slides[$i]->title;?></p>
					</div>
				<?php endfor;?>
			<?php endif;?>

			<div class="grid_item">
				<div class="gallery_name">
					<div class="small">Карта</div>
					<a href="<?=Url::toRoute('site/map');?>" class="text">
						Стартовые площадки 1 этапа реновации
					</a>
				</div>
			</div>

			<?php if(!empty($slides) && count($slides) > 8):?>
				<?php for ($i=9; $i <= count($slides) - 1; $i++):?>
					<div class="grid_item">
						<a href="#popup" class="gallery_inline">
							<img src="<?=$slides[$i]->imageUrl;?>"/>
						</a>
						<p class="hidden"><?=$slides[$i]->title;?></p>
					</div>
				<?php endfor;?>
			<?php endif;?>
		</div>

		<div class="popups_info">
			<div class="gallery_popup" id="popup">
				<div class="popup_img"></div>
				<div class="popup_text"></div>
				<div class="close"><img src="<?=Url::toRoute('images/close.svg');?>"/></div>
			</div>
		</div>
	</div>
	
</div>