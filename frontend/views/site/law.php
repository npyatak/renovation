<?php
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$url = Url::canonical();
$imageUrl = Url::toRoute(['images/items/share.png'], true);
$title = 'Nokia 8: покажи свою историю с обеих сторон';
$desc = 'Создай свое бози и выиграй Nokia 8 #fridaybothie #бозинапятнице #bothie';

$this->title = 'Закон о реновациях';

$this->registerJsFile(Url::toRoute('js/law.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Url::toRoute('js/player_setup_footer.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Url::toRoute('uw/stylesheets/law.css'));
?>

<div class="law">
	<?=$this->render('_top_block', ['class' => ' white']);?>
	<div class="law-header">
		<div class="container_inner">
			<h1>Закон о реновации</h1>
			<p>Федеральный закон от 1 июля 2017 года № 141-ФЗ "О внесении изменений в Закон Российской Федерации "О статусе столицы Российской Федерации" и отдельные законодательные акты Российской Федерации в части установления особенностей регулирования отдельных правоотношений в целях реновации жилищного фонда в субъекте Российской Федерации - городе федерального значения Москве"</p>
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
				<li><?=Html::a('Закон. Статья 1. Первая часть', Url::toRoute(['site/law']));?></li>
				<li><?=Html::a('Закон. Статья 1. Вторая часть', Url::toRoute(['site/law', 'page' => 2]));?></li>
				<li><?=Html::a('Закон. Статья 2', Url::toRoute(['site/law', 'page' => 3]));?></li>
				<li><?=Html::a('Народное обсуждение закона о реновации', Url::toRoute(['site/law', 'page' => 4]));?></li>
			</ul>
			<div class="facts">
				<li>14 июня 2017 г. принят Государственной Думой</li>
				<li>28 июня 2017 г. одобрен Советом Федерации</li>
				<li>1 июля 2017 г. подписан</li>
				<li>4 июля 2017 г. опубликован</li>
				<li>1 июля 2017 г. вступил в силу</li>
			</div>
			<div class="btn-wrap">
				<a class="btn btn-warning" href="<?=Url::toRoute(['site/law-file']);?>">Скачать текст закона</a>
			</div>
			<div class="law-text">
				<?php foreach ($models as $model):?>
					<?=$model->text;?>
				<?php endforeach;?>
			</div>
			<?=LinkPager::widget([
				'pagination' => $pages,
			]);
			?>
		</div>
	</div>
</div>