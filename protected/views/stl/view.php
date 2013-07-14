<?php
/* @var $this StlController */
/* @var $model Stl */

$this->breadcrumbs=array(
	'Stls'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Stl', 'url'=>array('index')),
	array('label'=>'Create Stl', 'url'=>array('create')),
	array('label'=>'Update Stl', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Stl', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stl', 'url'=>array('admin')),
);
?>

<h1>View Stl #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'original_name',
		'user_id',
		'created_on',
		'updated_on',
	),
)); ?>
