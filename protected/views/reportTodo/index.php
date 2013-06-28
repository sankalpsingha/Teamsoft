<?php
/* @var $this ReportTodoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Report Todos',
);

$this->menu=array(
	array('label'=>'Create ReportTodo', 'url'=>array('create')),
	array('label'=>'Manage ReportTodo', 'url'=>array('admin')),
);
?>

<h1>Report Todos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
