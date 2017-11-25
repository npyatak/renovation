<?php
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Закон о реновациях';
?>

<?=Html::a('Закон. Статья 1. Первая часть', Url::toRoute(['site/law']));?>
<?=Html::a('Закон. Статья 1. Вторая часть', Url::toRoute(['site/law', 'page' => 2]));?>
<?=Html::a('Закон. Статья 2.', Url::toRoute(['site/law', 'page' => 3]));?>
<?=Html::a('Народное обсуждение закона о реновации.', Url::toRoute(['site/law', 'page' => 4]));?>

<?=Html::a('Скачать закон', Url::toRoute(['site/law-file']));?>

<?php foreach ($models as $model):?>
	<?=$model->text;?>
<?php endforeach;?>

<?=LinkPager::widget([
    'pagination' => $pages,
]);
?>