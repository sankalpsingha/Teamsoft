<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index')),
	array('label'=>'Manage Module', 'url'=>array('admin')),
);
?>

<h1>Create Module</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>