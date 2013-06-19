<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index')),
	array('label'=>'Create Module', 'url'=>array('create')),
	array('label'=>'View Module', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Module', 'url'=>array('admin')),
);
?>

<h1>Update Module <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>