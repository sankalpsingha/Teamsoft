<?php
/* @var $this ReportTodoController */
/* @var $model ReportTodo */

$this->breadcrumbs=array(
	'Report Todos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReportTodo', 'url'=>array('index')),
	array('label'=>'Create ReportTodo', 'url'=>array('create')),
	array('label'=>'Update ReportTodo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReportTodo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportTodo', 'url'=>array('admin')),
);
?>

<h1>View ReportTodo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'todo_id',
		'report_data',
		'created_on',
		'updated_on',
	),
)); ?>
