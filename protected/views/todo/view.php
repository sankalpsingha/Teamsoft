<?php
/* @var $this TodoController */
/* @var $model Todo */

$this->breadcrumbs=array(
	'Todos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Todo', 'url'=>array('index')),
	array('label'=>'Create Todo', 'url'=>array('create')),
	array('label'=>'Update Todo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Todo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Todo', 'url'=>array('admin')),
);
?>

<h1>View Todo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'todocol',
		'created_on',
		'updated_on',
		'deadline',
		'module_id',
		'user_id',
		'description',
		'completed',
	),
)); ?>
