<?php
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$url = Url::canonical();
$imageUrl = Url::toRoute([Yii::$app->params['shareImage']], true);
$title = Yii::$app->params['shareTitle'];
$desc = Yii::$app->params['shareText'];

$this->title = 'Вокруг реновации: '.$model->title;

$this->registerJsFile(Url::toRoute('js/law.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile(Url::toRoute('js/player_setup_footer.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Url::toRoute('uw/stylesheets/law.css'));
?>

<div class="law">
	<?=$this->render('_top_block', ['class' => ' white']);?>
	<div class="law-header" style='background-image: url("../../images/<?=$model->url;?>.jpg")'>
		<div class="container_inner">
			<h1>Вокруг реновации: <br><br><?=$model->title;?></h1>
			<p><?=$model->text_additional;?></p>
			<div class="btn-wrap">
				<span class="btn-down"><i class="fa fa-angle-down"></i></span>
			</div>
			<div class="social-wrap">
				<?=Html::a('<i class="fa fa-facebook"></i>', '', [
					'data-type' => 'fb',
					'data-url' => $url,
					'data-title' => $title,
					'data-image' => $imageUrl,
					'data-desc' => $desc,
				]);?>
				<?=Html::a('<i class="fa fa-vk"></i>', '', [
					'data-type' => 'vk',
					'data-url' => $url,
					'data-title' => $title,
					'data-image' => $imageUrl,
					'data-desc' => $desc,
				]);?>
				<?=Html::a('<i class="fa fa-twitter"></i>', '', [
					'data-type' => 'tw',
					'data-url' => $url,
					'data-title' => $title,
				]);?>
				<?=Html::a('<i class="fa fa-odnoklassniki"></i>', '', [
					'data-type' => 'ok',
					'data-url' => $url,
					'data-desc' => $desc,
				]);?>
			</div>
		</div>
	</div>
	<div class="law-content">
		<div class="container_inner">
			<ul class="urls">
				<li><?=Html::a('Социальные обязательства', Url::toRoute(['site/about']));?></li>
				<li><?=Html::a('Инфраструктура', Url::toRoute(['site/about', 'page' => $items[2]]));?></li>
				<li><?=Html::a('Экология', Url::toRoute(['site/about', 'page' => $items[3]]));?></li>
			</ul>
			<div class="law-text">
				<?=$model->text;?>
			</div>
		    <ul class="pagination">
		    <?php foreach ($items as $key => $item):?>
		    	<li <?=$page == $item ? 'class="active"' : '';?>><a href="<?=Url::toRoute(['site/about', 'page' => $item]);?>"><?=$key;?></a></li>
		    <?php endforeach;?>
		    </ul>
		</div>
	</div>
</div>