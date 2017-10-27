<?php
if($page !== null) {
	$this->title = $page->title;
}
?>
<br>
<br>
<br>
<br>
<?php if($slides):?>
	<?php foreach ($slides as $slide):?>
		<div class="width_<?=$slide->width_preset;?>">
			<h3><?=$slide->dateFormatted;?></h3>
			<p><?=$slide->text;?></p>
		</div>
	<?php endforeach;?>
<?php endif;?>