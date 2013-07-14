<?php
/* @var $this StlController */
/* @var $model Stl */

$this->breadcrumbs=array(
	'Stls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stl', 'url'=>array('index')),
	array('label'=>'Manage Stl', 'url'=>array('admin')),
);
?>

<h1>Create Stl</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>