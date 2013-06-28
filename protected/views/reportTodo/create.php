<?php
/* @var $this ReportTodoController */
/* @var $model ReportTodo */

$this->breadcrumbs=array(
	'Report Todos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportTodo', 'url'=>array('index')),
	array('label'=>'Manage ReportTodo', 'url'=>array('admin')),
);
?>

<h1>Create ReportTodo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>