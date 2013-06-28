<?php
/* @var $this ReportTodoController */
/* @var $model ReportTodo */

$this->breadcrumbs=array(
	'Report Todos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportTodo', 'url'=>array('index')),
	array('label'=>'Create ReportTodo', 'url'=>array('create')),
	array('label'=>'View ReportTodo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReportTodo', 'url'=>array('admin')),
);
?>

<h1>Update ReportTodo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>