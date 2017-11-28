<?php 
use yii\helpers\Url;
use frontend\assets\HomePageAsset;

HomePageAsset::register($this);
?>

<?=$this->render('_top_block', ['class' => ' white']);?>

<div class="np-section np-section_full_first np-section_full np-section_1">
    <div class="np-wrap np-wrap_flex np-wrap_absolute">

		<a href="<?=Url::home();?>" class="np-section__back">На главную</a>

		<h1 class="np-section__el">Москва<br>без пятиэтажек</h1>

		<img src="images/1-logo.png" alt="">

		<div class="np-text-content np-text-content_i np-section__el">
			<p>Все о проекте реновации в одном спецпроекте: история, перспективы, новости, личный опыт, нормативные документы.</p>
		</div>

		<a href="" class="np-section__scroll"></a>

	</div>
</div>

<div class="np-section np-section_2">
	<div class="np-wrap np-wrap_flex">

		<h2 class="np-section__el">Московские пятиэтажки:<br>история вопроса</h2>

		<div class="np-text-content np-text-content_i np-section__el">
			<p>Зачем Советскому Союзу нужны были «хрущевки», какие серии строились в разные периоды «индустриального домостроения», чем они отличались друг от друга. </p>
		</div>

		<div class="np-section_2__image-outer np-section__el">
			<p class="np-section_2_image-description">
				Кризис на рынке жилья 
				<br>Хрущевки
				<br>"Брежневки"
				<br>Лужковская программа 
				<br>Конец первой волны
			</p>
			<div class="np-section_2__image">
				<div class="np-bg-image">
					<a href="<?=Url::toRoute(['site/history']);?>" class="np-button np-button_top-left np-button_orange">Читать</a>
					<img src="images/2-1.jpg" alt="">
				</div>
				<p>Жилищное строительство в микрорайоне Ясенево, 1976 год<br>Фотоархив ТАСС</p>
			</div>
		</div>

	</div>
</div>

<div class="np-section np-section_3">
	<div class="np-wrap np-wrap_flex">
		<div class="np-section_3__image">
			<div class="np-bg-image"><a href="" class="np-button np-button_play">Смотреть <span></span></a><img src="images/2-2.jpg" alt=""></div>
		</div>
		<div class="np-section_3__wrap">
			<div class="np-text-content">
				<div class="np-text-content__title">Видео-галерея</div>
				<p>Чудовищный кризис на рынке жилья – только одна из проблем, с которыми столкнулся Советский Союз после окончания Великой Отечественной. - Небольшой ввдный текст к видео с приглашением смотреть</p>
			</div>
		</div>
		
		<a href="" class="np-section__scroll"></a>
	</div>
</div>

<div class="np-section np-section_4 np-section_4_0">
	<div class="np-wrap np-wrap_flex">
			
		<h2 class="np-section__el">Реновация в датах</h2>

		<div class="np-text-content np-text-content_i np-section__el">
			<p>От предложения проекта до его реализации</p>
		</div>

		<div class="np-section_4__image np-section__el">
			<div class="np-bg-image">
				<a href="<?=Url::toRoute(['site/timeline']);?>" class="np-button np-button_top-right np-button_white">Читать</a>
				<img src="images/4.jpg" alt="">
			</div>
		</div>

	</div>
</div>

<div class="np-section np-section_5" style="background-image: url('images/5.jpg');">
	<div class="np-wrap np-wrap_flex">
			
			<h2 class="np-section__el">Пионеры<br>реновации</h2>
			
			<div class="np-text-content np-text-content_i np-section__el">
				<p>Запуск программы реновации жилья в Москве вызвал огромный резонанс и общественную дискуссию. Между тем, сносить панельные пятиэтажки в столице начали еще в конце 1990-х годов. С того момента городские власти расселили более полутора тысяч домов. Москвичам, которые в них жили, есть что вспомнить о том, как проходит переезд, каким было их впечатление от новых квартир и довольны ли они переменами. В специальном проекте ТАСС одни москвичи рассказывают о том, как сменили хрущевки на новостройки, а другие – почему хотят это сделать.</p>
				<a href="http://pyatiehtazhki.tass.ru/?_ga=2.127206541.1082805625.1511712625-56336648.1505299740" target="_blank" class="np-button np-button_orange">Читать</a>
			</div>

	</div>
</div>

<div class="np-section np-section_4 np-section_4_1">
	<div class="np-wrap np-wrap_flex">
			
		<h2 class="np-section__el">Пятиэтажки VS<br>новостройки</h2>

		<div class="np-text-content np-text-content_i np-section__el">
			<p>Чем старое жилье будет отличаться от нового – в деталях, цифрах и чертежах</p>
			<a href="<?=Url::toRoute(['site/compare']);?>" class="np-button np-button_blue">Читать</a>
		</div>

		<div class="np-section_4__image np-section__el">
			<div class="np-bg-image">
				<img src="images/6.jpg" alt="">
			</div>
		</div>
	</div>
</div>

<div class="np-section np-section_5 np-section_5_1" style="background-image: url('images/7.jpg');">
	<div class="np-wrap np-wrap_flex">	
			<h2 class="np-section__el">Новости о реновации</h2>
			
			<div class="np-text-content np-text-content_i np-section__el">
				<p>Самая свежая информация - здесь</p>
				<a href="http://tass.ru/renovaciya" target="_blank" class="np-button np-button_blue">Узнать</a>
			</div>
	</div>
</div>

<?php if($galleries):?>
<div class="np-section np-section_4 np-section_4_2">
	<div class="np-wrap np-wrap_flex">			
		<h2 class="np-section__el">Галереи</h2>
		<div class="np-text-content np-section__el">
	        <?php foreach ($galleries as $gal):?>
	            <p>
	                <a href="<?=Url::toRoute(['site/gallery', 'id' => $gal->id]);?>">
	                	<?=$gal->title;?>
	                </a>
	            </p>
	        <?php endforeach;?>
		</div>
	</div>
</div>
<?php endif;?>