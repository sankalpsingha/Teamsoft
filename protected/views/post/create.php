<?php
/* @var $this PostController */
/* @var $model Post */

$this->widget('bootstrap.widgets.TbBreadcrumbs',array(
	'links'=>array('Create'),
	
));

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>
<div class="span8 offset2" >
				<div class="well">

<h2 class="text-success">Create Post</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model,)); ?>
</div>
</div>