<?php
/* @var $this ModuleController */
/* @var $model Module */

?>


<style>
	#test{
  margin-bottom: 10px;
  margin-left: 10px;
}
#bk{
	background-color: #fff;
	border-radius: 20px;
}

</style>
<div class="span8 offset2">
<div id="bk">
	<div class="row-fluid">
		<div class="span6 offset3">
<h2 class="muted">Create New Module</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
<div class="span3">
	<?php $this->widget('bootstrap.widgets.TbButton',array(
		'type' => 'success',
		'buttonType' => 'link',
		'url' => $this->createUrl('module/index'),
		'label' => 'List Module',
		'htmlOptions' => array('style'=>'margin-top:30px; margin-left:5px;'),

	)); ?>
</div>
</div>
</div>
</div>