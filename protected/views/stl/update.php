<?php
/* @var $this StlController */
/* @var $model Stl */

$this->breadcrumbs=array(
	'Stls'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stl', 'url'=>array('index')),
	array('label'=>'Create Stl', 'url'=>array('create')),
	array('label'=>'View Stl', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Stl', 'url'=>array('admin')),
);
?>

<h1>Update Stl <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>